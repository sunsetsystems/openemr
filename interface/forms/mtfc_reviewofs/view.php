<!-- Forms generated from formsWiz -->
<?php
include_once("../../globals.php");
?>
<html><head>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<?php
include_once("$srcdir/api.inc");
$obj = formFetch("form_mtfc_reviewofs", $_GET["id"]);
?>
<form method=post action="<?echo $rootdir?>/forms/mtfc_reviewofs/save.php?mode=update&id=<?echo $_GET["id"];?>" name="my_form">
<span class="title">Review of System Checks</span><Br><br>

<table><tr><td valign=top>

<span class=bold>GN:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>
<!-- dont' need
<input type=checkbox name="fever"  <?if ($obj{"fever"} == "on") {echo "checked";};?>><span class=text>Fever</span><br>
-->
<? 
  if ($obj{"fever"} == "na")
  { ?>
    <input type="radio" name='fever' value='na' checked>
    <input type="radio" name='fever' value='pos'>
    <input type="radio" name='fever' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Fever</span><br>
<? } else if ($obj{"fever"} == "pos") { ?>
    <input type="radio" name='fever' value='na'>
    <input type="radio" name='fever' value='pos' checked>
    <input type="radio" name='fever' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Fever</span><br>
<? } else { ?>
	<input type="radio" name='fever' value='na'>
	<input type="radio" name='fever' value='pos'>
	<input type="radio" name='fever' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Fever</span><br>
<? }
   
   if ($obj{"night_sweats"} == "na")
   { ?>
     <input type="radio" name='night_sweats' value='na' checked>
     <input type="radio" name='night_sweats' value='pos'>
     <input type="radio" name='night_sweats' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>N. Sweats</span><br>
<? } else if ($obj{"night_sweats"} == "pos") { ?>
     <input type="radio" name='night_sweats' value='na'>
     <input type="radio" name='night_sweats' value='pos' checked>
     <input type="radio" name='night_sweats' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>N. Sweats</span><br>
<? } else { ?>
     <input type="radio" name='night_sweats' value='na'>
     <input type="radio" name='night_sweats' value='pos'>
     <input type="radio" name='night_sweats' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>N. Sweats</span><br>
<? } 

   if ($obj{"weight_change"} == "na")
   { ?>
     <input type="radio" name='weight_change' value='na' checked>
     <input type="radio" name='weight_change' value='pos'>
     <input type="radio" name='weight_change' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Wt.Change</span><br>
<? } else if ($obj{"weight_change"} == "pos") { ?>
     <input type="radio" name='weight_change' value='na'>
     <input type="radio" name='weight_change' value='pos' checked>
     <input type="radio" name='weight_change' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Wt.Change</span><br>
<? } else { ?>
     <input type="radio" name='weight_change' value='na'>
     <input type="radio" name='weight_change' value='pos'>
     <input type="radio" name='weight_change' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Wt.Change</span><br>
<? }

   if ($obj{"fatigue"} == "na")
   { ?>
     <input type="radio" name='fatigue' value='na' checked>
     <input type="radio" name='fatigue' value='pos'>
     <input type="radio" name='fatigue' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Fatigue</span><br>
<? } else if ($obj{"fatigue"} == "pos") { ?>
     <input type="radio" name='fatigue' value='na'>
     <input type="radio" name='fatigue' value='pos' checked>
     <input type="radio" name='fatigue' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Fatigue</span><br>
<? } else { ?>
     <input type="radio" name='fatigue' value='na'>
     <input type="radio" name='fatigue' value='pos'>
     <input type="radio" name='fatigue' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Fatigue</span><br>
<? }


   if ($obj{"appetite_change"} == "na")
   { ?>
      <input type="radio" name='appetite_change' value='na' checked>
      <input type="radio" name='appetite_change' value='pos'>
      <input type="radio" name='appetite_change' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Appetite</span><br>
<? } else if ($obj{"appetite_change"} == "pos") { ?>
     <input type="radio" name='appetite_change' value='na'>
     <input type="radio" name='appetite_change' value='pos' checked>
     <input type="radio" name='appetite_change' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Appetite</span><br>
<? } else { ?>
      <input type="radio" name='appetite_change' value='na'>
      <input type="radio" name='appetite_change' value='pos'>
      <input type="radio" name='appetite_change' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Appetite</span><br>
<? }


   if ($obj{"irritable"} == "na")
   { ?>
      <input type="radio" name='irritable' value='na' checked>
      <input type="radio" name='irritable' value='pos'>
      <input type="radio" name='irritable' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Irritable</span><br>
<? } else if ($obj{"irritable"} == "pos") { ?>
     <input type="radio" name='irritable' value='na'>
     <input type="radio" name='irritable' value='pos' checked>
     <input type="radio" name='irritable' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Irritable</span><br>
<? } else { ?>
      <input type="radio" name='irritable' value='na'>
      <input type="radio" name='irritable' value='pos'>
      <input type="radio" name='irritable' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Irritable</span><br>      
<?  } ?>
       <br>
