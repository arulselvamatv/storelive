
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
                                <h4 class="mb-0 text-white">Supplier report</h4>
                            </div>
                            <div id="tablesss">
                            <form autocomplete="off">
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label">Start Date<span style="color: red"> *</span></label>
                                                    <input type='text' class='form-control bill' id='s_date' name='s_date' >
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">End Date<span style="color: red"> *</span></label>
                                                    <input class="form-control bill" type="text" id="e_date" name="e_date" value="">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-sm-12">
                                                            <center>
                                                            
                                                            <button type="button" class="btn btn-success" id="sup_rep">Submit</button>
                                                            
                                                            </center>
                                                            
                                        </div>
                                    </div>   
                                </div>
                            </form>
                            </div>
                                            <!--/span-->
                                            <!-- <div class="table-responsive">
                                                <table class="table table-bordered" id="trn_dlr_pi_inv">
                                                  <thead>
                                                    <tr>
                                                    <th class="text-center">S.No.</th>
                                                      <th class="text-center">Company Name.</th>
                                                      <th class="text-center">Name.</th>
                                                      <th class="text-center">Mobile No.</th>
                                                      <th class="text-center">Address.</th>
                                                      <th class="text-center">gstin_no.</th>
                                                      <th class="text-center">pan_no.</th>
                                                      <th class="text-center">bank1.</th>
                                                      <th class="text-center">bank2.</th>
                                                      <th class="text-center">date_time.</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody1">
                                            
                                                  </tbody>
                                                </table>
                                              </div> -->
                                                   

                                    </div> 
                                    <!-- card body ended   -->
                                </div>
                                <!-- form body ended -->
                            
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
    <link rel="stylesheet" href="assets/jquery-ui.css">
    <script src="assets/jquery_ui/jquery-ui.js"></script>
    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script>
         $( ".bill" ).datepicker(
            {
        dateFormat: 'yy-mm-dd' ,
		changeMonth: true,
		changeYear: true,
	    });
    $( document ).ready(function() {
        $( "#sup_rep" ).click(function( event ) {
            var s_date= $("#s_date").val(); 
            // alert(s_date); exit;
            var e_date= $("#e_date").val();
            
            if(s_date=="" || e_date==""){
                alert("Start Date or End date Missing"); 
            }
            window.location.href = "ajax/ajax_suplier_report.php?s_date="+s_date+"&e_date="+e_date+"";
            // $.ajax({
			// 	type: "GET",
			// 	url: 'ajax/ajax_suplier_report.php?s_date='+s_date+'&e_date='+e_date,
			// 	success: function(data){
			// 		// alert(data);
                    
            //         $('#tablesss').html(data);
                    
					
			// 	}
			// });
            // var htm="<table width='100%'><tr>";
		    //     htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=ajax/ajax_suplier_report.php?s_date="+s_date+"&e_date="+e_date+" target='_blank'> Click here to print without header</a></td>";
            //     htm=htm+"</tr></table>";
		    //     $("#update_div2").html(htm);
        });
    // $(document).on('change', '#po_no', function( e ) {
	    
        
            
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
    
   

</body>

</html>
        