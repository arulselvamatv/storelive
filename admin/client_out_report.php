<?php

require_once("header.php");

?>

        <div class="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                <div class="card">

                    <div class="card-header bg-info">

                                <h4 class="mb-0 text-white">Store Out report</h4>

                            </div>

                    <form autocomplete="off" action="customer_out_report_pdf.php" target="_blank" >

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

                                            <div class="col-lg-2">
                                                <label>&nbsp</label>
                                                    <select class="js-example-basic-multiple w-100" id="client_name" name="client_name" >

                                                    <option value="">Select Client Name</option>

									                        <?php

								

                                                            require_once("database/connect.php");

                                                            $db=new Database;

                                                            $db->connect();

                                                            $asd =('SELECT `cl_id`, `dep_name` FROM `client` WHERE active_record=1');

                                                            //echo $asd; exit;

                                                            $datd = $db->query($asd);

                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))

                                                                {

                                                                    echo "<option value='".$data['cl_id']."'>".$data['dep_name']."</option>";

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

                                            <div class="table-responsive">

                                                <table class="table table-bordered" id="trn_dlr_pi_inv">

                                                  <thead>

                                                    <tr>

                                                    <th class="text-center">S.No.</th>

                                                    <th class="text-center">Date</th>

                                                    <th class="text-center">Client Name</th>

                                                    <th class="text-center">Product Name</th>

                                                    <th class="text-center">Qty</th>

                                                    </tr>

                                                  </thead>

                                                  <tbody id="tbody1">

                                            

                                                  </tbody>

                                                </table>

                                              </div>

                                        </div> 

                                    </div> 

                                </div>

                                

                                 <div class="col-lg-12 text-center mb-5" >

                                                <button class='btn btn-success' type='submit' onclick="return filter_data();" >Print Report</button>

                                                <button type="submit" onclick="return confirm('Do you really want to refresh your page?') , locationreload();" class="btn btn-success">Refresh</button>

                                </div>



                            </form>

                            

                        </div>

            </div>

        </div>

                    </div>



            </div>



    <?php require_once("footer.php");?>



    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->

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



<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->



    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->

    

    

    

     <script>

    function locationreload() {

        location.reload();

          

    }

   </script>



    

    

    

    

    

    

    <script>

    $( document ).ready(function() 

{

	     var this_val = 1;

        $.ajax({

				type: "GET",

				url: 'ajax/ajax_client_out_report.php?po_no='+this_val,

				success: function(data){

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

            var client_name = $( '#client_name' ).val();



            var this_val = 0;



            $.ajax({

				type: "GET",

				url: 'ajax/ajax_client_out_report.php?from_date='+from_date + '&to_date=' + to_date + '&client_name=' + client_name + '&po_no=' + this_val,

				success: function(data){

                    $('#tbody1').html(data);

				}

			});

        }

</script>



</body>

</html>

        