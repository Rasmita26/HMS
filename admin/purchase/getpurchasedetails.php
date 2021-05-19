<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
$editpono=$_GET['pono'];
?>

<style>
/* .table-list th {
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    background-color: #8e44ad;
    color: white;
               } */

               .table-list th {
        background:#2845CE;
        color: #fff;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 2px;
        border: 1px solid #fff;
    }
    .table-list td {
        border: 1px solid #ddd;
        /* background: #eee; */
    }
    .table-ui .btn {
        margin: 3px;
    }
    .table-list tr:nth-child(even)
     {
        background-color:#CFD5F2; 
         }
         .table-list tr:nth-child(odd)
     {
        background-color: #eee;
         }
</style>
<div class="main-content">
    <input type="hidden" id="editpono" value="<?php echo $editpono; ?>">
    <div class="title">PURCHASE</div>
    <br>
    <div class="container-fluid crm">

        <div id="div-content" class="content">
            <table width="100%" style="position:fixed;width:93%; z-index: 1;">
                <tr>
                    <td align="center" style="width:25%"><a href="/admin/purchase/index.php"
                            style="border:1px solid white;border-radius:0px;background:#1E8685;"
                            class="btn btn-primary btn-block">Purchase Order</td>
                    <td align="center" style="width:25%"><a href="/admin/purchase/gateentry.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Gate
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
        <input type="hidden" id="abc">
        <div class="col-sm-3"><label>Date</label><input type="date" class="form-control" id="date"></input></div>
        <div class="col-sm-3"><label>Supplier Name</label>
            <select class="form-control" id="supplier" onchange="fun_medicinename()">
                <?php 
                                        echo '<option value="Select">Select</option>';
                                        $result1=mysqli_query($con,"SELECT id,sname FROM `supplier`");
                                        while($rows1 = mysqli_fetch_assoc($result1)){
                                        echo '<option value="'.$rows1['id'].'">'.$rows1['sname'].'</option>';
                                       }
                                    ?>
            </select>
        </div>

    </div><br>
    <div class="col-sm-12 table-responsive">
        <table id="table-purchase" class="table table-list">
            <thead>
                <tr>
                    <th rowspan="2" width="15%">MEDICINE NAME</th>
                    <th rowspan="2">QTY</th>
                    <th rowspan="2">UNIT</th>
                    <th rowspan="2">RATE</th>
                    <th rowspan="2">ACTUAL AMOUNT</th>
                    <th colspan="2">DISCOUNT</th>
                    <th rowspan="2">AMOUNT</th>
                    <th colspan="2">CGST</th>
                    <th colspan="2">SGST</th>
                    <th colspan="2">IGST</th>
                    <th rowspan="2">NET AMOUNT</th>
                    <th rowspan="2">Action</th>
                </tr>
                <tr>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                </tr>
            <tbody>
                <tr id="inp-calc">
                    <td>
                        <div class="form-group"> <select class="form-control select-js" id="medicineid"
                                onchange="get_medicinerate(this)">
                                <!-- <option value="Select">Select</option> -->
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group"><input type="text" id="qty" class="form-control input-sm quantity"
                                onkeyup="amount()"></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="text" id="unit" class="form-control input-sm" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="rate" class="form-control input-sm rate"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="amount" class="form-control input-sm amount"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="drate" class="form-control input-sm"
                                onkeyup="amount()"></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="damount" class="form-control input-sm"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="amount_afterdesc" class="form-control input-sm"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="cgstper" class="form-control input-sm"
                                onkeyup="amount()"></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="cgstamt" class="form-control input-sm"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="sgstper" class="form-control input-sm"
                                onkeyup="amount()"></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="sgstamt" class="form-control input-sm"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="igstper" class="form-control input-sm"
                                onkeyup="amount()"></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="igstamt" class="form-control input-sm"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><input type="number" id="netamount" class="form-control input-sm"
                                readonly></div>
                    </td>
                    <td>
                        <div class="form-group"><button class="btn btn-primary" onclick="btnsubmit()">ADD</button></div>
                    </td>
            </tbody>
        </table>
    </div>

    <div class="col-sm-3"><label></label><br><button class="btn btn-primary" id="btn-submit"
            onclick="submit()">Submit</button> </div>
</div>

