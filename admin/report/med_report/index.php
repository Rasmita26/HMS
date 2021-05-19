<?php
$base='../../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
?>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;

    }


    th {
        background: #2845CE;
        color: #fff;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 2px;
        border: 1px solid #fff;
    }

    td {
        border: 1px solid #ddd;
        /* background: #eee; */
    }

    tr:nth-child(even) {
        background-color: #CFD5F2;
    }

    tr:nth-child(odd) {
        background-color: #eee;
    }
</style>
<div class="main-content">
    <div class="title">MEDICINE REPORTS</div>
    <div class="container-fluid" style="margin-top:20px">
<div style="margin-left:90%;">
        <button style="background-color:#1CD3DC;height:30px;width:80px" id="btnExport"> EXPORT </button>
</div>
<br>
        <input type="text" class="form-control input-sm fuzzy-search" id="search" placeholder="Search Box">
        <br>
        <!-- <table class="list" id="table"> -->
        <table id="table">
            <th width="50">ID</th>
            <th>Medicine Details</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Quantity Issued</th>
            <th>Live Quantity</th>

            <tbody>


                <?php
              
             $result=mysqli_query($con,"SELECT * FROM `medicine`");
             $count=0;
              while($rows = mysqli_fetch_assoc($result)){
                  $count++;
                  $name= $rows['name'];
             
                $issueqty=mysqli_fetch_assoc(mysqli_query($con,"SELECT issueqty x FROM billstock  WHERE medicinename='$name' "))['x'];
                $liveqty=$rows['quantity']-$issueqty;



                echo '<tr style="border: 1px solid black; text-align: center">';
                echo '<td style=" border: 1px solid black; text-align: center">'.$count.'</td>';
                echo '<td style="border: 1px solid black; text-align: left">  
                Medicine Name    : '.$name.' <br>
                Category         : '.$rows['category'].' <br>
                Manufacturer     : '.$rows['manufactured'].' <br></td>';
                echo '<td style="border: 1px solid black; text-align: center">Price : '.$rows['price'].'</td>';
    
                echo '<td style="border: 1px solid black; text-align: center">Quantity : '.$rows['quantity'].'</td>';
                echo '<td style="border: 1px solid black; text-align: center">Quantity issued : '.$issueqty.'</td>';
                echo '<td style="border: 1px solid black; text-align: center">Quantity : '.$liveqty.'</td>';
    
             
  
                echo '</tr>';

           }
        ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
            $(;
                "#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();

                    $(".list").filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        }

                    );
                }

            );
        }

    );



    $(document).ready(function () {
        $("#btnExport").click(function () {
            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[
            0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `export.xlsx`, // fileName you could use any name
                sheet: {
                    name: 'Sheet 1' // sheetName
                }
            });
        });
    });
</script>