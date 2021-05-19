<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['medicineid']) &&  isset($_POST['supplier'])){
        $con=_connect();
        $medicineid = $_POST["medicineid"];
        $supplierid = $_POST["supplier"];
        $state = mysqli_fetch_assoc(mysqli_query($con,"SELECT  state x FROM supplier where id='$supplierid'"))['x'];
        $gstrate = mysqli_fetch_assoc(mysqli_query($con,"SELECT  gstrate x FROM medicine where id='$medicineid'"))['x'];
        if ($state=='27') {
          $cgst=$gstrate/2;
          $sgst=$gstrate/2;
          $igst=0;
        }else{
          $cgst=0;
          $sgst=0;
          $igst=$gstrate;
        }
        $rateunit=mysqli_fetch_assoc(mysqli_query($con,"SELECT rate, (SELECT medicine.units FROM medicine where medicine.id='$medicineid') as units FROM msirate where sid='$supplierid' AND medicineid='$medicineid' "));
        echo '{"status":"success","rate":"'.$rateunit['rate'].'","unit":"'.$rateunit['units'].'","cgst":"'.$cgst.'","sgst":"'.$sgst.'","igst":"'.$igst.'"}';
    }else{
      echo '{"status":"falid1"}';
    }
?>
