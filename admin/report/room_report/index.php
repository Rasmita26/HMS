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
    <div class="title">ROOM REPORT</div>
    <div class="container-fluid" style="margin-top:20px">
        <div class="row">
            <div class="col-sm-3">
                <label>Ward Type</label>
                <select class="form-control" id=ward>
                    <option value="Select"></option>
                    <option value="General">General</option>
                    <option value="ICU">ICU</option>

                </select>
            </div>
            <div class="col-sm-3">
                <label>Date</label>
                <input type="date" class="form-control" id="date">
            </div>
            <div class="col-sm-3">
                <label>Month</label>
                <input type="month" class="form-control" id="month">
            </div>

            <div style="margin-top:25px">
                <button class="btn btn-primary submit-btn " id="btn-submit" onclick="search()">Search</button>
            </div>
        </div>
        <br>
        <input type="text" class="form-control input-sm fuzzy-search" id="search" placeholder="Search Box">
        <br>
        <div class="list">
            <div class="tr row">
                <div class="col-sm-2 th">ID</div>
                <div class="col-sm-2 th">Ward Type</div>
                <div class="col-sm-2 th">Patient Name</div>
                <div class="col-sm-2 th">Date</div>
                <div class="col-sm-2 th">Bed no</div>
                <div class="col-sm-2 th">Price</div>

            </div>
        </div>
    </div>
</div>

<script>
    function search() {
        $('.chk').remove();

        $.ajax({

                type: "POST",
                data: "wardtype=" + $('#ward').val() + "&date=" + $('#date').val() + "&month=" + $('#month').val(),
                url: 'select.php',
                success: function (res) {
                    if (res.status == 'success') {
                        json = res.json;
                        var str = '';

                        for (var i in json) {
                            str += '<div class="row tr chk">';

                            str += '<div class="col-sm-2 td">' + json[i].id + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].bedtype + '<br>' + json[i].roomtype +
                                ' </div>';
                            str += '<div class="col-sm-2 td">' + json[i].patient_name + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].assign_time + '<br>' + json[i]
                                .discharge_time + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].bedno + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].price + '</div>';
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