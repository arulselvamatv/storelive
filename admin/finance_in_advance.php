<?php
require_once("header.php");
?>
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
                                <h4 class="mb-0 text-white">Finance Entry</h4>
                            </div>
					
								<!--<label class="control-label col-sm-4">Enter Invoice Number</label>-->
								<!--<div class="col-sm-8">-->
								
								<!--   <input type="text" name="po_no" id="po_no" class="form-control" style="width:100%;" onkeypress="view(event);"> -->
								  
								<!--</div>-->
							<div class="col-sm-12">		
								
								<div class="form-group">
								<div class="col-sm-8">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;<label class="control-label col-sm-4">Enter Dept Number</label>
                                <b><input type="text" name="po_no" id="po_no" class="form-control" style="width:200px;border:1px solid gray" onkeypress="view(event);"></b> 								  
								</div>	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
								
								
								</div>
						</div>
				
                                    <div id="update_div"></div>
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

<!--</form>-->
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>>
    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>
<script type="text/javascript">

function view(eve)
{
	$("#update_div").html("");
	
	var ee=eve.keyCode || eve.which;

	if(ee==13)
	{
		$.ajax({
		type: "GET",
		url: 'ajax/get_finance_advance.php?val='+$("#po_no").val(),
		success: function(data){
			
			$("#update_div").html(data);
			
		}
		});
			//$('#update_div').load('po_preview.php?pid='+$('#po_no').val());
	}
	
	
}
</script>
	<script>
	$(document).ready(function() {				
		
		//=====auto complete function while typing name =========
    
		// end of id search ===================
		Layout.init(); // init layout	
		});
	</script>
	

</body>

</html>	
	