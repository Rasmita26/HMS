<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

$billno=mysqli_fetch_assoc(mysqli_query($con,"SELECT max(billno) x FROM billstock"))['x'];
$billno++;
?>
<link rel="stylesheet" href="<?php echo $base; ?>css/grid.min.css">
<style>
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

    <div class="title">BILLING</div> <br>
    <div id="div-content" class="content">
        <table width="100%" style="position:fixed;width:93%; z-index: 1;">
            <tr>
                <td align="center" style="width:25%"><a href="/admin/Billing/index.php"
                        style="border:1px solid white;border-radius:0px;background:#1E8685;"
                        class="btn btn-primary btn-block">Billing</td>
                <td align="center" style="width:25%"><a href="/admin/Billing/receipt.php"
                        style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Receipt
                        generate</td>
               
            </tr>
        </table>
    </div>
    <br><br><br>

    <div class="row" style="margin-left:25px">
        <div class="col-sm-3"><label>Bill Number </label><input class="form-control" type="text" readonly
                value="<?php echo $billno; ?>" id="billno"> </input>
        </div>
        <div class="col-sm-3"><label>Patient ID </label><input class="form-control" type="text" id="patientid" required>
            </input></div>
        <div class="col-sm-3"><label>Date </label><input class="form-control" value="<?php echo $_today; ?>" type="date"
                id="billdate"> </input></div>
    </div>
    <br>
    <div class="table-ui container-fluid" id="test-list">
        <div class="list">
            <div class="tr row">
                <div class="col-sm-4 th">Medicine Name</div>
                <div class="col-sm-2 th">Stock Quantity</div>
                <div class="col-sm-2 th">Issue Quantity</div>
                <div class="col-sm-4 th">Action</div>
            </div>

            <div class=" tr row" id="inp-calc">
                <div class="col-sm-4 td">
                    <select class="form-control select-js" id="medicinename" onchange="get_medicine_stock(this)">
                        <option value="Select" id="mydropdowm"></option>
                        <?php 
                                                        $result=mysqli_query($con,"SELECT DISTINCTROW medicineid FROM `stock` WHERE stockqty<>0 ORDER BY id DESC");
                                                        while($row=mysqli_fetch_assoc($result)){
                                                            $medicineid=$row['medicineid'];
                                                            $medicinename=mysqli_fetch_assoc(mysqli_query($con,"SELECT name x FROM medicine WHERE id='$medicineid'"))['x'];
                                                        echo "<option value=".$medicineid.">".$medicinename."</option>";
                                                        }
                                                    ?>
                    </select>
                </div>
                <div class="col-sm-2 td"> <input type="text" class="form-control" id='inp-text-2' readonly> </div>
                <div class="col-sm-2 td"> <input type="number" class="form-control" id='issueqty'
                        onkeyup="checkqty(this)" required> </div>
                <div class="col-sm-4 td"> <button style="margin-left:35%" class="btn btn-sm btn-success" onclick="btnsubmit()"> Add
                        Medicine</button> </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <button class="btn btn-primary" onclick="submit()" style="margin-left:698px;margin-top:20px"> Submit </button>
    </div>
</div>

<script>
    function get_medicine_stock(e) {
        var medicineid = $(e).val();
        $.ajax({
            type: "POST",
            data: "medicineid=" + medicineid,
            url: 'select.php',
            success: function (res) {
                if (res.status == 'success') {
                    $('#inp-text-2').val(res.quantity);
                }
            }
        });
    }
    $(document).ready(function () {
        $('.select-js').select2({
            width: '100%',
            tags: true
        });
        $('.select').attr('style', 'width:100%!important;');
    });

    function checkqty(e) {
        var stockqutity = $("#inp-text-2").val();
        var issuequantity = $(e).val();
        if (parseFloat(issuequantity) > parseFloat(stockqutity)) {
            alert('Not Allow');
            $("#issueqty").val(0);
        }
    }

    function btnsubmit() {

        var mid = $("#medicinename").val();
        var mname = $("#medicinename option:selected").text();
        var stockqutity = $("#inp-text-2").val();
        var issuequantity = $("#issueqty").val();

        var markup = '<div class="tr row">';
        markup += '<div class="col-sm-4 td medicineid" style="display:none;">' + mid + '</div>';
        markup += '<div class="col-sm-4 td medicinename">' + mname + '</div>';
        markup += '<div class="col-sm-2 td">' + stockqutity + '</div>';
        markup += '<div class="col-sm-2 td issueqty">' + issuequantity + '</div>';
        markup +=
            '<div class="col-sm-4 td"><button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
        markup += '</div>';
        $(".table-ui > .list").append(markup);

        $("#medicinename").val('Select').trigger('change');
        $("#inp-text-2").val('');
        $("#issueqty").val('');

    }

    function remove(e) {
        $(e).parent().parent().fadeOut(1000, function () {
            $(this).remove();
        });
    }

    function submit() {

        var patientid = $('#patientid').val().trim(),
            issueqty = $('#issueqty').val().trim();
        valid = true;

        if (patientid == '') {
            valid = valid * false;
            $('#patientid').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#patientid').css('border-bottom', '1px solid green');
        }

        var arr = [];
        var counter = 0;
        $('.list > .tr').each(function () {
            if (counter != 0) {
                arr.push({
                    'billno': $('#billno').val(),
                    'patientid': $('#patientid').val(),
                    'billdate': $('#billdate').val(),
                    'medicineid': $(this).find('.medicineid').text().trim(),
                    'medicinename': $(this).find('.medicinename').text().trim(),
                    'issueqty': $(this).find('.issueqty').text().trim()
                });
            } else {
                counter++;
            }
        });
        arr.shift();
        if (arr == '') {
            valid = valid * false;
            $('.list').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('.list').css('border-bottom', '1px solid green');
        }
        if (valid) {
            var data = JSON.stringify(arr);
            $.ajax({
                type: "POST",
                data: {
                    data: data
                },
                url: 'insert.php',
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