<span class=bold>ENT:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?  if ($obj{"earache"} == "na")
    { ?>
      <input type="radio" name='earache' value='na' checked>
      <input type="radio" name='earache' value='pos'>
      <input type="radio" name='earache' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ear ache</span><br>
<? } else if ($obj{"earache"} == "pos") { ?>
       <input type="radio" name='earache' value='na'>
       <input type="radio" name='earache' value='pos' checked>
       <input type="radio" name='earache' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Ear ache</span><br>
<?  } else { ?>
      <input type="radio" name='earache' value='na'>
      <input type="radio" name='earache' value='pos'>
      <input type="radio" name='earache' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Ear ache</span><br>
<?  }

    if ($obj{"change_in_hearing"} == "na")
    { ?>
       <input type="radio" name='change_in_hearing' value='na' checked >
       <input type="radio" name='change_in_hearing' value='pos'>
       <input type="radio" name='change_in_hearing' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hearing Loss</span><br>
<? } else if ($obj{"change_in_hearing"} == "pos") { ?>
       <input type="radio" name='change_in_hearing' value='na'>
       <input type="radio" name='change_in_hearing' value='pos' checked>
       <input type="radio" name='change_in_hearing' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Hearing Loss</span><br>
<? } else { ?>
       <input type="radio" name='change_in_hearing' value='na'>
       <input type="radio" name='change_in_hearing' value='pos'>
       <input type="radio" name='change_in_hearing' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Hearing Loss</span><br>
<? }


    if ($obj{"rhinorrhea"} == "na")
    { ?>
       <input type="radio" name='rhinorrhea' value='na' checked>
       <input type="radio" name='rhinorrhea' value='pos'>
       <input type="radio" name='rhinorrhea' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Rhinorrhea</span><br>
<? } else if ($obj{"rhinorrhea"} == "pos") { ?>
       <input type="radio" name='rhinorrhea' value='na'>
       <input type="radio" name='rhinorrhea' value='pos' checked>
       <input type="radio" name='rhinorrhea' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Rhinorrhea</span><br>
<?  } else { ?>
       <input type="radio" name='rhinorrhea' value='na'>
       <input type="radio" name='rhinorrhea' value='pos'>
       <input type="radio" name='rhinorrhea' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Rhinorrhea</span><br>
<?  }

    
    if ($obj{"sneezing"} == "na")
    { ?>
       <input type="radio" name='sneezing' value='na' checked>
       <input type="radio" name='sneezing' value='pos'>
       <input type="radio" name='sneezing' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Sneezing</span><br>
<? } else if ($obj{"sneezing"} == "pos") { ?>
       <input type="radio" name='sneezing' value='na'>
       <input type="radio" name='sneezing' value='pos' checked>
       <input type="radio" name='sneezing' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Sneezing</span><br>
<?  } else { ?>
       <input type="radio" name='sneezing' value='na'>
       <input type="radio" name='sneezing' value='pos'>
       <input type="radio" name='sneezing' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Sneezing</span><br>
<?  }


    if ($obj{"facial_pain"} == "na")
    { ?>
       <input type="radio" name='facial_pain' value='na' checked>
       <input type="radio" name='facial_pain' value='pos'>
       <input type="radio" name='facial_pain' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Facial Pain</span><br>
<? } else if ($obj{"facial_pain"} == "pos") { ?>
       <input type="radio" name='facial_pain' value='na'>
       <input type="radio" name='facial_pain' value='pos' checked>
       <input type="radio" name='facial_pain' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Facial Pain</span><br>
<?  } else { ?>
       <input type="radio" name='facial_pain' value='na'>
       <input type="radio" name='facial_pain' value='pos'>
       <input type="radio" name='facial_pain' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Facial Pain</span><br>
<?  }


    if ($obj{"sore_throat"} == "na")
    { ?>
       <input type="radio" name='sore_throat' value='na' checked>
       <input type="radio" name='sore_throat' value='pos'>
       <input type="radio" name='sore_throat' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Sore Throat</span><br>
<? } else if ($obj{"sore_throat"} == "pos") { ?>
       <input type="radio" name='sore_throat' value='na'>
       <input type="radio" name='sore_throat' value='pos' checked>
       <input type="radio" name='sore_throat' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Sore Throat</span><br>
<?  } else { ?>
       <input type="radio" name='sore_throat' value='na'>
       <input type="radio" name='sore_throat' value='pos'>
       <input type="radio" name='sore_throat' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Sore Throat</span><br>
<?  }

    if ($obj{"epistaxis"} == "na")
    { ?>
       <input type="radio" name='epistaxis' value='na' checked>
       <input type="radio" name='epistaxis' value='pos'>
       <input type="radio" name='epistaxis' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Epistaxis</span><br>
<? } else if ($obj{"epistaxis"} == "pos") { ?>
       <input type="radio" name='epistaxis' value='na'>
       <input type="radio" name='epistaxis' value='pos' checked>
       <input type="radio" name='epistaxis' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Epistaxis</span><br>
<?  } else { ?>
       <input type="radio" name='epistaxis' value='na'>
       <input type="radio" name='epistaxis' value='pos'>
       <input type="radio" name='epistaxis' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Epistaxis</span><br>
<?  }
?>

</td><td valign=top>

