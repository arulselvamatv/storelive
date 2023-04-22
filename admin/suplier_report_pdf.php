<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    <title></title>
   <style>
        table,
        td,
        tr {
            border: 1px solid black;
        }
    </style>
</head>


 
 
 
<body style="padding:7px 100px 40px ;">
   
 <div class="rounded-3" style="background-color:#99c2ff;padding:5px 0;"> <h1 class="text-center">Supplier In Report1</h1></div>
     
<?php
require_once("database/connect.php");
$db=new Database;
$db->connect();

$supplier = '';
$date = '';
$bill_no = '';
$dep_no = '';
$filtered = false; 
$po_no = ''; 


if(isset($_REQUEST['po_no']))
    {
    $po_no   = $_REQUEST['po_no'];
    }


if( $po_no != 1 )
{
    $from_date= $_REQUEST['from_date'];
    $to_date  = $_REQUEST['to_date'];
    $sup_name = $_REQUEST['sup_name'];
    
     $bill_no = $_REQUEST['bill_no'];
    
    $dep_no = $_REQUEST['dep_no'];
    
    
    if( !empty( $from_date ) && !empty( $to_date ) ) {
		$date = " AND wo.date_time between '". $from_date ."' and '". $to_date ."' ";
		$filtered = true; 
	}
    if( empty( $to_date ) && isset( $from_date ) && !empty( $from_date ) ) {
        $date = " AND DATE( wo.date_time ) = '". $from_date ."'";
        $filtered = true; 
    }
	if(empty( $from_date ) &&  isset( $to_date ) && !empty( $to_date ) ) {
		$date = " AND DATE( wo.date_time ) = '". $to_date ."' ";
		$filtered = true; 
	} 

    if( isset( $sup_name ) && !empty( $sup_name ) ) {
        $supplier = " AND wo.suplier_id = " . $sup_name;
        $filtered = true; 
    }
    if( isset($bill_no) && !empty($bill_no))
    {
        $bill = " AND se.billno = " . $bill_no;
        $filtered = true; 
    }
     if( isset($dep_no) && !empty($dep_no))
    {
        $po= " AND wo.dep_no = " . $dep_no;
        $filtered = true; 
    }
}

    if($filtered){
	            $asd =('SELECT distinct se.billno,wo.dep_no
				FROM work_order as wo
				INNER join suplier as s on s.sup_id =wo.suplier_id
				INNER join   store_entry as se on se.po_id =wo.wo_id
				WHERE wo.`active_record` =1 '. $supplier .' '. $date .' '.$bill.'  '.$po.'  group by wo.prod_name');
	} else{
            $asd =('SELECT wo.suplier_id as suplier_id, s.name as supplier_name,(wo.prod_name) as item_name,wo.ddl_pro_qty, wo.date_time as `po_date` 
			FROM work_order as wo
			INNER join suplier as s on s.sup_id =wo.suplier_id
			WHERE wo.`active_record` =1 '. $supplier .' '. $date .' '.$bill.'  '.$po.' group by wo.prod_name ');
		}

   $data = $db->query($asd);
	$i=0;
     while($prd = $data->fetch(PDO::FETCH_ASSOC)) { 
              $i++;  
              if($filtered){
				   echo
				   
				 'Bill Number : '.$prd['billno'].'  PO Number : '.$prd['dep_no'].'
				   
				   <table class="table table-bordered" id="trn_dlr_pi_inv" target=”_blank” > 
					  <thead>
						<tr>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">S.No.</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Date</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">po Number</th > 
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Bill Number</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Supplier Name</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Product Name</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Qty</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">suplier amount </th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Discount amount </th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Gst Amount</th>
						<th class="text-center" style="background-color:#e6f0ff;font-weight: 700;">Total</th>
						</tr>
					  </thead>
					  <tbody id="tbody1">
				   ';
				   
						$sup_rep = ('SELECT wo.suplier_id as suplier_id, s.name as supplier_name,se.billno,(wo.prod_name) as item_name,wo.ddl_pro_qty, wo.date_time as `po_date` , 
						wo.sup_amt,wo.disc_amt,wo.gst_amt,wo.tot,wo.dep_no ,wo.tran_charge_gst

            						 FROM work_order as wo 
            						 INNER join suplier as s on s.sup_id =wo.suplier_id 
            						 INNER join store_entry as se on se.po_id =wo.wo_id 
            						 WHERE wo.`active_record` =1 AND se.billno = '.$prd['billno'].' and wo.dep_no = "'.$prd['dep_no'].'" group by wo.prod_name');
						$sup_rep_data = $db->query($sup_rep);
					 $j=0;
					 $tot=0;
					 while($reports = $sup_rep_data->fetch(PDO::FETCH_ASSOC)) {
						++$j;

						$tran_charge_gst=$reports['tran_charge_gst'];

						$sup_amt=$reports['sup_amt'] ;
						$ddl_pro_qty=$reports['ddl_pro_qty'];
						
						$tot += $sup_amt*$ddl_pro_qty+$tran_charge_gst;
						 
						echo '<tr>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$j.'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['po_date'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['dep_no'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['billno']. '</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['supplier_name']. '</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['item_name'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['ddl_pro_qty'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['sup_amt'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['disc_amt'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 400;font-size: 14px;">'.$reports['gst_amt'].'</th>'.
						'<th style="color:#111;text-align: center; font-weight: 600;font-size: 16px;">'.$reports['sup_amt'] * $reports['ddl_pro_qty'].
						'</th>'.
						'</tr>';
					}

					echo 
					'<tr class="text-end h5">'.
					'<th colspan="10">Transport Total'.
					   '<th colspan="11">'.$tran_charge_gst.'</th>'.
				   '</tr>'.
					
					'<tr class="text-end ">'.
					'<th colspan="10">Grand Total'.
					   '<th colspan="11">'.$tot.'</th>'.
					   '</tr>';
					
					echo '</tbody></table>';
					
			   }else {

					echo '<tr>'.
					'<th>'.$i.'</th>'.
					'<th>'.$prd['po_date'].'</th>'.
					'<th>'.$prd['dep_no'].'</th>'.
					'<th>'.$prd['billno']. '</th>'.
					'<th>'.$prd['supplier_name']. '</th>'.
					'<th>'.$prd['item_name'].'</th>'.
					'<th>'.$prd['ddl_pro_qty'].'</th>'.
					'<th>'.$prd['sup_amt'].'</th>'.
					'<th>'.$prd['disc_amt'].'</th>'.
					'<th>'.$prd['gst_amt'].'</th>'.
					'<th>'.$prd['sup_amt'] * $prd['ddl_pro_qty'].
					'</th>'.
					'</tr>'; 
				}

            }

                       
 	?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
