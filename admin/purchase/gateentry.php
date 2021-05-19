<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>

<style>

/* .table-list th {
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    background-color: #16a085;
    color: white;
} */
.th {
        background:#2845CE;
        color: #fff;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 2px;
        border: 1px solid #fff;
    }
    .td {
        border: 1px solid #ddd;
        /* background: #eee; */
    }
    .table-ui .btn {
        margin: 3px;
    }
    .tr:nth-child(even)
     {
         background-color: #eee;
         }
         .tr:nth-child(odd)
     {
         background-color:#CFD5F2;
         }


    .label1{
        font-size: 13.5px;
    }
</style>
<div class="main-content">

    <div class="title">PURCHASE</div>
    <br>
    <img class="hidden" id=imageid src="../../../../img/login-img.png">
    <div class="container-fluid crm">
        <div id="div-content" class="content">
            <table width="100%" style="position:fixed;width:93%; z-index: 1;">
                <tr>
                    <td align="center" style="width:25%"><a href="/admin/purchase/index.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Purchase
                            Order</td>
                    <td align="center" style="width:25%"><a href="/admin/purchase/gateentry.php"
                            style="border:1px solid white;border-radius:0px; background:#1E8685;"
                            class="btn btn-primary btn-block">Gate
                            Entry</td>

                    <td align="center" style="width:25%"><a href="/admin/purchase/reports.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Reports
                    </td>

                </tr>
            </table>


        </div>
    </div>
    <br><br><br>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-12 table-responsive">
            <div class="table-ui container-fluid table-list">

                <div class="tr row">
                    <div class="col-sm-1 th">Order No.</div>
                    <div class="col-sm-1 th">Order Date</div>
                    <div class="col-sm-3 th">Supplier Info</div>
                    <div class="col-sm-4 th">Order</div>
                    <div class="col-sm-3 th">Action</div>

                </div>

                <?php
                        $result=mysqli_query($con,"SELECT DISTINCTROW pono from purchase WHERE gateentry_time<>0 AND purchase_bill_time=0");
                        while($rows=mysqli_fetch_assoc($result)){
                            $pono=$rows['pono'];  
                            $selectval=mysqli_fetch_assoc(mysqli_query($con,"SELECT * from purchase WHERE pono='$pono'"));
                            $supplierid=$selectval['supplierid'];
                            $date=$selectval['purchasedate'];
                            
                           
                            
                            
                            $supplier=mysqli_fetch_assoc(mysqli_query($con,"SELECT * from supplier WHERE id='$supplierid'"));
                            $sname=$supplier['sname'];
                            $address=$supplier['address'];
                            $semail=$supplier['semail'];
                            $phoneno=$supplier['phoneno'];
                            $cname=json_decode($supplier['cname']);
                            
                            foreach($cname as $i){
                                 $cname=get_object_vars($i)['cname'];
                                 $mobile=get_object_vars($i)['mobile'];
                                 $department=get_object_vars($i)['department'];
                          

                                break;
                            
                             }
                            

                            ?>
                <div class="tr row">
                    <div class="col-sm-1 td" style="word-wrap:break-word;"><?php echo $rows['pono']; ?></div>
                    <div class="col-sm-1 td" style="word-wrap:break-word;"> <?php echo date("d-m-Y",strtotime($selectval['purchasedate'])) ; ?></div>
                    <div class="col-sm-3 td" style="word-wrap:break-word;">
                        <?php echo 'Supplier Name : ' .$sname; ?><br><?php echo 'Email :' .$semail; ?><br><?php echo 'Phoneno :' .$phoneno; ?>
                        <br><?php echo 'Address :' .$address; ?><br><?php echo 'Contact Person :' .$cname.'<br> Mobile : '.$mobile.'<br> Department : '.$department; ?>
                    </div>
                    <div class="col-sm-4 td" style="word-wrap:break-word;">
                        <?php
                                    $result1=mysqli_query($con,"SELECT medicineid,unit,quantity,rate,descper,cgstper,sgstper,igstper,received_qty FROM `purchase` WHERE pono='$pono' AND purchasedate='$date' AND supplierid='$supplierid'");
                                echo '<table class="table table-list form-group">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th width="200">Medicine Name</th>';
                               
                                echo '<th>Qty</th>';
                                echo'<th>Received Qty </th>';
                                echo'<th>Action  </th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                
                                while($rows=mysqli_fetch_assoc($result1)){
                                  $medicineid=  $rows['medicineid'];
                                  $received_qty=  $rows['received_qty'];
                                  $quantity=$rows['quantity'];
                                  $cgstper= $rows['cgstper'];
                                  $igstper= $rows['igstper'];
                                  $sgstper= $rows['sgstper'];
                                  $descper= $rows['descper'];
                                  $unit=  $rows['unit'];
                                  $rate= $rows['rate'];
                                  
                                            echo '<tr>';

                                            $name=mysqli_fetch_assoc(mysqli_query($con,"SELECT name x from medicine WHERE id='$medicineid'"))['x'];
                                            echo '<td>'.$name.'</td>';
                                            echo '<td>'.$rows['quantity'].'</td>';
                                          
                                            if($rows['received_qty']!=''){
                                                echo '<td> '.$rows['received_qty'].' </td>';
                                                echo '<td>Done</td>';
                                            }else{
                                                echo '<td> <input type="text"  class="form-control received_qty" size="40"/>  </td>';
                                                echo '<td><button class="btn btn-sm btn-block btn-success"     data-rate ="'.$rate.'"  data-unit ="'.$unit.'" data-descper ="'.$descper.'" data-cgstper ="'.$cgstper.'"  data-igstper ="'.$igstper.'"  data-sgstper ="'.$sgstper.'"  data-quantity ="'.$quantity.'"  data-purchasedate ="'.$date.'" data-supplierid ="'.$supplierid.'" data-pono="'.$pono.'" data-medicineid="'.$medicineid.'" onclick="receive(this)" >Confirm</button></td>';
                                            }
                                           
                                            echo '</tr>';
                                    
                                        }
                                echo '</tbody>';
                                echo '</table>';

                                


                                
                                    
                                ?>
                    </div>
                    <?php
                        if ($received_qty!="") {
                            ?>
                    <div class="col-sm-3 td" style="word-wrap:break-word;">
                        <div class="col-sm-12"> <label class="label1">Purchase Billno.</label><input type="text"
                                class="form-control purchase_billno" id="purchase_billno" ></input></div>
                        <div class="col-sm-12"><label class="label1">Date</label><input type="date"
                                class="form-control purchase_billdate" id="purchase_billdate"></input></div>


                        <div class="col-sm-12"><input type="file" class="purchasebill" id="img"></input></div>


                        <button class="btn btn-sm btn-block btn-success" data-link1="purchase_bill_by"
                            data-link2="purchase_bill_time" data-purchaseid='<?php echo $pono; ?>'
                            onclick="billdetails(this)">Confirm</button>
                        <?php
                            # code...
                        }
                        ?>


                    </div>


                    </div>
               
                <?php
                        }
                                    
                        ?>





        </div>

