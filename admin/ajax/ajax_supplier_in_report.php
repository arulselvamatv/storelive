<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no    = $_REQUEST['po_no'];
$supplier = '';
$date = '';
$bill_no = '';
$dep_no = '';

$filtered = false; 

if( $po_no != 1 ) 
{
    $from_date= $_REQUEST['from_date'];
    $to_date  = $_REQUEST['to_date'];
    $sup_name = $_REQUEST['sup_name'];
    
    $bill_no = $_REQUEST['bill_no'];
    
    $dep_no = $_REQUEST['dep_no'];
    
  // echo $dep_no;exit;
    
    
    if( !empty( $from_date ) && !empty( $to_date ) ) 
    {
		$date = " AND wo.date_time between '". $from_date ."' and '". $to_date ."' ";
		$filtered = true; 
	}
	
    if( empty( $to_date ) && isset( $from_date ) && !empty( $from_date))
    {
        $date = " AND DATE( wo.date_time ) = '". $from_date ."'";
		$filtered = true; 
    }
    
	if(empty($from_date ) &&  isset( $to_date ) && !empty( $to_date )) 
	{
		$date = " AND DATE( wo.date_time ) = '". $to_date ."' ";
		$filtered = true; 
	} 
	
    if( isset($sup_name) && !empty($sup_name))
    {
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


$HTML="";
	if($con){
		if($filtered)
		{
		    $asd =('SELECT distinct se.billno ,wo.dep_no
    				FROM work_order as wo
    				INNER join suplier as s on s.sup_id =wo.suplier_id
    				INNER join store_entry as se on se.po_id =wo.wo_id
    				WHERE wo.`active_record` =1  '.$supplier.' '. $date.' '.$bill.'  '.$po.'  group by wo.prod_name');
    				
    			//	echo $asd;exit;
		}
		else
		{
			$asd =('SELECT wo.suplier_id as suplier_id, s.name as supplier_name,se.billno,(wo.prod_name) as item_name,wo.ddl_pro_qty, wo.date_time as `po_date` ,
    				wo.sup_amt,wo.disc_amt,wo.gst_amt,wo.tot,wo.dep_no
    				FROM work_order as wo
    				INNER join suplier as s on s.sup_id =wo.suplier_id
    				INNER join   store_entry as se on se.po_id =wo.wo_id
    				WHERE wo.`active_record` =1 group by wo.prod_name');
			
		}
		
		//~ echo $asd; exit;
		$demo = 0;
		
		
		$e=0;
		$prdt_data = $db->query($asd);

            while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)) 
            {
               ++$e;
               if($filtered)
               {
				   echo 
				   '<div>Bill Number : '.$prd['billno'].' Bill Number : '.$prd['dep_no'].' </div><table class="table table-bordered" id="trn_dlr_pi_inv" target=”_blank” > 
					  <thead>
						<tr>
						<th class="text-center">S.No.</th>
						<th class="text-center">Date</th>
						<th class="text-center">po Number</th > 
						<th class="text-center">Bill Number</th>
						<th class="text-center">Supplier Name</th>
						<th class="text-center">Product Name</th>
						<th class="text-center">Qty</th>
						<th class="text-center">suplier amount </th>
						<th class="text-center">Discount amount </th>
						<th class="text-center">Gst Amount</th>
						<th class="text-center">Total</th>
						</tr>
					  </thead>
					  <tbody id="tbody1">
				   ';
			   }
			   
                if($filtered)
                {
					 $sup_rep = ('SELECT wo.suplier_id as suplier_id, s.name as supplier_name,se.billno,(wo.prod_name) as item_name,wo.ddl_pro_qty, wo.date_time as `po_date` ,
            					  wo.sup_amt,wo.disc_amt,wo.gst_amt,wo.tot,wo.dep_no,wo.tran_charge_gst 
            					  FROM work_order as wo 
            					  INNER join suplier as s on s.sup_id =wo.suplier_id 
            					  INNER join store_entry as se on se.po_id =wo.wo_id 
            					  WHERE wo.`active_record` =1 AND se.billno = "'.$prd['billno'].'" and wo.dep_no = "'.$prd['dep_no'].'"  group by wo.prod_name');
            			//	echo 	 $sup_rep; 
            					  
            					  
					$j=0;
		            $sup_rep_data = $db->query($sup_rep);
                    $j=0;
					$tot=0;
                    
                        while($reports = $sup_rep_data->fetch(PDO::FETCH_ASSOC))
                        {
                        ++$j;

						$sup_amt=$reports['sup_amt'] ;
						$ddl_pro_qty=$reports['ddl_pro_qty'];

						$tran_charge_gst=$reports['tran_charge_gst'] ;

						$tot += $sup_amt*$ddl_pro_qty+$tran_charge_gst;
    					 
    					echo '<tr>'.
    					'<th>'.$j.'</th>'.
    					'<th>'.$reports['po_date'].'</th>'.
    					'<th>'.$reports['dep_no'].'</th>'.
    					'<th>'.$reports['billno']. '</th>'.
    					'<th>'.$reports['supplier_name']. '</th>'.
    					'<th>'.$reports['item_name'].'</th>'.
    					'<th>'.$reports['ddl_pro_qty'].'</th>'.
    					'<th>'.$reports['sup_amt'].'</th>'.
    					'<th>'.$reports['disc_amt'].'</th>'.
    					'<th>'.$reports['gst_amt'].'</th>'.
    					'<th>'.$reports['sup_amt'] * $reports['ddl_pro_qty'].
    					'</th>'.
    					'</tr>';
    				   }

					   echo 
					   '<tr class="text-end h5">'.
					   '<th colspan="10">Transport Total'.
						  '<th colspan="11">'.$tran_charge_gst.'</th>'.
					  '</tr>'.  
					 
					   '<tr class="text-end h5">'.
    				   	    '<th colspan="11">'.$tot.'</th>'.
    				   		'</tr>';
			} 
			else
			{
				echo '<tr>'.
                '<th>'.$e.'</th>'.
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
				
                if($filtered)
                {
					 echo '</tbody></table>';
				}
            }

        if( $e == 0 ) {
            echo '<tr><th colspan="5">No data to display.</th></tr>';
        }
	}

?>

