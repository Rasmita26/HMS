<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

        if(isset($_POST['data']) && isset($_POST['data1']) ){
      $con=_connect();
      if (session_status()==PHP_SESSION_NONE) { session_start(); }

      $created_by=$_SESSION['id'];

      $data =json_decode($_POST["data"]);
      $sname = get_object_vars($data)["sname"];
      $address = get_object_vars($data)["address"];
      $phone = get_object_vars($data)["phone"];
      $cpancard = get_object_vars($data)["cpancard"];
      $creditdate = get_object_vars($data)["creditdate"];
      $country = get_object_vars($data)["country"];
      $state= get_object_vars($data)["state"];
      $pin = get_object_vars($data)["pin"];
      $gstno= get_object_vars($data)["gstno"];
      $email= get_object_vars($data)["email"];
      $others= get_object_vars($data)["others"];
      $cname= get_object_vars($data)["cname"];
      // $department= get_object_vars($data)["department"];
      // $mobile= get_object_vars($data)["mobile"];
      // $landline= get_object_vars($data)["landline"];
      // $email= get_object_vars($data)["email"];
      $data1 =$_POST["data1"];


      $create=mysqli_query($con, "INSERT INTO supplier(sname,address,phoneno,semail,cpancard,creditdate,country,state,pin_no,gst_no,others,cname,created_by,created_time) VALUES
      ('$sname','$address','$phone','$email','$cpancard','$creditdate','$country','$state','$pin','$gstno','$others','$data1','$created_by','$CURRENT_MILLIS')");

     
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


