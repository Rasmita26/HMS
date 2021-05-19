<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

$json1='';
$result1=mysqli_query($con,"SELECT sname,id FROM supplier");
while($rows1 = mysqli_fetch_assoc($result1)){
 $sname=$rows1["sname"];
 $id=$rows1["id"];
 $json1.=',{"sname":"'.$sname.'","id":"'.$id.'"}';   
}

$json1=substr($json1,1);
$json1='['.$json1.']';

?>

<style>
.sidenav1 {
       height: 100%;
       width:0;
       position: fixed;
       z-index: 2;
       top: 81px;
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
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
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
    .form_wrapper {
        background: #fff;
        width: 450px;
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
    .login {
        position: relative;
        width: 100%;
        padding: 10px;
        margin: 0 0 10px 0;
        box-sizing: border-box;
        border-radius: 13px;
        /* background: #FAFAFA; */
        background: rgba(255, 255, 255, .8);
        overflow: hidden;
        animation: input_opacity 0.2s cubic-bezier(.55, 0, .1, 1);
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
            0 1px 5px 0 rgba(0, 0, 0, 0.12),
            0 3px 1px -2px rgba(0, 0, 0, 0.2);
    }
    .login>header {
        position: relative;
        width: 100%;
        padding: 10px;
        margin: -10px -10px 25px -10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        /* background: #009688;
        font-family: 'Roboto', sans-serif; */
        background:#3B57DC;
        font-family: cursive;
        font-size: 1.3rem;
        color: #FAFAFA;
        animation: scale_header 0.6s cubic-bezier(.55, 0, .1, 1), text_opacity 1s cubic-bezier(.55, 0, .1, 1);
        box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.14),
            0px 1px 5px 0px rgba(0, 0, 0, 0.12),
            0px 3px 1px -2px rgba(0, 0, 0, 0.2);
    }
    .login>header:before {
        content: '';
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        width: 100%;
        height: 5px;
        padding: 10px;
        margin: -10px 0 0 -10px;
        box-sizing: border-box;
        /* background: rgba(0, 0, 0, 0.156); */
        font-family: 'Roboto', sans-serif;
        font-size: 0.9rem;
        color: transparent;
        z-index: 5;
    }
    .login>header h2 {
        margin: 10px 0 10px 0;
    }
    .login-form {
        padding: 10px; 
        box-sizing: border-box;
    }
    .bg-img {
        background-image: url("/images/image.jpg");
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
    <div class="title"> Supplier Dashboard</div>
    
<input type="hidden" id="item-json4" value='<?php echo str_replace("'"," &#39;",$json1); ?>' />
<span style="font-size:24px;cursor:pointer" onclick="openNav1()">&#9776; Search</span>
<div id="mysidenav1" class="sidenav1" style="margin-left:80px;">

	<div id="test-list" style="padding:5px;">
		<a href="javascript:void(0)" class="closebtn1" onclick="closeNav1()">&times;</a>
	<br><br><br>
		<div class="form-group">
			<input type="text" placeholder="Search" id="search" class="form-control input-sm fuzzy-search" style="border-radius:3px;">
		</div>
		<ul class="list">
		</ul>
	</div>
</div>
<script>
var json4 = JSON.parse($("#item-json4").val());
console.log(json4);

var selectdb5 = '';
for (var i in json4) {
    
        selectdb5 += '<li><span class="supplierid">' + (json4[i].sname) + '</span><button style="margin-left:2px;" data-supplierid="' + json4[i].id + '" onclick="edit('+json4[i].id+')" class="btn btn-primary btn-sm"> <span class="fa fa-edit"></span> E</button> </li>';

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
    valueNames: ['supplierid']
});

</script>
    <div style="margin-top:13px">
        <div class="container-fluid">
            <!-- supplier form start -->
            <div class="col-sm-5">
                <div class="login">
                    <header>
                        <div><label>Supplier Form</label></div>
                    </header>
                    <hr class="style-hr">
                    <div class="login-form">
                        <div class="col-sm-12"><label>Supplier Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="sname">
                        </div>
                        <div class="col-sm-6">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea placeholder="" class="form-control" rows="1" id="address"></textarea>
                        </div>
                        <div class="col-sm-6"><label>Pin No.<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="pin"></div>
                        <div class="col-sm-6"> <label>Country<span class="text-danger">*</span></label>
                            <select class="form-control" id="country">
                                <?php 
                                        echo '<option value="Select">Select</option>';
                                        $result1=mysqli_query($con,"SELECT DISTINCTROW countryname FROM `countrymaster`");
                                        while($rows1 = mysqli_fetch_assoc($result1)){
                                        echo '<option value="'.$rows1['countryname'].'">'.$rows1['countryname'].'</option>';
                                       }
                                  ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>State<span class="text-danger">*</span></label>
                            <select class="form-control" id="state">
                                <?php 
                                       echo '<option value="Select">Select</option>';
                                       $result1=mysqli_query($con,"SELECT DISTINCTROW statecode,statename FROM `statemaster`");
                                       while($rows1 = mysqli_fetch_assoc($result1)){
                                       echo '<option value="'.$rows1['statecode'].'">'.$rows1['statename'].'</option>';
                                     }
                                    ?>
                            </select>
                        </div>
                        <div class="col-sm-6"><label>Phone No<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="phone" pattern="[789][0-9]{9}"></div>

                        <div class="col-sm-6"> <label>Pancard No. <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="cpancard"></div>

                        <div class="col-sm-6"><label>GST No.<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="gstno"></div>

                        <div class="col-sm-6"><label> Credit Days <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="creditdate"></div>

                        <div class="col-sm-12"><label>Email<span class="text-danger">*</span></label>
                            <input class="form-control email" type="email" id="email"></div>

                        <div class="col-sm-12"><label>Others</label>
                            <textarea placeholder="" class="form-control" rows="2" id="others"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- supplier form end -->

            <div class="col-sm-7">
                <center>
                    <div><label>Contact Person Details</label></div>
                </center>
                <hr class="style-hr">
                <center><button id="myBtn" class="btn btn-primary btn-lg"
                        style="font-size:15px;border-radius:50px;margin-top:10px;" data-target="#myModal">+
                        Add</button></center>
                <!-- contact person table start -->
                <div class="list1" style="margin-top:20px">
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
                <!-- contact person table end -->
            </div>
        </div>
    </div>
    <hr class="style-hr">
    <div>
        <center>
            <button style="width:140px;height:40px" class="btn btn-primary submit-btn" id="btn-submit" onclick="submitbtn()">SUBMIT</button>
        </center>
    </div>
</div>

<!-- contact person form start -->
<!-- The Modal -->

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" style="width:50%">
        <!-- <span class="close">&times;</span> -->
        <div class="form_wrapper">
            <span class="close">&times;</span>
            <div align="center"><label>Contact Person</label></div>

            <div class="col-sm-12"><label> Name<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="cname"> </div>
            <div class="col-sm-12"><label>Department<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="department"></div>
            <div class="col-sm-12"><label>Mobile No<span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="mobile" pattern="[789][0-9]{9}"></div>
            <div class="col-sm-12"><label>Landline No.<span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="landline"></div>
            <div class="col-sm-12"> <label>Email <span class="text-danger">*</span></label>
                <input class="form-control c_email" type="email" id="c_email"><br>
            </div>
            <div>
                <button class="btn btn-primary submit-btn btn-block" id="btn-submit1"
                    onclick="submitbtn1()">Submit</button>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- contact person form end-->
<script>
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
    //  contact person table fetch data start
    function submitbtn1() {

        var cname = $("#cname").val();
        var department = $("#department").val();
        var mobile = $("#mobile").val();
        var landline = $("#landline").val();
        var c_email = $("#c_email").val();

        valid = true;
        if (cname == '') {
            valid = valid * false;
            $('#cname').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#cname').css('border-bottom', '1px solid green');
        }
        if (department == '') {
            valid = valid * false;
            $('#department').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#department').css('border-bottom', '1px solid green');
        }
        if (mobile == '') {
            valid = valid * false;
            $('#mobile').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#mobile').css('border-bottom', '1px solid green');
        }
        if (landline == '') {
            valid = valid * false;
            $('#landline').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#landline').css('border-bottom', '1px solid green');
        }
        if (c_email == '') {
            valid = valid * false;
            $('#c_email').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#c_email').css('border-bottom', '1px solid green');
        }

        var markup = '<div class="tr row abc">';
        markup += '<div class="col-sm-2 td cname">' + cname + '</div>';
        markup += '<div class="col-sm-2 td department">' + department + '</div>';
        markup += '<div class="col-sm-2 td mobile">' + mobile + '</div>';
        markup += '<div class="col-sm-2 td landline">' + landline + '</div>';
        markup += '<div class="col-sm-2 td c_email">' + c_email + '</div>';
        // markup += '<div class="col-sm-2 td"><button class="btn-danger btn-sm btn" 
        markup +=
            '<div class="col-sm-2 td"> <button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
        markup += '</div>';

        $(".list1").append(markup);
        $("#cname").val('');
        $("#department").val('');
        $("#mobile").val('');
        $("#landline").val('');
        $("#c_email").val('');
    }

    function remove(e) {
        $(e).parent().parent().fadeOut(1000, function () {
            $(this).remove();
        });
    }
    //  contact person table fetch data end
    // Main Form start
    function submitbtn() {
        console.log('abc');
        
        var filter =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        var sname = $('#sname').val().trim(),
            address = $('#address').val().trim(),
            phone = $('#phone').val().trim(),
            cpancard = $('#cpancard').val().trim(),
            creditdate = $('#creditdate').val().trim(),
            country = $('#country').val().trim(),
            state = $('#state').val().trim(),
            pin = $('#pin').val().trim(),
            gstno = $('#gstno').val().trim(),
            email = $('#email').val().trim(),
            others = $('#others').val().trim();

        valid = true;

        if (sname == '') {
            

            valid = valid * false;
            $('#sname').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#sname').css('border-bottom', '1px solid green');
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
        if (creditdate == '') {
         
            valid = valid * false;
            $('#creditdate').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#creditdate').css('border-bottom', '1px solid green');
        }
        if (country == '') {
          

            valid = valid * false;
            $('#country').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#country').css('border-bottom', '1px solid green');
        }
        if (state == '') {
            valid = valid * false;
            $('#state').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#state').css('border-bottom', '1px solid green');
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
        if (!filter.test(email)) {
            console.log('abc10');

            valid = valid * false;
            $('#email').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#email').css('border-bottom', '1px solid green');
        }
        if (others == '') {
            console.log('abc11');

            valid = valid * false;
            $('#others').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#others').css('border-bottom', '1px solid green');
        }
        // contact person detail store in single column start
        var arr1 = [];
        $('.list1 > .abc').each(function () {
            arr1.push({
                'cname': $(this).find('.cname').text().trim(),
                'department': $(this).find('.department').text().trim(),
                'mobile': $(this).find('.mobile').text().trim(),
                'landline': $(this).find('.landline').text().trim(),
                'c_email': $(this).find('.c_email').text().trim()
            });

        });
        console.log(arr1);
        
        if (arr1 == '') {
           

            valid = valid * false;
            $('.list1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('.list1').css('border-bottom', '1px solid green');
        }
        // contact person detail store in single column end

        if (valid) {
            // $('#btn-submit').hide();
            var arr = {
                "sname": sname,
                "address": address,
                "phone": phone,
                "cpancard": cpancard,
                "creditdate": creditdate,
                "country": country,
                "state": state,
                "pin": pin,
                "gstno": gstno,
                "email": email,
                "others": others,
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
                        alert('Data SuccessFull Save');
                        location.reload();
                    } else {
                        $('#btn-submit').show();
                    }
                }
            });
        }
    }
// Main form End

//edit function


function validate_mobile($phone)
{
    return preg_match('/^[0-9]{10}+$/', $phone);
}
function edit(id){
    closeNav1();
$('.abc').remove();
$.ajax({
            type: "POST",
            url: 'select.php',
            data: "id=" + id,
            success: function (res) {
                if (res.status == 'success') {
                    $('#item-json4').val(id);
                    $('#btn-submit').text('Update');
                    $('#btn-submit').attr('onclick', 'update()');
                    var json = res.json[0];
                    var cnamejson = res.cname;
                    for(var i in cnamejson){                    
                        var markup = '<div class="tr row abc">';
                        markup += '<div class="col-sm-2 td cname">' + cnamejson[i].cname + '</div>';
                        markup += '<div class="col-sm-2 td department">' + cnamejson[i].department + '</div>';
                        markup += '<div class="col-sm-2 td mobile">' + cnamejson[i].mobile + '</div>';
                        markup += '<div class="col-sm-2 td landline">' + cnamejson[i].landline + '</div>';
                        markup += '<div class="col-sm-2 td c_email">' + cnamejson[i].c_email + '</div>';
                        markup+= '<div class="col-sm-2 td"> <button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
                        markup += '</div>';
                        $(".list1").append(markup);
                    }
                    // $('#ids').val(json.id);
                    $('#sname').val(json.sname);
                    $('#address').val(json.address);
                    $('#phone').val(json.phoneno);
                    $('#email').val(json.semail);
                    $('#cpancard').val(json.cpancard);
                    $('#creditdate').val(json.creditdate);
                    $('#state').val(json.state);
                    $('#country').val(json.country);
                    $('#pin').val(json.pin_no);
                    $('#gstno').val(json.gst_no);
                    $('#others').val(json.others);
                    
                    $('#cname').val(json.cname);
                    $('#department').val(json.department);
                    $('#mobile').val(json.mobile);
                    $('#landline').val(json.landline);
                    $('#c_email').val(json.c_email);   
               }                
            }
        });
}
//end edit function
// start update function

function update(id) {
            var filter =
                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

                var sname = $('#sname').val().trim(),
            address = $('#address').val().trim(),
            phone = $('#phone').val().trim(),
            cpancard = $('#cpancard').val().trim(),
            creditdate = $('#creditdate').val().trim(),
            country = $('#country').val().trim(),
            state = $('#state').val().trim(),
            pin = $('#pin').val().trim(),
            gstno = $('#gstno').val().trim(),
            email = $('#email').val().trim(),
            others = $('#others').val().trim();


                valid = true;

if (sname == '') {
    valid = valid * false;
    $('#sname').css('border-bottom', '1px solid red');
} else {
    valid = valid * true;
    $('#sname').css('border-bottom', '1px solid green');
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
if (creditdate == '') {
    valid = valid * false;
    $('#creditdate').css('border-bottom', '1px solid red');
} else {
    valid = valid * true;
    $('#creditdate').css('border-bottom', '1px solid green');
}
if (country == '') {
    valid = valid * false;
    $('#country').css('border-bottom', '1px solid red');
} else {
    valid = valid * true;
    $('#country').css('border-bottom', '1px solid green');
}
if (state == '') {
    valid = valid * false;
    $('#state').css('border-bottom', '1px solid red');
} else {
    valid = valid * true;
    $('#state').css('border-bottom', '1px solid green');
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
if (!filter.test(email)) {
    valid = valid * false;
    $('#email').css('border-bottom', '1px solid red');
} else {
    valid = valid * true;
    $('#email').css('border-bottom', '1px solid green');
}
if (others == '') {
    valid = valid * false;
    $('#others').css('border-bottom', '1px solid red');
} else {
    valid = valid * true;
    $('#others').css('border-bottom', '1px solid green');
}
// contact person detail store in single column start
var arr1 = [];
$('.list1 > .abc').each(function () {
    arr1.push({
        'cname': $(this).find('.cname').text().trim(),
        'department': $(this).find('.department').text().trim(),
        'mobile': $(this).find('.mobile').text().trim(),
        'landline': $(this).find('.landline').text().trim(),
        'c_email': $(this).find('.c_email').text().trim()
    });

});
if (arr1 == '') {
            valid = valid * false;
            $('.list1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('.list1').css('border-bottom', '1px solid green');
        }
        // contact person detail store in single column end

        if (valid) {
            // $('#btn-submit').hide();
            var arr = {
                "sname": sname,
                "address": address,
                "phone": phone,
                "cpancard": cpancard,
                "creditdate": creditdate,
                "country": country,
                "state": state,
                "pin": pin,
                "gstno": gstno,
                "email": email,
                "others": others,
            }
            var data = JSON.stringify(arr);
            var data1 = JSON.stringify(arr1);

            $.ajax({
                type: "POST",
                data: {
                    id: $('#item-json4').val(),
                    data: data,
                    data1: data1
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


</script>