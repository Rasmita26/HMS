<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>
<style>
    .th {
        background: #2845CE;
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

    .tr:nth-child(even) {
        background-color: #eee;
    }

    .tr:nth-child(odd) {
        background-color: #CFD5F2;
    }
</style>
<div class="main-content">

    <div class="title">DOCTORS REPORTS</div> <br>
    <div class="row" style="margin-top:20px;margin-left:30px">

        <div class="col-sm-3">
            <label>Doctor Name</label>
            <select class="form-control" id="doctorname">
                <option value="Select">Select</option>
                <?php 
                 $result=mysqli_query($con,"SELECT id,doctorname FROM `doctor` ");
                    while($rows = mysqli_fetch_assoc($result)){
                        $id=$rows['id'];
                        $doctorname=$rows['doctorname'];
                      
                        echo '<option value="'.$id.'" >'.$doctorname.'</option>';
                    }
            ?>
            </select>
        </div>

        <div class="col-sm-3">
            <label>Specialist</label>
            <select class="form-control" id="specialist">
                <option value="Select">Select</option>
                <?php 
                 $result=mysqli_query($con,"SELECT specialist FROM `doctor` ");
                    while($rows = mysqli_fetch_assoc($result)){
                        $specialist=$rows['specialist'];
                       
                        echo '<option value="'.$specialist.'" >'.$specialist.'</option>';
                    }
            ?>
            </select>
        </div>
        <div class="col-sm-2">
            <label>Designation</label>
            <select class="form-control" id="designation">
                <option value="Select">Select</option>
                <?php 
                 $result=mysqli_query($con,"SELECT designation FROM `doctor` ");
                    while($rows = mysqli_fetch_assoc($result)){
                        $designation=$rows['designation'];
                        echo '<option value="'.$designation.'" >'.$designation.'</option>';
                    }
            ?>
            </select>
        </div>
        <div class="col-sm-2" style="margin-top:23px">
            <button class="btn btn-primary submit-btn " id="btn-submit" onclick="fun_search()">Search</button>
        </div>
    </div>
    <br>
    <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:5px;" id="search"
        placeholder="Search Box">
    <br>
    <div class="list">
        <div class="tr row">
            <div class="col-sm-1 th">ID</div>
            <div class="col-sm-2 th">Doctor Name</div>
            <div class="col-sm-2 th">Specialist</div>
            <div class="col-sm-1 th">Phone</div>
            <div class="col-sm-2 th">Designation</div>
            <div class="col-sm-2 th">Time</div>
            <div class="col-sm-2 th">Days</div>

        </div>
    </div>
</div>
<script>
    function fun_search() {
        $('.chk').remove();

        var doctorname = $('#doctorname').val();
        var specialist = $('#specialist').val();
        var designation = $('#designation').val();

        $.ajax({

            type: "POST",
            data: "doctorname=" + doctorname + "&specialist=" + specialist + "&designation=" + designation,
            url: 'select.php',
            success: function (res) {
                if (res.status == 'success') {
                    json = res.json;
                    var str = '';

                    for (var i in json) {
                        str += '<div class="tr row chk">';
                        str += '<div class="col-sm-1 td">' + json[i].id + ' </div>';
                        str += '<div class="col-sm-2 td">' + json[i].doctorname + '</div>';
                        str += '<div class="col-sm-2 td">' + json[i].specialist + '</div>';
                        str += '<div class="col-sm-1 td">' + json[i].phone + ' </div>';
                        str += '<div class="col-sm-2 td">' + json[i].designation + '</div>';
                        str += '<div class="col-sm-2 td">' + json[i].frmtime + '<br>' + json[i].totime +
                            ' </div>';
                        str += '<div class="col-sm-2 td">' + json[i].days + '</div>';

                        str += '</div>';
                    }
                    $('.list').append(str);

                }
            }
        });
    }

    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();

            $(".list .chk").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<?php 
  include($base.'_in/footer.php');
?>