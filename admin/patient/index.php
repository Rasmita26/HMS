<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

$uhid_no=mysqli_fetch_assoc(mysqli_query($con,"SELECT max(uhid_no) x FROM patient_details"))['x'];
$uhid_no++;


$json1='';
$result1=mysqli_query($con,"SELECT id,patient_name FROM patient_details");
while($rows1 = mysqli_fetch_assoc($result1)){
 $patient_name=$rows1["patient_name"];
 $id=$rows1["id"];
 $json1.=',{"patient_name":"'.$patient_name.'","id":"'.$id.'"}';   
}

$json1=substr($json1,1);
$json1='['.$json1.']';
?>
<style>
    .sidenav1 {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 2;
        top: 85px;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 10px;
    }

    .sidenav1 a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav1 a:hover {
        color: #f1f1f1;
    }

    .sidenav1 .closebtn1 {
        position: absolute;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
        .sidenav1 {
            padding-top: 15px;
        }

        .sidenav1 a {
            font-size: 18px;
        }
    }

    .list {
        padding: 0px;
    }

    .list li span {
        display: inline;
    }

    .list li {
        text-decoration: none;
        display: block;
        padding: 2px;
        background: #FFF;
        border: 1px solid #333;
        color: #000;
    }

    body {
        font-family: Verdana, Geneva, sans-serif;
        font-size: 14px;
        background: #f2f2f2;
    }

    .form_wrapper {
        background: rgba(255, 255, 255, .7);
        width: 550px;
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
        background-image: url("/images/image.jpg");
        height: auto;
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
        <div class="title">REGISTRATION</div> <br>
        <!-- <input type="hidden" id="abc"> -->
      
        <input type="hidden" id="item-json4" value='<?php echo str_replace("'"," &#39;",$json1); ?>' />
        <span style="font-size:20px;cursor:pointer" onclick="openNav1()">&#9776; Search</span>
        <div id="mysidenav1" class="sidenav1" style="margin-left:65px;">

            <div id="test-list" style="padding:5px;">
                <a href="javascript:void(0)" class="closebtn1" onclick="closeNav1()">&times;</a>
                <br><br><br>
                <div class="form-group">
                    <input type="text" placeholder="Search" id="search" class="form-control input-sm fuzzy-search"
                        style="border-radius:3px;">
                </div>
                <ul class="list">
                </ul>
            </div>
        </div>
        <script>
            var json4 = JSON.parse($("#item-json4").val());
            console.log(json4);
            // var strdb1 = '';
            var selectdb5 = '';
            for (var i in json4) {

                selectdb5 += '<li><span class="patientid">' + (json4[i].patient_name) +
                    '</span><button style="margin-left:2px;" data-patientid="' + json4[i].id + '" onclick="edit(' +
                    json4[i].id +
                    ')" class="btn btn-primary btn-sm"> <span class="fa fa-edit"></span> E</button> <button style="margin-left:2px;" data-patientid="' +
                    json4[i].id + '" onclick="deleteentry(' + json4[i].id +
                    ')" class="btn btn-danger btn-sm"> <span class="fa fa-edit"></span> D</button></li>';
                // strdb1 += '<option value="' + json1[i].fname + '">' + capitalize_Words(json1[i].fname) + '</option>';

            }
            $('.list').append(selectdb5);

            function openNav1() {
                console.log('abc');

                document.getElementById("mysidenav1").style.width = "292px";
            }

            function closeNav1() {
                document.getElementById("mysidenav1").style.width = "0";
            }
            var monkeyList = new List('test-list', {
                valueNames: ['patientid']
            });
        </script>


        <div class="container-fluid">
            <div class="form_wrapper">
                <div class="col-sm-6">
                    <label>Registration Date</label>
                    <input class="form-control" type="date" id="registration_date">
                </div>
                <div class="col-sm-6">
                    <label>UHID No.</label>
                    <input class="form-control" type="text" id="uhid_no" value="<?php echo $uhid_no; ?>" readonly>
                </div>
                <div class="col-sm-6">
                    <label>Patient Name<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="patient_name">
                </div>
                <div class="col-sm-6">
                    <label>Relative Name</label>
                    <input class="form-control" type="text" id="relative_name">
                </div>
                <div class="col-sm-6">
                    <label>Gender<span class="text-danger">*</span></label><br>
                    <input type="radio" name="radio1" id="gender" value="Male">
                    <label  style="margin-right:15px">Male</label>
                    <input type="radio" name="radio1" id="gender" value="Female" checked>
                    <label>Female</label><br>
                    <input type="radio" name="radio1" id="gender" value="Transgender">
                    <label>Transgender</label>
                </div>

                <div class="col-sm-6">
                    <label>Address <span class="text-danger">*</span></label>
                    <textarea placeholder="Enter Address Here.." class="form-control" rows="2" id="address"></textarea>
                </div>

                <div class="col-sm-6">
                    <label>DOB</label>
                    <input class="form-control" type="date" id="dob" onchange="calculate_age()">
                </div>
                <div class="col-sm-6">
                    <label>Age</label>
                    <input class="form-control" type="text" id="age">
                </div>
               
                <div class="col-sm-6">
                    <label>Mobile No.1</label>
                    <input class="form-control" type="number" id="mobileno1">
                </div>
                <div class="col-sm-6">
                    <label>Mobile No.2</label>
                    <input class="form-control" type="number" id="mobileno2">
                </div>
                <div class="col-sm-6">
                    <label>Consulting Doctor</label>
                    <input class="form-control" type="text" id="consulting_doctor">
                </div>
                <div class="col-sm-6">
                    <label>Reffered By</label>
                    <input class="form-control" type="text" id="reffered_by">
                </div>
                <div class="col-sm-6">
                    <label>Disease</label><input class="form-control" type="text" id="disease">
                </div>
                <div class="col-sm-6">
                    <label>Deposit</label><input class="form-control" type="number" id="deposit"><br>
                </div>
                <div class="col-sm-12">
                    <label>Type <span class="text-danger">*</span></label><br>
                    <input class="form-check-input" type="radio" name="status" id="type" value="Treatment" checked>
                    <label> Treatment/ipd</label>
                    <input style="margin-left:10px" class="form-check-input" type="radio" name="status" id="type"
                        value="Surgery">
                    <label> surgery/opd</label>
                </div>
                <div>
                    <button class="btn btn-primary  btn-sm btn-block submit-btn" id="btn-submit"
                        onclick="submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function calculate_age(){

var dob1 = $('#dob').val();
dob = new Date(dob1);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
console.log(age);

$('#age').val(age);
}
    function submit() {


        var registration_date = $('#registration_date').val().trim(),
            uhid_no = $('#uhid_no').val().trim(),
            patient_name = $('#patient_name').val().trim(),
            relative_name = $('#relative_name').val().trim(),
            address = $('#address').val().trim(),
            mobileno1 = $('#mobileno1').val().trim(),
            mobileno2 = $('#mobileno2').val().trim(),
            dob = $('#dob').val().trim(),
            age = $('#age').val().trim(),
            consulting_doctor = $('#consulting_doctor').val().trim(),
            reffered_by = $('#reffered_by').val().trim(),
            disease = $('#disease').val().trim(),
            deposit = $('#deposit').val().trim(),



            valid = true;
        var gender = $('#gender:checked').val();
        var type = $('#type:checked').val();

        console.log(gender);
        console.log(type);

        if (registration_date == '') {
            valid = valid * false;
            $('#registration_date').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#registration_date').css('border-bottom', '1px solid green');
        }

        if (uhid_no == '') {
            valid = valid * false;
            $('#uhid_no').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#uhid_no').css('border-bottom', '1px solid green');
        }

        if (patient_name == '') {
            valid = valid * false;
            $('#patient_name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#patient_name').css('border-bottom', '1px solid green');
        }

        if (address == '') {
            valid = valid * false;
            $('#address').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#address').css('border-bottom', '1px solid green');
        }

        if (relative_name == '') {
            valid = valid * false;
            $('#relative_name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#relative_name').css('border-bottom', '1px solid green');
        }

        if (mobileno1 == '') {
            valid = valid * false;
            $('#mobileno1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#mobileno1').css('border-bottom', '1px solid green');
        }

        if (dob == '') {
            valid = valid * false;
            $('#dob').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#dob').css('border-bottom', '1px solid green');
        }


        if (age == '') {
            valid = valid * false;
            $('#age').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#age').css('border-bottom', '1px solid green');
        }


        if (consulting_doctor == '') {
            valid = valid * false;
            $('#consulting_doctor').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#consulting_doctor').css('border-bottom', '1px solid green');
        }


        if (reffered_by == '') {
            valid = valid * false;
            $('#reffered_by').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#reffered_by').css('border-bottom', '1px solid green');
        }

        if (disease == '') {
            valid = valid * false;
            $('#disease').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#disease').css('border-bottom', '1px solid green');
        }

        if (deposit == '') {
            valid = valid * false;
            $('#deposit').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#deposit').css('border-bottom', '1px solid green');
        }

        if (valid) {

            // $('#btn-submit').hide();
            var arr = {
                "registration_date": registration_date,
                "uhid_no": uhid_no,
                "patient_name": patient_name,
                "relative_name": relative_name,
                "gender": gender,
                "address": address,
                "mobileno1": mobileno1,
                "mobileno2": mobileno2,
                "dob": dob,
                "age": age,
                "consulting_doctor": consulting_doctor,
                "reffered_by": reffered_by,
                "disease": disease,
                "type": type,
                "deposit": deposit

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
                            $('#abc').val(res.id);
                            window.location = '/admin/bedmaster/index.php?id=' + res.pid;
                        } else {
                            $('#btn-submit').show();
                        }
                    }
                }

            );
        }
    }


    function edit(id) {
        closeNav1();

        $.ajax({
            type: "POST",
            url: 'select.php',
            data: "id=" + id,
            
            // $date1=$rows['date'];
            // $date= date("d-m-Y",$date1/1000);

            success: function (res) {
                if (res.status == 'success') {
                    $('#item-json4').val(id);
                    $('#btn-submit').text('Update');
                    $('#btn-submit').attr('onclick', 'update()');
                    var json = res.json[0];
                    $('#registration_date').val(json.registration_date);
                    $('#uhid_no').val(json.uhid_no);
                    $('#patient_name').val(json.patient_name);
                    $('#address').val(json.address);
                    $('#relative_name').val(json.relative_name);
                    $('#disease').val(json.disease);
                    $('#mobileno1').val(json.mobileno1);
                    $('#mobileno2').val(json.mobileno2);
                    $('#dob').val(json.dob);
                    $('#consulting_doctor').val(json.consulting_doctor);
                    $('#reffered_by').val(json.reffered_by);
                    $('#age').val(json.age);
                    $('#deposit').val(json.deposit);

                    var gender = json.gender;
                    var type = json.type;
                    console.log(gender);
                    console.log(type);
                    $("input[name=radio1][value=" + gender + "]").attr('checked', 'checked');
                    $("input[name=status][value=" + type + "]").attr('checked', 'checked');
                }
            }
        });
    }

    function update() {

        var registration_date = $('#registration_date').val().trim(),
            uhid_no = $('#uhid_no').val().trim(),
            patient_name = $('#patient_name').val().trim(),
            relative_name = $('#relative_name').val().trim(),
            address = $('#address').val().trim(),
            mobileno1 = $('#mobileno1').val().trim(),
            mobileno2 = $('#mobileno2').val().trim(),
            dob = $('#dob').val().trim(),
            age = $('#age').val().trim(),
            consulting_doctor = $('#consulting_doctor').val().trim(),
            reffered_by = $('#reffered_by').val().trim(),
            disease = $('#disease').val().trim(),
            deposit = $('#deposit').val().trim(),



            valid = true;
        var gender = $('#gender:checked').val();
        var type = $('#type:checked').val();

        console.log(gender);
        console.log(type);

        if (registration_date == '') {
            valid = valid * false;
            $('#registration_date').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#registration_date').css('border-bottom', '1px solid green');
        }

        if (uhid_no == '') {
            valid = valid * false;
            $('#uhid_no').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#uhid_no').css('border-bottom', '1px solid green');
        }

        if (patient_name == '') {
            valid = valid * false;
            $('#patient_name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#patient_name').css('border-bottom', '1px solid green');
        }

        if (address == '') {
            valid = valid * false;
            $('#address').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#address').css('border-bottom', '1px solid green');
        }

        if (relative_name == '') {
            valid = valid * false;
            $('#relative_name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#relative_name').css('border-bottom', '1px solid green');
        }

        if (mobileno1 == '') {
            valid = valid * false;
            $('#mobileno1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#mobileno1').css('border-bottom', '1px solid green');
        }

        if (dob == '') {
            valid = valid * false;
            $('#dob').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#dob').css('border-bottom', '1px solid green');
        }


        if (age == '') {
            valid = valid * false;
            $('#age').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#age').css('border-bottom', '1px solid green');
        }


        if (consulting_doctor == '') {
            valid = valid * false;
            $('#consulting_doctor').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#consulting_doctor').css('border-bottom', '1px solid green');
        }


        if (reffered_by == '') {
            valid = valid * false;
            $('#reffered_by').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#reffered_by').css('border-bottom', '1px solid green');
        }

        if (disease == '') {
            valid = valid * false;
            $('#disease').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#disease').css('border-bottom', '1px solid green');
        }

        if (deposit == '') {
            valid = valid * false;
            $('#deposit').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#deposit').css('border-bottom', '1px solid green');
        }

        if (valid) {

            // $('#btn-submit').hide();
            var arr = {
                "registration_date": registration_date,
                "uhid_no": uhid_no,
                "patient_name": patient_name,
                "relative_name": relative_name,
                "gender": gender,
                "address": address,
                "mobileno1": mobileno1,
                "mobileno2": mobileno2,
                "dob": dob,
                "age": age,
                "consulting_doctor": consulting_doctor,
                "reffered_by": reffered_by,
                "disease": disease,
                "type": type,
                "deposit": deposit

            }

            var data = JSON.stringify(arr);

            $.ajax({
                type: "POST",
                data: {
                    id: $('#item-json4').val(),
                    data: data
                },
                url: 'update.php',
                success: function (res) {
                    if (res.status == 'success') {
                        alert("Record Updated Successfully");
                        location.reload();

                        $('#item-json4').val(res.id);
                    } else {
                        $('#btn-submit').show();
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
                        $('#item-json4').val(id);
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