<script>
function btnsubmit() {

var mid = $("#medicineid").val();
var mname = $("#medicineid option:selected").text();
var quantity =$("#qty").val();
var unit =$("#unit").val();
var rate =$("#rate").val();
var actualamount =$("#amount").val();
var discountrate =$("#drate").val();
var discountamount =$("#damount").val();
var amountafterdis =$("#amount_afterdesc").val();
var cgstrate =$("#cgstper").val();
var cgstamount =$("#cgstamt").val();
var sgstrate =$("#sgstper").val();
var sgstamount =$("#sgstamt").val();
var igstrate =$("#igstper").val();
var igstamount=$("#igstamt").val();
var netamount=$("#netamount").val();

var markup = '<tr>';
markup += '<td style="display:none;" class="medicineid">' + mid + '</td>';
markup += '<td class="medicinename">' + mname + '</td>';
markup += '<td class="qty">' + quantity  + '</td>';
markup += '<td class="unit">' + unit  + '</td>';
markup += '<td class="rate">' + rate  + '</td>';
markup += '<td class="actualamt">' + actualamount  + '</td>';
markup += '<td class="discountrate">' + discountrate  + '</td>';
markup += '<td class="discountamount">' + discountamount  + '</td>';
markup += '<td class="amountafterdis">' + amountafterdis  + '</td>';
markup += '<td class="cgstrate">' + cgstrate  + '</td>';
markup += '<td class="cgstamount">' + cgstamount  + '</td>';
markup += '<td class="sgstrate">' + sgstrate  + '</td>';
markup += '<td class="sgstamount">' + sgstamount  + '</td>';
markup += '<td class="igstrate">' + igstrate  + '</td>';
markup += '<td class="igstamount">' + igstamount  + '</td>';
markup += '<td class="netamount">' + netamount  + '</td>';
markup += '<td ><button class="btn btn-sm btn-danger" onclick="remove(this);"> R </button></td>';
// markup += '<td>'"<button class='btn-danger btn-sm btn' onclick='remove(this)'>Remove</button>" '</td>';
markup += '</tr>';


$("#table-purchase > tbody").append(markup);

 $("#medicineid").val('Select').trigger('change');
$("#qty").val('');
 $("#unit").val('');
 $("#rate").val('');
 $("#amount").val('');
 $("#drate").val('');
 $("#damount").val('');
 $("#amount_afterdesc").val('');
 $("#cgstper").val('');
 $("#cgstamt").val('');
 $("#sgstper").val('');
 $("#sgstamt").val('');
 $("#igstper").val('');
 $("#igstamt").val('');
 $("#netamount").val('');
 


}

function remove(e) {
$(e).parent().parent().fadeOut(1000, function () {
    $(this).remove();
});
}

function fun_medicinename() {
    $('#medicineid')
        .find('option')
        .remove()
        .end()
        .append('<option value="Select">Select</option>')
        .val('Select');
    $.ajax({
        type: "POST",
        data: "medicineid=" + $('#supplier').val(),
        url: 'getmed.php',
        success: function (res) {
            if (res.status == 'success') {
                json = res.json;
                //$('#medicineid').html('<option value="Select">Select</option>');
                for (var i in json) {
                    console.log(json[i]);
                    $('#medicineid').append(json[i]);
                }
            }
        }
    });
}


function get_medicinerate(e) {

    $.ajax({
        type: "POST",
        data: "medicineid=" + $(e).val() + "&supplier=" + $('#supplier').val(),
        url: 'getrate.php',
        success: function (res) {
            if (res.status == 'success') {
                $('#unit').val(res.unit);
                $('#rate').val(res.rate);
                $('#cgstper').val(res.cgst);
                $('#sgstper').val(res.sgst);
                $('#igstper').val(res.igst);

            }
        }
    });
}



function amount(){
    var qty    = parseFloat($('#qty').val());
    var amount = 0;
    var rate   = parseFloat($('#rate').val());
        amount = qty*rate;
        $('#amount').val(amount);

    var drate = parseFloat($('#drate').val());    
    var damount = 0;
    damount = amount/100*drate;
    $('#damount').val(damount);
    var amount_afterdesc = amount-damount;
    $('#amount_afterdesc').val(amount-damount);
     
    

    var cgstper = parseFloat($('#cgstper').val());
    var sgstper = parseFloat($('#sgstper').val());
    var igstper = parseFloat($('#igstper').val());

    var cgstamt=0;
    var sgstamt=0;
    var igstamt=0;
    Math.ceil(2.4);

    

    cgstamt = amount_afterdesc/100*cgstper;
    sgstamt = amount_afterdesc/100*sgstper;
    igstamt = amount_afterdesc/100*igstper;

    $('#cgstamt').val(Math.round(cgstamt*100)/100);
    $('#sgstamt').val(Math.round(sgstamt*100)/100);
    $('#igstamt').val(Math.round(igstamt*100)/100);

    var netamount = amount_afterdesc+(cgstamt+sgstamt+igstamt);
     
    $('#netamount').val(Math.ceil(netamount));
    
}


