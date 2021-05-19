<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    
    if(isset($_POST['patientid'])){
        $con=_connect();
        $id =$_POST["patientid"];
       
        $str='';
        
          $query="SELECT DATE_FORMAT(billdate,'%d/%m/%Y') as billdate,billno as description,((SELECT price FROM medicine WHERE medicine.id= billstock.medicineid)*issueqty) as amount FROM billstock WHERE patientid='$id' UNION SELECT CONCAT(DATE_FORMAT(FROM_UNIXTIME(assign_time/1000),'%d/%m/%Y %r'),' TO ',DATE_FORMAT(FROM_UNIXTIME(discharge_time/1000),'%d/%m/%Y %r')) as billdate , CONCAT(bedtype,' , ',roomtype,', ',bedno) as description, Sum(price) as amount FROM bed WHERE pid='$id' UNION SELECT DATE_FORMAT(date,'%d/%m/%Y') as billdate,operationrequired as description,patientcharges as amount FROM surgery WHERE uhid_no='$id'";
          
          $select = mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($select)){
        
         $totalamt += $rows1['amount'];

          $str.="<div class='tr row chk'><div class='col-sm-2 td'>".$rows1['billdate']."</div><div class='col-sm-4 td'>".$rows1['description']."</div><div class='col-sm-2 td'>".$rows1['amount']."</div></div>"; }
             
          if($select) {

          
echo '{"status":"success","json":"'.$str.'","totalamt":"'.$totalamt.'"}';
        
  }else{
      echo '{"status":"failed"}';
  }
  }else{
    echo '{"status":"failed1"}';
  }
  

?>





