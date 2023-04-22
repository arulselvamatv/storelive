<?php
require_once("header.php");
?>
<?php
require_once(__DIR__."/database/connect.php");
$db = new Database;
$db->connect();
$po_qry = ('SELECT `wo_id`, dep_no, work_order.`po_no`, `wo_no`, work_order.`quo_no`, `prod_name`, work_order.`ddl_pro_unit`, work_order.`ddl_pro_qty`, work_order.`product_spec`, work_order.`suplier_id`, s.company_name, `sup_amt`, work_order.`disc_amt`, work_order.`tot`,
            `work_order`.`approved_dt`, `work_order`.`date_time` FROM `work_order` JOIN `suplier` as s ON s.sup_id = work_order.suplier_id JOIN `quot_sup_amt` as qsa ON qsa.quo_no = work_order.quo_no WHERE `work_order`.`active_record`= 1 AND NOW() >= DATE_ADD(`approved_dt`, INTERVAL CAST(timelinedays - 5 AS UNSIGNED) DAY)  GROUP BY `po_no`');
// $po_qry = ('SELECT `wo_id`, dep_no, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, `ddl_pro_qty`, `product_spec`, `suplier_id`, s.company_name, `sup_amt`, `disc_amt`, `tot`,
            // `work_order`.`approved_dt`, `work_order`.`date_time` FROM `work_order` JOIN `suplier` as s ON s.sup_id = work_order.suplier_id WHERE `work_order`.`active_record`= 1 AND NOW() >= DATE_ADD(`approved_dt`, INTERVAL 30 DAY)  GROUP BY `po_no`');
$podata = $db->query($po_qry);
$po_exp_cnt = $podata->rowCount();
?>

        
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"></br></br>
                        <div class="card-header bg-info"><h4 class="mb-0 text-white">PO Reminder Report</h4></div>
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">  
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="123">
                                            <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Purchase Order No</th>
                                                <th class="text-center">Department No</th>
                                                <th class="text-center">Company Name</th>
                                                <th class="text-center">Approved</th>
                                                <th class="text-center">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                while ($po_d = $podata->fetch(PDO::FETCH_ASSOC)) {
                                                    $i = ++$i;
                                                    echo '<tr>' .
                                                    '<th><center>' . $i . '</center></th>' .
                                                    '<th><center>' . $po_d['po_no'] . '</center></th>' .
                                                    '<th><center>' . $po_d['dep_no'] . '</center></th>' .
                                                    '<th><center>' . $po_d['company_name'] . '</center></th>' .
                                                    '<th><center>' . date('d F Y', strtotime($po_d['approved_dt'])) . '</center></th>' .
                                                    '<th><center>' . date('d F Y', strtotime($po_d['date_time'])) . '</center></th>' .
                                                    '</tr>';
                                                } 
                                                ?>
                                                <!--<hr><hr>-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        <!-- Container ended -->
    </div>
    <!-- Page wrapper ended -->
  <?php require_once("footer.php");?>

    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="dist/js/pages/jasny-bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script type="text/javascript">

$(document).on('click', '.view', function( e ) {
	
	$("#update_div").html("");
    // $("#update_div2").html("");
   
	var this_attr_id = $.trim($(this).attr("id"));
    var splt_this_id = this_attr_id.split("_");
    var splt_this_id_ar = splt_this_id[2];
	//alert(splt_this_id_ar);
	
		$.ajax({
		type: "GET",
		url: 'po_view.php?po_no='+splt_this_id_ar+'&header=0',
		success: function(data){
			
			$("#update_div").html(data);
			
		}
		});
		
        var htm="<table width='100%'><tr>";
		htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=po_view.php?po_no="+splt_this_id_ar+"&header=0 target='_blank'> Click here to print without header</a></td>";
		htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=po_view.php?po_no="+splt_this_id_ar+"&header=1 target='_blank'> Click here to print with header</a></td>";
		htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=po_view.php?po_no="+splt_this_id_ar+"&header=2 target='_blank'> Click here to print Blank header</a></td>";
		htm=htm+"<td align='center'><a href='?po_no="+splt_this_id_ar+"'><input type='hidden' name='po' value=\'"+splt_this_id_ar+"\'><button id=\"btnlnk\" class=\"btn btn-primary\" target='_blank'> Click here to Edit PO</button></a></td>";
		htm=htm+"</tr></table>";
		$("#update_div2").html(htm);
	
	
		});
</script>
<script>
          $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#trn_dlr_pi_inv thead tr')
        .clone(true)
        .addClass('filters')
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
    


</body>

</html>
        