<?php
    $base='../../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['data']) && isset($_POST['id'])){
      $con=_connect();
      $id=$_POST['id'];
      $data=get_object_vars(json_decode($_POST["data"]));
      
          $name=$data['name'];
          $category=$data['category'];
          $description=$data['description'];
          $quantity=$data['quantity'];
          $price=$data['price'];
          $manufactured=$data['manufactured'];
          $status=$data['status'];
          $units=$data['units'];
          $minimumorder=$data['minimumorder'];
          $minimumstock=$data['minimumstock'];
          $gstrate=$data['gstrate'];
        
// echo "UPDATE medicine SET name='$name', category='$category', description='$description', quantity='$quantity', price='$price',units='$units', manufactured='$manufactured', status='$status', minimumorder='$minimumorder', minimumstock='$minimumstock', gstrate='$gstrate' WHERE id='$id'";
          $results= mysqli_query($con,"UPDATE medicine SET name='$name', category='$category', description='$description', quantity='$quantity', price='$price',units='$units', manufactured='$manufactured', status='$status', minimumorder='$minimumorder', minimumstock='$minimumstock', gstrate='$gstrate' WHERE id='$id'");

      if($results){
        echo '{"status":"success"}';
     }else{
         echo '{"status":"failed"}';
     }
     _close($con);
    }else{
       echo '{"status":"failed1"}';
    }
?>

