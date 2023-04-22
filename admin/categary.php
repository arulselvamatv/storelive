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

                        <div class="card">

                            <div class="card-header bg-info">

                                <h4 class="mb-0 text-white">Add category Details</h4>

                            </div>

                            <form id="categary" autocomplete="off">

                                

                                <div class="form-body">

                                    <div class="card-body">

                                        <div class="row pt-3">

                                            <div class="col-md-6 ">

                                                <div class="form-group">

                                                    <label class="form-label">Category Name</label>

                                                    <input class="form-control" type="text" id="c_name" name="c_name" required/>

                                                </div>

                                            </div>

                                           

                                        

                                        

                                        </div>  

                                        

                                        <div class="col-sm-12">

                                                            <center>

                                                            

                                                            <button type="button" id="button" class="btn btn-success">Submit</button>

                                                            

                                                            </center>

                                                            

                                                        </div>

                                    </div>   

                                </div>

                                <hr>

                                <?php

								

					require_once("database/connect.php");

					$db=new Database;

					$db->connect();

          $asd =('SELECT `ca_id`, `category_name`, `updated_no`, `active_record`, `date_time` FROM `category` WHERE `active_record`=1');

                    //echo $asd; exit;

                    $datd = $db->query($asd);

                    echo'<div class="px-4 pb-4"><b>Category Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';

                    echo "<thead><tr>";

                    echo "<th>S.No.</th>";

                      echo "<th>Category Name.</th>";

                      echo "<th>time_date</th>";

                      echo "</tr></thead><tbody>";

                      $sno=0;

                    while($row = $datd->fetch(PDO::FETCH_ASSOC))

                    {

                      echo "<tr>";

                      echo "<td>".$row['ca_id']."</td>";//".(++$sno).".

                      echo "<td>".$row['category_name']."</td>";

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

			

// 			jQuery.validator.addMethod("lettersonly", function(value, element) {

//   return this.optional(element) || /^[a-z]+$/i.test(value);

// }, "Alphabetic only allowed"); 

// var form1 = $('#categary');

//             var error1 = $('.alert-danger', form1);

//             var success1 = $('.alert-success', form1);



//             form1.validate({

//                 errorElement: 'span', //default input error message container

//                 errorClass: 'help-block help-block-error', // default input error message class

//                 focusInvalid: false, // do not focus the last invalid input

//                 ignore: "",  // validate all fields including form hidden input

              

//                 rules: {

//                     c_name: {

                       

//                         required: true

//                     }

					

                  

//                 },



//                 invalidHandler: function (event, validator) { //display error alert on form submit              

//                     success1.hide();

//                     error1.show();

//                     Metronic.scrollTo(error1, -200);

//                 },



//                 highlight: function (element) { // hightlight error inputs

//                     $(element)

//                         .closest('.form-group').addClass('has-error'); // set error class to the control group

//                 },



//                 unhighlight: function (element) { // revert the change done by hightlight

//                     $(element)

//                         .closest('.form-group').removeClass('has-error'); // set error class to the control group

//                 },



//                 success: function (label) {

//                     label

//                         .closest('.form-group').removeClass('has-error'); // set success class to the control group

//                 },



//                 submitHandler: function (form) {

//                     success1.show();

//                     error1.hide();

					

// 						var data = new FormData($(form)[0]);

// 	$.ajax

// 		(

// 			{

// 				//data : form.serialize(),

// 				url:'categary_back.php',

// 				data: data,

// 				cache: false,

// 				contentType: false,

// 				processData: false,

// 				type: 'POST',

// 				success: function (response)

// 				{

//                     if(response=="Category Details Entered Sucessfully.")

//                     {

//                         $('.form-control').val('');

//                         alert(response);	

//                         window.location="categary.php";

//                     }

//                     else if(response=="Error! Please try again.")

//                     {

//                         $('.form-control').val('');

//                         alert(response);	

//                         window.location="categary.php";

//                     }

//                     else

//                     {

//                         alert(response);	

//                     }

                   

								

// 				},

				

// 			}

// 		); 

					

//                 }

//             });
// --------------------------------------------


$(document).ready(function () { 
    $( "#button" ).click(function() {
        try { 
            if($('#c_name').val()=='') {
                $('#c_name').focus();
                throw "Enter categary Name";
                return false;
            }
            let myform = document.getElementById("categary");
            let data = new FormData(myform);
            
	        $.ajax({
				//data : form.serialize(),
				url:'categary_back.php',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success: function (response)
				{
                    if(response=="categary Detail Entered Sucessfully.")
                    {
                        $('.form-control').val('');
                        alert(response);	
                        window.location="categary.php";
                    }
                    else if(response=="Error! Please try again.")
                    {
                        $('.form-control').val('');
                        alert(response);	
                        window.location="categary.php";
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

        