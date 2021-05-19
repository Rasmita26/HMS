<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
       
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM doctor WHERE id='$id'"));
     
      if ($select) {
          $doctorname=$select['doctorname'];
          $specialist=$select['specialist'];
          $phone=$select['phone'];
          $qualification=$select['qualification'];
          $experience=$select['experience'];
          $city=$select['city'];
          $email=$select['email'];
          $frmtime=$select['frmtime'];
          // $time2= date('h:i a', $time/1000);
          // echo $time2;
          // $time2 =date("H:i", $time / 1000);
          $totime=$select['totime'];
          // $time3 =date('h:i a', $time1/1000);
          $days=$select['days'];
          $aadhar=$select['aadhar'];
          $pancard=$select['pancard'];
          $pcheck=$select['pcheck'];
          $bankname=$select['bankname'];
          $accountno=$select['accountno'];
          $ifsc=$select['ifsc'];
          $designation=$select['designation'];
    $str='{"doctorname":"'.$doctorname.'","specialist":"'.$specialist.'","phone":"'.$phone.'","qualification":"'.$qualification.'","experience":"'.$experience.'","city":"'.$city.'","email":"'.$email.'","frmtime":"'.$frmtime.'","totime":"'.$totime.'","days":'.$days.',"aadhar":"'.$aadhar.'","pancard":"'.$pancard.'","pcheck":"'.$pcheck.'","bankname":"'.$bankname.'","accountno":"'.$accountno.'","ifsc":"'.$ifsc.'","designation":"'.$designation.'"}';

      echo '{"status":"success","json":['.$str.']}';
        }else{
          echo '{"status":"falid2"}';
          }
    }else{
       echo '{"status":"falid1"}';
  }
?>
