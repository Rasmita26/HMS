<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['uhid_no'])){
        $con=_connect();
        $uhid_no =$_POST["uhid_no"];
       
      $select=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM surgery WHERE uhid_no='$uhid_no'"));
     
      if ($select) {
          $uhid_no=$select['uhid_no'];
          $operationrequired=$select['operationrequired'];
          $patientcharges=$select['patientcharges'];
          $date=$select['date'];
          $doctor_details=$select['doctor_details'];
          $material_details=$select['material_details'];
         
    $str='{"uhid_no":"'.$uhid_no.'","operationrequired":"'.$operationrequired.'","patientcharges":"'.$patientcharges.'","date":"'.$date.'","doctor_details":'.$doctor_details.',"material_details":'.$material_details.'}';

      echo '{"status":"success","json":['.$str.']}';
        }else{
          echo '{"status":"failed"}';
          }
    }else{
       echo '{"status":"failed1"}';
  }
?>
