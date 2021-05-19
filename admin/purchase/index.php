<?php
$base='../../';
include($base."_in/header.php");
include($base."_in/connect.php");
$con=_connect();
if (session_status()==PHP_SESSION_NONE) { session_start(); }   
$created_by=$_SESSION['id'];

?>

<style>

/* .table-list th {
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    background-color: #16a085;
    color: white;
} */

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
    <div class="title">PURCHASE</div>
    <input type="hidden" value="<?php echo $_SESSION['id'];?>" id="created_by">

    <br>
    <img  class="hidden"  id=imageid src="../../../../img/login-img.png" >
    <div class="container-fluid crm">
        <div id="div-content" class="content">
            <table width="100%" style="position:fixed;width:93%; z-index: 1;">
                <tr>
                    <td align="center" style="width:25%"><a href="/admin/purchase/index.php"
                            style="border:1px solid white;border-radius:0px;background:#1E8685;"
                            class="btn btn-primary btn-block">Purchase Order</td>
                    <td align="center" style="width:25%"><a href="/admin/purchase/gateentry.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Gate
                            Entry</td>
                  
                    <td align="center" style="width:25%"><a href="/admin/purchase/reports.php"
                            style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Reports
                    </td>

                </tr>
            </table>


        </div>
    </div>
    <br><br><br>

<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-12 table-responsive">
        <div class="table-ui container-fluid table-list">

            <div class="tr row">
                <div class="col-sm-1 th">Order No.</div>
                <div class="col-sm-1 th">Order Date</div>
                <div class="col-sm-3 th">Supplier Info</div>
                <div class="col-sm-6 th">Order</div>
                <div class="col-sm-1 th">Action</div>
            </div>

            <?php
                        $result=mysqli_query($con,"SELECT DISTINCTROW pono,purchasedate,supplierid from purchase WHERE gateentry_time=0 ");
                        while($rows=mysqli_fetch_assoc($result)){
                            $supplierid=$rows['supplierid'];
                            $pono=$rows['pono'];
                            $date=$rows['purchasedate'];
                            $supplier=mysqli_fetch_assoc(mysqli_query($con,"SELECT * from supplier WHERE id='$supplierid'"));
                            $sname=$supplier['sname'];
                            $address=$supplier['address'];
                            $semail=$supplier['semail'];
                            $phoneno=$supplier['phoneno'];
                            $cname=json_decode($supplier['cname']);
                            foreach($cname as $i){
                                 $cname=get_object_vars($i)['cname'];
                                 $mobile=get_object_vars($i)['mobile'];
                                 $department=get_object_vars($i)['department'];
                          

                                break;
                            
                             }
                            

                            ?>
            <div class="tr row">
                <div class="col-sm-1 td" style="word-wrap:break-word;"><?php echo $rows['pono']; ?></div>
                <div class="col-sm-1 td" style="word-wrap:break-word;"><?php echo date("d-m-Y",strtotime($rows['purchasedate'])) ; ?></div>
                <div class="col-sm-3 td" style="word-wrap:break-word;">
                    <?php echo 'Supplier Name : ' .$sname; ?><br><?php echo 'Email :' .$semail; ?><br><?php echo 'Phoneno :' .$phoneno; ?>
                    <br><?php echo 'Address :' .$address; ?><br><?php echo 'Contact Person :' .$cname.'<br> Mobile : '.$mobile.'<br> Department : '.$department; ?>
                </div>
                <div class="col-sm-6 td" style="word-wrap:break-word;">
                    <?php
                                    $result1=mysqli_query($con,"SELECT medicineid,unit,quantity,rate,actual_amount,amount_afterdesc,cgstamt,sgstamt,igstamt,netamount FROM `purchase` WHERE pono='$pono' AND purchasedate='$date' AND supplierid='$supplierid'");
                                echo '<table class="table table-list form-group">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th width="200">Medicine Name</th>';
                                echo '<th>Unit</th>';
                                echo '<th>Qty</th>';
                                echo '<th>Rate</th>';
                                echo '<th>Actual Amount</th>';
                                echo '<th>Dicount</th>';
                                echo '<th>CGST</th>';
                                echo '<th>SGST</th>';
                                echo '<th>IGST</th>';
                                echo '<th >Net Amount</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                
                                while($rows=mysqli_fetch_assoc($result1)){
                                  $medicineid=  $rows['medicineid'];
                                            echo '<tr>';

                                            $name=mysqli_fetch_assoc(mysqli_query($con,"SELECT name x from medicine WHERE id='$medicineid'"))['x'];
                                            echo '<td>'.$name.'</td>';

                                            echo '<td style="display:none">'.$rows['medicineid'].'</td>';
                                            echo '<td>'.$rows['unit'].'</td>';
                                            echo '<td>'.$rows['quantity'].'</td>';
                                            echo '<td>'.$rows['rate'].'</td>';
                                            echo '<td>'.$rows['actual_amount'].'</td>';
                                            echo '<td>'.$rows['amount_afterdesc'].'</td>';
                                            echo '<td>'.$rows['cgstamt'].'</td>';
                                            echo '<td>'.$rows['sgstamt'].'</td>';
                                            echo '<td>'.$rows['igstamt'].'</td>';
                                            echo '<td>'.$rows['netamount'].'</td>';
                                            echo '</tr>';
                                    
                                        }
                                echo '</tbody>';
                                echo '</table>';


                                


                                
                                    
                                ?>

                </div>

                <div class="col-sm-1 td" style="word-wrap:break-word;"><button
                        class="btn btn-sm btn-block btn-success" data-link1="gateentry_by" data-link2="gateentry_time" data-purchaseid='<?php echo $pono; ?>' onclick="confirm(this)">Confirm</button>
                    <a class="btn btn-sm btn-block btn-primary" href="/admin/purchase/getpurchasedetails.php?pono=<?php echo $pono; ?>" >Edit</a>
                    <button class="btn btn-sm btn-block btn-warning" data-pono='<?php echo $pono;?>'
                        onclick="printer(this)">Print</button>
                    <button class="btn btn-sm btn-block btn-primary hidden" onclick="TriggerOutlook()">Email</button>

                </div>
                </div>
                <?php
                        }
                                    
                        ?>

            

        </div>


    </div>
    <button onclick="window.location='/admin/purchase/getpurchasedetails.php'" id="myBtn" class="btn btn-primary btn-lg"
        data-toggle="modal"
        style="font-size:25px;border-radius:50px;width:60px;height:60px;position: fixed;bottom: 40px;right: 40px;background:#eb2f06;color:#fff;"
        data-target="#myModal">+</button>

