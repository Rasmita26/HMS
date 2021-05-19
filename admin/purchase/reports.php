<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>
<style>

#modal-img{
height: 50%;
width: 50%;
}

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
</style>
<div class="main-content">

    <div class="title">PURCHASE</div>
    <br>
    <div class="container-fluid crm">
        <div id="div-content" class="content">
            <table width="100%" style="position:fixed;width:93%; z-index: 1;">
                <tr>
                    <td align="center" style="width:25%"><a href="/admin/purchase/index.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Purchase
                            Order</td>
                    <td align="center" style="width:25%"><a href="/admin/purchase/gateentry.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Gate
                            Entry</td>
                    <td align="center" style="width:25%"><a href="/admin/purchase/reports.php"
                            style="border:1px solid white;border-radius:0px;background:#1E8685;"
                            class="btn btn-primary btn-block">Reports</td>
                </tr>
            </table>
            <br>
        </div>
        <div class="row" style="margin-top:35px;margin-left:30px">

            <div class="col-sm-3">
                <label>Select Supplier</label>
                <select class="form-control" id="supplier">
                    <option value="Select">Select</option>
                    <?php 
                             $result=mysqli_query($con,"SELECT id,sname FROM `supplier` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $id=$rows['id'];
                                    $sname=$rows['sname'];
                                    //$sname=mysqli_fetch_assoc(mysqli_query($con,"SELECT sname x FROM `supplier` WHERE  id='$id' "))['x'];
                                    echo '<option value="'.$id.'" >'.$sname.'</option>';
                                }
                        ?>
                </select>
            </div>

            <div class="col-sm-3">
                <label>Select Medicine</label>
                <select class="form-control" id="medicinename">
                    <option value="Select">Select</option>
                    <?php 
                             $result=mysqli_query($con,"SELECT id,name FROM `medicine` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $name=$rows['name'];
                                    $id=$rows['id'];
                                    // $id=mysqli_fetch_assoc(mysqli_query($con,"SELECT name x FROM `medicine` WHERE  id='$id' "))['x'];
                                    echo '<option value="'.$id.'" >'.$name.'</option>';
                                }
                        ?>
                </select>
            </div>
            <div class="col-sm-2">
                <label> From Date:</label>
                <input type="date" name="time" class="form-control" id="frmdate">
            </div>
            <div class="col-sm-2">
                <label> To Date:</label>
                <input type="date" name="time" class="form-control" id="todate">
            </div>
            <br>
            <div class="col-sm-2" style="margin-top:23px">
                
                <button class="btn btn-primary submit-btn " id="btn-submit" onclick="fun_search()">Search</button>
            </div>
        </div>
        <br> <br>
        <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:5px;" id="search"
            placeholder="Search Box">
        <br>
        <div class="list">
            <div class="tr row">
                <div class="col-sm-2 th">Supplier Name</div>
                <div class="col-sm-1 th">Order No.</div>
                <div class="col-sm-1 th">Order Date</div>
                <div class="col-sm-1 th">Received Date</div>
                <div class="col-sm-1 th">Medicine Name</div>
                <div class="col-sm-1 th">Unit</div>
                <div class="col-sm-1 th">Order Qty</div>
                <div class="col-sm-1 th">Received Qty</div>
                <div class="col-sm-1 th"> Bill No.</div>
                <div class="col-sm-1 th"> Price</div>
                <div class="col-sm-1 th"> Action</div>
            </div>
        </div>
        <br>
       <div hidden class="total"style="margin-left:83%"><label>Total</label>
         <input style="width:85px" type="text" id="totalPrice" disabled></input>
      </div>
    </div>
</div>
<img src="data:image/jpg;base64,Qzp4YW1wcAltcHBocENCREMudG1w"></img>"
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-img">
       
      </div>
    </div>
  </div>
</div>



<script>

 function fun_search() {
        $('.chk').remove();

        var supplier = $('#supplier').val();
        var medicinename = $('#medicinename').val();
        var frmdate = $('#frmdate').val();
        var todate = $('#todate').val();

        $.ajax({

                type: "POST",
                data: "supplier=" + supplier + "&medicinename=" + medicinename +  "&frmdate=" + frmdate + "&todate=" + todate,
                url: 'select1.php',
                success: function (res) {
                    if (res.status == 'success') {
                        json = res.json;
                        var str = '';

                        for (var i in json) {
                            str += '<div class="row tr chk">';
                            str += '<div class="col-sm-2 td">' + json[i].sname + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].pono + ' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].purchasedate + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].purchase_billdate + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].name + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].unit + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].quantity + ' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].received_qty + ' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].purchase_billno + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].netamount + '</div>';
                            str += '<div class="col-sm-1 td"style="display:none;" >' + json[i].purchasebill + '</div>';

                            str +='<div class="col-sm-1 td"> <button   data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm btn" data-pono='+ json[i].pono +' onclick="openfile(this)">Openfile</button></div>';
      

                            str += '</div>';
                        }
                        $('.list').append(str);
                        $('.total').show();
                        $('#totalPrice').val(res.total_amount);
                    }
                }
            }
        );
    }

    $(document).ready(function () {
            $("#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();

                    $(".list .chk").filter(function () {
                         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        }
                    );
                }
            );
        }
    );


    function openfile(e) {
        var pono = $(e).data('pono');



        $.ajax({
            type: "POST",
                data: "pono=" + pono,
                url: 'image.php',
            success: function (res) {
                if(res.status="success"){
                    var img = res.img;
                    $('#modal-img').html(img);
                }
            }
        });
    }



</script>