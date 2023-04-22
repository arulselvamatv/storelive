<?php
require_once("header.php");
?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card"></br>
                        </br>
                            <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Store List</h4>
                            </div>
                            <form id="store_list" action="store_list_back.php" method="POST"  autocomplete="off">
                                
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                                

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="DynamicAddRowCols">
                                                  <thead>
                                                    <tr>
                                                      
                                                      <th class="text-center"><input type="checkbox" name="select-all" id="select-all" /></th>
                                                      <th class="text-center">Quotation No.</th>
                                                      <th class="text-center">PO No.</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Specification</th>
                                                      <th class="text-center">Suplier Name</th>
                                                      <th class="text-center">Per Rate</th>
                                                      <th class="text-center">Quantity</th>
                                                      <th class="text-center">Rate</th>
                                                      <th class="text-center">Product Date</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody>
                                                </table>
                                              </div>
                                                   
                                        </div> 
                                        
                                        <div class="col-sm-12">
                                                    
                                                            <center>
                                                            <label class="form-label">Select Department Name:</label>
                                                    <select class="js-example-basic-multiple" id="dep_name" name="dep_name" required="required">
                                                    <option value="">Select Department Name</option>
									                        <?php
								
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            $asd =('SELECT `cl_id`, `dep_name`, `date_time`, `active_record` FROM `client` WHERE active_record=1');
                                                            //echo $asd; exit;
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo "<option value='".$data['cl_id']."'>".''.$data['dep_name']."</option>";
                                                                }

								
									                        ?>
									                    </select> 
                                                        &nbsp;
                                                            <input class='btn btn-success' type='submit' value='Transfer To Department'>&nbsp;
                                                            <input class='btn btn-danger'  type='button' value='Cancel' onClick='window.location.reload();'>
                                                            </center>
                                                            
                                        </div>

                                    </div> 
                                    <!-- card body ended   -->
                                </div>
                                <!-- form body ended -->
                            </form>
                            <!-- Form Ended -->
                            <hr>
                                <?php
								
					require_once("database/connect.php");
					$db=new Database;
					$db->connect();
          $asd =('SELECT sl.`sl_id`, sl.`code`, sl.`sl_no`, sl.`se_no`, sl.`quo_no`, sl.`po_no`, sl.`prod_name`, sl.`pro_ty`, sl.`ddl_pro_qty`, sl.`ddl_pro_spec`, sl.`supname`, sl.`rate`, sl.`date_time`, sl.`dep_name`, sl.`crn_date_time`, sl.`active_record`, s.company_name FROM `store_list` as sl 
          INNER JOIN suplier as s on s.sup_id = sl.supname
          WHERE sl.`active_record`= 1 group BY sl.code');
                    //echo $asd; exit;
                    $datd = $db->query($asd);
                    echo'<b>Store Transfer Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';
                    echo "<thead><tr>";
                    echo "<th>S.No.</th>";
                      echo "<th>Store List No.</th>";
                      echo "<th>Company Name.</th>";
                      echo "<th>time_date</th>";
                      echo "<th>Export</th>";
                      echo "</tr></thead><tbody>";
                      $sno=0;
                    while($row = $datd->fetch(PDO::FETCH_ASSOC))
                    {
                      echo "<tr>";
                      echo "<td>".$row['code']."</td>";//".(++$sno).".
                      echo "<td>".$row['sl_no']."</td>";
                      echo "<td>".$row['company_name']."</td>";
                      echo "<td>".$row['crn_date_time']."</td>";
                      echo "<td><a class=\"btn btn-primary\" href=storelist_preview.php?pid=".$row['code']." target='_blank'> Click here to print</a></td>";
                      //<a href='pdf/quotation_pdf.php?serial_no="($row['serial_no'])."' target='_blank'>Export To PDF-".$row['code']."</a>
                      // <a href='pdf/quotation_pdf.php?serial_no=".$this->encrypt_decrypt($this->killChars($row['serial_no']), $action = 'encrypt')."' target='_blank'>Export To PDF-".$row['code']."</a>
                      //".$this->encrypt_decrypt($this->killChars($row['pinvpid']), $action = 'encrypt')."' target='_blank'
                      echo "</tr>";
                    }
                    echo "</tbody></table>";
          ?>
                        </div>
                        <!-- card ended -->
                    
                    </div>
                
                </div>
                <!-- row ended -->

            </div>
            <!-- ============================================================== -->
    <!--END continerfluid -->
    <?php require_once("footer.php");?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
   </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script>
    $( document ).ready(function() {
    // $(document).on('change', '#po_no', function( e ) {
	     var this_val = 1;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_store_list.php?po_no='+this_val,
				success: function(data){
					//alert(data);
                    $('#tbody').html(data);
                    
					
				}
			});
            //var this_mobile = $.trim($('#name').find(':selected').attr("data-mobile"));
          
    // });
    });

    $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
}); 
    </script>
    <script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
    </script>

<!-- <script>
	jQuery(function ($) {
    //form submit handler
    $('#store_list').submit(function (e) {
        //check atleat 1 checkbox is checked
        if (!$('.chk').is(':checked')) {
            //prevent the default form submit if it is not checked
            alert("Plz select atleast one of the row to submit")
            e.preventDefault();
        }
        $( '.chk' ).each(function( index ) {
            if ($('.chk').is(':checked')) {
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[1];
                if ($('#iqty_'+splt_this_id_ar).val()<=0) {
                    //prevent the default form submit if it is not checked
                    alert("Plz select atleast one quantity to submit");
                    e.preventDefault();
                    }
            }
        });
       
    })
})
	</script> -->
    
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
        