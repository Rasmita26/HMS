<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
$id=$_GET['id'];
?>

<link rel="stylesheet" href="/css/classic.css">
<link rel="stylesheet" href="/css/classic.date.css">
<link rel="stylesheet" href="/css/classic.time.css">
<script src="/js/picker.js"></script>
<script src="/js/picker.date.js"></script>
<script src="/js/picker.time.js"></script>

<style>
  .plane {
    margin: 20px auto;
    max-width: 300px;
  }
  ol {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .seats {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
  }

  .seat {
    display: flex;
    flex: 0 0 14.28571428571429%;
    padding: 5px;
    position: relative;
  }

  .seat:nth-child(3) {
    margin-right: 14.28571428571429%;
  }

  .seat input[type=radio] {
    position: absolute;
    opacity: 0;
  }

  .seat input[type=radio]:checked+label {
    background: #bada55;
    -webkit-animation-name: rubberBand;
    animation-name: rubberBand;
    animation-duration: 300ms;
    animation-fill-mode: both;
  }

  .seat input[type=radio]:disabled+label {
    background: #dddddd;
  }

  .seat input[type=radio]:disabled+label:after {
    text-indent: 0;
    position: absolute;
    top: 4px;
    left: 50%;
    transform: translate(-50%, 0%);
  }

  .seat input[type=radio]:disabled+label:hover {
    box-shadow: none;
    cursor: not-allowed;
  }

  .seat label {
    display: block;
    position: relative;
    width: 80%;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    line-height: 1.5rem;
    padding: 4px 0;
    background: #87CEFA;
    border-radius: 5px;
    animation-duration: 300ms;
    animation-fill-mode: both;
  }

  .seat label:before {
    content: "";
    position: absolute;
    width: 75%;
    height: 75%;
    top: 1px;
    left: 50%;
    transform: translate(-50%, 0%);
    background: rgba(255, 255, 255, 0.4);
    ;
    border-radius: 3px;
  }

  .seat label:hover {
    cursor: pointer;
    box-shadow: 0 0 0px 2px #5C6AFF;
  }

  @-webkit-keyframes rubberBand {
    0% {
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
    }
    30% {
      -webkit-transform: scale3d(1.25, 0.75, 1);
      transform: scale3d(1.25, 0.75, 1);
    }
    40% {
      -webkit-transform: scale3d(0.75, 1.25, 1);
      transform: scale3d(0.75, 1.25, 1);
    }
    50% {
      -webkit-transform: scale3d(1.15, 0.85, 1);
      transform: scale3d(1.15, 0.85, 1);
    }
    65% {
      -webkit-transform: scale3d(0.95, 1.05, 1);
      transform: scale3d(0.95, 1.05, 1);
    }
    75% {
      -webkit-transform: scale3d(1.05, 0.95, 1);
      transform: scale3d(1.05, 0.95, 1);
    }
    100% {
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
    }
  }

  @keyframes rubberBand {
    0% {
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
    }
    30% {
      -webkit-transform: scale3d(1.25, 0.75, 1);
      transform: scale3d(1.25, 0.75, 1);
    }
    40% {
      -webkit-transform: scale3d(0.75, 1.25, 1);
      transform: scale3d(0.75, 1.25, 1);
    }
    50% {
      -webkit-transform: scale3d(1.15, 0.85, 1);
      transform: scale3d(1.15, 0.85, 1);
    }
    65% {
      -webkit-transform: scale3d(0.95, 1.05, 1);
      transform: scale3d(0.95, 1.05, 1);
    }
    75% {
      -webkit-transform: scale3d(1.05, 0.95, 1);
      transform: scale3d(1.05, 0.95, 1);
    }
    100% {
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
    }
  }

  .rubberBand {
    -webkit-animation-name: rubberBand;
    animation-name: rubberBand;
  }

  /* #basicExampleModal{
  margin-top: -360.6px;
    display: block !important;
    height: 462px;
} */
</style>
<div class="main-content">
  <input type="hidden" id="abc">
  <div class="title"> Bed Allotment </div>
  <div class="container" style="margin-top:20px">
    <div class="row">
      <div class="col-sm-4">
        <label>Patient ID</label>
        <input type="text" class="form-control" value="<?php echo $id;?>" id="pid">
      </div>
      <div class="col-sm-4">
        <label>General</label>
        <select class="form-control" onchange="getbedcount(this)" id="general">
          <option value="Select">Select</option>
          <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW roomtype FROM `room` WHERE room='General' ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $roomtype=$rows['roomtype'];
                                    $id=mysqli_fetch_assoc(mysqli_query($con,"SELECT id x FROM `room` WHERE room='General' AND roomtype='$roomtype' "))['x'];
                                    echo '<option value="'.$id.'" >'.$roomtype.'</option>';
                                }
                        ?>
        </select>
      </div>


      <div class="col-sm-4">
        <label>ICU</label>
        <select class="form-control" onchange="getbedcount(this)" id="icu">
          <option value="Select">Select</option>
          <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW roomtype FROM `room` WHERE room='ICU' ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $roomtype=$rows['roomtype'];
                                    $id=mysqli_fetch_assoc(mysqli_query($con,"SELECT id x FROM `room` WHERE room='ICU' AND roomtype='$roomtype' "))['x'];
                                    echo '<option value="'.$id.'" >'.$roomtype.'</option>';
                                }
                        ?>
        </select>
      <br></div>

      <div class='col-sm-3'>
        <label> Assign Date </label>
        <input type="text" id="inp-enq-fromdate" class="form-control input-sm" >
        <input type="hidden" id="datetimepicker3"> </div>

      <div class='col-sm-3'>
        <label> Assign Time </label>
        <input type="text" id="inp-enq-fromtime" class="form-control input-sm" >
        <input type="hidden" id="datetimepicker5">
      </div>

      <div class='col-sm-3'>
        <label> Discharge Date </label>
        <input type="text" id="inp-enq-todate" class="form-control input-sm">
        <input type="hidden" id="datetimepicker4">
      </div>

      <div class='col-sm-3'>
        <label> Discharge Time</label>
        <input type="text" id="inp-enq-totime" class="form-control input-sm" >
        <input type="hidden" id="datetimepicker6"> </div>


      <div class="col-sm-2">
        <label></label>
        <button class="btn btn-primary submit-btn btn-block" id="btn-submit" onclick="search()">Search</button><br>
      </div>
    </div>

  </div>

  <div class="row ">
    <div class="col-sm-12">
      <ol class="cabin fuselage">
      </ol>
      <div class="col-sm-1"></div>
      <div class="col-sm-2">
        <label>Price</label>
        <input type="number" class="form-control" id="price"></div>

      <div class="col-sm-2">
        <label>Remark</label>
        <input type="text" class="form-control" id="remark"></div>

      <div class="col-sm-2" style="margin-top:25px">
        <button class="btn btn-primary submit-btn btn-block" id="btn-submit" onclick="submit()">Submit</button><br>
      </div>

    </div>
  </div>
