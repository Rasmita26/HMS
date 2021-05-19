<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

        if (isset($_POST['data']) && isset($_POST['data1'])) {

            $con = _connect();

            if (session_status() == PHP_SESSION_NONE) {session_start(); }

            $created_by = $_SESSION['id'];

            $data = json_decode($_POST["data"]);
            $hname = get_object_vars($data)["hname"];
            $address = get_object_vars($data)["address"];
            $phone = get_object_vars($data)["phone"];
            $cpancard = get_object_vars($data)["cpancard"];
            $country = get_object_vars($data)["country"];
            $hosstate = get_object_vars($data)["hosstate"];
            $pin = get_object_vars($data)["pin"];
            $gstno = get_object_vars($data)["gstno"];
            $others = get_object_vars($data)["others"];
            $cname = get_object_vars($data)["cname"];

            //$id = get_object_vars($data)["id"];

            $data1 = $_POST["data1"];

            $id1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT max(id) x FROM hospital_details"))['x'];
                if ($id1!=0) {
                    mysqli_query($con,"UPDATE hospital_details  SET hname='$hname',address='$address',phoneno='$phone',cpancard='$cpancard',country='$country',state='$hosstate',pin_no='$pin',gst_no='$gstno',others='$others',cname='$data1',created_by='$created_by',created_time='$created_time'");
                } else {
                    mysqli_query($con, "INSERT INTO hospital_details(hname,address,phoneno,cpancard,country,state,pin_no,gst_no,others,cname,created_by,created_time) VALUES('$hname', '$address', '$phone', '$cpancard', '$country', '$hosstate', '$pin', '$gstno', '$others', '$data1', '$created_by', '$CURRENT_MILLIS')");
                }
            
            echo '{"status":"success"}';
            _close($con);
        }else {
            echo '{"status":"failed1"}';
        } 
?>