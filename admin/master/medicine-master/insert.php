<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

      if(isset($_POST['data'])){
      $con=_connect();
      if (session_status()==PHP_SESSION_NONE) { session_start(); }

          $created_by=$_SESSION['id'];      
          $data =json_decode($_POST["data"]);
          
          $name = get_object_vars($data)["name"];
          $category = get_object_vars($data)["category"];
          $description = get_object_vars($data)["description"];
          $price = get_object_vars($data)["price"];
          $quantity = get_object_vars($data)["quantity"];
          $manufactured = get_object_vars($data)["manufactured"];
          $status= get_object_vars($data)["status"];
          $units = get_object_vars($data)["units"];
          $minimumorder= get_object_vars($data)["minimumorder"];
          $minimumstock= get_object_vars($data)["minimumstock"];
          $gst= get_object_vars($data)["gstrate"];
//  echo "INSERT INTO medicine(name,category,description,price,quantity,manufactured,status,units,minimumorder,minimumstock,gstrate,created_by,created_time) VALUES
//  ('$name','$category','$description','$quantity','$price','$manufactured','$status','$units','$minimumorder','$minimumstock','$gst','$created_by','$CURRENT_MILLIS')";
       $create=mysqli_query($con, "INSERT INTO medicine(name,category,description,quantity,price,manufactured,status,units,gstrate,minimumorder,minimumstock,created_by,created_time) VALUES
      ('$name','$category','$description','$quantity','$price','$manufactured','$status','$units','$gst','$minimumorder','$minimumstock','$created_by','$CURRENT_MILLIS')");

      if ($create) {
        $medicineid=mysqli_fetch_assoc(mysqli_query($con, "SELECT id x FROM medicine WHERE name='$name'"))['x'];
        mysqli_query($con, "INSERT INTO stock(medicineid,medicinename,openingbal,issueqty,receivedqty,adjustaddqty,adjustissueqty,stockqty,created_by,created_time) VALUES('$medicineid','$name','$quantity','0','0','0','0','$quantity','$created_by','$CURRENT_MILLIS')");

        echo '{"status":"success"}';
      }else{
        echo '{"status":"failed1}';
      }
              _close($con);
       }
       else{
          echo '{"status":"falid"}';
       }
  ?>


