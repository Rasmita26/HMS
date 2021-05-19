<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    if(isset($_POST['data'])){
        $con=_connect();
        if (session_status()==PHP_SESSION_NONE) { session_start(); }
  
        $created_by=$_SESSION['id'];
  
    
  
        $data =json_decode($_POST["data"]);
        $patientid= get_object_vars($data)["patientid"]; 
    $reason = get_object_vars($data)["reason"];
  //  echo  $doctorname;
    $name =get_object_vars($data)["name"];
    $mobile =get_object_vars($data)["mobile"];

   //  echo "INSERT INTO room(room,roomtype,countno,price,created_by,created_time) VALUES ('$room','$roomtype','$countno','$price','$created_by','$CURRENT_MILLIS')";


   $create=mysqli_query($con, "INSERT INTO emergency(patientid,reason,name,mobile,created_by,created_time) VALUES ('$patientid','$reason','$name','$mobile','$created_by','$CURRENT_MILLIS')");


     
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