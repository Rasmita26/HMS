

<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM supplier WHERE id='$id'"));
      if ($select) {
        $id           =$select['id'];
        $sname        =$select['sname'];
        $address      =json_encode($select['address']);
        $phoneno      =$select['phoneno'];
        $semail       =$select['semail'];
        $cpancard     =$select['cpancard'];
        $creditdate   =$select['creditdate'];
        $state        =$select['state'];
        $country      =$select['country'];
        $pin_no       =$select['pin_no'];
        $gst_no       =$select['gst_no'];
        $others       =$select['others'];
        $cname        =$select['cname'];

        $str='{"id":"'.$id.'","sname":"'.$sname.'","address":'.$address.',"phoneno":"'.$phoneno.'","semail":"'.$semail.'","cpancard":"'.$cpancard.'","creditdate":"'.$creditdate.'","state":"'.$state.'","country":"'.$country.'","pin_no":"'.$pin_no.'","gst_no":"'.$gst_no.'","others":"'.$others.'"}';  
        echo '{"status":"success","json":['.$str.'],"cname":'.$cname.'}';
      
    }else{
        echo '{"status":"falid2"}';
      }
  }else{
      echo '{"status":"falid1"}';
  }
?>

