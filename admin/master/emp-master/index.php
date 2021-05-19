<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

$json1='';
$result1=mysqli_query($con,"SELECT id,fname FROM employee");
while($rows1 = mysqli_fetch_assoc($result1)){
 $fname=$rows1["fname"];
 $id=$rows1["id"];
 $json1.=',{"fname":"'.$fname.'","id":"'.$id.'"}';   
}

$json1=substr($json1,1);
$json1='['.$json1.']';
?>

<style>
    .sidenav1 {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
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
    hr.style-hr {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
    }

    .login {
        position: relative;
        width: 100%;
        padding: 10px;
        margin: 0 0 10px 0;
        box-sizing: border-box;
        border-radius: 13px;
        /* background: #FAFAFA; */
        background: rgba(255, 255, 255, .7);
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
        /* background: #009688; */
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
        background-image: url("/images/image1.jpg");
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
    <div class="title"> Employee Dashboard</div>
    <div style="margin-top:10px">
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
    
        selectdb5 += '<li><span class="employeeid">' + (json4[i].fname) + '</span><button style="margin-left:2px;" data-employeeid="' + json4[i].id + '" onclick="edit('+json4[i].id+')" class="btn btn-primary btn-sm"> <span class="fa fa-edit"></span> E</button> <button style="margin-left:2px;" data-employeeid="' + json4[i].id + '" onclick="deleteentry('+json4[i].id+')" class="btn btn-danger btn-sm"> <span class="fa fa-edit"></span> D</button></li>';
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
    valueNames: ['employeeid']
});

        </script>

        <div class="container-fluid">
            <br>
            <!-- supplier form start -->
            <div class="col-sm-7">
                <div class="login">
                    <header>
                        <div><label>Employee Form</label></div>
                    </header>
                    <hr class="style-hr">
                    <div class="login-form">
                        <div class="col-sm-3">
                            <label>Role</label>
                            <select class="form-control" id="role">
                                <option>Admin</option>
                                <option>Doctor</option>
                                <option>Nurse</option>
                                <option>Laboratorist</option>
                                <option>Pharmacist</option>
                                <option>Accountant</option>
                                <option>Receptionist</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Title</label>
                            <select class="form-control" id="title">
                                <option>Mr.</option>
                                <option>Mrs.</option>
                                <option>Miss</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Full Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="fname">
                        </div>

                        <div class="col-sm-4">
                            <label>Gender<span class="text-danger">*</span></label>
                            <br>
                            <input type="radio" name="radio1" id="gender" value="Male">
                            <label style="margin-right:10px;">Male</label>
                            <input type="radio" name="radio1" id="gender" value="Female">
                            <label>Female</label>
                        </div>
                        <div class="col-sm-4"> <label>Date of Birth <span class="text-danger">*</span></label>
                            <input class="form-control " type="date" id="dob"> </div>
                        <div class="col-sm-4"> <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control email" type="email" id="email"></div>

                        <div class="col-sm-6"> <label>Address</label>
                            <textarea placeholder="Enter Address Here.." rows="1" class="form-control"
                                id="address"></textarea>
                        </div>
                        <div class="col-sm-6"> <label>Password</label>
                            <input class="form-control" type="password" id="password"></div>

                        <div class="col-sm-6"> <label>Employee ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="employeeid"> </div>

                        <div class="col-sm-6">
                            <label>Joining Date <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" id="joindate"></div>

                        <div class="col-sm-6">
                            <label>Phone 1 </label>
                            <input class="form-control" type="number" id="phone1"></div>
                        <div class="col-sm-6">
                            <label>Phone 2 </label>
                            <input class="form-control" type="number" id="phone2"></div>

                        <div class="col-sm-4">
                            <label>Qualification <span class="text-danger">*</span></label><input class="form-control"
                                type="text" id="qualification"></div>
                        <div class="col-sm-4">
                            <label>Experience <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="experience"></div>
                        <div class="col-sm-4">
                            <label>Status</label> <br><label class="radio-inline"><input type="radio" name="status"
                                    value="Active" id="status">Active</label>
                            <label class="radio-inline"><input type="radio" name="status" value="Inactive"
                                    id="status">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- supplier form end -->

            <div class="col-sm-5">
                <div class="login">
                    <header>
                        <div><label>Additional Details</label></div>
                    </header>
                    <hr class="style-hr">
                    <div class="login-form">
                        <div class="col-sm-12">
                            <label>Profile Pic <span class="text-danger">*</span></label><input type="file" name="pic"
                                id="pic1"> <br>
                        </div>
                        <div class="col-sm-12">
                            <label>Aadhar Card <span class="text-danger">*</span></label><input type="file" name="pic"
                                id="pic2"><br>
                        </div>
                        <div class="col-sm-12">
                            <label>Pan Card<span class="text-danger">*</span></label><input type="file" name="pic"
                                id="pic3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="style-hr">
        <div>
            <center>
                <button class="btn btn-primary submit-btn" id="btn-submit" onclick="submitbtn()">Submit</button>
            </center>
        </div>
    </div>
    </div>

    <script>
       
        // $(document).ready(function () {
        //     $("#search").on("keyup", function () {
        //         var value = $(this).val().toLowerCase();
        //         $(".list .abc").filter(function () {
        //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //         });
        //     });
        // });

        function reset() {
            location.reload();
        }
        $('#reset').hide();


        function submitbtn() {
            var filter =
                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            var title = $('#title').val().trim(),
                fname = $('#fname').val().trim(),
                role = $('#role').val().trim();
                dob = $('#dob').val().trim(),
                address = $('#address').val().trim(),
                qualification = $('#qualification').val().trim(),
                experience = $('#experience').val().trim(),
                email = $('#email').val().trim(),
                password = $('#password').val().trim(),
                employeeid = $('#employeeid').val().trim(),
                joindate = $('#joindate').val().trim(),
                phone1 = $('#phone1').val().trim(),
                phone2 = $('#phone2').val().trim();

            valid = true;

            var gender = $('#gender:checked').val();
            var status = $('#status:checked').val();

            console.log(gender);
            console.log(status);

            if (title == '') {
                valid = valid * false;
                $('#title').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#title').css('border-bottom', '1px solid green');
            }
            if (fname == '') {
                valid = valid * false;
                $('#fname').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#fname').css('border-bottom', '1px solid green');
            }
            if (role == '') {
                valid = valid * false;
                $('#role').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#role').css('border-bottom', '1px solid green');
            }
            if (dob == '') {
                valid = valid * false;
                $('#dob').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#dob').css('border-bottom', '1px solid green');
            }
            if (address == '') {
                valid = valid * false;
                $('#address').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#address').css('border-bottom', '1px solid green');
            }
            if (!filter.test(email)) {
                valid = valid * false;
                $('#email').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#email').css('border-bottom', '1px solid green');
            }
            if (password == '') {
                valid = valid * false;
                $('#password').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#password').css('border-bottom', '1px solid green');
            }
            if (employeeid == '') {
                valid = valid * false;
                $('#employeeid').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#employeeid').css('border-bottom', '1px solid green');
            }
            if (joindate == '') {
                valid = valid * false;
                $('#joindate').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#joindate').css('border-bottom', '1px solid green');
            }
            if (phone1 == '') {
                valid = valid * false;
                $('#phone1').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#phone1').css('border-bottom', '1px solid green');
            }
            if (phone2 == '') {
                valid = valid * false;
                $('#phone2').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#phone2').css('border-bottom', '1px solid green');
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

            var file1 = $("#pic1").prop("files")[0];
            var file2 = $("#pic2").prop("files")[0];
            var file3 = $("#pic3").prop("files")[0];
            var form_data = new FormData();
            form_data.append("id", $('#abc').val());
            form_data.append("file1", file1);
            form_data.append("file2", file2);
            form_data.append("file3", file3);

            if (valid) {

                var arr = {
                    "title": title,
                    "fname": fname,
                    "gender": gender,
                    "role": role,
                    "dob": dob,
                    "address": address,
                    "email": email,
                    "password": password,
                    "employeeid": employeeid,
                    "joindate": joindate,
                    "phone1": phone1,
                    "phone2": phone2,
                    "qualification": qualification,
                    "experience": experience,
                    "status": status
                }
                var data = JSON.stringify(arr);
                form_data.append("data", data);
                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: 'insert.php',
                    success: function (res) {
                        if (res.status == 'success') {
                            alert('Data SuccessFull Save');
                            location.reload();

                            $('#abc').val(res.id);
                        } else {
                            $('#btn-submit').show();
                        }
                    }
                });
            }
        }

        function edit(id) {
            closeNav1();

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
                        $('#title').val(json.title);
                        $('#fname').val(json.fname);
                        $('#role').val(json.role);
                        $('#dob').val(json.dob);
                        $('#address').val(json.address);
                        $('#email').val(json.email);
                        $('#password').val(json.password);
                        $('#employeeid').val(json.employeeid);
                        $('#joindate').val(json.joindate);
                        $('#phone1').val(json.phone1);
                        $('#phone2').val(json.phone2);
                        $('#qualification').val(json.qualification);
                        $('#experience').val(json.experience);


                        var gender = json.gender;
                        var status = json.status;
                        console.log(gender);
                        console.log(status);
                        $("input[name=radio1][value=" + gender + "]").attr('checked', 'checked');
                        $("input[name=status][value=" + status + "]").attr('checked', 'checked');
                    }
                }
            });
        }

        function update() {
            var filter =
                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            var title = $('#title').val().trim(),
                fname = $('#fname').val().trim(),
                role = $('#role').val().trim();
                dob = $('#dob').val().trim(),
                address = $('#address').val().trim(),
                email = $('#email').val().trim(),
                password = $('#password').val().trim(),
                qualification = $('#qualification').val().trim(),
                experience = $('#experience').val().trim(),
                employeeid = $('#employeeid').val().trim(),
                joindate = $('#joindate').val().trim(),
                phone1 = $('#phone1').val().trim(),
                phone2 = $('#phone2').val().trim();

            valid = true;

            var gender = $('#gender:checked').val();
            var status = $('#status:checked').val();
            console.log(gender);
            console.log(status);

            if (title == '') {
                valid = valid * false;
                $('#title').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#title').css('border-bottom', '1px solid green');
            }
            if (fname == '') {
                valid = valid * false;
                $('#fname').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#fname').css('border-bottom', '1px solid green');
            }
            if (role == '') {
                valid = valid * false;
                $('#role').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#role').css('border-bottom', '1px solid green');
            }
            if (dob == '') {
                valid = valid * false;
                $('#dob').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#dob').css('border-bottom', '1px solid green');
            }
            if (address == '') {
                valid = valid * false;
                $('#address').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#address').css('border-bottom', '1px solid green');
            }
            if (!filter.test(email)) {
                valid = valid * false;
                $('#email').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#email').css('border-bottom', '1px solid green');
            }
            if (password == '') {
                valid = valid * false;
                $('#password').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#password').css('border-bottom', '1px solid green');
            }
            if (employeeid == '') {
                valid = valid * false;
                $('#employeeid').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#employeeid').css('border-bottom', '1px solid green');
            }
            if (joindate == '') {
                valid = valid * false;
                $('#joindate').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#joindate').css('border-bottom', '1px solid green');
            }
            if (phone1 == '') {
                valid = valid * false;
                $('#phone1').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#phone1').css('border-bottom', '1px solid green');
            }
            if (phone2 == '') {
                valid = valid * false;
                $('#phone2').css('border-bottom', '1px solid red');
            } else {
                valid = valid * true;
                $('#phone2').css('border-bottom', '1px solid green');
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


            if (valid) {
                var arr = {
                    "title": title,
                    "fname": fname,
                    "gender": gender,
                    "role": role,
                    "dob": dob,
                    "address": address,
                    "email": email,
                    "password": password,
                    "employeeid": employeeid,
                    "joindate": joindate,
                    "phone1": phone1,
                    "phone2": phone2,
                    "status": status,
                    "qualification": qualification,
                    "experience": experience
                };

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

    <?php 
include($base."_in/footer.php");
?>