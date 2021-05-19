<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
      if(isset($_POST['assigndate']) && isset($_POST['dischargedate']) && isset($_POST['bedtype']) && isset($_POST['price']) && isset($_POST['bedno']) && isset($_POST['pid']) && isset($_POST['remark']) && isset($_POST['assigntime']) && isset($_POST['dischargetime'])){
      $con=_connect();
      if (session_status()==PHP_SESSION_NONE) { session_start(); }
      
      $created_by=$_SESSION['id'];

      $assigndate =$_POST["assigndate"]+$_POST["assigntime"];
      $dischargedate =$_POST["dischargedate"]+$_POST["dischargetime"];
      $price =$_POST['price'];
      $bedno =$_POST['bedno'];
      $remark =$_POST['remark'];
      $pid =$_POST['pid'];
      $id=$_POST['bedtype'];
      
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT room,roomtype from room WHERE id='$id'"));
      $bedtype=$select['room'];
      $roomtype=$select['roomtype'];

      // echo "INSERT INTO bed(assign_time,discharge_time,bedtype,roomtype,price,bedno,pid,remark,created_by,created_time) VALUES
      // ('$assigndate','$dischargedate','$bedtype','$roomtype','$price','$bedno','$pid','$remark','$created_by','$CURRENT_MILLIS')";
      
     $create=mysqli_query($con, "INSERT INTO bed(assign_time,discharge_time,bedtype,roomtype,price,bedno,pid,remark,created_by,created_time) VALUES
     ('$assigndate','$dischargedate','$bedtype','$roomtype','$price','$bedno','$pid','$remark','$created_by','$CURRENT_MILLIS')");

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