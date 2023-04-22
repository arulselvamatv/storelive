<?php

require_once("header.php");

if(!empty($_REQUEST['cl_id']))

{

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

                                <h4 class="mb-0 text-white">Edit Client</h4>

                            </div>

                            <form id="client_update" autocomplete="off">

                                

                                <div class="form-body">

                                    <div class="card-body">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT `cl_id`, `dep_name`, `room_no`, `block`, `date_time`, `active_record` FROM `client` WHERE active_record=1 and `cl_id`="'.$_REQUEST['cl_id'].'"');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                while($row = $datd->fetch(PDO::FETCH_ASSOC))

                                {

                                ?>

                                                <div class="form-group">

                                                    <label class="form-label">Department Name:</label>

                                                    <input type="hidden" class="form-control" id="e_cl_id" name="e_cl_id" value="<?php print $row['cl_id']?>" readonly="readonly">

                                                    <input type="text" class="form-control" id="e_dep_name" name="e_dep_name" value="<?php print $row['dep_name']?>" readonly="readonly">

                                                </div> 

                                                <div class="form-group">Block No:</label>

                                                    <input type="text" class="form-control" id="e_block" name="e_block" value="<?php print $row['block']?>">

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">Floor/Room No:</label>

                                                    <input type="text" class="form-control" id="e_room_no" name="e_room_no" value="<?php print $row['room_no']?>">

                                                </div> 

                                                

                                <?php

                                }

                                ?>  

                                        

                                        <div class="col-sm-12">

                                                            <center>

                                                            

                                                            <button type="submit" class="btn btn-success">Submit</button>

                                                            

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

<?php

}

else{

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

                                <h4 class="mb-0 text-white">Add Client</h4>

                            </div>

                            <form id="client" autocomplete="off">

                                

                                <div class="form-body">

                                    <div class="card-body">

                                                <div class="form-group">

                                                    <label class="form-label">Department Name:</label>

                                                    <input type="text" class="form-control" id="dep_name" name="dep_name">

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">Block No:</label>

                                                    <input type="text" class="form-control" id="block" name="block">

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">Floor/Room No:</label>

                                                    <input type="text" class="form-control" id="room_no" name="room_no">

                                                </div> 

                                                

                                       

                                        

                                        <div class="col-sm-12">

                                                            <center>

                                                            

                                                            <button type="submit" class="btn btn-success">Submit</button>

                                                            

                                                            </center>

                                                            

                                        </div>



                                    </div> 

                                    <!-- card body ended   -->

                                </div>

                                <!-- form body ended -->

                                <hr>

                                <?php

								

					require_once("database/connect.php");

					$db=new Database;

					$db->connect();

                   $asd =('SELECT `cl_id`, `dep_name`, room_no, block, `date_time`, `active_record` FROM `client` WHERE `active_record`=1');

                    //echo $asd; exit;

                    $datd = $db->query($asd);

                    echo'<div class="px-4 py-4"><b>Client Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';

                    echo "<thead><tr>";

                    echo "<th>S.No.</th>";

                    echo "<th>Department Name.</th>";

                    echo "<th>Block No.</th>";

                    echo "<th>Floor/Room No.</th>";

                    echo "<th>Edit.</th>";

                    echo "</tr></thead><tbody>";

                    $sno=0;

                   // $sno++;

                    while($row = $datd->fetch(PDO::FETCH_ASSOC))

                    {
                       // $sno++;

                      echo "<tr>";

                      echo "<td>".(++$sno).".</td>";//".(++$sno).".

                      echo "<td>".$row['dep_name']."</td>";

                      echo "<td>".$row['block']."</td>";

                      echo "<td>".$row['room_no']."</td>";

                      echo "<td><div id='outer'>

                      <center>

                      <a href='?cl_id=".$row['cl_id']."'><div class='inner'><input class='btn btn-primary editz' name='edit-button[]' id='edit-button_".$row['cl_id']."' value='Edit' style='display:block' /></div></a>

                      </center>

                      </div></td>";

                      echo "</tr>";

                    }

                    echo "</tbody></table></div>";

          ?>

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

<?php

}

