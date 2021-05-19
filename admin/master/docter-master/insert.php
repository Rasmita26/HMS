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
        $doctorname = get_object_vars($data)["doctorname"];
        $specialist = get_object_vars($data)["specialist"];
        $phone =get_object_vars($data)["phone"];
        $qualification =get_object_vars($data)["qualification"];
        $experience =get_object_vars($data)["experience"];
        $city =get_object_vars($data)["city"];
        $email =get_object_vars($data)["email"];
        $frmtime =get_object_vars($data)["frmtime"];
  
        $totime =get_object_vars($data)["totime"];
     
        $aadhar =get_object_vars($data)["aadhar"];
        $pancard =get_object_vars($data)["pancard"];
        $pcheck =get_object_vars($data)["pcheck"];
        $bankname =get_object_vars($data)["bankname"];
        $accountno =get_object_vars($data)["accountno"];
        $ifsc =get_object_vars($data)["ifsc"];
        
        $designation =get_object_vars($data)["designation"];
        
echo "INSERT INTO doctor(doctorname,specialist,phone,qualification,experience,city,email,designation,frmtime,totime,days,aadhar,pancard,pcheck,bankname,accountno,ifsc,created_by,created_time) VALUES
('$doctorname','$specialist','$phone','$qualification','$experience','$city','$email','$designation','$frmtime','$totime','$data1','$aadhar','$pancard','$pcheck','$bankname','$accountno','$ifsc','$created_by','$CURRENT_MILLIS')";
     $create=mysqli_query($con, "INSERT INTO doctor(doctorname,specialist,phone,qualification,experience,city,email,designation,frmtime,totime,days,aadhar,pancard,pcheck,bankname,accountno,ifsc,created_by,created_time) VALUES
      ('$doctorname','$specialist','$phone','$qualification','$experience','$city','$email','$designation','$frmtime','$totime','$data1','$aadhar','$pancard','$pcheck','$bankname','$accountno','$ifsc','$created_by','$CURRENT_MILLIS')");

    if ($create) {
      echo '{"status":"success"}';
    }else{
      echo '{"status":"falid1"}';
    }
            _close($con);
     }
     else{
        echo '{"status":"falid"}';
     }
?>