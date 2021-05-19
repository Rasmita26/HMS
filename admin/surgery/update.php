<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data']) && isset($_POST['data1']) && isset($_POST['uhid_no1']) && isset($_POST['uhid_no']) && isset($_POST['date']) && isset($_POST['operation']) && isset($_POST['totalbill'])){

        $con=_connect();
     
       if (session_status()==PHP_SESSION_NONE) { session_start(); }   
        $created_by=$_SESSION['id'];

        $data=$_POST['data'];  
        $data1=$_POST['data1']; 
        
        $uhid_no=$_POST['uhid_no']; 
        $uhid_no1=$_POST['uhid_no1']; 
        $operation=$_POST['operation']; 
        $totalbill=$_POST['totalbill']; 
        $date=$_POST['date']; 

        
    //    echo "UPDATE surgery SET uhid_no='$uhid_no',operationrequired='$operation',date='$date',patientcharges='$totalbill',doctor_details='$data',material_details='$data1' where uhid_no='$uhid_no1'";
        
        $create=mysqli_query($con,"UPDATE surgery SET uhid_no='$uhid_no',operationrequired='$operation',date='$date',patientcharges='$totalbill',doctor_details='$data',material_details='$data1' where uhid_no='$uhid_no1'");
        
        if ($create) {
          echo '{"status":"success"}';
        }else{
          echo '{"status":"failed"}';
        }
        _close($con);
      }
      else{
         echo '{"status":"failed1"}';
      }
 ?>
    