<?php
$base='../../';
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
    <div class="title">BILLING</div> <br>
    <img class="hidden" id=imageid src="../../../../img/login-img.png">
    <div id="div-content" class="content">
        <table width="100%" style="position:fixed;width:93%; z-index: 1;">
            <tr>
                <td align="center" style="width:25%"><a href="/admin/Billing/index.php"
                        style="border:1px solid white;border-radius:0px;background:#21AD91;" class="btn btn-primary btn-block">Billing</td>
                <td align="center" style="width:25%"><a href="/admin/Billing/receipt.php"
                        style="border:1px solid white;border-radius:0px;background:#1E8685;"
                        class="btn btn-primary btn-block">Receipt generate</td>
               
            </tr>
        </table>
    </div>

    <br><br><br>

    <div class="row" style="margin-left:15px">
        <div class="col-sm-3"><label>Date<span class="text-danger">*</span></label>
            <input type="date" value="<?php echo $_today; ?>" class="form-control" id="date">
        </div>
        <div class="col-sm-3"><label>Patient ID<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="patientid"></input>
        </div>
        <button style="height:40px;margin-top:20px;margin-left:30px" type="button" class="btn btn-primary pull-right"
            onclick="fun_search()">Search</button>

        <button style="height:40px;margin-top:20px;margin-left:30px;width:60px" class="btn btn-sm btn-warning"
            onclick="print(this)">PRINT</button>
    </div>
    <div class="list" style="margin-left:30px;margin-top:30px;width:115%">
        <div class="tr row">
            <div class="col-sm-2 th"> Billing Date</div>
            <div class="col-sm-4 th">Description</div>
            <div class="col-sm-2 th">Amount</div>
        </div>
    </div>
    <br>
    <div style="margin-left:56%;"><label>Total</label>
        <input type="text" id="totalPrice" disabled></input>
    </div>
</div>

