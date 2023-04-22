<?php
require_once("header.php");

?>

<style>
.print-btn {
        color: rgb(255 255 255 / 80%);
        background-color: green;
        border: 5px solid transparent;
        float: right;
 }
 </style>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info">
                            <h4 class="mb-0 text-white">Store In Report</h4>
                            <button type="button" class="btn btn-default print-btn" id ="xls" data-dismiss="modal">Excel</button>
                            </div>
                    <form autocomplete="off"  action="store_in_report_pdf.php"  target="_blank"  >
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                   <center>
							<div class="row pt-3">
								<div class="col-lg-3" align="left">
									<label>From</label>
									<input type="date" class="form-control" id="from_date" name="from_date" placeholder="From Date">
								</div>

								<div class="col-lg-3" align="left">
									<label>To</label>
									<input type="date" class="form-control" id="to_date" name="to_date" placeholder="To Date">

								</div>
								
								<div class="col-lg-4" align="left">
									<label>Bill No</label>
									<input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Bill No">
								</div>
								
												
												</div>
												
								<div class="row pt-3">
								    
								    
								    	<div class="col-lg-4" align="left">
									<label>Po No</label>
									<input type="text" class="form-control" id="po_nos" name="po_nos" placeholder="Po No">

								</div>
								    
								    
								    <div class="col-lg-3">
									  <label>&nbsp</label>
										<select class="form-select js-example-basic-multiple" id="sup_name" name="sup_name" >
										<option value="">Select Supplier Name</option>
												<?php
												require_once("database/connect.php");
												$db=new Database;
												$db->connect();
												$asd =('SELECT `sup_id`, `name`,`company_name` FROM `suplier` WHERE active_record=1');
												//echo $asd; exit;
												$datd = $db->query($asd);
												while($data=$datd->fetch(PDO::FETCH_ASSOC))
													{
														echo "<option value='".$data['sup_id']."'>".$data['company_name']."</option>";
													}
												?>
											</select> 
												</div>
								<div class="col-lg-2 text-start">
									   <br>
									<input class='btn btn-success btn-sm px-5' type='button' onclick="return filter_data();" value='Go'>
								</div>

							</div>
						</center>
								<div class="row pt-3">  
									<div class="table-responsive" id="notFiltered">
									   <table class="table table-bordered" id="store_in_report">
                                    <thead>
										<tr>
											<th class="text-center">S.No.</th>
											<th class="text-center">Inward No / Date</th>
											<th class="text-center">Name of the Department</th>
											<th class="text-center">Name of the Supplier</th>
											<th class="text-center">Bill No & Date</th>
											<th class="text-center">Amount in Price</th>
											<th class="text-center">PO No</th>
											<th class="text-center">Received from Store Signature with Date</th>
											<th class="text-center">Given to Store Signature with Date</th>
										</tr>
                                    </thead>
                                    <tbody id="tbody1">
									  </tbody>
									</table>
                                              </div>
                                              </div>
                                        </div> 
                                    </div> 
                                </div>

                                <div class="col-lg-12 text-center mb-5">
                                    <button class='btn btn-success ' type='submit' onclick="return filter_data();" >Print Report </button>
                                     <button type="submit" onclick="return confirm('Do you really want to refresh your page?') , locationreload();" class="btn btn-success ">Refresh</button>
                                </div>
                            </form>
                        </div>
            </div>
        </div>
                    </div>
            </div>
            
   <?php require_once("footer.php"); ?>
 
 
<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/waves.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
<script src="dist/js/custom.min.js"></script>

<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<script src="dist/js/pages/jasny-bootstrap.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"/>
<script src="assets/global/plugins/select2/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/datatables/select/css/select.dataTables.min.css"/>

<script src="assets/datatables/datatables.min.js"></script>
<script src="assets/datatables/select/js/dataTables.select.min.js"></script>

<script>
    function locationreload() {
        location.reload();       
    }
   </script>

<script type="text/javascript">
	
	$( document ).ready(function() {
	     var this_val = 1;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_store_in_excel_report.php?po_no='+this_val,
				success: function(data){
                   $('#tbody1').html(data);
				}
			});          
    $('.js-example-basic-multiple').select2();
        });
	
	
	
    $(document).ready(function () {
        $('#xls').click(function (event) {
            event.preventDefault();
             var this_val = 0;
             var from_date = $( '#from_date' ).val();
             var to_date = $( '#to_date' ).val();
             var sup_name = $( '#sup_name' ).val();
             var bill_no   = $( '#bill_no' ).val();
			 var po_nos    = $( '#po_nos' ).val();
             if(from_date !="" || to_date !="" || sup_name !="" || bill_no!="" || po_nos!="" ){
				 var this_val = 0;
				 } else{
				 var this_val = 1;
				}
             window.location.href = 'ajax/store_in_excel_report.php?from_date='+from_date + '&to_date=' + to_date + '&sup_name=' + sup_name + '&bill_no=' + bill_no +  '&po_nos=' + po_nos + '&po_no=' + this_val;
            return false;
        });
       
    });
    
  function filter_data() {
            var error = 0;
            var from_date = $( '#from_date' ).val();
            var to_date = $( '#to_date' ).val();
            var sup_name = $( '#sup_name' ).val();
            var bill_no   = $( '#bill_no' ).val();
            var po_nos    = $( '#po_nos' ).val();

            var this_val = 0;
            $.ajax({
				type: "GET",
				url: 'ajax/ajax_store_in_excel_report.php?from_date='+from_date + '&to_date=' + to_date + '&sup_name=' + sup_name + '&bill_no=' + bill_no +  '&po_nos=' + po_nos + '&po_no=' + this_val,
				success: function(data){
						$('#tbody1').html(data);
				   }
			});
        }
</script>

</body>

</html>

        
