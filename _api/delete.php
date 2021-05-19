<?php
    $base='../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
        if (session_status()==PHP_SESSION_NONE) { session_start(); }

        $removed_by=$_SESSION['id'];

      $delete=mysqli_query($con, "UPDATE `appointment` SET removed_by='$removed_by',removed_time='$CURRENT_MILLIS' WHERE id='$id'");
      if ($delete) {
        echo '{"status":"success"}';
      }else{
        echo '{"status":"falid1"}';
      }
  }else{
      echo '{"status":"falid1"}';
  }
?>
