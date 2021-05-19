<?php 
  $base='../';
  include($base.'_in/header.php');
  include($base.'_in/connect.php');
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

         .th1 {
        background:#1BBCA7;
        color: #fff;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 2px;
        border: 1px solid #fff;
    }
    .td1 {
        border: 1px solid #ddd;
        /* background: #eee; */
    }
    .table-ui .btn {
        margin: 3px;
    }
    .tr1:nth-child(even)
     {
         background-color: #eee;
         }
         .tr1:nth-child(odd)
     {
         background-color:#C5DAD7;
         }
 
         
</style>

<div class="main-content">
  <div class="title">Dashboard</div>
  <br><br>
  <!-- fetch data into database from table start-->
  <div class="row" style="margin-right: 0px;  margin-left: 0px;">
    <div class="table-ui container-fluid" id="test-list">
      <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:4px;margin-bottom:4px;"
        id="search" placeholder="Search Box">

      <div class="list" style="margin-left:4px;">
        <div class="tr row">
          <div class="col-sm-3 th">Sr No.</div>
          <div class="col-sm-6 th">Registration</div>
          <div class="col-sm-2 th">Notes</div>
          <div class="col-sm-1 th">Action</div>
        </div>
        <?php
             $result=mysqli_query($con,"SELECT * FROM appointment WHERE removed_time=0 AND confirmed_time=0");
              while($rows = mysqli_fetch_assoc($result)){
                $appointment_id=$rows['id'];
              
                 $date1=$rows['date'];

                $date= date("d-m-Y",$date1/1000);
       
                //  $date= date("d/m/Y",($date1));
                 $time1=$rows['time'];
                 $time= date('h:i:s a', strtotime($time1));
                 
                 $doctorid= $rows['drname'];  
                 $doctorname=mysqli_fetch_assoc(mysqli_query($con,"SELECT doctorname x FROM `doctor` WHERE id=$doctorid"))['x']; //single data fetch in array
                 $specialist=mysqli_fetch_assoc(mysqli_query($con,"SELECT specialist x FROM `doctor` WHERE id=$doctorid"))['x']; 
                 echo '<div class="tr row abc" id="myTable">
                       <div class="col-sm-3 td">
                       Register No. : '.$rows['id'].' <br>
                       Appointment time : '.$time.' <br>
                       Appointment date : '.$date.' <br>
                       Dr.Name : '.$doctorname.' <br>
                       Specialist : '.$specialist.' <br>
                     </div>

                     <div class="col-sm-6 td">
                       Patient Name: '.$rows['patient_name'].' <br>
                       Disease: '.$rows['disease'].' <br>
                       Phone1: '.$rows['phone1'].' <br>
                       Phone2: '.$rows['phone2'].' <br>
                      Location: '.$rows['location'].' <br>       
                     </div>

                     <div class="col-sm-2 td">
                     </div>

                     <div class="col-sm-1 td">
                     <button class="btn btn-sm btn-block btn-primary" onclick="modalopen('.$rows['id'].');" >Reset</button>
                     <button class="btn btn-sm btn-block btn-danger"  onclick="deleteentry(this)" data-id="'.$appointment_id.'">Discard</button>
                     <button class="btn btn-sm btn-block btn-success"  onclick="confirmappointment(this)" data-id="'.$appointment_id.'">Confirm</button>
                  
                  
                   </div>
              </div>';
           }
        ?>
      </div>
    </div>
  </div>
  <!-- fetch data into database from table end-->

  <!-- Appointment schedule star -->
  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:70%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Appointment Schedule</h4>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-left:15px">
            <div class="col-sm-2">
              <label> Specialists:</label>
              <select class="form-control" id="specialist">
                <option value="Select">Select</option>
                <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW specialist FROM `doctor` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $specialist=$rows['specialist'];
                                    $id=mysqli_fetch_assoc(mysqli_query($con,"SELECT specialist x FROM `doctor` WHERE  specialist='$specialist' "))['x'];
                                    echo '<option value="'.$id.'" >'.$specialist.'</option>';
                                }
                        ?>
              </select>
            </div>
            <div class="col-sm-3">
              <label> From:</label>
              <input type="date" name="time" class="form-control" id="frmdate">
            </div>
            <div class="col-sm-3">
              <label> To:</label>
              <input type="date" name="time" class="form-control" id="todate">
            </div>
            <div style="margin-left:7px;margin-top:25px">
              <button type="button" class="btn btn-primary pull-right" onclick="fun_search_doctor()">Search</button>
            </div>
            <div class="col-sm-2">
              <label> Doctor Name:</label>
              <select class="form-control" id="dname">
                <option value="Select">Select</option>
              </select>
            </div>
          </div>
        </div>
