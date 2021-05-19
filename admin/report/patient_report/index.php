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
    <div class="title">PATIENT REPORTS</div>
    <div class="container-fluid" style="margin-top:20px">
        <div class="row">

            <div class="col-sm-2">
                <label>Gender</label>
                <select class="form-control" id="gender">
                    <option value="Select">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Transgender">Transgender</option>
                </select>
            </div>

            <div class="col-sm-2">
                <label>Age</label>
                <select class="form-control" id="age">
                    <option value="Select">Select</option>
                    <?php
                        for ($i=1; $i<=100; $i++)
                        {
                            ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>

            <div class="col-sm-2">
                <label>Type</label>
                <select class="form-control" id="type">
                    <option value="Select">Select</option>
                    <option value="Treatment">Treatment/IPD</option>
                    <option value="Surgery">Surgery/OPD</option>
                </select>
            </div>

            <div class="col-sm-2">
                <label>Month :</label>
                <input class="form-control"
                        type="month" id="month">
            </div>

            <div class="col-sm-2">
                <label>Date:</label>
                <input class="form-control"
                        type="date" id="date">
            </div>

            <div style="margin-top:25px">
                <button class="btn btn-primary submit-btn " id="btn-submit" onclick="search()">Search</button>
                <br> <br> </div>
           
            <div class="col-sm-3" style="margin-left:25px">
                <label>Find By Phone & Email :</label>
                <input class="form-control"
                        type="text" id="phone_email">
            </div>
        
            <div style="margin-top:20px">
            
                <button class="btn btn-primary submit-btn" id="btn-submit" onclick="search1()">Search</button>
    <br><br></div>
       </div>

        <input type="text" class="form-control input-sm fuzzy-search" id="search"  placeholder="Search Box">
        <br>
        <div class="list">
            <div class="tr row">
                <div class="col-sm-1 th">ID</div>
                <div class="col-sm-2 th">Patient Name</div>
                <div class="col-sm-1 th">Gender</div>
                <div class="col-sm-1 th">Age</div>
                <div class="col-sm-1 th">Relative Name</div>
                <div class="col-sm-2 th">Address</div>
                <div class="col-sm-1 th">phone </div>
                <div class="col-sm-1 th">Type</div>
                <div class="col-sm-1 th">Disease</div>
                <div class="col-sm-1 th">Deposit</div>
            </div>
        </div>
    </div>
</div>

<script>

$('#phone_email').keypress(function (e) {
	if (e.which == 13) {
        search1();
	}
});

    function search() {
        $('.chk').remove();

        $.ajax({

                type: "POST",
                data: "gender=" + $('#gender').val() + "&age=" + $('#age').val() + "&type=" + $('#type').val() +"&month=" + $('#month').val() +"&date=" + $('#date').val(),
                url: 'select.php',
                success: function (res) {
                    if (res.status == 'success') {
                        json = res.json;
                        var str = '';
                              
                        for (var i in json) {
                            str += '<div class="row tr chk">';

                            str += '<div class="col-sm-1 td">'+ json[i].uhid_no+'</div>';
                            str += '<div class="col-sm-2 td">' + json[i].patient_name + ' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].gender + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].age + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].relative_name + ' </div>';
                            str += '<div class="col-sm-2 td">' + json[i].address + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].mobileno1 + '<br>' + json[i].mobileno2 + ' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].type + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].disease + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].deposit + ' </div>';

                            str += '</div>';
                        }

                        $('.list').append(str);
                    }
                }
            }

        );
    }
 function search1() {
        $('.chk').remove();

        $.ajax({

                type: "POST",
                data: "phone=" + $('#phone_email').val(),
                url: 'select1.php',
                success: function (res) {
                    if (res.status == 'success') {
                        json = res.json;
                        var str = '';

                        for (var i in json) {
                            str += '<div class="row tr chk">';

                            str += '<div class="col-sm-1 td">' + json[i].uhid_no + '</div>';
                            str += '<div class="col-sm-2 td">' + json[i].patient_name + ' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].gender + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].age + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].relative_name + ' </div>';
                            str += '<div class="col-sm-2 td">' + json[i].address + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].mobileno1 + '<br>' + json[i].mobileno2 +' </div>';
                            str += '<div class="col-sm-1 td">' + json[i].type + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].disease + '</div>';
                            str += '<div class="col-sm-1 td">' + json[i].deposit + ' </div>';
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