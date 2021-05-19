<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['pono']) && isset($_POST['medicineid']) && isset($_POST['rate']) && isset($_POST['received_qty'])   && isset($_POST['supplierid']) && isset($_POST['purchasedate']) && isset($_POST['quantity']) && isset($_POST['unit']) && isset($_POST['cgstper'])&& isset($_POST['descper']) && isset($_POST['igstper'])&& isset($_POST['sgstper'])) {  

        $con   = _connect();
        $received_qty = _clean($con,$_POST["received_qty"]);

        $pono = $_POST["pono"];
        $medicineid = $_POST["medicineid"];
        $supplierid = $_POST["supplierid"];
        $purchasedate= $_POST["purchasedate"];
        $unit = $_POST["unit"]; 
        $quantity = $_POST["quantity"]; 
        $descper =  $_POST["descper"];
        $cgstper =  $_POST["cgstper"];
        $igstper =  $_POST["igstper"];
        $sgstper =  $_POST["sgstper"];
        $rate    = $_POST["rate"];
        $amount = $received_qty*$rate;
        $damount = $amount / 100 * $descper;
        $amount_afterdesc = $amount-$damount;
        $cgstamt=$amount_afterdesc /100 * $cgstper;
       
        $sgstamt=$amount_afterdesc /100 * $sgstper;
        $igstamt=$amount_afterdesc /100 * $igstper;
        $netamount= $amount_afterdesc+($cgstamt+$sgstamt+$igstamt);
 


        if (session_status()==PHP_SESSION_NONE) {session_start();}
        $created_by = $_SESSION['id'];

        //  echo "INSERT INTO gateentry (pono,supplierid,purchasedate,medicineid,unit,quantity,rate,received_qty,actual_amount,descper,descamt,amount_afterdesc,cgstper,cgstamt,sgstper,sgstamt,igstper,igstamt,netamount,created_by,created_time) VALUES ('$pono','$supplierid','$purchasedate','$medicineid','$unit','$quantity','$rate','$received_qty','$amount','$descper','$damount','$amount_afterdesc','$cgstper','$cgstamt','$sgstper','$sgstamt','$igstper','$igstamt','$netamount','$created_by','$CURRENT_MILLIS')";    

        $create = mysqli_query($con,"INSERT INTO gateentry (pono,supplierid,purchasedate,medicineid,unit,quantity,rate,received_qty,actual_amount,descper,descamt,amount_afterdesc,cgstper,cgstamt,sgstper,sgstamt,igstper,igstamt,netamount,created_by,created_time) VALUES('$pono','$supplierid','$purchasedate','$medicineid','$unit','$quantity','$rate','$received_qty','$amount','$descper','$damount','$amount_afterdesc','$cgstper','$cgstamt','$sgstper','$sgstamt','$igstper','$igstamt','$netamount','$created_by','$CURRENT_MILLIS')");    
        if ($create) {
            $update=mysqli_query($con,"UPDATE purchase SET received_qty='$received_qty' WHERE pono='$pono' AND medicineid='$medicineid'");

            //  $update=mysqli_query($con,"UPDATE gateentry SET received_qty='$received_qty',actual_amount='$amount',descamt='$damount',amount_afterdesc='$amount_afterdesc',cgstamt='$cgstamt',sgstamt='$sgstamt',igstamt='$igstamt',netamount='$netamount' WHERE pono='$pono' AND medicineid='$medicineid'");


        echo '{"status":"success"}'; 
         
            } else{
                echo '{"status":"failed"}';
            } 
         _close($con);
        } else{
            echo '{"status":"failed1"}';
    }
?>
