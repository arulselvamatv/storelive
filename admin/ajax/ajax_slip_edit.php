<?php
error_reporting(0);
require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$code=$_GET['code'];
$HTML="";
	if($con)
	{
		echo '<form action="slip_back.php" method="post">
        <table class="table table-bordered"><thead>
		<tr>
		  <th class="text-center">No</th>
          <th class="text-center">Invoice NO</th>
          <th class="text-center">Quotation NO</th>
          <th class="text-center">Purchase Order NO</th>
		  <th class="text-center">Product Name</th>
		  <th class="text-center">Quantity</th>
		  <th class="text-center">Specification needed</th>';
		  echo "<th class='text-center'>Supplier</th>
          <th class='text-center'>Overall Total</th>";
		echo '</thead>
	  <tbody id="tbody">';

	  
      
		
		$asd =('SELECT wo.tran_charge,wo.tran_charge_per,wo.tran_charge_gst,wo.ser_charge,wo.ser_charge_per,wo.ser_charge_gst,st.`store_id`,st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, st.installation, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt,st.disc_amt as disc_amt, st.gst_amt as gst_amt, st.unit as unit,st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
        INNER join grb as g on g.grb_no =st.grb_id
        INNER join work_order as wo on wo.wo_id =st.po_id
        INNER join suplier as s on s.sup_id =wo.suplier_id
        WHERE wo.`active_record` =1 and s.`active_record` =1  and st.code ="'.$code.'" group by  st.grb_id');
		//echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
			$i = ++$i;
			echo '<tr>'.
			'<th>'.$i.'.</th>'.
            '<th>'.$prd['invoice_no'].
			'<input type="hidden" class="form-control" name="invoice_no[]" id="invoice_no'.$i.'" value="'.$prd['invoice_no'].'" readonly="readonly" />'.
			'</th>'.
            '<th>'.$prd['quo_no'].
			'<input type="hidden" class="form-control" name="quo_no[]" id="quo_no'.$i.'" value="'.$prd['quo_no'].'" readonly="readonly" />'.
			'</th>'.
            '<th>'.$prd['po_no'].
			'<input type="hidden" class="form-control" name="po_no[]" id="po_no'.$i.'" value="'.$prd['po_no'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['item_name'].
			'<input type="hidden" class="form-control" name="prod_name[]" id='.$i.' value="'.$prd['item_name'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<input type="hidden" class="form-control" name="ddl_pro_unt[]" id="iunt_'.$i.'" value="Per '.$prd['unit'].'" readonly="readonly" />
            <input type="hidden" class="form-control" name="ddl_pro_unit[]" id="iunit_'.$i.'" value='.$prd['unit'].' readonly="readonly" />';
            echo $prd['received_qty'];
            echo "&nbsp;".$prd['unit'];
            echo '<input type="hidden" class="form-control" name="ddl_pro_qty[]" id="iqty_'.$i.'" value='.$prd['received_qty'].' readonly="readonly" /></th>'.
			'<th>'.$prd['item_desc'].'<input type="hidden" class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value="'.$prd['item_desc'].'" readonly="readonly" />'.
			'</th>';
            echo '<th>';
			
            echo '<input type="hidden" name="sup_id[]" id="sup_id_'.$i.'" value="'.$prd['suplier_id'].'" readonly="readonly" />
            Supplier Amount: '.$prd['bill_amt'].' ₹</br><input type="hidden" class="form-control sup_amt" name="sup_amt[]" id="sup_amt'.$i.'" value="'.$prd['bill_amt'].'" readonly="readonly" />
			Discount %: '.$prd['disc_amt'].' %</br><input type="hidden" class="form-control disc_amt" name="disc_amt[]" id="disc_amt_'.$i.'" value="'.$prd['disc_amt'].'" readonly="readonly" />
			GST %: '.$prd['gst_amt'].' %</br><input type="hidden" class="form-control gst_amt" name="gst_amt[]" id="gst_amt_'.$i.'" value="'.$prd['gst_amt'].'" readonly="readonly" />
			
			Total Per Qty: '.$prd['per_amt'].' ₹<input type="hidden"  name="per_tot[]" id="per_tot_'.$i.'" class="form-control" value="'.$prd['per_amt'].'" readonly="readonly"/>';
               $tot =$prd['per_amt'] * $prd['received_qty'];
            echo '</th>
            <th>'.$tot.' ₹<input type="hidden"  name="tot[]" id="tot_'.$i.'" class="form-control tot" value="'.$tot.'" readonly="readonly"/> <input type="hidden"  name="installation[]" id="installation_'.$i.'" class="form-control" value="'.$prd['installation'].'" readonly="readonly"/></th>';
			echo '</tr>';
		}

        $asdaa =('SELECT  sl.`invoice_no`, sum(sl.`ddl_pro_qty`) as qty, sl.`ins_id`, sl.`installation`,sl.ser_charge,sl.ser_charge_per,sl.ser_charge_gst, sl.`tran_charge`,sl.tran_charge_per,sl.tran_charge_gst, sl.`packing`, sl.`advance`, sum(ins.ins_qty) as ins_qty, sum(ins.ins_amt) as ins_amt FROM `slip_list` as sl
      inner join installtion as ins on ins.ins_id =  sl.ins_id
      WHERE sl.`active_record`=1 and sl.`installation`="Yes" and sl.code='.$code.'   group by sl.`invoice_no`');
      $datda = $db->query($asdaa);
      $prd = $datda->fetch(PDO::FETCH_ASSOC);
      $ins_qty = $prd['ins_qty'];
      $qty = $prd['qty'];
      $tran_charge = $prd['tran_charge'];
      $packing = $prd['packing'];
      $advance = $prd['advance'];
      $service = $prd['ins_amt'];
      $remaing_qty=$ins_qty-$qty;
 

        echo "</tbody></table><table class='table'>";
        if(!isset($tran_charge)){
            // echo "rkraj1";exit();
            $asdaa =('SELECT wo.adv,wo.tran_charge,wo.tran_charge_per,wo.tran_charge_gst,wo.ser_charge,wo.ser_charge_per,wo.ser_charge_gst,st.`store_id`,st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, st.installation, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt,st.disc_amt as disc_amt, st.gst_amt as gst_amt, st.unit as unit,st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
        INNER join grb as g on g.grb_no =st.grb_id
        INNER join work_order as wo on wo.wo_id =st.po_id
        INNER join suplier as s on s.sup_id =wo.suplier_id
        WHERE wo.`active_record` =1 and s.`active_record` =1  and st.code ="'.$code.'" group by  st.invoice_no');
		//echo $asd; exit;
		$i=0;
		$prdt_dataaa = $db->query($asdaa);
		while($prdaa = $prdt_dataaa->fetch(PDO::FETCH_ASSOC))
		{
		    
		    $slist_qry = 'SELECT *  FROM `slip_list` WHERE `code` = "'.$code.'" AND `slip_list`.`active_record`=1 GROUP BY `slip_list`.invoice_no';
                $slist_r = $db->query($slist_qry);
                $slist_data =  $slist_r->fetch();
                if($slist_r->rowCount() > 0){
                    $prdaa['tran_charge'] = $slist_data['tran_charge'];
                    $prdaa['tran_charge_per'] = $slist_data['tran_charge_per'];
                    $prdaa['tran_charge_gst'] = $slist_data['tran_charge_gst'];
                    $prdaa['ser_charge'] = $slist_data['ser_charge'];
                    $prdaa['ser_charge_per'] = $slist_data['ser_charge_per'];
                    $prdaa['ser_charge_gst'] = $slist_data['ser_charge_gst'];
                }
		    
		    
        echo "<tr>
        <td style='text-align:right;'>Total</td><td style='width:20%'><input type='text' class='form-control' name='bill_tot' id='bill_tot' value='0' readonly='readonly'></td>
        <td style='text-align:right;'>Packing and Forwarding Charges</td><td style='width:20%'><input typr='text' class='form-control' id='packing' name='packing' value='0'></td>
        <td style='text-align:right;'>Advance Payment</td><td style='width:20%'><input type='text' class='form-control' name='advance' id='advance' value=".$prdaa['adv']."></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Transportation Charges</td><td style='width:20%'><input type='text' class='form-control' name='tran_charge' id='tran_charge' value=".$prdaa['tran_charge']."></td>
        <td style='text-align:right;'>Transportation GST Percent</td><td style='width:20%'><input type='text' class='form-control' name='tran_charge_per' id='tran_charge_per' value=".$prdaa['tran_charge_per']."></td>
        <td style='text-align:right;'>Transportation GST Charge</td><td style='width:20%'><input type='text' class='form-control' name='tran_charge_gst' id='tran_charge_gst' value=".$prdaa['tran_charge_gst']." readonly='readonly'></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Installation/Service Charges</td><td style='width:20%'><input type='text' class='form-control' name='ser_charge' id='ser_charge' value=".$prdaa['ser_charge']."></td>
        <td style='text-align:right;'>Installation/Service GST Percent</td><td style='width:20%'><input type='text' class='form-control' name='ser_charge_per' id='ser_charge_per' value=".$prdaa['ser_charge_per']."></td>
        <td style='text-align:right;'>Installation/Service GST Charge</td><td style='width:20%'><input type='text' class='form-control' name='ser_charge_gst' id='ser_charge_gst' value=".$prdaa['ser_charge_gst']." readonly='readonly'></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Final Total</td><td style='width:20%'><input type='text' class='form-control' name='overall_total' id='overall_total' value='0' readonly='readonly'></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Installation Product Name</td><td style='width:20%'><input type='hidden' class='form-control' name='code' id='code' value=".$code.">
        <select name='ins_prod_name' id='ins_prod_name' class='js-example-basic-multiple' style='width:100%;' > 
        <option value=''>Select Product Name</option>";
        
                                    
                                    $asda =('SELECT st.`store_id`, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, st.installation, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt,st.disc_amt as disc_amt, st.gst_amt as gst_amt, st.unit as unit,st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
                                    INNER join grb as g on g.grb_no =st.grb_id
                                    INNER join work_order as wo on wo.wo_id =st.po_id
                                    INNER join suplier as s on s.sup_id =wo.suplier_id
                                    WHERE wo.`active_record` =1 and s.`active_record` =1 and st.`installation` ="Yes" and st.code ="'.$code.'"   group by  wo.prod_name');
                                    //echo $asd; exit;
                                    $datda = $db->query($asda);
                                    while($data=$datda->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo "<option value='".$data['item_name']."'>".''.$data['item_name']."</option>";
                                        }
        echo "</select></td>
        <td style='text-align:right;'>Quantity</td><td style='width:20%' id='ins_qty_td'>";
        
        echo "</td>
        <td style='text-align:right;'>Installation Amount</td><td style='width:20%'><input type='text' class='form-control' name='ins_amt' id='ins_amt' value='0'></td>
        </tr>";
		}
        }
        else{
            // echo "rkraj2";exit();
            echo "<tr>
        <td style='text-align:right;'>Total</td><td style='width:20%'><input type='text' class='form-control' name='bill_tot' id='bill_tot' value='0' readonly='readonly'></td>
        <td style='text-align:right;'>Packing and Forwarding Charges</td><td style='width:20%'><input typr='text' class='form-control' id='packing' name='packing' value=".$packing." readonly='readonly'></td>
        <td style='text-align:right;'>Advance Payment</td><td style='width:20%'><input type='text' class='form-control' name='advance' id='advance' value=".$advance." readonly='readonly'></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Transportation Charges</td><td style='width:20%'><input type='text' class='form-control' name='tran_charge' id='tran_charge' value=".$transport." readonly='readonly'></td>
        <td style='text-align:right;'>Transportation GST Percent</td><td style='width:20%'><input type='text' class='form-control' name='tran_charge_per' id='tran_charge_per' value=".$tran_charge_per." readonly='readonly'></td>
        <td style='text-align:right;'>Transportation GST Charge</td><td style='width:20%'><input type='text' class='form-control' name='tran_charge_gst' id='tran_charge_gst' value=".$tran_charge_gst." readonly='readonly'></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Installation/Service Charges</td><td style='width:20%'><input type='text' class='form-control' name='ser_charge' id='ser_charge' value=".$service."  readonly='readonly'></td>
        <td style='text-align:right;'>Installation/Service GST Percent</td><td style='width:20%'><input type='text' class='form-control' name='ser_charge_per' id='ser_charge_per' value=".$ser_charge_per."  readonly='readonly'></td>
        <td style='text-align:right;'>Installation/Service GST Charge</td><td style='width:20%'><input type='text' class='form-control' name='ser_charge_gst' id='ser_charge_gst' value=".$ser_charge_gst." readonly='readonly'></td>
        </tr>
        <tr>
        <td style='text-align:right;'>Final Total</td><td style='width:20%'><input type='text' class='form-control' name='overall_total' id='overall_total' value='0' readonly='readonly'></td>
        </tr>";
            if($remaing_qty==0 && isset($service))
                {
                    echo "<tr><div><center>Product Instalation Done</center></div></tr>";
                }
            else{
                echo "<tr>
            <td style='text-align:right;'>Installation Product Name</td><td style='width:20%'><input type='hidden' class='form-control' name='code' id='code' value=".$code.">
            <select name='ins_prod_name' id='ins_prod_name' class='js-example-basic-multiple' style='width:100%;' > 
            <option value=''>Select Product Name</option>";
            
                                        
                                        $asda =('SELECT st.`store_id`, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, st.installation, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt,st.disc_amt as disc_amt, st.gst_amt as gst_amt, st.unit as unit,st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
                                        INNER join grb as g on g.grb_no =st.grb_id
                                        INNER join work_order as wo on wo.wo_id =st.po_id
                                        INNER join suplier as s on s.sup_id =wo.suplier_id
                                        WHERE wo.`active_record` =1 and s.`active_record` =1 and st.`installation` ="Yes" and st.code ="'.$code.'"   group by  wo.prod_name');
                                        //echo $asd; exit;
                                        $datda = $db->query($asda);
                                        while($data=$datda->fetch(PDO::FETCH_ASSOC))
                                            {
                                                echo "<option value='".$data['item_name']."'>".''.$data['item_name']."</option>";
                                            }
            echo "</select></td>
            <td style='text-align:right;'>Quantity</td><td style='width:20%' id='ins_qty_td'>";
            
            echo "</td>
            <td style='text-align:right;'>Installation Amount</td><td style='width:20%'><input type='text' class='form-control' name='ins_amt' id='ins_amt' value='0'></td>
            </tr>";
                }
            }
		echo "</table>
                  
        <div id='outer'>
		<center>
		<div class='inner'><input id='calculate' class='btn btn-primary' type='button' value='Calculate' style='display:block' /></div>&nbsp;
        <div class='inner'><input id='edit' class='btn btn-primary' type='button' value='Edit' style='display:none' /></div>&nbsp;";

        if($remaing_qty==0 && isset($service)){

            echo "<div class='inner'><input id='sucess' class='btn btn-success' type='submit' value='Genrate GRB' style='display:none' /></div>&nbsp;";
            
        }
        else{

            echo "<div class='inner'><input id='sucess' class='btn btn-success' type='submit' value='Update' style='display:none' /></div>&nbsp;";
        }
        


        echo "<div class='inner'><input class='btn btn-danger' type='button' value='Cancel' onClick='window.location.reload();' /></div>
		</center>
		</div>
        
        </form>";
        
		
	}
    

	
	    
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>


<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="../assets/global/plugins/select2/js/select2.min.js"></script>
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
    $( document ).ready(function() {
         //ON keyup tran_charge
    $(document).on('keyup', '#tran_charge', function( e ) {
        // alert("asdas"); exit;
                var price = $('#tran_charge').val();
                
                var gst = $('#tran_charge_per').val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $('#tran_charge_gst').val(net_price);
                });
                //ON keyup tran_charge_per
    $(document).on('keyup', '#tran_charge_per', function( e ) {
        // alert("asdas"); exit;
                var price = $('#tran_charge').val();
                
                var gst = $('#tran_charge_per').val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $('#tran_charge_gst').val(net_price);
                });
                //ON keyup ser_charge
    $(document).on('keyup', '#ser_charge', function( e ) {
        // alert("asdas"); exit;
                var price = $('#ser_charge').val();
                
                var gst = $('#ser_charge_per').val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $('#ser_charge_gst').val(net_price);
                });
                //ON keyup serv_charge_per
    $(document).on('keyup', '#ser_charge_per', function( e ) {
        // alert("asdas"); exit;
                var price = $('#ser_charge').val();
                
                var gst = $('#ser_charge_per').val();
                var tax = (price / 100) * gst;
                // var gst_amount = ( price * gst% ) / 100;
                var net_price = Number(price) + Number(tax);
                
                $('#ser_charge_gst').val(net_price);
                });
    // ON keyup disc_amt
    $(document).on('keyup', '.disc_amt', function( e ) {
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[2];

                var disc = $('#disc_amt_'+splt_this_id_ar).val();
                var price = $('#sup_amt_'+splt_this_id_ar).val();
                var prices = $('#sup_amt_'+splt_this_id_ar).val()*$('#iqty_'+splt_this_id_ar).val();
                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                //alert(dec);
                var mult = price * dec;
                var mults = prices * dec; // gives the value for subtract from main value
                var discount = price - mult;
                var discounts = prices - mults;
                
                var gst = $('#gst_amt_'+splt_this_id_ar).val();
                var tot_price = Number(discount * gst / 100) + Number(discount);
                var tot_prices = Number(discounts * gst / 100) + Number(discounts);
                // alert(disc); exit;
                
                $('#tot_'+splt_this_id_ar).val(tot_price);
                $('#tot_val_'+splt_this_id_ar).val(tot_prices);
                });
                // ON keyup disc_amt END
		$(".js-example-basic-multiple").select2();
                $(document).on('change', '#ins_prod_name', function( e ) {
                    var val = $.trim($(this).val());
                    var code = $.trim($("#code").val());
                // var this_name = $.trim($(this).find(':selected').attr("data-name"));
                // $('#DynamicAddRowCols .name').text(this_name);
                // $('.supplier_amt').val("");
                $.ajax({
                    
                        type: "GET",
                        url: 'ajax/ajax_slip_edit_qty.php?prod_name='+val+"&code="+code,
                        success: function(data){
                            //alert(data);
                            //$("#PRO_DETS").html(data);
                            $('#ins_qty_td').html(data);
                        // $('#name').html(data);
                            
                            
                        }
			        });
          
                });

            
	});
</script>
<script>
	jQuery(function ($) {
    //form submit handler
    $('#store_list').submit(function (e) {
        //check atleat 1 checkbox is checked
        if (!$('.chk').is(':checked')) {
            //prevent the default form submit if it is not checked
            alert("Plz select The Supplier Amouunt")
            e.preventDefault();
        }
       
       
    })
})
	</script>
    <script>
        $(document).on("click", "#calculate", function( e ) {

var total = 0;
        $(".tot").each(function (index, element) {
            
            total = Number(total) + Number($(element).val());
        });
        //alert(total);
        document.getElementById("bill_tot").value=total;
var bill_tot = $("#bill_tot").val();
var service = $("#service").val();
var ser_charge_per = $("#ser_charge_per").val();
var ser_charge_gst = $("#ser_charge_gst").val();
var transport = $("#transport").val();
var tran_charge_per = $("#tran_charge_per").val();
var tran_charge_gst = $("#tran_charge_gst").val();
var packing = $("#packing").val();
var advance = $("#advance").val();
$("#overall_total").val( Number(bill_tot) + Number(ser_charge_gst) + Number(tran_charge_gst) + Number(packing)  - Number(advance));



$("#transport").attr("readonly", true);
$("#packing").attr("readonly", true);
$("#advance").attr("readonly", true);
$(this).css("display", "none");
$("#edit").css("display", "block");
$("#sucess").css("display", "block");

});
$(document).on("click", "#edit", function( e ) {
		$("#transport").attr("readonly", false);
		$("#packing").attr("readonly", false);
		$("#advance").attr("readonly", false);
		$(this).css("display", "none");
		$("#calculate").css("display", "block");
		$("#sucess").css("display", "none");
	});
        </script>