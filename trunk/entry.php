<?php require_once('Connections/config.php'); 
session_start();
//include ('includes/db_connect.inc.php');
include ('includes/plug-ins.inc.php');
include ('includes/url_variables.inc.php');

// Templating system
include_once ('includes/tbs_class_php5.php');

mysql_select_db($database, $brewing);

$query_contest_info = "SELECT * FROM contest_info WHERE id=1";
$row_contest_info = mysql_query($query_contest_info, $brewing) or die(mysql_error());
$contest_info = mysql_fetch_assoc($row_contest_info);

$query_brewing = sprintf("SELECT * FROM brewing WHERE id = '%s'", $id);
$log = mysql_query($query_brewing, $brewing) or die(mysql_error());
$brewing_info = mysql_fetch_assoc($log);

$query_brewer_user = sprintf("SELECT * FROM users WHERE id = '%s'", $brewing_info['brewBrewerID']);
$user = mysql_query($query_brewer_user, $brewing) or die(mysql_error());
$row_brewer_user_info = mysql_fetch_assoc($user);

$query_logged_in = sprintf("SELECT * FROM users WHERE user_name = '%s'", $_SESSION['loginUsername']);
$logged_in_user = mysql_query($query_logged_in, $brewing) or die(mysql_error());
$row_logged_in_user = mysql_fetch_assoc($logged_in_user);

$query_brewer = sprintf("SELECT * FROM brewer WHERE uid = '%s'", $row_brewer_user_info['id']);
$brewer = mysql_query($query_brewer, $brewing) or die(mysql_error());
$brewer_info = mysql_fetch_assoc($brewer);

$query_prefs = "SELECT * FROM preferences WHERE id=1";
$prefs = mysql_query($query_prefs, $brewing) or die(mysql_error());
$row_prefs = mysql_fetch_assoc($prefs);

// Check access restrictions
if ($brewer_info['brewerEmail'] != $_SESSION['loginUsername'] &&
      $row_logged_in_user['userLevel'] != 1) { 
  echo "<html><head><title>Error</title></head><body>";
  echo "<p>You do not have sufficient access priveliges to view this page.</p>";
  echo "</body>";
  exit();
}

// Get some values that are easier to work with in the templates
$brewing_info['carbonation'] = 'unknown';
if ($brewing_info['brewCarbonationMethod'] == "Y") {
  $brewing_info['carbonation'] = 'forced';
}
if ($brewing_info['brewCarbonationMethod'] == "N") {
  $brewing_info['carbonation'] = 'bottleConditioned';
}

// Various mead and cider info
switch ($brewing_info['brewMead1']) {
  case "Still":
    $brewing_info['sparkling'] = 'no';
    break;
  case "Petillant":
    $brewing_info['sparkling'] = 'petillant';
    break;
  case "Sparkling":
    $brewing_info['sparkling'] = 'yes';
    break;
  default:
    $brewing_info['sparkling'] = '';
}

switch ($brewing_info['brewMead2']) {
  case "Dry":
    $brewing_info['sweetness'] = 'dry';
    break;
  case "Semi-Sweet":
    $brewing_info['sweetness'] = 'semiSweet';
    break;
  case "Sweet":
    $brewing_info['sweetness'] = 'sweet';
    break;
  default:
    $brewing_info['sweetness'] = '';
}

switch ($brewing_info['brewMead3']) {
  case "Hydromel":
    $brewing_info['meadType']='hydromel';
    break;
  case "Standard":
    $brewing_info['meadType']='standard';
    break;
  case "Sack":
    $brewing_info['meadType']='sack';
    break;
  default:
    $brewing_info['meadType']='';
    break;
}

// Style name
include ('includes/style_convert.inc.php'); // User friendly style names
if ($brewing_info['brewCategory'] < 29) 
  $brewing_info['styleName'] = $brewing_info['brewStyle'];
else
  $brewing_info['styleName'] = $row_contest_info['contestName']." Style: ".$brewing_info['brewStyle']; 

// Some metric/US conversions
$brewing_info['brewSize']['us']=$brewing_info['brewYield'];
$brewing_info['brewSize']['metric']=round($brewing_info['brewYield']*3.78541,2);

