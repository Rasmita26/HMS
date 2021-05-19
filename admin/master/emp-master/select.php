<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM employee WHERE id='$id'"));
      if ($select) {
        
        $title=$select['title'];
        $fname=$select['fname'];
        $gender=$select['gender'];
        $role=$select['role'];
        $dob=$select['dob'];
        $address=$select['address'];
        $email=$select['email'];
        $password=$select['password'];
        $employeeid=$select['employeeid'];
        $joindate=$select['joindate'];
        $phone1=$select['phone1'];
        $phone2=$select['phone2'];
        $status=$select['status'];
        $qualification=$select['qualification'];
        $experience=$select['experience'];
        
        $str='{"title":"'.$title.'","fname":"'.$fname.'","gender":"'.$gender.'","role":"'.$role.'","dob":"'.$dob.'","address":"'.$address.'","email":"'.$email.'","password":"'.$password.'","employeeid":"'.$employeeid.'","joindate":"'.$joindate.'","phone1":"'.$phone1.'","phone2":"'.$phone2.'","status":"'.$status.'","qualification":"'.$qualification.'","experience":"'.$experience.'"}';
       
        echo '{"status":"success","json":['.$str.']}';
    }else{
        echo '{"status":"falid2"}';
      }
  }else{
      echo '{"status":"falid1"}';
  }
?>
