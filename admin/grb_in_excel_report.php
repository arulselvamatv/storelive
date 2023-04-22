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
                            <h4 class="mb-0 text-white">GRB In Report</h4>
                            <button type="button" class="btn btn-default print-btn" id ="xls" data-dismiss="modal">Excel</button>
                            </div>
                    <form autocomplete="off"  action="grb_report_pdf.php"  target="_blank"  >
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                    <center>
							<div class="row pt-3">
								<div class = "row">
								<div class="col-lg-4" align="left">
									<label>From</label>
									<input type="date" class="form-control" id="from_date" name="from_date" placeholder="From Date">
								</div>

								<div class="col-lg-4" align="left">
									<label>To</label>
									<input type="date" class="form-control" id="to_date" name="to_date" placeholder="To Date">

								</div>
								
								<div class="col-lg-4" align="left">
									<label>Bill No</label>
									<input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Bill No">
								</div>
								</div>
								
								<div class = "row">
								<div class="col-lg-4" align="left">
									<label>Po No</label>
									<input type="text" class="form-control" id="po_nos" name="po_nos" placeholder="Po No">

								</div>
								
								<div class="col-lg-4" align="left">
									<label>Gst %</label>
									<select class="form-select js-example-basic-multiple" id="gst" name="gst" >
										<option value = "">Select Gst %</option>
										<option value = "1"> greater than 1%</option>
										<option value = "12"> greater than 12%</option>
										<option value = "18"> greater than 18%</option>
										<option value = "28"> greater than 28%</option>
                                    </select>
								</div> 
								<div class="col-lg-4" align="left">
									  <label>Supplier Name</label>
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
													<th class="text-center">Gst %</th>
													<th class="text-center">Gst Amount</th>
													<th class="text-center">Advance Amount</th>
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

<script type="text/javascript">
    function locationreload() {
        location.reload();       
    }
   </script>

<script type="text/javascript">
	
	$( document ).ready(function() {
	     var this_val = 1;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_grb_in_excel_report.php?po_no='+this_val,
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
			 var gst       = $( '#gst' ).val();
             if(from_date !="" || to_date !="" || sup_name !="" || bill_no!="" || po_nos!="" || gst!=""){
				 var this_val = 0;
				 } else{
				 var this_val = 1;
				}
             window.location.href = 'ajax/grb_in_excel_report.php?from_date='+from_date + '&to_date=' + to_date + '&sup_name=' + sup_name + '&bill_no=' + bill_no +  '&po_nos=' + po_nos + '&gst=' + gst + '&po_no=' + this_val;
            return false;
        });
       
    });
    
  function filter_data() {
            var error = 0;
            var from_date = $( '#from_date' ).val();
            var to_date   = $( '#to_date' ).val();
            var sup_name  = $( '#sup_name' ).val();
            var bill_no   = $( '#bill_no' ).val();
            var po_nos    = $( '#po_nos' ).val();
            var gst       = $( '#gst' ).val();

            var this_val = 0;
            $.ajax({
				type: "GET",
				url: 'ajax/ajax_grb_in_excel_report.php?from_date='+from_date + '&to_date=' + to_date + '&sup_name=' + sup_name + '&bill_no=' + bill_no +  '&po_nos=' + po_nos + '&gst=' + gst + '&po_no=' + this_val,
				success: function(data){
						$('#tbody1').html(data);
				   }
			});
        }
</script>




	<script>
	$(document).ready(function() {	
		   var gst = 1;
		   var gst_per = 10;
		    $(".total").each(function (index, element){
    			var total = $(element).val();
    			var gst_per = $('#gst_per').val();
    			var dec = (gst_per/100).toFixed(2); //its convert 10 into 0.10
    			var mult = Number(total)*Number(dec);
		        gst = Number(gst) + Number(mult);
			    $(".gst_amt").html(gst.toFixed(2));
			
		  });
		});
	</script>

</body>

</html>

        
