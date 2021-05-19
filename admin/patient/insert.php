<?php $base='../../';
include($base.'_in/connect.php');
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_POST['data'])) {
  $con=_connect();

  if (session_status()==PHP_SESSION_NONE) {
    session_start();
  }

  $created_by=$_SESSION['id'];

  $data=json_decode($_POST["data"]);

   $registration_date=get_object_vars($data)["registration_date"];
   $registration_date1 =strtotime($registration_date)*1000;
   $uhid_no          =get_object_vars($data)["uhid_no"];
   $patient_name     =get_object_vars($data)["patient_name"];
   $relative_name    =get_object_vars($data)["relative_name"];
   $gender           =get_object_vars($data)["gender"];
   $address          =get_object_vars($data)["address"];
   $mobileno1        =get_object_vars($data)["mobileno1"];
   $mobileno2        =get_object_vars($data)["mobileno2"];
   $dob              =get_object_vars($data)["dob"];
   $dob1 =strtotime($dob)*1000;
   $age              =get_object_vars($data)["age"];
   $consulting_doctor=get_object_vars($data)["consulting_doctor"];
   $reffered_by      =get_object_vars($data)["reffered_by"];
   $disease          =get_object_vars($data)["disease"];
   $type             =get_object_vars($data)["type"];
   $deposit          =get_object_vars($data)["deposit"];

//  echo "INSERT INTO patient_details(registration_date,uhid_no,patient_name,relative_name,gender,address,mobileno1,mobileno2,dob,age,consulting_doctor,reffered_by,disease,type,deposit,created_by,created_time) VALUES
  //  ('$registration_date', '$uhid_no', '$patient_name', '$relative_name', '$gender', '$address', '$mobileno1', '$mobileno2', '$dob','$age', '$consulting_doctor','$reffered_by','$disease','$type','$deposit','$created_by', '$CURRENT_MILLIS')";

  $create=mysqli_query($con, "INSERT INTO patient_details(registration_date,uhid_no,patient_name,relative_name,gender,address,mobileno1,mobileno2,dob,age,consulting_doctor,reffered_by,disease,type,deposit,created_by,created_time) VALUES
('$registration_date1', '$uhid_no', '$patient_name', '$relative_name', '$gender', '$address', '$mobileno1', '$mobileno2', '$dob1','$age', '$consulting_doctor','$reffered_by','$disease','$type','$deposit','$created_by', '$CURRENT_MILLIS')");


    if ($create) {
      $id=mysqli_fetch_assoc(mysqli_query($con, "SELECT max(id) x FROM patient_details"))['x'];
      echo '{"status":"success","pid":"'.$id.'"}';
    }

    else {
      echo '{"status":"failed1"}';
    }

    _close($con);
  }

  else {
    echo '{"status":"failed"}';
  }

  ?>