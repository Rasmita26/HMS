<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
      if( isset($_POST['bedno']) && isset($_POST['dischargedate']) && isset($_POST['dischargetime'])){
      $con=_connect();
      $bedno=$_POST['bedno'];

      $dischargedate =$_POST["dischargedate"]+ $_POST["dischargetime"];
      // echo "UPDATE bed SET discharge_time='$dischargedate' WHERE bedno='$bedno'";

      $results= mysqli_query($con,"UPDATE bed SET discharge_time='$dischargedate' WHERE bedno='$bedno'");
      
    

      if($results){
        echo '{"status":"success"}';
     }else{
         echo '{"status":"failed"}';
     }
 
  
     _close($con);
        }else{
       echo '{"status":"failed1"}';
      }
?>


    