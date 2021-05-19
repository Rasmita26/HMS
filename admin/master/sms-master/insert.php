<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    if(isset($_POST['data']) && isset($_POST['data1'])){
        $con=_connect();
        if (session_status()==PHP_SESSION_NONE) { session_start(); }
  
        $created_by=$_SESSION['id'];
        $data1 =$_POST["data1"];
        $data =json_decode($_POST["data"]);

        
          $drivername = get_object_vars($data)["drivername"];
          $vehiclename = get_object_vars($data)["vehiclename"];
          $phoneno =get_object_vars($data)["phoneno"];
          $vehicleno =get_object_vars($data)["vehicleno"];
          $email =get_object_vars($data)["email"];
          $address=get_object_vars($data)["address"];
          $description=get_object_vars($data)["description"];
          $organisation =get_object_vars($data)["organisation"];
          $o_phone =get_object_vars($data)["o_phone"];
          $o_email =get_object_vars($data)["o_email"];
          $supportingperson =get_object_vars($data)["supportingperson"];
          
          // echo "INSERT INTO ambulance(drivername,vehiclename,phoneno,vehicleno,email,address,description,organisation,o_phone,o_email,supportingperson,facility,created_by,created_time) VALUES
          // ('$drivername','$vehiclename','$phoneno','$vehicleno','$email','$address','$description','$organisation','$o_phone','$o_email','$supportingperson','$data1','$created_by','$CURRENT_MILLIS')";     

   $create=mysqli_query($con, "INSERT INTO ambulance(drivername,vehiclename,phoneno,vehicleno,email,address,description,organisation,o_phone,o_email,supportingperson,facility,created_by,created_time) VALUES
          ('$drivername','$vehiclename','$phoneno','$vehicleno','$email','$address','$description','$organisation','$o_phone','$o_email','$supportingperson','$data1','$created_by','$CURRENT_MILLIS')"); 
          

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
      