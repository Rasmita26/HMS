<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

?>

<style>
 
 .bg-img {
        background-image: url("/images/logform.jpg");
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

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<div class="main-content">
<div class="bg-img">
    <div class="title"> LOGIN MASTER</div> 
    <div class="modal-dialog">
    <div style="margin-top:30%">
        <div class="modal-content">
            <div class="modal-heading">
                <h2 class="text-center">Login</h2>
            </div>
            <hr />
            <div class="modal-body">
              
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" class="form-control" placeholder="User Name" id="username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <input type="password" class="form-control" placeholder="Password" id="password" />

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-phone"></span>
                            </span>
                            <input type="number" class="form-control" placeholder="Mobile no." id="mobile" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>

                            <select class="form-control" id="role" placeholder="Role">
                                <option>Admin</option>
                                <option>Doctor</option>
                                <option>Nurse</option>
                                <option>Laboratorist</option>
                                <option>Pharmacist</option>
                                <option>Accountant</option>
                                <option>Receptionist</option>
                            </select>

                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary btn-lg" onclick="submit()">Login</button>

                    </div>

                    </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>

    function submit() {

        var username = $('#username').val().trim(),
            password = $('#password').val().trim(),
            mobile = $('#mobile').val().trim(),
            role = $('#role').val().trim();


            valid = true;



        if (username == '') {
            valid = valid * false;
            $('#username').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#username').css('border-bottom', '1px solid green');
        }

        if (password == '') {
            valid = valid * false;
            $('#password').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#password').css('border-bottom', '1px solid green');
        }

        if (mobile == '') {
            valid = valid * false;
            $('#mobile').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#mobile').css('border-bottom', '1px solid green');
        }

        if (role == '') {
            valid = valid * false;
            $('#role').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#role').css('border-bottom', '1px solid green');
        }


        if (valid) {
            // $('#btn-submit').hide();
            var arr = {
                "username": username,
                "password": password,
                "mobile": mobile,
                "role": role
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
</script>
