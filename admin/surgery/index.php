<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();

$json1='';

$result1=mysqli_query($con,"SELECT uhid_no FROM surgery");
while($rows1 = mysqli_fetch_assoc($result1)){
 $uhid_no=$rows1["uhid_no"];
 $patient_name=mysqli_fetch_assoc(mysqli_query($con, "SELECT patient_name x FROM patient_details where uhid_no='$uhid_no'"))['x'];

 $json1.=',{"patient_name":"'.$patient_name.'","uhid_no":"'.$uhid_no.'"}';   
}

$json1=substr($json1,1);
$json1='['.$json1.']';

?>
<style>
  .list {
        padding: 0px;
    }
    .list li span {
        display: inline;
    }
    .list li {
        text-decoration: none;
        display: block;
        padding: 2px;
        background: #FFF;
        border: 1px solid #333;
        color: #000;
    }
.sidenav1 {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 2;
        top: 85px;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 10px;
    }
    .sidenav1 a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }
    .sidenav1 a:hover {
        color: #f1f1f1;
    }
    .sidenav1 .closebtn1 {
        position: absolute;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }
    @media screen and (max-height: 450px) {
        .sidenav1 {
            padding-top: 15px;
        }

        .sidenav1 a {
            font-size: 18px;
        }
    }
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

    <div class="title">Dashboard</div> <br>


    <input type="hidden" id="item-json4" value='<?php echo str_replace("'"," &#39;",$json1); ?>' />
<span style="font-size:20px;cursor:pointer" onclick="openNav1()">&#9776; Search</span>
<div id="mysidenav1" class="sidenav1" style="margin-left:65px;">

    <div id="test-list" style="padding:5px;">
        <a href="javascript:void(0)" class="closebtn1" onclick="closeNav1()">&times;</a>
        <br><br><br>
        <div class="form-group">
            <input type="text" placeholder="Search" id="search" class="form-control input-sm fuzzy-search"
                style="border-radius:3px;">
        </div>
        <ul class="list">
        </ul>
    </div>
</div>
<script>

var json4 = JSON.parse($("#item-json4").val());
console.log(json4);
// var strdb1 = '';
var selectdb5 = '';
for (var i in json4) {
    
        selectdb5 += '<li><span class="patientid">' + (json4[i].patient_name) + '</span><button style="margin-left:2px;" data-employeeid="' + json4[i].uhid_no + '" onclick="edit(this)" class="btn btn-primary btn-sm"> <span class="fa fa-edit"></span> E</button> <button style="margin-left:2px;" data-employeeid="' + json4[i].uhid_no + '" onclick="deleteentry('+json4[i].uhid_no+')" class="btn btn-danger btn-sm"> <span class="fa fa-edit"></span> D</button></li>';
        // strdb1 += '<option value="' + json1[i].fname + '">' + capitalize_Words(json1[i].fname) + '</option>';

}
$('.list').append(selectdb5);
function openNav1() {
  console.log('abc');
  
    document.getElementById("mysidenav1").style.width = "292px";
}

function closeNav1() {
    document.getElementById("mysidenav1").style.width = "0";
}
var monkeyList = new List('test-list', {
    valueNames: ['patientid']
});

        </script>


<div class="row" style="margin-left:20px">

