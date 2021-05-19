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

    .clearfix:after {
        content: "";
        display: block;
        clear: both;
        visibility: hidden;
        height: 0;
    }

    .form_wrapper {
        background: rgba(255, 255, 255, .8);
        width: 550px;
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
        padding: 0 10px;
        box-sizing: border-box;
    }

    .form_wrapper .col_half {
        width: 33%;
        float: left;
    }

    .form_wrapper .input_field {
        position: relative;
        margin-bottom: 02px;
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
        background-image: url("/images/ambulance.jpg");
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
    <div class="title"> Ambulance Dashboard</div>
    <br>
    <input type="hidden" id="abc">
    <div class="form_wrapper">
        <div class="col-sm-12">
            <label>Driver Name <i class="text-danger">*</i></label><input class="form-control" type="text"
                id="drivername">
        </div>
        <div class="col-sm-6"><label>Vehicle Name <i class="text-danger">*</i></label><input class="form-control"
                type="text" id="vehiclename"></div>

        <div class="col-sm-6">
            <label>Vehicle No <i class="text-danger">*</i></label><input class="form-control" type="text"
                id="vehicleno">
        </div>
        <div class="col-sm-6"><label>Phone No <i class="text-danger">*</i></label><input class="form-control"
                type="number" id="phoneno">
        </div>
        <div class="col-sm-6">
            <label>Email id <i class="text-danger">*</i></label><input class="form-control email" type="email"
                id="email"></div>

        <div class="col-sm-6">
            <label>Name of Organisation <i class="text-danger">*</i></label><input class="form-control" type="text"
                id="organisation"></div>

        <div class="col-sm-6"><label>Phone No <i class="text-danger">*</i></label><input class="form-control"
                type="number" id="o_phone"></div>

        <div class="col-sm-6"><label>Email id <i class="text-danger">*</i></label><input class="form-control o_email"
                type="email" id="o_email"></div>

        <div class="col-sm-6"><label>Supporting Person <i class="text-danger">*</i></label><input class="form-control"
                type="number" id="supportingperson"></div>

        <div class="col-sm-6"><label for="address">Address <i class="text-danger">*</i></label><textarea name="address"
                class="form-control tinymce" placeholder="Address" rows="1" id="address"></textarea>
        </div>
        <div class="col-sm-6"><label for="description">Description </label><textarea name="description"
                class="form-control tinymce" placeholder="Description" rows="1" id="description"></textarea></div>

        <div class="col-sm-12">
            <label for="description">Facility <i class="text-danger">*</i></label>
            <div class="checkbox">
                <label><input type="checkbox" class="facility" value="Resusitation Kit" id="resusitationkit">
                    Resusitation Kit</label>

                <label><input type="checkbox" class="facility" value="Ambu bag set oropharyngeal airway" id="ambubag">
                    Ambubag set oropharyngeal airway</label>
                <label><input type="checkbox" class="facility" value="First AidBox" id="firstaidbox"> First
                    AidBox</label>
                <label><input type="checkbox" class="facility" value="Oxygen Cylinder and Accessories" id="oxygen">
                    OxygenCylinder and Accessories<label></div>
        </div>
        <div>
            <button class="btn btn-primary btn-block" id="btn-submit" onclick="submit()">Save</button>
        </div>
    </div>
<br>
    <div class="list" style="margin-left:4px;">
        <div class="tr row">
            <div class="col-sm-1 th">Sr No.</div>
            <div class="col-sm-2 th">Driver Details</div>
            <div class="col-sm-2 th">Vehicle Details</div>
            <div class="col-sm-3 th">Organisation Details</div>
            <div class="col-sm-2 th">Facility</div>
            <div class="col-sm-2 th">Action</div>
        </div>

        <?php
    $result=mysqli_query($con,"SELECT * FROM `ambulance`");
    while($rows = mysqli_fetch_assoc($result)){
   
    echo '<div class="tr row abc">
                <div class="col-sm-1 td" > Id No. : '.$rows['id'].'  </div>
                <div class="col-sm-2 td">
                Driver Name : '.$rows['drivername'].' <br>
                Phone no. : '.$rows['phoneno'].' 
                  </div>
                <div class="col-sm-2 td">
                Vehicle Name : '.$rows['vehiclename'].' <br>
                Vehicle No. : '.$rows['vehicleno'].' <br> 
                Supporting Person : '.$rows['supportingperson'].'
                 </div>
                <div class="col-sm-3 td"> 
                Organisation Name : '.$rows['organisation'].' <br>
                Phone no. : '.$rows['o_phone'].' 
                </div>
                <div class="col-sm-2 td"> 
                Facility : '.$rows['facility'].' </div>
                
                <div class="col-sm-2 td">
                    <button class="btn btn-primary" onclick="edit('.$rows['id'].');" >Edit</button>
                    <button class="btn btn-danger" onclick="deleteentry('.$rows['id'].');" >Delete</button>
                </div>
              </div>';
        
      }
       ?>
    </div>
    </div>
    <script>
        function submit() {
            var filter =
                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            var drivername = $('#drivername').val().trim(),
                vehiclename = $('#vehiclename').val().trim(),
                vehicleno = $('#vehicleno').val().trim(),
                phoneno = $('#phoneno').val().trim(),
                email = $('#email').val().trim(),
                address = $('#address').val().trim(),
                description = $('#description').val().trim(),
                organisation = $('#organisation').val().trim(),
                o_phone = $('#o_phone').val().trim(),
                o_email = $('#o_email').val().trim(),
                supportingperson = $('#supportingperson').val().trim(),

                valid = true;

            var facility = [];
            if ($('#resusitationkit:checked').val() != undefined) {
                facility.push($('#resusitationkit:checked').val());
            }
            if ($('#firstaidbox:checked').val() != undefined) {
                facility.push($('#firstaidbox:checked').val());
            }
            if ($('#ambubag:checked').val() != undefined) {
                facility.push($('#ambubag:checked').val());
            }
            if ($('#oxygen:checked').val() != undefined) {
                facility.push($('#oxygen:checked').val());
            }

            console.log(facility);

            if (drivername == '') {
                valid = valid * false;
                $('#drivername').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#drivername').css('border-bottom', '1px solid green');
            }
            if (vehiclename == '') {
                valid = valid * false;
                $('#vehiclename').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#vehiclename').css('border-bottom', '1px solid green');
            }
            if (vehicleno == '') {
                valid = valid * false;
                $('#vehicleno').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#vehicleno').css('border-bottom', '1px solid green');
            }
            if (phoneno == '') {
                valid = valid * false;
                $('#phoneno').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#phoneno').css('border-bottom', '1px solid green');
            }
            if (!filter.test(email)) {
                valid = valid * false;
                $('#email').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#email').css('border-bottom', '1px solid green');
            }
            if (address == '') {
                valid = valid * false;
                $('#address').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#address').css('border-bottom', '1px solid green');
            }
            if (description == '') {
                valid = valid * false;
                $('#description').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#description').css('border-bottom', '1px solid green');
            }
            if (organisation == '') {
                valid = valid * false;
                $('#organisation').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#organisation').css('border-bottom', '1px solid green');
            }
            if (o_phone == '') {
                valid = valid * false;
                $('#o_phone').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#o_phone').css('border-bottom', '1px solid green');
            }
            if (!filter.test(o_email)) {
                valid = valid * false;
                $('#o_email').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#o_email').css('border-bottom', '1px solid green');
            }
            if (supportingperson == '') {
                valid = valid * false;
                $('#supportingperson').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#supportingperson').css('border-bottom', '1px solid green');
            }

            if (valid) {
                // $('#btn-submit').hide();
                var arr = {
                    "drivername": drivername,
                    "vehiclename": vehiclename,
                    "vehicleno": vehicleno,
                    "phoneno": phoneno,
                    "email": email,
                    "address": address,
                    "description": description,
                    "organisation": organisation,
                    "o_phone": o_phone,
                    "o_email": o_email,
                    "supportingperson": supportingperson
                }
                var data = JSON.stringify(arr);
                facility = JSON.stringify(facility);
                $.ajax({
                    type: "POST",
                    data: {
                        data: data,
                        data1: facility
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

                        $('#drivername').val(json.drivername);
                        $('#vehiclename').val(json.vehiclename);
                        $('#phoneno').val(json.phoneno);
                        $('#vehicleno').val(json.vehicleno);
                        $('#email').val(json.email);
                        $('#address').val(json.address);
                        $('#description').val(json.description);
                        $('#organisation').val(json.organisation);
                        $('#o_phone').val(json.o_phone);
                        $('#o_email').val(json.o_email);
                        $('#supportingperson').val(json.supportingperson);
                        var arr1 = json.facility;

                        $('.facility').each(function () {
                            var faci = $(this).val();

                            for (var i in arr1) {
                                if (arr1[i] == faci) {
                                    $(this).prop("checked", true);
                                }
                            }

                        })
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
            var filter =
                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            var drivername = $('#drivername').val().trim(),
                vehiclename = $('#vehiclename').val().trim(),
                vehicleno = $('#vehicleno').val().trim(),
                phoneno = $('#phoneno').val().trim(),
                email = $('#email').val().trim(),
                address = $('#address').val().trim(),
                description = $('#description').val().trim(),
                organisation = $('#organisation').val().trim(),
                o_phone = $('#o_phone').val().trim(),
                o_email = $('#o_email').val().trim(),
                supportingperson = $('#supportingperson').val().trim(),

                valid = true;

            var facility = [];
            if ($('#resusitationkit:checked').val() != undefined) {
                facility.push($('#resusitationkit:checked').val());
            }
            if ($('#firstaidbox:checked').val() != undefined) {
                facility.push($('#firstaidbox:checked').val());
            }
            if ($('#ambubag:checked').val() != undefined) {
                facility.push($('#ambubag:checked').val());
            }
            if ($('#oxygen:checked').val() != undefined) {
                facility.push($('#oxygen:checked').val());
            }

            console.log(facility);

            if (drivername == '') {
                valid = valid * false;
                $('#drivername').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#drivername').css('border-bottom', '1px solid green');
            }

            if (vehiclename == '') {
                valid = valid * false;
                $('#vehiclename').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#vehiclename').css('border-bottom', '1px solid green');
            }

            if (vehicleno == '') {
                valid = valid * false;
                $('#vehicleno').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#vehicleno').css('border-bottom', '1px solid green');
            }

            if (phoneno == '') {
                valid = valid * false;
                $('#phoneno').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#phoneno').css('border-bottom', '1px solid green');
            }
            if (!filter.test(email)) {
                valid = valid * false;
                $('#email').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#email').css('border-bottom', '1px solid green');
            }

            if (address == '') {
                valid = valid * false;
                $('#address').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#address').css('border-bottom', '1px solid green');
            }

            if (description == '') {
                valid = valid * false;
                $('#description').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#description').css('border-bottom', '1px solid green');
            }

            if (organisation == '') {
                valid = valid * false;
                $('#organisation').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#organisation').css('border-bottom', '1px solid green');
            }

            if (o_phone == '') {
                valid = valid * false;
                $('#o_phone').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#o_phone').css('border-bottom', '1px solid green');
            }
            if (!filter.test(o_email)) {
                valid = valid * false;
                $('#o_email').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#o_email').css('border-bottom', '1px solid green');
            }

            if (supportingperson == '') {
                valid = valid * false;
                $('#supportingperson').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#supportingperson').css('border-bottom', '1px solid green');
            }

            if (valid) {
                // $('#btn-submit').hide();
                var arr = {
                    "drivername": drivername,
                    "vehiclename": vehiclename,
                    "vehicleno": vehicleno,
                    "phoneno": phoneno,
                    "email": email,
                    "address": address,
                    "description": description,
                    "organisation": organisation,
                    "o_phone": o_phone,
                    "o_email": o_email,
                    "supportingperson": supportingperson
                }
                var data = JSON.stringify(arr);
                facility = JSON.stringify(facility);
                $.ajax({
                    type: "POST",
                    url: 'update.php',
                    data: {
                        id: $('#abc').val(),
                        data: data,
                        data1: facility
                    },

                    success: function (res) {
                        if (res.status == 'success') {
                            alert('Data SuccessFull Updated');
                            location.reload();

                        }
                    }
                });
            }
        }
    </script>
