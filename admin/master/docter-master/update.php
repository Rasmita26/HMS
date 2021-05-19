<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data']) && isset($_POST['id'])){
      $con=_connect();
      $data=get_object_vars(json_decode($_POST["data"]));

          $doctorname=$data['doctorname'];
          $specialist=$data['specialist'];
          $phone=$data['phone'];
          $qualification=$data['qualification'];
          $experience=$data['experience'];
          $city=$data['city'];
          $email=$data['email'];
          $time=$data['frmtime'];
 
          $time1=$data['totime'];
   
          $day = $_POST["data1"];
          $id = $_POST["id"];
          $pcheck=$data['pcheck'];
          $aadhar=$data['aadhar'];
          $pancard=$data['pancard'];
          $bankname=$data['bankname'];
          $accountno=$data['accountno'];
          $ifsc=$data['ifsc'];
          $designation=$data['designation'];
// echo "UPDATE doctor SET doctorname='$doctorname',specialist='$specialist', phone='$phone', qualification='$qualification', experience='$experience', city='$city', email='$email', designation='$designation',frmtime='$time',  totime='$time1', days='$day', pcheck='$pcheck', aadhar='$aadhar', pancard='$pancard', bankname='$bankname', accountno='$accountno', ifsc='$ifsc' WHERE id='$id'";
      
      $results= mysqli_query($con,"UPDATE doctor SET doctorname='$doctorname',specialist='$specialist', phone='$phone', qualification='$qualification', experience='$experience', city='$city', email='$email', designation='$designation',frmtime='$time',  totime='$time1', days='$day', pcheck='$pcheck', aadhar='$aadhar', pancard='$pancard', bankname='$bankname', accountno='$accountno', ifsc='$ifsc' WHERE id='$id'");
      
      if($results){
        echo '{"status":"success"}';
     }else{
         echo '{"status":"falid"}';
     }
     _close($con);
        }else{
       echo '{"status":"falid"}';
      }
?>


    