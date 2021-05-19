<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['doctorname']) && isset($_POST['specialist']) && isset($_POST['designation'])){
        $con=_connect();
       
        $doctorname =$_POST["doctorname"];
        $specialist =$_POST["specialist"];
        $designation =$_POST["designation"];
      

        $query='';
        if($doctorname=='Select' && $specialist=='Select' && $designation=='Select'){
            $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM `doctor`";
        }

       if($doctorname=='Select' && $specialist=='Select' && $designation!='Select'){
           $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM `doctor` WHERE designation='$designation'";
        }

        if($doctorname=='Select' && $specialist!='Select' && $designation!='Select'){
          $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE designation='$designation' AND specialist='$specialist'";  
        // echo "SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE designation='$designation' AND specialist='$specialist'";  
        }

        if($doctorname!='Select' && $specialist!='Select' && $designation!='Select'){
            $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE designation='$designation' AND specialist='$specialist' AND id='$doctorname'";  

        }
        if($doctorname!='Select' && $specialist!='Select' && $designation=='Select'){
            $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE specialist='$specialist' AND id='$doctorname'";  
        }
        if($doctorname!='Select' && $specialist=='Select' && $designation=='Select'){
            $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE id='$doctorname'";  
        // echo "SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE doctorname='$doctorname'";
        }
        if($doctorname!='Select' && $specialist=='Select' && $designation!='Select'){
            $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE designation='$designation' AND id='$doctorname'";  
        }
        if($doctorname=='Select' && $specialist!='Select' && $designation=='Select'){
            $query="SELECT id,doctorname,specialist,phone,designation,frmtime,totime,days FROM doctor WHERE specialist='$specialist'";  
        }
        
         $result=mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($result)){
            
            $id=$rows1['id'];
            $doctorname=$rows1['doctorname'];
            $specialist=$rows1['specialist'];
            $phone=$rows1['phone'];
            $designation=$rows1['designation'];
            $frmtime=$rows1['frmtime'];
            $totime=$rows1['totime'];
            $days=$rows1['days'];
           

            $json.=',{"id":"'.$id.'","doctorname":"'.$doctorname.'","specialist":"'.$specialist.'","phone":"'.$phone.'","designation":"'.$designation.'","frmtime":"'.$frmtime.'","totime":"'.$totime.'","days":'.$days.'}';
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

