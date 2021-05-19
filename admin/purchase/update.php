<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data']) && isset($_POST['data1']) ){
    $con=_connect();
       if (session_status()==PHP_SESSION_NONE) { session_start(); }   

        $created_by=$_SESSION['id'];
        $data=json_decode($_POST['data']); 
        $data1=json_decode($_POST['data1']); 

        $date=get_object_vars($data1)['date'];
        $supplier=get_object_vars($data1)['supplier'];
        $pono=get_object_vars($data1)['pono'];
        mysqli_query($con,"DELETE FROM purchase where pono='$pono' ");
        foreach($data as $i){
          // $date = get_object_vars($i)["purchasedate"];
          // $supplier =get_object_vars($i)["supplierid"];
          $medicineid =get_object_vars($i)["medicineid"];
          $qty =get_object_vars($i)["quantity"];
          $unit=get_object_vars($i)["unit"];
          $rate=get_object_vars($i)["rate"];
          $amount=get_object_vars($i)["amount"];
          $drate=get_object_vars($i)["drate"];
          $damount=get_object_vars($i)["damount"];
          $amount_afterdesc=get_object_vars($i)["amountafterdis"];
          $cgstper=get_object_vars($i)["cgstper"];
          $cgstamount=get_object_vars($i)["cgstamount"];
          $sgstper=get_object_vars($i)["sgstper"];
          $sgstamount=get_object_vars($i)["sgstamount"];
          $igstper=get_object_vars($i)["igstper"];
          $igstamount=get_object_vars($i)["igstamount"];
          $netamount=get_object_vars($i)["netamount"];

//  echo "INSERT INTO purchase (purchasedate,supplierid,medicineid,unit,quantity,rate,actual_amount,descper,descamt,amount_afterdesc,cgstper,cgstamt,igstper,igstamt,netamount,created_by,created_time) VALUES('$date','$supplier','$medicineid','$unit','$qty','$rate','$amount','$drate','$damount','$amount_afterdesc','$cgstper','$cgstamount','$sgstper','$sgstamount','$igstper','$igstamount','$netamount','$created_by','$CURRENT_MILLIS')";
         $create=mysqli_query($con, "INSERT INTO purchase (pono,purchasedate,supplierid,medicineid,unit,quantity,rate,actual_amount,descper,descamt,amount_afterdesc,cgstper,cgstamt,sgstper,sgstamt,igstper,igstamt,netamount,created_by,created_time) VALUES
          ('$pono','$date','$supplier','$medicineid','$unit','$qty','$rate','$amount','$drate','$damount','$amount_afterdesc','$cgstper','$cgstamount','$sgstper','$sgstamount','$igstper','$igstamount','$netamount','$created_by','$CURRENT_MILLIS')");
        } 
         echo '{"status":"success"}';
            _close($con);
         }else{
            echo '{"status":"failed1"}';
         }
?>