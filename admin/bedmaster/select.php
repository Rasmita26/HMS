<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['idno']) ){
        $con=_connect();
        $idno =$_POST["idno"];
         $countno=mysqli_fetch_assoc(mysqli_query ($con, "SELECT countno x FROM `room` where id=$idno"))['x'];
         echo '{"status":"success","countno":"'.$countno.'"}';
  }else{
      echo '{"status":"failed"}';
  }
?> 



