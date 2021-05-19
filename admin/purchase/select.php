<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['pono'])){
        $con=_connect();
        $pono =$_POST["pono"];
        $json='';
        $result=mysqli_query($con,"SELECT * FROM purchase WHERE pono='$pono'");
        while($select = mysqli_fetch_assoc($result)){
          $date=$select['purchasedate'];
          $supplier=$select['supplierid'];
          $medicineid=$select['medicineid'];
          $quantity=$select['quantity'];
          $unit=$select['unit'];
          $rate=$select['rate'];
          $actualamount=$select['actual_amount'];
          $drate=$select['descper'];
          $damount=$select['descamt'];
          $amountafterdesc=$select['amount_afterdesc'];
          $cgstper=$select['cgstper'];
          $cgstamt=$select['cgstamt'];
          $sgstper=$select['sgstper'];
          $sgstamt=$select['sgstamt'];
          $igstper=$select['igstper'];
          $igstamt=$select['igstamt'];
          $netamount=$select['netamount'];
          $json.=',{"date":"'.$date.'","supplier":"'.$supplier.'","medicineid":"'.$medicineid.'","quantity":"'.$quantity.'","unit":"'.$unit.'","rate":"'.$rate.'","actualamount":"'.$actualamount.'","drate":"'.$drate.'","damount":"'.$damount.'","amountafterdesc":"'.$amountafterdesc.'","cgstper":"'.$cgstper.'","cgstamt":"'.$cgstamt.'","sgstper":"'.$sgstper.'","sgstamt":"'.$sgstamt.'","igstper":"'.$igstper.'","igstamt":"'.$igstamt.'","netamount":"'.$netamount.'"}';
       }
       $json=substr($json,1);
       $json='['.$json.']';
      if ($result) {
        echo '{"status":"success","json":'.$json.'}';
    }else{
        echo '{"status":"failed"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }
?> 



