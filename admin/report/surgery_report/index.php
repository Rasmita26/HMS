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
    <div class="title">SURGERY REPORTS</div>
    <div class="container-fluid" style="margin-top:20px">
        <div class="row">

            <div class="col-sm-3">
                <label>UHID NO.</label>
                <input type="text" class="form-control">
            </div>

            <div class="col-sm-3">
                <label>Doctor Name</label>
                <select class="form-control" id="doctorname">
                    <option value="Select"></option>
                    <?php 
                            
                             $result=mysqli_query($con,"SELECT DISTINCTROW  doctor_details FROM surgery ");
                                while($rowss = mysqli_fetch_assoc($result)){
                                    $doctorname=json_decode($rowss['doctor_details']);
                                    foreach ($doctorname as $k) {
                                        
                                        $doctorname1=get_object_vars($k)['doctorname'];
                                        echo '<option value="'.$doctorname1.'" >'.$doctorname1.'</option>';
                                    }
                                
                                }
                        ?>
                </select>
            </div>

            <div class="col-sm-3">
                <label>Date</label>
                <input class="form-control" type="date" id="date">
            </div>

            <div style="margin-top:20px">
                <button class="btn btn-primary submit-btn" id="btn-submit" onclick="search1()">Search</button>
            </div>
        </div>
        <br>
        <input type="text" class="form-control input-sm fuzzy-search" id="search" placeholder="Search Box">
        <br>
        <div class="list">
            <div class="tr row">
                <div class="col-sm-1 th">ID</div>
                <div class="col-sm-2 th">Patient ID </div>
                <div class="col-sm-3 th">Operation Required</div>
                <div class="col-sm-3 th">Doctor Name</div>
                <div class="col-sm-3 th">Material Name</div>
            </div>
        </div>
    </div>
</div>

<script>
    function search1() {
        $('.chk').remove();

        var uhid_no = $('#uhid_no').val();
        var doctor_name = $('#doctorname').val();
        var date = $('#date').val();

        $.ajax({

            type: "POST",
            data: "uhid_no=" + uhid_no + "&doctorname=" + doctor_name + "&date=" + date,
            url: 'selectsurgery.php',
            success: function (res) {
                if (res.status == 'success') {
                    json = res.json;
                    var str = '';

                    var count = 1;
                    for (var i in json) {
                        var doctor_details = res.json[i].doctor_details;
                        var material_details = res.json[i].material_details;
                        str += '<div class="row tr chk">';
                        str += '<div class="col-sm-1 td">' + count + '</div>';
                        str += '<div class="col-sm-2 td">' + json[i].uhid_no + ' </div>';
                        str += '<div class="col-sm-3 td">' + json[i].operationrequired + '</div>';
                        str += '<div class="col-sm-3 td ">';
                        console.log(doctor_details);

                        for (var k in doctor_details) {
                            str += 'Doctor name:-' + doctor_details[k].doctorname + '<br>' +
                                'Specialist :-' + doctor_details[k].specialist + '<br>' + 'Designation :-' +
                                doctor_details[k].designation + '<br>' + 'Charges :-' + doctor_details[k]
                                .charges + '<br>';
                        }
                        str += '</div>';

                        str += '<div class="col-sm-3 td ">';
                        console.log(material_details);

                        for (var k in material_details) {
                            str += 'Material name:-' + material_details[k].materialname + '<br>' +
                                'Quantity :-' + material_details[k].quantity + '<br>' + 'Price :-' +
                                material_details[k].price + '<br>';
                        }
                        str += '</div>';
                        // for (var i = 0; i < doctor_details.length; i++) {
                        // if(doctor_details[i].doctorname && doctor_details[i].specialist  && doctor_details[i].designation  && doctor_details[i].charges){
                        // str += '<div class="col-sm-3 td ">'   +  doctor_details[i].doctorname  + '<br>' + doctor_details[i].specialist  + '<br>' + doctor_details[i].designation + '<br>' + doctor_details[i].charges +'</div>';
                        //  }   

                        // if(material_details[i].materialname && material_details[i].quantity  && material_details[i].price ){
                        //   str += '<div class="col-sm-3 td ">' + material_details[i].materialname  + '<br>' + material_details[i].quantity   + '<br>' + material_details[i].price +'</div>';
                        //}   

                        str += '</div>';
                        count++;
                    }
                    $('.list').append(str);

                }
            }
        });
    }


    //     var doctor_details = res.json[0]['doctor_details'];

    // for(var i in doctor_details){

    //     var markup = '<div class="tr row">';
    //     // markup += '<div class="col-sm-2 td id" style="display:none;">' +  + '</div>';
    //     markup += '<div class="col-sm-2 td doctorname">' + doctor_details[i].doctorname + '</div>';
    //     markup += '<div class="col-sm-2 td specialist">' + doctor_details[i].specialist + '</div>';
    //     markup += '<div class="col-sm-2 td designation">' + doctor_details[i].designation + '</div>';
    //     markup += '<div class="col-sm-2 td charges">' +    doctor_details[i].charges + '</div>';
    //     markup += '<div class="col-sm-4 td"><button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
    //     markup += '</div>';
    //     $(".table-ui > .list").append(markup);
    //  }

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