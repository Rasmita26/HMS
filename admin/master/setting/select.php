<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

        $con=_connect();
     
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM hospital_details"));
      if ($select) {
        $id           =$select['id'];
        $hname        =$select['hname'];
        $address      =json_encode($select['address']);
        $phoneno      =$select['phoneno'];
        $cpancard     =$select['cpancard'];
        
        $state        =$select['state'];
        $country      =$select['country'];
        $pin_no       =$select['pin_no'];
        $gst_no       =$select['gst_no'];
        $others       =$select['others'];
        $cname        =$select['cname'];

        $str='{"id":"'.$id.'","name":"'.$hname.'","address":'.$address.',"phoneno":"'.$phoneno.'","cpancard":"'.$cpancard.'","state":"'.$state.'","country":"'.$country.'","pin_no":"'.$pin_no.'","gst_no":"'.$gst_no.'","others":"'.$others.'"}';  
        echo '{"status":"success","json":['.$str.'],"cname":'.$cname.'}';
      
    }else{
        echo '{"status":"falid2"}';
      }
  
?> 
