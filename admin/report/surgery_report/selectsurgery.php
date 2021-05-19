<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['uhid_no']) && isset($_POST['doctorname']) && isset($_POST['date'])){
        $con=_connect();
       
        $uhid_no =$_POST["uhid_no"];
        $doctorname =$_POST["doctorname"];
        $date =$_POST["date"];
      

        $query='';

        if($uhid_no=='undefined' && $doctorname=='Select' && $date==''){
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery";
        }


        if($uhid_no=='undefined' && $doctorname=='Select' && $date!=''){
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' ";
        }

        if($uhid_no=='undefined' && $doctorname!='Select' && $date!=''){
            // echo "SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctorname='$doctorname' ";
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctor_details LIKE '%$doctorname%' ";
  
        }


        if($uhid_no!='undefined' && $doctorname!='Select' && $date!=''){
            // echo "SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctorname='$doctorname' ";
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctor_details LIKE '%$doctorname%'  and uhid_no='$uhid_no'";
        }

        if($uhid_no!='undefined' && $doctorname!='Select' && $date==''){
            // echo "SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctorname='$doctorname' ";
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where doctor_details LIKE '%$doctorname%'  and uhid_no='$uhid_no'";
        }

        if($uhid_no!='undefined' && $doctorname=='Select' && $date!=''){
            // echo "SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctorname='$doctorname' ";
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where doctor_details LIKE '%$doctorname%'  and date='$date' ";
        }

        
        if($uhid_no!='undefined' && $doctorname=='Select' && $date==''){
            // echo "SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctorname='$doctorname' ";
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where uhid_no='$uhid_no' ";
        }

          
        if($uhid_no=='undefined' && $doctorname!='Select' && $date==''){
            // echo "SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where date='$date' and doctorname='$doctorname' ";
            $query="SELECT id,uhid_no,operationrequired,doctor_details,material_details,date FROM surgery where doctor_details LIKE '%$doctorname%' ";
        }

         $result=mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($result)){
            
            $uhid_no=$rows1['uhid_no'];
            $operationrequired=$rows1['operationrequired'];
            $doctor_details=$rows1['doctor_details'];
            $material_details=$rows1['material_details'];
          
            $date=$rows1['date'];
        
           

            $json.=',{"uhid_no":"'.$uhid_no.'","operationrequired":"'.$operationrequired.'","doctor_details":'.$doctor_details.',"material_details":'.$material_details.',"date":"'.$date.'"}';
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

