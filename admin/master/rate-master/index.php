<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>
<style>
  .style-hr{ border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
}
/* .table-list th {
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    background-color: #1BBCA7;
    color: white;
} */


body{
    font-size: 18px;
}
.table-list th {
        background:#1BBCA7;
        color: #fff;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 2px;
        border: 1px solid #fff;
    }
    .table-list td {
        border: 1px solid #ddd;
        font-size: 18px;

        /* background: #eee; */
    }
    .table-list tr:nth-child(even)
     {
        background-color:#C5DAD7;
         }
         .table-list tr:nth-child(odd)
     {
        background-color: #eee;   
         }
 

</style>
<div class="main-content">
    <div class="title"> MEDICINE RATE MASTER</div>

    <div class="content" style="margin-left:76.8px;margin-top:74.575px;" data-select2-id="6">
        <h2 align="center">Supplier Medicine Rate Master</h2>
        <hr class="style-hr">
        <div class="col-sm-3"> </div>
        <div class="col-sm-2">Medicine Name </div>
        <div class="col-sm-4">
            <select class="form-control" id="medicinename" >

                <option value="Select" id="mydropdowm" >Select</option>
                <?php 
                                $result=mysqli_query($con,"SELECT  medicineid FROM `stock` WHERE stockqty<>0 ORDER BY id DESC");
                                while($row=mysqli_fetch_assoc($result)){
                                    $medicineid=$row['medicineid'];
                                    $medicinename=mysqli_fetch_assoc(mysqli_query($con,"SELECT name x FROM medicine WHERE id='$medicineid'"))['x'];
                                echo "<option value=".$medicineid.">".$medicinename."</option>";
                                }
                            ?>
            </select>
        </div>
        <div style="clear:both;"></div>

        <hr class="style-hr">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <table id="supplierRate" class="table table-list">
                <thead>
                    <tr>
                        <th rowspan="2">Supplier Name</th>
                        <th rowspan="2">Rate</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                              $result1=mysqli_query($con,"SELECT  id,sname FROM `supplier`");
                              while($rows1 = mysqli_fetch_assoc($result1)){
                                echo "<tr>";
                                 echo "<td style='display:none;' class='sid' >" . $rows1['id'] . "</td>";
                                echo "<td class='sname'>" . $rows1['sname'] . "</td>";
                                echo "<td align='center' style='padding:0px!important;'><input type='number' class='form-control input-sm rate'></td>"; 
                                echo "</tr>";
                              }
                       ?>
                </tbody>
            </table>
        </div>

        <div style="clear:both;"></div>
        <hr class="style-hr">
        <div class="col-sm-3"></div>
        <div class="col-sm-3"><button class="btn btn-primary" id="btn-submit" onclick="submit()"
                style="margin-left:90%;width:50%">Submit</button></div>

        <div class="col-sm-3"></div>

    </div>
</div>


<script>
    function submit() {
     
        valid=true;
        var arr = [];

                $('.table-list > tbody > tr').each(function () {
                        arr.push({
                            'medicinename': $('#medicinename').val(),
                            'sid': $(this).find('.sid').text().trim(),
                            'sname': $(this).find('.sname').text().trim(),
                            'rate': $(this).find('.rate').val(),    
                        });
                });
               
                console.log(arr);
                

                if (valid) {
                    var data = JSON.stringify(arr);
                    $.ajax({
                        type: "POST",
                        data: {
                            data: data

                        },
                        url: 'insert.php',


                        success: function (res) {
                            if (res.status == 'success') {
                                alert('Data SuccessFull Save');
                                location.reload();
                            } else {
                                $('#btn-submit').show();
                            }
                        }
                    });
                }

    }    
        </script>