<span class=bold>CV:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?
    if ($obj{"cp_palp"} == "na")
    { ?>
       <input type="radio" name='cp_palp' value='na' checked>
       <input type="radio" name='cp_palp' value='pos'>
       <input type="radio" name='cp_palp' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>CP/PALP</span><br>
<? } else if ($obj{"cp_palp"} == "pos") { ?>
       <input type="radio" name='cp_palp' value='na'>
       <input type="radio" name='cp_palp' value='pos' checked>
       <input type="radio" name='cp_palp' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>CP/PALP</span><br>
<?  } else { ?>
       <input type="radio" name='cp_palp' value='na'>
       <input type="radio" name='cp_palp' value='pos'>
       <input type="radio" name='cp_palp' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>CP/PALP</span><br>
<?  }


    if ($obj{"doe_pnd"} == "na")
    { ?>
       <input type="radio" name='doe_pnd' value='na' checked>
       <input type="radio" name='doe_pnd' value='pos'>
       <input type="radio" name='doe_pnd' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>DOE/PND</span><br>
<? } else if ($obj{"doe_pnd"} == "pos") { ?>
       <input type="radio" name='doe_pnd' value='na'>
       <input type="radio" name='doe_pnd' value='pos' checked>
       <input type="radio" name='doe_pnd' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>DOE/PND</span><br>
<?  } else { ?>
       <input type="radio" name='doe_pnd' value='na'>
       <input type="radio" name='doe_pnd' value='pos'>
       <input type="radio" name='doe_pnd' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>DOE/PND</span><br>
<?  }


    if ($obj{"orthophea"} == "na")
    { ?>
       <input type="radio" name='orthophea' value='na' checked>
       <input type="radio" name='orthophea' value='pos'>
       <input type="radio" name='orthophea' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Orthopnea</span><br>
<? } else if ($obj{"orthophea"} == "pos") { ?>
       <input type="radio" name='orthophea' value='na'>
       <input type="radio" name='orthophea' value='pos' checked>
       <input type="radio" name='orthophea' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Orthopnea</span><br>
<?  } else { ?>
       <input type="radio" name='orthophea' value='na'>
       <input type="radio" name='orthophea' value='pos'>
       <input type="radio" name='orthophea' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Orthopnea</span><br>
<?  }


    if ($obj{"syncope_or_nearsyncope"} == "na")
    { ?>
       <input type="radio" name='syncope_or_nearsyncope' value='na' checked>
       <input type="radio" name='syncope_or_nearsyncope' value='pos'>
       <input type="radio" name='syncope_or_nearsyncope' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Syncope</span><br>
<? } else if ($obj{"syncope_or_nearsyncope"} == "pos") { ?>
       <input type="radio" name='syncope_or_nearsyncope' value='na'>
       <input type="radio" name='syncope_or_nearsyncope' value='pos' checked>
       <input type="radio" name='syncope_or_nearsyncope' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Syncope</span><br>
<?  } else { ?>
       <input type="radio" name='syncope_or_nearsyncope' value='na'>
       <input type="radio" name='syncope_or_nearsyncope' value='pos'>
       <input type="radio" name='syncope_or_nearsyncope' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Syncope</span><br>
<?  }


    if ($obj{"edema"} == "na")
    { ?>
       <input type="radio" name='edema' value='na' checked>
       <input type="radio" name='edema' value='pos'>
       <input type="radio" name='edema' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Edema</span><br>
<? } else if ($obj{"edema"} == "pos") { ?>
       <input type="radio" name='edema' value='na'>
       <input type="radio" name='edema' value='pos' checked>
       <input type="radio" name='edema' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Edema</span><br>
<?  } else { ?>
       <input type="radio" name='edema' value='na'>
       <input type="radio" name='edema' value='pos'>
       <input type="radio" name='edema' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Edema</span><br>
<?  }


    if ($obj{"change_in_bp"} == "na")
    { ?>
       <input type="radio" name='change_in_bp' value='na' checked>
       <input type="radio" name='change_in_bp' value='pos'>
       <input type="radio" name='change_in_bp' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in BP</span><br>
<? } else if ($obj{"change_in_bp"} == "pos") { ?>
       <input type="radio" name='change_in_bp' value='na'>
       <input type="radio" name='change_in_bp' value='pos' checked>
       <input type="radio" name='change_in_bp' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Ch. in BP</span><br>
<?  } else { ?>
       <input type="radio" name='change_in_bp' value='na'>
       <input type="radio" name='change_in_bp' value='pos'>
       <input type="radio" name='change_in_bp' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in BP</span><br>
<?  }

 ?>
<br><span class=bold>ENDO:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?
    if ($obj{"polyuria"} == "na")
    { ?>
       <input type="radio" name='polyuria' value='na' checked>
       <input type="radio" name='polyuria' value='pos'>
       <input type="radio" name='polyuria' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Urination</span><br>
<? } else if ($obj{"polyuria"} == "pos") { ?>
       <input type="radio" name='polyuria' value='na'>
       <input type="radio" name='polyuria' value='pos' checked>
       <input type="radio" name='polyuria' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Urination</span><br>
<?  } else { ?>
       <input type="radio" name='polyuria' value='na'>
       <input type="radio" name='polyuria' value='pos'>
       <input type="radio" name='polyuria' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Urination</span><br>
<?  }

    if ($obj{"polydipsia"} == "na")
    { ?>
       <input type="radio" name='polydipsia' value='na' checked>
       <input type="radio" name='polydipsia' value='pos'>
       <input type="radio" name='polydipsia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Thirst</span><br>
<? } else if ($obj{"polydipsia"} == "pos") { ?>
       <input type="radio" name='polydipsia' value='na'>
       <input type="radio" name='polydipsia' value='pos' checked>
       <input type="radio" name='polydipsia' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Thirst</span><br>
<?  } else { ?>
       <input type="radio" name='polydipsia' value='na'>
       <input type="radio" name='polydipsia' value='pos'>
       <input type="radio" name='polydipsia' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Thirst</span><br>
<?  }

    if ($obj{"incr_in_hunger"} == "na")
    { ?>
       <input type="radio" name='incr_in_hunger' value='na' checked>
       <input type="radio" name='incr_in_hunger' value='pos'>
       <input type="radio" name='incr_in_hunger' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Hunger</span><br>
<? } else if ($obj{"incr_in_hunger"} == "pos") { ?>
       <input type="radio" name='incr_in_hunger' value='na'>
       <input type="radio" name='incr_in_hunger' value='pos' checked>
       <input type="radio" name='incr_in_hunger' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Hunger</span><br>
<?  } else { ?>
       <input type="radio" name='incr_in_hunger' value='na'>
       <input type="radio" name='incr_in_hunger' value='pos'>
       <input type="radio" name='incr_in_hunger' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Hunger</span><br>
<?  }

    if ($obj{"tremulousness"} == "na")
    { ?>
       <input type="radio" name='tremulousness' value='na' checked>
       <input type="radio" name='tremulousness' value='pos'>
       <input type="radio" name='tremulousness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Tremulousness</span><br>
<? } else if ($obj{"tremulousness"} == "pos") { ?>
       <input type="radio" name='tremulousness' value='na'>
       <input type="radio" name='tremulousness' value='pos' checked>
       <input type="radio" name='tremulousness' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Tremulousness</span><br>
<?  } else { ?>
       <input type="radio" name='tremulousness' value='na'>
       <input type="radio" name='tremulousness' value='pos'>
       <input type="radio" name='tremulousness' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Tremulousness</span><br>
<?  }

    if ($obj{"hair_loss"} == "na")
    { ?>
       <input type="radio" name='hair_loss' value='na' checked>
       <input type="radio" name='hair_loss' value='pos'>
       <input type="radio" name='hair_loss' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hair Loss</span><br>
<? } else if ($obj{"hair_loss"} == "pos") { ?>
       <input type="radio" name='hair_loss' value='na'>
       <input type="radio" name='hair_loss' value='pos' checked>
       <input type="radio" name='hair_loss' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Hair Loss</span><br>
<?  } else { ?>
       <input type="radio" name='hair_loss' value='na'>
       <input type="radio" name='hair_loss' value='pos'>
       <input type="radio" name='hair_loss' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Hair Loss</span><br>
<?  }

    if ($obj{"skin_changes"} == "na")
    { ?>
       <input type="radio" name='skin_changes' value='na' checked>
       <input type="radio" name='skin_changes' value='pos'>
       <input type="radio" name='skin_changes' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Skin Changes</span><br>
<? } else if ($obj{"skin_changes"} == "pos") { ?>
       <input type="radio" name='skin_changes' value='na'>
       <input type="radio" name='skin_changes' value='pos' checked>
       <input type="radio" name='skin_changes' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Skin Changes</span><br>
<?  } else { ?>
       <input type="radio" name='skin_changes' value='na'>
       <input type="radio" name='skin_changes' value='pos'>
       <input type="radio" name='skin_changes' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Skin Changes</span><br>
<?  }
?>

