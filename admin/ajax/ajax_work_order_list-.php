<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT `qas_id`, `wo_no`, quo_no ,date_time FROM `quot_sup_amt_sel` 
		WHERE `active_record`=1 and `po_status`=0  group by wo_no  ');
		//echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{ 
			
			$i = ++$i;
			echo '<tr>'.
			'<th>'.$i.'</th>'.
			'<th>'.
			'<input class="form-control" name="wo_no[]" id="wo_no_'.$i.'" value="'.$prd['wo_no'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<input class="form-control" name="quo_no[]" id="quo_no_'.$i.'" value="'.$prd['quo_no'].'" readonly="readonly" />'.
			'</th>'.
			
            '<th><input class="form-control" name="date_time[]" id="date_time_'.$i.'" value='.$prd['date_time'].' readonly="readonly" />'.
			'</th>'.
			'<th><center><input id="edit_'.$i.'" name="edit[]" class="btn btn-primary edit" type="button" value="Edit"  /></center>'.
			'</th>'.

			'</tr>';
		}
		echo "<div class='buttonss'></div>";
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
	    var this_val = $("#edit_"+splt_this_id_ar).val();
		var wo_no = $("#wo_no_"+splt_this_id_ar).val();
		var quo_no = $("#quo_no_"+splt_this_id_ar).val();
		//alert(wo_no);

		$.ajax({
		type: "GET",
		url: 'ajax/ajax_quot_amt_sel_work.php?wo_no='+wo_no+"&quo_no="+quo_no,
		success: function(data){
			
			$("#DynamicAddRowCols").html(data);
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