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
        width: 500px;
        max-width: 100%;
        box-sizing: border-box;
        padding: 5px;
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
        padding: 8px;
        box-sizing: border-box;
    }
    .form_wrapper .input_field {
        position: relative;
        margin-bottom: 4px;
        -webkit-animation: bounce 0.6s ease-out;
        animation: bounce 0.6s ease-out;
    }
    .form_wrapper .input_field>span {
        position: absolute;
        left: 0;
        top: 0;
        color: #333;
        height: 100%;
        border-right: 1px solid #ccc;
        text-align: center;
        width: 10px;
    }
    .form_container .row .col_half.last {
        border-left: 1px solid #ccc;
    }
    .radio_option input:hover+label:before {
        border-color: #000;
    }
    .radio_option input:checked+label:before {
        background-color: #000;
        border-color: #000;
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
        background-image: url("/images/room1.jpg");
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
    <div class="title"> Room Allotment</div>
    <div style="margin-top:15px">
        <input type="hidden" id="abc">
        <!-- <div class="container" style="background-color:white"> -->
        <div class="form_wrapper">

            <div class="input_field">
                <div><label> Ward Type </label></div>
                <div class="input_field radio_option">
                    <input type="radio" name="rooms" class="rooms" value="General" id="room">
                    <label style="margin-right:30px;">General</label>
                    <input type="radio" name="rooms" class="rooms" value="ICU" id="room">
                    <label>ICU</label>
                </div>
            </div>
            <div class="input_field">
                <div><label>Room Type </label></div>
                <input class="form-control" type="text" name="city" list="roomtype" id="roomtype1">
                <datalist id="roomtype">
                        <!-- <option value="Single">Single</option> -->
                        <!--<option value="Multibed Ward">
                        <option value="Twin Sharing">
                        <option value="Single Delux">
                        <option value="Super Delux">
                        <option value="Suite"> -->
                    <?php 
            $result1=mysqli_query($con, "SELECT DISTINCTROW roomtype FROM  room ORDER BY id ASC");
            while($row1=mysqli_fetch_assoc($result1)) {
                $roomtype=$row1['roomtype'];
            echo '<option value="'.$roomtype.'">'.$roomtype.'</option>';

            }
        ?>
                </datalist>
            </div>

            <div class="input_field"><label>Counts</label>
                <input class="form-control" type="number" id="countno">
            </div>

            <div class="input_field"><label>Price</label><input class="form-control" type="number" id="price">
            </div>

            <button class="btn btn-primary submit-btn btn-block" id="btn-submit" onclick="submit()">Save</button>
      </div>
      <br>

        <div class="list" style="margin-left:4px;">
            <div class="tr row">
                <div class="col-sm-2 th">Sr No.</div>
                <div class="col-sm-2 th">Room</div>
                <div class="col-sm-2 th">Room Type</div>
                <div class="col-sm-2 th">Count No.</div>
                <div class="col-sm-2 th">Price</div>
                <div class="col-sm-2 th">Action</div>
            </div>
            <?php
                $result=mysqli_query($con,"SELECT * FROM `room`");
                while($rows = mysqli_fetch_assoc($result)){
            
                echo '<div class="tr row abc">
                            <div class="col-sm-2 td" > Id No. : '.$rows['id'].'  </div>
                            <div class="col-sm-2 td"> Room : '.$rows['room'].'  </div>
                            <div class="col-sm-2 td"> Room Type: '.$rows['roomtype'].' </div>
                            <div class="col-sm-2 td"> Count No. : '.$rows['countno'].' </div>
                            <div class="col-sm-2 td"> Price : '.$rows['price'].' </div>
                            
                            <div class="col-sm-2 td">
                                <button class="btn btn-primary" onclick="edit('.$rows['id'].');" >Edit</button>
                                <button class="btn btn-danger" onclick="deleteentry('.$rows['id'].');" >Delete</button>
                            </div>
                        </div>';
                    
                }

       ?>
        </div>
    </div>
    </div>
</div>
<script>
    function submit() {

        var roomtype = $('#roomtype1').val().trim(),
            countno = $('#countno').val().trim(),
            price = $('#price').val().trim(),

            valid = true;

        var room = $('#room:checked').val();
        console.log(room);

        if (roomtype == '') {
            valid = valid * false;
            $('#roomtype1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#roomtype1').css('border-bottom', '1px solid green');
        }
        if (countno == '') {
            valid = valid * false;
            $('#countno').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#countno').css('border-bottom', '1px solid green');
        }
        if (price == '') {
            valid = valid * false;
            $('#price').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#price').css('border-bottom', '1px solid green');
        }
        if (valid) {
          
            var arr = {
                "room": room,
                "roomtype": roomtype,
                "countno": countno,
                "price": price
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
                    $('#roomtype1').val(json.roomtype);
                    $('#countno').val(json.countno);
                    $('#price').val(json.price);

                    var rooom = json.rooom;

                    console.log(rooom);
                    $("input[name=rooms][value=" + rooom + "]").attr('checked', 'checked');

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

    function update(id) {

        var roomtype = $('#roomtype1').val().trim(),
            countno = $('#countno').val().trim(),
            price = $('#price').val().trim(),
            valid = true;

        var room = $('#room:checked').val();
        console.log(room);

        if (roomtype == '') {
            valid = valid * false;
            $('#roomtype1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#roomtype1').css('border-bottom', '1px solid green');
        }
        if (countno == '') {
            valid = valid * false;
            $('#countno').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#countno').css('border-bottom', '1px solid green');
        }
        if (price == '') {
            valid = valid * false;
            $('#price').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#price').css('border-bottom', '1px solid green');
        }
        if (valid) {
            var arr = {
                "room": room,
                "roomtype": roomtype,
                "countno": countno,
                "price": price
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
</script>