</td><td valign=top>

<span class=bold>RESP:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?
    if ($obj{"cough"} == "na")
    { ?>
       <input type="radio" name='cough' value='na' checked>
       <input type="radio" name='cough' value='pos'>
       <input type="radio" name='cough' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Cough</span><br>
<? } else if ($obj{"cough"} == "pos") { ?>
       <input type="radio" name='cough' value='na'>
       <input type="radio" name='cough' value='pos' checked>
       <input type="radio" name='cough' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Cough</span><br>
<?  } else { ?>
       <input type="radio" name='cough' value='na'>
       <input type="radio" name='cough' value='pos'>
       <input type="radio" name='cough' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Cough</span><br>
<?  }

    if ($obj{"wheezing"} == "na")
    { ?>
       <input type="radio" name='wheezing' value='na' checked>
       <input type="radio" name='wheezing' value='pos'>
       <input type="radio" name='wheezing' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Wheeze</span><br>
<? } else if ($obj{"wheezing"} == "pos") { ?>
       <input type="radio" name='wheezing' value='na'>
       <input type="radio" name='wheezing' value='pos' checked>
       <input type="radio" name='wheezing' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Wheeze</span><br>
<?  } else { ?>
       <input type="radio" name='wheezing' value='na'>
       <input type="radio" name='wheezing' value='pos'>
       <input type="radio" name='wheezing' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Wheeze</span><br>
<?  }

    if ($obj{"shortness_of_breath_2"} == "na")
    { ?>
       <input type="radio" name='shortness_of_breath_2' value='na' checked>
       <input type="radio" name='shortness_of_breath_2' value='pos'>
       <input type="radio" name='shortness_of_breath_2' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>SOB</span><br>
<? } else if ($obj{"shortness_of_breath_2"} == "pos") { ?>
       <input type="radio" name='shortness_of_breath_2' value='na'>
       <input type="radio" name='shortness_of_breath_2' value='pos' checked>
       <input type="radio" name='shortness_of_breath_2' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>SOB</span><br>
<?  } else { ?>
       <input type="radio" name='shortness_of_breath_2' value='na'>
       <input type="radio" name='shortness_of_breath_2' value='pos'>
       <input type="radio" name='shortness_of_breath_2' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>SOB</span><br>
<?  }
 ?>

<br><br><br><br><span class=bold>PSYCH:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?  
    if ($obj{"anxiety"} == "na")
    { ?>
       <input type="radio" name='anxiety' value='na' checked>
       <input type="radio" name='anxiety' value='pos'>
       <input type="radio" name='anxiety' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Anxiety</span><br>
<? } else if ($obj{"anxiety"} == "pos") { ?>
       <input type="radio" name='anxiety' value='na'>
       <input type="radio" name='anxiety' value='pos' checked>
       <input type="radio" name='anxiety' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Anxiety</span><br>
<?  } else { ?>
       <input type="radio" name='anxiety' value='na'>
       <input type="radio" name='anxiety' value='pos'>
       <input type="radio" name='anxiety' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Anxiety</span><br>
<?  }


    if ($obj{"depressed"} == "na")
    { ?>
       <input type="radio" name='depressed' value='na' checked>
       <input type="radio" name='depressed' value='pos'>
       <input type="radio" name='depressed' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Depression</span><br>
<? } else if ($obj{"depressed"} == "pos") { ?>
       <input type="radio" name='depressed' value='na'>
       <input type="radio" name='depressed' value='pos' checked>
       <input type="radio" name='depressed' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Depression</span><br>
<?  } else { ?>
       <input type="radio" name='depressed' value='na'>
       <input type="radio" name='depressed' value='pos'>
       <input type="radio" name='depressed' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Depression</span><br>
<?  }

    if ($obj{"insomnia"} == "na")
    { ?>
       <input type="radio" name='insomnia' value='na' checked>
       <input type="radio" name='insomnia' value='pos'>
       <input type="radio" name='insomnia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Insomnia</span><br>
<? } else if ($obj{"insomnia"} == "pos") { ?>
       <input type="radio" name='insomnia' value='na'>
       <input type="radio" name='insomnia' value='pos' checked>
       <input type="radio" name='insomnia' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Insomnia</span><br>
<?  } else { ?>
       <input type="radio" name='insomnia' value='na'>
       <input type="radio" name='insomnia' value='pos'>
       <input type="radio" name='insomnia' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Insomnia</span><br>
<?  }

    if ($obj{"adhd"} == "na")
    { ?>
       <input type="radio" name='adhd' value='na' checked>
       <input type="radio" name='adhd' value='pos'>
       <input type="radio" name='adhd' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>ADHD</span><br>
<? } else if ($obj{"adhd"} == "pos") { ?>
       <input type="radio" name='adhd' value='na'>
       <input type="radio" name='adhd' value='pos' checked>
       <input type="radio" name='adhd' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>ADHD</span><br>
<?  } else { ?>
       <input type="radio" name='adhd' value='na'>
       <input type="radio" name='adhd' value='pos'>
       <input type="radio" name='adhd' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>ADHD</span><br>
<?  }

    if ($obj{"add_info"} == "na")
    { ?>
       <input type="radio" name='add_info' value='na' checked>
       <input type="radio" name='add_info' value='pos'>
       <input type="radio" name='add_info' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>ADD</span><br>
<? } else if ($obj{"add_info"} == "pos") { ?>
       <input type="radio" name='add_info' value='na'>
       <input type="radio" name='add_info' value='pos' checked>
       <input type="radio" name='add_info' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>ADD</span><br>
<?  } else { ?>
       <input type="radio" name='add_info' value='na'>
       <input type="radio" name='add_info' value='pos'>
       <input type="radio" name='add_info' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>ADD</span><br>
<?  }

    if ($obj{"bipolar"} == "na")
    { ?>
       <input type="radio" name='bipolar' value='na' checked>
       <input type="radio" name='bipolar' value='pos'>
       <input type="radio" name='bipolar' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Bipolar</span><br>
<? } else if ($obj{"bipolar"} == "pos") { ?>
       <input type="radio" name='bipolar' value='na'>
       <input type="radio" name='bipolar' value='pos' checked>
       <input type="radio" name='bipolar' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Bipolar</span><br>
<?  } else { ?>
       <input type="radio" name='bipolar' value='na'>
       <input type="radio" name='bipolar' value='pos'>
       <input type="radio" name='bipolar' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Bipolar</span><br>
<?  }
?>