</div>

<!-- <div class="ui modal transition visible active" id="basicExampleModal" style="margin-top: -188.6px;/* display: block !important; */"> -->

<div class="ui modal" id="basicExampleModal">
  <i class="close icon"></i>
  <div class="header">
    Discharge Update
  </div>
  <div class="image content">

    <div class="description">
      <div class="ui header"></div>
      <div class='col-sm-4'>
        <label>Patient Name</label>
        <input type="text" class="form-control" id="patientName">
        <input type="hidden" class="form-control" id="patientid">
      </div>
      <div class='col-sm-4'>
        <label> Discharge Date </label>
        <input type="text" id="inp-enq-todate1" class="form-control input-sm">
        <input type="hidden" id="date1">
      </div>

      <div class='col-sm-4' style="width:50%">
        <label> Discharge Time </label>
        <input type="text" id="inp-enq-totime1" class="form-control input-sm">
        <input type="hidden" id="time1"> </div>
    </div>
  </div>
  <div class="center">
    <button class="btn btn-primary" id="btn-modal-update" data-bed-no="" onclick="update()" style="margin-left:30px">
      Update
    </button>
  </div>
</div>


<script type="text/javascript">
  // re-initializing tooltip

  function getbedcount(e) {
    $('.seats').remove();
    var idno = $(e).val();
    $.ajax({
      type: "POST",
      data: "idno=" + idno,
      url: 'select.php',
      success: function (res) {
        if (res.status == 'success') {
          console.log(res);
          var countno = res.countno;

          var str = '';
          var limit = Math.ceil(countno / 6);
          counter = 1;
          for (var i = 1; i <= limit; i++) {
            str += '<li>';
            str += '<ol class="seats" type="A' + i + '" data-toggle="tooltip">';
            for (var j = 1; j <= 6; j++) {
              if (counter <= countno) {
                str += '<li class="seat" title="" data-bed-no="' + j + '-' + i + '" data-pname="">';
                str += '<input type="radio"  name="radiobutton" id="' + j + '-' + i + '" />';
                str += '<label  for="' + j + '-' + i + '">' + j + '-' + i + '</label>';
                str += '</li>';
                counter++;
              }
            }
            str += '</ol>';
            str += '</li>';
          }

          $('.fuselage').append(str);

          $(".seat").on('click', function () {
            if ($(this).find("input").is(":disabled")) {
              let bedNo = $(this).data("bed-no");
              let pid = $(this).data("pid");
              let pname = $(this).data("pname");
              $('#patientName').val(pname);
              $('#patientid').val(pid);
              $("#btn-modal-update").attr("data-bed-no", bedNo);

              $("#basicExampleModal").modal("show");
              $("#basicExampleModal").css({
                'margin-top': '-360.6px',
                'height': '462px'
              });

            }
          });
        }
      }
    });
  }


  function search() {
    var assigndate = $('#datetimepicker3').val();
    var dischargedate = $('#datetimepicker4').val();
    var assigntime = $('#datetimepicker5').val();
    var dischargetime = $('#datetimepicker6').val();
    var general = $('#general').val();
    var icu = $('#icu').val();
    var bedtype = '';

    valid = true;


    if (general != 'Select') {
      bedtype = general;
    }

    if (icu != 'Select') {
      bedtype = icu;
    }

    if (bedtype == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }

    if (assigndate == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }
    if (dischargedate == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }

    if (assigntime == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }
    if (dischargetime == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }

    if (valid) {
      $('input').each(function () {
        $(this).prop('disabled', false);
      })

      $.ajax({
        type: "POST",

        data: 'assigndate=' + assigndate + '&dischargedate=' + dischargedate + '&assigntime=' + assigntime +
          '&dischargetime=' + dischargetime + '&bedtype=' + bedtype,
        url: 'filter.php',
        success: function (res) {
          console.log(res);
          if (res.status == 'success') {
            var arr = res.arr;
            $('#price').val(res.price);
            for (var i in arr) {

              $(".seat[data-bed-no='" + arr[i].bedno + "']").find("input").prop('disabled', true);
              $(".seat[data-bed-no='" + arr[i].bedno + "']").attr('data-pid', arr[i].pid);
              $(".seat[data-bed-no='" + arr[i].bedno + "']").attr('data-pname', arr[i].pname);
              $(".seat[data-bed-no='" + arr[i].bedno + "']").attr('title', 'Patient name : ' + arr[i].pname +
                '\n  Bed allocated assigntime : ' + arr[i].assign_time + '\n Dischargetime : ' + arr[i]
                .discharge_time);

            }
            $('[data-toggle="tooltip"]').tooltip();

          }
        }
      });
    }
  }

  function submit() {
    var assigndate = $('#datetimepicker3').val(),
      dischargedate = $('#datetimepicker4').val(),
      price = $('#price').val(),
      bedno = $("input[name='radiobutton']:checked").parent().text().trim();
      pid = $('#pid').val(),
      remark = $('#remark').val(),
      assigntime = $('#datetimepicker5').val(),
      dischargetime = $('#datetimepicker6').val(),

      valid = true;
    var general = $('#general').val();
    var icu = $('#icu').val();
    var bedtype = '';

    if (assigndate == '') {
      valid = valid * false;
      $('#datetimepicker3').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#datetimepicker3').css('border-bottom', '1px solid green');
    }

    if (dischargedate == '') {
      valid = valid * false;
      $('#datetimepicker4').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#datetimepicker4').css('border-bottom', '1px solid green');
    }

    if (general != 'Select') {
      bedtype = general;
    }

    if (icu != 'Select') {
      bedtype = icu;
    }

    if (bedtype == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }


    if (price == '') {
      valid = valid * false;
      $('#price').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#price').css('border-bottom', '1px solid green');
    }

    if (bedno == '') {
      valid = valid * false;
      $('#bedno').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#bedno').css('border-bottom', '1px solid green');
    }


    if (pid == '') {
      valid = valid * false;
      $('#pid').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#pid').css('border-bottom', '1px solid green');
    }


    if (remark == '') {
      valid = valid * false;
      $('#remark').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#remark').css('border-bottom', '1px solid green');
    }
 

    if (assigntime == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }
    if (dischargetime == '') {
      valid = valid * false;
    } else {
      valid = valid * true;
    }


    if (valid) {
      $.ajax({
        type: "POST",
        data: 'assigndate=' + assigndate + '&dischargedate=' + dischargedate + '&assigntime=' + assigntime +
          '&dischargetime=' + dischargetime + '&bedtype=' + bedtype + '&price=' + price + '&bedno=' + bedno +
          '&pid=' + pid + '&remark=' + remark,
        url: 'insert.php',
        success: function (res) {
          if (res.status == 'success') {
            alert('Data SuccessFull Save');
            var url = new URL(window.location.href);
            var id = url.searchParams.get("id");
            if (id == null) {
              location.reload();
            } else {
              window.location = '/admin/patient/index.php'
            }

          } else {
            $('#btn-submit').show();
          }
        }
      });
    }
  }


  $("#inp-enq-fromtime").pickatime({
    onClose: function () {
      try {
        var dateStamp = this.get('select')['pick'];
        $("#datetimepicker5").val(dateStamp * 60 * 1000);
      } catch (err) {

      }
    }
  });

  $("#inp-enq-totime").pickatime({
    onClose: function () {
      try {
        var dateStamp = this.get('select')['pick'];
        $("#datetimepicker6").val(dateStamp * 60 * 1000);
      } catch (err) {

      }
    }
  });

  $("#inp-enq-totime1").pickatime({
    onClose: function () {
      try {
        var dateStamp = this.get('select')['pick'];
        $("#time1").val(dateStamp * 60 * 1000);
      } catch (err) {

      }
    }
  });

  $("#inp-enq-fromdate").pickadate({
    selectYears: true,
    selectMonths: true,
    min: true,
    onClose: function () {
      try {
        var dateStamp = this.get('select')['pick'];
        $("#datetimepicker3").val(dateStamp);
      } catch (err) {

      }
    }
  });

  $("#inp-enq-todate").pickadate({
    selectYears: true,
    selectMonths: true,
    min: true,
    onClose: function () {
      try {
        var dateStamp = this.get('select')['pick'];
        $("#datetimepicker4").val(dateStamp);
      } catch (err) {

      }
    }
  });

  $("#inp-enq-todate1").pickadate({
    selectYears: true,
    selectMonths: true,
    min: true,
    onClose: function () {
      try {
        var dateStamp = this.get('select')['pick'];
        $("#date1").val(dateStamp);
      } catch (err) {

      }
    }
  });

  $('#general').on('change', function () {
    $('#icu').prop('disabled', true);
  })


  $('#icu').on('change', function () {
    $('#general').prop('disabled', true);
  })

  function update() {
    let bedNo = $("#btn-modal-update").data("bed-no");
    console.log(bedNo);
    var dischargedate = $('#date1').val(),

      dischargetime = $('#time1').val();
    console.log(dischargedate);


    valid = true;
    if (dischargedate == '') {
      valid = valid * false;
      $('#date1').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#date1').css('border-bottom', '1px solid green');
    }
    if (dischargetime == '') {
      valid = valid * false;
      $('#time1').css('border-bottom', '1px solid red');
    } else {
      valid = valid * true;
      $('#time1').css('border-bottom', '1px solid green');
    }




    if (valid) {
      $.ajax({
        type: "POST",
        url: 'update.php',
        data: "bedno=" + bedNo + "&dischargedate=" + dischargedate + "&dischargetime=" + dischargetime,
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





<?php 
  include($base.'_in/footer.php');
?>
