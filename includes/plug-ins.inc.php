<?php
$phpVersion = phpversion();
$today = date('Y-m-d');

$reg_open = $row_contest_info['contestRegistrationOpen'];
$reg_deadline = $row_contest_info['contestRegistrationDeadline'];

$ent_open = $row_contest_info['contestEntryOpen'];
$ent_deadline = $row_contest_info['contestEntDeadline'];

mysql_select_db($database, $brewing);
$query_check = "SELECT * FROM judging";
$check = mysql_query($query_check, $brewing) or die(mysql_error());
$row_check = mysql_fetch_assoc($check);
do {
 	if ($row_check['judgingDate'] > $today) $newDate[] = 1; 
 	else $newDate[] = 0;
	} while ($row_check = mysql_fetch_assoc($check));
	if (in_array(1, $newDate)) $judgingDateReturn = "false"; else $judgingDateReturn = "true";

function greaterDate($start_date,$end_date)
{
  $start = new Datetime($start_date);
  $end = new Datetime($end_date);
  if ($start > $end)
   return 1;
  else
   return 0;
}

function lesserDate($start_date,$end_date)
{
  $start = new Datetime($start_date);
  $end = new Datetime($end_date);
  if ($start < $end)
   return 1;
  else
   return 0;
}

$color = "#eeeeee";
$color1 = "#e0e0e0";
$color2 = "#eeeeee";


// ---------------------------- Temperature, Weight, and Volume Conversion ----------------------------------

function tempconvert($temp,$t) { // $t = desired output, defined at function call
if ($t == "F") { // Celsius to F if source is C
	$tcon = (($temp - 32) / 1.8); 
    return round ($tcon, 1);
	}
	
if ($t == "C") { // F to Celsius
	$tcon = (($temp - 32) * (5/9)); 
    return round ($tcon, 1);
	}
}

function weightconvert($weight,$w) { // $w = desired output, defined at function call
if ($w == "pounds") { // kilograms to pounds
	$wcon = ($weight * 2.2046);
	return round ($wcon, 2);
	}
	
if ($w == "ounces") { // grams to ounces
	$wcon = ($weight * 0.03527);
	return round ($wcon, 2);
	}	
	
if ($w == "grams") { // ounces to grams
	$wcon = ($weight * 28.3495);
	return round ($wcon, 2);
	}
	
if ($w == "kilograms") { // pounds to kilograms
	$wcon = ($weight * 0.4535);
	return round ($wcon, 2);
	}
}

function volumeconvert($volume,$v) {  // $v = desired output, defined at function call
if ($v == "gallons") { // liters to gallons
	$vcon = ($volume * 0.2641);
	return round ($vcon, 2);
	}
	
if ($v == "ounces") { // milliliters to ounces
	$vcon = ($volume * 29.573);
	return round ($vcon, 2);
	}	

if ($v == "liters") { // gallons to liters
	$vcon = ($volume * 3.7854);
	return round ($vcon, 2);
	}
	
if ($v == "milliliters") { // fluid ounces to milliliters
	$vcon = ($volume * 29.5735) ;
	return round ($vcon, 2);
	}	
	
}

// ---------------------------- Date Conversion -----------------------------------------
// http://www.phpbuilder.com/annotate/message.php3?id=1031006
function dateconvert($date,$func) {
if ($func == 1)	{ //insert conversion
list($day, $month, $year) = split('[/.-]', $date); 
$date = "$year-$month-$day"; 
return $date;
	}
if ($func == 2)	{ //output conversion
list($year, $month, $day) = explode("-", $date);
if ($month == "01" ) { $month = "January "; }
if ($month == "02" ) { $month = "February "; }
if ($month == "03" ) { $month = "March "; }
if ($month == "04" ) { $month = "April "; }
if ($month == "05" ) { $month = "May "; }
if ($month == "06" ) { $month = "June "; }
if ($month == "07" ) { $month = "July "; }
if ($month == "08" ) { $month = "August "; }
if ($month == "09" ) { $month = "September "; }
if ($month == "10" ) { $month = "October "; }
if ($month == "11" ) { $month = "November "; }
if ($month == "12" ) { $month = "December "; }
$day = ltrim($day, "0");
/* 
Future release: add logic to check if user preferences 
dictate "American" English date formats vs. "British" 
English date formats
*/
$date = "$month $day, $year";
return $date;
	}
	
if ($func == 3)	{ //output conversion
list($year, $month, $day) = explode("-", $date);
if ($month == "01" ) { $month = "Jan"; }
if ($month == "02" ) { $month = "Feb"; }
if ($month == "03" ) { $month = "Mar"; }
if ($month == "04" ) { $month = "Apr"; }
if ($month == "05" ) { $month = "May"; }
if ($month == "06" ) { $month = "Jun"; }
if ($month == "07" ) { $month = "Jul"; }
if ($month == "08" ) { $month = "Aug"; }
if ($month == "09" ) { $month = "Sep"; }
if ($month == "10" ) { $month = "Oct"; }
if ($month == "11" ) { $month = "Nov"; }
if ($month == "12" ) { $month = "Dec"; }
$day = ltrim($day, "0");
/* 
Future release: add logic to check if user preferences 
dictate "American" English date formats vs. "British" 
English date formats
*/
$date = "$month $day, $year";
return $date;
	}
}

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

?>