<script>
    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL.replace('/^data:image\/(png|jpg);base64,/', "");
    }

    function fun_search() {
        $('.chk').remove();
        $.ajax({
            type: "POST",
            data: "patientid=" + $('#patientid').val(),
            url: 'table.php',
            success: function (res) {
                if (res.status == 'success') {
                    json = res.json;

                    $('.list').append(json);

                    $('#totalPrice').val(res.totalamt);
                }
            }
        });
    }

    function print() {
        var patientid = $('#patientid').val();
        var date = $('#date').val();

        $.ajax({
            type: "POST",
            data: "date=" + date + "&patientid=" + patientid,
            url: 'print.php',
            cache: false,
            success: function (res) {
                if (res.status == 'success') {
                    var tablejson = res.json;
                    var billdetail = res.billdetail;
                    var surgeryjson = res.surgeryjson;
                    
                    var count = 0;
                    var base64 = getBase64Image(document.getElementById("imageid"));

                    var content = [];

                    content.push({
                        table: {
                            widths: ['*', '*', '*'],
                            headerRows: 3,
                            body: [
                                [{
                                    rowSpan: 3,
                                    stack: [{
                                        image: base64,
                                        width: 100,
                                        height: 80
                                    }]
                                }, {
                                    text: res.hname,
                                    alignment: 'right',
                                    bold: 'true',
                                    fontSize: '16',
                                    color: 'blue',
                                    colSpan: 2
                                }, ''],
                                ['', {
                                    text: 'Address:',
                                    alignment: 'right'
                                }, {
                                    text: res.address,
                                    border: [false, false, false, false]
                                }],
                                ['', {
                                    text: 'Phoneno:',
                                    alignment: 'right'
                                }, {
                                    text: res.phoneno,
                                    border: [false, false, false, false]
                                }],
                            ]
                        },
                        layout: 'noBorders'
                    });
                    content.push({
                        columns: [{
                            text: ' \n\nRECEIPT\n\n',
                            fontSize: 14,
                            bold: 1,
                            alignment: 'center',
                        }],
                    });
                    content.push({
                        table: {
                            alignment: 'center',
                            widths: ['*', '*', '*', '*', '*'],
                            fontSize: 20,
                            body: [
                                [{
                                    text: 'PAITENT ID. ',
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false],
                                }, {
                                    text: billdetail[0].patientid,
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: 'DATE ',
                                    alignment: 'right',
                                    bold: 'true',
                                    fontSize: '8',
                                    border: [false, false, false, false],
                                }, {
                                    text: billdetail[0].date,
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '8',
                                    border: [false, false, false, false],
                                }, ],
                                [{
                                    text: '',
                                    alignment: 'left',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, ],
                                [{
                                    text: 'PATIENT NAME ',
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false],
                                }, {
                                    text: billdetail[0].patient_name,
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, ],
                                // [{
                                //     text: 'EMAIL-ID',
                                //     alignment: 'left',
                                //     bold: 'true',
                                //     fontSize: '9',
                                //     border: [false, false, false, false],
                                // }, {
                                //     text: billdetail[0].email,
                                //     alignment: 'left',
                                //     bold: 'true',
                                //     fontSize: '9',
                                //     border: [false, false, false, false]
                                // }, {
                                //     text: '',
                                //     border: [false, false, false, false]
                                // }, {
                                //     text: '',
                                //     border: [false, false, false, false]
                                // }, {
                                //     text: '',
                                //     border: [false, false, false, false]
                                // }, ],
                                [{
                                    text: 'PHONE NO.',
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false],
                                }, {
                                    text: billdetail[0].mobileno1,
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, ],
                                [{
                                    text: '',
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false],
                                }, {
                                    text: billdetail[0].mobileno2,
                                    alignment: 'left',
                                    bold: 'true',
                                    fontSize: '9',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, {
                                    text: '',
                                    border: [false, false, false, false]
                                }, ],
                            ]
                        },
                        style: 'tablfont1',
                    });


                    var table1 = {
                        widths: ['auto', '*', 'auto'],
                        dontBreakRows: true,
                        body: []
                    };
                    var header = ['Srno', 'Descripation', 'Amount'];
                    table1['body'].push(header);

                    var bedjson = res.bedjson;
                    var header1 = ['1', {
                        text: 'Assigndate:-' + bedjson.assigndate + '\n Dischargedate:-' + bedjson
                            .dischargedate + '\n Bed:-' + bedjson.bedtype + ' \n Room:-' + bedjson
                            .roomtype
                    }, bedjson.price];
                    table1['body'].push(header1);

                    var cr = 1;
                    // var surgeryjson = res.surgeryjson;
                    // cr++;
                    // var header2 = [cr, {
                    //     text: 'Surgery Date :- ' + surgeryjson.date + '\n Operation :-' +surgeryjson.operationrequired
                       
                    // }, surgeryjson.patientcharges];
                    // table1['body'].push(header2);

                    
                    var total = 0;
                    var total1 = 0;
                    for (var i in tablejson) {
                        cr++;
                        var arr = [];
                       
                        arr.push(cr, {
                            text: 'Bill No : ' + tablejson[i].billno
                        }, tablejson[i].amount);
                        table1['body'].push(arr);

                        total += parseFloat(tablejson[i].amount);
                     }
                      for (var k in surgeryjson) {
                        cr++;
                        var arr1 = [];
                       
                        arr1.push(cr, {
                            text: 'Surgery Date : ' + surgeryjson[k].date + ' Operation' +surgeryjson[k].operationrequired
                        }, surgeryjson[k].patientcharges);
                        table1['body'].push(arr1);

                        total1 += parseFloat(surgeryjson[k].patientcharges);
                    }
                
                    var total_Amount = total + total1 + parseFloat(bedjson.price);

                    content.push({
                        columns: [{
                            style: 'tablfont',
                            table: table1,
                            fontSize: 10,
                            bold: true
                        }]
                    })

                    content.push({
                        columns: [{
                            text: '\n',
                            bold: 1,
                            alignment: 'left',
                        }],
                    });

                    content.push({
                        table: {
                            alignment: 'center',
                            widths: ['*', '*', '*', '*', '*', '*'],
                            fontSize: 20,
                            body: [
                                [{
                                        text: '',
                                        border: [false, false, false, false]
                                    },
                                    {
                                        text: '',
                                        border: [false, false, false, false]
                                    },
                                    {
                                        text: '',
                                        border: [false, false, false, false]
                                    },
                                    {
                                        text: '',
                                        border: [false, false, false, false]
                                    },
                                    {
                                        text: 'Total Amount',
                                        alignment: 'left',
                                        bold: 'true',
                                        fontSize: '12',
                                        border: [false, false, false, false],
                                        fillColor: '#71bbd4'
                                    },
                                    {
                                        text: total_Amount,
                                        alignment: 'center',
                                        fillColor: '#71bbd4',
                                        bold: 'true',
                                        fontSize: '12',
                                        border: [false, false, false, false]
                                    },
                                ],

                            ]
                        },
                        style: 'tablfont1',
                    });

                    content.push({
                        columns: [{
                            text: '\n\n\n Authorised Signature',
                            border: [0, 0, 0, 0],
                            alignment: 'right'
                        }]
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
                                            text: '© Tata Memorial Center (India) PVT. LTD. | PAGE ' +
                                                currentPage.toString() + ' of ' +
                                                pageCount,
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
</script>