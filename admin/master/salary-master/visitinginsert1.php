<?php $base='../../../';
include($base.'_in/connect.php');
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_POST['doctor_id']) && isset($_POST['doctorname']) && isset($_POST['month']) && isset($_POST['pcheck']) && isset($_POST['fees']) && isset($_POST['paidsalary'])){
  $con=_connect();
  if (session_status()==PHP_SESSION_NONE) {
    session_start();
  }
  $created_by=$_SESSION['id'];
  $doctor_id=$_POST["doctor_id"];
  $doctorname=$_POST["doctorname"];
  $month=$_POST["month"];
  $month1 =strtotime($month)*1000;
  $pcheck=$_POST["pcheck"];
  $fees=$_POST["fees"];
  $paidsalary=$_POST["paidsalary"];
  $chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM vistingdoctorsalary WHERE doctorid='$doctor_id' AND month='$month1'"));
  if ($chk) {
  mysqli_query($con, "DELETE FROM vistingdoctorsalary WHERE doctorid='$doctor_id' AND month='$month1'");
   $create=mysqli_query($con, "INSERT INTO vistingdoctorsalary(doctorid,doctorname,month,pcheck,fees,paidsalary,created_by,created_time) VALUES ('$doctor_id','$doctorname','$month1','$pcheck','$fees','$paidsalary','$created_by','$CURRENT_MILLIS')");
  } else {
    $create=mysqli_query($con, "INSERT INTO vistingdoctorsalary(doctorid,doctorname,month,pcheck,fees,paidsalary,created_by,created_time) VALUES ('$doctor_id','$doctorname','$month1','$pcheck','$fees','$paidsalary','$created_by','$CURRENT_MILLIS')");
}
  if ($create) {
    echo '{"status":"success"}';
  }else{
    echo '{"status":"failed"}';
  }
          _close($con);
  }
   else{
      echo '{"status":"failed1"}';
   }
?>
  