</td><td valign=top>

<span class=bold>GI:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<? 

    if ($obj{"nvd"} == "na")
    { ?>
       <input type="radio" name='nvd' value='na' checked>
       <input type="radio" name='nvd' value='pos'>
       <input type="radio" name='nvd' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>N - V - D</span><br>
<? } else if ($obj{"nvd"} == "pos") { ?>
       <input type="radio" name='nvd' value='na'>
       <input type="radio" name='nvd' value='pos' checked>
       <input type="radio" name='nvd' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>N - V - D</span><br>
<?  } else { ?>
       <input type="radio" name='nvd' value='na'>
       <input type="radio" name='nvd' value='pos'>
       <input type="radio" name='nvd' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>N - V - D</span><br>
<?  }

    if ($obj{"dysphagia"} == "na")
    { ?>
       <input type="radio" name='dysphagia' value='na' checked>
       <input type="radio" name='dysphagia' value='pos'>
       <input type="radio" name='dysphagia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Dysphagia</span><br>
<? } else if ($obj{"dysphagia"} == "pos") { ?>
       <input type="radio" name='dysphagia' value='na'>
       <input type="radio" name='dysphagia' value='pos' checked>
       <input type="radio" name='dysphagia' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Dysphagia</span><br>
<?  } else { ?>
       <input type="radio" name='dysphagia' value='na'>
       <input type="radio" name='dysphagia' value='pos'>
       <input type="radio" name='dysphagia' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Dysphagia</span><br>
<?  }

    if ($obj{"other_change_in_bowel_habits"} == "na")
    { ?>
       <input type="radio" name='other_change_in_bowel_habits' value='na' checked>
       <input type="radio" name='other_change_in_bowel_habits' value='pos'>
       <input type="radio" name='other_change_in_bowel_habits' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Bowel Habits Ch.</span><br>
<? } else if ($obj{"other_change_in_bowel_habits"} == "pos") { ?>
       <input type="radio" name='other_change_in_bowel_habits' value='na'>
       <input type="radio" name='other_change_in_bowel_habits' value='pos' checked>
       <input type="radio" name='other_change_in_bowel_habits' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Bowel Habits Ch.</span><br>
<?  } else { ?>
       <input type="radio" name='other_change_in_bowel_habits' value='na'>
       <input type="radio" name='other_change_in_bowel_habits' value='pos'>
       <input type="radio" name='other_change_in_bowel_habits' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Bowel Habits Ch.</span><br>
<?  }

    if ($obj{"heartburn"} == "na")
    { ?>
       <input type="radio" name='heartburn' value='na' checked>
       <input type="radio" name='heartburn' value='pos'>
       <input type="radio" name='heartburn' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Heartburn</span><br>
<? } else if ($obj{"heartburn"} == "pos") { ?>
       <input type="radio" name='heartburn' value='na'>
       <input type="radio" name='heartburn' value='pos' checked>
       <input type="radio" name='heartburn' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Heartburn</span><br>
<?  } else { ?>
       <input type="radio" name='heartburn' value='na'>
       <input type="radio" name='heartburn' value='pos'>
       <input type="radio" name='heartburn' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Heartburn</span><br>
<?  }

    if ($obj{"abdominal_pain"} == "na")
    { ?>
       <input type="radio" name='abdominal_pain' value='na' checked>
       <input type="radio" name='abdominal_pain' value='pos'>
       <input type="radio" name='abdominal_pain' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Abd.Pain</span><br>
<? } else if ($obj{"abdominal_pain"} == "pos") { ?>
       <input type="radio" name='abdominal_pain' value='na'>
       <input type="radio" name='abdominal_pain' value='pos' checked>
       <input type="radio" name='abdominal_pain' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Abd.Pain</span><br>
<?  } else { ?>
       <input type="radio" name='abdominal_pain' value='na'>
       <input type="radio" name='abdominal_pain' value='pos'>
       <input type="radio" name='abdominal_pain' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Abd.Pain</span><br>
<?  }

    if ($obj{"melena"} == "na")
    { ?>
       <input type="radio" name='melena' value='na' checked>
       <input type="radio" name='melena' value='pos'>
       <input type="radio" name='melena' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Melena</span><br>
<? } else if ($obj{"melena"} == "pos") { ?>
       <input type="radio" name='melena' value='na'>
       <input type="radio" name='melena' value='pos' checked>
       <input type="radio" name='melena' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Melena</span><br>
<?  } else { ?>
       <input type="radio" name='melena' value='na'>
       <input type="radio" name='melena' value='pos'>
       <input type="radio" name='melena' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Melena</span><br>
<?  }

    if ($obj{"hemato_chezia"} == "na")
    { ?>
       <input type="radio" name='hemato_chezia' value='na' checked>
       <input type="radio" name='hemato_chezia' value='pos'>
       <input type="radio" name='hemato_chezia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hematochezia</span><br>
<? } else if ($obj{"hemato_chezia"} == "pos") { ?>
       <input type="radio" name='hemato_chezia' value='na'>
       <input type="radio" name='hemato_chezia' value='pos' checked>
       <input type="radio" name='hemato_chezia' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Hematochezia</span><br>
<?  } else { ?>
       <input type="radio" name='hemato_chezia' value='na'>
       <input type="radio" name='hemato_chezia' value='pos'>
       <input type="radio" name='hemato_chezia' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Hematochezia</span><br>
<?  }
?>
        

