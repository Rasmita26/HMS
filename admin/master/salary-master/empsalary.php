<?php
       $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['employeeid']) && isset($_POST['fname']) && isset($_POST['basicsalary']) && isset($_POST['month']) && isset($_POST['totaldays']) && isset($_POST['presentdays']) && isset($_POST['absentdays']) && isset($_POST['paidsalary'])){
      $con=_connect();
      if (session_status()==PHP_SESSION_NONE) { session_start(); }
      $created_by=$_SESSION['id'];
      $employeeid= $_POST["employeeid"];
      $fname = $_POST["fname"];
      $basicsalary =$_POST["basicsalary"];
      $month =$_POST["month"];
      $month1 =strtotime($month)*1000;
      $totaldays =$_POST["totaldays"];
      $presentdays =$_POST["presentdays"];
      $absentdays =$_POST["totaldays"]-$_POST["presentdays"];
      $paidsalary =$_POST["paidsalary"];
      $chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM employee_salary WHERE employeeid='$employeeid' AND month='$month1'"));
      if ($chk) {
       mysqli_query($con, "DELETE FROM employee_salary WHERE employeeid='$employeeid' AND month='$month1'");
      $create=mysqli_query($con, "INSERT INTO employee_salary(employeeid,employeename,basicsalary,month,totaldays,presentdays,absentdays,paidsalary,created_by,created_time) VALUES ('$employeeid','$fname','$basicsalary','$month1','$totaldays' ,'$presentdays','$absentdays','$paidsalary','$created_by','$CURRENT_MILLIS')");
    } else {
     $create= mysqli_query($con,  "INSERT INTO employee_salary(employeeid,employeename,basicsalary,month,totaldays,presentdays,absentdays,paidsalary,created_by,created_time) VALUES ('$employeeid','$fname','$basicsalary','$month1','$totaldays' ,'$presentdays','$absentdays','$paidsalary','$created_by','$CURRENT_MILLIS')"); 
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