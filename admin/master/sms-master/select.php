<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
        // echo "SELECT * FROM room WHERE id='$id'";
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM ambulance WHERE id='$id'"));
      if ($select) {

        $drivername=($select)["drivername"];
          $vehiclename=($select)["vehiclename"];
          $phoneno=($select)["phoneno"];
          $vehicleno=($select)["vehicleno"];
          $email=($select)["email"];
          $address=($select)["address"];
          $description=($select)["description"];
          $organisation=($select)["organisation"];
          $o_phone=($select)["o_phone"];
          $o_email=($select)["o_email"];
          $supportingperson=($select)["supportingperson"];
          $facility=($select)["facility"];
            // echo '{"drivername":"'.$drivername.'","vehiclename":"'.$vehiclename.'","phoneno":"'.$phoneno.'","vehicleno":"'.$vehicleno.'","email":"'.$email.'","address":"'.$address.'","description":"'.$description.'","organisation":"'.$organisation.'","o_phone":"'.$o_phone.'","o_email":"'.$o_email.'","supportingperson":"'.$supportingperson.'","facilities":"'.$facilities.'"}';

          
         $str='{"drivername":"'.$drivername.'","vehiclename":"'.$vehiclename.'","phoneno":"'.$phoneno.'","vehicleno":"'.$vehicleno.'","email":"'.$email.'","address":"'.$address.'","description":"'.$description.'","organisation":"'.$organisation.'","o_phone":"'.$o_phone.'","o_email":"'.$o_email.'","supportingperson":"'.$supportingperson.'","facility":'.$facility.'}';


        echo '{"status":"success","json":['.$str.']}';
      
    }else{
        echo '{"status":"failed"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }
?> 
