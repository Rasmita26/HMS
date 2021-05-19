<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['assigndate']) && isset($_POST['dischargedate']) && isset($_POST['bedtype']) && isset($_POST['assigntime']) && isset($_POST['dischargetime']) ){
        
        $con=_connect();
        $id            = $_POST["bedtype"];
        $assigndate    = $_POST["assigndate"]+$_POST["assigntime"];
        $dischargedate = $_POST["dischargedate"]+$_POST["dischargetime"];
     
        $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT room,roomtype,price from room WHERE id='$id'"));
        $room=$select['room'];
        $roomtype=$select['roomtype'];
        $price2=$select['price'];
         $price=ceil(($dischargedate-$assigndate)/86000000)*$price2;
        $json='';
    
     $select=mysqli_query($con, "SELECT pid,bedno,(SELECT pname from patient WHERE patient.id=bed.pid) as pname,DATE_FORMAT(FROM_UNIXTIME(assign_time/1000),'%d/%m/%Y %r') as assign_time,DATE_FORMAT(FROM_UNIXTIME(discharge_time/1000),'%d/%m/%Y %r') as discharge_time FROM bed WHERE (assign_time<'$assigndate' OR assign_time<'$dischargedate') AND (discharge_time>'$assigndate' OR discharge_time>'$dischargedate') AND bedtype='$room' AND roomtype='$roomtype'");
     while($rows = mysqli_fetch_assoc($select)){
         $patientname =$rows["pname"];
         $pid =$rows["pid"];
         $assign_time=$rows['assign_time'];
         $discharge_time=$rows['discharge_time'];
         $json.=',{"pid":"'.$pid.'","bedno":"'.$rows['bedno'].'","pname":"'.$patientname.'","assign_time":"'.$assign_time.'","discharge_time":"'.$discharge_time.'"}';
    } 

    $json=substr($json,1);
    $arr='['.$json.']';
     
    
      

        echo '{"status":"success","price":"'.$price.'","arr":'.$arr.'}';  
}

