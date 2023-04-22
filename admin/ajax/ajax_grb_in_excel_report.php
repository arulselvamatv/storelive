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
    $gst      = $_REQUEST['gst'];
    
//    echo $gst;exit;
 
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
	
	if( !empty( $from_date ) && !empty( $to_date ) )
	{	
		$where .= " AND po.bill_date between '". $from_date ."' and '". $to_date ."' ";
		$filtered = true;
		
	}else if(!empty( $from_date))
	
	{
		$where .= " AND po.bill_date > '". $from_date ."'";
		$filtered = true;
	}else if(!empty($to_date))
	{
		$where .= " AND po.bill_date < '". $to_date ."'";
		$filtered = true;
	}
         
}



$HTML="";
	if($con){
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
    					    
    					    
    					    
    					   // SELECT po.`invoice_no`,po.`received_date`,wo.location,s.company_name,po.`billno`, po.`bill_date`,
        				// 	  po.`grand_total`,SUM(po.`grand_total`) as ivn_per_amt,wo.`dep_no`,po.`gst_amt`, po.`adv`
        				// 	  FROM `po_entry`  as po
        				// 	  INNER join `work_order1` as wo on wo.po_no = po.po_id 
        				// 	  INNER join `suplier` as s on s.`sup_id` = wo.suplier_id
        				// 	  WHERE '. $where .'
        				// 	  group by `invoice_no`
					  
					  //echo $asd; exit;
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
                    '<th>'.$prd['grand_total'].' <input type="hidden" class="total" id="total_'.$e.'" value='.$prd['grand_total'].' ></th>'.
                    '<th>'.$prd['dep_no'].'</th>'.
                    '<th style="font-size:12px ;width:100px">
                    
                    G gst% -'.$prd['gst_amt'].' <br>        <input type="hidden" class="gst_per" id="gst_per_'.$e.'" value='.$prd['gst_amt'].'>
                    T gst% -'.$prd['tran_charge_per'].'<br> <input type="hidden" class="tran_amt" id="tran_amt_'.$e.'" value='.$prd['tran_charge_gst'].'><input type="hidden" class="tran_per" id="tran_per_'.$e.'" value='.$prd['tran_charge_per'].'>
                    S gst% -'.$prd['ser_charge_per'].'      <input type="hidden" class="ser_amt" id="ser_amt_'.$e.'" value='.$prd['ser_charge_gst'].' ><input type="hidden" class="ser_per" id="ser_per_'.$e.'" value='.$prd['ser_charge_per'].'>
                    
                    </th>'.
                    
                   '<th style="font-size:12px ;width:150px" >
                   
                    <span>G gst amt -<span class="gst_per_amt" id="gst_per_amt_'.$e.'"></span></span></br>
                    <span>T gst amt -<span class="tran_per_amt" id="tran_per_amt_'.$e.'"></span></span></br>
                    <span>S gst amt -<span class="ser_per_amt" id="ser_per_amt_'.$e.'"></span></span>
                   
                   </th>'.
                    
                    '<th>'.$prd['adv'].'</th>'.
                  
            '</tr>';
     } 
            
        if( $e == 0 ) {
            echo '<tr><th colspan="5">No data to display.</th></tr>';
        }
	}

?>



<script type="text/javascript">
	$(document).ready(function(){
	    $(".gst_per_amt").each(function (index, element){
		    
			var this_attr_id = $.trim($(this).attr("id"));
			var splt_this_id = this_attr_id.split("_");
			var splt_this_id_ar = splt_this_id[3];
			var gst_total = $('#gst_per_'+splt_this_id_ar).val();
			var total = $('#total_'+splt_this_id_ar).val();
			var cal=((parseFloat(total)*parseFloat(gst_total))/100)
			$(this).html(cal.toFixed(2));
		});
		
		$(".tran_per_amt").each(function (index, element){
		    
			var this_attr_id = $.trim($(this).attr("id"));
			var splt_this_id = this_attr_id.split("_");
			var splt_this_id_ar = splt_this_id[3];
			var trs_total = $('#tran_per_'+splt_this_id_ar).val();
			var total = $('#tran_amt_'+splt_this_id_ar).val();
			var cal=((parseFloat(total)*parseFloat(trs_total))/100)
			$(this).html(cal.toFixed(2));
		});
		$(".ser_per_amt").each(function (index, element){
		    
			var this_attr_id = $.trim($(this).attr("id"));
			var splt_this_id = this_attr_id.split("_");
			var splt_this_id_ar = splt_this_id[3];
			var ser_total = $('#ser_per_'+splt_this_id_ar).val();
			var total = $('#ser_amt_'+splt_this_id_ar).val();
			var cal=((parseFloat(total)*parseFloat(ser_total))/100)
			$(this).html(cal.toFixed(2));
		});
	    
		
	});
</script>


