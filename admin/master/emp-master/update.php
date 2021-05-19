<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    
    if(isset($_POST['data'])&& isset($_POST['id']) ){
      $con=_connect();
      $data=get_object_vars(json_decode($_POST["data"]));

        $title=$data['title'];
        $fname=$data['fname'];
        $gender=$data['gender'];
        $role=$data['role'];
        $dob=$data['dob'];
        $address=$data['address'];
        $email=$data['email'];
        $password=$data['password'];
        $employeeid=$data['employeeid'];
        $joindate=$data['joindate'];
        $phone1=$data['phone1'];
        $phone2=$data['phone2'];
        $qualification=$data['qualification'];
        $experience=$data['experience'];
        $status=$data['status'];
        $id=$_POST['id'];

      $results= mysqli_query($con,"UPDATE employee SET  title='$title', fname='$fname', gender='$gender', role='$role', dob='$dob', address='$address', email='$email', password='$password', employeeid='$employeeid', joindate='$joindate', phone1='$phone1', phone2='$phone2', status='$status',experience='$experience',qualification='$qualification' WHERE id='$id'");
         
       if($results){
          echo '{"status":"success"}';
            }else{
                echo '{"status":"falid1"}';
            }
          _close($con);
        }else{
       echo '{"status":"falid"}';
      }
?>