<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no    = $_REQUEST['po_no'];
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
	if($con){
		  if($filtered){
					$asd = ('SELECT  se.`invoice_no` ,wo.location , s.company_name, se.`billno`,se.`bill_date`, se.`bill_amt`,SUM(se.`per_amt`) as ivn_per_amt ,wo.dep_no, wo.po_no, wo.prod_name, 
					         wo.product_spec, se.`received_date`
        					 FROM `store_entry` as se 
        					 INNER join `work_order` as wo on wo.wo_id = se.po_id 
        					 INNER join `suplier` as s on  s.`sup_id` = wo.suplier_id
        					 WHERE '. $where .'
					         group by se.`invoice_no` ');
			 } else{
					 $asd = ('SELECT  se.`invoice_no` ,wo.location , s.company_name, se.`billno`,se.`bill_date`, se.`bill_amt`,SUM(se.`per_amt`) as ivn_per_amt ,wo.dep_no, wo.po_no, wo.prod_name, 
        					 wo.product_spec, se.`received_date`
        					 FROM `store_entry` as se 
        					 INNER join `work_order` as wo on wo.wo_id = se.po_id 
        					 INNER join `suplier` as s on  s.`sup_id` = wo.suplier_id
        					 group by se.`invoice_no` ');
			}
		
		//~ echo $asd; exit;
		$e=0;
		$prdt_data = $db->query($asd);
          
            while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)) {
               ++$e;
				echo '<tr>'.
                '<th>'.$e.'</th>'.
                '<th>'.$prd['invoice_no'].' / '.date("d-m-y",strtotime($prd['received_date'])).'</th>'.
                '<th>'.$prd['location'].'</th>'.
                '<th>'.$prd['company_name']. '</th>'.
                '<th>'.$prd['billno'].' / '.date("d-m-y",strtotime($prd['bill_date'])).'</th>'.
                '<th>'.$prd['ivn_per_amt'].'</th>'.
                '<th>'.$prd['dep_no'].'</th>'.
                '<th> </th>'.
                '<th> </th>'.
                '</th>'.
                '</tr>';
     } 
            
        if( $e == 0 ) {
            echo '<tr><th colspan="5">No data to display.</th></tr>';
        }
	}

?>