<div class="col-sm-1" hidden><label>UHID NO.</label>
            <select class="form-control" id="uhid" >

                <?php 
                                $result=mysqli_query($con,"SELECT DISTINCTROW uhid_no FROM `patient_details`");
                                while($row=mysqli_fetch_assoc($result)){
                                    $uhid_no=$row['uhid_no'];
                                   
                                echo "<option value=".$uhid_no.">".$uhid_no."</option>";
                                }
                            ?>
            </select>
        </div>
        <div class="col-sm-2"><label>UHID NO.</label>
        <input type="text" class="form-control" id="pid">
          
        </div>
        <div class="col-sm-3"><label>Operation Required</label>
            <input class="form-control" type="text" id="operation"></input>
        </div>
        <div class="col-sm-3"><label>Total Bill</label>
            <input class="form-control" type="text" id="totalbill"> </input>
        </div>

        <div class="col-sm-3"><label>Date</label>
            <input class="form-control" type="date"  value="<?php echo $_today; ?>" id="date"> </input>
        </div>
    </div>
    <br>
    <div class="table-ui container-fluid" id="test-list">
        <div class="list" style="margin-left:20px;width:120%">
            <div class="tr row">
                <div class="col-sm-2 th">Doctor Name</div>
                <div class="col-sm-2 th">Specialist</div>
                <div class="col-sm-2 th">Designation</div>
                <div class="col-sm-2 th">Charge</div>
                <div class="col-sm-2 th">Action</div>
            </div>
            <div class=" tr row" id="inp-calc">
                <div class="col-sm-2 td">
                    <input class="form-control" type="text" name="doctorname" list="doctorname" id="dname1">
                    <datalist id="doctorname">
                        <!-- <option  value="Select"></option> -->
                        <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW doctorname FROM `doctor` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $doctorname=$rows['doctorname'];
                                   
                                    echo '<option value="'.$doctorname.'" >'.$doctorname.'</option>';
                                }
                        ?>
                    </datalist>
                </div>
                <div class="col-sm-2 td">
                    <select class="form-control" id="specialist">
                        <option value="Select">Select Specialist</option>
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
                <div class="col-sm-2 td">
                    <select class="form-control" id="designation">
                        <option value="Select">Designation</option>
                        <?php 
                             $result=mysqli_query($con,"SELECT DISTINCTROW designation FROM `doctor` ");
                                while($rows = mysqli_fetch_assoc($result)){
                                    $designation=$rows['designation'];
                                    $id=mysqli_fetch_assoc(mysqli_query($con,"SELECT designation x FROM `doctor` WHERE  designation='$designation' "))['x'];
                                    echo '<option value="'.$id.'" >'.$designation.'</option>';
                                }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2 td">
                    <input type="number" class="form-control" placeholder="Charges" id="charges" />
                </div>
                <div class="col-sm-2 td">
                    <button class="btn btn-sm btn-success" onclick="btnsubmit()" style="margin-left:60px">ADD</button>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>

    <div class="table-ui container-fluid" id="test-list">
        <div class="list1" style="margin-left:20px;width:110%">
            <div class="tr row">
                <div class="col-sm-3 th">Material Name</div>
                <div class="col-sm-3 th">Quantity</div>
                <div class="col-sm-3 th">Price</div>
                <div class="col-sm-2 th">Action</div>
            </div>
            <div class=" tr row" id="inp-calc">
                <div class="col-sm-3 td">
                    <input type="text" class="form-control" id="materialname" />
                </div>
                <div class="col-sm-3 td">
                    <input type="number" class="form-control" id="quantity" />
                </div>

                <div class="col-sm-3 td">
                    <input type="number" class="form-control" id="price" />
                </div>
                <div class="col-sm-2 td">
                    <button class="btn btn-sm btn-success" onclick="btnsubmit1()" style="margin-left:50px">ADD</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <button class="btn btn-primary" id="btn-submit" onclick="submit()" style="margin-left:75%;margin-top:20px">
            Submit </button>
            <br> <br>  </div>
   
    <!-- <div style="margin-left:50%;"><label>Total Charges</label>
    <input style="width:50%" class="form-control" type="text" id="hospitalbill"> </input>
    </div> -->
</div>

