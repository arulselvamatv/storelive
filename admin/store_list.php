<?php
require_once("header.php");


require_once("database/connect.php");
$db = new Database;
$db->connect();
?>

<style>
	#myModal .modal-lg{
		max-width: 90% !important;
		heig
	}
	#myModal #Iframe_url{
		width :100%;
		height :100%;
	}
	
	
	#myModal .modal-content{
		height: calc(100vh - 60px);
		background-color: #f9fafb !important;
	}
	
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card"></br>
                    </br>
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Store List</h4>
                    </div>
                    <div class="card-body">
                        <div class="row pt-3">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="storelist_tbl">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center">Quotation No</th>
                                        <th class="text-center">PO No</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Specification</th>
                                        <th class="text-center">Per Rate</th>
                                        <th class="text-center">Total Quantity</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Product Date</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            
                            
                             <!--selected products list  start Here-->
                            
                            <div>
                                <h4> <u>selected products list</u></h4>
                            </div>
                                    
                                    
                                     <div class="table-responsive">
                                            <table id='selected_product' style="width:100%">
                                                 <thead>
                                                     <tr>
                                                    <th class="text-center">S.No</th>
                                                      <th class="text-center">Quotation No.</th>
                                                      <th class="text-center">PO No.</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Specification</th>
                                                      <th class="text-center">Per Rate</th>
                                                      <!--<th class="text-center">Total Quantity</th>-->
                                                      <th class="text-center"> Selected Quantity</th>
                                                      <!--<th class="text-center">Rate</th>-->
                                                      <th class="text-center">Product Date</th>
                                                     </tr>
                                                </thead>
                                                
                                                <tbody id="show_selected_prducts">
                                                    
                                                    
                                                <tbody>
                                            </table>
                                             
                                        </div>
                                        
                                         <!--selected products list  End Here-->
                            
                            
                            

                        </div>

                        <?php
                        if ($user_id == $admin || $user_id == $store) {
                            ?>
                           <div class="row pt-4">
                         <div classs="col-lg-12 " align="center"> 
                         
                                <label class="form-label" style="font-weight:500">Enter Indent No:</label>
                                <input type="number" name="indent_no" id="indent_no">
                          
                                
                                    <label class="form-label ps-2" style="font-weight:500">Select Department Name:</label>
                                    <select class="js-example-basic-multiple w-50" id="dep_name" name="dep_name" required="required">
                                        <option value="">Select Department Name</option>
                                        <?php
                                        $datd = $db->query('SELECT `cl_id`, `dep_name`, `room_no`, `block`, `date_time`, `active_record` FROM `client` WHERE active_record=1');
                                        while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $data['cl_id'] . "'>" . $data['dep_name'] . "/" . $data['block'] . "/" . $data['room_no'] . "</option>";
                                        }
                                        ?>
                                    </select> 
                                     
                            </div>
                             <div class="col-lg-12 pt-4" align="center">
                                <input class='btn btn-success me-3 px-3' type='button' id="transfer_btn" value='Transfer To Department'> 
                                <input class='btn btn-danger' type='button' value='Cancel' onClick='window.location.reload();'>
                             </div>
                             
                        </div>
                            <?php
                        }
                        ?>


                        <hr>
                        <?php
                        $asd = ('SELECT sl.`sl_id`, sl.`code`, sl.`sl_no`, sl.`se_no`, sl.`quo_no`, sl.`po_no`, sl.`prod_name`, sl.`pro_ty`, sl.`ddl_pro_qty`, sl.`ddl_pro_spec`, sl.`supname`, sl.`rate`, sl.`date_time`, sl.`dep_name`, sl.`crn_date_time`, sl.`active_record`, s.company_name, c.dep_name as cl_name FROM `store_list` as sl 
                                  INNER JOIN suplier as s on s.sup_id = sl.supname
                                  inner JOIN client as c on c.cl_id = sl.dep_name
                                  WHERE sl.`active_record`= 1 group BY sl.code' );
                        //echo $asd; exit;
                        $datd = $db->query($asd);
                        echo '<h3><b>Store Transfer Report</b></h3><hr />
                        <div style="overflow-x:auto;">
                        <table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';
                        echo "<thead><tr>";
                        echo "<th>S.No</th>";
                        echo "<th>Store List No</th>";
                        echo "<th>Company Name</th>";
                        echo "<th>Department Name</th>";
                        echo "<th>Date</th>";
                        echo "<th>Export Bar Code</th>";
                        echo "<th>Export Report</th>";
                        echo "</tr></thead><tbody>";
                        $sno = 0;
                        while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['code'] . "</td>";//".(++$sno).".
                            echo "<td>" . $row['sl_no'] . "</td>";
                            echo "<td>" . $row['company_name'] . "</td>";
                            echo "<td>" . $row['cl_name'] . "</td>";
                            echo "<td>" . $row['crn_date_time'] . "</td>";
                            echo "<td><a class=\"btn btn-primary\" href=storelist_preview.php?pid=" . $row['code'] . " target='_blank'>  print Bar Code</a></td>";
                              echo "<td><a class=\"btn btn-primary\" href=store_cus_report.php?pid=".$row['code']." target='-blank'> Print Report</a></td>";
                            //<a href='pdf/quotation_pdf.php?serial_no="($row['serial_no'])."' target='_blank'>Export To PDF-".$row['code']."</a>
                            // <a href='pdf/quotation_pdf.php?serial_no=".$this->encrypt_decrypt($this->killChars($row['serial_no']), $action = 'encrypt')."' target='_blank'>Export To PDF-".$row['code']."</a>
                            //".$this->encrypt_decrypt($this->killChars($row['pinvpid']), $action = 'encrypt')."' target='_blank'
                            echo "</tr>";
                        }
                        echo "</tbody></table>
                        </div>";
                        ?>

                    </div>


                </div>
                <!-- card ended -->

            </div>

        </div>
        <!-- row ended -->

    </div>
