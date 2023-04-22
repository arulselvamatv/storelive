<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->Connect();

$HTML="";
if($con)
{
    $asd=('SELECT t.reason,st.dep, c.dep_name, st.`store_id`, st.code, st.invoice_no, st.wrt_date,s.company_name, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
    INNER join grb as g on g.grb_no =st.grb_id
    INNER join work_order as wo on wo.wo_id =st.po_id
    INNER join suplier as s on s.sup_id =wo.suplier_id 
    INNER join client as c on c.cl_id =st.dep
    inner join clientusers as cu on cu.dep_name=c.cl_id
    INNER join transfer as t on t.seno = st.se_no
    WHERE wo.`active_record` =1 and s.`active_record` =1 and t.active_record=1 and st.dep!=0 and st.tranf != 0 and t.to_sup=0 and cu.id='.$user_id.'  group by st.se_no order by t.t_id desc ');
   $i=0;
    $prdt_data=$db->query($asd);
    while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
    { 
        $i++;
        echo '<tr>'.
    
        '<td>'.$prd['se_no'].
        '<input type="hidden" name="seno[]" id="seno_'.$i.'" value="'.$prd['se_no'].'"/>'.
        '</td>'.
        '<td>'.$prd['dep_name'].
        '<input type="hidden" name="dep[]" id="dep_'.$i.'" value="'.$prd['dep'].'"/>'.
        '</td>'.
        '<td>'.$prd['item_name'].
        '</td>'.
        '<td>'.$prd['reason'].
        '<input type="hidden" name="reason[]" id="reason_'.$i.'" value="'.$prd['reason'].'"/>'.
        '</td>';
        if($prd['reason']=="UnWarranty"){
            $asda=('SELECT `sup_id`, `company_name` FROM `suplier` WHERE `active_record`=1');
   
            $prdt_dataa=$db->query($asda);
    
            echo '<td><select class="js-example-basic-multiple" name="reasons[]" id="reasons_'.$i.'">';
            while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))
            { 
                echo'<option value="'.$prda['sup_id'].'">'.$prda['company_name'].'</option>';
            
            }
            echo'</select></td>';
        }
        else if ($prd['reason']=="Warranty"){
            echo '<td>'.$prd['company_name'].'<input type="hidden" name="reasons[]" id="reasons_'.$i.'" value="'.$prd['dep'].'" /></td>';
        }
        
        echo '<td><center><input id="edit_'.$i.'" name="edit[]" class="btn btn-primary edit" type="button" value="Transfer"  /></center>'.
        '</td>'.

        '</tr>';
    }
}
  
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>


<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="../assets/global/plugins/select2/js/select2.min.js"></script>

<script>
   $(document).ready(function() {
    $(".js-example-basic-multiple").select2();
    });
    </script>
	
<script>
    $( document ).ready(function() {

    $(document).on('click', '.edit', function( e ) {
		var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
        // alert(splt_this_id_ar); exit;
	    var this_val = $("#edit_"+splt_this_id_ar).val();
		var seno = $("#seno_"+splt_this_id_ar).val();
        var reason = $("#reason_"+splt_this_id_ar).val();
		var reasons = $("#reasons_"+splt_this_id_ar).val();
        var dep = $("#dep_"+splt_this_id_ar).val();
        
		//   alert(reason); exit;

		$.ajax({
		type: "GET",
		url: 'ajax/ajax_transfered_update.php?seno='+seno+"&reasons="+reasons+"&reason="+reason+"&dep="+dep,
		success: function(data){
            if(data== "sucess"){
                alert("Transfered Sucessfully"); 
                window.location="transfered.php";
            }
            else{
                alert(data);
            }
			// alert("Transfer Sucessfully"); window.location="transfer.php";
			// $("#DynamicAddRowCols").html(data);
		}
		});
			//$('#update_div').load('po_preview.php?pid='+$('#po_no').val());
	
	
	});
    });
</script>

	

	<style>
		.highlight {
  background-color: #03a9f3
}
		</style>