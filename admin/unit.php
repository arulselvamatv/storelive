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

                                <h4 class="mb-0 text-white">Add Unit</h4>

                            </div>

                            <form id="unit" autocomplete="off">

                                

                                <div class="form-body">

                                    <div class="card-body">

                                        <div class="row pt-3">

                                            <div class="col-md-6 ">

                                                <div class="form-group">

                                                    <label class="form-label">Unit Name</label>

                                                    <input class="form-control" type="text" id="u_name" name="u_name" />

                                                </div>

                                            </div>

                                           

                                        

                                        

                                        </div>  

                                        

                                        <div class="col-sm-12">

                                                            <center>

                                                            
 
                                                            <button type="button"  id="button" class="btn btn-success">Submit</button>

                                                            

                                                            </center>

                                                            

                                                        </div>

                                    </div>   

                                </div>

                                <hr>

                                <?php

								

					require_once("database/connect.php");

					$db=new Database;

					$db->connect();

          $asd =('SELECT `u_id`, `u_name`, `active_record`, `date_time` FROM `unit` WHERE `active_record`=1');

                    //echo $asd; exit;

                    $datd = $db->query($asd);

                    echo'<div class="p-5"><b>Unit Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';

                    echo "<thead><tr>";

                    echo "<th>S.No.</th>";

                      echo "<th>Unit Name.</th>";

                      echo "<th>time_date</th>";

                      echo "</tr></thead><tbody>";

                      $sno=0;

                    while($row = $datd->fetch(PDO::FETCH_ASSOC))

                    {

                      echo "<tr>";

                      echo "<td>".(++$sno).".</td>";//".(++$sno).".

                      echo "<td>".$row['u_name']."</td>";

                      echo "<td>".$row['date_time']."</td>";

                      echo "</tr>";

                    }

                    echo "</tbody></table></div>";

          ?>

                            </form>

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

   </div>

    <!-- ============================================================== -->

    <!-- End Wrapper -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- All Jquery -->

    <!-- ============================================================== -->

    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->



    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>

    <script src="assets/datatable/jquery.dataTables.min.js"></script>

    <script src="assets/datatable/buttons.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

    

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

    <!-- DATATABLES -->

    <script>

          $(document).ready(function () {

    // Setup - add a text input to each footer cell

    $('#trn_dlr_pi_inv thead tr')

        .clone(true)

        .addClass('filters')

        .appendTo('#trn_dlr_pi_inv thead');

 

    var table = $('#trn_dlr_pi_inv').DataTable({

        orderCellsTop: true,

        fixedHeader: true,

        initComplete: function () {

            var api = this.api();

 

            // For each column

            api

                .columns()

                .eq(0)

                .each(function (colIdx) {

                    // Set the header cell to contain the input element

                    var cell = $('.filters th').eq(

                        $(api.column(colIdx).header()).index()

                    );

                    var title = $(cell).text();

                    $(cell).html('<input type="text" placeholder="' + title + '" />');

 

                    // On every keypress in this input

                    $(

                        'input',

                        $('.filters th').eq($(api.column(colIdx).header()).index())

                    )

                        .off('keyup change')

                        .on('keyup change', function (e) {

                            e.stopPropagation();

 

                            // Get the search value

                            $(this).attr('title', $(this).val());

                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

 

                            var cursorPosition = this.selectionStart;

                            // Search the column for that value

                            api

                                .column(colIdx)

                                .search(

                                    this.value != ''

                                        ? regexr.replace('{search}', '(((' + this.value + ')))')

                                        : '',

                                    this.value != '',

                                    this.value == ''

                                )

                                .draw();

 

                            $(this)

                                .focus()[0]

                                .setSelectionRange(cursorPosition, cursorPosition);

                        });

                });

        },

    });

});

        </script>

        <!--DATATABLES END  -->

        <!-- INSERT FORM VALIDATION -->

<script>

        // for more info visit the official plugin documentation: 

            // http://docs.jquery.com/Plugins/Validation

			

			$(document).ready(function () { 
    $( "#button" ).click(function() {
        try { 
            if($('#u_name').val()=='') {
                $('#u_name').focus();
                throw "Enter Unit Name";
                return false;
            }
            let myform = document.getElementById("unit");
            let data = new FormData(myform);
            
	        $.ajax({
				//data : form.serialize(),
				url:'unit_back.php',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success: function (response)
				{
                    if(response=="Unit Detail Entered Sucessfully.")
                    {
                        $('.form-control').val('');
                        alert(response);	
                        window.location="unit.php";
                    }
                    else if(response=="Error! Please try again.")
                    {
                        $('.form-control').val('');
                        alert(response);	
                        window.location="unit.php";
                    }
                    else
                    {
                        alert(response);	
                    }
                   
								
				}
				
			}); 

            return true;
        }catch(e){
            alert(e);
            return false;
        }
    });
});

        



    </script>

     <!-- INSERT FORM VALIDATION END -->

</body>



</html>

        