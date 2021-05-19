<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>


<div class="main-content">
  <div class="title">SALARY MASTER</div>
  <br>

  <div id="div-content" class="content">
    <table width="100%" style="position:fixed;width:93%; z-index: 1;">
      <tr>
        <td align="center" style="width:25%"><a href="/admin/master/salary-master/index.php"
            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Employee</td>
        <td align="center" style="width:25%"><a href="/admin/master/salary-master/visting_doctor.php"
            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Visting Doctor
        </td>

        <td align="center" style="width:25%"><a href="/admin/master/salary-master/outsidedoctor.php"
            style="border:1px solid white;border-radius:0px;background:#1E8685;"
            class="btn btn-primary btn-block">Outside Doctor 
        </td>
        <td align="center" style="width:25%"><a href="/admin/master/salary-master/report.php"
            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Salary Report
        </td>
      </tr>
    </table>
  </div>


  <button id="myBtn" class="btn btn-primary btn-lg" data-toggle="modal"
    style="font-size:25px;border-radius:50px;width:60px;height:60px;position:fixed;bottom:62px;right: 40px;background:#eb2f06;color:#fff;"
    data-target="#myModal">+</button>
  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:60%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">SALARY INFORMATION</h4>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-left:15px">
            <div class="col-sm-2">
              <label>Registration id:</label>
            </div>

            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" name="regid" class="form-control" id="regid">
              </div>
            </div>
            <div class="col-sm-2">
              <label>Date :</label>
            </div>

            <div class="col-sm-9">
              <div class="form-group">
                <input type="date" name="date" class="form-control" id="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label> Doctor Name:</label>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" name="dname" class="form-control" id="dname">
              </div>
            </div>
            <div class="col-sm-2">
              <label>Patient id:</label>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" name="pid" class="form-control" id="pid">
              </div>
            </div>
            <div class="col-sm-2">
              <label>Fees:</label>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" name="fees" class="form-control" id="fees">
              </div>
            </div>

          </div>
        </div>

        <!-- <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:4px;margin-bottom:4px;"
        id="search" placeholder="Search Box"> -->

        <div class="modal-footer">
          <button type="button" name="insert" id="btn-submit" class="btn btn-primary btn-block"
            onclick="submit()">ADD</button>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  function submit(id) {
    var regid = $('#regid').val(),
      date = $('#date').val(),
      dname = $('#dname').val(),
      pid = $('#pid').val(),
      fees = $('#fees').val(),
      valid = true;

    if (regid == '') {
      valid = valid * false;
      $('#regid').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#regid').css('border-bottom', '1px solid green');
    }

    if (date == '') {
      valid = valid * false;
      $('#date').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#date').css('border-bottom', '1px solid green');
    }

    if (dname == '') {
      valid = valid * false;
      $('#dname').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#dname').css('border-bottom', '1px solid green');
    }

    if (pid == '') {
      valid = valid * false;
      $('#pid').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#pid').css('border-bottom', '1px solid green');
    }

    if (fees == 'Select') {
      valid = valid * false;
      $('#fees').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#fees').css('border-bottom', '1px solid green');
    }




    if (valid) {
      // $('#btn-submit').hide();
      $.ajax({
        type: "POST",
        url: 'outsideinsert.php',
        data: "regid=" + regid + "&date=" + date + "&dname=" + dname + "&pid=" + pid + "&fees=" + fees,

        success: function (res) {

          if (res.status == 'success') {
            alert('Data SuccessFull Save');
            location.reload();
          }
        }
      });
    }
  }
</script>