?>

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

    

    

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>

    <!-- INSERT FORM VALIDATON -->

    <script>

        // for more info visit the official plugin documentation: 

            // http://docs.jquery.com/Plugins/Validation

			

	jQuery.validator.addMethod("lettersonly", function(value, element) {

  return this.optional(element) || /^[a-z]+$/i.test(value);

}, "Alphabetic only allowed"); 

var form1 = $('#client');

            var error1 = $('.alert-danger', form1);

            var success1 = $('.alert-success', form1);



            form1.validate({

                errorElement: 'span', //default input error message container

                errorClass: 'help-block help-block-error', // default input error message class

                focusInvalid: false, // do not focus the last invalid input

                ignore: "",  // validate all fields including form hidden input

              

                rules: {

                    // dep_name: {

                       

                    //     required: true

                    // }

					

                  

                },



                invalidHandler: function (event, validator) { //display error alert on form submit              

                    success1.hide();

                    error1.show();

                    Metronic.scrollTo(error1, -200);

                },



                highlight: function (element) { // hightlight error inputs

                    $(element)

                        .closest('.form-group').addClass('has-error'); // set error class to the control group

                },



                unhighlight: function (element) { // revert the change done by hightlight

                    $(element)

                        .closest('.form-group').removeClass('has-error'); // set error class to the control group

                },



                success: function (label) {

                    label

                        .closest('.form-group').removeClass('has-error'); // set success class to the control group

                },



                submitHandler: function (form) {

                    success1.show();

                    error1.hide();

					

						var data = new FormData($(form)[0]);

	$.ajax

		(

			{

				//data : form.serialize(),

				url:'client_back.php',

				data: data,

				cache: false,

				contentType: false,

				processData: false,

				type: 'POST',

				success: function (response)

				{

                    if(response=="Client Details Stored Sucessfully.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client.php";

                    }

                    else if(response=="Error! Please try again.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client.php";

                    }

                    else

                    {

                        alert(response); 

                    }

                    

								

				},

				

			}

		); 

					

                }

            });



</script>

<!-- INSERT FORM VALIDATION END -->

<!-- EDIT FORM VALIDATON -->

<script>

        // for more info visit the official plugin documentation: 

            // http://docs.jquery.com/Plugins/Validation

			

			jQuery.validator.addMethod("lettersonly", function(value, element) {

  return this.optional(element) || /^[a-z]+$/i.test(value);

}, "Alphabetic only allowed"); 

var form1 = $('#client_update');

            var error1 = $('.alert-danger', form1);

            var success1 = $('.alert-success', form1);



            form1.validate({

                errorElement: 'span', //default input error message container

                errorClass: 'help-block help-block-error', // default input error message class

                focusInvalid: false, // do not focus the last invalid input

                ignore: "",  // validate all fields including form hidden input

              

                rules: {

                    // dep_name: {

                       

                    //     required: true

                    // }

					

                  

                },



                invalidHandler: function (event, validator) { //display error alert on form submit              

                    success1.hide();

                    error1.show();

                    Metronic.scrollTo(error1, -200);

                },



                highlight: function (element) { // hightlight error inputs

                    $(element)

                        .closest('.form-group').addClass('has-error'); // set error class to the control group

                },



                unhighlight: function (element) { // revert the change done by hightlight

                    $(element)

                        .closest('.form-group').removeClass('has-error'); // set error class to the control group

                },



                success: function (label) {

                    label

                        .closest('.form-group').removeClass('has-error'); // set success class to the control group

                },



                submitHandler: function (form) {

                    success1.show();

                    error1.hide();

					

						var data = new FormData($(form)[0]);

	$.ajax

		(

			{

				//data : form.serialize(),

				url:'client_update_back.php',

				data: data,

				cache: false,

				contentType: false,

				processData: false,

				type: 'POST',

				success: function (response)

				{

                    if(response=="Client Details Updated Sucessfully.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client.php";

                    }

                    else if(response=="Error! Please try again.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client.php";

                    }

                    else

                    {

                        alert(response); 

                    }

                    

								

				},

				

			}

		); 

					

                }

            });



</script>

<!-- EDIT FORM VALIDATION END -->

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

        <!-- DATATABLES -->



</body>



</html>

        