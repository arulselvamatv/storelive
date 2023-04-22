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
                                <h4 class="mb-0 text-white">Add Quotation Supplier Amount</h4>
                            </div>
                            <form id="po" action="quotion_amount_back.php" method="POST" autocomplete="off">
                                
                                <div class="form-body">
                                    <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">QUOTATION NO:</label>
                                                    <input type="text" class="form-control form-select" id="quo_no" name="quo_no" list="quo_no_list">
                                                    <datalist id="quo_no_list">
									                        <?php
								
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            $asd =('SELECT  `serial_no` FROM `quotation` WHERE active_record=1 group by (`serial_no`)');
                                                            //echo $asd; exit;
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo "<option value='".$data['serial_no']."'>".''.$data['serial_no']."</option>";
                                                                }

								
									                        ?>
									                    </datalist> 
                                                                                                                
                                                </div> 

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="DynamicAddRowCols">
                                                  <thead>
                                                    <tr>
                                                      <th class="text-center">No</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Quantity</th>
                                                      <th class="text-center">Specification needed</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody>
                                                </table>
                                              </div>
                                                <br /><br />

                                                Suplier Name <input type="text" id="col" class="form-control form-select" list="sup_name_list">
                                                    <datalist id="sup_name_list">
									                        <?php
								
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            $asd =('SELECT `sup_id`, `company_name`, `name` FROM `suplier` WHERE `active_record`=1');
                                                            //echo $asd; exit;
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo "<option value='".$data['name']."'>".''.$data['name']." ( ".$data['company_name'].")</option>";
                                                                }


								
									                        ?>
									                    </datalist> 
                                               <br />
                                                <button class="btn btn-md btn-primary"  id="AddCol">Insert Suplier Name</button>
                                                <div class="col-md-6">
                                                   
                                                </div>       
                                        </div> 
                                        
                                        <div class="col-sm-12">
                                                            <center>
                                                            
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            
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
            <footer class="footer">
            © 2021 Eliteadmin by themedesigner.in
            <a href="https://www.wrappixel.com/">WrapPixel</a>
        </footer>
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <!-- ajax for table body -->
    <script>
    $( document ).ready(function() {
    $(document).on('change', '#quo_no', function( e ) {
	    var this_val = $.trim($(this).val());
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_quot_amt.php?quo_no='+this_val,
				success: function(data){
					//alert(data);
					//$("#PRO_DETS").html(data);
                    $('#tbody').html(data);
                   // $('#name').html(data);
                    
					
				}
			});
            //var this_mobile = $.trim($('#name').find(':selected').attr("data-mobile"));
          
    });
    });
    </script>
    <!-- script for adding column -->
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#AddCol').on("click", function () {
                if ($('#col').val()) {
                    var $col_val = $('#col').val();
                    $('#DynamicAddRowCols tr').append($("<td>"));
                    $('#DynamicAddRowCols thead tr>td:last').html($('#col').val());
                    $('#DynamicAddRowCols tbody tr').each(function () {
                        $(this).children('td:last').append('<td class="td"><input type="hidden" class="form-control form-select s_name" name="supplier_name[]" value='+$col_val+'><input type="text" class="form-control form-select txt" name="supplier_amount[]"></td>')
                        
                    });
                }
                else {
                    alert('Enter Text');
                }
                return false;
            });
        });
    </script>

    <!-- <script>
    $( document ).ready(function() {
    $(document).on('change', '.chk', function( e ) {
        //alert("asdasd");
        var $row = $(this).closest(".td");  // Gets a descendent with class="td"
    var $txtValue = $row.find(".txt").val();   //access the Texbox using the class
  
   //alert($txtValue);
    });
    });
           
           </script>   -->
     

</body>

</html>
        