<br><span class=bold>GYN:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<? 

    if ($obj{"change_in_menses"} == "na")
    { ?>
       <input type="radio" name='change_in_menses' value='na' checked>
       <input type="radio" name='change_in_menses' value='pos'>
       <input type="radio" name='change_in_menses' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Menses</span><br>
<? } else if ($obj{"change_in_menses"} == "pos") { ?>
       <input type="radio" name='change_in_menses' value='na'>
       <input type="radio" name='change_in_menses' value='pos' checked>
       <input type="radio" name='change_in_menses' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Menses</span><br>
<?  } else { ?>
       <input type="radio" name='change_in_menses' value='na'>
       <input type="radio" name='change_in_menses' value='pos'>
       <input type="radio" name='change_in_menses' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Menses</span><br>
<?  }

	if ($obj{"discharge_from_urethra"} == "na")
    { ?>
       <input type="radio" name='discharge_from_urethra' value='na' checked>
       <input type="radio" name='discharge_from_urethra' value='pos'>
       <input type="radio" name='discharge_from_urethra' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>D/C</span><br>
<? } else if ($obj{"discharge_from_urethra"} == "pos") { ?>
       <input type="radio" name='discharge_from_urethra' value='na'>
       <input type="radio" name='discharge_from_urethra' value='pos' checked>
       <input type="radio" name='discharge_from_urethra' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>D/C</span><br>
<?  } else { ?>
       <input type="radio" name='discharge_from_urethra' value='na'>
       <input type="radio" name='discharge_from_urethra' value='pos'>
       <input type="radio" name='discharge_from_urethra' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>D/C</span><br>
<?  }

?>


</td><td valign=top>

<span class=bold>GU:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<? 
    if ($obj{"burning_with_urination"} == "na")
    { ?>
       <input type="radio" name='burning_with_urination' value='na' checked>
       <input type="radio" name='burning_with_urination' value='pos'>
       <input type="radio" name='burning_with_urination' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Dysuria</span><br>
<? } else if ($obj{"burning_with_urination"} == "pos") { ?>
       <input type="radio" name='burning_with_urination' value='na'>
       <input type="radio" name='burning_with_urination' value='pos' checked>
       <input type="radio" name='burning_with_urination' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Dysuria</span><br>
<?  } else { ?>
       <input type="radio" name='burning_with_urination' value='na'>
       <input type="radio" name='burning_with_urination' value='pos'>
       <input type="radio" name='burning_with_urination' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Dysuria</span><br>
<?  }

    if ($obj{"incontinence"} == "na")
    { ?>
       <input type="radio" name='incontinence' value='na' checked>
       <input type="radio" name='incontinence' value='pos'>
       <input type="radio" name='incontinence' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incontinence</span><br>
<? } else if ($obj{"incontinence"} == "pos") { ?>
       <input type="radio" name='incontinence' value='na'>
       <input type="radio" name='incontinence' value='pos' checked>
       <input type="radio" name='incontinence' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Incontinence</span><br>
<?  } else { ?>
       <input type="radio" name='incontinence' value='na'>
       <input type="radio" name='incontinence' value='pos'>
       <input type="radio" name='incontinence' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Incontinence</span><br>
<?  }

    if ($obj{"hematuria"} == "na")
    { ?>
       <input type="radio" name='hematuria' value='na' checked>
       <input type="radio" name='hematuria' value='pos'>
       <input type="radio" name='hematuria' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hematuria</span><br>
<? } else if ($obj{"hematuria"} == "pos") { ?>
       <input type="radio" name='hematuria' value='na'>
       <input type="radio" name='hematuria' value='pos' checked>
       <input type="radio" name='hematuria' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Hematuria</span><br>
<?  } else { ?>
       <input type="radio" name='hematuria' value='na'>
       <input type="radio" name='hematuria' value='pos'>
       <input type="radio" name='hematuria' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Hematuria</span><br>
<?  }

    if ($obj{"urinary_frequency"} == "na")
    { ?>
       <input type="radio" name='urinary_frequency' value='na' checked>
       <input type="radio" name='urinary_frequency' value='pos'>
       <input type="radio" name='urinary_frequency' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Frequency</span><br>
<? } else if ($obj{"urinary_frequency"} == "pos") { ?>
       <input type="radio" name='urinary_frequency' value='na'>
       <input type="radio" name='urinary_frequency' value='pos' checked>
       <input type="radio" name='urinary_frequency' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Frequency</span><br>
<?  } else { ?>
       <input type="radio" name='urinary_frequency' value='na'>
       <input type="radio" name='urinary_frequency' value='pos'>
       <input type="radio" name='urinary_frequency' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Frequency</span><br>
<?  }

    if ($obj{"nocturia"} == "na")
    { ?>
       <input type="radio" name='nocturia' value='na' checked>
       <input type="radio" name='nocturia' value='pos'>
       <input type="radio" name='nocturia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Nocturia</span><br>
<? } else if ($obj{"nocturia"} == "pos") { ?>
       <input type="radio" name='nocturia' value='na'>
       <input type="radio" name='nocturia' value='pos' checked>
       <input type="radio" name='nocturia' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Nocturia</span><br>
<?  } else { ?>
       <input type="radio" name='nocturia' value='na'>
       <input type="radio" name='nocturia' value='pos'>
       <input type="radio" name='nocturia' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Nocturia</span><br>
<?  }

    if ($obj{"urinary_hesitency"} == "na")
    { ?>
       <input type="radio" name='urinary_hesitency' value='na' checked>
       <input type="radio" name='urinary_hesitency' value='pos'>
       <input type="radio" name='urinary_hesitency' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hesitancy</span><br>
<? } else if ($obj{"urinary_hesitency"} == "pos") { ?>
       <input type="radio" name='urinary_hesitency' value='na'>
       <input type="radio" name='urinary_hesitency' value='pos' checked>
       <input type="radio" name='urinary_hesitency' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Hesitancy</span><br>
<?  } else { ?>
       <input type="radio" name='urinary_hesitency' value='na'>
       <input type="radio" name='urinary_hesitency' value='pos'>
       <input type="radio" name='urinary_hesitency' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Hesitancy</span><br>
<?  }
?>


