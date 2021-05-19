
<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
$patientid=mysqli_fetch_assoc(mysqli_query($con,"SELECT max(patientid) x FROM emergency"))['x'];
$patientid++;
?>
<style>
 .bg-img {
        background-image: url("/images/emergency.jpg");
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
    <div class="title"> LOGIN MASTER</div> <br>
    
<input type="hidden" id="abc">
    <div id="div-content" class="content">
        <table width="100%" style="position:fixed;width:93%; z-index: 1;">
            <tr>
                <td align="center" style="width:25%"><a href="/admin/process/index.php"
                        style="border:1px solid white;border-radius:0px;background:#21AD91;"
                        class="btn btn-primary btn-block">General</td>
                <td align="center" style="width:25%"><a href="/admin/process/emergencyform.php"
                        style="border:1px solid white;border-radius:0px;background:#1E8685;" class="btn btn-primary btn-block">
                       Emergency</td>
            </tr>
        </table>
    </div>
    <br><br><br>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-heading">
                <h2 class="text-center">Registration Details</h2>
            </div>
            <hr />
            <div class="modal-body">
              
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text"  readonly class="form-control" placeholder="Patient Id" value="<?php echo $patientid; ?>" id="patientid" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <!-- <input type="text" class="form-control" placeholder="Reason" id="reason" /> -->
                            <select class="form-control" id="reason" placeholder="Reason">
                                <option>Accident Case</option>
                                <option>Burn Case</option>
                              
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" class="form-control" placeholder="Name of admitter" id="name" />
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
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg" onclick="submit()">Submit</button>

                    </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>

    function submit() {

        var patientid = $('#patientid').val(),
            reason = $('#reason').val(),
            mobile = $('#mobile').val(),
            name = $('#name').val();


            valid = true;



        if (patientid == '') {
            valid = valid * false;
            $('#patientid').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#patientid').css('border-bottom', '1px solid green');
        }

        if (reason == '') {
            valid = valid * false;
            $('#reason').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#reason').css('border-bottom', '1px solid green');
        }

        if (mobile == '') {
            valid = valid * false;
            $('#mobile').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#mobile').css('border-bottom', '1px solid green');
        }

        if (name == '') {
            valid = valid * false;
            $('#name').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#name').css('border-bottom', '1px solid green');
        }


        if (valid) {
            // $('#btn-submit').hide();
            var arr = {
                "patientid": patientid,
                "reason": reason,
                "mobile": mobile,
                "name": name
            }

            var data = JSON.stringify(arr);
            $.ajax({
                type: "POST",
                data: {
                    data: data
                },
                url: 'emergencyinsert.php',
                success: function (res) {
                    if (res.status == 'success') {
                        alert('Data SuccessFull Save');
                        // location.reload();
                        $('#abc').val(res.id);
                        window.location = '/admin/bedmaster/index.php?id=' + res.patientid;
                    } else {
                        $('#btn-submit').show();
                    }

                }
            });
        }
    }
</script>




