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
    <div class="title">APPOINTMENT REPORTS</div>
    <div class="container-fluid" style="margin-top:20px">

        <div class="col-sm-3">
            <label>Month :</label>
            <input class="form-control" type="month" id="month">
        </div>


        <div class="col-sm-3">
            <label>Confirm/Discard</label>
            <select class="form-control" id="appointment">
                <option value="Select">Select</option>
                <option value="confirm">Confirm</option>
                <option value="discard">Discard</option>
            </select>
        </div>
        <div style="margin-top:25px">
            <button class="btn btn-primary submit-btn" id="btn-submit" onclick="search()">Search</button>
        </div>

        <br>
        <div class="list">
            <div class="tr row">
                <div class="col-sm-1 th">SR No.</div>
                <div class="col-sm-2 th">Date</div>
                <div class="col-sm-2 th">Time</div>
                <div class="col-sm-3 th">Patient Details</div>
                <div class="col-sm-4 th">Doctor Details</div>
                <!-- <div class="col-sm-2 th">Status</div> -->
            </div>
        </div>
    </div>
</div>

<script>
    function search() {
        $('.chk').remove();

        $.ajax({

                type: "POST",
                data: "&appointment=" + $('#appointment').val() + "&month=" + $('#month').val(),
                url: 'selectappointment.php',
                success: function (res) {
                    if (res.status == 'success') {
                        json = res.json;
                        var str = '';

                        for (var i in json) {
                            str += '<div class="tr row chk">';
                            str += '<div class="col-sm-1 td">' + json[i].id + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].date + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].time + '</div>';
                            str += '<div class="col-sm-3 td">Patient Name:-' + json[i].patient_name + '<br>Phone No.1:-' + json[i].phone1 + '<br>Phone No.2:-' + json[i].phone2 + '<br>Location:-' + json[i].location + ' </div>';
                            str += '<div class="col-sm-4 td">Doctor Name:-' + json[i].drname + '<br>Specialist:-' + json[i].specialist + '</div>';
                            // str += '<div class="col-sm-1 td">' + json[i].age + '</div>';

                            str += '</div>';
                        }

                        $('.list').append(str);
                    }
                }
            }

        );
    }



    $(document).ready(function () {
            $("#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();

                    $(".list .chk").filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        }

                    );
                }

            );
        }

    );
</script>

<?php 
  include($base.'_in/footer.php');
?>