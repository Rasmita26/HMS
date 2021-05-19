<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['manuf'])){
        $con=_connect();
        $manuf =$_POST["manuf"];
        $arr= array();
      $select=mysqli_query($con, "SELECT DISTINCTROW category FROM `medicine` where manufactured='$manuf'");
      while($rows1 = mysqli_fetch_assoc($select)){
        array_push($arr,'<option value="'.$rows1['category'].'">'.$rows1['category'].'</option>');
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

