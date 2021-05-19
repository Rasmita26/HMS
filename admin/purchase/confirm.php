<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['pono']))  {
        $con   = _connect();
        $pono = _clean($con,$_POST["pono"]);
        if (session_status()==PHP_SESSION_NONE) {session_start();}
            $created_by = $_SESSION['id'];
        $update=mysqli_query($con,"UPDATE purchase SET 	gateentry_by='$created_by',gateentry_time='$CURRENT_MILLIS' WHERE pono='$pono'");
        if ($update) {
                echo '{"status":"success"}';        
            } else{
                echo '{"status":"failed"}';
            } 
         _close($con);

    } else{
            echo '{"status":"failed1"}';
    }
?>
