<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    
    if(isset($_POST['data'])&& isset($_POST['id']) ){
      $con=_connect();
      $data=get_object_vars(json_decode($_POST["data"]));

      
      $registration_date =$data['registration_date'];
      $uhid_no           =$data['uhid_no'];
      $patient_name      =$data['patient_name'];
      $relative_name     =$data['relative_name'];
      $gender            =$data['gender'];
      $address           =$data['address'];
      $mobileno1         =$data['mobileno1'];
      $mobileno2         =$data['mobileno2'];
      $dob               =$data['dob'];
      $age               =$data['age'];
      $consulting_doctor =$data['consulting_doctor'];
      $reffered_by       =$data['reffered_by'];
      $disease           =$data['disease'];
      $type              =$data['type'];
      $deposit           =$data['deposit'];
      $id=$_POST['id'];
 echo "UPDATE patient_details SET  registration_date='$registration_date', uhid_no='$uhid_no', patient_name='$patient_name', relative_name='$relative_name', gender='$gender', address='$address', mobileno1='$mobileno1', age='$age', mobileno2='$mobileno2', dob='$dob',age='$age',consulting_doctor='$consulting_doctor',reffered_by='$reffered_by', type='$type',deposit='$deposit',disease='$disease' WHERE id='$id'";
      $results= mysqli_query($con,"UPDATE patient_details SET  registration_date='$registration_date', uhid_no='$uhid_no', patient_name='$patient_name', relative_name='$relative_name', gender='$gender', address='$address', mobileno1='$mobileno1', age='$age', mobileno2='$mobileno2', dob='$dob',age='$age',consulting_doctor='$consulting_doctor',reffered_by='$reffered_by', type='$type',deposit='$deposit',disease='$disease' WHERE id='$id'");
         
       if($results){
          echo '{"status":"success"}';
            }else{
                echo '{"status":"failed"}';
            }
          _close($con);
        }else{
       echo '{"status":"falid"}';
      }
?>