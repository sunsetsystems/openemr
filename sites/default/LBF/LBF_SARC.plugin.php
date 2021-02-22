<?php
// Copyright (C) 2019 Rod Roark <rod@sunsetsystems.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

// This provides enhancement functions for the LBF_SARC visit form.
// It is invoked by interface/forms/LBF/new.php.

require("LBFcontra.common.inc.php");

// The purpose of this function is to create JavaScript for the <head>
// section of the page.  This defines desired javaScript functions.
//
function LBF_SARC_javascript() {
  LBFcontra_common_javascript();
}

// The purpose of this function is to create JavaScript that is run
// once when the page is loaded.
//
function LBF_SARC_javascript_onload() {
  LBFcontra_common_javascript_onload();
}

// This function generates HTML to go after the Save button.
//
function LBF_SARC_additional_buttons() {
  LBFcontra_common_additional_buttons();
}

// Custom logic to run at end of save handler.
//
function LBF_SARC_save_exit() {
  return LBFcontra_common_save_exit();
}

// PHP end tag omitted.
