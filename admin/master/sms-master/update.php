<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data'])  && isset($_POST['id'])){
      $con=_connect();
      $data=get_object_vars(json_decode($_POST["data"]));
   
      $id=$_POST['id'];
      $drivername=$data["drivername"];
      $vehiclename=$data["vehiclename"];
      $phoneno=$data["phoneno"];
      $vehicleno=$data["vehicleno"];
      $email=$data["email"];
      $address=$data["address"];
      $description=$data["description"];
      $organisation=$data["organisation"];
      $o_phone=$data["o_phone"];
      $o_email=$data["o_email"];
      $supportingperson=$data["supportingperson"];
      $facility = $_POST["data1"];
     
      $results= mysqli_query($con,"UPDATE ambulance SET drivername='$drivername', vehiclename='$vehiclename', phoneno='$phoneno', vehicleno='$vehicleno' , email='$email', address='$address', description='$description', organisation='$organisation', o_phone='$o_phone', o_email='$o_email', supportingperson='$supportingperson', facility='$facility'  WHERE id='$id'");

      
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