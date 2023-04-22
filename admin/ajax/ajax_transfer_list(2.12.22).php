<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->Connect();

$HTML="";
if($con)
{
    $asd=('SELECT st.dep,c.dep_name,st.`store_id`, st.code, st.invoice_no, st.wrt_date,s.company_name, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
    INNER join grb as g on g.grb_no =st.grb_id
    INNER join work_order as wo on wo.wo_id =st.po_id
    INNER join suplier as s on s.sup_id =wo.suplier_id 
    INNER join client as c on c.cl_id =st.dep
    WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep!=0 and st.tranf = 0  group by st.se_no order by st.`store_id` DESC LIMIT 1000');
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
        '<input type="hidden" name="fromdep[]" id="fromdep_'.$i.'" value="'.$prd['dep'].'"/>'.
        '</td>'.
        '<td>'.$prd['company_name'].
        '</td>'.
        '<td>'.$prd['item_name'].
        '</td>'.
        '<td>'.$prd['bill_date'].
        '</td>'.
        '<td>'.$prd['wrt_date'].
        '</td>';
        echo '<td><select class="js-example-basic-multiple reason" name="reason[]" id="reason_'.$i.'">
        
        <option value="Warranty">Warranty</option>
        <option value="UnWarranty">UnWarranty</option>
        
        <option value="Back to Store">Back To Store</option>
        
        <option value="Client">Client</option>';
        
        echo '</select><div id="hidden_div_'.$i.'"  style="display:none">'.
        '<select class="js-example-basic-multiple" name="todep[]" id="todep_'.$i.'" >';
        echo '<option value="">Select Client</option>';
        $asda=('SELECT `cl_id`, `dep_name`, `date_time`, `active_record` FROM `client` WHERE `active_record`=1');
   
        $prdt_dataa=$db->query($asda);
        while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))
        { 
            echo '<option value="'.$prda['cl_id'].'">'.$prda['dep_name'].'</option>';
        }
    echo '</select></div></td>';
    echo '<td><center><input id="edit_'.$i.'" name="edit[]" class="btn btn-primary edit" type="button" value="Transfer"  /></center>'.
        '</td>'.

        '</tr>';
    }
    echo "<div class='buttonss'></div>";
}
  
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>


<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="../assets/global/plugins/select2/js/select2.min.js"></script>


<script src="assets/datatable/jquery.dataTables.min.js"></script>
<script src="assets/datatable/buttons.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>

<style>
    #hidden_div {
    display: none;
}
</style>
<script>
   $(document).ready(function() {
    $(".js-example-basic-multiple").select2();
    });
    </script>
    <script>
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#trn_dlr_pi_inv thead tr')
        .appendTo('#trn_dlr_pi_inv thead');
 
    var table = $('#trn_dlr_pi_inv').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
        </script>
    
    
	
<script>
    $( document ).ready(function() {
        $(document).on('change', '.reason', function( e ) {
		var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
        // alert(splt_this_id_ar); exit;
		var reason = $("#reason_"+splt_this_id_ar).val();
        // alert("hhiii");
        if(reason=="Client"){
            // alert("hhiii");
            $("#hidden_div_"+splt_this_id_ar).css({'display':'block'});
        }
        else{
            // alert("hh");
            $("#hidden_div_"+splt_this_id_ar).css({'display':'none'});
        }
        
        // document.getElementById(divId).style.display = element.value == "Client" ? 'block' : 'none';
    });

    $(document).on('click', '.edit', function( e ) {
		var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
        // alert(splt_this_id_ar); exit;
	    var this_val = $("#edit_"+splt_this_id_ar).val();
		var seno = $("#seno_"+splt_this_id_ar).val();
		var reason = $("#reason_"+splt_this_id_ar).val();
        var fromdep = $("#fromdep_"+splt_this_id_ar).val();
        var todep = $("#todep_"+splt_this_id_ar).val();
        
		//  alert(seno); exit;

		$.ajax({
		type: "GET",
		url: 'ajax/ajax_transfer_update.php?seno='+seno+"&reason="+reason+"&fromdep="+fromdep+"&todep="+todep,
		success: function(data){
            if(data== "sucess"){
                alert("Transfer Sucessfully"); 
                window.location="transfer.php";
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