</td><td valign=top>

<span class=bold>MSK:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?        

    if ($obj{"myalgias"} == "na")
    { ?>
       <input type="radio" name='myalgias' value='na' checked>
       <input type="radio" name='myalgias' value='pos'>
       <input type="radio" name='myalgias' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Myalgias</span><br>
<? } else if ($obj{"myalgias"} == "pos") { ?>
       <input type="radio" name='myalgias' value='na'>
       <input type="radio" name='myalgias' value='pos' checked>
       <input type="radio" name='myalgias' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Myalgias</span><br>
<?  } else { ?>
       <input type="radio" name='myalgias' value='na'>
       <input type="radio" name='myalgias' value='pos'>
       <input type="radio" name='myalgias' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Myalgias</span><br>
<?  }


    if ($obj{"arthralgias"} == "na")
    { ?>
       <input type="radio" name='arthralgias' value='na' checked>
       <input type="radio" name='arthralgias' value='pos'>
       <input type="radio" name='arthralgias' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Arthralgias</span><br>
<? } else if ($obj{"arthralgias"} == "pos") { ?>
       <input type="radio" name='arthralgias' value='na'>
       <input type="radio" name='arthralgias' value='pos' checked>
       <input type="radio" name='arthralgias' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Arthralgias</span><br>
<?  } else { ?>
       <input type="radio" name='arthralgias' value='na'>
       <input type="radio" name='arthralgias' value='pos'>
       <input type="radio" name='arthralgias' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Arthralgias</span><br>
<?  }

    if ($obj{"redness"} == "na")
    { ?>
       <input type="radio" name='redness' value='na' checked>
       <input type="radio" name='redness' value='pos'>
       <input type="radio" name='redness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Redness</span><br>
<? } else if ($obj{"redness"} == "pos") { ?>
       <input type="radio" name='redness' value='na'>
       <input type="radio" name='redness' value='pos' checked>
       <input type="radio" name='redness' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Redness</span><br>
<?  } else { ?>
       <input type="radio" name='redness' value='na'>
       <input type="radio" name='redness' value='pos'>
       <input type="radio" name='redness' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Redness</span><br>
<?  }

    if ($obj{"swollen_joints"} == "na")
    { ?>
       <input type="radio" name='swollen_joints' value='na' checked>
       <input type="radio" name='swollen_joints' value='pos'>
       <input type="radio" name='swollen_joints' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Swelling</span><br>
<? } else if ($obj{"swollen_joints"} == "pos") { ?>
       <input type="radio" name='swollen_joints' value='na'>
       <input type="radio" name='swollen_joints' value='pos' checked>
       <input type="radio" name='swollen_joints' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Swelling</span><br>
<?  } else { ?>
       <input type="radio" name='swollen_joints' value='na'>
       <input type="radio" name='swollen_joints' value='pos'>
       <input type="radio" name='swollen_joints' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Swelling</span><br>
<?  }

    if ($obj{"stiff_joints"} == "na")
    { ?>
       <input type="radio" name='stiff_joints' value='na' checked>
       <input type="radio" name='stiff_joints' value='pos'>
       <input type="radio" name='stiff_joints' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Stiffness</span><br>
<? } else if ($obj{"stiff_joints"} == "pos") { ?>
       <input type="radio" name='stiff_joints' value='na'>
       <input type="radio" name='stiff_joints' value='pos' checked>
       <input type="radio" name='stiff_joints' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Stiffness</span><br>
<?  } else { ?>
       <input type="radio" name='stiff_joints' value='na'>
       <input type="radio" name='stiff_joints' value='pos'>
       <input type="radio" name='stiff_joints' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Stiffness</span><br>
<?  }

?>

