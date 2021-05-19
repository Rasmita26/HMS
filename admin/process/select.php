<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient_details WHERE id='$id'"));
      if ($select) {
        
     
        $registration_date =$select['registration_date'];
        $uhid_no           =$select['uhid_no'];
        $patient_name      =$select['patient_name'];
        $relative_name     =$select['relative_name'];
        $gender            =$select['gender'];
        $address           =$select['address'];
        $mobileno1         =$select['mobileno1'];
        $mobileno2         =$select['mobileno2'];
        $dob               =$select['dob'];
        $age               =$select['age'];
        $consulting_doctor =$select['consulting_doctor'];
        $reffered_by       =$select['reffered_by'];
        $disease           =$select['disease'];
        $type              =$select['type'];
        $deposit           =$select['deposit'];
        
        $str='{"registration_date":"'.$registration_date.'","uhid_no":"'.$uhid_no.'","patient_name":"'.$patient_name.'","relative_name":"'.$relative_name.'","address":"'.$address.'","gender":"'.$gender.'","deposit":"'.$deposit.'","dob":"'.$dob.'","age":"'.$age.'","mobileno1":"'.$mobileno1.'","mobileno2":"'.$mobileno2.'","disease":"'.$disease.'","consulting_doctor":"'.$consulting_doctor.'","reffered_by":"'.$reffered_by.'"}';
       
       
        echo '{"status":"success","json":['.$str.']}';
    }else{
        echo '{"status":"failed"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }
?>
