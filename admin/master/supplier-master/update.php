<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    
    if(isset($_POST['data'])&& isset($_POST['id']) && isset($_POST['data1'])){
      $con=_connect();
      $data=get_object_vars(json_decode($_POST['data']));
      $data1=$_POST['data1'];
      $id           =$_POST['id'];
      $sname        =$data['sname'];
      $address      =json_encode($data['address']);
      $phone        =$data['phone'];
      $email       =$data['email'];
      $cpancard     =$data['cpancard'];
      $creditdate   =$data['creditdate'];
      $state        =$data['state'];
      $country      =$data['country'];
      $pin      =$data['pin'];
      $gstno       =$data['gstno'];
      $others       =$data['others'];
      $cname        =$data['cname'];  

    //    echo "UPDATE supplier SET  sname='$sname', address='$address', phoneno='$phone', semail='$email', cpancard='$cpancard', creditdate='$creditdate', country='$country', state='$state', pin_no='$pin', gst_no='$gstno', others='$others',cname='$data1' WHERE id='$id'";
         

      $results= mysqli_query($con,"UPDATE supplier SET  sname='$sname', address='$address', phoneno='$phone', semail='$email', cpancard='$cpancard', creditdate='$creditdate', country='$country', state='$state', pin_no='$pin', gst_no='$gstno', others='$others',cname='$data1' WHERE id='$id'");
         
       if($results){
          echo '{"status":"success"}';
            }else{
                echo '{"status":"failed"}';
            }
          _close($con);
        }else{
       echo '{"status":"failed1"}';
      }
?>