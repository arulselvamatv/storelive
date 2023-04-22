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
                                <h4 class="mb-0 text-white">Work Order List</h4>
                            </div>
                            <form id="work_order"  autocomplete="off">
                                
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                    

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="DynamicAddRowCols">
                                                  <thead>
                                                    <tr>
                                                      
                                                      <th class="text-center">No.</th>
                                                      <th class="text-center">Work Order No.</th>
                                                      <th class="text-center">Quotation No.</th>
                                                      <th class="text-center">Product Date</th>
                                                      <th class="text-center">Edit</th>
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
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>
<!-- AJAX FOR BODY -->
    <script>
    $( document ).ready(function() {
    // $(document).on('change', '#po_no', function( e ) {
	     var this_val = 1;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_work_order_list.php?po_no='+this_val,
				success: function(data){
					//alert(data);
                    $('#tbody').html(data);
                    
					
				}
			});
    });

    </script>
    <!-- AJAX FOR BODY END  -->
    <!-- SELECT 2 -->
    <script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
    </script>
<!-- SELECT 2 END -->
   <!-- INSERT FORM VALIDATION -->
   <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
       
       <script>
           // for more info visit the official plugin documentation: 
               // http://docs.jquery.com/Plugins/Validation
               
               jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z]+$/i.test(value);
              }, "Alphabetic only allowed"); 
              var form1 = $('#work_order');
               var error1 = $('.alert-danger', form1);
               var success1 = $('.alert-success', form1);
   
               form1.validate({
                   errorElement: 'span', //default input error message container
                   errorClass: 'help-block help-block-error', // default input error message class
                   focusInvalid: false, // do not focus the last invalid input
                   ignore: "",  // validate all fields including form hidden input
                 
                   rules: {
                    // quo_no: {
                          
                    //        required: true
                    //    },
                    //    wo_no: {
                          
                    //       required: true
                    //   },
                    //   prod_name: {
                          
                    //       required: true
                    //   },
                    //   ddl_pro_unt: {
                          
                    //       required: true
                    //   },
                    //   ddl_pro_unit: {
                          
                    //       required: true
                    //   },
                    //   ddl_pro_qty: {
                          
                    //       required: true
                    //   },
                    //   ddl_pro_spec: {
                          
                    //       required: true
                    //   },
                    //   sup_id: {
                          
                    //       required: true
                    //   },
                    //   sup_amt: {
                          
                    //       required: true
                    //   },
                    //   disc_amt: {
                          
                    //       required: true
                    //   },
                    //   gst_amt: {
                          
                    //       required: true
                    //   },
                    //   tot: {
                          
                    //       required: true
                    //   }
                       
                     
                   },
   
                   invalidHandler: function (event, validator) { //display error alert on form submit              
                       success1.hide();
                       error1.show();
                       Metronic.scrollTo(error1, -200);
                   },
   
                   highlight: function (element) { // hightlight error inputs
                       $(element)
                           .closest('.form-group').addClass('has-error'); // set error class to the control group
                   },
   
                   unhighlight: function (element) { // revert the change done by hightlight
                       $(element)
                           .closest('.form-group').removeClass('has-error'); // set error class to the control group
                   },
   
                   success: function (label) {
                       label
                           .closest('.form-group').removeClass('has-error'); // set success class to the control group
                   },
   
                   submitHandler: function (form) {
                       success1.show();
                       error1.hide();
                       
                           var data = new FormData($(form)[0]);
       $.ajax
           (
               {
                   //data : form.serialize(),
                   url:'work_order_back.php',
                   data: data,
                   cache: false,
                   contentType: false,
                   processData: false,
                   type: 'POST',
                   success: function (response)
                   {
                       if(response == "Work Order Details Stored Sucessfully")
                       {
                            $('.form-control').val('');
                            alert(response); 
                            window.location="work_order.php";
                       }
                       else
                       {
                            alert(response); 
                       }
                      
                    },
                   
               }
           ); 
                       
                   }
               });
   
   </script>
   <!-- INSERT FORM VALIDATION END -->
      


</body>

</html>
        