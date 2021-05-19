<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['type']) && isset($_POST['month'])){
        $con=_connect();
      
        $type =$_POST["type"];
        $month =$_POST["month"];
    
        $monthVal=date("m", strtotime($month));
        $yearVal=date("Y", strtotime($month));
        $monthStart=strtotime($month)*1000;
    
        $daysInMonths=cal_days_in_month(CAL_GREGORIAN, $monthVal, $yearVal);
        $monthEnd=(86400000*($daysInMonths-1))+$monthStart;
 
        $query='';
        // if($type=='' && $month==''){
        //     $query="SELECT employeename,paidsalary as fees FROM  employee_salary where month=$month";
        // }
        if($type=='employee_salary'){
            $query="SELECT employeename,paidsalary FROM  employee_salary ";

        }elseif($type=='vistingdoctorsalary'){
            $query="SELECT doctorname,paidsalary  FROM  vistingdoctorsalary ";

        }elseif($type=='outsidedoctor'){
            $query="SELECT doctorname ,paidsalary FROM  outsidedoctor ";
        }

        if($type=='employee_salary' && $month!=''){
            $query="SELECT employeename,paidsalary FROM  employee_salary WHERE month='$monthStart'";

        }elseif($type=='vistingdoctorsalary' && $month!=''){
            $query="SELECT doctorname,paidsalary  FROM  vistingdoctorsalary WHERE month='$monthStart'";
            
        }elseif($type=='outsidedoctor' && $month!=''){
            $query="SELECT doctorname,paidsalary  FROM  outsidedoctor WHERE month>'$monthStart' AND month<'$monthEnd'";
        }

        $result=mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($result)){

            if($type=='employee_salary'){
                $name=$rows1['employeename'];
            }elseif($type=='vistingdoctorsalary'){
                $name=$rows1['doctorname'];
            }elseif($type=='outsidedoctor'){
                $name=$rows1['doctorname'];
            }
          
            $paidsalary=$rows1['paidsalary'];

           
            $json.=',{"name":"'.$name.'","paidsalary":"'.$paidsalary.'"}';
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