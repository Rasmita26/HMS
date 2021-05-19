<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data']) && isset($_POST['data1']) && isset($_POST['pid']) && isset($_POST['date']) && isset($_POST['operation']) && isset($_POST['totalbill'])){

        $con=_connect();
     
       if (session_status()==PHP_SESSION_NONE) { session_start(); }   
        $created_by=$_SESSION['id'];

        $data=$_POST['data'];  
        $data1=$_POST['data1']; 
        
        $pid=$_POST['pid']; 
        $operation=$_POST['operation']; 
        $totalbill=$_POST['totalbill']; 
        $date=$_POST['date']; 
      //  echo  "INSERT INTO surgery(uhid_no,operationrequired,date,patientcharges,doctor_details,material_details,created_by,created_time) VALUES
      //   ('$pid','$operation','$date','$totalbill','$data','$data1','$created_by','$CURRENT_MILLIS')"; 
        
        $create=mysqli_query($con,"INSERT INTO surgery(uhid_no,operationrequired,date,patientcharges,doctor_details,material_details,created_by,created_time) VALUES
        ('$pid','$operation','$date','$totalbill','$data','$data1','$created_by','$CURRENT_MILLIS')"); 
        
        if ($create) {
          echo '{"status":"success"}';
        }else{
          echo '{"status":"failed"}';
        }
        _close($con);
      }
      else{
         echo '{"status":"failed"}';
      }
 ?>
    