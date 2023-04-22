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
                                <h4 class="mb-0 text-white">Add Product Invoice</h4>
                            </div>
                            <form id="po" action="pi_back.php" method="POST"  autocomplete="off">
                                <div class="card-body">
                                    <h4 class="card-title">Add Product Invoice</h4>
                                </div>
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">Product Invoice NO:</label>
                                                    <input type="text" class="form-control form-select" id="po_no" name="po_no" list="po_no_list">
                                                    <datalist id="po_no_list">
									                        <?php
								
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            $asd =('SELECT  `po_no` FROM `po_quotation` WHERE active_record=1 ');
                                                            //echo $asd; exit;
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo "<option value='".$data['po_no']."'>".''.$data['po_no']."</option>";
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
                                                      <th class="text-center">Quotation No</th>
                                                      <th class="text-center">Po No</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Quantity</th>
                                                      <th class="text-center">Specification needed</th>
                                                      <th class="text-center">Suplier Name</th>
                                                      <th class="text-center">Rate</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody>
                                                </table>
                                              </div>
                                                   
                                        </div> 
                                        
                                        <div class="col-sm-12">
                                                            <center>
                                                            
                                                            <button type="submit" class="btn btn-primary">Add To Store</button>
                                                            
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script>
    $( document ).ready(function() {
    $(document).on('change', '#po_no', function( e ) {
	    var this_val = $.trim($(this).val());
        
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_pi.php?po_no='+this_val,
				success: function(data){
					//alert(data);
                    $('#tbody').html(data);
                    
					
				}
			});
            //var this_mobile = $.trim($('#name').find(':selected').attr("data-mobile"));
          
    });
    });
    </script>
    

</body>

</html>
        