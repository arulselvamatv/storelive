<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->Connect();

echo "<pre/>333"; print_r($_POST);exit;
$HTML="";
if($con)
{


		$where="";
		if( !empty($_REQUEST['search']['value']) ) { 
			$where.=" WHERE  ( email LIKE '".$_REQUEST['search']['value']."%' ";    
			$where.=" OR mobile_number LIKE '".$_REQUEST['search']['value']."%' )";
		}
		$totalRecordsSql = "SELECT count(*) as total FROM users $where;";
		$stmt = $conn->prepare($totalRecordsSql);
		$stmt->execute();
		$res = $stmt->fetchAll();
		$totalRecords=0;
		foreach ($res as $key => $value) {
			$totalRecords = $value['total'];
		}
		$columns = array( 
			0 =>'user_id', 
			1 => 'name',
			2=> 'email',
		  3=>'mobile_number'
		);

		$sql = "SELECT user_id,name,email,mobile_number";
		$sql.=" FROM users $where";

		$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$json_data = array(
		 "draw"            => intval( $_REQUEST['draw'] ),   
		 "recordsTotal"    => intval($totalRecords ),  
		 "recordsFiltered" => intval($totalRecords),
		 "data"            => $result   // total data array
		 );

		echo json_encode($json_data);

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
