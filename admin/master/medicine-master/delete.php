<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
       
        $delete=mysqli_query($con, "DELETE FROM medicine WHERE id='$id'");
      if ($delete) {
        echo '{"status":"success"}';
      }else{
        echo '{"status":"falid2"}';
      }
  }else{
      echo '{"status":"falid1"}';
  }
?> 
