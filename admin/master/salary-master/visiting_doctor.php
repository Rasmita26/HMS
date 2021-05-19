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
</style>
<div class="main-content">
    <div class="title">SALARY MASTER</div>
    <br>
    <img class="hidden" id=imageid src="../../../../img/login-img.png">
   
        <div id="div-content" class="content">
            <table width="100%" style="position:fixed;width:93%; z-index: 1;">
                <tr>
                    <td align="center" style="width:25%"><a href="/admin/master/salary-master/index.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Employee
                            </td>
                    <td align="center" style="width:25%"><a href="/admin/master/salary-master/visiting_doctor.php"
                            style="border:1px solid white;border-radius:0px; background:#1E8685;"
                            class="btn btn-primary btn-block">Visiting Doctor </td>

                    <td align="center" style="width:25%"><a href="/admin/master/salary-master/outsidedoctor.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Outsider
                            Doctor
                    </td>
                    <td align="center" style="width:25%"><a href="/admin/master/salary-master/report.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Salary
                            Report
                    </td>
                </tr>
            </table>
        </div>
   
    
  <div class="table-ui container-fluid" id="test-list" style="margin-top:50px">
    <div class="list">
            <div class="tr row">
                <div class="col-sm-4 th">Doctor Id</div>
                <div class="col-sm-4 th">Doctor Name</div>
                <div class="col-sm-4 th">Action</div>
            </div>

            <?php
               $result=mysqli_query($con,"SELECT id,doctorname FROM `doctor`");
                  while($rows = mysqli_fetch_assoc($result)){

                  echo '<div class="tr row">
                          <div class="col-sm-4 td"> Doctor id : '.$rows['id'].'</div>
                          <div class="col-sm-4 td"> Doctor Name : '.$rows['doctorname'].'</div>
                          <div class="col-sm-4 td">
                          <button style="margin-left:40%" class="btn btn-primary" data-id="'.$rows['id'].'" data-doctorname="'.$rows['doctorname'].'" onclick="modalopen(this);"  >Salary</button>   
                         </div>
                       </div>';
                   }
            ?>
        </div>
    </div>
    <!-- Employee salary start-->

    <div class="ui modal" id="mdal1">
        <i class="close icon"></i>
        <div class="header"> Salary Information </div>
        <div class="row" style="margin-top:40px;margin-left:30px">
            <input type="hidden" value='<?php echo $id;?>' id="doctor_id">
            <input type="hidden" value='<?php echo $doctorname;?>' id="dname">
            <div class="col-sm-3">
                <label>Select Month:</label>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="month" name="month" class="form-control" id="month" onchange="fun_edit(this)">
                </div>
            </div>
            <div class="col-sm-3">
                <label> Patient Check:</label>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" name="pcheck" class="form-control" id="pcheck" onkeyup="calculate()">
                </div>
            </div>
            <div class="col-sm-3">
                <label>Fees:</label>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" name="fees" class="form-control" id="fees" onkeyup="calculate()">
                </div>
            </div>

            <div class="col-sm-3">
                <label>Paid Salary:</label>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <input type="text" name="paidsalary" class="form-control" id="paidsalary" disabled>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">Nope</div>
            <button class="btn btn-success" id="submit" onclick="submit()">Submit</button>
        </div>
    </div>
    <!-- Employee salary end-->
</div>

<script>
    function fun_edit(e) {
        var month = $('#month').val();
        var doctor_id = $('#doctor_id').val();
        $.ajax({
            type: "POST",
            data: "doctor_id=" + $('#doctor_id').val() + "&month=" + $('#month').val(),
            url: 'editsalary1.php',
            success: function (res) {
                if (res.status == 'success') {
                    var json = res.json[0];

                    $('#pcheck').val(json.pcheck);
                    $('#fees').val(json.fees);
                    $('#paidsalary').val(json.paidsalary);
                }
            }
        });
    }

    function modalopen(e) {
        var id = $(e).data('id');
        var doctorname = $(e).data('doctorname');
            $('#doctor_id').val(id),
            $('#dname').val(doctorname),
            $('#mdal1').css('top', '10px');
            $('#mdal1').modal('show');
    }

    function calculate() {
        var pcheck = parseFloat($('#pcheck').val());
        var fees = parseFloat($('#fees').val());
        var paidsalary = pcheck * fees;
           $('#paidsalary').val(paidsalary);
    
    }

    function submit(id) {
        var doctor_id = $('#doctor_id').val(),
            doctorname = $('#dname').val(),
            month = $('#month').val(),
            pcheck = $('#pcheck').val(),
            fees = $('#fees').val(),
            paidsalary = $('#paidsalary').val();

        valid = true;

        if (month == '') {
            valid = valid * false;
            $('#month').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#month').css('border-bottom', '1px solid green');
        }
        if (pcheck == '') {
            valid = valid * false;
            $('#pcheck').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#pcheck').css('border-bottom', '1px solid green');
        }
        if (fees == '') {
            valid = valid * false;
            $('#fees').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#fees').css('border-bottom', '1px solid green');
        }
        if (paidsalary == '') {
            valid = valid * false;
            $('#paidsalary').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#paidsalary').css('border-bottom', '1px solid green');
        }

        if (valid) {
            $.ajax({
                type: "POST",
                url: 'visitinginsert1.php',
                data: "doctor_id=" + doctor_id + "&doctorname=" + doctorname + "&month=" + month + "&pcheck=" + pcheck +
                    "&fees=" + fees + "&paidsalary=" + paidsalary,

                success: function (res) {
                    if (res.status == 'success') {

                        alert("Record successfully inserted");
                        location.reload();
                    }
                }
            });
        }
    }
</script>