</div></div>
</div>

<script>
function receive(e){
   var pono= $(e).data('pono');
   var purchasedate= $(e).data('purchasedate');
   var rate= $(e).data('rate');
  
   var quantity= $(e).data('quantity');
   var unit= $(e).data('unit');
   var supplierid=  $(e).data('supplierid');
   var cgstper= $(e).data('cgstper');
   var igstper= $(e).data('igstper');
   var sgstper= $(e).data('sgstper');
   var descper= $(e).data('descper');
   var medicineid=$(e).data('medicineid');
    var received_qty = $(e).parent().parent().find('.received_qty').val();
 var returnDialog = confirm('Are you Sure?');
if (returnDialog) {
    $.ajax({
                    type: "POST",
                    url: 'receive.php',
                    data: 'pono=' + pono + '&received_qty=' + received_qty  + '&purchasedate=' + purchasedate + '&rate=' + rate  + '&supplierid=' +  supplierid + '&medicineid=' + medicineid  +'&quantity=' + quantity +'&unit=' + unit +'&cgstper=' + cgstper +'&sgstper=' + sgstper + '&igstper=' + igstper +'&descper=' + descper ,
                    success: function (res) {
                        if (res.status == 'success') {
                            
                            location.reload();
                        }
                    }
                });

   console.log('Yes');
} 




}





function billdetails(e){
    
   var pono= $(e).data('purchaseid');
    // var purchase_billno = $('#purchase_billno').val();
    var purchase_billno=$(e).parent().parent().find('.purchase_billno').val();
    
    var purchase_billdate = $(e).parent().parent().find('.purchase_billdate').val();
     var formData= new FormData();
     var purchasebill = $(e).parent().parent().find('.purchasebill').val();


     formData.append('data1',pono);
     formData.append('data2',purchase_billno);
     formData.append('data3',purchase_billdate);
     formData.append('file',$('.purchasebill')[0].files[0]);

 var returnDialog = confirm('Are you Sure?');
if (returnDialog) {
    $.ajax({
                    type: "POST",
                    //data: 'pono=' + pono  +'&purchase_billno=' + purchase_billno + '&purchase_billdate=' + purchase_billdate,
                     data: formData,
                     cache: false,
            contentType: false,
            processData: false,
                    url: 'bill.php',
                  

                  success: function (res) {
                        if (res.status == 'success') {
                            
                            location.reload();
                        }
                    }
                });

   console.log('Yes');
}  



}





</script>