</td><td valign=top>
<span class=bold>SKIN:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?     
    if ($obj{"rashes"} == "na")
    { ?>
       <input type="radio" name='rashes' value='na' checked>
       <input type="radio" name='rashes' value='pos'>
       <input type="radio" name='rashes' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Rash</span><br>
<? } else if ($obj{"rashes"} == "pos") { ?>
       <input type="radio" name='rashes' value='na'>
       <input type="radio" name='rashes' value='pos' checked>
       <input type="radio" name='rashes' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Rash</span><br>
<?  } else { ?>
       <input type="radio" name='rashes' value='na'>
       <input type="radio" name='rashes' value='pos'>
       <input type="radio" name='rashes' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Rash</span><br>
<?  }

    if ($obj{"new_lesions"} == "na")
    { ?>
       <input type="radio" name='new_lesions' value='na' checked>
       <input type="radio" name='new_lesions' value='pos'>
       <input type="radio" name='new_lesions' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>New Lesions</span><br>
<? } else if ($obj{"new_lesions"} == "pos") { ?>
       <input type="radio" name='new_lesions' value='na'>
       <input type="radio" name='new_lesions' value='pos' checked>
       <input type="radio" name='new_lesions' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>New Lesions</span><br>
<?  } else { ?>
       <input type="radio" name='new_lesions' value='na'>
       <input type="radio" name='new_lesions' value='pos'>
       <input type="radio" name='new_lesions' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>New Lesions</span><br>
<?  }

    if ($obj{"change_in_moles"} == "na")
    { ?>
       <input type="radio" name='change_in_moles' value='na' checked>
       <input type="radio" name='change_in_moles' value='pos'>
       <input type="radio" name='change_in_moles' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Mole(s)</span><br>
<? } else if ($obj{"change_in_moles"} == "pos") { ?>
       <input type="radio" name='change_in_moles' value='na'>
       <input type="radio" name='change_in_moles' value='pos' checked>
       <input type="radio" name='change_in_moles' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Mole(s)</span><br>
<?  } else { ?>
       <input type="radio" name='change_in_moles' value='na'>
       <input type="radio" name='change_in_moles' value='pos'>
       <input type="radio" name='change_in_moles' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Mole(s)</span><br>
<?  }

    if ($obj{"change_in_nails"} == "na")
    { ?>
       <input type="radio" name='change_in_nails' value='na' checked>
       <input type="radio" name='change_in_nails' value='pos'>
       <input type="radio" name='change_in_nails' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>change_in_nails</span><br>
<? } else if ($obj{"change_in_nails"} == "pos") { ?>
       <input type="radio" name='change_in_nails' value='na'>
       <input type="radio" name='change_in_nails' value='pos' checked>
       <input type="radio" name='change_in_nails' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>change_in_nails</span><br>
<?  } else { ?>
       <input type="radio" name='change_in_nails' value='na'>
       <input type="radio" name='change_in_nails' value='pos'>
       <input type="radio" name='change_in_nails' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>change_in_nails</span><br>
<?  }
?>

</td><td valign=top>
<span class=bold>NEURO:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<?

    if ($obj{"ha"} == "na")
    { ?>
       <input type="radio" name='ha' value='na' checked>
       <input type="radio" name='ha' value='pos'>
       <input type="radio" name='ha' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Headache</span><br>
<? } else if ($obj{"ha"} == "pos") { ?>
       <input type="radio" name='ha' value='na'>
       <input type="radio" name='ha' value='pos' checked>
       <input type="radio" name='ha' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Headache</span><br>
<?  } else { ?>
       <input type="radio" name='ha' value='na'>
       <input type="radio" name='ha' value='pos'>
       <input type="radio" name='ha' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Headache</span><br>
<?  }

    if ($obj{"vision_change"} == "na")
    { ?>
       <input type="radio" name='vision_change' value='na' checked>
       <input type="radio" name='vision_change' value='pos'>
       <input type="radio" name='vision_change' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Vision Ch.</span><br>
<? } else if ($obj{"vision_change"} == "pos") { ?>
       <input type="radio" name='vision_change' value='na'>
       <input type="radio" name='vision_change' value='pos' checked>
       <input type="radio" name='vision_change' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Vision Ch.</span><br>
<?  } else { ?>
       <input type="radio" name='vision_change' value='na'>
       <input type="radio" name='vision_change' value='pos'>
       <input type="radio" name='vision_change' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Vision Ch.</span><br>
<?  }

    if ($obj{"numbness"} == "na")
    { ?>
       <input type="radio" name='numbness' value='na' checked>
       <input type="radio" name='numbness' value='pos'>
       <input type="radio" name='numbness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Numbness</span><br>
<? } else if ($obj{"numbness"} == "pos") { ?>
       <input type="radio" name='numbness' value='na'>
       <input type="radio" name='numbness' value='pos' checked>
       <input type="radio" name='numbness' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Numbness</span><br>
<?  } else { ?>
       <input type="radio" name='numbness' value='na'>
       <input type="radio" name='numbness' value='pos'>
       <input type="radio" name='numbness' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Numbness</span><br>
<?  }

    if ($obj{"dizziness"} == "na")
    { ?>
       <input type="radio" name='dizziness' value='na' checked>
       <input type="radio" name='dizziness' value='pos'>
       <input type="radio" name='dizziness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Dizziness</span><br>
<? } else if ($obj{"dizziness"} == "pos") { ?>
       <input type="radio" name='dizziness' value='na'>
       <input type="radio" name='dizziness' value='pos' checked>
       <input type="radio" name='dizziness' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Dizziness</span><br>
<?  } else { ?>
       <input type="radio" name='dizziness' value='na'>
       <input type="radio" name='dizziness' value='pos'>
       <input type="radio" name='dizziness' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Dizziness</span><br>
<?  }

    if ($obj{"weakness"} == "na")
    { ?>
       <input type="radio" name='weakness' value='na' checked>
       <input type="radio" name='weakness' value='pos'>
       <input type="radio" name='weakness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Weakness</span><br>
<? } else if ($obj{"weakness"} == "pos") { ?>
       <input type="radio" name='weakness' value='na'>
       <input type="radio" name='weakness' value='pos' checked>
       <input type="radio" name='weakness' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Weakness</span><br>
<?  } else { ?>
       <input type="radio" name='weakness' value='na'>
       <input type="radio" name='weakness' value='pos'>
       <input type="radio" name='weakness' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Weakness</span><br>
<?  }

    if ($obj{"imbalance"} == "na")
    { ?>
       <input type="radio" name='imbalance' value='na' checked>
       <input type="radio" name='imbalance' value='pos'>
       <input type="radio" name='imbalance' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Imbalance</span><br>
<? } else if ($obj{"imbalance"} == "pos") { ?>
       <input type="radio" name='imbalance' value='na'>
       <input type="radio" name='imbalance' value='pos' checked>
       <input type="radio" name='imbalance' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>Imbalance</span><br>
<?  } else { ?>
       <input type="radio" name='imbalance' value='na'>
       <input type="radio" name='imbalance' value='pos'>
       <input type="radio" name='imbalance' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Imbalance</span><br>
<?  }
?>
</td>
</tr>
</table>

<span class=text>Additional Notes: </span><br><textarea cols=40 rows=8 wrap=virtual name="additional_notes" ><?echo $obj{"additional_notes"};?></textarea><br>
<br>
<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save Changes]</a>
</form>
<?php
formFooter();
?>
