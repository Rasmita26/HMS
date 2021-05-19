<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['type'])){
        $con=_connect();
        $type = $_POST["type"];
    

        // $employeesal = mysqli_fetch_assoc(mysqli_query($con,"SELECT  employeename,paidsalary  FROM employee_salary "));
        // $doctorsal = mysqli_fetch_assoc(mysqli_query($con,"SELECT  doctorname,paidsalary  FROM vistingdoctorsalary "));
        // $outsidersal = mysqli_fetch_assoc(mysqli_query($con,"SELECT  doctorname,paidsalary x FROM outsidedoctor "));
      
      $query='';

        // if ($employeesal=='') {
        //     $query="SELECT employeename,paidsalary  FROM  employee_salary ";

        // }elseif($doctorsal==''){
        //     $query="SELECT doctorname,paidsalary  FROM  vistingdoctorsalary ";

        // }else{
        //     $query="SELECT doctorname,paidsalary  FROM  outsidedoctor ";
        // }
        if($type=='employee_salary'){

            $query="SELECT employeename,paidsalary  FROM  employee_salary ";
        }elseif($type=='vistingdoctorsalary'){
            $query="SELECT doctornamename,paidsalary  FROM  visitingdoctorsalary ";
        }elseif($type=='outsidedoctor'){
            $query="SELECT doctornamename,paidsalary  FROM  outsidedoctor ";
        }
    
        echo '{"status":"success"}';
    }else{
      echo '{"status":"falid1"}';
    }

?>