<script>
    function btnsubmit() {

        var did = $("#doctorname").val();
        var dname = $("input[name=doctorname]").val();
        var specialist = $("#specialist").val();
        var designation = $("#designation").val();
        var charges = $("#charges").val();

        var markup = '<div class="tr row">';
        markup += '<div class="col-sm-2 td id" style="display:none;">' + did + '</div>';
        markup += '<div class="col-sm-2 td doctorname">' + dname + '</div>';
        markup += '<div class="col-sm-2 td specialist">' + specialist + '</div>';
        markup += '<div class="col-sm-2 td designation">' + designation + '</div>';
        markup += '<div class="col-sm-2 td charges">' + charges + '</div>';
        markup +=
            '<div class="col-sm-4 td"><button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
        markup += '</div>';
        $(".table-ui > .list").append(markup);

        // $("#doctorname").val('');
        $("input[name=doctorname]").val('').trigger('change');
        $("#specialist").val('');
        $("#designation").val('');
        $("#charges").val('');


    }


    function edit(e) {
            closeNav1();
         
var uhid_no = $(e).attr('data-employeeid');
console.log(uhid_no);

            $.ajax({
                type: "POST",
                url: 'select.php',
                data: "uhid_no=" + uhid_no,
                success: function (res) {
                    if (res.status == 'success') {
                         $('#uhid').val(uhid_no);

                        $('#btn-submit').text('Update');
                        $('#btn-submit').attr('onclick', 'update()');
                        var json = res.json[0];
                       
                         
                         console.log(doctor_details);
                         

                        $('#pid').val(json.uhid_no);
                        $('#operation').val(json.operationrequired);
                        $('#totalbill').val(json.patientcharges);
                        $('#date').val(json.date);
                        var doctor_details = res.json[0]['doctor_details'];

                        for(var i in doctor_details){

                            var markup = '<div class="tr row">';
                            // markup += '<div class="col-sm-2 td id" style="display:none;">' +  + '</div>';
                            markup += '<div class="col-sm-2 td doctorname">' + doctor_details[i].doctorname + '</div>';
                            markup += '<div class="col-sm-2 td specialist">' + doctor_details[i].specialist + '</div>';
                            markup += '<div class="col-sm-2 td designation">' + doctor_details[i].designation + '</div>';
                            markup += '<div class="col-sm-2 td charges">' +    doctor_details[i].charges + '</div>';
                            markup += '<div class="col-sm-4 td"><button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
                            markup += '</div>';
                            $(".table-ui > .list").append(markup);
                         }

                         var material_details = res.json[0]['material_details'];

                          for(var i in material_details){
                            var markup = '<div class="tr row abc">';

                            markup += '<div class="col-sm-3 td materialname">' + material_details[i].materialname + '</div>';
                            markup += '<div class="col-sm-3 td quantity">' + material_details[i].quantity + '</div>';
                            markup += '<div class="col-sm-3 td price">' + material_details[i].price + '</div>';
                            markup +=
                                '<div class="col-sm-2 td"><button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
                            markup += '</div>';
                            $(".table-ui > .list1").append(markup);
                          }
                    }
                    }
                    });
                    }




   function btnsubmit1() {

        var materialname = $("#materialname").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();

        var markup = '<div class="tr row abc">';

        markup += '<div class="col-sm-3 td materialname">' + materialname + '</div>';
        markup += '<div class="col-sm-3 td quantity">' + quantity + '</div>';
        markup += '<div class="col-sm-3 td price">' + price + '</div>';
        markup +=
            '<div class="col-sm-2 td"><button class="btn-danger btn-sm btn" onclick="remove(this)">Remove</button></div>';
        markup += '</div>';
        $(".table-ui > .list1").append(markup);

        $("#materialname").val('');
        $("#quantity").val('');
        $("#price").val('');
    }

    
