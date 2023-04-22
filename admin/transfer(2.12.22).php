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
                                <h4 class="mb-0 text-white">Transfer To Store</h4>
                            </div>
                            <form id="transfer"  autocomplete="off">
                                
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                    

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="trn_dlr_pi_inv">
                                                  <thead>
                                                    <tr>
                                                      
                                                      <th class="text-center">Serial NO.</th>
                                                      <th class="text-center">Department Name.</th>
                                                      <th class="text-center">Company Name.</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Bill Date</th>
                                                      <th class="text-center">Warranty Date</th>
                                                      <th class="text-center">Reason</th>
                                                      <th class="text-center">Transfer</th>
                                                     
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody>
                                                </table>
                                              </div>
                                                   
                                        </div> 
                                        
                                        

                                    </div> 
                                    <!-- card body ended   -->
                                </div>
                                <!-- form body ended -->
                            </form>
                            <!-- Form Ended -->
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

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    
    <!--<script src="assets/datatable/jquery.dataTables.min.js"></script>-->
    <!--<script src="assets/datatable/buttons.dataTables.min.js"></script>-->
    <!--<link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>-->
    
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>-->

    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
   
   <!-- AJAX FOR BODY -->
   <script>
    $( document ).ready(function() {
    // $(document).on('change', '#po_no', function( e ) {
	     var this_val = 1;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_transfer_list.php?se_no='+this_val,
				success: function(data){
					//alert(data);
                    $('#tbody').html(data);
                    
					
				}
			});
    });

    </script>
    <!-- AJAX FOR BODY END  -->
   
   <script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
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
        
