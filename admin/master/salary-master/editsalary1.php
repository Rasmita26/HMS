<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if (isset($_POST['doctor_id']) && isset($_POST['month'])) {
      $con = _connect();
        $doctor_id=$_POST['doctor_id'];
        $month=$_POST['month'];
        $month1 =strtotime($month)*1000;
        $chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM vistingdoctorsalary WHERE doctorid='$doctor_id' AND month='$month1'"));
        if ($chk) {
          $pcheck_old  = $chk["pcheck"];
          $fees_old    = $chk["fees"];
          $paidsalary_old   = $chk["paidsalary"];
          $str='{"pcheck":"'.$pcheck_old.'","fees":"'.$fees_old.'","paidsalary":"'.$paidsalary_old.'"}';      
          echo '{"status":"success","json":['.$str.']}';
      }
      _close($con);
    }
  ?>
