<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['wardtype']) && isset($_POST['date']) && isset($_POST['month'])){
        $con=_connect();
       
        $wardtype =$_POST["wardtype"];
        $date =$_POST["date"];
        $month =$_POST["month"];
    
        $monthVal=date("m", strtotime($month));
        $yearVal=date("Y", strtotime($month));
        $monthStart=strtotime($month)*1000;
    
        $daysInMonths=cal_days_in_month(CAL_GREGORIAN, $monthVal, $yearVal);
        $monthEnd=(86400000*($daysInMonths-1))+$monthStart;
 

        $query='';
        if($gender=='Select' && $age=='Select' && $type=='Select'){
            $query="SELECT * FROM `patient_details`";
        }

        if($gender=='Select' && $age=='Select' && $type!='Select'){
            $query="SELECT * FROM `patient_details` WHERE type='$type'";
        }

        if($gender=='Select' && $age!='Select' && $type!='Select'&& $registration_date!='Select'){
            $query="SELECT * FROM `patient_details` WHERE type='$type' AND age='$age' AND registration_date='$monthStart' AND registration_date<'$monthEnd'";
        }

        if($gender!='Select' && $age!='Select' && $type!='Select'&& $registration_date!='Select'){
            $query="SELECT * FROM `patient_details` WHERE type='$type' AND age='$age' AND gender='$gender' AND registration_date='$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender!='Select' && $age!='Select' && $type=='Select'&& $registration_date!='Select'){
            $query="SELECT * FROM `patient_details` WHERE age='$age' AND gender='$gender'AND  registration_date='$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender!='Select' && $age=='Select' && $type=='Select'&& $registration_date!='Select'){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND  registration_date='$monthStart'AND registration_date<'$monthEnd'";
        }
        if($gender!='Select' && $age=='Select' && $type!='Select'&& $registration_date!='Select'){
            $query="SELECT * FROM `patient_details` WHERE type='$type' AND  gender='$gender' AND registration_date='$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender=='Select' && $age!='Select' && $type=='Select'&& $registration_date!='Select'){
            $query="SELECT * FROM `patient_details` WHERE age='$age' AND registration_date='$monthStart'";
        }
         $result=mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($result)){
            $id    =$rows1['id'];
            $registration_date = $rows1['registration_date'];
            $uhid_no           = $rows1['uhid_no'];
            $patient_name      = $rows1['patient_name'];
            $relative_name     = $rows1['relative_name'];
            $address           = $rows1['address'];
            $mobileno1         = $rows1['mobileno1'];
            $mobileno2         = $rows1['mobileno2'];
            $dob               = $rows1['dob'];
            $age               = $rows1['age'];              
            $consulting_doctor = $rows1['consulting_doctor'];
            $reffered_by       = $rows1['reffered_by'];
            $disease           = $rows1['disease'];
            $deposit           = $rows1['deposit'];
            $gender            =$rows1['gender'];
          



            $json.=',{"id":"'.$id.'","registration_date":"'.$registration_date.'","gender":"'.$gender.'","age":"'.$age.'","uhid_no":"'.$uhid_no.'","address":"'.$address.'","mobileno1":"'.$mobileno1.'","mobileno2":"'.$mobileno2.'","consulting_doctor":"'.$consulting_doctor.'","reffered_by":"'.$reffered_by.'","dob":"'.$dob.'","disease":"'.$disease.'",}';
        }
    
            $json=substr($json,1);
            $json='['.$json.']';
            
            if($result) {
                echo '{"status":"success","json":'.$json.'}';
    }else{
        echo '{"status":"failed"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }
?> 

