<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
       
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM medicine WHERE id='$id'"));
      if ($select) {
            $name=$select['name'];
            $category=$select['category'];
            $description=$select['description'];
            $quantity=$select['quantity'];
            $price=$select['price'];
            $manufactured=$select['manufactured'];
            $status=$select['status'];
            $units=$select['units'];
            $minimumorder=$select['minimumorder'];
            $minimumstock=$select['minimumstock'];
            $gstrate=$select['gstrate'];

        $str='{"name":"'.$name.'","category":"'.$category.'","description":"'.$description.'","quantity":"'.$quantity.'","price":"'.$price.'","manufactured":"'.$manufactured.'","units":"'.$units.'","status":"'.$status.'","minimumorder":"'.$minimumorder.'","minimumstock":"'.$minimumstock.'","gstrate":"'.$gstrate.'"}';  
        echo '{"status":"success","json":['.$str.']}';   
    }else{
        echo '{"status":"falid2"}';
      }
  }else{
      echo '{"status":"falid1"}';
  }
?> 

