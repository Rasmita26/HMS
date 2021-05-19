<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

      if(isset($_POST['patientid']) && isset($_POST['date'])){

        $con = _connect();
        $id  = $_POST["patientid"];
        $date = $_POST["date"];

        $select = mysqli_fetch_assoc(mysqli_query($con, "SELECT hname,address,phoneno FROM hospital_details"));

        $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT DISTINCTROW patientid FROM billstock WHERE patientid='$id'"));
            if($result){
              $patientid = $result['patientid'];
             
            }
            $date1      = date('d-m-Y',strtotime($date));

        $patient = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM patient_details WHERE id='$id'"));
              
              $patient_name  = $patient['patient_name'];
              // $email  = $patient['email'];
              $mobileno1 = $patient['mobileno1'];
              $mobileno2 = $patient['mobileno2'];
              $billdetail='{"patientid":"'.$patientid.'","date":"'.$date1.'","patient_name":"'.$patient_name.'","mobileno1":"'.$mobileno1.'","mobileno2":"'.$mobileno2.'"}';

        $result1 = mysqli_query($con,"SELECT medicineid,billno,issueqty FROM `billstock` WHERE patientid='$id'");

            while($rows=mysqli_fetch_assoc($result1)){
              $medicineid =  $rows['medicineid'];
          
              $price      = mysqli_fetch_assoc(mysqli_query($con,"SELECT price x from medicine WHERE id='$medicineid'"))['x'];
              $billno     = $rows['billno'];
              $issueqty   = $rows['issueqty'];
              $amount     = $issueqty*$price;
             
              $json.=',{"billno":"'.$billno.'","amount":"'.$amount.'"}';
            }
            $json=substr($json,1);
            $json='['.$json.']';

        $result2=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `bed` WHERE pid='$id'"));
          if ($result2) {
               $assigndate    = date("d-m-Y",$result2['assign_time']/1000);
               $dischargedate = date("d-m-Y",$result2['discharge_time']/1000);
               $bedtype       = $result2['bedtype'];
               $roomtype      = $result2['roomtype'];
               $price         = $result2['price'];
              $bedjson ='{"assigndate":"'.$assigndate.'","dischargedate":"'.$dischargedate.'","bedtype":"'.$bedtype.'","roomtype":"'.$roomtype.'","price":"'.$price.'"}';
          }
          $result3=mysqli_query($con,"SELECT * FROM `surgery` WHERE uhid_no='$id'");
          while($rowss=mysqli_fetch_assoc($result3)){
               $date               = $rowss['date'];
               $operationrequired  = $rowss['operationrequired'];
               $patientcharges     = $rowss['patientcharges'];
              $surgeryjson.=',{"date":"'.$date.'","operationrequired":"'.$operationrequired.'","patientcharges":"'.$patientcharges.'"}';
          }
          $surgeryjson=substr($surgeryjson,1);
          $surgeryjson='['.$surgeryjson.']';
        // echo '{"status":"success","json":'.$json.',"billdetail":['.$billdetail.'],"hname":"'.$select['hname'].'","address":"'.$select['address'].'","phoneno":"'.$select['phoneno'].'","actualamount":"'.$sum['amt'].'","descamount":"'.$sum['disamt'].'","cgstamount":"'.$sum['cgstamount'].'","sgstamount":"'.$sum['sgstamount'].'","igstamount":"'.$sum['igstamount'].'","netamount":['.$netamount.']}';
        echo '{"status":"success","bedjson":'.$bedjson.',"surgeryjson":'.$surgeryjson.',"json":'.$json.',"billdetail":['.$billdetail.'],"hname":"'.$select['hname'].'","address":"'.$select['address'].'","phoneno":"'.$select['phoneno'].'"}';
        
      }else{
          echo '{"status":"failed"}';
        }
  
?>
