<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data1']) && isset($_POST['data2']) && isset($_POST['data3'])) {
        $con  = _connect();
        $pono = _clean($con,$_POST["data1"]);
        $purchase_billno = _clean($con,$_POST[ "data2"]);
        $purchase_billdate = _clean($con,$_POST["data3"]);
        
        $img = addslashes (file_get_contents($_FILES['file']['tmp_name']));
        // $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
        if (session_status()==PHP_SESSION_NONE) {session_start();}
            $created_by = $_SESSION['id'];
            // $sql = "INSERT INTO upload_image (img) VALUES ('{$imgData}');";            
            // $create = mysqli_query($con,"INSERT INTO gateentry (purchase_billno,purchase_billdate,purchasebill) VALUES ('$purchase_billno','$purchase_billdate','$img') WHERE pono='$pono'");
         
            $create = mysqli_query($con,"UPDATE gateentry SET  purchase_billno='$purchase_billno',purchase_billdate='$purchase_billdate',purchasebill='$img' WHERE pono='$pono'");
           if ($create) {
            $update=mysqli_query($con,"UPDATE  purchase SET  purchase_billno='$purchase_billno',purchase_billdate='$purchase_billdate',purchasebill='$img',purchase_bill_by='$created_by',purchase_bill_time='$CURRENT_MILLIS' WHERE pono='$pono'");


                echo '{"status":"success"}';        
            } else{
                echo '{"status":"failed"}';
            } 
            _close($con);
         } else{
            echo '{"status":"failed1"}';
    }
?>
