<?php
require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_id=$_GET['val'];
//echo $po_id; exit;
$HTML="";
	if($con)
	{
$asda =('SELECT s.name as contact_person,s.company_name as supplier_name, s.mobile, s.address,`wo_id`, `dep_no`, `po_no`,`adv`,`wo_no`, `quo_no`, `prod_name` as item_name, `ddl_pro_unit` as unit, 
       `ddl_pro_qty` as quantity, `product_spec` as item_desc, `suplier_id`, `sup_amt1`, `disc_amt1`, `gst_amt1`, `tot1`, `adv_dublicate`, work_order1.`active_record`, work_order1.`date_time` as po_date, po_status  FROM `work_order1` 
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
		$adv = $prdaa['adv'];
		$adv_dublicate = $prdaa['adv_dublicate'];


		$asdaa =('select SUM(a.adv_dup_dyn) as bal_adv_dublicate FROM
		(select po_no,`suplier_id`,adv_dup_dyn FROM `work_order1` where `ddl_pro_qty`=`po_status` and suplier_id='.$suplier_id.'  group by po_no,suplier_id order by `wo_id`)as a');
		
$dataa = $db->query($asdaa);
$prdaaa = $dataa->fetch(PDO::FETCH_ASSOC);
$bal_adv_dublicate = $prdaaa['bal_adv_dublicate']; 

		$HTML=$HTML. '
				<form id="store_in" action="po_in_back.php" method="post" autocomplete="off">
				
				<table class="table">
					<tr>
					<td colspan=2><input type="hidden" class="form-control" id="po_no" name="po_no"  value="'.$po_no.'" readonly="readonly">ORDER No. '.$dep_no.'</td><td colspan=2>Order Date: '.date('d-m-Y H:s', strtotime($po_date)).'</td></tr>
					<tr><td colspan=2><u>Supplier</u><br>'.$contact_person." / ".$mobile."<br>".$supplier_name.'</td>
					<td colspan=2><u>Advance Request In Work Order</u><br>'.$adv.'</td></tr>
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

		$asd =('SELECT s.name as contact_person,s.company_name as supplier_name, s.mobile, s.address,`wo_id`, `po_no`, `wo_no`,`adv`,`quo_no`, `prod_name` as item_name, `ddl_pro_unit` as unit, `ddl_pro_qty` as quantity, `product_spec` as item_desc, `suplier_id`, `sup_amt1`, `disc_amt1`, `gst_amt1`, `tot1`, work_order1.`active_record`, work_order1.`date_time` as po_date, po_status  FROM `work_order1` 
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
		            	<td class="col-md-2"><input type="text" class="form-control" id="bill_no_'.$row['wo_id'].'" name="bill_no_'.$row['wo_id'].'"    readonly="readonly"></td>
		            	
			            <td class="col-md-1"><input type="date" class="form-control bill" id="bill_date_'.$row['wo_id'].'" name="bill_date_'.$row['wo_id'].'"    readonly="readonly"></td>
			            
						<td class="col-md-1"><input type="text" class="form-control"  id="org_qty_'.$row['wo_id'].'" name="org_qty_'.$row['wo_id'].'" value="'.$row['quantity'].'" readonly="readonly"></td>
						
						<td class="col-md-1"><input type="text" class="form-control" readonly="readonly" id="rec_qty_'.$row['wo_id'].'" name="rec_qty_'.$row['wo_id'].'" value="'.$row['po_status'].'"></td>';
						
						
						if((($row['quantity'])-($row['po_status']))>0)
						   {
    							$HTML=$HTML.'<td>
    							
    							<select class="js-example-basic-multiple qty"  id="qty_'.$row['wo_id'].'" name="qty_'.$row['wo_id'].'">';
    							
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
						elseif((($row['quantity'])-($row['po_status']))==0)
    						{
    							$HTML=$HTML.'<td class="col-md-2">All Quantity Received</td>';
    						}
					
						
						$HTML=$HTML.'
						
						<td class="col-md-1"><input type="text" class="form-control" id="bill_amt_'.$row['wo_id'].'" name="bill_amt_'.$row['wo_id'].'" value="'.$row['sup_amt1'].'" readonly="readonly" ></td>



							<td>
						
			<label>Discount:</label>
               <div style="display:inline-flex">
               <div style="display:inline-block "><input class="form-control disc_amt discount_change " style="width:50px" name="disc_amt_entry'.$row['wo_id'].'" id="disc_amt_entry'.$row['wo_id'].'" 
               
                data-key="'.$row['wo_id'].'" value="'.$row['disc_amt1'].'" / ></div>
               
                <div style="display:inline-block">
                    <select class="form-control select discount_change"  style="width:50px" id="discamt'.$row['wo_id'].'" name="discamt'.$row['wo_id'].'" data-key="'.$row['wo_id'].'" >
                     
                        <option selected value="percentage">%</option>
                        <option value="rupees">Rs</option>
                        
                    </select>
                </div>
                
            </div>
        </br>
			Discount :<input class="form-control disc_amt w-100" name="disc_amt_'.$row['wo_id'].'" id="disc_amt_'.$row['wo_id'].'" value="'.$row['disc_amt1'].'"  readonly="readonly" /></br>

			</td>

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
				
// 		$asd1 =('SELECT s.name as contact_person,s.company_name as supplier_name, s.mobile, s.address,`wo_id`, `po_no`, `wo_no`,`adv`,`quo_no`, `prod_name` as item_name, `ddl_pro_unit` as unit, `ddl_pro_qty` as quantity, `product_spec` as item_desc, `suplier_id`, `sup_amt1`, `disc_amt1`, `gst_amt1`, `tot1`, work_order1.`active_record`, work_order1.`date_time` as po_date, po_status  FROM `work_order1` 
// 		inner join suplier as s on s.sup_id = work_order1.suplier_id
// 		WHERE work_order1.po_no="'.$po_id.'" and work_order1.`active_record`=1');
		
// 		echo $asd1;
			
// 		$datd1 = $db->query($asd1);
// 		$nodata1=0;
// 		while($row1 = $datd1->fetch(PDO::FETCH_ASSOC))
// 		{
			
			
// 		echo '	<td class="col-md-1"><input type="text" class="form-control" id="bill_amt_'.$row1['adv'].'" name="bill_amt_'.$row1['adv'].'" value="'.$row1['adv'].'" readonly="readonly" ></td>';
			
// // ** field for wo advance** 	echo "<td> Advance Amount:<input type='text' class='form-control' id='bill_amt_'.$row['wo_id'].' ' name='bill_amt_'.$row['wo_id'].'' value=.$row['sup_amt1'].' readonly='readonly' > </td>";
// 		}
        
        
        	
//         $asd1 =('SELECT s.name as contact_person,s.company_name as supplier_name, s.mobile, s.address,`wo_id`, `po_no`, `wo_no`,`adv`,`quo_no`, `prod_name` as item_name, `ddl_pro_unit` as unit, `ddl_pro_qty` as quantity, `product_spec` as item_desc, `suplier_id`, `sup_amt1`, `disc_amt1`, `gst_amt1`, `tot1`, work_order1.`active_record`, work_order1.`date_time` as po_date, po_status  FROM `work_order1` 
//  		inner join suplier as s on s.sup_id = work_order1.suplier_id
//  		WHERE work_order1.po_no="'.$po_id.'" and work_order1.`active_record`=1');
 		
//  		$datd1 = $db->query($asd1);
// 		$nodata1=0;
//  		$row1 = $datd1->fetch(PDO::FETCH_ASSOC);
 		
//  			$adv = $row1['adv'];
 		
 		
//  		 echo '<table class="table">
		
//       	<tr><td colspan=2><u> Advance Paind in word Order </u><br>'.$adv.'</td></tr>
// 				</table>';
	
	    //echo '<input type="text" class="form-control" id="bill_amt_'.$row1['adv'].'" name="bill_amt_'.$row1['adv'].'" value="'.$row1['adv'].'" readonly="readonly" >';
	
 		//echo $asd1;
        	
        	$HTML=$HTML. ";
        	
			<td style='text-align:right;'>Final Total</td><td style='width:20%'>
    			<input type='text' class='form-control' name='overall_total' id='overall_total' value='0' readonly='readonly'>
    			<input type='hidden' class='form-control' name='add_amt' id='add_amt' value='0'><input type='hidden' class='form-control' name='add_amt_per' id='add_amt_per' value='0'>
			    <div class='inner'><input id='edit' class='btn btn-primary' type='button' value='Edit' style='display:none' /></div>
			</td>
			
		<th>
           <div class='inner'><input id='calculate' class='btn btn-primary' type='button' value='Calculate' style='display:block' /></div>&nbsp;
        </th>
	</tr>
			
    <tr>
        <th>
        Transport Charge:<input class='form-control sub_total' type='number' id='tran_charge' name='tran_charge' value=0 required/>
        </th>
    
        <th>
        Transport GST Percent:<input class='form-control sub_total' type='number' id='tran_charge_per' name='tran_charge_per' value=0 required/>
        </th>
     
        <th>
        Transport Total Amount :<input class='form-control' type='number' id='tran_charge_gst' name='tran_charge_gst' value=0 readonly='readonly'/>
        </th>

    </tr>
        
        
     <tr>
        <th>
        Service Charge:<input class='form-control sub_total' type='number' id='ser_charge' name='ser_charge' value=0 required/>
        </th>
        <th>
        Service GST Percent:<input class='form-control sub_total' type='number' id='ser_charge_per' name='ser_charge_per' value=0 required/>
        </th>
        <th>
        Service Total Amount :<input class='form-control' type='number' id='ser_charge_gst' name='ser_charge_gst' value=0 readonly='readonly'/>
        </th>
    </tr>
        
     <tr>


	<tr>
		<th>
		  pro amt + otr amt :<input class='form-control' type='number' id='pro_otr_amt' name='pro_otr_amt' value=0   readonly='readonly'/>
		</th>
		<th>
		</th>
		<th>
		</th>
	</tr>


	<tr>
        <th>
        Advance Amount Paid in Finance:<input class='form-control' type='number' id='adv' name='adv' value=".$adv_dublicate."  readonly='readonly'>
		<input class='form-control' type='hidden' id='adv_rde_bal' name='adv_rde_bal' value='0' readonly='readonly'>
		
       
		<br>

		<th>
		<div class='inner'><input id='calculate_total' name='calculate_total' class='btn btn-primary' type='button' value='Calculate' style='display:block' /></div>&nbsp;
		<div class='inner'><input id='edit_total' class='btn btn-primary' type='button' value='Edit' style='display:none' /></div>
	    </th>
                      
        </th>
        
        <th>
           Balance Advance on Suplier:<input class='form-control' type='number' id='adv_balance1' name='adv_balance1' value='$bal_adv_dublicate' readonly='readonly'>
        </th>
    
    
	<th>
		<div class='inner'><input id='reduce_sup_amt' class='btn btn-primary' type='button' value='reduce supplier amt'  />
			<div style='display:none' class='container-fluid' id='yes_no' name='yes_no'>
				<label class='radio-inline'><input type='radio' name='yes' id='yes' value='yes'>Yes</label>
				<label class='radio-inline'><input type='radio' name='no' id='no' value='no'>No</label>
			</div>
		</div>
	</th>
        
        
    </tr>

		<th>
		 Sub Total Amount:<input class='form-control' type='number' id='sub_tot' name='sub_tot' value='0' readonly='readonly'/>
	    </th>
        
        <th>
         Grand Total Amount:<input class='form-control' type='number' id='grand_tot1' name='grand_tot1' value='0' readonly='readonly'/>
        </th>
        
        <th>
          <input class='form-control' type='hidden' id='' name=''  required/>
        </th>
        
    </tr>";
			
		$HTML=$HTML. "</table></table>
		</br>
		
		<div id='outer'>
		<center>
		&nbsp;<div class='inner'><input id='sucess' class='btn btn-success' type='submit' value='Submit Data' style='display:none' />
		</div>&nbsp;<div class='inner'><input class='btn btn-danger' type='button' value='Cancel' onClick='window.location.reload();' /></div>
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
			
		// document.getElementById("nos_"+id_no).readOnly = true;
			
                var gst = $("#gst_amt_"+id_no).val();
                
                var price = $("#bill_amt_"+id_no).val();
                
                var tot_price = Number(price * gst / 100) + Number(price);
                
                var disc = $("#disc_amt_"+id_no).val();
                
                //alert(disc);
                
                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                
                //alert(dec);
                
                var mult = tot_price * dec; // gives the value for subtract from main value
                
                var discont = tot_price - mult;
                
                $("#tot_"+id_no).val(discont.toFixed(2));
                
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
	$(document).on("click", "#calculate", function( e )
	 {
		var total = 0;
		
				$(".bill_tott").each(function (index, element)
				{
					
					total = Number(total) + Number($(element).val());

				});
				
				
		    $("#overall_total").val(total.toFixed(2));

			$("#pro_otr_amt").val(total.toFixed(2));
		    
			$("#grand_tot").val(total.toFixed(2));
			
			$("#balances_amt").val(total.toFixed(2));
		

		
		$("#service").attr("readonly", true);
		$("#transport").attr("readonly", true);
		$("#packing").attr("readonly", true);
		$("#gst").attr("readonly", true);
		$("#discount").attr("readonly", true);
		$("#advance").attr("readonly", true);
		$(this).css("display", "none");
		$("#edit").css("display", "block");
	//	$("#sucess").css("display", "block");
		
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
	
	
	
		$(document).on("click", "#calculate_total", function(e) {
// 		$("#adv").attr("readonly", true);
 		$("#tran_charge").attr("readonly", true);
    	$("#tran_charge_per").attr("readonly", true);
 		$("#ser_charge").attr("readonly", true);
 		$("#ser_charge_per").attr("readonly", true);
 		
 		$(this).css("display", "none");
		$("#edit_total").css("display", "block");
		
		$("#sucess").css("display", "block");
		
		
// 		$("#advance").attr("readonly", false);
// 		$(this).css("display", "none");
// 		$("#calculate").css("display", "block");
// 		$("#sucess").css("display", "none");
	});
	
	
	
		$(document).on("click", "#edit_total", function(e) {
// 		$("#adv").attr("readonly", false);
 		$("#tran_charge").attr("readonly", false);
    	$("#tran_charge_per").attr("readonly", false);
 		$("#ser_charge").attr("readonly", false);
 		$("#ser_charge_per").attr("readonly", false);
 		
 		$(this).css("display", "none");
		$("#calculate_total").css("display", "block");
		
// 		$("#advance").attr("readonly", false);
// 		$(this).css("display", "none");
// 		$("#calculate").css("display", "block");
// 		$("#sucess").css("display", "none");
	});
	

	
	
	
	
	//ON keyup tran_charge
        $(document).on("keyup", "#tran_charge", function( e ) {

                var price = $("#tran_charge").val();
                var gst = $("#tran_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $("#tran_charge_gst").val(net_price);
                });
	
	
	
	 //ON keyup tran_charge_per
    $(document).on("keyup", "#tran_charge_per", function( e ) {
                var price = $("#tran_charge").val();
                
                var gst = $("#tran_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $("#tran_charge_gst").val(net_price);
                });
                
                
    //ON keyup ser_charge
    
    $(document).on("keyup", "#ser_charge", function( e ) {
                var price = $("#ser_charge").val();
                var gst = $("#ser_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                $("#ser_charge_gst").val(net_price);
                });
                
                
    //ON keyup serv_charge_per
              $(document).on("keyup", "#ser_charge_per", function( e ) {
                var price = $("#ser_charge").val();
                var gst = $("#ser_charge_per").val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
 
                $("#ser_charge_gst").val(net_price);
                
                });
                

                
    // for grand total
        $(document).on("click", "#calculate_total", function( e )
		{
                // var price = $("#tran_charge_gst").val();
                // var gst = $("#ser_charge_gst").val();
                // var balances = $("#balances_amt").val();

				var pro_otr_amt = $("#pro_otr_amt").val();
                var adv = $("#adv").val();

				var grand_balances = adv - pro_otr_amt ;

				alert(grand_balances);

				$("#sub_tot").val(Math.abs(grand_balances));
			    $("#grand_tot1").val(Math.abs(grand_balances));

				var adv_balance = adv - pro_otr_amt;
			    $("#adv_rde_bal").val(adv_balance); 


				// if(adv>grand_balances)
				// {
				// 	$("#sub_tot").val("0");
				// }
				// else
				// {
				// 	$("#sub_tot").val(Math.abs(grand_balances));
				// }


                // alert(adv);
                //var grand_balancess = parseFloat(parseFloat(price) + parseFloat(gst) +  parseFloat(balances));

                // var grand_balances = adv - pro_otr_amt ;

                // $("#grand_tot").val(grand_balances);
                // var adv_balance = adv - grand_balancess;
                // $("#adv_balance").val(adv_balance);
               
        });


		$(document).on("click", "#calculate_total", function(e)
		 {
			var pro_otr_amt = $("#pro_otr_amt").val();
			var adv = $("#adv").val();

			var grand_balances = adv - pro_otr_amt ;
			$("#grand_tot1").val(Math.abs(grand_balances));

			var adv_balance = adv - pro_otr_amt;
			$("#adv_rde_bal").val(adv_balance);
			
			if(adv>grand_balances)
			{
				$("#sub_tot").val("0");
			}
			else
			{
				$("#sub_tot").val(Math.abs(grand_balances));
			}
		});
                
	
	//ON keyup balances_tot

              $(document).on("keyup", "#overall_total", function( e )
			   {        
					var adv = $("#adv").val();
					var total = $("#overall_total").val();
					var balances_amt = (total - adv);
					// var gst_amount = ( price * gst% ) / 100;
					var net_price = Number(price) + Number(tax);
					$("#balances_tot").val(balances_amt);
                });
	


				// ON keyup disc_amt
    
				$(document).on("keyup",".disc_amt", function( e ) 
					{
						var this_attr_id = $.trim($(this).attr("id"));
						var splt_this_id = this_attr_id.split("_");
						var splt_this_id_ar = splt_this_id[2];
						// var discamt = $("#discamt_"+splt_this_id_ar).val();
						var disc = $("#disc_amt_"+splt_this_id_ar).val();
						var price = $("#sup_amt_"+splt_this_id_ar).val();
						var prices = $("#sup_amt_"+splt_this_id_ar).val()*$("#iqty_"+splt_this_id_ar).val();
						var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
								
						//alert(dec);
						
						var mult = price * dec;
						var mults = prices * dec; // gives the value for subtract from main value
						var discount = price - mult;
						var discounts = prices - mults;
								
						var gst = $("#gst_amt_"+splt_this_id_ar).val();
						var tot_price = Number(discount * gst / 100) + Number(discount);
						var tot_prices = Number(discounts * gst / 100) + Number(discounts);
						
						// alert(disc); exit;
								
						$("#tot_"+splt_this_id_ar).val(tot_price);
						$("#tot_val_"+splt_this_id_ar).val(tot_prices);
						
					});
					
					$(document).on("change keyup", ".discount_change", function( e )
					 {
						var discount_percent = 0;
						var keyindex = $(this).data("key");
						var disc_amt_entry = $("#disc_amt_entry"+keyindex).val();
						var discamt = $("#discamt"+keyindex).val();
						if(discamt == "rupees")
						{
							discount_percent = disc_amt_entry;
						}else
						{
							var sup_amt = $("#bill_amt_"+keyindex).val();
							var discount_percent=((parseFloat(sup_amt) * parseFloat(disc_amt_entry))/100)
						}
						$("#disc_amt_"+keyindex).val(discount_percent);
						
					});	
					
					
          //keyup for product and other total

		  $(document).on("keyup", ".sub_total", function(e ) 
		  {
		 var overall_total = $("#overall_total").val();
		 var tran_charge_gst = $("#tran_charge_gst").val();
		 var ser_charge_gst = $("#ser_charge_gst").val();

		 // alert(overall_total);
		 // alert(tran_charge_gst);
		 // alert(ser_charge_gst);

		 // (overall_total + tran_charge_gst + ser_charge_gst )

		 var pro_otr =  Number(overall_total) + Number(tran_charge_gst) + Number(ser_charge_gst) ;
		 $("#pro_otr_amt").val(pro_otr);

	  //   alert (pro_otr);
		 
		 
		 // var gst_amount = ( price * gst% ) / 100;
		 var net_price = Number(price) + Number(tax);
		 $("#balances_tot").val(balances_amt);
		 });


				
               // reduces over all adv pending amount of the supplier 


				$(document).on("click","#reduce_sup_amt",function ()
				{
					$("#yes_no").css("display","block");
				});
				
				$(document).on("click","#yes",function()
				{
				var adv_balance1 = $("#adv_balance1").val();
				var sub_total = $("#sub_tot").val();
				var grand_total = adv_balance1 - sub_total ;
				 
			//alert (adv_balance1);
			//alert (sub_total);
			//alert (grand_total);
				
				$("#grand_tot1").val(Math.abs(grand_total));
				});


    </script>';
	
	if($nodata==0)
	{
		echo "Stock IN Entry Already Made!";
	}
	else
	{
		echo $HTML;
	}
	

	
	    
?>
