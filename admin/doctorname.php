<?php
    $base='../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
  
        $con=_connect();
       
        $specialist =$_POST["specialist"];
        $fromdate =$_POST["fromdate"];
        $todate =$_POST["todate"];

        $json='';
        $query='';
        if($specialist=='Select' && $fromdate=='' && $todate==''){
            $query=mysqli_query($con,"SELECT * FROM `doctor`");   
            while($rows = mysqli_fetch_assoc($query)){
                $days=json_decode($rows['days']);
                $day = array_values($days);
                $doctorname=$rows['doctorname'];
                $doctorid=$rows['id'];
                $specialist1=$rows['specialist'];
                $pcheck1=$rows['pcheck'];
               
                $appointment=mysqli_fetch_assoc(mysqli_query($con,"SELECT count(id) x FROM `appointment` WHERE drname='$doctorid' "))['x'];
                $pending=$pcheck1-$appointment;
                $json.=',{"doctorid":"'.$doctorid.'","doctorname":"'.$doctorname.'","specialist":"'.$specialist1.'","pcheck":"'.$pcheck1.'","days":'.json_encode($day).',"appointment":"'.$appointment.'","pending":"'.$pending.'"}';
            }
            $json=substr($json,1);
            $json='['.$json.']';
            echo '{"status":"success","json":'.$json.'}';
        }

        if($specialist!='Select' && $fromdate=='' && $todate==''){
            $query=mysqli_query($con,"SELECT * FROM `doctor` WHERE  specialist='$specialist'");
            while($rows = mysqli_fetch_assoc($query)){
                $days=json_decode($rows['days']);
                $day = array_values($days);
                $doctorname=$rows['doctorname'];
                $doctorid=$rows['id'];
                $specialist=$rows['specialist'];
                $pcheck=$rows['pcheck'];
              
                $appointment=mysqli_fetch_assoc(mysqli_query($con,"SELECT count(id) x FROM `appointment` WHERE drname='$doctorid' "))['x'];
                $pending=$pcheck-$appointment;
                $json.=',{"doctorid":"'.$doctorid.'","doctorname":"'.$doctorname.'","specialist":"'.$specialist.'","pcheck":"'.$pcheck.'","days":'.json_encode($day).',"appointment":"'.$appointment.'","pending":"'.$pending.'"}';
            }
            $json=substr($json,1);
            $json='['.$json.']';
            echo '{"status":"success","json":'.$json.'}';
        }

        if($specialist=='Select' && $fromdate!='' && $todate!=''){ 
            $from_date =$fromdate;
            $to_date =$todate;
            $daterange = getDatesFromRange($fromdate, $todate); 
           
            $arr=array();
            foreach($daterange as $i){
                $dayofweek = date('l', strtotime($i));
                array_push($arr,$dayofweek);
            }
        $arr1 = array_unique($arr);
        $query=mysqli_query($con,"SELECT * FROM `doctor`");
            while($rows = mysqli_fetch_assoc($query)){
                $days=json_decode($rows['days']);
                $day = array_values($days);
                $doctorname=$rows['doctorname'];
                $doctorid=$rows['id'];
                $specialist2=$rows['specialist'];
                $pcheck2=$rows['pcheck'];
                $appointment=mysqli_fetch_assoc(mysqli_query($con,"SELECT count(id) x FROM `appointment` WHERE drname='$doctorid' "))['x'];
                $pending=$pcheck2-$appointment;
               
                $counter=0;
                foreach($arr1 as $i){
                    if (in_array($i, $days)){
                        $counter++;
                    }
                }
                if($counter!=0){
                    $json.=',{"doctorid":"'.$doctorid.'","doctorname":"'.$doctorname.'","specialist":"'.$specialist2.'","pcheck":"'.$pcheck2.'","days":'.json_encode($day).',"appointment":"'.$appointment.'","pending":"'.$pending.'"}';
                 
                }
            }
            $json=substr($json,1);
            $json='['.$json.']';
            echo '{"status":"success","json":'.$json.'}';
        }

        if($specialist!='Select' && $fromdate!='' && $todate!=''){
            $from_date =$fromdate;
            $to_date =$todate;
            $daterange = getDatesFromRange($fromdate, $todate); 
           
            $arr=array();
            foreach($daterange as $i){
                $dayofweek = date('l', strtotime($i));
                array_push($arr,$dayofweek);
            }
        $arr1 = array_unique($arr);
        $query=mysqli_query($con,"SELECT * FROM `doctor` WHERE specialist='$specialist'");
            while($rows = mysqli_fetch_assoc($query)){
                $days=json_decode($rows['days']);
                $day = array_values($days);
                $doctorname=$rows['doctorname'];
                $doctorid=$rows['id'];
                $specialist=$rows['specialist'];
                $pcheck=$rows['pcheck'];
                $appointment=mysqli_fetch_assoc(mysqli_query($con,"SELECT count(id) x FROM `appointment` WHERE drname='$doctorid' "))['x'];
                $pending=$pcheck-$appointment;

                $counter=0;
                foreach($arr1 as $i){
                    if (in_array($i, $days)){
                        $counter++;
                    }
                }
                if($counter!=0){
                    $json.=',{"doctorid":"'.$doctorid.'","doctorname":"'.$doctorname.'","specialist":"'.$specialist.'","pcheck":"'.$pcheck.'","days":'.json_encode($day).',"appointment":"'.$appointment.'","pending":"'.$pending.'"}';
                 
                }
            }
            $json=substr($json,1);
            $json='['.$json.']';
            echo '{"status":"success","json":'.$json.'}';
        }

  function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
    $array = array(); 
    $interval = new DateInterval('P1D'); 
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
    foreach($period as $date) {                  
        $array[] = $date->format($format);  
    } 
    return $array; 
} 

?> 