</div>



		<!-- Modal content-->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			  </div>
			  <div class="modal-body">
				<iframe id="Iframe_url" src=""></iframe>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
			  </div>
			</div>

		  </div>
		</div>

    <?php require_once("footer.php"); ?>

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/waves.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
<script src="dist/js/custom.min.js"></script>

<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<script src="dist/js/pages/jasny-bootstrap.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>-->
<!--<script src="assets/datatable/jquery.dataTables.min.js"></script>-->
<!--<script src="assets/datatable/buttons.dataTables.min.js"></script>-->

<!--<script src="assets/auto.js"></script>-->
<!--<script src="assets/autocomplete.js"></script>-->
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"/>
<script src="assets/global/plugins/select2/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/datatables/select/css/select.dataTables.min.css"/>

<script src="assets/datatables/datatables.min.js"></script>
<script src="assets/datatables/select/js/dataTables.select.min.js"></script>

<script>
    $(document).ready(function () {
        var rows_selected = [];
        var rows_selected_data = [];

        var store_transfer_table = $('#storelist_tbl').DataTable({
            columnDefs: [{
                targets: 0,
                data: null,
                orderable: false,
                className: 'dtbl-checkbox',
                'render': function (data, type, full, meta) {
                    return '<input type="checkbox" name="dt_checkbox">';
                }
            }, {
                target: 1,
                data: 1,
                visible: false,
                searchable: false,
                render: function (id) {
                    return '<input type="hidden" name="store_id[]" value="' + id + '" data-id="' + id + '" />';
                }
            }, {
                target: [7, 9],
                searchable: false,
            }, {
                target: 8,
                data: 7,
                searchable: false,
                render: function (qty, type, row, meta) {
                    var qty_html = '<select class="js-example-basic-multiple qty select_qty" name="ddl_pro_qty_' + meta['row'] + '" required="required">';
                    for (let i = 0; i <= qty; i++) {
                        qty_html += '<option value="' + i + '">' + i + '</option>';
                    }
                    qty_html += '</select>';

                    return qty_html;
                }
            }],
            select: {
                style: 'multi',
                selector: 'td:first-child',
                info: false
            },
            order: [[1, 'asc']],
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "lengthMenu": [[25, 50, 100, 250], [25, 50, 100, 250]],
            "ajax": {
                "type": "POST",
                "url": "ajax/ajax_store_list_ssp	.php"
            },
            "rowCallback": function (row, data, index) {
                var rowId = data[0];
                if ($.inArray(rowId, rows_selected) !== -1) {
                    let row_qty = rows_selected_data.find((item) => {
                        return ((item[0] === rowId) ? item[1] : 0);
                    });
                    $(row).find('select[name="ddl_pro_qty_' + index + '"]').val(row_qty);
                    $(row).find('input[name="dt_checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                    
                }
            }
        });

        $('#storelist_tbl tbody').on('click', 'input[name="dt_checkbox"]', function (e) {
            var tbl_row = $(this).closest('tr');
            var selected_row = store_transfer_table.row(tbl_row);
            var data = selected_row.data();
            var row_index = selected_row.index();
            
            var rowId = data[0];

            var index = $.inArray(rowId, rows_selected);
            if (this.checked) {
                if (index === -1) {
                    let row_qty = $('#storelist_tbl').find('select[name="ddl_pro_qty_' + row_index + '"]').val();
                    rows_selected_data.push([rowId, row_qty]);
                    rows_selected.push(rowId);
                }
                tbl_row.addClass('selected');
            } else {
                if (index !== -1) {
                    let remove_index = rows_selected_data.findIndex((item) => {
                        return (item[0] === rowId);
                    })
                    rows_selected_data.splice(remove_index, 1);
                    rows_selected.splice(index, 1);
                }
                tbl_row.removeClass('selected');
            }
                  
                //selected products list  start here
               
			var formData = new FormData();
			formData.append('trans_data', JSON.stringify(rows_selected_data));
			$.ajax({
					url: 'ajax/ajax_store_list_selectproduct.php',
					type: 'post',
					data: formData,
					dataType: 'html',
					cache : false,
					processData: false,
					contentType: false,
					success: function (res) {
					   $('#show_selected_prducts').html(res);
					}
				});
                
            e.stopPropagation();
        });

        $('#storelist_tbl').on('click', 'tbody td:first-child', function (e) {
            $(this).parent().find('input[name="dt_checkbox"]').trigger('click');
        });

        $("#transfer_btn").click(function () {
            let transfer_data = rows_selected_data;

            if(transfer_data.length > 0){
                var todep_elem = $('#dep_name');
                var todep_val = todep_elem.val();

                var indent_no = $('#indent_no');
                var indent_val = indent_no.val();

                if(!todep_val){
                    alert('Select Department for Transfer');
                }
                else if(!indent_val)
                  {
                    alert('Indent Number is Missing');
                }
                else{
                    var formData = new FormData();
                    formData.append('trans_data', JSON.stringify(transfer_data));
                    formData.append('todep', todep_val);
                    formData.append('indent_no', indent_val);

                    

                    $.ajax({
                        url: 'store_list_back.php',
                        type: 'post',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function (res) {
                            if(res.status){
								$('#myModal').modal("show"); 
								//~ var url = "http://localhost:8080/store_software/admin/store_cus_report.php?pid='"+res.code+"' ";
								var url = "store_cus_report.php?pid='"+res.code+"' ";
								console.log(url);
								$('#Iframe_url').attr("src",url);
                                //alert('Transfered Successfully');
                               // location.reload();
                            }else{
                                if(res.err_msg){
                                    alert(res.err_msg);
                                }else{
                                    alert('Failed to Transfer! Try Again');
                                }
                            }
                        }
                    });
                }

            }else{
                alert('Select Checkboxes for Transfer');
            }

        });
        
         $(document).on('click','#myModal .close, #myModal .close-btn',function (){
			 $('#myModal').modal("hide");
			 location.reload();
		 });
        
        

        $(document).on('change','.select_qty',function (){
            var tbl_row = $(this).closest('tr');
            var selected_qty_val = $(this).val();

            var selected_row = store_transfer_table.row(tbl_row);
            var data = selected_row.data();
            var rowId = data[0];

            if ($.inArray(rowId, rows_selected) !== -1) {
                let change_index = rows_selected_data.findIndex((item) => {
                    return (item[0] === rowId);
                })
                rows_selected_data[change_index][1] = selected_qty_val;
            }
        })

        $('.js-example-basic-multiple').select2();
    });

</script>

<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#trn_dlr_pi_inv thead tr').clone(true).addClass('filters').appendTo('#trn_dlr_pi_inv thead');

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
        
