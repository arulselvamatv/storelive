<?php

require_once("header.php");

require_once("database/connect.php");

$db = new Database;

$db->connect();

?>

<!-- ============================================================== -->

<!-- End Left Sidebar - style you can find in sidebar.scss  -->

<!-- ============================================================== -->

<!-- ============================================================== -->

<!-- Page wrapper  -->

<!-- ============================================================== -->

<div class="page-wrapper">

    <?php if (!empty($_REQUEST['serial_no'])): ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                    <div class="card">

                        <div class="card-header bg-info"><h4 class="mb-0 text-white">Edit Quotation Details</h4></div>

                        <?php

                        $quo = ('SELECT `qu_id`, `pro_id`, `pro_name`,  `pro_quantity`, `pro_unit`, `pro_spec`, `active_record`, `time_date` FROM `quotation` where active_record=1 and serial_no="' . $_REQUEST['serial_no'] . '"');

                        // echo $quo;

                        $datd = $db->query($quo);



                        $max_pro_data = $db->query("SELECT MAX(`pro_id`) as max_pro_id, `code` FROM `quotation` where active_record=1 and serial_no='" . $_REQUEST['serial_no'] . "'")->fetch();

                        $edt_max_prod = (isset($_REQUEST['serial_no']) && !empty($_REQUEST['serial_no']) && !empty($max_pro_data['max_pro_id'])) ? ($max_pro_data['max_pro_id']) : '1';



                        ?>

                        <form id="quotation_update" autocomplete="off">

                            <input class="form-control" type="hidden" name="serial_no" value="<?php echo $_REQUEST['serial_no']; ?>">

                            <input class="form-control" type="hidden" name="nxt_pro_id" value="<?= $max_pro_data['max_pro_id']; ?>">

                            <input class="form-control" type="hidden" name="pro_code" value="<?= $max_pro_data['code']; ?>">

                            <div class="form-body">

                                <div class="card-body">

                                    <div class="row pt-3">

                                        <div class="table-responsive">

                                            <table class="table table-bordered">

                                                <thead>

                                                <tr>

                                                    <th class="text-center">No</th>

                                                    <th class="text-center">Product Name</th>

                                                    <th class="text-center">Quantity</th>

                                                    <th class="text-center">Specification needed</th>

                                                    <th class="text-center">Remove Row</th>

                                                </tr>

                                                </thead>

                                                <tbody id="tbody" class="edit_tbody">

                                                <?php

                                                while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {

                                                    // var_dump($row);

                                                    ?>

                                                    <tr id="1">

                                                        <td class="row-index text-center">

                                                            <input class="form-control" type="hidden" id="e_pro_id_<?= $row['pro_id']; ?>" name="e_pro_id[]" value="<?= $row['pro_id']; ?>">

                                                            <p><?php print $row['qu_id'] ?></p>

                                                        </td>

                                                        <td class="row-index text-center">

                                                            <select class="js-example-basic-single name form-control" id="e_pro_name_<?= $row['pro_id']; ?>" name="e_pro_name[]" style="width:250px;">

                                                                <?php

                                                                $quo = ('SELECT pdi.`pro_code`,pdi.`pro_name`, pdi.`pro_desc`, (pdi.`unit`) as unit FROM `product_details_info` as pdi inner JOIN product_details as pd on pd.`pro_id` = pdi.`pro_id` WHERE  pdi.`active_record` = 1 ');

                                                                $qdatd = $db->query($quo);

                                                                while ($data = $qdatd->fetch(PDO::FETCH_ASSOC)) {

                                                                    $unit = $data['unit'];

                                                                    echo "<option value='" . $data['pro_code'] . " - " . $data['pro_name'] . "'  " . (($data['pro_code'] . " - " . $data['pro_name']) == $row['pro_name'] ? 'selected' : '') . "    data-unit='" . $data['unit'] . "' data-pro_desc='" . $data['pro_desc'] . "'>" . '' . $data['pro_code'] . " - " . $data['pro_name'] . "</option>";

                                                                }

                                                                ?>

                                                            </select>

                                                        </td>

                                                        <td class="row-index text-center">

                                                            <input type="number" id="e_pro_quantity_<?= $row['pro_id']; ?>" name="e_pro_quantity[]" size="2" value="<?php print $row['pro_quantity'] ?>">



                                                            <!--<input type="text" class="unit" id="e_pro_unit_<?= $row['pro_id']; ?>" name="e_pro_unit[]" size="2" value="<!?php print $row['pro_unit'] ?>" readonly>-->

                                                            <select class="js-example-basic-single form-control"  id="e_pro_unit_<?= $row['pro_id']; ?>" name="e_pro_unit[]" style="width:100px;">

                                							<option value ="">Select Unit</option>';

                                							<?php

                                							$asda =('SELECT `u_id`, `u_name`, `date_time`, `active_record` FROM `unit` WHERE `active_record`=1');

                                							//echo $asd; exit;

                                							$datda = $db->query($asda);

                                							while($rowa = $datda->fetch(PDO::FETCH_ASSOC))

                                							{

                                							    $qty=$row['pro_unit'];

                                							    $qty1=$rowa['u_name'];

                                							    ?>

                                							    

                                							<option value ="<?php echo $rowa['u_name']; ?>" <?php if($qty==$qty1){ echo 'selected'; }?> ><?php echo $rowa['u_name'];?></option>

                                							<?php

                                							}

                                							?>

                                						</select>

                                                        </td>

                                                        <td class="row-index text-center">

                                                            <input class="form-control" type="text" id="e_pro_spec_<?= $row['pro_id']; ?>" name="e_pro_spec[]" value="<?php print $row['pro_spec'] ?>">

                                                        </td>

                                                        <td class="text-center">

                                                            <button class="btn btn-danger remove" type="button">Remove</button>

                                                        </td>

                                                    </tr>

                                                <?php } ?>

                                                </tbody>

                                            </table>

                                        </div>

                                        <!-- table responsive   -->

                                    </div>

                                    <div class="col-sm-12">

                                        <center>

                                            <button class="btn btn-md btn-primary" id="editBtn" type="button"> Add new Row</button>

                                            <button type="submit" class="btn btn-success">Submit</button>

                                        </center>

                                    </div>

                                </div>

                                <!-- card body ended   -->

                            </div>

                        </form>



                    </div>

                </div>

            </div>

                    </div>

    <?php else: ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="card"></br></br>

                    <div class="card-header bg-info"><h4 class="mb-0 text-white">Add Quotation</h4></div>

                    <form id="quotion" method="POST" autocomplete="off">

                        <div class="form-body">

                            <div class="card-body">

                                <div class="row pt-3">

                                    <!--/span-->

                                    <div class="table-responsive">


                                    <div class="col-md-3">
                                        <div class="form-group">
                                                <label class="form-label m-2">Bill type<span style="color: red"> *</span></label>
                                                    <select class=" form-select" name="bill_type" id="bill_type">
                                                        <option value="">Select Bill Type</option>
                                                        <option value="purchaseorder">Purchase order</option>
									                    <option value="serviceorder">Services Order</option>
                                                    </select>
                                        </div>
                                    </div>





                                        <table class="table table-bordered">

                                            <thead>

                                            <tr>

                                                <th class="text-center">No</th>

                                                <th class="text-center">Product Name</th>

                                                <th class="text-center">Quantity</th>

                                                <th class="text-center">Specification needed</th>

                                                <th class="text-center">Remove Row</th>

                                            </tr>

                                            </thead>

                                            <tbody id="tbody">

                                            <tr id="1">

                                                <td class="row-index text-center">

                                                    <input class="form-control" type="hidden" id="pro_id_1" name="pro_id[]" value="1">

                                                    <p>1</p>

                                                </td>

                                                <td class="row-index text-center">

                                                    <select class="js-example-basic-single name form-control" id="pro_name_1" name="pro_name[]" style="width:250px;">

                                                        <option value="">Select Product Name</option>

                                                        <?php

                                                        require_once("database/connect.php");

                                                        $db = new Database;

                                                        $db->connect();

                                                        $quo = ('SELECT pdi.`pro_code`,pdi.`pro_name`, pdi.`pro_desc`, (pdi.`unit`) as unit FROM `product_details_info` as pdi inner JOIN product_details as pd on pd.`pro_id` = pdi.`pro_id` WHERE  pdi.`active_record` = 1 ');

                                                        //echo $asd; exit;

                                                        $datd = $db->query($quo);

                                                        $edt_max_prod =1;

                                                        while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {

                                                            $unit = $data['unit'];

                                                            echo "<option value='" . $data['pro_code'] . " - " . $data['pro_name'] . "' data-unit='" . $data['unit'] . "' data-pro_desc='" . $data['pro_desc'] . "'>" . '' . $data['pro_code'] . " - " . $data['pro_name'] . "</option>";

                                                        }

                                                        ?>

                                                    </select>

                                                </td>

                                                <td class="row-index text-center">

                                                    <input type="number" class="validnumeric" id="pro_quantity_1" min="1" data-error="#pro_qty_err_1" name="pro_quantity[]" size="2">

                                                    <!--<input type="text" class="unit" id="pro_unit_1" name="pro_unit[]" size="2" value="" readonly>-->

                                                    <select class="js-example-basic-single form-control"  id="pro_unit_1" name="pro_unit[]" style="width:100px;">

                                							<option value ="">Select Unit</option>';

                                							<?php

                                							$asda =('SELECT `u_id`, `u_name`, `date_time`, `active_record` FROM `unit` WHERE `active_record`=1');

                                							//echo $asd; exit;

                                							$datda = $db->query($asda);

                                							while($rowa = $datda->fetch(PDO::FETCH_ASSOC))

                                							{

                                							    ?>

                                							    

                                							<option value ="<?php echo $rowa['u_name']; ?>" ><?php echo $rowa['u_name'];?></option>

                                							<?php

                                							}

                                							?>

                                						</select>

                                                    <p id="pro_qty_err_1"></p>

                                                </td>



                                                <td class="row-index text-center">

                                                    <input class="form-control" type="text" id="pro_spec_1" name="pro_spec[]">

                                                </td>

                                                <td class="text-center">

                                                    <button class="btn btn-danger remove" type="button">Remove</button>

                                                </td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>



                                </div>



                                <div class="col-sm-12">

                                    <center>

                                        <button class="btn btn-md btn-primary" id="addBtn" type="button">Add new Row</button>

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

                        $db = new Database;

                        $db->connect();

                        $asd = ('SELECT  `qu_id`, `code`,`bill_type`, `serial_no`, `active_record`, `time_date` FROM `quotation` WHERE `active_record`=1 group by `serial_no`');

                        //echo $asd; exit;

                        $datd = $db->query($asd);

                        echo '<div class="px-4 py-4"><b>Quotation Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';

                        echo "<thead><tr>";

                        echo "<th style='width=5%;'>S.No.</th>";

                        echo "<th>Serial No.</th>";

                        echo "<th>Bill Type.</th>";

                        echo "<th>time_date</th>";

                        echo "<th>Export</th>";

                        echo "<th>Edit</th>";

                        echo "</tr></thead><tbody>";

                        $sno = 0;

                        while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>";

                            echo "<td style='width=5%;'>" . $row['code'] . "</td>";//".(++$sno).".

                            echo "<td>" . $row['serial_no'] . "</td>";

                            echo "<td>" . $row['bill_type'] . "</td>";

                            echo "<td>" . $row['time_date'] . "</td>";

                            echo "<td><a class=\"btn btn-primary\" href=quotation_pdf.php?pid=" . $row['serial_no'] . " target='_blank'> Click here to print</a></td>";

                            echo "<td><a href='?serial_no=" . $row['serial_no'] . "'><div class='inner'><input class='btn btn-primary editz' name='edit-button[]' id='edit-button_" . $row['serial_no'] . "' value='Edit' style='display:block' /></div></a></td>";

                            //<a href='pdf/quotation_pdf.php?serial_no="($row['serial_no'])."' target='_blank'>Export To PDF-".$row['code']."</a>

                            // <a href='pdf/quotation_pdf.php?serial_no=".$this->encrypt_decrypt($this->killChars($row['serial_no']), $action = 'encrypt')."' target='_blank'>Export To PDF-".$row['code']."</a>

                            //".$this->encrypt_decrypt($this->killChars($row['pinvpid']), $action = 'encrypt')."' target='_blank'

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

        <?php endif; ?>

    </div>



    <!-- ============================================================== -->

    <!--END continerfluid -->

    <?php require_once("footer.php"); ?>

    <!-- ============================================================== -->

    <!-- End footer -->

 </div>   <!-- ============================================================== -->

