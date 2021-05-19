<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

$json1='';
$result1=mysqli_query($con,"SELECT id,doctorname FROM doctor");
while($rows1 = mysqli_fetch_assoc($result1)){
 $doctorname=$rows1["doctorname"];
 $id=$rows1["id"];
 $json1.=',{"doctorname":"'.$doctorname.'","id":"'.$id.'"}';   
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
        width: 620px;
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
    <div class="title"> Doctor Dashboard</div>
    <div style="margin-top:8px">

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
    
        selectdb5 += '<li><span class="doctorid">' + (json4[i].doctorname) + '</span><button style="margin-left:2px;" data-doctorid="' + json4[i].id + '" onclick="edit('+json4[i].id+')" class="btn btn-primary btn-sm"> <span class="fa fa-edit"></span> E</button> <button style="margin-left:2px;" data-doctorid="' + json4[i].id + '" onclick="deleteentry('+json4[i].id+')" class="btn btn-danger btn-sm"> <span class="fa fa-edit"></span> D</button></li>';
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
    valueNames: ['doctorid']
});

        </script>


        <div class="container-fluid">
            <div class="form_wrapper">
                <div class="col-sm-6"><label> Name of Doctor<span class="text-danger">*</span></label><input
                        class="form-control" type="text" id="doctorname">
                        <input type="hidden" id="ids">
                </div>
                <div class="col-sm-6"><label>Specialists<span class="text-danger">*</span></label><input
                        class="form-control" type="text" id="specialist"></div>
                <div class="col-sm-6"><label>Qualification<span class="text-danger">*</span></label><input
                        class="form-control" type="text" id="qualification"></div>
                <div class="col-sm-6"><label>Experience<span class="text-danger">*</span></label><input
                        class="form-control" type="text" id="experience"></div>

                <div class="col-sm-6">
                    <label>From<span class="text-danger">*</span></label><br>
                    <input class="form-control" type="time" id="frmtime">
                </div>
                <div class="col-sm-6">
                    <label>To<span class="text-danger">*</span></label><br>
                    <input class="form-control" type="time" id="totime">
                </div>
                
                <div class="col-sm-6"><label>Phone No<span class="text-danger">*</span></label><input
                        class="form-control" type="number" id="phone" pattern="[789][0-9]{9}"></div>
                <div class="col-sm-6"><label>City<span class="text-danger">*</span></label><input class="form-control"
                        type="text" id="city"></div>
                <div class="col-sm-6"><label>Email id<span class="text-danger">*</span></label><input
                        class="form-control email" type="email" id="email">
                </div>
                <div class="col-sm-6"><label>Designation<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="designation"></div>
                <div class="col-sm-12">
                    <label for="description">Visting Days<span class="text-danger">*</span> </label>
                    <div class="checkbox">
                        <label><input class="days" type="checkbox" value="Sunday" id="sunday">Sunday</label>
                        <label><input class="days" type="checkbox" value="Monday" id="monday">Monday</label>
                        <label><input class="days" type="checkbox" value="Tuesday" id="tuesday">Tuesday</label>
                        <label><input class="days" type="checkbox" value="Wednesday" id="wednesday">Wednesday</label>
                        <label><input class="days" type="checkbox" value="Thursday" id="thursday">Thursday</label>
                        <label><input class="days" type="checkbox" value="Friday" id="friday">Friday</label>
                        <label><input class="days" type="checkbox" value="Saturday" id="saturday">Saturday</label>
                    </div>
                </div>
               
                <div class="col-sm-6"><label>Patient's checked<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="pcheck"></div>
                <div class="col-sm-6"><label>Aadhar Card No<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="aadhar"></div>
                <div class="col-sm-6"><label>Pan Card No<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="pancard"></div>
                <div class="col-sm-6"><label>Bank Name<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="bankname"></div>
                <div class="col-sm-6"><label>Account No.<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="accountno"></div>
                <div class="col-sm-6"><label>IFSC Code<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="ifsc"><br>
                </div>
                <div align="right">
                    <button class="btn btn-primary submit-btn btn-block" id="btn-submit" onclick="submit()">Save</button>
                </div>
            </div>
        </div>
        </div>
    <br></div>
    <!-- <div class="table-ui container-fluid" id="test-list">
        <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:3px;margin-bottom:3px;"
            id="search" placeholder="Search Box"></div>
    <div class="list" style="margin-left:4px;">
        <div class="tr row">
            <div class="col-sm-1 th">Sr No.</div>
            <div class="col-sm-2 th">Doctor Name</div>
            <div class="col-sm-2 th">Specialist</div>
            <div class="col-sm-2 th">Mobile No.</div>
            <div class="col-sm-2 th">Email</div>
            <div class="col-sm-1 th">City</div>
            <div class="col-sm-2 th">Action</div>
        </div>

        <?php
            $result=mysqli_query($con,"SELECT * FROM `doctor`");
            while($rows = mysqli_fetch_assoc($result)){

            echo '<div class="tr row abc">
                <div class="col-sm-1 td"> '.$rows['id'].' </div>
                <div class="col-sm-2 td"> '.$rows['doctorname'].' </div>
                <div class="col-sm-2 td"> '.$rows['specialist'].' </div>
                <div class="col-sm-2 td"> '.$rows['phone'].' </div>
                <div class="col-sm-2 td"> '.$rows['email'].' </div>
                <div class="col-sm-1 td"> '.$rows['city'].' </div>
                <div class="col-sm-2 td">
                    <button class="btn btn-primary" onclick="edit('.$rows['id'].');">Edit</button>
                    <button class="btn btn-danger" onclick="deleteentry('.$rows['id'].');">Delete</button>
                </div>
            </div>';

            }
       ?>
    </div>
    <div> -->
        <script>
            // $(document).ready(function () {
            //     $("#search").on("keyup", function () {
            //         var value = $(this).val().toLowerCase();
            //         $(".list .abc").filter(function () {
            //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //         });
            //     });
            // });

            function edit(id) {
            closeNav1();
            $('.days').each(function () {
                        $(this).prop("checked", false);
                })

            $.ajax({
                type: "POST",
                url: 'select.php',
                data: "id=" + id,
                success: function (res) {
                    if (res.status == 'success') {
                        $('#ids').val(id);
                        $('#btn-submit').text('Update');
                        $('#btn-submit').attr('onclick', 'update()');
                        var json = res.json[0];
                        console.log(json.frmtime);
                        
                        $('#doctorname').val(json.doctorname);
                        $('#specialist').val(json.specialist);
                        $('#phone').val(json.phone);
                        $('#qualification').val(json.qualification);
                        $('#experience').val(json.experience);
                        $('#city').val(json.city);
                        $('#email').val(json.email);
                        $('#frmtime').val(json.frmtime);
                        // $("input[type=time]").val(json.frmtime);
                        // document.getElementById("time").value = json.frmtime;

                        $('#totime').val(json.totime);
                        $('#designation').val(json.designation);
                        var day = json.days;
                        console.log(day);
                        
                            var arr =day;
                            $('.days').each(function () {
                            var daycout = $(this).val();
                            for (var i in arr) {
                                if (arr[i] == daycout) {
                                    $(this).prop("checked", true);
                                }
                            }

                        })
                        
                       
                        // $('#days').val();

                        $('#aadhar').val(json.aadhar);
                        $('#pancard').val(json.pancard);
                        $('#pcheck').val(json.pcheck);
                        $('#bankname').val(json.bankname);
                        $('#accountno').val(json.accountno);
                        $('#ifsc').val(json.ifsc);

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

            function submit() {
                var filter =
                    /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

                var doctorname = $('#doctorname').val().trim(),
                    specialist = $('#specialist').val().trim(),
                    phone = $('#phone').val().trim(),
                    qualification = $('#qualification').val().trim(),
                    experience = $('#experience').val().trim(),
                    city = $('#city').val().trim(),
                    email = $('#email').val().trim(),
                    totime = $('#totime').val().trim(),
                    frmtime = $('#frmtime').val().trim(),
                    aadhar = $('#aadhar').val().trim(),
                    pancard = $('#pancard').val().trim(),
                    pcheck = $('#pcheck').val().trim(),
                    bankname = $('#bankname').val().trim(),
                    accountno = $('#accountno').val().trim(),
                    ifsc = $('#ifsc').val().trim();
                    designation = $('#designation').val().trim();

                valid = true;

                var day = [];
                if ($('#monday:checked').val() != undefined) {
                    day.push($('#monday:checked').val());
                }
                if ($('#tuesday:checked').val() != undefined) {
                    day.push($('#tuesday:checked').val());
                }
                if ($('#wednesday:checked').val() != undefined) {
                    day.push($('#wednesday:checked').val());
                }
                if ($('#thursday:checked').val() != undefined) {
                    day.push($('#thursday:checked').val());
                }
                if ($('#friday:checked').val() != undefined) {
                    day.push($('#friday:checked').val());
                }
                if ($('#saturday:checked').val() != undefined) {
                    day.push($('#saturday:checked').val());
                }
                if ($('#sunday:checked').val() != undefined) {
                    day.push($('#sunday:checked').val());
                }
                // var day = [{
                //     monday : $('#monday:checked').val(),
                //     tuesday : $("#tuesday:checked").val(),
                //     wednesday : $('#wednesday:checked').val(),
                //     thursday : $("#thursday:checked").val(),
                //     friday : $('#friday:checked').val(),
                //     saturday : $("#saturday:checked").val(),
                //     sunday : $("#sunday:checked").val()
                // }]

                console.log(day);
                designation
                if (designation == '') {
                    valid = valid * false;
                    $('#designation').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#designation').css('border-bottom', '1px solid green');
                }
                if (doctorname == '') {
                    valid = valid * false;
                    $('#doctorname').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#doctorname').css('border-bottom', '1px solid green');
                }
                if (specialist == '') {
                    valid = valid * false;
                    $('#specialist').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#specialist').css('border-bottom', '1px solid green');
                }
                if (phone == '') {
                    valid = valid * false;
                    $('#phone').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#phone').css('border-bottom', '1px solid green');
                }
                if (qualification == '') {
                    valid = valid * false;
                    $('#qualification').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#qualification').css('border-bottom', '1px solid green');
                }
                if (experience == '') {
                    valid = valid * false;
                    $('#experience').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#experience').css('border-bottom', '1px solid green');
                }
                if (city == '') {
                    valid = valid * false;
                    $('#city').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#city').css('border-bottom', '1px solid green');
                }
                if (!filter.test(email)) {
                    valid = valid * false;
                    $('#email').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#email').css('border-bottom', '1px solid green');
                }
                if (frmtime == '') {
                    valid = valid * false;
                    $('#frmtime').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#frmtime').css('border-bottom', '1px solid green');
                }
                if (totime == '') {
                    valid = valid * false;
                    $('#totime').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#totime').css('border-bottom', '1px solid green');
                }
                if (aadhar == '') {
                    valid = valid * false;
                    $('#aadhar').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#aadhar').css('border-bottom', '1px solid green');
                }
                if (pancard == '') {
                    valid = valid * false;
                    $('#pancard').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#pancard').css('border-bottom', '1px solid green');
                }
                if (pcheck == '') {
                    valid = valid * false;
                    $('#pcheck').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#pcheck').css('border-bottom', '1px solid green');
                }
                if (bankname == '') {
                    valid = valid * false;
                    $('#bankname').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#bankname').css('border-bottom', '1px solid green');
                }
                if (accountno == '') {
                    valid = valid * false;
                    $('#accountno').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#accountno').css('border-bottom', '1px solid green');
                }
                if (ifsc == '') {
                    valid = valid * false;
                    $('#ifsc').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#ifsc').css('border-bottom', '1px solid green');
                }

                if (valid) {
                    var arr = {
                        "doctorname": doctorname,
                        "specialist": specialist,
                        "phone": phone,
                        "qualification": qualification,
                        "experience": experience,
                        "city": city,
                        "email": email,
                        "frmtime": frmtime,
                        "totime": totime,
                        "aadhar": aadhar,
                        "pancard": pancard,
                        "pcheck": pcheck,
                        "bankname": bankname,
                        "accountno": accountno,
                        "ifsc": ifsc,
                        "designation": designation
                    }
                    var data = JSON.stringify(arr);
                    day = JSON.stringify(day);
                    $.ajax({
                        type: "POST",
                        data: {
                            data: data,
                            data1: day
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

            function update() {
                var filter =
                    /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

                var doctorname = $('#doctorname').val().trim(),
                    specialist = $('#specialist').val().trim(),
                    phone = $('#phone').val().trim(),
                    qualification = $('#qualification').val().trim(),
                    experience = $('#experience').val().trim(),
                    city = $('#city').val().trim(),
                    email = $('#email').val().trim(),
                    frmtime = $('#frmtime').val().trim(),
                    totime = $('#totime').val().trim(),
                    aadhar = $('#aadhar').val().trim(),
                    pancard = $('#pancard').val().trim(),
                    pcheck = $('#pcheck').val().trim(),
                    bankname = $('#bankname').val().trim(),
                    accountno = $('#accountno').val().trim(),
                    ifsc = $('#ifsc').val().trim(),
                    designation = $('#designation').val().trim();

                valid = true;
                
                if (designation == '') {
                    valid = valid * false;
                    $('#designation').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#designation').css('border-bottom', '1px solid green');
                }
                if (doctorname == '') {
                    valid = valid * false;
                    $('#doctorname').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#doctorname').css('border-bottom', '1px solid green');
                }
                if (specialist == '') {
                    valid = valid * false;
                    $('#specialist').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#specialist').css('border-bottom', '1px solid green');
                }
                if (phone == '') {
                    valid = valid * false;
                    $('#phone').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#phone').css('border-bottom', '1px solid green');
                }
                if (qualification == '') {
                    valid = valid * false;
                    $('#qualification').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#qualification').css('border-bottom', '1px solid green');
                }
                if (experience == '') {
                    valid = valid * false;
                    $('#experience').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#experience').css('border-bottom', '1px solid green');
                }
                if (city == '') {
                    valid = valid * false;
                    $('#city').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#city').css('border-bottom', '1px solid green');
                }
                if (!filter.test(email)) {
                    valid = valid * false;
                    $('#email').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#email').css('border-bottom', '1px solid green');
                }
                if (frmtime == '') {
                    valid = valid * false;
                    $('#frmtime').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#frmtime').css('border-bottom', '1px solid green');
                }
                if (totime == '') {
                    valid = valid * false;
                    $('#totime').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#totime').css('border-bottom', '1px solid green');
                }
                if (aadhar == '') {
                    valid = valid * false;
                    $('#aadhar').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#aadhar').css('border-bottom', '1px solid green');
                }
                if (pancard == '') {
                    valid = valid * false;
                    $('#pancard').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#pancard').css('border-bottom', '1px solid green');
                }
                if (pcheck == '') {
                    valid = valid * false;
                    $('#pcheck').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#pcheck').css('border-bottom', '1px solid green');
                }
                if (bankname == '') {
                    valid = valid * false;
                    $('#bankname').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#bankname').css('border-bottom', '1px solid green');
                }
                if (accountno == '') {
                    valid = valid * false;
                    $('#accountno').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#accountno').css('border-bottom', '1px solid green');
                }
                if (ifsc == '') {
                    valid = valid * false;
                    $('#ifsc').css('border-bottom', '1px solid red');
                } else {
                    valid = valid * true;
                    $('#ifsc').css('border-bottom', '1px solid green');
                }

                var day = [];
                if ($('#monday:checked').val() != undefined) {
                    day.push($('#monday:checked').val());
                }
                if ($('#tuesday:checked').val() != undefined) {
                    day.push($('#tuesday:checked').val());
                }
                if ($('#wednesday:checked').val() != undefined) {
                    day.push($('#wednesday:checked').val());
                }
                if ($('#thursday:checked').val() != undefined) {
                    day.push($('#thursday:checked').val());
                }
                if ($('#friday:checked').val() != undefined) {
                    day.push($('#friday:checked').val());
                }
                if ($('#saturday:checked').val() != undefined) {
                    day.push($('#saturday:checked').val());
                }
                if ($('#sunday:checked').val() != undefined) {
                    day.push($('#sunday:checked').val());
                }

                if (valid) {
                    var arr = {
                        "doctorname": doctorname,
                        "specialist": specialist,
                        "phone": phone,
                        "qualification": qualification,
                        "experience": experience,
                        "city": city,
                        "email": email,
                        "totime": totime,
                        "frmtime": frmtime,
                        "aadhar": aadhar,
                        "pancard": pancard,
                        "pcheck": pcheck,
                        "bankname": bankname,
                        "accountno": accountno,
                        "ifsc": ifsc,
                        "designation": designation
                    }

                    var data = JSON.stringify(arr);
                   var day = JSON.stringify(day);
                    $.ajax({
                        type: "POST",
                        url: 'update.php',
                        data: {
                            id: $('#ids').val(),
                            data: data,
                            data1: day
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