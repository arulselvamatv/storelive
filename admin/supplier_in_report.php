<?php
require_once("header.php");
?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Supplier In report</h4>
                            </div>
                    <form autocomplete="off"  action="suplier_report_pdf.php"  target="_blank"  >
                        <!--action="supplier_report_pdf"-->
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                    <center>
                                        <div class="row pt-3">
                                            <div class="col-lg-2" align="left">
                                                <label>From</label>
                                                <input type="date" class="form-control" id="from_date" name="from_date" placeholder="From Date">
                                            </div>

                                            <div class="col-lg-2" align="left">
                                                <label>To</label>
                                                <input type="date" class="form-control" id="to_date" name="to_date" placeholder="To Date">

                                            </div>
                                            
                                            <div class="col-lg-2" align="left">
                                                <label>Bill No</label>
                                                <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Bill no">

                                            </div>
                                            
                                            
                                             <div class="col-lg-2" align="left">
                                                <label>Po No</label>
                                                <input type="text" class="form-control" id="dep_no" name="dep_no" placeholder="Po no">

                                            </div>
                                            
                                            
                                            <div class="col-lg-2">
                                                  <label>&nbsp</label>
                                                    <select class="form-select js-example-basic-multiple" id="sup_name" name="sup_name" >
                                                    <option value="">Select Supplier Name</option>
									                        <?php
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            $asd =('SELECT `sup_id`, `name` FROM `suplier` WHERE active_record=1');
                                                            //echo $asd; exit;
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo "<option value='".$data['sup_id']."'>".$data['name']."</option>";
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
                                                <table class="table table-bordered" id="trn_dlr_pi_inv" target=”_blank” > 
                                                  <thead>
                                                    <tr>
                                                    <th class="text-center">S.No.</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">po Number</th > 
                                                    <th class="text-center">Bill Number</th>
                                                    <th class="text-center">Supplier Name</th>
                                                    <th class="text-center">Product Name</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">suplier amount </th>
                                                    <th class="text-center">Discount amount </th>
                                                    <th class="text-center">Gst Amount</th>
                                                    <th class="text-center">Total</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody1">
                                                  </tbody>
                                                </table>
                                              </div>
                                              <div class="table-responsive" id="filteredTable">
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
            
    <?php require_once("footer.php");?>
    
    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <script src="dist/js/custom.min.js"></script>



    <!-- This page plugins -->

    <script src="dist/js/pages/jasny-bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script> 

  <script>
    function locationreload() {
        location.reload();       
    }
   </script>
   
    <script>
    $( document ).ready(function() {
	     var this_val = 1;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_supplier_in_report.php?po_no='+this_val,
				success: function(data){
					$('#notFiltered').show();
                    $('#filteredTable').hide();
                    $('#tbody1').html(data);
				}
			});          
    $('.js-example-basic-multiple').select2();
        });

        function filter_data() 
        {
            var error = 0;
            var from_date = $( '#from_date' ).val();
            var to_date = $( '#to_date' ).val();
            var sup_name = $( '#sup_name' ).val();
            var bill_no = $( '#bill_no' ).val();
            var dep_no = $( '#dep_no' ).val();
              
            //alert(bill_no);exit;

            var this_val = 0;
            $.ajax({
				type: "GET",
				url: 'ajax/ajax_supplier_in_report.php?from_date='+from_date + '&to_date=' + to_date + '&sup_name=' + sup_name + '&bill_no=' + bill_no +  '&dep_no=' + dep_no + '&po_no=' + this_val,
				success: function(data){
					if(from_date !="" || to_date !="" || sup_name !="" || bill_no !="" || dep_no !="")
					{
						$('#notFiltered').hide();
						$('#filteredTable').show().html(data);
					}
					else
					{
						$('#notFiltered').show();
						$('#filteredTable').hide();
						$('#tbody1').html(data);
					}
				}
			});
        }

</script>
</body>

</html>

        