<br>
        <!-- <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:4px;margin-bottom:4px;"
        id="search" placeholder="Search Box"> -->
        <div class="list1 hidden" style="margin-left:40px;width:90%">
          <div class="tr1 row">
            <div class="col-sm-2 th1">Doctor Name</div>
            <div class="col-sm-2 th1">Specialist</div>
            <div class="col-sm-2 th1">Available</div>
            <div class="col-sm-2 th1">Patient Checking</div>
            <div class="col-sm-2 th1">Appointment</div>
            <div class="col-sm-2 th1">Pending</div>
          </div>
        </div>
        <br>
        <div class="row" style="margin-left:40px">

          <div class="col-sm-5"><label>Patient Name:</label>
            <input type="text" name="inp-name" class="form-control" id="name">
          </div>

          <div class="col-sm-5"><label>Disease:</label>
            <input type="text" name="inp-disease" class="form-control" id="disease">
            <br></div>
          <div class="col-sm-5"><label>Date</label>
            <input type="date" name="date" class="form-control" id="date">
          </div>

          <div class="col-sm-5"><label>Time</label>
            <input type="time" name="time" class="form-control" id="time">
            <br></div>
          <!-- <div class="col-sm-3"></div> -->
          <div class="col-sm-4"><label>Phone 1:</label>
            <input type="text" name="inp-phone" class="form-control" id="phone1">
          </div>

          <div class="col-sm-4"><label>Phone 2:</label>
            <input type="text" name="inp-phone" class="form-control" id="phone2">
          </div>

          <div class="col-sm-3"><label>Location:</label>
            <input type="text" name="inp-location" class="form-control" id="location">
            <br></div>
        </div>
        <div class="modal-footer">
          <button type="button" name="insert" id="btn-submit" class="btn btn-primary btn-block"
            onclick="submit()">ADD</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Appointment schedule end -->

  <button id="myBtn" class="btn btn-primary btn-lg" data-toggle="modal"
    style="font-size:25px;border-radius:50px;width:60px;height:60px;position:fixed;bottom:62px;right: 40px;background:#eb2f06;color:#fff;"
    data-target="#myModal">+</button>

  <!-- Appointment Reschedule start -->

<div class="ui modal" id="mdal1">
  <i class="close icon"></i>
  <div class="header"> Appointment Reschedule </div>
  <div class="content">
    <div class="col-sm-3">
      <label> Specialists:</label>
      <select class="form-control" id="specialist1">
        <option value="Select">Select</option>
        <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW specialist FROM `doctor` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $specialist=$rows['specialist'];
                                    $id=mysqli_fetch_assoc(mysqli_query($con,"SELECT specialist x FROM `doctor` WHERE  specialist='$specialist' "))['x'];
                                    echo '<option value="'.$id.'" >'.$specialist.'</option>';
                                }
                        ?>
      </select>
    </div>
    <div class="col-sm-3">
      <label> From:</label>
      <input type="date" name="time" class="form-control" id="frmdate1">
    </div>
    <div class="col-sm-3">
      <label> To:</label>
      <input type="date" name="time" class="form-control" id="todate1">
    </div>
    <div style="margin-top:24px">
      <button type="button" class="btn btn-primary" onclick="fun_search_doctor1()">Search</button>
    </div>
    <br>
    <div style="clear:both"></div>
    <div class="list2 hidden">
      <div class="tr1 row">
        <div class="col-sm-2 th1">Doctor Name</div>
        <div class="col-sm-2 th1">Specialist</div>
        <div class="col-sm-2 th1">Available</div>
        <div class="col-sm-2 th1">Patient Checking</div>
        <div class="col-sm-2 th1">Appointment</div>
        <div class="col-sm-2 th1">Pending</div>
      </div>
    </div>
    <br>
    <div class="col-sm-2">
      <label> Doctor Name:</label>
    </div>
    <div class="col-sm-9">
      <div class="form-group">
        <select class="form-control" id="dname1">
          <option value="Select">Select</option>
          <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW id,doctorname FROM `doctor` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $doctorname=$rows['doctorname'];
                                    $id=$rows['id'];
                                    echo '<option value="'.$id.'" >'.$doctorname.'</option>';
                                }
                        ?>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <label>Disease:</label>
    </div>
    <div class="col-sm-9">
      <div class="form-group">
        <input type="text" name="disease1" class="form-control" id="disease1">
      </div>
    </div>
    <div class="col-sm-2">
      <label>Date:</label>
    </div>
    <div class="col-sm-9">
      <div class="form-group">
        <input type="date" name="date" class="form-control" id="date1">
      </div>
    </div>
    <div class="col-sm-2">
      <label>Time:</label>
    </div>
    <div class="col-sm-9">
      <div class="form-group">
        <input type="time" name="date" class="form-control" id="time1">
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui black deny button">Nope</div>
    <button class="btn btn-success" id="btn-submit1">Update</button>
  </div>
