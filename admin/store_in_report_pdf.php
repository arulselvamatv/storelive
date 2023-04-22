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
 <h2 class="text-center">Store In Report</h2>


<body>


<?php



require_once("database/connect.php");
$db = new Database;
$db->connect();

   if(isset($_REQUEST['po_no'])){
      $po_no    = $_REQUEST['po_no'];
    }
    
    
    if(isset($_REQUEST) && $_REQUEST['from_date']!="" || $_REQUEST['to_date']!="" || $_REQUEST['sup_name']!=""  || $_REQUEST['bill_no']!="" || $_REQUEST['po_nos']!="" ) {
		$po_no = 0;
	 }  else{
		 $po_no = 1;
	 }
  
$supplier = '';
$date = '';
$filtered = false;


//~ echo "<pre/>";print_r($_REQUEST);exit;
if( $po_no != 1 ) {
    $from_date= $_REQUEST['from_date'];
    $to_date  = $_REQUEST['to_date'];
    $sup_name = $_REQUEST['sup_name'];
    $bill_no  = $_REQUEST['bill_no'];
    $po_nos   = $_REQUEST['po_nos'];
    
    //echo $bill_no;exit;
 
 
     $where = " 1= 1";
      
      if( isset( $sup_name ) && !empty( $sup_name ) ) {
			$where .= " AND wo.suplier_id = '".$sup_name."'";
			$filtered = true;
	 }
	 
	 if( isset( $po_nos ) && !empty( $po_nos ) ) {
		$where .= " AND wo.dep_no = '".$po_nos."'";
		$filtered = true;
	}
	
	 if( isset( $bill_no ) && !empty( $bill_no ) ) {
		$where .= " AND se.billno = '".$bill_no."'";
		$filtered = true;
	}
	 
	// echo $bill_no;exit;
		
		if( !empty( $from_date ) && !empty( $to_date ) ) {	
				$where .= " AND se.bill_date between '". $from_date ."' and '". $to_date ."' ";
				$filtered = true;
			}else if(!empty( $from_date)){
				$where .= " se.bill_date > '". $from_date ."'";
				$filtered = true;
			}else if(!empty($to_date)){
				$where .= " se.bill_date < '". $to_date ."'";
				$filtered = true;
		}
}

$HTML="";
		  if($filtered){
					$asd = ('SELECT  se.`invoice_no` ,wo.location , s.company_name, se.`billno`,se.`bill_date`, se.`bill_amt`,SUM(se.`per_amt`) as ivn_per_amt ,wo.dep_no, wo.po_no, wo.prod_name, wo.product_spec, se.`received_date`
					 FROM `store_entry` as se 
					 INNER join `work_order` as wo on wo.wo_id = se.po_id 
					 INNER join `suplier` as s on  s.`sup_id` = wo.suplier_id
					 WHERE '. $where .'
					 group by se.`invoice_no` ');
			 } else{
					 $asd = ('SELECT  se.`invoice_no` ,wo.location , s.company_name, se.`billno`,se.`bill_date`, se.`bill_amt`,SUM(se.`per_amt`) as ivn_per_amt ,wo.dep_no, wo.po_no, wo.prod_name, wo.product_spec, se.`received_date`
					 FROM `store_entry` as se 
					 INNER join `work_order` as wo on wo.wo_id = se.po_id 
					 INNER join `suplier` as s on  s.`sup_id` = wo.suplier_id
					 group by se.`invoice_no` ');
			}
		
		//~ echo $asd; exit;
		$e=0;
		$prdt_data = $db->query($asd);
		          
		          echo '<table class="table table-bordered" id="store_in_report">
						<thead>
							<tr>
								<th class="text-center">S.No.</th>
								<th class="text-center">Inward No / Date</th>
								<th class="text-center">Name of the Department</th>
								<th class="text-center">Name of the Supplier</th>
								<th class="text-center">Bill No & Date</th>
								<th class="text-center">Amount in Price</th>
								<th class="text-center">PO No</th>
								<th class="text-center">Received from Store Signature with Date</th>
								<th class="text-center">Given to Store Signature with Date</th>
							</tr>
						</thead>
						<tbody id="tbody1">';
		 
          
            while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)) {
               ++$e;
				echo '<tr>'.
                '<th>'.$e.'</th>'.
                '<th>'.$prd['invoice_no'].' / '.date("d-m-y",strtotime($prd['received_date'])).'</th>'.
                '<th>'.$prd['location'].'</th>'.
                '<th>'.$prd['company_name']. '</th>'.
                '<th>'.$prd['billno'].' / '.date("d-m-y",strtotime($prd['bill_date'])).'</th>'.
                '<th>'.$prd['ivn_per_amt'].'</th>'.
                '<th>'.$prd['po_no'].'</th>'.
                '<th> </th>'.
                '<th> </th>'.
                '</th>'.
                '</tr>';
     } 
            
        if( $e == 0 ) {
            echo '<tr><th colspan="5">No data to display.</th></tr>';
        }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
