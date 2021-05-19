 <?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data'])){

        $con=_connect();
     
       if (session_status()==PHP_SESSION_NONE) { session_start(); }   
        $created_by=$_SESSION['id'];

        $data=json_decode($_POST['data']);  
        
    foreach($data as $i){
        $billno=get_object_vars($i)['billno'];
        $patientid=get_object_vars($i)['patientid'];
        $billdate1=get_object_vars($i)['billdate'];
        $medicineid=get_object_vars($i)['medicineid'];
        $medicinename=get_object_vars($i)['medicinename'];
        $issueqty=get_object_vars($i)['issueqty'];
        $create=mysqli_query($con, "INSERT INTO billstock (billno,billdate,patientid,medicineid,medicinename,issueqty,created_by,created_time) VALUES('$billno','$billdate1','$patientid','$medicineid','$medicinename','$issueqty','$created_by','$CURRENT_MILLIS')");
    } 
      echo '{"status":"success"}';
        _close($con);
     }else{
        echo '{"status":"failed1"}';
     }
?>