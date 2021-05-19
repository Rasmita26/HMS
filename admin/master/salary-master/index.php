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
  <div id="div-content" class="content">
    <table width="100%" style="position:fixed;width:93%; z-index: 1;">
      <tr>
        <td align="center" style="width:25%"><a href="/admin/master/salary-master/index.php"
            style="border:1px solid white;border-radius:0px;background:#1E8685;"
            class="btn btn-primary btn-block">Employee</td>
        <td align="center" style="width:25%"><a href="/admin/master/salary-master/visiting_doctor.php"
            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Visting
            Doctor</td>

        <td align="center" style="width:25%"><a href="/admin/master/salary-master/outsidedoctor.php"
            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Outside
            Doctor
        </td>
        <td align="center" style="width:25%"><a href="/admin/master/salary-master/report.php"
            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Salary Report

        </td>
      </tr>
    </table>
  </div>
  <br>

  <div class="table-ui container-fluid" id="test-list" style="margin-top:40px">
    <div class="list">
      <div class="tr row">
        <div class="col-sm-4 th">Employee Id</div>
        <div class="col-sm-4 th">Employee Name</div>
        <div class="col-sm-4 th">Action</div>
      </div>

      <?php
    $result=mysqli_query($con,"SELECT employeeid,fname FROM `employee`");
    while($rows = mysqli_fetch_assoc($result)){
   
        echo '<div class="tr row">
                <div class="col-sm-4 td"> Employee id : '.$rows['employeeid'].'  </div>
                <div class="col-sm-4 td"> Employee Name : '.$rows['fname'].'  </div>
               
                <div class="col-sm-4 td">
                    <button style="margin-left:40%" class="btn btn-primary" data-employeeid="'.$rows['employeeid'].'" data-fname="'.$rows['fname'].'" onclick="modalopen(this);" >Salary</button>
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
    <div class="row" style="margin-top:50px;margin-left:40px">
      <input type="hidden" value='<?php echo $employeeid;?>' id="eid">
      <input type="hidden" value='<?php echo $fname;?>' id="ename">
      <div class="col-sm-2">
        <label>Select Month:</label>
      </div>
      <div class="col-sm-9">
        <div class="form-group">
          <input type="month" name="month" class="form-control" id="month" onchange="fun_edit(this)">
        </div>
      </div>
      <div class="col-sm-2">
        <label> Basic Salary:</label>
      </div>
      <div class="col-sm-9">
        <div class="form-group">
          <input type="text" name="salary" class="form-control" id="salary">
        </div>


      </div>
      <div class="col-sm-2">
        <label>Total Days:</label>
      </div>
      <div class="col-sm-9">
        <div class="form-group">
          <input type="text" name="totaldays" class="form-control" id="totaldays">
        </div>
      </div>
      <div class="col-sm-2">
        <label>Present Days:</label>
      </div>
      <div class="col-sm-9">
        <div class="form-group">
          <input type="text" name="presentdays" class="form-control" id="presentdays" onkeyup="days()">
        </div>
      </div>
      <div class="col-sm-2">
        <label>Absent Days:</label>
      </div>
      <div class="col-sm-9">
        <div class="form-group">
          <input type="text" name="absentdays" class="form-control" id="absentdays" onkeyup="days()">
        </div>
      </div>
      <div class="col-sm-2">
        <label>Total Salary:</label>
      </div>
      <div class="col-sm-9">
        <div class="form-group">
          <input type="text" name="totalsalary" class="form-control" id="totalsalary">
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
    var eid = $('#eid').val();
    $.ajax({
      type: "POST",
      data: "employeeid=" + $('#eid').val() + "&month=" + $('#month').val(),
      url: 'editsalary.php',
      success: function (res) {
        if (res.status == 'success') {
          var json = res.json[0];

          $('#salary').val(json.basicsalary);
          $('#totaldays').val(json.totaldays);
          $('#presentdays').val(json.presentdays);
          $('#absentdays').val(json.absentdays);
          $('#totalsalary').val(json.paidsalary);
        }
      }
    });
  }


  //function to calculate salary
  function days() {
    var basicsalary = parseFloat($('#salary').val());
    var totaldays = parseFloat($('#totaldays').val());
    var presentdays = parseFloat($('#presentdays ').val());
    var absentdays = totaldays - presentdays;
    $('#absentdays').val(absentdays);
    var pardaysalay = basicsalary / 30;
    //console.log(pardaysalay);
    var abssalary = pardaysalay * absentdays;
    // console.log(abssalary);
    var paidsalary = (Math.round(basicsalary - abssalary));

    $('#totalsalary').val(paidsalary);
  }

  function modalopen(e) {
    var employeeid = $(e).data('employeeid');
    var fname = $(e).data('fname');
    $('#eid').val(employeeid),
      $('#ename').val(fname),
      $('#mdal1').css('top', '10px');
    $('#mdal1').modal('show');

  }

  function submit(id) {
    var employeeid = $('#eid').val(),
      fname = $('#ename').val(),

      month = $('#month').val(),
      basicsalary = $('#salary').val(),
      presentdays = $('#presentdays').val(),
      absentdays = $('#absentdays').val(),
      totaldays = $('#totaldays').val(),
      paidsalary = $('#totalsalary').val();

    valid = true;

    if (month == '') {
      valid = valid * false;
      $('#month').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#month').css('border-bottom', '1px solid green');
    }

    if (basicsalary == '') {
      valid = valid * false;
      $('#salary').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#salary').css('border-bottom', '1px solid green');
    }

    if (presentdays == '') {
      valid = valid * false;
      $('#presentdays').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#presentdays').css('border-bottom', '1px solid green');
    }

    if (absentdays == '') {
      valid = valid * false;
      $('#absentdays').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#absentdays').css('border-bottom', '1px solid green');
    }

    if (totaldays == 'Select') {
      valid = valid * false;
      $('#totaldays').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#totaldays').css('border-bottom', '1px solid green');
    }

    if (paidsalary == '') {
      valid = valid * false;
      $('#totalsalary').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#totalsalary').css('border-bottom', '1px solid green');
    }

    if (valid) {
      // $('#btn-submit').hide();
      $.ajax({
        type: "POST",
        url: 'empsalary.php',
        data: "employeeid=" + employeeid + "&fname=" + fname + "&basicsalary=" + basicsalary + "&presentdays=" +
          presentdays + "&absentdays=" + absentdays + "&totaldays=" + totaldays + "&month=" + month +
          "&paidsalary=" + paidsalary,

        success: function (res) {

          if (res.status == 'success') {
            alert('Data SuccessFull Save');
            window.location.href = "/admin/master/salary-master/index.php";
          }
        }
      });
    }
  }
</script>