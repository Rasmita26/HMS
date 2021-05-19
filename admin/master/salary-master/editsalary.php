<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if (isset($_POST['employeeid']) && isset($_POST['month'])) {
      $con = _connect();
        $employeeid=$_POST['employeeid'];
        $month=$_POST['month'];
        $month1 =strtotime($month)*1000;
        $chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM employee_salary WHERE employeeid='$employeeid' AND month='$month1'"));
        if ($chk) {
          $basicsalary_old  = $chk["basicsalary"];
          $totaldays_old    = $chk["totaldays"];
          $presentdays_old  = $chk["presentdays"];
          $absentdays_old   = $chk["absentdays"];
          $paidsalary_old   = $chk["paidsalary"];
          $str='{"basicsalary":"'.$basicsalary_old.'","totaldays":"'.$totaldays_old.'","presentdays":"'.$presentdays_old.'","absentdays":"'.$absentdays_old.'","paidsalary":"'.$paidsalary_old.'"}';      
          echo '{"status":"success","json":['.$str.']}';
      }
      _close($con);
    }
  ?>

