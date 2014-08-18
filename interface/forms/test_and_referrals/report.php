<?php
//------------Forms generated from formsWiz
// This Report.form is what shows on the main encounter
// screen.
include_once("../../globals.php");
include_once($GLOBALS["srcdir"]."/api.inc");
function test_and_referrals_report( $pid, $encounter, $cols, $id) {
   $count = 0;
   $data = formFetch("test_and_referrals", $id);
   if ($data) {
     print "<table><tr>";
     foreach($data as $key => $value) {
       if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "date" || $value == "" || $value == "0000-00-00 00:00:00") {
	      continue;
       }
       if ($value == "on") {
          $value = "yes";
       }
       $key=ucwords(str_replace("_"," ",$key));
       print "<td><span class=bold>$key: </span><span class=text>$value</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
       $count++;
       if ($count == $cols) {
         $count = 0;
         print "</tr><tr>\n";
       }
     }
    }
    print "</tr></table>";
}
?> 
