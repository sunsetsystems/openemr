<?php
/*
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2017-2021 Rod Roark <rod@sunsetsystems.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/checkout_receipt_array.inc.php");
require_once("$srcdir/compute_line_amounts.inc.php");
require_once("../../custom/code_types.inc.php");

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use OpenEMR\Services\FacilityService;

// For each sorting option, specify the ORDER BY argument.
// "invoiceno, pid, encounter, payor" are always together because these are the possible components
// of the displayed invoice number.
$ORDTYPE = "`item` = 'PREVBAL', `item` = 'Credit', `item` = 'DISCOUNT'";
$ORDERHASH = array(
    'item'    => "$ORDTYPE, item, service_date, invoice, customer",
    'svcdate' => "service_date, invoice, $ORDTYPE, customer, item",
    'paydate' => "payment_date, service_date, invoice, $ORDTYPE, customer, item",
    'invoice' => "invoice, service_date, $ORDTYPE, customer, item",
    'payor'   => "customer, service_date, invoice, $ORDTYPE, item",
    'method'  => "payment_method, service_date, invoice, $ORDTYPE, customer, item",
    'site'    => "site, service_date, invoice, $ORDTYPE, customer, item",
);

function bucks($amount)
{
    if ($amount) {
        echo oeFormatMoney($amount);
    }
}

function display_desc($desc)
{
    if (preg_match('/^\S*?:(.+)$/', $desc, $matches)) {
        $desc = $matches[1];
    }
    return $desc;
}

function output_csv($s)
{
    return str_replace('"', '""', $s);
}

// Compute price per unit preferring number of decimals for the locale, but increasing
// that up to a reasonable limit when there would otherwise be rounding error.
//
function oeFormatMoneySpreadsheet($amount, $blankifzero=false)
{
    $d = $GLOBALS['currency_decimals'];
    $max_decimals = $d + 4;
    $amount = round($amount, $max_decimals);
    if ($amount == 0) {
        if ($blankifzero) return '';
        // Workaround for results of -0.00.
        $amount = 0;
    }
    for (; $d < $max_decimals; ++$d) {
        if ($amount == round($amount, $d)) {
            break;
        }
    }
    return sprintf('%01.' . $d . 'f', $amount);
}

function get_related_code($related_codes, $type)
{
    $ret = '';
    $relcodes = explode(';', $related_codes);
    foreach ($relcodes as $codestring) {
        if ($codestring === '') {
            continue;
        }
        list($codetype, $code) = explode(':', $codestring);
        if ($codetype != $type) {
            continue;
        }
        $ret = $code;
        break;
    }
    return $ret;
}

function get_related_code_name($related_codes, $type)
{
    global $code_types;
    $ret = '';
    $code = get_related_code($related_codes, $type);
    if ($code) {
        $typeid = empty($code_types[$type]) ? 0 : $code_types[$type]['id'];
        $tmprow = sqlQuery(
            "SELECT code_text, related_code FROM codes WHERE " .
            "code_type = ? AND code = ? AND active = 1",
            array($typeid, $code)
        );
        if (!empty($tmprow)) {
            $ret = $tmprow['code_text'];
        }
    }
    return $ret;
}

// Get dimensions and gift card ID for a given charge item.
//
function getDimensions($patient_id, $encounter_id, $payor, $item_related_code, $fac_related_code)
{
    global $code_types;
    $dimarr = array(
        'proj_code' => '',
        'project' => '',
        'fund_name' => '',
        'dept_name' => '',
        'sobj_name' => '',
        'act_name' => '',
        'gift_card_id' => '',
    );
    // Compute gift card ID and project, fund, dept, sobj, act names.
    // If payor has a project associated, use that project;
    // Else if Service or Product has a Project, use that Project;
    // Else if Facility has a project mapped to Service or Products, use that Project.
    $gcrow = sqlQuery(
        "SELECT notes FROM list_options WHERE list_id = 'chargecats' AND " .
        "option_id = ? AND activity = 1 LIMIT 1",
        array($payor)
    );
    if (!empty($gcrow['notes'])) {
        if (preg_match('/PROJ=([0-9A-Za-z]+)/', $gcrow['notes'], $matches)) {
            $dimarr['proj_code'] = $matches[1];
        }
        if (preg_match('/GIFTCARD=Y/', $gcrow['notes'], $matches)) {
            $gcrow = sqlQuery(
                "SELECT a.memo FROM ar_activity AS a WHERE " .
                "a.pid = ? AND a.encounter = ? AND a.deleted IS NULL AND a.pay_amount > 0.00 " .
                "ORDER BY a.pay_amount DESC LIMIT 1",
                array($patient_id, $encounter_id)
            );
            if (!empty($gcrow['memo'])) {
                $tmp = strpos($gcrow['memo'], ' ');
                $tmp = $tmp === false ? 0 : ($tmp + 1); 
                $dimarr['gift_card_id'] = substr($gcrow['memo'], $tmp);
            }
        }
    }
    if ($dimarr['proj_code'] === '') {
        $dimarr['proj_code'] = get_related_code($item_related_code, 'PROJ');
    }
    if ($dimarr['proj_code'] === '') {
        $dimarr['proj_code'] = get_related_code($fac_related_code, 'PROJ');
    }
    $projid = empty($code_types['PROJ']) ? 0 : $code_types['PROJ']['id'];
    if ($dimarr['proj_code'] !== '') {
        $tmprow = sqlQuery(
            "SELECT code_text, related_code FROM codes WHERE " .
            "code_type = ? AND code = ? AND active = 1",
            array($projid, $dimarr['proj_code'])
        );
        if (!empty($tmprow)) {
            $dimarr['project'] = $tmprow['code_text'];
            $dimarr['fund_name'] = get_related_code_name($tmprow['related_code'], 'FUND');
            $dimarr['dept_name'] = get_related_code_name($tmprow['related_code'], 'DEPT');
            $dimarr['sobj_name'] = get_related_code_name($tmprow['related_code'], 'SOBJ');
            $dimarr['act_name']  = get_related_code_name($tmprow['related_code'], 'ACT' );
        }
    }
    // ACT code in the service overrides any other (2019-03-12).
    if (get_related_code($item_related_code, 'ACT')) {
        $dimarr['act_name'] = get_related_code_name($item_related_code, 'ACT' );
    }
    return $dimarr;
}

function insertLineItem(&$outstuff)
{
    $qparms = array();
    $delim = '';
    $query = "INSERT INTO nstemp SET";
    foreach ($outstuff as $key => $value) {
        $query .= "$delim `$key` = ";
        if (is_null($value)) {
            $query .= "NULL";
        } else {
            $query .= "?";
            $qparms[] = $value;
        }
        $delim = ',';
    }
    sqlStatement($query, $qparms);
}

function thisLineItem($patient_id, $encounter_id, $code_type, $code, $selector,
  $description, $svcdate, $paydate, $qty, $amount, $irnumber, $payor, $sitecode,
  $terms, $item_related_code, $fac_related_code, $ndc_number, $customer_name, $balance)
{
    // global $aItems, $aTaxNames, $overpayments, $previous_invnumber_display, $code_types;
    global $aItems, $aTaxNames, $overpayments;

    // Invoice number will be displayed with a suffix to indicate checkout sequence number.
    // Zero suffix indicates there was no checkout for the line item.
    $invnumber = $irnumber ? $irnumber : "$patient_id.$encounter_id";

    if (!$payor) {
        // This should not happen!
        $payor = 'C00001';
    }

    $pay_method = $payor == 'C00001' ? 'Cash' : '';

    $invnumber_display = $invnumber . '_' . substr($payor, -3);

    if (empty($qty)) {
        $qty = 1;
    }
    $rowamount = sprintf('%01.2f', $amount);
    $disp_code = $code;
    if ($code_type == 'PROD') {
        $disp_code = $ndc_number;
    }

    $invno = "$patient_id.$encounter_id";

    // This is to get the sum of taxes for the line item.
    ensureLineAmounts($patient_id, $encounter_id);
    $codekey = $code_type . ':' . $code;
    if (!empty($selector)) {
        $codekey .= ':' . $selector;
    }
    $rowtax = 0;
    foreach ($aItems[$invno][$codekey]['tax'] as $tmp) {
        $rowtax += $tmp;
    }

    $memo = "OpenEMR Inv " . $invnumber_display;
    $memo_header = $memo;

    // Get info related to the discount, if any.
    $adjrow = sqlQuery(
        "SELECT a.adj_amount, lo.title, lo.notes " .
        "FROM ar_activity AS a " .
        "JOIN list_options AS lo ON lo.list_id = 'adjreason' AND lo.option_id = a.memo AND lo.activity = 1 " .
        "WHERE " .
        "a.pid = ? AND a.encounter = ? AND a.deleted IS NULL AND " .
        "a.code_type = ? AND a.code = ? AND " .
        "(a.adj_amount != 0.00 OR a.pay_amount = 0.00) AND a.memo != '' " .
        "ORDER BY lo.notes DESC, a.adj_amount DESC LIMIT 1",
        array($patient_id, $encounter_id, $code_type, $code)
    );

    $dimarr = getDimensions($patient_id, $encounter_id, $payor, $item_related_code, $fac_related_code);

    if (empty($customer_name)) {
        // We expect $payor was originally empty and is now C00001 here.
        $customer_name = getListItemTitle('chargecats', $payor);
    }

    // Per SRD June 2019.
    if ($balance) {
        $payor = 'CR0001';
        $customer_name = 'Credit';
        $pay_method = '';
        $terms = 'Net 30';
    }

    $outstuff = array(
        'ptenc'          => "$patient_id,$encounter_id", // using a comma for doinvopen()
        'service_date'   => $svcdate,
        'payment_date'   => $paydate,
        'invoice'        => $invnumber_display,
        'item'           => $disp_code,
        'description'    => $description,
        'qty'            => $qty,
        'each'           => $amount / $qty,
        'tax'            => $rowtax,
        'memo_header'    => $memo_header,
        'memo_column'    => $memo,
        'giftcard'       => $dimarr['gift_card_id'],
        'customer'       => $payor,
        'customer_name'  => $customer_name,
        'payment_method' => $pay_method,
        'terms'          => $terms,
        'strategic_obj'  => $dimarr['sobj_name'],
        'site'           => $sitecode,
        'project'        => $dimarr['project'],
        'fund'           => $dimarr['fund_name'],
        'activity'       => $dimarr['act_name'],
        'department'     => $dimarr['dept_name'],
    );
    insertLineItem($outstuff);

    // If there is a discount adjustment write a row for it.
    if (!empty($adjrow['notes']) && preg_match('/TYPE=DISCOUNT/i', $adjrow['notes'])) {
        $outstuff['item'         ] = xl('DISCOUNT');
        $outstuff['qty'          ] = 1;
        $outstuff['each'         ] = 0 - $adjrow['adj_amount'];
        $outstuff['tax'          ] = 0;
        $outstuff['memo_header'  ] = '';
        $outstuff['giftcard'     ] = '';
        $outstuff['customer'     ] = '';
        $outstuff['customer_name'] = '';
        $outstuff['terms'        ] = '';
        insertLineItem($outstuff);
    }
} // end function thisLineItem

$previous_invnumber_display = '';

function writeLineItems()
{
    global $orderby, $previous_invnumber_display;
    $res = sqlStatement("SELECT * FROM nstemp ORDER BY $orderby");
    while ($row = sqlFetchArray($res)) {
        if (!empty($_POST['form_csvexport'])) {
        }
        else {
            echo " <tr>\n";
        }
        $ptenc = '0,0';
        $delim = '';
        foreach ($row as $key => $value) {
            if ($key == 'ptenc') {
                $ptenc = $value;
                continue;
            }
            else if ($key == 'service_date' || $key == 'payment_date') {
                $value = oeFormatShortDate($value);
            }
            else if ($key == 'each' || $key == 'tax') {
                $value = oeFormatMoneySpreadsheet($value);
            }
            else if ($key == 'memo_header') {
                if ($previous_invnumber_display == $row['invoice']) {
                    $value = '';
                }
            }
            if (!empty($_POST['form_csvexport'])) {
                echo $delim . '"' . output_csv($value) . '"';
                $delim = ',';
            }
            else {
                if ($key == 'invoice') {
                    echo "  <td class='delink' onclick='doinvopen($ptenc)'>";
                } else {
                    echo "  <td class='detail'>";
                }
                echo text($value) . "</td>\n";
            }
        }
        if (!empty($_POST['form_csvexport'])) {
            echo "\n";
        }
        else {
            echo " </tr>\n";
        }
        $previous_invnumber_display = $row['invoice'];
    }
}

function get_post_var($varname, $default='')
{
    return isset($_POST[$varname]) ? $_POST[$varname] : $default;
}

function get_req_var($varname, $default='')
{
    return isset($_REQUEST[$varname]) ? $_REQUEST[$varname] : $default;
}

if (!empty($_POST)) {
    if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
        CsrfUtils::csrfNotVerified();
    }
}
if (!AclMain::aclCheckCore('acct', 'rep_a')) {
    die("Unauthorized access.");
}

$form_from_date = fixDate(get_post_var('form_from_date'), date('Y-m-01'));
$form_to_date   = fixDate(get_post_var('form_to_date'), date('Y-m-d'));

// The selected facility IDs, if any.
$form_facility  = get_post_var('form_facility', array());

$form_payor     = get_post_var('form_payor');

$tmp = get_req_var('form_orderby');
$form_orderby = empty($ORDERHASH[$tmp]) ? 'svcdate' : $tmp;
$orderby = $ORDERHASH[$form_orderby];

// Get the tax types applicable to this report's date range.
$aTaxNames = array();
$tnres = sqlStatement(
    "SELECT DISTINCT b.code, b.code_text " .
    "FROM billing AS b " .
    "JOIN form_encounter AS fe ON fe.pid = b.pid AND fe.encounter = b.encounter " .
    "WHERE b.code_type = 'TAX' AND b.activity = '1' AND fe.date >= ? AND fe.date <= ? " .
    "ORDER BY b.code, b.code_text",
    array("$form_from_date 00:00:00", "$form_to_date 23:59:59")
);
while ($tnrow = sqlFetchArray($tnres)) {
    $aTaxNames[$tnrow['code']] = $tnrow['code_text'];
}

if (!empty($_POST['form_csvexport'])) {
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download; charset=utf-8");
    header("Content-Disposition: attachment; filename=netsuite_export.csv");
    header("Content-Description: File Transfer");
    // Prepend a BOM (Byte Order Mark) header to mark the data as UTF-8.  This is
    // said to work for Excel 2007 pl3 and up and perhaps also Excel 2003 pl3.  See:
    // http://stackoverflow.com/questions/155097/microsoft-excel-mangles-diacritics-in-csv-files
    // http://crashcoursing.blogspot.com/2011/05/exporting-csv-with-special-characters.html
    echo "\xEF\xBB\xBF";
    // CSV headers:
    echo '"' . xl('Service Date'    ) . '",';
    echo '"' . xl('Payment Date'    ) . '",';
    echo '"' . xl('Invoice'         ) . '",';
    echo '"' . xl('Item'            ) . '",';
    echo '"' . xl('Description'     ) . '",';
    echo '"' . xl('Qty'             ) . '",';
    echo '"' . xl('Each'            ) . '",';
    echo '"' . xl('Tax'             ) . '",';
    echo '"' . xl('Memo Header'     ) . '",';
    echo '"' . xl('Memo Column'     ) . '",';
    echo '"' . xl('GiftCard'        ) . '",';
    echo '"' . xl('Customer'        ) . '",';
    echo '"' . xl('Customer Name'   ) . '",';
    echo '"' . xl('Payment Method'  ) . '",';
    echo '"' . xl('Terms'           ) . '",';
    echo '"' . xl('Strategic Obj'   ) . '",';
    echo '"' . xl('Site'            ) . '",';
    echo '"' . xl('Project'         ) . '",';
    echo '"' . xl('Fund'            ) . '",';
    echo '"' . xl('Activity'        ) . '",';
    echo '"' . xl('Department'      ) . '"';
    echo "\n";
} // end export
else {
?>
<html>
<head>
<title><?php echo xlt('NetSuite Export') ?></title>

<?php Header::setupHeader(['datetime-picker', 'report-helper']); ?>

<style type="text/css">

 .dehead { color:#000000; font-family:sans-serif; font-size:10pt; font-weight:bold }
 .detail { color:#000000; font-family:sans-serif; font-size:10pt; font-weight:normal }
 .delink { color:#0000cc; font-family:sans-serif; font-size:10pt; font-weight:normal; cursor:pointer }

table.mymaintable, table.mymaintable td {
 border: 1px solid #aaaaaa;
 border-collapse: collapse;
}
table.mymaintable td {
 padding: 1pt 4pt 1pt 4pt;
}

</style>

<script type="text/javascript" src="../../library/textformat.js?v=<?php echo $v_js_includes; ?>"></script>
<script type="text/javascript" src="../../library/topdialog.js?v=<?php echo $v_js_includes; ?>"></script>
<script type="text/javascript" src="../../library/dialog.js?v=<?php echo $v_js_includes; ?>"></script>
<script type="text/javascript" src="../../library/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../library/js/report_helper.js?v=<?php echo $v_js_includes; ?>"></script>

<script>

$(function () {
    $('.datepicker').datetimepicker({
        <?php $datetimepicker_timepicker = false; ?>
        <?php $datetimepicker_showseconds = false; ?>
        <?php $datetimepicker_formatInput = true; ?>
        <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
        <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
    });

    // Enable fixed headers when scrolling the report.
    if (window.oeFixedHeaderSetup) {
        oeFixedHeaderSetup(document.getElementById('mymaintable'));
    }
});

var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';

function dosort(orderby) {
 var f = document.forms[0];
 f.form_orderby.value = orderby;
 if (opener) opener.top.restoreSession(); else top.restoreSession();
 f.submit();
 return false;
}

// Process click to pop up the add/edit window.
function doinvopen(ptid,encid) {
 dlgopen('../patient_file/pos_checkout.php?ptid=' + ptid + '&enc=' + encid, '_blank', 750, 550);
}

</script>

</head>

<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
<center>

<h2><?php echo xlt('NetSuite Export')?></h2>

<form method='post' action='netsuite_export.php' onsubmit='return top.restoreSession()'>
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />

<center>
<table border='0' cellpadding='3'>

 <tr>
  <td rowspan='2'>
<?php
    // Indented for the not-export case.

    // Build a multi-select list of facilities.
    //
    $facilityService = new FacilityService();
    $fres = $facilityService->getAllFacility();
    echo "   <select name='form_facility[]' multiple='multiple' " .
        "title='" . xla('Select one or more clinics, or none for all clinics.') . "'>\n";
    foreach ($fres as $frow) {
        $facid = $frow['id'];
        echo "    <option value='$facid'";
        if (in_array($facid, $form_facility)) {
            echo " selected";
        }
        echo ">" . text($frow['name']) . "</option>\n";
    }
    echo "   </select>\n";
?>
  </td>
  <td>
<?php
    // Build a drop-down for payor type.
    echo "   <select name='form_payor'>\n";
    echo "    <option value=''"  . ($form_payor == ''  ? ' selected' : '') . ">-- " . xl('All Payors') . " --\n";
    echo "    <option value='c'" . ($form_payor == 'c' ? ' selected' : '') . ">"    . xl('Cash'   ) . "\n";
    echo "    <option value='i'" . ($form_payor == 'i' ? ' selected' : '') . ">"    . xl('Insurer') . "\n";
    echo "   </select>&nbsp;\n";
?>
  &nbsp;
   <?php echo xlt('From'); ?>:
   <input type='text' class='datepicker' name='form_from_date' id='form_from_date' size='10'
    value='<?php echo attr(oeFormatShortDate($form_from_date)); ?>' />
   &nbsp;<?php echo xlt('To'); ?>:
   <input type='text' class='datepicker' name='form_to_date' id='form_to_date' size='10'
    value='<?php echo attr(oeFormatShortDate($form_to_date)); ?>' />
  </td>
 </tr>
 <tr>
  <td>
   <input type='submit' name='form_refresh' value="<?php echo xlt('Run') ?>">
   &nbsp;
   <input type='submit' name='form_csvexport' value="<?php echo xlt('Export to CSV') ?>">
   &nbsp;
   <input type='button' value='<?php echo xlt('Print'); ?>' onclick='window.print()' />
  </td>
 </tr>

 <tr>
  <td height="1">
  </td>
 </tr>

</table>
</center>

<table width='98%' id='mymaintable' class='mymaintable'>
 <thead>
 <tr bgcolor="#dddddd">
  <td class="dehead">
   <a href="#" onclick="return dosort('svcdate')"
   <?php if ($form_orderby == "svcdate") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Service Date'); ?></a>
  </td>
  <td class="dehead">
   <a href="#" onclick="return dosort('paydate')"
   <?php if ($form_orderby == "paydate") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Payment Date'); ?></a>
  </td>
  <td class="dehead">
   <a href="#" onclick="return dosort('invoice')"
   <?php if ($form_orderby == "invoice") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Invoice'); ?></a>
  </td>
  <td class="dehead">
   <a href="#" onclick="return dosort('item')"
   <?php if ($form_orderby == "item") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Item'); ?></a>
  </td>
  <td class="dehead">
   <?php echo xlt('Description'); ?>
  </td>
  <td class="dehead" align="right">
   <?php echo xlt('Qty'); ?>
  </td>
  <td class="dehead" align="right">
   <?php echo xlt('Each'); ?>
  </td>
  <td class="dehead" align="right">
   <?php echo xlt('Tax'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('Memo Header'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('Memo Column'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('GiftCard'); ?>
  </td>
  <td class="dehead">
   <a href="#" onclick="return dosort('payor')"
   <?php if ($form_orderby == "payor") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Customer'); ?></a>
  </td>
  <td class="dehead">
   <?php echo xlt('Customer Name'); ?>
  </td>
  <td class="dehead">
   <a href="#" onclick="return dosort('method')"
   <?php if ($form_orderby == "method") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Payment Method'); ?></a>
  </td>
  <td class="dehead">
   <?php echo xlt('Terms'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('Strategic Obj'); ?>
  </td>
  <td class="dehead">
   <a href="#" onclick="return dosort('site')"
   <?php if ($form_orderby == "site") echo " style=\"color:#00cc00\""; ?>
   ><?php echo xlt('Site'); ?></a>
  </td>
  <td class="dehead">
   <?php echo xlt('Project'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('Fund'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('Activity'); ?>
  </td>
  <td class="dehead">
   <?php echo xlt('Department'); ?>
  </td>
 </tr>
 </thead>
 <tbody>
<?php
} // end not export

if (!empty($_POST['form_orderby'])) {
    $from_date = $form_from_date;
    $to_date   = $form_to_date;
    $overpayments = 0;
    $aItems = array();

    sqlStatement(
        "CREATE TEMPORARY TABLE nstemp ( " .
        "`ptenc`          VARCHAR(64) DEFAULT '', " .
        "`service_date`   DATE DEFAULT NULL, " .
        "`payment_date`   DATE DEFAULT NULL, " .
        "`invoice`        VARCHAR(64) DEFAULT '', " .
        "`item`           VARCHAR(64) DEFAULT '', " .
        "`description`    VARCHAR(128) DEFAULT '', " .
        "`qty`            INT(11) NOT NULL DEFAULT 0, " .
        "`each`           DECIMAL(12,2) NOT NULL DEFAULT 0, " .
        "`tax`            DECIMAL(12,2) NOT NULL DEFAULT 0, " .
        "`memo_header`    VARCHAR(128) DEFAULT '', " .
        "`memo_column`    VARCHAR(128) DEFAULT '', " .
        "`giftcard`       VARCHAR(64) DEFAULT '', " .
        "`customer`       VARCHAR(64) DEFAULT '', " .
        "`customer_name`  VARCHAR(128) DEFAULT '', " .
        "`payment_method` VARCHAR(128) DEFAULT '', " .
        "`terms`          VARCHAR(128) DEFAULT '', " .
        "`strategic_obj`  VARCHAR(128) DEFAULT '', " .
        "`site`           VARCHAR(128) DEFAULT '', " .
        "`project`        VARCHAR(128) DEFAULT '', " .
        "`fund`           VARCHAR(128) DEFAULT '', " .
        "`activity`       VARCHAR(128) DEFAULT '', " .
        "`department`     VARCHAR(128) DEFAULT '' " .
        ") ENGINE=MyISAM;"
    );

    $dt1 = "$from_date 00:00:00";
    $dt2 = "$to_date 23:59:59";

    $encres = sqlStatement(
        "SELECT pid, encounter FROM form_encounter WHERE date >= ? AND date <= ? UNION " .
        "SELECT DISTINCT pid, encounter FROM ar_activity WHERE pay_amount > 0.00 AND " .
        "deleted IS NULL AND post_date >= ? AND post_date <= ? " .
        "ORDER BY pid, encounter",
        array($dt1, $dt2, $from_date, $to_date)
    );

    while ($encrow = sqlFetchArray($encres)) {
        $ferow = sqlQuery(
            "SELECT " .
            "substr(fe.date, 1, 10) AS svcdate, fe.invoice_refno AS invoiceno, fe.facility_id, " .
            "f.facility_npi, f.related_code_2 AS fac_related_code " .
            "FROM form_encounter AS fe " .
            "LEFT JOIN facility AS f ON f.id = fe.facility_id " .
            "WHERE fe.pid = ? AND fe.encounter = ?",
            array($encrow['pid'], $encrow['encounter'])
        );

        if (empty($ferow)) {
            continue;
        }

        if (!empty($form_facility) && !in_array($ferow['facility_id'], $form_facility)) {
            continue;
        }

        // Compute the money balance as of the visit date.
        $chgrow = sqlQuery(
            "SELECT SUM(fee) AS charges FROM billing WHERE activity = 1 AND " .
            "pid = ? AND encounter = ?",
            array($encrow['pid'], $encrow['encounter'])
        );
        $prodrow = sqlQuery(
            "SELECT SUM(fee) AS charges FROM drug_sales WHERE " .
            "pid = ? AND encounter = ?",
            array($encrow['pid'], $encrow['encounter'])
        );
        $adjrow = sqlQuery(
            "SELECT SUM(adj_amount) AS adjustments FROM ar_activity WHERE " .
            "deleted IS NULL AND pid = ? AND encounter = ?",
            array($encrow['pid'], $encrow['encounter'])
        );
        $payrow = sqlQuery(
            "SELECT SUM(pay_amount) AS payments FROM ar_activity WHERE " .
            "deleted IS NULL AND pid = ? AND encounter = ? AND post_date <= ?",
            array($encrow['pid'], $encrow['encounter'], $ferow['svcdate'])
        );
        $balance = $chgrow['charges'] + $prodrow['charges'] - $adjrow['adjustments'] - $payrow['payments'];
        $balance = round($balance, $GLOBALS['currency_decimals']);

        // Set up data for reporting payments on and after the visit.
        // First, get the fund name for cash customers in this visit. This takes some work because it
        // can depend on the customer, service, product or facility. While fund is also computed when
        // charge items are reported, those will not be processed if the visit was not in the report's
        // date range.
        $query = "( " .
            "SELECT " .
            "b.chargecat AS payor, b.fee, c.related_code AS item_related_code " .
            "FROM billing AS b " .
            "JOIN code_types AS ct ON ct.ct_key = b.code_type " .
            "LEFT JOIN codes AS c ON c.code_type = ct.ct_id AND c.code = b.code AND c.modifier = b.modifier " .
            "WHERE b.pid = ? AND b.encounter = ? AND  b.code_type != 'COPAY' AND b.activity = 1 AND b.fee != 0 AND " .
            "(b.code_type != 'TAX' OR b.ndc_info = '') " .
            ") UNION ALL ( " .
            "SELECT " .
            "s.chargecat AS payor, s.fee, d.related_code AS item_related_code " .
            "FROM drug_sales AS s " .
            "LEFT JOIN drugs AS d ON d.drug_id = s.drug_id " .
            // 2018-06-28 CV says include all inventory items, not just those with a fee.
            "WHERE s.pid = ? AND s.encounter = ?" .
            ") " .
            "ORDER BY (payor = 'C00001' OR payor = '') DESC, fee DESC LIMIT 1";
        $tmprow = sqlQuery($query, array($encrow['pid'], $encrow['encounter'], $encrow['pid'], $encrow['encounter']));
        $item_related_code = empty($tmprow['item_related_code']) ? '' : $tmprow['item_related_code'];
        $dimarr = getDimensions($encrow['pid'], $encrow['encounter'], 'C00001', $item_related_code, $ferow['fac_related_code']);

        $paycounter = 1;
        $inv_display = $ferow['invoiceno'] ? $ferow['invoiceno'] : ($encrow['pid'] . '.' . $encrow['encounter']);
        $invnumber = "$inv_display-Pay" . sprintf('%02d', $paycounter);
        // These attributes are used for partial payments, and most also for post-visit payments:
        $outstuff = array(
            'ptenc'          => $encrow['pid'] . ',' . $encrow['encounter'],
            'service_date'   => $ferow['svcdate'],
            'payment_date'   => $ferow['svcdate'],
            'invoice'        => $invnumber,
            'item'           => 'Credit',
            'description'    => 'Partial Payment',
            'qty'            => 1,
            'each'           => $payrow['payments'], // was: $balance
            'tax'            => 0,
            'memo_header'    => '',
            'memo_column'    => "OpenEMR Inv " . $invnumber,
            'giftcard'       => '',
            'customer'       => 'CR0001',
            'customer_name'  => 'Credit',
            'payment_method' => 'Cash',
            'terms'          => '',
            'strategic_obj'  => '',
            'site'           => $ferow['facility_npi'],
            'project'        => '',
            'fund'           => $dimarr['fund_name'],
            'activity'       => '',
            'department'     => '',
        );

        // Write charge rows if the visit is in the date range.
        if ($ferow['svcdate'] >= $from_date && $ferow['svcdate'] <= $to_date) {
            $query = "( " .
                "SELECT " .
                "b.code_type, b.code AS itemcode, '' AS selector, b.code_text AS description, " .
                "'' AS ndc_number, b.units, b.fee, " .
                "l4.mapping AS terms, l4.title AS payor_name, c.related_code AS item_related_code, " .
                "b.chargecat AS payor " .
                "FROM billing AS b " .
                "JOIN code_types AS ct ON ct.ct_key = b.code_type " .
                "LEFT JOIN codes AS c ON c.code_type = ct.ct_id AND c.code = b.code AND c.modifier = b.modifier " .
                "LEFT JOIN list_options AS l4 ON l4.list_id = 'chargecats' AND l4.option_id = b.chargecat AND l4.activity = 1 " .
                "WHERE b.pid = ? AND b.encounter = ? AND  b.code_type != 'COPAY' AND b.activity = 1 AND b.fee != 0 AND " .
                "(b.code_type != 'TAX' OR b.ndc_info = '') " . // why the ndc_info test?
                ") UNION ALL ( " .
                "SELECT " .
                "'PROD' AS code_type, s.drug_id AS itemcode, s.selector, d.name AS description, " .
                "d.ndc_number, s.quantity AS units, s.fee, " .
                "l4.mapping AS terms, l4.title AS payor_name, d.related_code AS item_related_code, " .
                "s.chargecat AS payor " .
                "FROM drug_sales AS s " .
                "LEFT JOIN drugs AS d ON d.drug_id = s.drug_id " .
                "LEFT JOIN list_options AS l4 ON l4.list_id = 'chargecats' AND l4.option_id = s.chargecat AND l4.activity = 1 " .
                // 2018-06-28 CV says include all inventory items, not just those with a fee.
                "WHERE s.pid = ? AND s.encounter = ?" .
                ") ORDER BY code_type, itemcode, selector";

            $res = sqlStatement(
                $query,
                array($encrow['pid'], $encrow['encounter'], $encrow['pid'], $encrow['encounter'])
            );

            while ($row = sqlFetchArray($res)) {
                $payor = $row['payor'];
                $terms = ($payor && !empty($row['terms'])) ? $row['terms'] : '';
                $payor_name = ($payor && !empty($row['payor_name'])) ? $row['payor_name'] : '';

                if ($form_payor == 'c' && $payor != '') {
                    continue;
                }
                if ($form_payor == 'i' && $payor == '') {
                    continue;
                }

                $tmp = thisLineItem(
                    $encrow['pid'],
                    $encrow['encounter'],
                    $row['code_type'],
                    $row['itemcode'],
                    $row['selector'],
                    $row['description'],
                    $ferow['svcdate'],
                    $ferow['svcdate'],
                    $row['units'],
                    $row['fee'],
                    $ferow['invoiceno'],
                    $payor,
                    $ferow['facility_npi'],
                    $terms,
                    $row['item_related_code'],
                    $ferow['fac_related_code'],
                    $row['ndc_number'],
                    $payor_name,
                    $balance
                );
            }

            // Generate Partial Payment row if applicable.
            if ($balance != 0 && $payrow['payments']) {
                insertLineItem($outstuff);
                ++$paycounter;
            }
        } // End of things that happened on the visit date.

        // Generate another row for each payment in the date range and after the visit date.
        $pres = sqlStatement(
            "SELECT post_date, pay_amount FROM ar_activity WHERE " .
            "pid = ? AND encounter = ? AND deleted IS NULL AND pay_amount != 0.00 AND " .
            "post_date > ? AND post_date >= ? AND post_date <= ?" .
            "ORDER BY sequence_no",
            array($encrow['pid'], $encrow['encounter'], $ferow['svcdate'], $from_date, $to_date)
        );
        while ($prow = sqlFetchArray($pres)) {
            $out2 = $outstuff;
            $inv_display = $ferow['invoiceno'] ? $ferow['invoiceno'] : ($encrow['pid'] . '.' . $encrow['encounter']);
            $invnumber = "$inv_display-Pay" . sprintf('%02d', $paycounter);
            $out2['payment_date'] = $prow['post_date'];
            $out2['invoice'] = $invnumber;
            $out2['description'] = 'Previous Balance Repaid';
            $out2['each'] = $prow['pay_amount'];
            $out2['memo_header'] = "OpenEMR Inv " . $invnumber;
            $out2['memo_column'] = "OpenEMR Inv " . $invnumber;
            insertLineItem($out2);
            ++$paycounter;
        }
    } // End of visits.

    writeLineItems();

} // end refresh or export

if (empty($_POST['form_csvexport'])) {
?>

</tbody>
</table>
<input type="hidden" name="form_orderby" value="<?php echo $form_orderby ?>" />
</form>
</center>
</body>
</html>
<?php
} // End not csv export