function remove(e) {
$(e).parent().parent().fadeOut(1000, function () {
    $(this).remove();
});
}

    function submit() {

        // var pid = $('#pid').val().trim(),
        var operation = $('#operation').val().trim(),
            totalbill = $('#totalbill').val().trim(),
            doctorname = $('#doctorname').val().trim(),
            // specialist = $('#specialist').val().trim(),
            // designation = $('#designation').val().trim(),
            charges = $('#charges').val().trim(),
            materialname = $('#materialname').val().trim(),
            quantity = $('#quantity').val().trim(),
            price = $('#price').val().trim();

        valid = true;

        if (operation == '') {
            valid = valid * false;
            $('#operation').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#operation').css('border-bottom', '1px solid green');
        }

        if (totalbill == '') {
            valid = valid * false;
            $('#totalbill').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('#totalbill').css('border-bottom', '1px solid green');
        }

        var arr = [];
        var counter = 0;
        $('.list > .tr').each(function () {
            if (counter != 0) {
                arr.push({
                    'doctorname': $(this).find('.doctorname').text(),
                    'specialist': $(this).find('.specialist').text(),
                    'designation': $(this).find('.designation').text(),
                    'charges': $(this).find('.charges').text(),
                });
            } else {
                counter++;
            }
        });


        var arr1 = [];
        var counter1 = 0;
        $('.list1 > .tr ').each(function () {

            if (counter1 != 0) {
                arr1.push({
                    'materialname': $(this).find('.materialname').text().trim(),
                    // 'materialname': $(this).find('.materialname').text().trim(),
                    'quantity': $(this).find('.quantity').text().trim(),
                    'price': $(this).find('.price').text().trim()
                });
            } else {
                counter1++;
            }
        });

        arr.shift();
        if (arr == '') {
            valid = valid * false;
            $('.list').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('.list').css('border-bottom', '1px solid green');
        }

        arr1.shift();
        if (arr1 == '') {
            valid = valid * false;
            $('.list1').css('border-bottom', '1px solid red');
        } else {
            valid = valid * true;
            $('.list1').css('border-bottom', '1px solid green');
        }

        if (valid) {
            var data = JSON.stringify(arr);
            var data1 = JSON.stringify(arr1);
            $.ajax({
                type: "POST",
                data: {
                    data: data,
                    data1: data1,
                    pid: $('#pid').val(),
                    operation: $('#operation').val(),
                    totalbill: $('#totalbill').val(),
                    date: $('#date').val(),
                },
                url: 'insert.php',
                success: function (res) {
                    if (res.status == 'success') {
                        alert('Data SuccessFull Save');
                        location.reload();
                        // $('#hospitalbill').val(res.totalamt);
                    } else {
                        $('#btn-submit').show();
                    }
                }
            });
        }
    }




                                function update() {
                                        var uhid_no=$('#pid').val(),
                                        date = $('#date').val();
                                        operation = $('#operation').val();
                                        totalbill =$('#totalbill').val();

                            valid = true;

                            
                                    var arr = [];
                                    var counter = 0;
                                    $('.list > .tr').each(function () {
                                        if (counter != 0) {
                                            arr.push({
                                                'doctorname': $(this).find('.doctorname').text(),
                                                'specialist': $(this).find('.specialist').text(),
                                                'designation': $(this).find('.designation').text(),
                                                'charges': $(this).find('.charges').text(),
                                            });
                                        } else {
                                            counter++;
                                        }
                                    });
                                       

                                    var arr1 = [];
                                    var counter1 = 0;
                                    $('.list1 > .tr ').each(function () {

                                        if (counter1 != 0) {
                                            arr1.push({
                                                'materialname': $(this).find('.materialname').text().trim(),
                                                // 'materialname': $(this).find('.materialname').text().trim(),
                                                'quantity': $(this).find('.quantity').text().trim(),
                                                'price': $(this).find('.price').text().trim()
                                            });
                                        } else {
                                            counter1++;
                                        }
                                    });




                            console.log(arr);

                            if (valid) {
                                arr.shift();
                                arr1.shift();
                                var data = JSON.stringify(arr);
                                var data1 = JSON.stringify(arr1);
                                
                              

                                $.ajax({
                                    type: "POST",
                                    data: {
                                        data: data,
                                        data1:data1,
                                        uhid_no1:$('#uhid').val(),
                                        uhid_no: $('#pid').val(),
                                        operation: $('#operation').val(),
                                        totalbill: $('#totalbill').val(),
                                         date: $('#date').val(),
                                        
                                    },
                                    url: 'update.php',
                                    success: function (res) {
                                        if (res.status == 'success') {
                                            alert('Data Update SuccessFull Save');
                                            location.reload();
                                        } else {
                                            $('#btn-submit').show();
                                        }
                                    }
                                });
                            }
                            }


</script>

<?php 
  include($base.'_in/footer.php');
?>