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
 <h2 class="text-center">GRB In Report</h2>


<body>
<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();

$supplier = '';
$date = '';
$filtered = false; 
$po_no = ''; 


if(isset($_REQUEST['po_no'])){
$po_no    = $_REQUEST['po_no'];
}

if(isset($_REQUEST) && $_REQUEST['from_date']!="" || $_REQUEST['to_date']!="" || $_REQUEST['sup_name']!="" || $_REQUEST['bill_no']!="" || $_REQUEST['po_nos']!="" || $_REQUEST['gst']!=""){
    $po_no = 0;
 }  else{
	 $po_no = 1;
  }
//~ echo "<pre/>_REQUEST";print_r($po_no);exit;
if( $po_no != 1 ) {
    $from_date= $_REQUEST['from_date'];
    $to_date  = $_REQUEST['to_date'];
    $sup_name = $_REQUEST['sup_name'];
    $bill_no  = $_REQUEST['bill_no'];
    $po_nos   = $_REQUEST['po_nos'];
    $gst      = $_REQUEST['gst'];
 
 
	$where = " 1= 1";
 
    if( isset( $sup_name ) && !empty( $sup_name ) ) {
        $where .= " AND wo.suplier_id = '".$sup_name."'";
        $filtered = true;
    }
    
    if( isset( $gst ) && !empty( $gst ) ) {
		$where .= " AND po.gst_amt > '".$gst."'";
		$filtered = true;
	}
	
	 if( isset( $po_nos ) && !empty( $po_nos ) ) {
		$where .= " AND wo.dep_no = '".$po_nos."'";
		$filtered = true;
	}
	
	 if( isset( $bill_no ) && !empty( $bill_no ) ) {
		$where .= " AND po.billno = '".$bill_no."'";
		$filtered = true;
	}
	
	if( !empty( $from_date ) && !empty( $to_date ) ) {	
		$where .= " AND po.bill_date between '". $from_date ."' and '". $to_date ."' ";
		$filtered = true;
	}else if(!empty( $from_date)){
		$where .= " AND po.bill_date > '". $from_date ."'";
		$filtered = true;
	}else if(!empty($to_date)){
		$where .= " AND po.bill_date < '". $to_date ."'";
		$filtered = true;
	}
         
}

     if($filtered){
					$asd = ('SELECT po.`invoice_no`,po.`received_date`,wo.location,s.company_name,po.`billno`, po.`bill_date`,
					  po.`grand_total`,SUM(po.`grand_total`) as ivn_per_amt,wo.`dep_no`,po.`gst_amt`, po.`adv`,

					  po.`tran_charge`,po.`tran_charge_per`,po.`tran_charge_gst`, 
                      po.`ser_charge`,po.`ser_charge_per`,po.`ser_charge_gst`

					  FROM `po_entry`  as po
					  INNER join `work_order1` as wo on wo.po_no = po.po_id 
					  INNER join `suplier` as s on s.`sup_id` = wo.suplier_id
					  WHERE '. $where .'
					  group by `invoice_no`');
			 } else{
					 $asd = ('SELECT po.`invoice_no`,po.`received_date`,wo.location,s.company_name,po.`billno`, po.`bill_date`,
					  po.`grand_total`,SUM(po.`grand_total`) as ivn_per_amt,wo.`dep_no`,po.`gst_amt`, po.`adv`,

					  po.`tran_charge`,po.`tran_charge_per`,po.`tran_charge_gst`, 
                      po.`ser_charge`,po.`ser_charge_per`,po.`ser_charge_gst`


					  FROM `po_entry`  as po
					  INNER join `work_order1` as wo on wo.po_no = po.po_id 
					  INNER join `suplier` as s on s.`sup_id` = wo.suplier_id
					  group by `invoice_no`');
			}

   $e=0;
		$prdt_data = $db->query($asd);
		    echo 
				   '<table class="table table-bordered" id="trn_dlr_pi_inv" target=”_blank” > 
					  <thead>
						<tr>
						<th class="text-center">S.No.</th>
						<th class="text-center">Inward No / Date</th>
						<th class="text-center">Name of the Department</th>
						<th class="text-center">Name of the Supplier</th>
						<th class="text-center">Bill No & Date</th>
						<th class="text-center">Amount in Price</th>
						<th class="text-center">PO No</th>
						<th class="text-center">Gst %</th>
						<th class="text-center">Gst Amount</th>
						<th class="text-center">Advance Amount</th>
						</tr>
					  </thead>
					  <tbody id="tbody1">
				   ';
          
            while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)) {
               ++$e;
				echo '<tr>'.
                '<th>'.$e.'</th>'.
                '<th>'.$prd['invoice_no'].' / '.date("d-m-y",strtotime($prd['received_date'])).'</th>'.
                '<th>'.$prd['location'].'</th>'.
                '<th>'.$prd['company_name']. '</th>'.
                '<th>'.$prd['billno'].' / '.date("d-m-y",strtotime($prd['bill_date'])).'</th>'.
                '<th>'.$prd['ivn_per_amt'].' <input type="hidden" class="total" value='.$prd['ivn_per_amt'].' ></th>'.
                '<th>'.$prd['dep_no'].'</th>'.
				'<th style="font-size:12px ;width:100px">
                    
				G gst% -'.$prd['gst_amt'].' <br>        <input type="hidden" id="gst_per" value='.$prd['gst_amt'].'>
				T gst% -'.$prd['tran_charge_per'].'<br> <input type="hidden" id="tran_grand_total_amt" value='.$prd['tran_charge_gst'].'><input type="hidden" id="tran_gst_pert" value='.$prd['tran_charge_per'].'>
				S gst% -'.$prd['ser_charge_per'].'      <input type="hidden" id="ser_grand_total_amt" value='.$prd['ser_charge_gst'].' ><input type="hidden" id="ser_gst_per" value='.$prd['ser_charge_per'].'>
				
			</th>'.
			
			'<th style="font-size:12px ;width:150px" >
			   
				<span>G gst amt -<span class="grand_tot"></span></span></br>
				<span>T gst amt -<span class="disc"></span></span></br>
				<span>S gst amt -<span class="services_amt"></span></span>
			   
			 </th>'.
                '<th>'.$prd['adv'].'</th>'.
                '</th>'.
                '</tr>';
     } 

                       
 	?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
