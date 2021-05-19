<?php
       $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['regid']) && isset($_POST['date']) && isset($_POST['dname']) && isset($_POST['fees']) && isset($_POST['pid'])){
      $con=_connect();
      if (session_status()==PHP_SESSION_NONE) { session_start(); }
      $created_by=$_SESSION['id'];
      $regid= $_POST["regid"];
      $date = $_POST["date"];
      $month1 =strtotime($date)*1000;
      $dname =$_POST["dname"];
      $fees =$_POST["fees"];
      $pid =$_POST["pid"];
      $create=mysqli_query($con, "INSERT INTO outsidedoctor(registrationid,month,doctorname,patientid,paidsalary,created_by,created_time) VALUES ('$regid','$month1','$dname','$pid','$fees','$created_by','$CURRENT_MILLIS')");

       
    if ($create) {
        echo '{"status":"success"}';
      }else{
        echo '{"status":"failed1"}';
      }
  
      
  
  
              _close($con);
       }
       else{
          echo '{"status":"failed"}';
       }
  ?>