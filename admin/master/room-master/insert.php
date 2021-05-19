<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    if(isset($_POST['data'])){
        $con=_connect();
        if (session_status()==PHP_SESSION_NONE) { session_start(); }
  
        $created_by=$_SESSION['id'];
  
    
  
        $data =json_decode($_POST["data"]);
        $room = get_object_vars($data)["room"]; 
    $roomtype = get_object_vars($data)["roomtype"];
  //  echo  $doctorname;
    $countno =get_object_vars($data)["countno"];
    $price =get_object_vars($data)["price"];

   //  echo "INSERT INTO room(room,roomtype,countno,price,created_by,created_time) VALUES ('$room','$roomtype','$countno','$price','$created_by','$CURRENT_MILLIS')";


   $create=mysqli_query($con, "INSERT INTO room(room,roomtype,countno,price,created_by,created_time) VALUES ('$room','$roomtype','$countno','$price','$created_by','$CURRENT_MILLIS')");


     
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