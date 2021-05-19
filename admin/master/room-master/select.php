<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM room WHERE id='$id'"));
      if ($select) {
        $room=$select['room'];
        $roomtype=$select['roomtype'];
        $countno=$select['countno'];
        $price=$select['price'];

        $str='{"rooom":"'.$room.'","roomtype":"'.$roomtype.'","countno":"'.$countno.'","price":"'.$price.'"}';


        echo '{"status":"success","json":['.$str.']}';
      
    }else{
        echo '{"status":"failed"}';
      }
  }else{
      echo '{"status":"failed2"}';
  }
?> 
