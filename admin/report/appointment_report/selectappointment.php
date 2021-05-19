<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['appointment']) &&isset($_POST['month'])){
        $con=_connect();
       
        $month =$_POST["month"];
        $appointment =$_POST["appointment"];
       
        $monthVal=date("m", strtotime($month));
        $yearVal=date("Y", strtotime($month));
        $monthStart=strtotime($month)*1000;
    
        $daysInMonths=cal_days_in_month(CAL_GREGORIAN, $monthVal, $yearVal);
        $monthEnd=(86400000*($daysInMonths-1))+$monthStart;



        $query='';
       
        if( $month!='' && $appointment=='confirm'){
            $query="SELECT id,patient_name,drname,phone1,phone2,location,date,time,specialist FROM appointment where confirmed_time<>0  AND date>'$monthStart' AND  date<'$monthEnd'";
         

        }elseif( $month!='' && $appointment=='discard'){
            $query="SELECT id,patient_name,drname,phone1,phone2,location,date,time,specialist FROM appointment where removed_time<>0 AND date>'$monthStart' AND  date<'$monthEnd'";
          

        }
      
            $result=mysqli_query($con,$query);
            while($rows1 = mysqli_fetch_assoc($result)){
                $drname=$rows1['drname'];
              $id=$rows1['id'];
                $patient_name=$rows1['patient_name'];
                $phone1=$rows1['phone1'];
                $phone2=$rows1['phone2'];
                $location=$rows1['location'];
                $specialist=$rows1['specialist'];
                $date=$rows1['date'];
                $date1= date("d-m-Y",$date/1000);
                // echo $date;
                $time=$rows1['time'];
                $time1= date('h:i:s a', strtotime($time));


                               
    
                $json.=',{"drname":"'.$drname.'","patient_name":"'.$patient_name.'","id":"'.$id.'","phone1":"'.$phone1.'","phone2":"'.$phone2.'","location":"'.$location.'","specialist":"'.$specialist.'","date":"'.$date1.'","time":"'.$time1.'"}';
            }
        
                $json=substr($json,1);
                $json='['.$json.']';
                
                if($result) {
                    echo '{"status":"success","json":'.$json.',"count":"'.$count.'"}';
        }else{
            echo '{"status":"failed2"}';
          }
      }else{
          echo '{"status":"failed1"}';
      }
    ?> 