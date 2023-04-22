
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
                                <h4 class="mb-0 text-white">Store Report</h4>
                            </div>
                            <div class="container my-5">
                            <div class="col-md-12 text-center " style="background-color:#E5f5f7;border:1px solid #C1f0f7;border-radius:5px ">
                                <form method="GET" action="store_stock_list_bycat.php"  target="_blank" >
                                    
                                <div class="row py-5">
                                     <div class="col-md-3 text-end h3 pt-1">Category Name :</div>
                                     <div class="col-md-3">
                            <?php
                                    echo '<select class="form-select asd"  name="unit" id="unit" required>
                                          <option value ="">Select Category </option>';
                                          $asd =('SELECT `ca_id`, `category_name`, `updated_no`, `active_record`,`date_time` FROM `category` WHERE `active_record`=1');
                                          //echo $asd; exit;
                                          $datd = $db->query($asd);
                                          while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                                          echo'<option value ="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                                         }
                            ?>
                            
                                 </select>
                                 </div>
                                  <div class="col-md-2">  
                                     <button type="submit" class="btn btn-primary px-4">VIEW</button> <br>
                                    </div>
                                    
                                     <div class="col-md-4" style="border-left:1px solid #84b0c2 ">  
                                     
                                     <a  href="store_all_stock.php"  type="submit" class="btn btn-info px-3" target="_blank">View Whole Store stock list </a>
                                     
                                     </div >
                                     </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    
                    </div>
                
                </div>

            </div>
              </div>
            <!-- ============================================================== -->
    <!--END continerfluid -->
    <?php require_once("footer.php");?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
 







 


    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    
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
    

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>

</html>