<!-- ============================================================== -->

<!-- End Wrapper -->

<!-- ============================================================== -->

<!-- ============================================================== -->

<!-- All Jquery -->

<!-- ============================================================== -->

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap tether Core JavaScript -->

<!-- <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->

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

<script src="assets/auto.js"></script>

<script src="assets/autocomplete.js"></script>

<!-- ============================================================== -->

<!-- This page plugins -->

<!-- ============================================================== -->

<script src="dist/js/pages/jasny-bootstrap.js"></script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<script src="assets/datatable/jquery.dataTables.min.js"></script>

<script src="assets/datatable/buttons.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"/>

<script src="assets/global/plugins/select2/js/select2.min.js"></script>





<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>





<script>

    $(document).ready(function () {

        $(".js-example-basic-single").select2();

    });



</script>

<script>

    $(document).ready(function () {



        // TABLE BODY

        // Denotes total number of rows

        var rowIdx = '<?php echo $edt_max_prod; ?>';



        // jQuery button click event to add a row

        $('#addBtn').on('click', function () {


            var bill_type = $( "#bill_type" ).val();
            if(bill_type==''){
                alert('Select Bill Type');
                $('#bill_type').focus();
                return false;
            }



            //var cname = $( "#c_name" ).val();

            //var cname_2 = cname.substring(0, 2);

            //alert(cname);



            // Adding a row inside the tbody.

            $('#tbody').append(`<tr id="R${++rowIdx}">

                 <td class="row-index text-center">

                 <input class="form-control" type="hidden" id="pro_id_` + rowIdx + `" name="pro_id[]" value="${rowIdx}" >

                 <p>${rowIdx}</p>

                 </td>

    

                 <td class="row-index text-center">

                 <select id="pro_name_` + rowIdx + `" name="pro_name[]" class="js-example-basic-asd name" style="width:250px;">

                 <option value="">Select Product Name</option>

					<?php



            require_once("database/connect.php");

            $db = new Database;

            $db->connect();

            $asd = ('SELECT pdi.`pro_code`,pdi.`pro_name`, pdi.`pro_desc`, (pdi.`unit`) as unit FROM `product_details_info` as pdi inner JOIN product_details as pd on pd.`pro_id` = pdi.`pro_id` WHERE  pdi.`active_record` = 1 ');

            $datd = $db->query($asd);

            while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {

                echo "<option value='" . ($data['pro_code']) . " - " . ($data['pro_name']) . "'  data-unit='" . ($data['unit']) . "' data-pro_desc='" . ($data['pro_desc']) . "'>" . '' . ($data['pro_code']) . " - " . ($data['pro_name']) . "</option>";

            }



            ?>

				</select> 

                 </td>

    

                 <td class="row-index text-center">

                 <input  type="number" class="validnumeric" id="pro_quantity_` + rowIdx + `" name="pro_quantity[]" min="1" data-error="pro_qty_err_` + rowIdx + `" size="2">

                <select class="js-example-basic-asd"  id="pro_unit_` + rowIdx + `" name="pro_unit[]" style="width:100px;">

                                							<option value ="">Select Unit</option>';

                                							<?php

                                							$asda =('SELECT `u_id`, `u_name`, `date_time`, `active_record` FROM `unit` WHERE `active_record`=1');

                                							//echo $asd; exit;

                                							$datda = $db->query($asda);

                                							while($rowa = $datda->fetch(PDO::FETCH_ASSOC))

                                							{

                                							    ?>

                                							    

                                							<option value ="<?php echo $rowa['u_name']; ?>" ><?php echo $rowa['u_name'];?></option>

                                							<?php

                                							}

                                							?>

            	</select>

                 <p id="pro_qty_err_` + rowIdx + `"></p>

                 </td>



                 <td class="row-index text-center">

                 <input class="form-control" type="text" id="pro_spec_` + rowIdx + `" name="pro_spec[]">

                 </td>

                  <td class="text-center">

                    <button class="btn btn-danger remove"

                      type="button">Remove</button>

                    </td>

                  </tr>`);

            $(".js-example-basic-asd").select2();

        });





        $('#editBtn').on('click', function () {



            //var cname = $( "#c_name" ).val();

            //var cname_2 = cname.substring(0, 2);

            //alert(cname);



            // Adding a row inside the tbody.

            $('#tbody').append(`<tr id="R${++rowIdx}">

                 <td class="row-index text-center">

                 <input class="form-control" type="hidden" id="pro_id_` + rowIdx + `" name="e_pro_id[]" value="${rowIdx}" >

                 <p>${rowIdx}</p>

                 </td>



                 <td class="row-index text-center">

                 <select id="pro_name_` + rowIdx + `" name="e_pro_name[]" class="js-example-basic-asd name" style="width:250px;">

                 <option value="">Select Product Name</option>

					<?php



            require_once("database/connect.php");

            $db = new Database;

            $db->connect();

            $asd = ('SELECT pdi.`pro_code`,pdi.`pro_name`, pdi.`pro_desc`, (pdi.`unit`) as unit FROM `product_details_info` as pdi inner JOIN product_details as pd on pd.`pro_id` = pdi.`pro_id` WHERE  pdi.`active_record` = 1 ');

            $datd = $db->query($asd);

            while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {

                echo "<option value='" . $data['pro_code'] . " - " . $data['pro_name'] . "'  data-unit='" . $data['unit'] . "' data-pro_desc='" . $data['pro_desc'] . "'>" . '' . $data['pro_code'] . " - " . $data['pro_name'] . "</option>";

            }



            ?>

				</select>

                 </td>



                 <td class="row-index text-center">

                 <input  type="number" id="pro_quantity_` + rowIdx + `" name="e_pro_quantity[]" size="2">

                <select  class="js-example-basic-asd"   id="pro_unit_` + rowIdx + `" name="e_pro_unit[]" style="width:100px;">

                                							<option value ="">Select Unit</option>';

                                							<?php

                                							$asda =('SELECT `u_id`, `u_name`, `date_time`, `active_record` FROM `unit` WHERE `active_record`=1');

                                							//echo $asd; exit;

                                							$datda = $db->query($asda);

                                							while($rowa = $datda->fetch(PDO::FETCH_ASSOC))

                                							{

                                							    ?>

                                							    

                                							<option value ="<?php echo $rowa['u_name']; ?>" ><?php echo $rowa['u_name'];?></option>

                                							<?php

                                							}

                                							?>

            	</select>

                 </td>



                 <td class="row-index text-center">

                 <input class="form-control" type="text" id="pro_spec_` + rowIdx + `" name="e_pro_spec[]">

                 </td>

                  <td class="text-center">

                    <button class="btn btn-danger remove"

                      type="button">Remove</button>

                    </td>

                  </tr>`);

            $(".js-example-basic-asd").select2();

        });

// TABLE BODY END     

        // jQuery button click event to remove a row.

        $('#tbody').on('click', '.remove', function () {



            // Getting all the rows next to the row

            // containing the clicked button

            var child = $(this).closest('tr').nextAll();



            // Iterating across all the rows 

            // obtained to change the index

            child.each(function () {



                // Getting <tr> id.

                var id = $(this).attr('id');



                // Getting the <p> inside the .row-index class.

                var idx = $(this).children('.row-index').children('p');



                // Gets the row number from <tr> id.

                var dig = parseInt(id.substring(1));



                // Modifying row index.

                idx.html(`${dig - 1}`);



                // Modifying row id.

                $(this).attr('id', `R${dig - 1}`);

            });



            // Removing the current row.

            $(this).closest('tr').remove();



            // Decreasing total number of rows by 1.

            rowIdx--;

        });

    });

    // END REMOVEs ROW

