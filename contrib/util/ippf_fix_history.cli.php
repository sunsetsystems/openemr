<?php
/**
* CLI script to fix history_data where the last entries for a patient have duplicate timestamps
* and are missing data due to a bug in patient.inc.
* This only happened when a LBF had more than 2 fields with Source = History.
*
* Copyright (C) 2019 Rod Roark <rod@sunsetsystems.com>
*
* LICENSE: This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://opensource.org/licenses/gpl-license.php>.
*
* @package   OpenEMR
* @author    Rod Roark <rod@sunsetsystems.com>
*/

function sqlExec($link, $query) {
  if (!mysqli_query($link, $query)) die("Query failed: $query\n");
  return true;
}

function sqlSelect($link, $query) {
    $res = mysqli_query($link, $query);
    if (!$res) {
        die("Query failed: $query\n");
    }
    return $res;
}

function sqlSelectOne($link, $query) {
    $res = sqlSelect($link, $query);
    $row = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    return $row;
}

// Dummy translation function so included things will work.
function xl($s) {
    return $s;
}

$sfname = $argv[1];
if (empty($sfname)) {
    die("You must have a command line argument for the OpenEMR subdirectory name.");
}

// Assuming this script is in the parent of the OpenEMR directories.
$base_directory = dirname(__FILE__);
if (stripos(PHP_OS,'WIN') === 0) {
    $base_directory = str_replace("\\","/",$base_directory);
}

// $confname = "$base_directory/$sfname/sites/default/sqlconf.php";
$confname = "$sfname/sites/default/sqlconf.php";
if (!is_file($confname)) {
    die("File not found: " . $confname);
}

$link = false;
include($confname);
$link = mysqli_connect($host, $login, $pass, $dbase, $port);
if (empty($link)) {
    die("Failed to open database '$dbase'");
}

sqlExec($link, "SET sql_mode = ''");

// Identify patients whose most recent history is from a LBF visit form that saved 3 or more
// History data items. These need fixing because their items were saved as separate rows, and
// due to a recently-fixed bug the 3rd and beyond will not include the changes from the 2nd and
// beyond. Older row groups with duplicated timestamps are also wrong but not fixable.

$query1 = "select h.pid, h.date from history_data as h where " .
    "h.date = (select max(h1.date) from history_data as h1 where h1.pid = h.pid) and " .
    "(select count(h2.id) from history_data as h2 where h2.pid = h.pid and h2.date = h.date) > 2 " .
    "group by h.pid, h.date order by h.pid, h.date;";

$res1 = sqlSelect($link, $query1);
while ($row1 = mysqli_fetch_assoc($res1)) {
    $pid  = $row1['pid'];
    $date = $row1['date'];
    $query2 = "select * from history_data where pid = '$pid' and date = '$date' order by id";
    $dirtycols = array();

    $res2 = sqlSelect($link, $query2);
    $lastrow = mysqli_fetch_assoc($res2);
    while ($row2 = mysqli_fetch_assoc($res2)) {
        foreach ($row2 as $key => $value) {
            if ($key == 'id' || $key == 'date') {
                continue;
            }
            if (!array_key_exists($key, $dirtycols) && $value !== $lastrow[$key]) {
                $dirtycols[$key] = $value;
            }
        }
        $lastrow = $row2;
        foreach ($dirtycols as $key => $value) {
            $lastrow[$key] = $value;
        }
    }
    mysqli_free_result($res2);

    $tmp = sqlSelectOne($link, "SELECT NOW() AS rightnow");
    $date = $tmp['rightnow'];
    $query3 = "INSERT INTO history_data SET `date` = '$date'";
    foreach ($lastrow as $key => $value) {
        if ($key == 'id' || $key == 'date') {
            continue;
        }
        $val = is_null($value) ? "NULL" : ("'" . mysqli_real_escape_string($link, $value) . "'");
        $query3 .= ", `$key` = $val";
    }

    // echo "$query3;\n\n";
    sqlExec($link, $query3);

    if (!empty($dirtycols)) {
        foreach ($dirtycols as $key => $value) {
            echo "For pid $pid at $date $key is set to '$value'\n";
        }
        echo "\n";
    }
}
mysqli_free_result($res1);
