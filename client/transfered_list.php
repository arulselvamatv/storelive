<?php
require_once("header.php");
?>
<!--<!?php
         if(!empty($_REQUEST['se_no']))
        {
          
            $se_no=$_REQUEST['se_no'];
            
            $asd =('UPDATE store_entry SET tranf=1 WHERE `se_no`="'.$se_no.'"');
            $datd = $db->query($asd);
            if($datd)
            {
                echo('<script type="text/javascript">alert("Transfer Sucessfully"); window.location="transfer.php";</script>');
            }
            else
            {
                echo('<script type="text/javascript">alert("Error! Please try again."); window.location="transfer.php";</script>');
            }
        } 
        ?>-->
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
                                <h4 class="mb-0 text-white">Warrenty List</h4>
                            </div>
                                
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
                                                      <th class="text-center">From Department.</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">Supplier Name</th>
                                                      <th class="text-center">Select Client</th>
                                                      <th class="text-center">Button</th>
                                                     
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

                                <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Client Transfer History</h4>
                            </div>
                                
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                                

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="trn_dlr_pi_invv">
                                                  <thead>
                                                    <tr>
                                                      
                                                      <th class="text-center">Serial NO.</th>
                                                      <th class="text-center">Product Name</th>
                                                      <th class="text-center">From Department.</th>
                                                      <th class="text-center">Mode.</th>
                                                      <th class="text-center">To Department</th>
                                                     
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody1">
                                            
                                                  </tbody>
                                                </table>
                                              </div>
                                           
                                                   
                                        </div> 
                                        
                                       

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
				url: 'ajax/ajax_transferedl_list.php?se_no='+this_val,
				success: function(data){
					//alert(data);
                    $('#tbody').html(data);
                    
					
				}
			});
            $.ajax({
				type: "GET",
				url: 'ajax/ajax_transferedh_list.php?se_no='+this_val,
				success: function(data){
					//alert(data);
                    $('#tbody1').html(data);
                    
					
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

    


</body>

</html>
        