// Convert fermentation temperature
$brewPrimaryTemp=$brewing_info['brewPrimaryTemp'];
$brewing_info['brewPrimaryTemp']=array();
if ($row_prefs['prefsTemp'] == "Celsius") {
  $brewing_info['brewPrimaryTemp']['c'] = $brewPrimaryTemp;
  $brewing_info['brewPrimaryTemp']['f']  = 
      round((9/5)*$brewPrimaryTemp+32, 0);
} else {
  $brewing_info['brewPrimaryTemp']['f'] = $brewPrimaryTemp;
  $brewing_info['brewPrimaryTemp']['c']  = 
      round((5/9)*($brewPrimaryTemp-32), 0);
}

$brewSecondaryTemp=$brewing_info['brewSecondaryTemp'];
$brewing_info['brewSecondaryTemp']=array();
if ($row_prefs['prefsTemp'] == "Celsius") {
  $brewing_info['brewSecondaryTemp']['c'] = $brewSecondaryTemp;
  $brewing_info['brewSecondaryTemp']['f']  = 
      round((9/5)*$brewSecondaryTemp+32, 0);
} else {
  $brewing_info['brewSecondaryTemp']['f'] = $brewSecondaryTemp;
  $brewing_info['brewSecondaryTemp']['c']  = 
      round((5/9)*($brewSecondaryTemp-32), 0);
}
      
// Arrays for ingredients and mashing
//

$totalFermentables=0;

// Grains
$brewing_info['grains']=array();
for ($i=1; $i <= 9; $i++) {
  if ($brewing_info['brewGrain'.$i] != "") {
    $brewing_info['grains'][$i]['name']=$brewing_info['brewGrain'.$i];

    // Metric/US conversion
    if ($row_prefs['prefsWeight2'] == "kilograms") {
      $brewing_info['grains'][$i]['weight']['kg'] = $brewing_info['brewGrain'.$i.'Weight'];
      $brewing_info['grains'][$i]['weight']['lb'] = 
           round($brewing_info['brewGrain'.$i.'Weight']*2.204,2);
     } else {
       $brewing_info['grains'][$i]['weight']['lb'] = $brewing_info['brewGrain'.$i.'Weight'];
       $brewing_info['grains'][$i]['weight']['kg'] = 
           round($brewing_info['brewGrain'.$i.'Weight']/2.204,2);
     }
     
     $totalFermentables+=$brewing_info['grains'][$i]['weight']['kg'];
     $brewing_info['grains'][$i]['use']=$brewing_info['brewGrain'.$i.'Use'];
  }
}

// Extracts
$brewing_info['extracts']=array();
for ($i=1; $i <= 9; $i++) {
  if ($brewing_info['brewExtract'.$i] != "") {
    $brewing_info['extracts'][$i]['name']=$brewing_info['brewExtract'.$i];

    // Metric/US conversion
    if ($row_prefs['prefsWeight2'] == "kilograms") {
      $brewing_info['extracts'][$i]['weight']['kg'] = $brewing_info['brewExtract'.$i.'Weight'];
      $brewing_info['extracts'][$i]['weight']['lb'] = 
           round($brewing_info['brewExtract'.$i.'Weight']*2.204,2);
     } else {
       $brewing_info['extracts'][$i]['weight']['lb'] = $brewing_info['brewExtract'.$i.'Weight'];
       $brewing_info['extracts'][$i]['weight']['kg'] = 
           round($brewing_info['brewExtract'.$i.'Weight']/2.204,2);
     }
     
     $totalFermentables+=$brewing_info['extracts'][$i]['weight']['kg'];
     $brewing_info['extracts'][$i]['use']=$brewing_info['brewExtract'.$i.'Use'];
  }
}

// Adjuncts
$brewing_info['adjuncts']=array();
for ($i=1; $i <= 9; $i++) {
  if ($brewing_info['brewAddition'.$i] != "") {
    $brewing_info['adjuncts'][$i]['name']=$brewing_info['brewAddition'.$i];

    // Metric/US conversion
    if ($row_prefs['prefsWeight2'] == "kilograms") {
      $brewing_info['adjuncts'][$i]['weight']['kg'] = $brewing_info['brewAddition'.$i.'Amt'];
      $brewing_info['adjuncts'][$i]['weight']['lb'] = 
           round($brewing_info['brewAddition'.$i.'Amt']*2.204,2);
     } else {
       $brewing_info['adjuncts'][$i]['weight']['lb'] = $brewing_info['brewAddition'.$i.'Amt'];
       $brewing_info['adjuncts'][$i]['weight']['kg'] = 
           round($brewing_info['brewAddition'.$i.'Amt']/2.204,2);
     }
     
     $totalFermentables+=$brewing_info['adjuncts'][$i]['weight']['kg'];
     $brewing_info['adjuncts'][$i]['use']=$brewing_info['brewAddition'.$i.'Use'];
  }
}

