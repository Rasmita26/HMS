<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>
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
    body {
        font-family: Verdana, Geneva, sans-serif;
        font-size: 14px;
        background: #f2f2f2;
    }

    .form_wrapper {
        background: rgba(255, 255, 255, .8);
        width: 520px;
        max-width: 100%;
        box-sizing: border-box;
        padding: 25px;
        margin: auto;
        position: relative;
        z-index: 1;
        border-top: 5px solid #f5ba1a;
        -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
        -webkit-transition: none;
        transition: none;
        -webkit-animation: expand 0.8s 0.6s ease-out forwards;
        animation: expand 0.8s 0.6s ease-out forwards;
        opacity: 0;
    }

    .form_wrapper label {
        font-size: 12px;
    }

    .form_wrapper .row {
        margin: 8px -10px;
    }

    .form_wrapper .row>div {
        padding: 0 10px;
        box-sizing: border-box;
    }

    @-webkit-keyframes expand {
        0% {
            -webkit-transform: scale3d(1, 0, 1);
            opacity: 0;
        }

        25% {
            -webkit-transform: scale3d(1, 1.2, 1);
        }

        50% {
            -webkit-transform: scale3d(1, 0.85, 1);
        }

        75% {
            -webkit-transform: scale3d(1, 1.05, 1);
        }

        100% {
            -webkit-transform: scale3d(1, 1, 1);
            opacity: 1;
        }
    }

    .bg-img {
        background-image: url("/images/medicine2.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    img {
        max-width: 100%;
    }

</style>

<div class="main-content">
<div class="bg-img">
    <div class="title"> Medicine Dashboard</div>
    <div style="margin-top:8px">
        <div class="form_wrapper">

            <input type="hidden" id="abc">
            <div class="col-sm-6">
                <label for="name">Medicine Name <i class="text-danger">*</i></label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Medicine Name" value="">
            </div>
            <div class="col-sm-6">
                <label for="category">Category Name <i class="text-danger">*</i></label>
                <input name="category" type="text" class="form-control" id="category" placeholder="Category Name"
                    value="">
            </div>
            <div class="col-sm-12">
                <label for="description">Description </label><br>
                <textarea name="description" type="text" class="form-control" placeholder="Description" rows="1"
                    id="description"></textarea>
            </div>
            <div class="col-sm-12">
                <label for="manufactured_by">Manufactured By <i class="text-danger">*</i></label>
                <input name="manufactured_by" type="text" class="form-control" id="manufactured"
                    placeholder="ManufacyuredBy" value="">
            </div>
            <div class="col-sm-6">
                <label for="price">Price <i class="text-danger">*</i></label><input name="price" type="text"
                    class="form-control" id="price" placeholder="Price" value="">
            </div>
            <div class="col-sm-6">
                <label for="quantity">Quantity <i class="text-danger">*</i></label> <input name="quantity" type="text"
                    class="form-control" id="quantity" placeholder="Quantity" value="">
            </div>
            <div class="col-sm-6">
                <label for="quantity1" data-toggle="tooltip" data-placement="top"
                    title="A minimum order quantity (MOQ) is the lowest set amount of stock that a supplier is willing to sell, ( कम से कम आर्डर करने की क्वांटिटी )">Minimal
                    Order Quantity <i class="text-danger">*</i></label> <input name="quantity1" type="number"
                    class="form-control" id="minimumorder" placeholder="Quantity" value="">
            </div>
            <div class="col-sm-6">
                <label for="quantity2" data-toggle="tooltip" data-placement="top"
                    title="A minimum stock level refers to the minimum quantity of a particular item of material which must be kept in the stores at all times, ( कम से  कम  मात्रा  में  वस्तू  उपलब्ध होनी  चाहिए )">Minimal
                    Stock Level <i class="text-danger">*</i></label> <input name="quantity2" type="number"
                    class="form-control" id="minimumstock" placeholder="Quantity" value="">
            </div>
            <div class="col-sm-6">
                <label for="units">Units <i class="text-danger">*</i></label>
                <select id="units" class="form-control">
                    <?php 
                              echo '<option value="Select">Select</option>';
                              $result1=mysqli_query($con,"SELECT DISTINCTROW unitcode, unitdesc FROM `munit`");
                              while($rows1 = mysqli_fetch_assoc($result1)){
                                echo '<option value="'.$rows1['unitcode'].'">'.$rows1['unitdesc'].'</option>';
                            }
                       ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="gstrate">GST <i class="text-danger">*</i></label> <input name="gstrate" type="text"
                    class="form-control" id="gstrate" placeholder="Gst Rate" value="">
            </div>
            <div class="col-sm-12">
                <label>Status</label> <br><label class="radio-inline"><input type="radio" name="status" value="Active"
                        id="status" checked>Active</label>
                <label class="radio-inline"><input type="radio" name="status" value="Inactive"
                        id="status">Inactive</label>
                        <br><br> </div>
            <div align="right">
                <button class="btn btn-primary submit-btn btn-block" id="btn-submit" onclick="submit()">Save</button>
            </div>
        </div>
    </div>

    <div class="table-ui container-fluid" id="test-list">
        <div class="col-sm-3">
            <label for="usr"> Manufactured By:</label>
            <select id="manufactured1" style="width:80%" onchange="fun_manuf(this)" class="form-control">
                <?php 
                              echo '<option value="Select">Select</option>';
                              $result1=mysqli_query($con,"SELECT DISTINCTROW manufactured FROM `medicine`");
                              while($rows1 = mysqli_fetch_assoc($result1)){
                                echo '<option value="'.$rows1['manufactured'].'">'.$rows1['manufactured'].'</option>';
                            }
                            ?>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="usr"> Category By:</label>
            <select id="category1" style="width:80%" class="form-control">
                <option value="Select">Select</option>
            </select>
        </div>
        <div class="col-sm-3" id="test-list" style="margin-top:20px"> <input type="text"
                class="form-control input-sm fuzzy-search" style="margin-top:4px;margin-bottom:4px;" id="search"
                placeholder="Search Box"></div>

        <div class="col-sm-3" style="margin-top:15px">
            <button class="btn btn-primary submit-btn" onclick="fun_all()">Search</button>
        </div>
    </div>
    <br>
    <div class="list" style="margin-left:4px;">
        <div class="tr row">
            <div class="col-sm-2 th">Sr No.</div>
            <div class="col-sm-2 th">Medicine Name</div>
            <div class="col-sm-2 th">Quantity</div>
            <div class="col-sm-2 th">Price</div>
            <div class="col-sm-2 th">Status</div>
            <div class="col-sm-2 th">Action</div>
        </div>
    </div>
    </div>
</div>

<script>
    function fun_manuf(e) {
        document.getElementById('category1').innerHTML = "";
        $.ajax({
            type: "POST",
            data: "manuf=" + $(e).val(),
            url: 'getcate.php',
            success: function (res) {
                if (res.status == 'success') {
                    json = res.json;
                    $('#category1').append('<option value="Select">Select</option>');
                    for (var i in json) {
                        console.log(json[i]);
                        $('#category1').append(json[i]);
                    }
                }
            }
        });
    }

    function fun_all() {
        $('.chk').remove();
        $.ajax({
            type: "POST",
            data: "manuf=" + $('#manufactured1').val() + "&catf=" + $('#category1').val(),
            url: 'detail.php',
            success: function (res) {
                if (res.status == 'success') {
                    json = res.json;

                    $('.list').append(json);
                }
            }
        });
    }

    function submit() {

        var name = $('#name').val().trim(),
            category = $('#category').val().trim(),
            quantity = $('#quantity').val().trim(),
            price = $('#price').val().trim(),
            description = $('#description').val().trim(),
            units = $('#units').val().trim(),
            manufactured = $('#manufactured').val().trim(),
            minimumorder = $('#minimumorder').val().trim(),
            minimumstock = $('#minimumstock').val().trim(),
            gstrate = $('#gstrate').val().trim();

        valid = true;

        var status = $('#status:checked').val();

        if (name == '') {
            valid = valid * false;
            $('#name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#name').css('border-bottom', '1px solid green');
        }
        if (category == '') {
            valid = valid * false;
            $('#category').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#category').css('border-bottom', '1px solid green');
        }
        if (price == '') {
            valid = valid * false;
            $('#price').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#price').css('border-bottom', '1px solid green');
        }
        if (quantity == '') {
            valid = valid * false;
            $('#quantity').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#quantity').css('border-bottom', '1px solid green');
        }
        if (description == '') {
            valid = valid * false;
            $('#description').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#description').css('border-bottom', '1px solid green');
        }
        if (manufactured == '') {
            valid = valid * false;
            $('#manufactured').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#manufactured').css('border-bottom', '1px solid green');
        }
        if (minimumorder == '') {
            valid = valid * false;
            $('#minimumorder').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#minimumorder').css('border-bottom', '1px solid green');
        }
        if (minimumstock == '') {
            valid = valid * false;
            $('#minimumstock').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#minimumstock').css('border-bottom', '1px solid green');
        }
        if (units == '') {
            valid = valid * false;
            $('#units').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#units').css('border-bottom', '1px solid green');
        }
        if (gstrate == '') {
            valid = valid * false;
            $('#gstrate').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#gstrate').css('border-bottom', '1px solid green');
        }

        if (valid) {
            var arr = {
                "name": name,
                "category": category,
                "description": description,
                "price": price,
                "quantity": quantity,
                "manufactured": manufactured,
                "status": status,
                "units": units,
                "minimumorder": minimumorder,
                "minimumstock": minimumstock,
                "gstrate": gstrate
            }
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

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function edit(id) {
        $.ajax({
            type: "POST",
            url: 'select.php',
            data: "id=" + id,
            success: function (res) {
                if (res.status == 'success') {
                    $('#abc').val(id);
                    $('#btn-submit').text('Update');
                    $('#btn-submit').attr('onclick', 'update()');
                    var json = res.json[0];
                    $('#name').val(json.name);
                    $('#category').val(json.category);
                    $('#description').val(json.description);
                    $('#quantity').val(json.quantity);
                    $('#price').val(json.price);
                    $('#units').val(json.units);
                    $('#manufactured').val(json.manufactured);
                    $('#minimumorder').val(json.minimumorder);
                    $('#minimumstock').val(json.minimumstock);
                    $('#gstrate').val(json.gstrate);

                    var status = json.status;

                    console.log(status);
                    $("input[name=status][value=" + status + "]").attr('checked', 'checked');
                }
            }
        });
    }

    function deleteentry(id) {
        if (confirm('Are you sure you want to delete this thing into the database?')) {
            $.ajax({
                type: "POST",
                url: 'delete.php',
                data: "id=" + id,

                success: function (res) {
                    if (res.status == 'success') {
                        alert("Record deleted successfully");
                        location.reload();
                    }
                }
            });
        } else {
            alert('your record is safe');
        }
    }

    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".list .chk").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function update(id) {

        var name = $('#name').val().trim(),
            category = $('#category').val().trim(),
            quantity = $('#quantity').val().trim(),
            price = $('#price').val().trim(),
            units = $('#units').val().trim(),
            description = $('#description').val().trim(),
            manufactured = $('#manufactured').val().trim(),
            minimumorder = $('#minimumorder').val().trim(),
            minimumstock = $('#minimumstock').val().trim(),
            gstrate = $('#gstrate').val().trim();

        valid = true;

        var status = $('#status:checked').val();

        if (name == '') {
            valid = valid * false;
            $('#name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#name').css('border-bottom', '1px solid green');
        }
        if (category == '') {
            valid = valid * false;
            $('#category').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#category').css('border-bottom', '1px solid green');
        }
        if (price == '') {
            valid = valid * false;
            $('#price').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#price').css('border-bottom', '1px solid green');
        }
        if (quantity == '') {
            valid = valid * false;
            $('#quantity').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#quantity').css('border-bottom', '1px solid green');
        }
        if (description == '') {
            valid = valid * false;
            $('#description').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#description').css('border-bottom', '1px solid green');
        }
        if (manufactured == '') {
            valid = valid * false;
            $('#manufactured').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#manufactured').css('border-bottom', '1px solid green');
        }
        if (minimumorder == '') {
            valid = valid * false;
            $('#minimumorder').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#minimumorder').css('border-bottom', '1px solid green');
        }
        if (minimumstock == '') {
            valid = valid * false;
            $('#minimumstock').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#minimumstock').css('border-bottom', '1px solid green');
        }
        if (units == '') {
            valid = valid * false;
            $('#units').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#units').css('border-bottom', '1px solid green');
        }
        if (gstrate == '') {
            valid = valid * false;
            $('#gstrate').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#gstrate').css('border-bottom', '1px solid green');
        }

        if (valid) {
            var arr = {
                "name": name,
                "category": category,
                "description": description,
                "price": price,
                "quantity": quantity,
                "manufactured": manufactured,
                "status": status,
                "units": units,
                "minimumorder": minimumorder,
                "minimumstock": minimumstock,
                "gstrate": gstrate
            }

            var data = JSON.stringify(arr);

            $.ajax({
                type: "POST",
                url: 'update.php',
                data: {
                    id: $('#abc').val(),
                    data: data
                },
                success: function (res) {
                    if (res.status == 'success') {
                        alert("Record successfully updated");
                 
                   

                        location.reload();
                    }
                }
            });
        }
    }
</script>
