
<?php
    $base='../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['mobile']) && isset($_POST['password'])){
      $con=_connect();
      $mobile =$_POST["mobile"];
      $password =$_POST["password"];

      $result=mysqli_fetch_assoc(mysqli_query($con,"SELECT id, mobile, username, role FROM login WHERE mobile='$mobile' AND password='$password'"));
      if($result){
        session_start();
        $_SESSION['id'] =  $result['id'];
        $_SESSION['mobile'] =  $mobile['mobile'];
        $_SESSION['username'] =  $result['username'];
        $_SESSION['role'] =  $result['role'];
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