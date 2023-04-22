<?php
require_once("header.php");
$user_id = $_SESSION['user_log_email'];
$user_type = $_SESSION['user_log_type'];

?>
        <div class=page-wrapper>
            <div class=container-fluid>
                <div class=row>
                    <div class=col-lg-12>
                        <div class=card></br></br>
                            <div class="card-header bg-info"><h4 class="mb-0 text-white">Add Quotation Supplier Amount</h4></div>
                            <form id=quotion_amount autocomplete=off>
                                <div class=form-body>
                                    <div class=card-body>
                                        <div class=form-group>
                                            <label class=form-label>QUOTATION NO:</label>
                                            <select class="form-select-lg mb-3 js-example-basic-multiple" id=quo_no name=quo_no size=50>
                                                <option value="">Select A Quotation NO</option>
						                        <?php
                                                require_once("database/connect.php");$db=new Database;$db->connect();
                                                $asd = "SELECT `quotation`.`serial_no` FROM `quotation` JOIN product_details_info as pdi ON quotation.pro_name LIKE concat('%',pdi.pro_code,' - ',pdi.pro_name , '%') 
                                                JOIN product_details ON product_details.pro_id= pdi.pro_id JOIN category ON category.category_name=product_details.cat_name JOIN suplier ON suplier.supliercat=category.ca_id 
                                                JOIN users ON users.email = suplier.email WHERE `quotation`.`active_record`=1 AND users.email='".$user_id."' group by (`serial_no`)"; 
                                              
                                                $datd = $db->query($asd);
                                                while($data=$datd->fetch(PDO::FETCH_ASSOC)){
                                                    echo "<option value='".$data['serial_no']."'>".''.$data['serial_no']."</option>";
                                                }
						                        ?>
						                    </select> 
                                            <label class="form-label">Supplier Name:</label>
                                            <select class="js-example-basic-multiple" size="50" name="suplier_name" id="suplier_name" disabled readonly>
						                        <?php
                                                require_once("database/connect.php");$db=new Database;$db->connect();
                                                $asd =("SELECT `sup_id`,`company_name`,users.`email`,users.`name` FROM `users` INNER JOIN suplier ON suplier.email = users.email where users.email='".$user_id."'");
                                                $datd = $db->query($asd);
                                                $data = $datd->fetch();
                                                echo "<option selected value='".$data['sup_id']."' data-name='".$data['name']."'>".''.$data['name']." ( ".$data['company_name'].")</option>";
                                                ?>
						                    </select>
                                        </div> 
                                        <div class="row pt-3">  
                                            <div class=table-responsive>
                                                <table class="table table-bordered" id=DynamicAddRowCols>
                                                  <thead>
                                                    <tr>
                                                      <th class="text-center">No</th>
                                                      <th class="text-center" >Product Name</th>
                                                      <th class="text-center">QTY</th>
                                                      <th class="text-center" colspan="2">Specification needed</th>
                                                      <th class="text-center name">Suplier amount</th>
                                                      <th class="text-center name">Discount % </th>
                                                      <th class="text-center name">GST %</th>
                                                      <th class="text-center name">Total</th>
                                                      <th class="text-center name">Edit</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody>
                                                </table>
                                                 
                                              </div>
                                        </div>
                                        <div class="col-sm-12"><center><button type="submit" class="btn btn-success">Submit</button></center></div>
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
    
    <script>
            $( document ).ready(function() {
                // SELECT 2
                $('.js-example-basic-multiple').select2();
                //SELECT 2 END
                // ON CHANGE QUO_NO
                $(document).on('change', '#quo_no', function( e ) {
                    $('#suplier_name').attr("disabled", true);
                    // $('#suplier_name').attr("disabled", false);
                    $('.supplier_amt').val("");
                     $('#suplier_name').change();
                });
                // ON CHANGE QUO_NO END
                // ON CHANGE suplier_name
                $(document).on('change', '#suplier_name', function( e ) {
                var this_val = $.trim($("#quo_no").val());
                var val = $.trim($(this).val());
                //ajax for table body
                $.ajax({
                        type: "GET",
                        url: 'ajax/ajax_quot_amt.php?quo_no='+this_val+"&sup_name="+val,
                        success: function(data){
                            $('#tbody').html(data);
                            
                            
                        }
			        });
                //ajax for table body end
                });
                // ON CHANGE suplier_name END
                // ON keyup disc_amt
                $(document).on('keyup', '.disc_amt', function( e ) {
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[2];

                var disc = $('#disc_amt_'+splt_this_id_ar).val();
                var price = $('#supplier_amt_'+splt_this_id_ar).val();
                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                //alert(dec);
                var mult = price * dec; // gives the value for subtract from main value
                var discount = price - mult;
                
                var gst = $('#gst_amt_'+splt_this_id_ar).val();
                var tot_price = Number(discount * gst / 100) + Number(discount);

                
                $('#tot_'+splt_this_id_ar).val(tot_price);
                });
                // ON keyup disc_amt END
                // ON keyup gst_amt
                $(document).on('keyup', '.gst_amt', function( e ) {
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[2];

                var disc = $('#disc_amt_'+splt_this_id_ar).val();
                var price = $('#supplier_amt_'+splt_this_id_ar).val();
                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                //alert(dec);
                var mult = price * dec; // gives the value for subtract from main value
                var discount = price - mult;
                
                var gst = $('#gst_amt_'+splt_this_id_ar).val();
                var tot_price = Number(discount * gst / 100) + Number(discount);

                
                $('#tot_'+splt_this_id_ar).val(tot_price);
                });
                // ON keyup gst_amt END
                // ON keyup supplier_amt
                $(document).on('keyup', '.supplier_amt', function( e ) {
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[2];

                var disc = $('#disc_amt_'+splt_this_id_ar).val();
                var price = $('#supplier_amt_'+splt_this_id_ar).val();
                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
                //alert(dec);
                var mult = price * dec; // gives the value for subtract from main value
                var discount = price - mult;
                
                var gst = $('#gst_amt_'+splt_this_id_ar).val();
                var tot_price = Number(discount * gst / 100) + Number(discount);

                
                $('#tot_'+splt_this_id_ar).val(tot_price);
                });
                
                // ON keyup supplier_amt END
                // ON CLICK EDIT
                $(document).on('click', '.edit', function( e ) {
                //var this_val = $.trim($("#quo_no").val());
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[1];
                $('#supplier_amt_'+splt_this_id_ar).attr("readonly", false); 
                $('#gst_amt_'+splt_this_id_ar).attr("readonly", false); 
                $('#disc_amt_'+splt_this_id_ar).attr("readonly", false); 
                $('#editing_'+splt_this_id_ar).toggle();
                // $('#editing_'+splt_this_id_ar).attr("display", false); 
                    //$('#editing_'+splt_this_id_ar).css('display', '');
                // document.getElementById("editing_"+splt_this_id_ar).style.display = "none";
                document.getElementById("end-editing_"+splt_this_id_ar).style.visibility = 'visible';
                document.getElementById("edit-button_"+splt_this_id_ar).style.visibility = 'hidden';


                });
                // ON CLICK EDIT END
                // ON CLICK DONE

                $(document).on('click', '.done', function( e ) {
                //var this_val = $.trim($("#quo_no").val());
                var this_attr_id = $.trim($(this).attr("id"));
                var splt_this_id = this_attr_id.split("_");
                var splt_this_id_ar = splt_this_id[1];
                $('#supplier_amt_'+splt_this_id_ar).attr("readonly", true); 
                $('#gst_amt_'+splt_this_id_ar).attr("readonly", true); 
                $('#disc_amt_'+splt_this_id_ar).attr("readonly", true); 
                document.getElementById("end-editing_"+splt_this_id_ar).style.visibility = 'hidden';
                document.getElementById("edit-button_"+splt_this_id_ar).style.visibility = 'visible';

                });
                // ON CLICK DONE END

            });
        </script>
         <!-- INSERT FORM VALIDATION -->
    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
       
       <script>
           // for more info visit the official plugin documentation: 
               // http://docs.jquery.com/Plugins/Validation
               
               jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z]+$/i.test(value);
              }, "Alphabetic only allowed"); 
              var form1 = $('#quotion_amount');
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
                    suplier_name: {
                          
                          required: true
                      },
                    prod_name: {
                          
                          required: true
                      },
                    ddl_pro_qty: {
                          
                          required: true
                      },
                    ddl_pro_spec: {
                          
                          required: true
                      },
                    ddl_pro_unit: {
                          
                          required: true
                      },
                    ddl_pro_unt: {
                          
                          required: true
                      },
                    supplier_amt: {
                          
                          required: true
                      },
                    disc_amt: {
                          
                          required: true
                      },
                    gst_amt: {
                          
                          required: true
                      },
                    tot: {
                          
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
                                        url:'quotion_amount_back.php',
                                        data: data,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        type: 'POST',
                                        success: function (response)
                                        {
                                            if(response=="Error! Quotation Suplier Amount Not Updated Try Again.")
                                            {
                                                alert(response); 
                                            }
                                            else if(response=="Error! Supplier Amt Not Updated Try Again.")
                                            {
                                                alert(response); 
                                            }
                                            else
                                            {
                                                $('.form-control').val('');
                                                alert(response); 
                                                window.location="quotation_suplier_amount.php";
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
        