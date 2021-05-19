<?php
    $base='../../';
    include($base.'_in/connect.php');
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    if(isset($_POST['supplier']) && isset($_POST['medicinename']) && isset($_POST['frmdate']) && isset($_POST['todate'])){
        $con=_connect();
       
        $supplier =$_POST["supplier"];
        $medicinename =$_POST["medicinename"];
        $frmdate =$_POST["frmdate"];
        $todate =$_POST["todate"];

        $query='';
        if($supplier=='Select' && $medicinename=='Select' && $frmdate=='' && $todate==''){
            $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry`";
        }

       if($supplier=='Select' && $medicinename=='Select' && $frmdate!='' && $todate!==''){
           $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE purchasedate BETWEEN '$frmdate' AND '$todate'";
        }

        if($supplier=='Select' && $medicinename!='Select' && $frmdate!='' && $todate!==''){
          $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE purchasedate BETWEEN '$frmdate' AND '$todate' AND medicineid='$medicinename'";  
        }

        if($supplier!='Select' && $medicinename!='Select' && $frmdate!='' && $todate!==''){
            $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE purchasedate BETWEEN '$frmdate' AND '$todate' AND medicineid='$medicinename' AND supplierid='$supplier'";  
        }
        if($supplier!='Select' && $medicinename!='Select' && $frmdate==''  && $todate==''){
            $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE medicineid='$medicinename' AND supplierid='$supplier'";  
        }
        if($supplier!='Select' && $medicinename=='Select' && $frmdate==''  && $todate==''){
            $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE supplierid='$supplier'";  
        }
        if($supplier!='Select' && $medicinename=='Select' && $frmdate!='' && $todate!==''){
            $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE purchasedate BETWEEN '$frmdate' AND '$todate' AND supplierid='$supplier'";  
        }
        if($supplier=='Select' && $medicinename!='Select' && $frmdate=='' && $todate==''){
            $query="SELECT pono,purchase_billno,DATE_FORMAT(purchasedate,'%d/%m/%Y') as purchasedate,DATE_FORMAT(purchase_billdate,'%d/%m/%Y') as purchase_billdate,unit,quantity,received_qty,netamount,(select sname from supplier where supplier.id=gateentry.supplierid)as supplier_name,(select name from medicine where medicine.id=gateentry.medicineid)as medicine_name FROM `gateentry` WHERE medicineid='$medicinename'";  
        }
        
         $result=mysqli_query($con,$query);
        while($rows1 = mysqli_fetch_assoc($result)){
            
            $supplierid=$rows1['supplier_name'];
            $purchaseid=$rows1['pono'];
            $purchasedate=$rows1['purchasedate'];
            $purchase_billdate=$rows1['purchase_billdate'];
            $medicinename=$rows1['medicine_name'];
            $unit=$rows1['unit'];
            $quantity=$rows1['quantity'];
            $received_quantity=$rows1['received_qty'];
            $purchase_billno=$rows1['purchase_billno'];
            $netamount=$rows1['netamount'];
            $total_amount+=$netamount;
            
            

            $json.=',{"sname":"'.$supplierid.'","pono":"'.$purchaseid.'","name":"'.$medicinename.'","unit":"'.$unit.'",
            "quantity":"'.$quantity.'","received_qty":"'.$received_quantity.'","purchase_billno":"'.$purchase_billno.'","purchasedate":"'.$purchasedate.'","purchase_billdate":"'.$purchase_billdate.'","netamount":"'.$netamount.'"}';
        }
    
            $json=substr($json,1);
            $json='['.$json.']';
            
            if($result) {
                echo '{"status":"success","json":'.$json.',"total_amount":'.$total_amount.'}';
    }else{
        echo '{"status":"failed2"}';
      }
  }else{
      echo '{"status":"failed1"}';
  }
?> 

