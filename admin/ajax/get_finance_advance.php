<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_id=$_GET['val'];

//echo $po_id;


$HTML="";
	if($con)
	{
	    $HTML=$HTML. '<form action="finance_back_advance.php" method="post">';
	    
// 		$html2="<b><u>Payment is made for:</u></b><br/>
		
	   $html2="<div style=\"border:1px solid black; margin:5px;\">
	    
	    <table width='100%'><tr><td>";
	    
	 
		$html2=$html2.'';

		$asda =('SELECT wo.dep_no as invoice_no,wo.`adv`, wo.`po_status`,

		s.name as supplier_name,s.company_name,s.address,
        
        wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id,wo.`advance_paid_statues`,
		
		wo.po_no as po_no FROM `work_order1` as wo 
        
        INNER join suplier as s on s.sup_id =wo.suplier_id
        
        WHERE wo.`active_record` =1 and s.`active_record` =1 and wo.dep_no="'.$po_id.'"   group by wo.dep_no ');
        
       //  echo $asda;
         
        	$dataa = $db->query($asda);
        	while($rows = $dataa->fetch(PDO::FETCH_ASSOC))
        	{
        	    if($rows['advance_paid_statues'] != '0')
        	    {
        	          $HTML=$HTML. '<h6> Advances Amount paid</h6> ';
        	    }
        	    
        	    else if($rows['po_status'] !='0')
        	    {
        	        $HTML=$HTML.'<h6> Grb Created so you Canot Abel to pay Advance </h6>';
        	    }
        	    
        	    else 
        	    {
        	    $html2=$html2.'   <br/>';
                        
                        $date=date("d-m-Y",strtotime($rows['bill_date']));
                        $company_name=$rows['company_name'];
                        $address=$rows['address'];
                        
                         $adv=$rows['adv'];
                        
                        
                        $HTML=$HTML. '
                        
                        <table class="table" width="100%" >
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
        	}
        	
        	$HTML=$HTML. '
				<div class="panel panel-default">
				<div class="panel-body">
				<table border=1 width="100%">
				';
			$HTML=$HTML.
			'
				<tr> . ';
				//       if($adv_status != 0)
				//   {
    // 			$HTML=$HTML. '	<td  width="30%">
    //     				<input type="hidden" name="po_number" value="'.$po_id.'">
    //     				<input type="hidden" name="amount_value" value="'.$advance.'">
    //     			    <input  type="radio" check value="Advance" id="adv_payment" name="grb_payment_for" disabled >&nbsp;Payment Advance Amount Request in Work Order :</td><td align="left"> Rs.'.$adv.'
    // 			    </td> ';
    // 			    }
    // 			    else {
    			       $HTML=$HTML. '<td  width="30%">
        				<input type="hidden" name="po_number" value="'.$po_id.'">
        				<input type="hidden" name="amount_value" value="'.$adv.'">
        			    <input  type="radio" checked value="Advance" id="adv_payment" name="grb_payment_for" >&nbsp;Payment Advance Amount Request in Work Order :</td><td align="left"> Rs.'.$adv.'
    			    </td> '; 
    			 //   }
				$HTML=$HTML. '	</tr>
				</table>
			';
			
// 			$asdaaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$po_id.'" and payment_type=1 ');
            //echo $asdaaa; exit;
        
        // 	$dataaaa = $db->query($asdaaa);
//         	while($rowsaaa = $dataaaa->fetch(PDO::FETCH_ASSOC))
//         	{
// 			$HTML=$HTML.
// 			'
// 			<div class="panel-heading"><strong>Advance Paid History:</strong></div>
// 			<table border=1 width="100%">
// 	        <tr> <td  width="16%">
// 	        Advance Amount Paid:</td><td align="left" width="16%"> Rs.'.$rowsaaa['payment_amount'].'</td><td width="16%">Payment Mode.</td><td align="left" width="16%">'.$rowsaaa['payment_mode'].'</td><td width="16%">Transaction No.</td><td align="left" width="16%">'.$rowsaaa['transaction_no'].'</td></tr>';
// 			}
				$HTML=$HTML. "</table>
		</div>
		</div>
		</div>";
			
				$HTML=$HTML. '
				
				<div class="panel panel-default">
				 <div class="panel-heading"><strong>Payment History:</strong></div>
				<div class="panel-body">';
				
				$i++;
			
// 			$asdaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$po_id.'" and payment_type=2 ');
        	//echo $asdaa; exit;
        // 	$dataaa = $db->query($asdaa);
//         	while($rowsaa = $dataaa->fetch(PDO::FETCH_ASSOC))
//         	{
// 			$HTML=$HTML.
// 			'
// 			<table width="100%">
// 				<tr> <td width="16%">
				
// 				Amount Paid:</td><td align="left" width="16%">Rs.'.$rowsaa['payment_amount'].'</td><td width="30%">Payment Mode.</td><td align="left" width="16%">'.$rowsaa['payment_mode'].'</td><td width="16%">Transaction No.</td><td  align="left"  width="16%">'.$rowsaa['transaction_no'].'</td></tr>
// 			';
// // 			$tot=$tot+$rowsaa['payment_amount'];
// 			}
// 		$asdaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$po_id.'" ');
//         	//echo $asdaa; exit;
//         	$dataaa = $db->query($asdaa);
//         	while($rowsaa = $dataaa->fetch(PDO::FETCH_ASSOC))
//         	{
		
// 			$tot=$tot+$rowsaa['payment_amount'];
// 			}
		
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
						<label class="control-label col-sm-4">Enter the Advance Amount:</label>
							<div class="col-sm-8">
							  <input class="form-control" type="text"  name="payment_amount" style="width:300px;border:1px solid gray"> <font color="red"><br>(Payment Already Made Rs.'.($tot+$advance).')</font>
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