</div>

</div>
</div>


    <script>



function confirm(e) {
  var purchaseid = $(e).data('purchaseid'),
  created_by = $('#created_by').val();
  $.ajax({
    type: "POST",
    data: 'pono=' + purchaseid +"&created_by=" + created_by,
    url: 'confirm.php',
    cache: false,
    success: function (res) {
      if (res.status == 'success') {
        window.location.href ='/admin/purchase/gateentry.php';
  
      }
    }
  });
}
 

function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL("image/png");
  return dataURL.replace('/^data:image\/(png|jpg);base64,/', "");
}


function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}




    
    function printer(e) {
        var pono=$(e).attr('data-pono');

        $.ajax({
            type: "POST",
            data: 'id=' + pono,
            url: 'print.php',
            cache: false,
            success: function (res) {
                if (res.status == 'success') {
                    var tablejson = res.json;
                    var purchasedetail = res.purchasedetail;
                    var count=0;
                    var base64 = getBase64Image(document.getElementById("imageid"));


                    var content = [];
        
                    content.push({
                        table: {
				        widths: ['*', '*', '*'],
				        headerRows: 3,
				            body: [
                                    [{rowSpan: 3,stack: [{image:base64,width: 100, height:80}]}, {text:res.hname,alignment: 'right',bold: 'true',fontSize: '16',color: 'blue',colSpan: 2}, ''],
                                    ['', {text:'Address',alignment: 'right'},{text:  res.address,border: [false, false, false, false]}],
                                    ['', {text:'Phoneno',alignment: 'right'},{text: res.phoneno,border: [false, false, false, false]}],
				                ]
                            },
                            layout: 'noBorders'
                    }); 

       

                            content.push({
                        columns: [  {                 
                                    text: 'PURCHASE ORDER\n\n',
                                    fontSize: 14,
                                    bold: 1,
                                    alignment: 'center',
                                }],
                            });


                            
  


                        
                        content.push({
  table: {
    // heights: [20, 20, 20],
    alignment: 'center',
    widths: ['*','*','*','*','*'],
    fontSize: 20,
   
   

    body: [
     [{text: 'PURCHASEORDERNO. ',alignment: 'left',bold: 'true',fontSize: '8', border: [false, false, false, false],},{text: purchasedetail[0].pono,alignment: 'left',bold: 'true',fontSize: '8', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: 'PURCHASE DATE ',alignment: 'right',bold: 'true',fontSize: '8', border: [false, false, false, false],},{text:purchasedetail[0].purchasedate,alignment: 'left',bold: 'true',fontSize: '8', border: [false, false, false, false],},],
      [{text: '',alignment: 'left', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},],
      [{text: 'SUPPLIER NAME ',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false],},{text: purchasedetail[0].sname,alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},],
      [{text: 'EMAIL-ID',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], },{text: purchasedetail[0].semail,alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},],
      [{text: 'PHONE NO.',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false],},{text: purchasedetail[0].supplierphoneno,alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},],
      [{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},],
   
     
    
    ]
  }, style: 'tablfont1',
});



var table2 = {
                    dontBreakRows: true,
                    widths: ['auto','*','auto','auto'],

                    body: []
                };

var hardwareheader=['Srno','Item Name','Quantity','Rate'];

                  table2["body"].push(hardwareheader);
               
                content.push({
        table: {
           // headerRows: 1,
            widths: ['*'],
            body: [
                [''],
                ['']
            ]
        },
        layout: 'headerLineOnly'
        
    });
    var cr=1;
for(var i in tablejson){
   var tb=[];
   tb.push(cr,tablejson[i].name,tablejson[i].qty,tablejson[i].rate);
   table2['body'].push(tb);
   cr++;
}

    content.push({
                        text: "",
                        fontSize: 20,
                        bold: true,
                        alignment: 'center'
                    }, {
                        style:'tablfont',
                        table: table2
                    });





                         content.push({
                                columns: [  { 
                                        text: '\n',
                                        fontSize: 12, bold:1,
                                        alignment: 'left',
                                }],
                            });
                                
                                
            

                            content.push({
  table: {
    // heights: [20, 20, 20],
    alignment: 'center',
    widths: ['*','*','*','*','*','*'],
    fontSize: 20,
   
   

    body: [
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: 'AMOUNT',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], fillColor: '#71bbd4'}, {text:'₹ ' + res.actualamount,alignment: 'center',fillColor: '#71bbd4',bold: 'true',fontSize: '9', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: 'DISCOUNT',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], fillColor: '#71bbd4'},{text: '₹ '+ res.descamount,alignment: 'center',fillColor: '#71bbd4',bold: 'true',fontSize: '9', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: 'CGST',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], fillColor: '#71bbd4'},{text:'₹ '+ res.cgstamount,alignment: 'center',fillColor: '#71bbd4',bold: 'true',fontSize: '9', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: 'SGST',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], fillColor: '#71bbd4'},{text:'₹ '+ res.sgstamount,alignment: 'center',fillColor: '#71bbd4',bold: 'true',fontSize: '9', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: 'IGST',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], fillColor: '#71bbd4'},{text:'₹ '+ res.igstamount,alignment: 'center',fillColor: '#71bbd4',bold: 'true',fontSize: '9', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},],
      [{text: convertNumberToWords(res.netamount),colSpan:4, border: [false, false, false, false],fillColor: '#71bbd4' },{},{},{},{text: 'NET AMOUNT',alignment: 'left',bold: 'true',fontSize: '9', border: [false, false, false, false], fillColor: '#71bbd4'},{text:'₹ '+ res.netamount,alignment: 'center',fillColor: '#71bbd4',bold: 'true',fontSize: '9', border: [false, false, false, false]},],
      [{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},{text: '',alignment: 'center', border: [false, false, false, false]},],
     
    ]
  }, style: 'tablfont1',
});