function submit() {
var supplier=$('#supplier').val(),
date = $('#date').val(),
// created_by = $('#created_by').val();
valid = true;
var arr = [];
var counter = 0;
$('#table-purchase > tbody > tr ').each(function () {
    if (counter != 0) {
        arr.push({

           //  'date': $('#date').val(),
           //  'supplier': $('#supplier').val(),
            'medicineid': $(this).find('.medicineid').text().trim(),
            'medicinename': $(this).find('.medicinename').text().trim(),
            'quantity': $(this).find('.qty').text().trim(),
            'unit': $(this).find('.unit').text().trim(),
            'rate': $(this).find('.rate').text().trim(),
            'amount': $(this).find('.actualamt').text().trim(),
            'drate': $(this).find('.discountrate').text().trim(),
            'damount': $(this).find('.discountamount').text().trim(),
            'amountafterdis':$(this).find('.amountafterdis').text().trim(),
            'cgstper': $(this).find('.cgstrate').text().trim(),
            'cgstamount': $(this).find('.cgstamount').text().trim(),
            'sgstper': $(this).find('.sgstrate').text().trim(),
            'sgstamount': $(this).find('.sgstamount').text().trim(),
            'igstper': $(this).find('.igstrate').text().trim(),
            'igstamount': $(this).find('.igstamount').text().trim(),
            'netamount': $(this).find('.netamount').text().trim(),




        });
    } else {
        counter++;
    }
});

console.log(arr);

 // arr.shift();
//  if (arr == '') {
//      valid = valid * false;
//      $('.list').css('border-bottom', '1px solid red');
//  } else {
//      valid = valid * true;
//      $('.list').css('border-bottom', '1px solid green');
//  }

if (valid) {
    var data = JSON.stringify(arr);
    var arr1 = {
            "date": date,
            "supplier": supplier,
            // "created_by":created_by,
        }
        var data1 = JSON.stringify(arr1);

    $.ajax({
        type: "POST",
        data: {
            data: data,
            data1:data1,
        },
        url: 'insert.php',
        success: function (res) {
            if (res.status == 'success') {
                alert('Data SuccessFull Save');
                window.location = '/admin/purchase/index.php' 
               
            } else {
                $('#btn-submit').show();
            }
        }
    });
}
}

var editpono=$('#editpono').val();

if(editpono!=''){
    $.ajax({
        type: "POST",
        url: 'select.php',
        data: "pono=" + editpono,
        success: function (res) {
            if (res.status == 'success') {
                
                $('#btn-submit').text('Update');
                $('#btn-submit').attr('onclick', 'update()');
                var json = res.json;
                $('#date').val(json[0].date);
                $('#supplier').val(json[0].supplier).trigger('change');
                setTimeout(function(){
                    for(var i in json){
                $('#medicineid').val(json[i].medicineid);
                $('#unit').val(json[i].unit);
                $('#qty').val(json[i].quantity);
                $('#rate').val(json[i].rate);
                $('#amount').val(json[i].actualamount);
                $('#drate').val(json[i].drate);
                $('#damount').val(json[i].damount);
                $('#amount_afterdesc').val(json[i].amountafterdesc);
                $('#cgstper').val(json[i].cgstper);
                $('#cgstamt').val(json[i].cgstamt);
                $('#sgstper').val(json[i].sgstper);
                $('#sgstamt').val(json[i].sgstamt);
                $('#igstper').val(json[i].igstper);
                $('#igstamt').val(json[i].igstamt);
                $('#netamount').val(json[i].netamount);
                btnsubmit();
                }
                     
                    }, 800);
            }
        }
    });
}

function update() {
var supplier=$('#supplier').val(),
date = $('#date').val();
pono = $('#editpono').val();

valid = true;
var arr = [];
var counter = 0;
$('#table-purchase > tbody > tr ').each(function () {
    if (counter != 0) {
        arr.push({

           //  'date': $('#date').val(),
           //  'supplier': $('#supplier').val(),
            'medicineid': $(this).find('.medicineid').text().trim(),
            'medicinename': $(this).find('.medicinename').text().trim(),
            'quantity': $(this).find('.qty').text().trim(),
            'unit': $(this).find('.unit').text().trim(),
            'rate': $(this).find('.rate').text().trim(),
            'amount': $(this).find('.actualamt').text().trim(),
            'drate': $(this).find('.discountrate').text().trim(),
            'damount': $(this).find('.discountamount').text().trim(),
            'amountafterdis':$(this).find('.amountafterdis').text().trim(),
            'cgstper': $(this).find('.cgstrate').text().trim(),
            'cgstamount': $(this).find('.cgstamount').text().trim(),
            'sgstper': $(this).find('.sgstrate').text().trim(),
            'sgstamount': $(this).find('.sgstamount').text().trim(),
            'igstper': $(this).find('.igstrate').text().trim(),
            'igstamount': $(this).find('.igstamount').text().trim(),
            'netamount': $(this).find('.netamount').text().trim(),
        });
    } else {
        counter++;
    }
});

console.log(arr);

if (valid) {
    var data = JSON.stringify(arr);
    var arr1 = {
            "date": date,
            "supplier": supplier,
            "pono":pono,
            }
        var data1 = JSON.stringify(arr1);

    $.ajax({
        type: "POST",
        data: {
            data: data,
            data1:data1,
        },
        url: 'update.php',
        success: function (res) {
            if (res.status == 'success') {
                alert('Data SuccessFull Save');
                location.reload();
            } else {
                $('#btn-submit').show();
            }
        }
    });
}
}


</script>

