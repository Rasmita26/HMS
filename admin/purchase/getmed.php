<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['medicineid'])){
        $con=_connect();
        $medicineid =$_POST["medicineid"];
        $arr= array();
       $select=mysqli_query($con, "SELECT medicineid FROM msirate where sid='$medicineid'");
      while($rows1 = mysqli_fetch_assoc($select)){
        $medicineid=$rows1['medicineid'];
        $name=mysqli_fetch_assoc(mysqli_query($con, "SELECT name x FROM medicine where id='$medicineid'"))['x'];
        array_push($arr,'<option value="'.$rows1['medicineid'].'">'.$name.'</option>');
       }
      if ($select) {        
        echo '{"status":"success","json":'.json_encode($arr).'}';
    }else{
        echo '{"status":"falid2"}';
      }
  }else{
      echo '{"status":"falid1"}';
  }
?> 

