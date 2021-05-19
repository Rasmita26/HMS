<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['medicineid']) ){
        $con=_connect();
        $medicineid =$_POST["medicineid"];
         //echo "SELECT stockqty x FROM `stock` where medicineid=$idno";
         $stockqty=mysqli_fetch_assoc(mysqli_query ($con, "SELECT stockqty x FROM `stock` where medicineid=$medicineid ORDER BY id DESC LIMIT 1 "))['x'];
         if ($stockqty) {
            echo '{"status":"success","quantity":"'.$stockqty.'"}';
        }
  }else{
      echo '{"status":"failed"}';
  }
?> 
