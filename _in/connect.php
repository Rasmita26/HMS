<?php 

date_default_timezone_set('Asia/Kolkata');
include('env.php');
$CURRENT_MILLIS=round(microtime(true) * 1000);
$CURRENT_DAY=date("d", $CURRENT_MILLIS/1000);
$CURRENT_MONTH=date("m", $CURRENT_MILLIS/1000);
$CURRENT_YEAR=date("Y", $CURRENT_MILLIS/1000);
$START_OF_THE_DAY=strtotime($CURRENT_YEAR.'-'.$CURRENT_MONTH.'-'.$CURRENT_DAY.' 00:00:00') * 1000;
$END_OF_THE_DAY=strtotime($CURRENT_YEAR.'-'.$CURRENT_MONTH.'-'.$CURRENT_DAY.' 24:00:00') * 1000;;

function _clean($con,$str){
  return mysqli_real_escape_string($con,$str);
}

$month = date('m');
$day = date('d');
$year = date('Y');
$_today = $year . '-' . $month . '-' . $day;

?>