</div>


  <!-- Appointment Reschedule end -->

  <script>
    function fun_search_doctor() {
      $('.chk').remove();

      var specialist = $('#specialist').val();
      var frmdate = $('#frmdate').val();
      var todate = $('#todate').val();

      valid = true;


      if (valid) {
        // remove old data from dropdown when search new data
        $('#dname')
          .find('option')
          .remove()
          .end()
          .append('<option value="Select">Select</option>')
          .val('Select')

        $.ajax({
          type: "POST",
          url: 'doctorname.php',
          data: "specialist=" + specialist + "&fromdate=" + frmdate + "&todate=" + todate,
          success: function (res) {
            if (res.status == 'success') {
              var json = res.json;
              var str = '';
              for (var i in json) {
                $('#dname').append('<option value="' + json[i].doctorid + '">' + json[i].doctorname +
                  '</option>');

                str += '<div class="tr1 row chk">';

                str += '<div class="col-sm-2 td1 doctorname">' + json[i].doctorname + '</div>';
                str += '<div class="col-sm-2 td1 specialist">' + json[i].specialist + ' </div>';
                str += '<div class="col-sm-2 td1 days">' + json[i].days + '</div>';
                str += '<div class="col-sm-2 td1 pcheck">' + json[i].pcheck + '</div>';
                str += '<div class="col-sm-2 td1 ">' + json[i].appointment + ' </div>';
                str += '<div class="col-sm-2 td1 ">' + json[i].pending + '</div>';

                str += '</div>';
              }
              $('.list1').append(str);

              $('.list1').removeClass('hidden');
            }
          }
        });
      }
    }


    function fun_search_doctor1() {
      $('.chk').remove();

      var specialist = $('#specialist1').val();
      var frmdate = $('#frmdate1').val();
      var todate = $('#todate1').val();

      valid = true;

      if (valid) {
        // remove old data from dropdown when search new data
        $('#dname1')
          .find('option')
          .remove()
          .end()
          .append('<option value="Select">Select</option>')
          .val('Select')

        $.ajax({
          type: "POST",
          url: 'doctorname.php',
          data: "specialist=" + specialist + "&fromdate=" + frmdate + "&todate=" + todate,
          success: function (res) {
            if (res.status == 'success') {
              var json = res.json;
              var str = '';
              for (var i in json) {
                $('#dname1').append('<option value="' + json[i].doctorid + '">' + json[i].doctorname +
                  '</option>');

                str += '<div class="tr1 row chk">';

                str += '<div class="col-sm-2 td1 doctorname">' + json[i].doctorname + '</div>';
                str += '<div class="col-sm-2 td1 specialist">' + json[i].specialist + ' </div>';
                str += '<div class="col-sm-2 td1 days">' + json[i].days + '</div>';
                str += '<div class="col-sm-2 td1 pcheck">' + json[i].pcheck + '</div>';
                str += '<div class="col-sm-2 td1 appointment">' + json[i].appointment + ' </div>';
                str += '<div class="col-sm-2 td1 pending">' + json[i].pending + '</div>';

                str += '</div>';
              }
              $('.list2').append(str);

              $('.list2').removeClass('hidden');
            }
          }
        });
      }
    }


    $(document).ready(function () {
      $("#search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list .abc").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    function deleteentry(e) {
      var appointment_id =$(e).attr('data-id');
      
      if (confirm('Are you sure you want to save this thing into the database?')) {
        $.ajax({
          type: "POST",
          url: '/_api/delete.php',
          data: "&id=" + appointment_id,

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


    function confirmappointment(e) {
      var appointment_id =$(e).attr('data-id');
      
      if (confirm('Appointment confirm?')) {
        $.ajax({
          type: "POST",
          url: '/_api/confirm.php',
          data: "&id=" + appointment_id,

          success: function (res) {
            if (res.status == 'success') {
              alert("Appointment confirmed");
              location.reload();
            }
          }
        });
      } else {
        alert('your record is safe');
      }
    }
    
    
    
    
    function modalopen(id) {
      $('#mdal1').css('top', '10px');
      $('#mdal1').modal('show');
      $('#btn-submit1').attr('onclick', 'update(' + id + ')');
    }

    function update(id) {
      var dname = $('#dname1').val().trim(),
        disease = $('#disease1').val().trim(),
        time = $('#time1').val().trim(),
        date = $('#date1').val().trim();

      console.log(dname);

      valid = true;

      if (dname == '') {
        valid = valid * false;
        $('#dname1').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#dname1').css('border-bottom', '1px solid green');
      }
      if (disease == '') {
        valid = valid * false;
        $('#disease1').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#disease1').css('border-bottom', '1px solid green');
      }
      if (time == '') {
        valid = valid * false;
        $('#time1').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#time1').css('border-bottom', '1px solid green');
      }
      if (date == '') {
        valid = valid * false;
        $('#date1').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#date1').css('border-bottom', '1px solid green');
      }

      if (valid) {
        $.ajax({
          type: "POST",
          url: '/_api/update.php',
          data: "&id=" + id + "&dname=" + dname + "&time=" + time + "&disease=" + disease + "&date=" + date,

          success: function (res) {
            if (res.status == 'success') {
              alert("Record successfully updated");
              location.reload();
            }
          }
        });
      }
    }

    function submit(e) {
      var name = $('#name').val().trim(),
        disease = $('#disease').val().trim(),
        time = $('#time').val().trim(),
        date = $('#date').val().trim(),
        specialist = $('#specialist').val().trim(),
        dname = $('#dname').val().trim(),
        phone1 = $('#phone1').val().trim(),
        phone2 = $('#phone2').val().trim(),
        location = $('#location').val().trim();

      valid = true;

      if (name == '') {
        valid = valid * false;
        $('#name').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#name').css('border-bottom', '1px solid green');
      }

      if (disease == '') {
        valid = valid * false;
        $('#disease').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#disease').css('border-bottom', '1px solid green');
      }

      if (time == '') {
        valid = valid * false;
        $('#time').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#time').css('border-bottom', '1px solid green');
      }

      if (date == '') {
        valid = valid * false;
        $('#date').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#date').css('border-bottom', '1px solid green');
      }

      if (dname == 'Select') {
        valid = valid * false;
        $('#dname').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#dname').css('border-bottom', '1px solid green');
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

      if (location == '') {
        valid = valid * false;
        $('#location').css('border-bottom', '1px solid red');
      } else {
        valid = valid * true;
        $('#location').css('border-bottom', '1px solid green');
      }

      if (valid) {
        // $('#btn-submit').hide();
        $.ajax({
          type: "POST",
          url: '/_api/app.php',
          data: "name=" + name + "&disease=" + disease + "&time=" + time + "&date=" + date + "&specialist=" +
            specialist + "&dname=" + dname + "&phone1=" + phone1 + "&phone2=" + phone2 + "&location=" + location,

          success: function (res) {
            // if (res.status == 'success') {
            //   //$('#btn-submit').show();
            //   alert('Data SuccessFull Save');
            //   location.reload();
            // } else {
            //   	$('#btn-submit').show();
            // }
            if (res.status == 'success') {
              alert('Data SuccessFull Save');
              window.location.href = "/admin/popup.php";
            }
          }
        });
      }
    }

    function myDeleteFunction() {
  document.getElementById("myTable").remove();
}


  </script>