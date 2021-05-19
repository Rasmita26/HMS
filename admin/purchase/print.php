<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['id'])){
        $con=_connect();
        $id =$_POST["id"];
    
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT hname,address,phoneno FROM hospital_details"));

  $result=mysqli_fetch_assoc(mysqli_query($con,"SELECT DISTINCTROW pono,purchasedate,supplierid FROM purchase WHERE pono='$id'"));
  if($result){
    $supplierid=$result['supplierid'];
    $pono=$result['pono'];
    $date=date("d-m-Y",strtotime($result['purchasedate']));
    $date1=$result['purchasedate'];

    $supplier=mysqli_fetch_assoc(mysqli_query($con,"SELECT * from supplier WHERE id='$supplierid'"));
    $sname=$supplier['sname'];
    $address=$supplier['address'];
    $semail=$supplier['semail'];
    $phoneno=$supplier['phoneno'];
    $purchasedetail='{"pono":"'.$pono.'","purchasedate":"'.$date.'","sname":"'.$sname.'","semail":"'.$semail.'","supplierphoneno":"'.$phoneno.'"}';
    
    
    $result1=mysqli_query($con,"SELECT medicineid,unit,quantity,rate,actual_amount,amount_afterdesc,cgstamt,sgstamt,igstamt,netamount FROM `purchase` WHERE pono='$pono' AND purchasedate='$date1' AND supplierid='$supplierid'");

    while($rows=mysqli_fetch_assoc($result1)){
      $medicineid=  $rows['medicineid'];
      $name=mysqli_fetch_assoc(mysqli_query($con,"SELECT name x from medicine WHERE id='$medicineid'"))['x'];
      $quantity = $rows['quantity'];
      $rate     = $rows['rate'];
      $json.=',{"name":"'.$name.'","qty":"'.$quantity.'","rate":"'.$rate.'"}';
      
    }
  }
  $json=substr($json,1);
  $json='['.$json.']';




  $sum=mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(actual_amount) as amt, SUM(descamt) as disamt , SUM(cgstamt) as cgstamount, SUM(sgstamt) as sgstamount,SUM(igstamt) as igstamount FROM `purchase` WHERE pono='$pono'"));

  $actual_amount=$sum['amt'];
  $desc_amount=$sum['disamt'];
  $cgst_amount=$sum['cgstamount'];
  $sgst_amount=$sum['sgstamount'];
  $igst_amount=$sum['igstamount'];
  $netamount=$actual_amount-$desc_amount+($cgst_amount+$sgst_amount+$igst_amount);
 



  

      echo '{"status":"success","json":'.$json.',"purchasedetail":['.$purchasedetail.'],"hname":"'.$select['hname'].'","address":"'.$select['address'].'","phoneno":"'.$select['phoneno'].'","actualamount":"'.$sum['amt'].'","descamount":"'.$sum['disamt'].'","cgstamount":"'.$sum['cgstamount'].'","sgstamount":"'.$sum['sgstamount'].'","igstamount":"'.$sum['igstamount'].'","netamount":['.$netamount.']}';
      
    }else{
        echo '{"status":"failed"}';
      }
  
?> 



