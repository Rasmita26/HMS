<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    if (isset($_POST['data'])) {
      $con = _connect();
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      $created_by = $_SESSION['id'];


      $data = json_decode($_POST["data"]);
      foreach($data as $i) {
        $sid = get_object_vars($i)["sid"];
        $sname = get_object_vars($i)["sname"];
        $medicinename = get_object_vars($i)["medicinename"];
        $rate = get_object_vars($i)["rate"];

        //  $sid1=mysqli_fetch_assoc(mysqli_query($con, "SELECT id x FROM supplier WHERE sname='$sname' "))['x'];
        $chk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM msirate WHERE medicineid='$medicinename' AND sid='$sid'"));
        if ($chk) {
          $sid_old = $chk["sid"];
          $medicineid_old = $chk["medicineid"];
          $rate_old = $chk["rate"];
          $created_by_old = $chk["created_by"];
          $created_time_old = $chk["created_time"];
          mysqli_query($con, "INSERT INTO msirate_history(sirid,rate,medicineid,created_by,created_time) VALUES ('$sid_old','$rate_old','$medicineid_old','$created_by_old','$created_time_old')");
          mysqli_query($con, "DELETE FROM msirate WHERE medicineid='$medicineid_old' AND sid='$sid_old'");
          mysqli_query($con, "INSERT INTO msirate(sid,sname,medicineid,rate,approval,approval_by,created_by,created_time) VALUES ('$sid','$sname','$medicinename','$rate','0','0','$created_by','$CURRENT_MILLIS')");
        } else {
          mysqli_query($con, "INSERT INTO msirate(sid,sname,medicineid,rate,approval,approval_by,created_by,created_time) VALUES ('$sid','$sname','$medicinename','$rate','0','0','$created_by','$CURRENT_MILLIS')");
       }

      }
      echo '{"status":"success"}';
      _close($con);
    } else {
      echo '{"status":"failed1"}';
    }
  ?>
