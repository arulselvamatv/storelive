<?php 

require_once("../database/connect.php");
$db=new Database;
$conn=$db->Connect();


$po_no    = $_REQUEST['po_no'];
$supplier = '';
$date = '';
$filtered = false;

if( $po_no != 1 ) {
    $from_date= $_REQUEST['from_date'];
    $to_date  = $_REQUEST['to_date'];
    $sup_name = $_REQUEST['sup_name'];
    $bill_no  = $_REQUEST['bill_no'];
    $po_nos   = $_REQUEST['po_nos'];


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


// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Store-in-report_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('S.No', 'Inward No / Date', 'Name of the Department', 'Name of the Supplier', 'Bill No & Date', 'Amount in Price', 'Po No', 'Received from Store Signature with Date', 'Given to Store Signature with Date'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
          if($filtered) {
                   $query = ('SELECT  se.`invoice_no` ,wo.location , s.company_name, se.`billno`,se.`bill_date`, se.`bill_amt`,SUM(se.`per_amt`) as ivn_per_amt ,wo.dep_no, wo.po_no, wo.prod_name, wo.product_spec, se.`received_date`
						 FROM `store_entry` as se 
						 INNER join `work_order` as wo on wo.wo_id = se.po_id 
						 INNER join `suplier` as s on  s.`sup_id` = wo.suplier_id
						 WHERE '. $where .'
						 group by se.`invoice_no` ');
					 } else {
						 $query = ('SELECT  se.`invoice_no` ,wo.location , s.company_name, se.`billno`,se.`bill_date`, se.`bill_amt`,SUM(se.`per_amt`) as ivn_per_amt ,wo.dep_no, wo.po_no, wo.prod_name, wo.product_spec, se.`received_date`
						 FROM `store_entry` as se 
						 INNER join `work_order` as wo on wo.wo_id = se.po_id 
						 INNER join `suplier` as s on  s.`sup_id` = wo.suplier_id
						 group by se.`invoice_no` ');
					}
  $sup_rep_data = $db->query($query);
		 $j=0;
   while($reports = $sup_rep_data->fetch(PDO::FETCH_ASSOC)) {
	++$j;   
	    $lineData = array($j, $reports['invoice_no'] .' / '.date("d-m-y",strtotime($reports['received_date'])), $reports['location'], $reports['company_name'], $reports['billno'] .' / '. date("d-m-y",strtotime($reports['bill_date'])), $reports['ivn_per_amt'], $reports['dep_no'], '', ''); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
      }

 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;


		
?> 
