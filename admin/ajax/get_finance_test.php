<?php
require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_id=$_GET['val'];

//echo $po_id;


$HTML="";
	if($con)
	{
	    $HTML=$HTML. '<form action="finance_back_test.php" method="post">';
		$html2="<b><u>Payment is made for:</u></b><br/>
	    <div style=\"border:1px solid black; margin:5px;\">
	    <table><tr><td>";
		$html2=$html2.'';

		$asda =('SELECT wo.dep_no as invoice_no,st.`store_id`,wo.`adv`, st.code, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, 
	
		count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, wo.adv_dublicate ,st.`received_date` as po_date, st.`u_id`,wo.suplier_id as suplier_id,
	
		s.name as supplier_name,s.company_name,s.address,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.suplier_id, st.se_no as se_no ,
		
		wo.po_no as po_no,st.grand_total, sum(st.grand_total) as grand_total   FROM `po_entry` as st 
        
        INNER join work_order1 as wo on wo.po_no =st.po_id
        
        INNER join suplier as s on s.sup_id =wo.suplier_id
        
        WHERE wo.`active_record` =1 and s.`active_record` =1 and wo.dep_no="'.$po_id.'"  group by wo.dep_no');
        
        //echo $asda;
         
        	$dataa = $db->query($asda);
        	while($rows = $dataa->fetch(PDO::FETCH_ASSOC))
        	{
        	    
            			if($rows['adv']==''){
            			    $advance=0;
            			}
            			else{
            			    $advance = $rows['adv'];
            			}
            			
            			 $adv_status= $rows['advance_paid_statues']  ;

						 $adv_amt_balance = $rows['adv_dublicate'];
            			 
            			 
            			 //echo 'flo'.$adv_status;exit;
            			
                        $grand_total= $rows['grand_total']  ;
                        $html2=$html2."";
                        $html2=$html2.'
                        &nbsp;&nbsp;&nbsp;&nbsp';
                        
                        $ex_po_id=$rows['po_id']  ;
                
                        
                        $asdaaa =('SELECT invoice_no,total,grand_total,bill_date,grb_edit_history  FROM po_entry WHERE po_id="'.$ex_po_id.'"  group by invoice_no');
                        $dataaaa = $db->query($asdaaa);
                        	
                    	while($rowsss = $dataaaa->fetch(PDO::FETCH_ASSOC))
                    	{ 
                    	    
							if($rowsss['grb_edit_history'] != 0 and  $rowsss['grand_total'] == 0 )
							 {
						  $html2=$html2.'
						  <span style="background-color:#ff6242;">
							  <input type="hidden" name="po_number" value="'.$po_id.'">
							   <input type="hidden" name="po_number" value="'.$po_id.'">
							  <input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number"  disabled />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp;Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;
						   </span>
						  ";
						  $html2=$html2." ";
							 }
							 
							   else if($rowsss['grb_edit_history'] != 0 and  $rowsss['grand_total'] != 0  and  $rowsss['payment_status'] == 0  )
							 {
						   $html2=$html2.'
							<span style="background-color:#ff6242;">
								<input type="hidden" name="po_number" value="'.$po_id.'">
								<input type="hidden" name="amt" value='.$rowsss["grand_total"].'>
								<input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number" />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;
							 </span>
							 ";
						  $html2=$html2." ";
							 }
							 
							 
							  else if($rowsss['grb_edit_history'] != 0 and  $rowsss['grand_total'] != 0  and  $rowsss['payment_status'] != 0 )
							 {
						   $html2=$html2.'
							<span style="background-color:#ff6242;">
								<input type="hidden" name="po_number" value="'.$po_id.'">
								<input type="hidden" name="amt" value='.$rowsss["grand_total"].'>
								<input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number"  disabled />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;
							 </span>
							 ";
						  $html2=$html2." ";
							 }
							 
							else if($rowsss['grand_total'] == 0)
							 {
						   $html2=$html2.'
								<input type="hidden" name="po_number" value="'.$po_id.'">
								<input type="hidden" name="amt" value='.$rowsss["grand_total"].'>
								<input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number"  disabled />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;";
						  $html2=$html2." ";
							 }
							 
							  else if($rowsss['payment_status'] != 0)
							 {
						   $html2=$html2.'
								<input type="hidden" name="po_number" value="'.$po_id.'">
								<input type="hidden" name="amt" value='.$rowsss["grand_total"].'>
								<input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number"  disabled />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;";
						  $html2=$html2." ";
							 }
							 
							 
							 else
							 {
						   $html2=$html2.'
								  <input type="hidden" name="po_number" value="'.$po_id.'">
								  <input type="hidden" name="amt" value='.$rowsss["grand_total"].'>
								  <input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number"/>&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;";
						  $html2=$html2." ";
							 }
							 
					 // 	     if($rowsss['payment_status']!= 0)
					 // 	    {
					 // 	  $html2=$html2.'
					 // 	 <input type="hidden" name="po_number" value="'.$po_id.'">
					 // 	 <input type="hidden" name="amt" value='.$rowsss["grand_total"].'>
					 //      <input  type="radio"   value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number"  disabled />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;";
					 //      $html2=$html2." ";
					 // 	    }
							 
							 
							 
					 // 	 $html2=$html2.'
					 // 	 <input type="hidden" name="po_number" value="'.$po_id.'">
					 //      <input  type="radio" checked value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number" />&nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp; Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;";
					 //      $html2=$html2." ";
						 }
                    	
                    	
                        // <input  type="radio" checked value="'.$rows['invoice_no'].'" id="chk_'.$rows['invoice_no'].'" name="grb" >Dept No. '.$rows['invoice_no'].'
                        // Dated'.date("d-m-Y",strtotime($rows['date_time']))." (Rs.".$grand_total.")";
                        // $html2=$html2."
                        // ";
		                  
                        $html2=$html2.'</td></tr>
        
                        <tr> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td colspan="3"><input  type="radio" checked value="Payment_value" id="chk_Advance" name="grb_payment_for" >Payment</td>
    
    
                        </tr>
                        </table>
                        
                         </div>';
                        
                    //      <b><u>Advance Amount enter Field:</u></b><br/>
                        
                    //      <table><tr><td>";
                         
                    //      <input type="hidden" name="po_number" value="'.$po_id.'">
                    //      <input type="radio" checked value="'.$rowsss['invoice_no'].'" id="chk_'.$rowsss['invoice_no'].'" name="grb_number" />
                    //      &nbsp;Dept No. '.$rowsss['invoice_no'].' &nbsp;
                    //      Dated &nbsp; '.date("d-m-Y",strtotime($rowsss['bill_date']))." (Rs.".$rowsss['grand_total'].")&nbsp;&nbsp;&nbsp;&nbsp;";
                         
                    //   $html2=$html2.'</td></tr>
                       
                    //     <tr> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td colspan="3"><input  type="radio" checked value="Advance" id="chk_Advance" name="grb_payment_for" >Advance Payment  &nbsp;&nbsp;&nbsp; 
                    //                                                              <input  type="radio" checked value="Payment" id="chk_Advance" name="grb_payment_for" >Payment</td>
                    //     </tr>
                         
                    //      </table>
                        
                        
                        
                       
                      $html2=$html2.'   <br/>';
 
                        $date=date("d-m-Y",strtotime($rows['bill_date']));
                        $company_name=$rows['company_name'];
                        $address=$rows['address'];
                        $HTML=$HTML. '
                        
                        <table class="table" width="100%">
                        <tr>
                        <th>
                        To, <br>
                        The Chairman <br>
                        Kalasalingam University <br>
                        Old. No.14 / New No.52 Sriman Srinivasan Road, <br>
                        Alwarpet, Chennai 600 018. <br>
                        <br>
                        
                        Through, <br>
                        The Finance Officer <br>
                        <br>
                        
                        Respected Sir,<br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sub: General Stores - Acknowledgement for Kalasalingam University - Reg.,<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ref:<b> Invoice No:'.$po_id.' / Dated: '.$date.'</b>
                        <br>
                        <br>
                        
                        With reference to the above, the receipt of materials is acknowledged as per Bill / Invoice of M/s. <b>'.$company_name.', '.$address.'</b>
                        </th>
                        </tr>
                        </table>';
        	}
        	$HTML=$HTML. '
				<div class="panel panel-default">
				<div class="panel-heading"><strong> Advance Paid History:</strong></div>
				<div class="panel-body">
				<table border=1 width="100%">
				';
			$HTML=$HTML.
			'
				<tr> . ';
				      if($adv_status != 0)
				   {
    			$HTML=$HTML. '	<td>
        				<input type="hidden" name="po_number" value="'.$po_id.'">
        				<input type="hidden" name="amount_value" value="'.$advance.'">
        			    <input  type="radio" check value="Advance" id="adv_payment" name="grb_payment_for" disabled >&nbsp;Advance Amount Request in Work Order :<b> Rs.'.$advance.'</b> (Advance paid)
    			    </td> 
					<td>
    			    <input  type="radio" check value="Advance" id="adv_payment" name="grb_payment_for" disabled >&nbsp;Advance Balance Amount : <b>Rs.'.$adv_amt_balance.'</b>
    			    </td>
					';
    			    }
    			    else {
    			       $HTML=$HTML. '<td>
        				<input type="hidden" name="po_number" value="'.$po_id.'">
        				<input type="hidden" name="amount_value" value="'.$advance.'">
        			    <input  type="radio" check value="Advance" id="adv_payment" name="grb_payment_for"  disabled>&nbsp;Advance Amount Request in Work Order :<b>Rs.'.$advance.' </b>
    			    </td> 
					<td>
    			    <input  type="radio" check value="Advance" id="adv_payment" name="grb_payment_for" disabled >&nbsp;Advance Balance Amount : <b>Rs.'.$adv_amt_balance.'</b>
    			    </td>'; 
    			    }
				$HTML=$HTML. '	</tr>
				</table>
			';
				$asdaaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$po_id.'" and payment_type=1 ');
        // 	echo $asdaaa; exit;
        	$dataaaa = $db->query($asdaaa);
        	while($rowsaaa = $dataaaa->fetch(PDO::FETCH_ASSOC))
        	{
			$HTML=$HTML.
			'
	<div class="panel-heading"><strong> Advance Paid History:</strong></div>
	<table border=1 width="100%">
	<tr> <td  width="16%">
	Advance Amount Paid:</td><td align="left" width="16%"> Rs.'.$rowsaaa['payment_amount'].'</td><td width="16%">Payment Mode.</td><td align="left" width="16%">'.$rowsaaa['payment_mode'].'</td><td width="16%">Transaction No.</td><td align="left" width="16%">'.$rowsaaa['transaction_no'].'</td></tr>';
			}
				$HTML=$HTML. "</table>
		</div>
		</div>
		</div>";
			
				$HTML=$HTML. '
				
				<div class="panel panel-default">
				<div class="panel-heading"><strong>Payment History:</strong></div>
				<div class="panel-body">
				<table border=1 width="100%">
				';
				
				$i++;
			
			$asdaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$po_id.'" and payment_type=2 ');
        	//echo $asdaa; exit;
        	$dataaa = $db->query($asdaa);
        	while($rowsaa = $dataaa->fetch(PDO::FETCH_ASSOC))
        	{
			$HTML=$HTML.
			'
			
				<tr> <td width="16%">
				
				Amount Paid:</td><td align="left" width="16%">Rs.'.$rowsaa['payment_amount'].'</td><td width="16%">Payment Mode.</td><td align="left" width="16%">'.$rowsaa['payment_mode'].'</td><td width="16%">Transaction No.</td><td  align="left"  width="16%">'.$rowsaa['transaction_no'].'</td></tr>
			';
// 			$tot=$tot+$rowsaa['payment_amount'];
			}
		$asdaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$po_id.'" ');
        	//echo $asdaa; exit;
        	$dataaa = $db->query($asdaa);
        	while($rowsaa = $dataaa->fetch(PDO::FETCH_ASSOC))
        	{
		
			$tot=$tot+$rowsaa['payment_amount'];
			}
		
		$HTML=$HTML. "</table>
		</div>
		</div>
		".$html2."
		</div>";
		
		$HTML=$HTML.
			'
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-sm-4">Enter the Amount Paid:</label>
							<div class="col-sm-8">
							<input type="hidden" name="overall_total_1" value="'.$grand_total.'" >
							<input type="hidden" name="inv_no" value="'.$po_id.'" >
							<input class="form-control" type="text"  name="payment_amount" style="width:300px;border:1px solid gray"> <font color="red"><br>(Payment Already Made Rs.'.($tot).')</font>
							</div>
					</div>
				</div>
				<div class="col-sm-6">
    				<div class="form-group">
    					<label class="control-label col-sm-3">Payment Mode.</label>
    					<div class="col-sm-9">
    						<input class="form-control" type="text"  name="payment_mode" style="width:300px;border:1px solid gray">
    					</div>
    				</div>
    			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Reference No. / Cheque No.</label>
					<div class="col-sm-9">
						<textarea class="form-control" name="transaction_no" rows=3 style="width:300px;border:1px solid gray"></textarea>
					</div>
				</div>
			</div>
			</div>
		<hr>
		<center><input type="submit" value="Submit Data"></center>
		</form>
		';
	}
	$HTML=$HTML.'
	
<script type="text/javascript">
	function chk_change(chk_id)
	{
		var id_no=chk_id.id.split("_")[1]; 
		
		if(chk_id.checked==true)
		{
			
			document.getElementById("qty_"+id_no).readOnly = true; 
		}
		else
		{
			document.getElementById("qty_"+id_no).readOnly = false; 
		}
	}
	</script>
  <script src="assets/jquery_ui/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".bill" ).datepicker({dateFormat: "dd-mm-yy"});
	
  } );
  </script>
	';
	echo $HTML;

	
	    
?>