</script>

<!-- ON CHANGE NAME -->

<script>

    $(document).on('change', '.name', function (e) {

        var this_val = $.trim($(this).val());

        var this_unit = $.trim($(this).find(':selected').attr("data-unit"));

        var this_pro_desc = $.trim($(this).find(':selected').attr("data-pro_desc"));

        var this_attr_id = $.trim($(this).attr("id"));

        var splt_this_id = this_attr_id.split("_");

        var splt_this_id_ar = splt_this_id[2];

        //alert(this_unit);

       // $('#pro_unit_' + splt_this_id_ar).val(this_unit);

        $('#pro_spec_' + splt_this_id_ar).val(this_pro_desc);

    });



</script>

<!-- END ON CHANGE NAME -->

<!-- INSERT FORM VALIDATION -->

<script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>

<script>

        // for more info visit the official plugin documentation:

        // http://docs.jquery.com/Plugins/Validation



        jQuery.validator.addMethod("lettersonly", function (value, element) {

            return this.optional(element) || /^[a-z]+$/i.test(value);

        }, "Alphabetic only allowed");





        var form1 = $('#quotion');

        var error1 = $('.alert-danger', form1);

        var success1 = $('.alert-success', form1);



        form1.validate({

            errorElement: 'span', //default input error message container

            errorClass: 'help-block help-block-error', // default input error message class

            focusInvalid: false, // do not focus the last invalid input

            ignore: "",  // validate all fields including form hidden input

            rules: {

                pro_id: {

                    required: true

                },

                pro_name: {

                    required: true

                },

                pro_unit: {

                    required: true

                },

                pro_specs: {

                    required: true

                }

            },

            errorPlacement: function (error, element) {

                var placement = $(element).data('error');

                if (placement) {

                    error.appendTo(element.siblings(document.querySelector(placement)));

                } else {

                    error.insertAfter(element);

                }

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

                        url: 'quotion_back.php',

                        data: data,

                        cache: false,

                        contentType: false,

                        processData: false,

                        type: 'POST',

                        success: function (response) {

                            if (response == "Quotation Info Stored Sucessfully") {

                                $('.form-control').val('');

                                alert(response);

                                window.location = "quotion.php";

                            } else {

                                alert(response);

                            }

                },

            });

        }

    });



    // for more info visit the official plugin documentation:

    // http://docs.jquery.com/Plugins/Validation

    jQuery.validator.addMethod("lettersonly", function (value, element) {

        return this.optional(element) || /^[a-z]+$/i.test(value);

    }, "Alphabetic only allowed");

    var form2 = $('#quotation_update');

    var error2 = $('.alert-danger', form2);

    var success2 = $('.alert-success', form2);

    form2.validate({

        errorElement: 'span', //default input error message container

        errorClass: 'help-block help-block-error', // default input error message class

        focusInvalid: false, // do not focus the last invalid input

        ignore: "",  // validate all fields including form hidden input

        rules: {

            // pro_id: {

            //   required: true

            // },

            // pro_name: {

            //   required: true

            // },

            // pro_unit: {

            //   required: true

            // },

            // pro_specs: {

            //   required: true

            // }

        },

        invalidHandler: function (event, validator) { //display error alert on form submit

            success2.hide();

            error2.show();

            Metronic.scrollTo(error2, -200);

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

            success2.show();

            error2.hide();

            var data = new FormData($(form)[0]);

            $.ajax({

                //data : form.serialize(),

                url: 'quotation_back_update.php',

                data: data,

                cache: false,

                contentType: false,

                processData: false,

                type: 'POST',

                success: function (response) {

                    if (response == "Quotation Info Updated Sucessfully") {

                        $('.form-control').val('');

                        alert(response);

                        window.location = "quotion.php";

                    } else {

                        alert(response);

                    }

                        },

        });

        }

    });

</script>

<!-- EDIT FORM VALIDATION END -->

<!-- DATALIST -->

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

<!-- END DATALIST -->





</body>



</html>

        