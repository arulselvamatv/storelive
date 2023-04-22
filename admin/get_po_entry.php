<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_id=$_GET['val'];
//echo $po_id; exit;
$HTML="";
	if($con)
	{
		
		
		$asda =('SELECT s.name as contact_person,s.company_name as supplier_name, s.mobile, s.address,`wo_id`, `dep_no`, `po_no`, `wo_no`, `quo_no`, `prod_name` as item_name, `ddl_pro_unit` as unit, `ddl_pro_qty` as quantity, `product_spec` as item_desc, `suplier_id`, `sup_amt1`, `disc_amt1`, `gst_amt1`, `tot1`, work_order1.`active_record`, work_order1.`date_time` as po_date, po_status  FROM `work_order1` 
				inner join suplier as s on s.sup_id = work_order1.suplier_id
				WHERE work_order1.po_no="'.$po_id.'" and work_order1.`active_record`=1');
		$data = $db->query($asda);
		$prdaa = $data->fetch(PDO::FETCH_ASSOC);
		$po_date = $prdaa['po_date'];	
		$po_no = $prdaa['po_no'];
		$dep_no = $prdaa['dep_no'];
		$contact_person = $prdaa['contact_person'];	
		$mobile = $prdaa['mobile'];	
		$supplier_name = $prdaa['supplier_name'];	
		$HTML=$HTML. '
				<form id="store_in" action="po_in_back.php" method="post" autocomplete="off">
				
				
				<table class="table">
					<tr>
					<td colspan=2><input type="hidden" class="form-control" id="po_no" name="po_no"  value="'.$po_no.'" readonly="readonly">ORDER No. '.$dep_no.'</td><td colspan=2>Order Date: '.date('d-m-Y H:s', strtotime($po_date)).'</td></tr>
					<tr><td colspan=2><u>Supplier</u><br>'.$contact_person." / ".$mobile."<br>".$supplier_name.'</td></tr>
				</table>';
				$HTML=$HTML. "
				<div class=\"table-responsive\">
				<table class=\"table table-stripped table-bordered table-hover\" >
				<tr>
				<th>Goods</th>
				<th>Description</th>";
				
				$HTML=$HTML. "
				<th>Bill NO</th>
				<th>Bill Date</th>
				
				<th>Quantity</th>";
					$HTML=$HTML. "
					<th>Availabe</th>
					<th>Received</th>
					";
				$HTML=$HTML. "<th>Suplier amount</th>
				<th>Discout %</th>
				<th>GST %</th>
				<th>Total Amount</th>
				<th>Available and Verified</th>
				</tr>";

		$asd =('SELECT s.name as contact_person,s.company_name as supplier_name, s.mobile, s.address,`wo_id`, `po_no`, `wo_no`, `quo_no`, `prod_name` as item_name, `ddl_pro_unit` as unit, `ddl_pro_qty` as quantity, `product_spec` as item_desc, `suplier_id`, `sup_amt1`, `disc_amt1`, `gst_amt1`, `tot1`, work_order1.`active_record`, work_order1.`date_time` as po_date, po_status  FROM `work_order1` 
				inner join suplier as s on s.sup_id = work_order1.suplier_id
				WHERE work_order1.po_no="'.$po_id.'" and work_order1.`active_record`=1');
			
		$datd = $db->query($asd);
		$nodata=0;
		while($row = $datd->fetch(PDO::FETCH_ASSOC))
		{
			
			$HTML=$HTML. '<tr>
			<td><input type="hidden" name="po_id_'.$row['wo_id'].'" value="'.$row['wo_id'].'">';
			if((($row['quantity'])-($row['po_status']))>0)
			{
					$HTML=$HTML.'<input type="hidden" name="po_row_id[]" value="'.$row['wo_id'].'">';
					$nodata=1;
			}
			
			
				
			$HTML=$HTML.'<input type="hidden" name="act_qty_'.$row['wo_id'].'" value="'.$row['quantity'].'">'.$row['item_name'].'</td>';
			
			$HTML=$HTML.'<td>'.$row['item_desc'].'</td>';
			
			
			
			$HTML=$HTML.'
		            	<td class="col-md-2"><input type="text" class="form-control" id="bill_no_'.$row['wo_id'].'" name="bill_no_'.$row['wo_id'].'" readonly="readonly"></td>
			            <td class="col-md-1"><input type="text" class="form-control bill" id="bill_date_'.$row['wo_id'].'" name="bill_date_'.$row['wo_id'].'" readonly="readonly"></td>
						<td class="col-md-1"><input type="text" class="form-control"  id="org_qty_'.$row['wo_id'].'" name="org_qty_'.$row['wo_id'].'" value="'.$row['quantity'].'" readonly="readonly"></td>
						<td class="col-md-1"><input type="text" class="form-control" readonly="readonly" id="rec_qty_'.$row['wo_id'].'" name="rec_qty_'.$row['wo_id'].'" value="'.$row['po_status'].'"></td>';
						if((($row['quantity'])-($row['po_status']))>0)
						{
							$HTML=$HTML.'<td><select class="js-example-basic-multiple qty"  id="qty_'.$row['wo_id'].'" name="qty_'.$row['wo_id'].'">';
							$act_qty = $row['quantity'];
							$rec_qty = $row['po_status'];
							$no_rows=$act_qty - $rec_qty + 1;
							//echo $no_rows; exit;
							
							for($i=0;$i<$no_rows;$i++)
							{
								$HTML=$HTML.'<option value='.$i.'>'.$i.'</option>';
							}
							
							$HTML=$HTML.'</select>';
							$HTML=$HTML.' ('.$row['unit'].') ';
							$HTML=$HTML.'<input type="text" class="form-control"  id="nos_'.$row['wo_id'].'" name="nos_'.$row['wo_id'].'" value="" readonly="readonly">
							<select class="js-example-basic-multiple"  name="nosunit_'.$row['wo_id'].'" id="nosunit_'.$row['wo_id'].'">
							<option value ="">Select Unit</option>';
							$asda =('SELECT `u_id`, `u_name`, `date_time`, `active_record` FROM `unit` WHERE `active_record`=1');
							//echo $asd; exit;
							$datda = $db->query($asda);
							while($rowa = $datda->fetch(PDO::FETCH_ASSOC))
							{
								$HTML=$HTML.'<option value ="'.$rowa['u_name'].'">'.$rowa['u_name'].'</option>';
							}
							$HTML=$HTML.'</select>
							<input type="hidden" class="form-control" readonly="readonly" id="unit_'.$row['wo_id'].'" name="unit_'.$row['wo_id'].'" value="'.($row['unit']).'"></td>';
						}
						elseif((($row['quantity'])-($row['po_status']))==0){
							$HTML=$HTML.'<td class="col-md-2">All Quantity Received</td>';
						}
						
						
						$HTML=$HTML.'
						
						<td class="col-md-1"><input type="text" class="form-control" id="bill_amt_'.$row['wo_id'].'" name="bill_amt_'.$row['wo_id'].'" value="'.$row['sup_amt1'].'" readonly="readonly" ></td>
						<td class="col-md-1"><input class="form-control" name="disc_amt_'.$row['wo_id'].'" id="disc_amt_'.$row['wo_id'].'" value="'.$row['disc_amt1'].'" readonly="readonly"/></td>
						<td class="col-md-1"><input class="form-control gst_amt" name="gst_amt_'.$row['wo_id'].'" id="gst_amt_'.$row['wo_id'].'" value="'.$row['gst_amt1'].'" readonly="readonly"/>
						<input type="hidden" name="tot_'.$row['wo_id'].'" id="tot_'.$row['wo_id'].'" class="form-control" value="'.$row['tot1'].'" readonly="readonly"/></td>
						<td class="col-md-1"><input type="text" class="form-control bill_tott" id="bill_tott_'.$row['wo_id'].'" name="bill_tott_'.$row['wo_id'].'" value="0" readonly="readonly"></td>
						<td class="col-md-1"><input  type="checkbox" checked value="1" id="chk_'.$row['wo_id'].'" name="chk_'.$row['wo_id'].'" onclick="chk_change(this)"> Verified</td>
						</td>
						</tr>';
		            }
		$HTML=$HTML. "</table></div>
		
		<table class='table'>";
			$HTML=$HTML. "<tr>";
				
				$HTML=$HTML. "	
			<td style='text-align:right;'>Final Total</td><td style='width:20%'><input type='text' class='form-control' name='overall_total' id='overall_total' value='0' readonly='readonly'><input type='hidden' class='form-control' name='add_amt' id='add_amt' value='0'><input type='hidden' class='form-control' name='add_amt_per' id='add_amt_per' value='0'></td>
		
			
			 <th>
      <div class='inner'><input id='calculate' class='btn btn-primary' type='button' value='Calculate' style='display:block' /></div>&nbsp;
        </th>
				</tr>
			
			 <tr>
        <th>
        Advance Amount:<input class='form-control' type='number' id='adv' name='adv' value='0' required/>
        </th>
        
        <th>
           balances Amount:<input class='form-control' type='number' id='balances_amt' name='balances_amt' value='0' readonly='readonly'/>
        </th>
    
    
    	 <th>
        <input class='form-control' type='hidden' id='adv' name='adv' value='0' required/>
        </th>
        
        
        </tr>
        
         <tr>
        <th>
        Transport Charge:<input class='form-control' type='number' id='tran_charge' name='tran_charge' value=0 required/>
        </th>
    
        <th>
        Transport GST Percent:<input class='form-control' type='number' id='tran_charge_per' name='tran_charge_per' value=0 required/>
        </th>
     
      
        <th>
        Transport GST Charge:<input class='form-control' type='number' id='tran_charge_gst' name='tran_charge_gst' value=0 readonly='readonly'/>
        </th>
        </tr>
        
        
         <tr>
        <th>
        Service Charge:<input class='form-control' type='number' id='ser_charge' name='ser_charge' value=0 required/>
        </th>
        <th>
        Service GST Percent:<input class='form-control' type='number' id='ser_charge_per' name='ser_charge_per' value=0 required/>
        </th>
        <th>
        Service GST Charge:<input class='form-control' type='number' id='ser_charge_gst' name='ser_charge_gst' value=0 readonly='readonly'/>
        </th>
        </tr>
        
        <tr>
        
         <th>
        Grand Total Amount:<input class='form-control' type='number' id='grand_tot' name='grand_tot' value='0' readonly='readonly'/>
        </th>
        
        	 <th>
        <input class='form-control' type='hidden' id='adv' name='adv' value='0' required/>
        </th>
        
        	 <th>
        <input class='form-control' type='hidden' id='adv' name='adv' value='0' required/>
        </th>
        
        </tr>
        
        
        ";
			
		$HTML=$HTML. "</table></table>
		</br>
		
		<div id='outer'>
		<center>
		<div class='inner'><input id='edit' class='btn btn-primary' type='button' value='Edit' style='display:none' /></div>&nbsp;<div class='inner'><input id='sucess' class='btn btn-success' type='submit' value='Submit Data' style='display:none' /></div>&nbsp;<div class='inner'><input class='btn btn-danger' type='button' value='Cancel' onClick='window.location.reload();' /></div>
		</center>
		</div>
		</form>
		";
	}
	$HTML=$HTML.'
	<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>
  	<script src="assets/jquery_ui/jquery-ui.js"></script>
  	<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="../assets/global/plugins/select2/js/select2.min.js"></script>
	<link rel="stylesheet" href="../assets/jquery-ui.css">
	<style>
	#outer {
		width :100%;
		text -align: center;
	}
	.inner{
		display: inline-block;
	}
	</style>
	<script> 
	$( ".bill" ).datepicker({
		changeMonth: true,
		changeYear: true,
	});
	$( document ).ready(function() {
		$(".js-example-basic-multiple").select2();
		
		
	});
	
	</script>
	<script type="text/javascript">

	function chk_change(chk_id)
	{
		var id_no=chk_id.id.split("_")[1]; 
		
		if(chk_id.checked==true)
		{
			document.getElementById("bill_no_"+id_no).readOnly = true;
			document.getElementById("bill_date_"+id_no).readOnly = true;
			document.getElementById("bill_amt_"+id_no).readOnly = true;
			document.getElementById("disc_amt_"+id_no).readOnly = true;
			document.getElementById("gst_amt_"+id_no).readOnly = true;
			
			document.getElementById("nos_"+id_no).readOnly = true;
			
                var gst = $("#gst_amt_"+id_no).val();
                var price = $("#bill_amt_"+id_no).val();
                var tot_price = Number(price * gst / 100) + Number(price);
                var disc = $("#disc_amt_"+id_no).val();
                //alert(disc);
                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                //alert(dec);
                var mult = tot_price * dec; // gives the value for subtract from main value
                var discont = tot_price - mult;
                $("#tot_"+id_no).val(discont);
			var quantity =document.getElementById("qty_"+id_no).value;
			var amount =document.getElementById("tot_"+id_no).value;
			document.getElementById("bill_tott_"+id_no).value=quantity*amount;
			
			
			

		}
		else
		{
		document.getElementById("bill_no_"+id_no).readOnly = false;
		document.getElementById("bill_date_"+id_no).readOnly = false;
			
			document.getElementById("nos_"+id_no).readOnly = false;
			document.getElementById("bill_amt_"+id_no).readOnly = false;
			document.getElementById("disc_amt_"+id_no).readOnly = false;
			document.getElementById("gst_amt_"+id_no).readOnly = false;
		}
	}

	
	$(document).on("click", "#calculate", function( e ) {

		var total = 0;
				$(".bill_tott").each(function (index, element) {
					
					total = Number(total) + Number($(element).val());
				});
				
		$("#overall_total").val(total);
			$("#grand_tot").val(total);
		

		
		$("#service").attr("readonly", true);
		$("#transport").attr("readonly", true);
		$("#packing").attr("readonly", true);
		$("#gst").attr("readonly", true);
		$("#discount").attr("readonly", true);
		$("#advance").attr("readonly", true);
		$(this).css("display", "none");
		$("#edit").css("display", "block");
		$("#sucess").css("display", "block");
		
	});
	
	$(document).on("click", "#edit", function(e) {
		$("#service").attr("readonly", false);
		$("#transport").attr("readonly", false);
		$("#packing").attr("readonly", false);
		$("#gst").attr("readonly", false);
		$("#discount").attr("readonly", false);
		$("#advance").attr("readonly", false);
		$(this).css("display", "none");
		$("#calculate").css("display", "block");
		$("#sucess").css("display", "none");
	});
	
	
	
	
	  //ON keyup tran_charge
    $(document).on("keyup", "#tran_charge", function( e ) {
         //alert("asdas"); exit;
                var price = $("#tran_charge").val();
                
                var gst = $("#tran_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $("#tran_charge_gst").val(net_price);
                });
	
	
	
	 //ON keyup tran_charge_per
    $(document).on("keyup", "#tran_charge_per", function( e ) {
         //alert("asdas"); exit;
                var price = $("#tran_charge").val();
                
                var gst = $("#tran_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $("#tran_charge_gst").val(net_price);
                });
                
                
                  //ON keyup ser_charge
    $(document).on("keyup", "#ser_charge", function( e ) {
        // alert("asdas"); exit;
                var price = $("#ser_charge").val();
                
                var gst = $("#ser_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $("#ser_charge_gst").val(net_price);
                });
                
                
                //ON keyup serv_charge_per
              $(document).on("keyup", "#ser_charge_per", function( e ) {
        // alert("asdas"); exit;
                var price = $("#ser_charge").val();
                
                var gst = $("#ser_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                
                $("#ser_charge_gst").val(net_price);
                
                });
                
                
                
        //ON keyup Advances
        
              $(document).on("keyup", "#adv", function( e ) {
                var adv = $("#adv").val();
                var total = $("#overall_total").val();
                // alert("asdas"); exit;
                var balances = (total - adv).toFixed(2);
                $("#balances_amt").val(balances);
                 $("#grand_tot").val(balances);
                });
                
                
	
// 	//ON keyup balances_tot
//               $(document).on("keyup", "#overall_total", function( e ) {
//          alert("asdas"); exit;
//                 var adv = $("#adv").val();
//                 var total = $("#overall_total").val();
//                 var balances_amt = (total - adv);
//                 // var gst_amount = ( price * gst% ) / 100;
//                 var net_price = Number(price) + Number(tax);
//                 $("#balances_tot").val(balances_amt);
//                 });
	
	
	
	
    </script>

	
	
	
	
	
	
	
	
	
  
	
	';
	
	if($nodata==0)
	{
		echo "Stock IN Entry Already Made!";
	}
	else
	{
		echo $HTML;
	}
	

	
	    
?>
