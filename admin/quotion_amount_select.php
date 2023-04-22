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
                                <h4 class="mb-0 text-white">Add Quotation Supplier Amount Select</h4>
                            </div>
                            <form id="quotion_amount_select" autocomplete="off">
                                
                                <div class="form-body">
                                    <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">QUOTATION NO:</label>
                                                    <select class="js-example-basic-multiple" id="quo_no" name="quo_no" >
                                                    <option value="">Select A Quotation NO</option>
									                        <?php
								
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            $asd =('SELECT `qsa_id`, `quo_no`, `product_name`, `product_quantity`, `product_spec`, `date_time`, `active_record` FROM `quot_sup_amt` WHERE active_record=1 group by (`quo_no`) ORDER BY `quot_sup_amt`.`qsa_id` DESC');
                                                            //echo $asd; exit;
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo "<option value='".$data['quo_no']."'>".''.$data['quo_no']."</option>";
                                                                }

								
									                        ?>
									                    </select> 
                                                                                                                
                                                </div> 

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="DynamicAddRowCols">
                                                  <!-- <thead>
                                                    <tr>
                                                      <th class="text-center">No</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Quantity</th>
                                                      <th class="text-center">Specification needed</th>
                                                      <th class="text-center">Supplier</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody> -->
                                                </table>
                                              </div>
                                                <br /><br />

                                                
                                                <div class="col-md-6">
                                                   
                                                </div>       
                                        </div> 
                                        
                                        <div class="col-sm-12">
                                                            <center>
                                                            
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                            
                                                            </center>
                                                            
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <!-- ajax for table body -->
    <script>
    $( document ).ready(function() {
    $(document).on('change', '#quo_no', function( e ) {
	    var this_val = $.trim($(this).val());
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_quot_amt_sel.php?quo_no='+this_val,
				success: function(data){
					//alert(data);
					//$("#PRO_DETS").html(data);
                    $('#DynamicAddRowCols').html(data);
                   // $('#name').html(data);
                    
					
				}
			});
            //var this_mobile = $.trim($('#name').find(':selected').attr("data-mobile"));
          
    });
    
    });
    </script>
    
     <!-- ajax for table body end -->
    <!-- CheckBox -->
    <script>
    $(document).on('click', '.check', function( e ) {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[id='" + $box.attr("id") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
    });
    </script>
<!-- CheckBox END -->
<!-- Select 2 -->
<script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
    </script>
    <!-- Select 2 End -->
    <!-- INSERT FORM VALIDATION -->
    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
       
       <script>
           // for more info visit the official plugin documentation: 
               // http://docs.jquery.com/Plugins/Validation
               
               jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z]+$/i.test(value);
              }, "Alphabetic only allowed"); 
              var form1 = $('#quotion_amount_select');
               var error1 = $('.alert-danger', form1);
               var success1 = $('.alert-success', form1);
   
               form1.validate({
                   errorElement: 'span', //default input error message container
                   errorClass: 'help-block help-block-error', // default input error message class
                   focusInvalid: false, // do not focus the last invalid input
                   ignore: "",  // validate all fields including form hidden input
                 
                   rules: {
                    quo_no: {
                          
                           required: true
                       },
                       sup_name: {
                          
                          required: true
                      },
                      prod_name: {
                          
                          required: true
                      },
                      ddl_pro_unt: {
                          
                          required: true
                      },
                      ddl_pro_unit: {
                          
                          required: true
                      },
                      ddl_pro_qty: {
                          
                          required: true
                      },
                      ddl_pro_spec: {
                          
                          required: true
                      },
                      check: {
                          
                          required: true
                      }
                       
                     
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
                                        url:'quotion_amount_select_back.php',
                                        data: data,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        type: 'POST',
                                        success: function (response)
                                        {
                                            if(response=="Error! Quotation Amount Selected not updated try again.")
                                            {
                                                alert(response); 
                                            }
                                            else{
                                                $('.form-control').val('');
                                                alert(response); 
                                                window.location="quotion_amount_select.php";
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
        