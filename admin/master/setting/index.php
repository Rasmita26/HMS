<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>

<style>
hr.style-hr {
    border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
}
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%;
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
}
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.th {
        background:#1BBCA7;
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
         background-color: #C5DAD7;
         }
         .tr:nth-child(odd)
     {
         background-color:#eee;
         }
    body {
        font-family: Verdana, Geneva, sans-serif;
        font-size: 14px;
        background: #f2f2f2;
    }
    .clearfix:after {
        content: "";
        display: block;
        clear:/ both;
        visibility: hidden;
        height: 0;
    }
    .form_wrapper {
        background: #fff;
        width: 450px;
        max-width: 100%;
        box-sizing: border-box;
        padding: 5px;
        /* margin: auto; */
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
        width: 50%;
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
        background-image: url("/images/hospital.jpg");
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
    <div class="title"> Hospital Dashboard</div>
    <div style="margin-top:25px">
        <div class="container-fluid">
            <div class="col-sm-5">
               <center><div><label>Hospital Details</label></div></center>
            <hr class="style-hr">
                <div class="form_wrapper">
               
                    <div class="input_field"><label>Hospital Name<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="hname">
                        <input type="hidden" id="ids">
                    </div>
               
                    <div class="input_field"><label>Address</label>
                        <textarea placeholder="" class="form-control" rows="2" id="address"></textarea>
                    </div>
                        
                    <div class="row clearfix">
                        <div class="col_half">
                            <div class="input_field"> <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control" id="country">
                                    <?php 
                                        echo '<option value="Select"></option>';
                                        $result1=mysqli_query($con,"SELECT DISTINCTROW countryname FROM `countrymaster`");
                                        while($rows1 = mysqli_fetch_assoc($result1)){
                                        echo '<option value="'.$rows1['countryname'].'">'.$rows1['countryname'].'</option>';
                                       }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col_half">
                            <div class="input_field"><label>State<span class="text-danger">*</span></label>
                                <select class="form-control" id="hosstate">
                                    <?php 
                                       echo '<option value="Select">Select</option>';
                                       $result1=mysqli_query($con,"SELECT DISTINCTROW statecode,statename FROM `statemaster`");
                                       while($rows1 = mysqli_fetch_assoc($result1)){
                                       echo '<option value="'.$rows1['statecode'].'">'.$rows1['statename'].'</option>';
                                     }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col_half">
                            <div class="input_field"><label>Phone No<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" id="phone" ></div>
                        </div>
                        <div class="col_half">
                            <div class="input_field"> <label>Pancard No. <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="cpancard">
                            </div>
                        </div>
                        <div class="col_half">
                            <div class="input_field"><label>GST No. <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="gstno"></div>
                        </div>

                        <div class="col_half">
                            <div class="input_field"><label>Pin No.<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="pin"></div>
                        </div>
                    
                    </div>
                    <div class="input_field"><label>Others</label>
                        <textarea placeholder="" class="form-control" rows="2" id="others"></textarea>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-7">
            <center><div><label>Contact Person Details</label></div></center>
            <hr class="style-hr">
                <center><button id="myBtn" class="btn btn-primary btn-lg"
                        style="font-size:15px;border-radius:50px;margin-top:10px;" data-target="#myModal">+
                        Add</button></center>

                <div class="list" style="margin-top:20px">
                    <div class="tr row">
                        <div class="col-sm-2 th">Name</div>
                        <div class="col-sm-2 th">Department</div>
                        <div class="col-sm-2 th">Phone no.</div>
                        <div class="col-sm-2 th">Landline</div>
                        <div class="col-sm-2 th">Email</div>
                        <div class="col-sm-2 th">Action</div>
                    </div>

                    <div class="tr row">

                    </div>
                </div>
                </div>
            </div>
            <hr class="style-hr">
            <div>
                <center> <button class="btn btn-primary submit-btn" id="btn-submit" onclick="submit()">Submit</button></center>
            </div>
 </div>
</div>
            <!-- The Modal -->

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="form_wrapper" style="margin:auto">
                        <div align="center"><label>Contact Person</label></div>

                        <div class="input_field"><label> Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="cname">
                            <input type="hidden" id="ids">
                        </div>
                        <div class="input_field"><label>Department<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="department"></div>
                        <div class="input_field"><label>Mobile No<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="mobile" pattern="[789][0-9]{9}"></div>
                        <div class="input_field"><label>Landline No.<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="landline"></div>
                        <div class="input_field"> <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" id="email">
                        </div>
                        <div>
                            <button class="btn btn-primary submit-btn btn-block" id="btn-submit1"
                                onclick="submitbtn1()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

<script>

function validate_mobile($phone)
{
    return preg_match('/^[0-9]{10}+$/', $phone);
}

$.ajax({
            type: "POST",
            url: 'select.php',
            success: function (res) {
                if (res.status == 'success') {
                   
                    $('#btn-submit').text('Update');
                   
                    var json = res.json[0];
                    var cnamejson = res.cname;
                    for(var i in cnamejson){                    
                        var markup = '<div class="tr row abc">';
                        markup += '<div class="col-sm-2 td cname">' + cnamejson[i].cname + '</div>';
                        markup += '<div class="col-sm-2 td department">' + cnamejson[i].department + '</div>';
                        markup += '<div class="col-sm-2 td mobile">' + cnamejson[i].mobile + '</div>';
                        markup += '<div class="col-sm-2 td landline">' + cnamejson[i].landline + '</div>';
                        markup += '<div class="col-sm-2 td email">' + cnamejson[i].email + '</div>';
                        markup+= '<div class="col-sm-2 td"> <button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
                        markup += '</div>';
                        $(".list").append(markup);
                    }
                    $('#ids').val(json.id);
                    $('#hname').val(json.name);
                    $('#address').val(json.address);
                    $('#phone').val(json.phoneno);
                    $('#cpancard').val(json.cpancard);
                    $('#hosstate').val(json.state);
                    $('#country').val(json.country);
                    $('#pin').val(json.pin_no);
                    $('#gstno').val(json.gst_no);
                    $('#others').val(json.others);
                    
                    $('#cname').val(json.cname);
                    $('#department').val(json.department);
                    $('#mobile').val(json.mobile);
                    $('#landline').val(json.landline);
                    $('#email').val(json.email);   
               }                
            }
        });

var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function () {
    modal.style.display = "block";
}
span.onclick = function () {
    modal.style.display = "none";
}
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function submitbtn1() {

var cname = $("#cname").val();
var department = $("#department").val();
var mobile = $("#mobile").val();
var landline = $("#landline").val();
var email = $("#email").val();

var markup = '<div class="tr row abc">';
markup += '<div class="col-sm-2 td cname">' + cname + '</div>';
markup += '<div class="col-sm-2 td department">' + department + '</div>';
markup += '<div class="col-sm-2 td mobile">' + mobile + '</div>';
markup += '<div class="col-sm-2 td landline">' + landline + '</div>';
markup += '<div class="col-sm-2 td email">' + email + '</div>';
// markup += '<div class="col-sm-2 td"><button class="btn-danger btn-sm btn" 
markup+= '<div class="col-sm-2 td"> <button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
markup += '</div>';
$(".list").append(markup);
$("#cname").val('');
$("#department").val('');
$("#mobile").val('');
$("#landline").val('');
$("#email").val('');
}

function remove(e) {
$(e).parent().parent().fadeOut(1000, function () {
    $(this).remove();
});
}

function submit() {
 
    var hname = $('#hname').val().trim(),
         ids  =$('#ids').val().trim(),
        address = $('#address').val().trim(),
        phone = $('#phone').val().trim(),
        cpancard = $('#cpancard').val().trim(),
        country = $('#country').val().trim(),
        hosstate = $('#hosstate').val().trim(),
        pin = $('#pin').val().trim(),
        gstno = $('#gstno').val().trim(),
        others = $('#others').val().trim();


    valid = true;

    if (hname == '') {
        valid = valid * false;
        $('#hname').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#hname').css('border-bottom', '1px solid green');
    }
    if (address == '') {
        valid = valid * false;
        $('#address').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#address').css('border-bottom', '1px solid green');
    }
    if (phone == '') {
        valid = valid * false;
        $('#phone').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#phone').css('border-bottom', '1px solid green');
    }

    if (cpancard == '') {
        valid = valid * false;
        $('#cpancard').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#cpancard').css('border-bottom', '1px solid green');
    }

    // if (creditdate == '') {
    //     valid = valid * false;
    //     $('#creditdate').css('border-bottom', '1px solid red');
    // } else {
    //     valid = valid * true;
    //     $('#creditdate').css('border-bottom', '1px solid green');
    // }

    if (country == '') {
        valid = valid * false;
        $('#country').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#country').css('border-bottom', '1px solid green');
    }
    if (hosstate == '') {
        valid = valid * false;
        $('#hosstate').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#hosstate').css('border-bottom', '1px solid green');
    }

    if (pin == '') {
        valid = valid * false;
        $('#pin').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#pin').css('border-bottom', '1px solid green');
    }

    if (gstno == '') {
        valid = valid * false;
        $('#gstno').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#gstno').css('border-bottom', '1px solid green');
    }

    if (others == '') {
        valid = valid * false;
        $('#others').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('#others').css('border-bottom', '1px solid green');
    }

    var arr1 = [];
    $('.list > .abc').each(function () {
            arr1.push({
                'cname': $(this).find('.cname').text().trim(),
                'department': $(this).find('.department').text().trim(),
                'mobile': $(this).find('.mobile').text().trim(),
                'landline': $(this).find('.landline').text().trim(),
                'email': $(this).find('.email').text().trim()
            });

    });
    // arr1.shift();
    if (arr1 == '') {
        valid = valid * false;
        $('.list').css('border-bottom', '1px solid red');
    } else {
        valid = valid * true;
        $('.list').css('border-bottom', '1px solid green');
    }

    if (valid) {
        // $('#btn-submit').hide();
        var arr = {
               "id"     :ids,
              "hname"   : hname,
              "address" : address,
              "phone"   : phone,
              "cpancard": cpancard,  
              "country" : country,
              "hosstate"   : hosstate,
              "pin"     : pin,
              "gstno"   : gstno,
              "others"  : others,
        }
        var data = JSON.stringify(arr);
        var data1 = JSON.stringify(arr1);

        $.ajax({
            type: "POST",
            data: {
                data: data,
                data1: data1
            },
            url: 'insert.php',
            success: function (res) {
                if (res.status == 'success') {
                   
                  
                    // location.reload();
                } else {
                    $('#btn-submit').show();
                }
            }
        });
    }
}
</script>