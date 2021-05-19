<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data']) && isset($_POST['id'])){
      $con=_connect();
      $data=get_object_vars(json_decode($_POST["data"]));

      $room=$data['room'];
      $roomtype=$data['roomtype'];
      $countno=$data['countno'];
      $price=$data['price'];
      $id=$_POST['id'];


      $results= mysqli_query($con,"UPDATE room SET room='$room', roomtype='$roomtype', countno='$countno', price='$price'  WHERE id='$id'");

      
      if($results){
        echo '{"status":"success"}';
     }else{
         echo '{"status":"falid"}';
     }
 
  
     _close($con);
        }else{
       echo '{"status":"falid"}';
      }
?>