content.push({
    columns: [ 

                {text:'\n\nAuthorised Signatory', border: [0, 0, 0, 0],alignment:'right'}
                ]
});
                 

                    docDefinition = {
                        pageSize: 'A4',
                        pageOrientation: 'portrait',
                        pageMargins: [40, 30, 30, 35],
                        footer: function (currentPage, pageCount) {
                            return {
                                margin: 10,
                                columns: [{
                                    fontSize: 9,
                                    text: [{
                                            text: '--------------------------------------------------------------------------' +
                                                '\n',
                                            margin: [0, 20]
                                        },
                                        {
                                            text: '© Tata Memorial Center (India) PVT. LTD. | PAGE ' + currentPage.toString() + ' of ' + pageCount,
                                        }
                                    ],
                                    alignment: 'center'
                                }]
                            };

                        },
                        content,
                        styles: {
                            tablfont: {
                                fontSize: 9
                            },
                            tablfont1: {
                                fontSize: 9
                            }
                        }
                    }

                    var win = window.open('', '_blank');
                    pdfMake.createPdf(docDefinition).open({}, win);
                }
            }
        })


    }

//     function TriggerOutlook(e)

// {
//   var ccontact = $('#ccontact').val();
//   var enquiryid = $(e).data('enquiryid');
//   console.log(enquiryid);
//   var body = href="http://vaishnaviacservice.co.in/process/transaction/enquiry1/quatation/email.php?enquiryid="+enquiryid;
//   // var body = href="Vaishnavi AC Serviceshttp://vservice.local/process/transaction/enquiry1/quatation/email.php?enquiryid="+enquiryid;
//   var subject = "Vaishnavi AC Services";
//   var TO = ccontact;

//   window.location.href = "mailto: " + TO + "?body=Quatation Pdf Fille%0D%0A%0D%0A" + body + "&subject=" + subject;
//   // window.location.href = "mailto:user@example.com?subject=Subject&body=message%20goes%20here";


// }

    </script>
 

