<?php
    $base='../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['doctorname']) && isset($_POST['phone']) && isset($_POST['qual']) && isset($_POST['exp']) && isset($_POST['city']) && isset($_POST['email']) && isset($_POST['time']) && isset($_POST['day']) && isset($_POST['aadhar']) && isset($_POST['pan']) && isset($_POST['check']) && isset($_POST['bankname']) && isset($_POST['accountno']) && isset($_POST['ifsc'])){
      $con=_connect();
     
      if (session_status()==PHP_SESSION_NONE) { session_start(); }

      $created_by=$_SESSION['id'];

      $doctorname =$_POST["doctorname"];
      $phone =$_POST["phone"];
      $qual =$_POST["qual"];
      $exp =$_POST["exp"];
      $city =$_POST["city"];
      $email =$_POST["email"];
      $time =$_POST["time"];
      $day =$_POST["day"];
      $aadhar =$_POST["aadhar"];
      $pan =$_POST["pan"];
      $check =$_POST["check"];
      $bname =$_POST["bname"];
      $account =$_POST["account"];
      $ifse =$_POST["ifse"];

    $create=mysqli_query($con, "INSERT INTO doctor(doctorname,phone,qualification,exp,city,email,time,days,aadhar,pan,pcheck,bname,account,ifse,created_by,created_time) VALUES
     ('$doctorname','$phone','$qual','$exp','$city','$email',$time','$day','$aadhar','$pan','$check','$bname','$account','$ifse',$created_by','$CURRENT_MILLIS')");

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