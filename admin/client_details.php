<?php

require_once("header.php");

if(!empty($_REQUEST['cl_id']))

{

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

                                <h4 class="mb-0 text-white">Edit Client Details</h4>

                            </div>

                            <form id="client_details_update" autocomplete="off">

                            <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT cl.id,c.`dep_name`, cl.`email`, cl.`pass`, `last_login` FROM `clientusers` as cl 

                                inner join client as c on c.cl_id = cl.dep_name 

                                where active_record=1 and cl.id="'.$_REQUEST['cl_id'].'"');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                while($row = $datd->fetch(PDO::FETCH_ASSOC))

                                {

                                ?> 

                                <div class="form-body">

                                    <div class="card-body">

                                                <div class="form-group">

                                                    <label class="form-label">Department Name:</label>

                                                    <input type="text" class="form-control" id="e_dep_name" name="e_dep_name" value="<?php print $row['dep_name']?>" readonly="readonly"/>

                                                    <input type="hidden" class="form-control" id="e_dep_id" name="e_dep_id" value="<?php print $row['id']?>"/>

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">User ID:</label>

                                                    <input type="text" class="form-control" id="e_usr_name" name="e_usr_name" value="<?php print $row['email']?>" readonly="readonly"/>

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">Password:</label>

                                                    <input type="text" class="form-control" id="e_pass" name="e_pass" value="<?php print $row['pass']?>" required/>

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

                                <hr>

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

                                <h4 class="mb-0 text-white">Add Client Details</h4>

                            </div>

                            <form id="client_details" autocomplete="off">

                                

                                <div class="form-body">

                                    <div class="card-body">

                                                <div class="form-group">

                                                    <label class="form-label">Department Name:</label>

                                                    <select type="text" class="form-control js-example-basic-multiple" id="dep_name" name="dep_name" required>

                                                    <option value="">Select Department</option>"

									                        <?php

								

                                                            require_once("database/connect.php");

                                                            $db=new Database;

                                                            $db->connect();

                                                            $asd =('SELECT  cl_id, `dep_name`, `block`, `room_no` FROM `client` WHERE active_record=1');

                                                            //echo $asd; exit;

                                                            $datd = $db->query($asd);

                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))

                                                                {

                                                                    echo "<option value='".$data['cl_id']."'>".'[Dep:'.$data['dep_name'].'] [Block:'.$data['block'].'] [Room:'.$data['room_no'].']'."</option>";

                                                                }



								

									                        ?>

									                    </select> 

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">User ID:</label>

                                                    <input type="text" class="form-control" id="usr_name" name="usr_name" required/>

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">Password:</label>

                                                    <input type="text" class="form-control" id="pass" name="pass" required/>

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

                    $asd =('SELECT cl.id,c.`dep_name`, cl.`email`, cl.`pass`, `last_login` FROM `clientusers` as cl 

                    inner join client as c on c.cl_id = cl.dep_name');

                    //echo $asd; exit;

                    $datd = $db->query($asd);

                    echo'<div class="px-4 py-4"><b>Client Details Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" cellpadding="5" class="table table-bordered table-responsive">';

                    echo "<thead><tr>";

                    echo "<th>S.No.</th>";

                      echo "<th>Department Name.</th>";

                      echo "<th>Email.</th>";

                      echo "<th>Password.</th>";

                      echo "<th>last_login</th>";

                      echo "<th>Edit</th>";

                      echo "</tr></thead><tbody>";

                      $sno=0;

                    while($row = $datd->fetch(PDO::FETCH_ASSOC))

                    {

                      echo "<tr>";

                      echo "<td>".(++$sno).".</td>";//".(++$sno).".

                      echo "<td>".$row['dep_name']."</td>";

                      echo "<td>".$row['email']."</td>";

                      echo "<td>".$row['pass']."</td>";

                      echo "<td>".$row['last_login']."</td>";

                      echo "<td><div id='outer'>

                      <center>

                      <a href='?cl_id=".$row['id']."'><div class='inner'><input class='btn btn-primary editz' name='edit-button[]' id='edit-button_".$row['id']."' value='Edit' style='display:block' /></div></a>

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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <script src="assets/auto.js"></script>

	<script src="assets/autocomplete.js"></script>

    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />

    <script src="assets/global/plugins/select2/js/select2.min.js"></script>

    <script src="assets/datatable/jquery.dataTables.min.js"></script>

    <script src="assets/datatable/buttons.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>

    

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>

    <!-- SELECT 2 -->

    <script>

 $( document ).ready(function() {

                $('.js-example-basic-multiple').select2();

            });



    </script> 

    <style>

	#commentForm {

		width: 500px;

	}

	#commentForm label {

		width: 250px;

	}

	#commentForm label.error, #commentForm input.submit {

		margin-left: 253px;

	}

    </style>

    <!-- SELECT 2 END-->

     <!-- INSERT FORM VALIDATON -->

     <script>

        // for more info visit the official plugin documentation: 

            // http://docs.jquery.com/Plugins/Validation

			

			jQuery.validator.addMethod("lettersonly", function(value, element) {

  return this.optional(element) || /^[a-z]+$/i.test(value);

}, "Alphabetic only allowed"); 

var form1 = $('#client_details');

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

				url:'client_details_back.php',

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

                        window.location="client_details.php";

                    }

                    else if(response=="Error! Please try again.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client_details.php";

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

var form1 = $('#client_details_update');

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

				url:'client_details_update_back.php',

				data: data,

				cache: false,

				contentType: false,

				processData: false,

				type: 'POST',

				success: function (response)

				{

                    if(response=="Client Password Updated Sucessfully.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client_details.php";

                    }

                    else if(response=="Error! Please try again.")

                    {

                        $('.form-control').val('');

                        alert(response); 

                        window.location="client_details.php";

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

<!-- DATATABLES END -->

</body>



</html>

        