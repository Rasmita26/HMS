<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['gender']) && isset($_POST['age']) && isset($_POST['type']) && isset($_POST['month']) && isset($_POST['date'])){
        $con=_connect();
       
        $gender =$_POST["gender"];
        $age =$_POST["age"];
        $type =$_POST["type"];
        $month =$_POST["month"];
        $date =$_POST["date"];

        $monthVal=date("m", strtotime($month));
        $yearVal=date("Y", strtotime($month));
        $monthStart=strtotime($month)*1000;
    
        $daysInMonths=cal_days_in_month(CAL_GREGORIAN, $monthVal, $yearVal);
        $monthEnd=(86400000*($daysInMonths-1))+$monthStart;

        $query='';
        if($gender=='Select' && $age=='Select' && $type=='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details`";
        }
        if($gender=='Select' && $age=='Select' && $type=='Select' && $month=='' && $date!=''){
            $query="SELECT * FROM `patient_details` WHERE registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender=='Select' && $age=='Select' && $type=='Select' && $month!='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        
        if($gender=='Select' && $age=='Select' && $type!='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE type='$type'";
        }
        if($gender=='Select' && $age!='Select' && $type=='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE age='$age'";
        }
        if($gender!='Select' && $age=='Select' && $type=='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender'";
        }
        if($gender!='Select' && $age!='Select' && $type=='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND age='$age'";
        }
        if($gender!='Select' && $age=='Select' && $type!='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND type='$type'";
        }
        if($gender!='Select' && $age=='Select' && $type=='Select' && $month!='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender!='Select' && $age=='Select' && $type=='Select' && $month=='' && $date!=''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender=='Select' && $age!='Select' && $type!='Select' && $month=='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE age='$age' AND type='$type'";
        }
        if($gender=='Select' && $age!='Select' && $type=='Select' && $month!='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE age='$age' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender=='Select' && $age!='Select' && $type=='Select' && $month=='' && $date!=''){
            $query="SELECT * FROM `patient_details` WHERE age='$age' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender=='Select' && $age=='Select' && $type!='Select' && $month!='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE type='$type' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender=='Select' && $age=='Select' && $type!='Select' && $month=='' && $date!=''){
            $query="SELECT * FROM `patient_details` WHERE type='$type' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender!='Select' && $age!='Select' && $type!='Select' && $month!='' && $date==''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND age='$age' AND type='$type' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }
        if($gender!='Select' && $age!='Select' && $type!='Select' && $month=='' && $date!=''){
            $query="SELECT * FROM `patient_details` WHERE gender='$gender' AND age='$age' AND type='$type' AND registration_date>'$monthStart' AND registration_date<'$monthEnd'";
        }

        
         $result=mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($result)){
            $uhid_no=$rows1['uhid_no'];
            $patient_name=$rows1['patient_name'];
            $gender=$rows1['gender'];
            $age=$rows1['age'];
            $relative_name=$rows1['relative_name'];
            $address=$rows1['address'];
            $mobileno1=$rows1['mobileno1'];
            $mobileno2=$rows1['mobileno2'];
            $deposit=$rows1['deposit'];
            $type=$rows1['type'];
            $disease=$rows1['disease'];

            $json.=',{"uhid_no":"'.$uhid_no.'","patient_name":"'.$patient_name.'","gender":"'.$gender.'","age":"'.$age.'","relative_name":"'.$relative_name.'",
            "address":"'.$address.'","mobileno1":"'.$mobileno1.'","mobileno2":"'.$mobileno2.'","deposit":"'.$deposit.'","type":"'.$type.'","disease":"'.$disease.'"}';
        }
    
            $json=substr($json,1);
            $json='['.$json.']';
            
            if($result) {
                echo '{"status":"success","json":'.$json.'}';
    }else{
        echo '{"status":"failed2"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }
?> 

