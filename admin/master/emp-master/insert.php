<?php $base='../../../';
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

      $title=get_object_vars($data)["title"];
      $fname=get_object_vars($data)["fname"];
      $gender=get_object_vars($data)["gender"];
      $role=get_object_vars($data)["role"];
      $dob=get_object_vars($data)["dob"];
      $address=get_object_vars($data)["address"];
      $email=get_object_vars($data)["email"];
      $password=get_object_vars($data)["password"];
      $employeeid=get_object_vars($data)["employeeid"];
      $joindate=get_object_vars($data)["joindate"];
      $phone1=get_object_vars($data)["phone1"];
      $phone2=get_object_vars($data)["phone2"];
      $status=get_object_vars($data)["status"];
      $qualification=get_object_vars($data)["qualification"];
      $experience=get_object_vars($data)["experience"];

  $create=mysqli_query($con, "INSERT INTO employee(title,fname,gender,role,dob,address,email,password,employeeid,joindate,phone1,phone2,status,qualification,experience,created_by,created_time) VALUES
('$title', '$fname', '$gender', '$role', '$dob', '$address', '$email', '$password', '$employeeid', '$joindate', '$phone1', '$phone2', '$status', '$qualification', '$experience', '$created_by', '$CURRENT_MILLIS')");

    if ($create) {
      $id=mysqli_fetch_assoc(mysqli_query($con, "SELECT max(id) x FROM employee"))['x'];
      $pathaadharproof=getcwd()."/images/user/aadhar/".$id.'.jpg';
      $pathpanproof=getcwd()."/images/user/pan/".$id.'.jpg';
      $pathphotoproof=getcwd()."/images/user/pic/".$id.'.jpg';
      move_uploaded_file($_FILES['file1']['tmp_name'], $pathaadharproof);
      move_uploaded_file($_FILES['file2']['tmp_name'], $pathpanproof);
      move_uploaded_file($_FILES['file3']['tmp_name'], $pathphotoproof);

      echo '{"status":"success"}';
    }
    else {
      echo '{"status":"falid1"}';
    }
    _close($con);
  }
  else {
    echo '{"status":"falid"}';
  }

  ?>
