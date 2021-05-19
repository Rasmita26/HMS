<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['phone'])){
        $con=_connect();
        $phone = $_POST['phone'];

       $select=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM patient_details WHERE mobileno1='$phone' OR mobileno2='$phone'"));
     
       if ($select)
       {
          $uhid_no=$select['uhid_no'];
          $patient_name=$select['patient_name'];
          $gender=$select['gender'];
          $age=$select['age'];
          $relative_name=$select['relative_name'];
          $address=$select['address'];
          $mobileno1=$select['mobileno1'];
          $mobileno2=$select['mobileno2'];
          $deposit=$select['deposit'];
          $type=$select['type'];
          $disease=$select['disease'];


        $json.=',{"uhid_no":"'.$uhid_no.'","patient_name":"'.$patient_name.'","gender":"'.$gender.'","age":"'.$age.'","relative_name":"'.$relative_name.'",
            "address":"'.$address.'","mobileno1":"'.$mobileno1.'","mobileno2":"'.$mobileno2.'","deposit":"'.$deposit.'","type":"'.$type.'","disease":"'.$disease.'"}';
        }
    
            $json=substr($json,1);
            $json='['.$json.']';
            
    if($select) {
         echo '{"status":"success","json":'.$json.'}';
   }else{
         echo '{"status":"failed2"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }

?>