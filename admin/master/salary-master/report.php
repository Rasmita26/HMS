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
        padding-top: 4px;
        padding-bottom: 2px;
        border: 1px solid #fff;
    }

    .td {
        border: 1px solid #ddd;
        background: #eee;
        padding-top: 1px;
        padding-bottom: 1px;
    }

    .table-ui .btn {
        margin: 3px;
    }
    /* .tr:nth-child(even)
     {
         background-color: #eee;
         }
         .tr:nth-child(odd)
     {
         background-color:#CFD5F2;
         } */
</style>
<div class="main-content">
    <div class="title">SALARY MASTER</div>
    <br>
    <!-- <img class="hidden" id=imageid src="../../../../img/login-img.png"> -->

    <div id="div-content" class="content">
        <table width="100%" style="position:fixed;width:93%; z-index: 1;">
            <tr>
                <td align="center" style="width:25%"><a href="/admin/master/salary-master/index.php"
                        style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Employee
                       </td>
                <td align="center" style="width:25%"><a href="/admin/master/salary-master/visiting_doctor.php"
                        style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Visiting
                        Doctor</td>

                <td align="center" style="width:25%"><a href="/admin/master/salary-master/outsidedoctor.php"
                        style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Outsider
                        Doctor
                </td>
                <td align="center" style="width:25%"><a href="/admin/master/salary-master/report.php"
                        style="border:1px solid white;border-radius:0px;background:#1E8685;"
                        class="btn btn-primary btn-block">Salary
                        Report
                </td>
            </tr>
        </table>
    </div>

    <div class="row" style="margin-top:50px;margin-left:30px">
        <div class="col-sm-4">
            <label>Type</label>
            <select class="form-control" id="type" name="type">
                <option value="Select">Select</option>
                <option value="employee_salary">Employee salary</option>
                <option value="vistingdoctorsalary">Doctor salary</option>
                <option value="outsidedoctor">Outsider Doctor salary</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Month</label>
            <input type="month" class="form-control" id="month">
        </div>

        <div style="margin-left:7px;margin-top:25px">
            <button class="btn btn-primary submit-btn" id="btn-submit" onclick="search()">Search</button>
            <br><br> </div>
    </div>

    <input type="text" class="form-control input-sm fuzzy-search" id="search" placeholder="Search Box">
    <!-- <input type="text" class="form-control input-sm fuzzy-search" style="margin-top:4px;margin-bottom:4px;" id="search"
                placeholder="Search Box"> -->
    <div class="table-ui container-fluid" id="test-list" style="margin-top:10px;margin-left:15%">
        <div class="list">
            <div class="tr row">
                <div class="col-sm-4 th">Name</div>
                <div class="col-sm-4 th">Salary</div>
            </div>
        </div>
    </div>
</div>

<script>
    // function fun_type(e) {
    //     var employee_salary      = $('#type').val();
    //         visitingdoctorsalary = $('#type').val();
    //         outsidedoctor        = $('#type').val();
    //     $.ajax({
    //         type: "POST",
    //         data: "type=" + $(e).val(),
    //         url: 'gettype.php',
    //         success: function (res) {
    //             if (res.status == 'success') {
    //                 json = res.json;

    //                 for (var i in json) {
    //                     console.log(json[i]);
    //                     $('#type').append(json[i]);
    //                 }
    //             }
    //         }
    //     });
    // }


    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".list .chk").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function search() {
        $('.chk').remove();
        var type = $('#type').val();
        var month = $('#month').val();

        $.ajax({
                type: "POST",
                data: "type=" + $('#type').val() + "&month=" + $('#month').val(),
                url: 'reportinfo.php',
                success: function (res) {
                    if (res.status == 'success') {
                        json = res.json;
                        console.log(json);

                        var str = '';

                        for (var i in json) {
                            str += '<div class="tr row chk">';
                            str += '<div class="col-sm-4 td">' + json[i].name + '</div>';
                            str += '<div class="col-sm-4 td">' + json[i].paidsalary + ' </div>';

                            str += '</div>';
                        }
                        $('.list').append(str);
                    }
                }
            }

        );
    }
</script>