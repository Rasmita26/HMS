<?php $base='../';
include($base.'_in/connect.php');
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_POST['name']) && isset($_POST['disease']) && isset($_POST['time']) && isset($_POST['date']) && isset($_POST['specialist']) && isset($_POST['dname']) && isset($_POST['phone1']) && isset($_POST['phone2']) && isset($_POST['location'])) {
  $con=_connect();
  if (session_status()==PHP_SESSION_NONE) {
    session_start();
  }
  $created_by=$_SESSION['id'];

  $name=$_POST["name"];
  $disease=$_POST["disease"];
  $time=$_POST["time"];
  $date=$_POST["date"];
  $date1=strtotime($date)*1000;
  $specialist=$_POST["specialist"];
  $dname=$_POST["dname"];
  $phone1=$_POST["phone1"];
  $phone2=$_POST["phone2"];
  $location=$_POST["location"];

  echo  "INSERT INTO appointment(patient_name,specialist,drname,disease,phone1,phone2,location,time,date,created_by,created_time,removed_by) VALUES ('$name','$specialist','$dname','$disease','$phone1','$phone2','$location','$time','$date1','$created_by','$CURRENT_MILLIS')";



  $create=mysqli_query($con, "INSERT INTO appointment(patient_name,specialist,drname,disease,phone1,phone2,location,time,date,created_by,created_time) VALUES ('$name','$specialist','$dname','$disease','$phone1','$phone2','$location','$time','$date1','$created_by','$CURRENT_MILLIS')");

  if ($create) {
    echo '{"status":"success"}';
  }
  else {
    echo '{"status":"failed"}';
  }
  _close($con);
}
else {
  echo '{"status":"failed1"}';
}
?>