// Calculate percentages
if ($totalFermentables != 0) {
  reset ($brewing_info['grains']);
  foreach ($brewing_info['grains'] as &$fermentable)
    $fermentable['weight']['percent'] = 
       round(($fermentable['weight']['kg']/$totalFermentables)*100,2);

  reset ($brewing_info['extracts']);
  foreach ($brewing_info['extracts'] as &$fermentable)
    $fermentable['weight']['percent'] = 
       round(($fermentable['weight']['kg']/$totalFermentables)*100,2);

  reset ($brewing_info['adjuncts']);
  foreach ($brewing_info['adjuncts'] as &$fermentable)
    $fermentable['weight']['percent'] = 
       round(($fermentable['weight']['kg']/$totalFermentables)*100,2);
}
  

// Hops
$brewing_info['hops']=array();
for ($i=1; $i <= 9; $i++) {
  if ($brewing_info['brewHops'.$i] != "") {
    $brewing_info['hops'][$i]['name']=$brewing_info['brewHops'.$i];
    $brewing_info['hops'][$i]['alphaAcid']=$brewing_info['brewHops'.$i.'IBU'];
    $brewing_info['hops'][$i]['minutes']=$brewing_info['brewHops'.$i.'Time'];
    $brewing_info['hops'][$i]['use']=$brewing_info['brewHops'.$i.'Use'];
    $brewing_info['hops'][$i]['form']=$brewing_info['brewHops'.$i.'Form'];

    // Metric/US conversion
    if ($row_prefs['prefsWeight1'] == "grams") {
      $brewing_info['hops'][$i]['weight']['g'] = $brewing_info['brewHops'.$i.'Weight'];
      $brewing_info['hops'][$i]['weight']['oz'] = 
           round($brewing_info['brewHops'.$i.'Weight']/28.3495,2);
     } else {
       $brewing_info['hops'][$i]['weight']['oz'] = $brewing_info['brewHops'.$i.'Weight'];
       $brewing_info['hops'][$i]['weight']['g'] = 
           round($brewing_info['brewHops'.$i.'Weight']*28.3495,1);
     }
  }
}

// Mashing
$brewing_info['mashSteps']=array();
for ($i=1; $i <= 9; $i++) {
  if ($brewing_info['brewMashStep'.$i.'Temp'] != 0) {
    $brewing_info['mashSteps'][$i]['name']=$brewing_info['brewMashStep'.$i.'Name'];
    $brewing_info['mashSteps'][$i]['minutes']=$brewing_info['brewMashStep'.$i.'Time'];

    // Metric/US conversion
    if ($row_prefs['prefsTemp'] == "Celsius") {
      $brewing_info['mashSteps'][$i]['temp']['c'] = $brewing_info['brewMashStep'.$i.'Temp'];
      $brewing_info['mashSteps'][$i]['temp']['f']  = 
           round((9/5)*$brewing_info['brewMashStep'.$i.'Temp']+32, 0);
     } else {
      $brewing_info['mashSteps'][$i]['temp']['f'] = $brewing_info['brewMashStep'.$i.'Temp'];
      $brewing_info['mashSteps'][$i]['temp']['c']  = 
           round((5/9)*($brewing_info['brewMashStep'.$i.'Temp']-32), 0);
     }
  }
}

$TBS =& new clsTinyButStrong;

if ($row_prefs['prefsEntryForm'] == "B") { 
$TBS->LoadTemplate('templates/bjcp-entry.html');
}

if ($row_prefs['prefsEntryForm'] == "M") { 
$TBS->LoadTemplate('templates/simple-metric-entry.html');
}

if ($row_prefs['prefsEntryForm'] == "U") { 
$TBS->LoadTemplate('templates/simple-us-entry.html');
}

$TBS->MergeBlock('grains',$brewing_info['grains']);
$TBS->MergeBlock('extracts',$brewing_info['extracts']);
$TBS->MergeBlock('adjuncts',$brewing_info['adjuncts']);
$TBS->MergeBlock('hops',$brewing_info['hops']);
$TBS->MergeBlock('mashSteps',$brewing_info['mashSteps']);

$TBS->Show();

?>
