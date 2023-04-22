<?php

require_once("header.php");

?>

    <div class="page-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card"></br></br>

                        <div class="card-header bg-info"><h4 class="mb-0 text-white">Work Order List</h4></div>

                            <form id="work_order"  autocomplete="off"><hr>

                                <div class="form-body">

                                    <div class="card-body">

                                        <div class="row pt-3">  

                                            <div class="table-responsive">

                                                <table class="table table-bordered" id="trn_dlr_pi_inv">

                                                  <thead>

                                                    <tr>

                                                      <th class="text-center">No.</th>

                                                      <th class="text-center">Work Order No.</th>

                                                      <th class="text-center">Quotation No.</th>
                                                      
                                                      <th class="text-center">Bill Type</th>

                                                      <th class="text-center">Product Date</th>

                                                      <th class="text-center">Edit</th>

                                                      <th class="text-center">View</th>

                                                    </tr>

                                                  </thead>

                                                  <tbody id="tbody">

                                                  </tbody>

                                                </table>

                                              </div>

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

    <?php require_once("footer.php");?>

        <!-- ============================================================== -->

        <!-- End footer -->

        <!-- ============================================================== -->

   </div>

<link rel="stylesheet" type="text/css" href="assets/datatable/jquery.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/css/select2.min.css"  />

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->

<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>

<script src="dist/js/waves.js"></script>

<script src="dist/js/sidebarmenu.js"></script>

<script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>

<script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>

<script src="dist/js/custom.min.js"></script>

<script src="dist/js/pages/jasny-bootstrap.js"></script>

<script src="assets/datatable/jquery.dataTables.min.js"></script>

<script src="assets/datatable/buttons.dataTables.min.js"></script>

<script src="assets/auto.js"></script>

<script src="assets/autocomplete.js"></script>

<script src="assets/global/plugins/select2/js/select2.min.js"></script>

<script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>

<script>

    $( document ).ready(function() {

    // $(document).on('change', '#po_no', function( e ) {

	     var this_val = 1;

        $.ajax({

			type: "GET",

			url: 'ajax/ajax_work_order_list.php?po_no='+this_val,

			success: function(data){

				//alert(data);

                $('#tbody').html(data);

			}

		});

    });

</script>

    <!-- AJAX FOR BODY END  -->

<style>#trn_dlr_pi_inv{margin:0 auto;clear:both;width:inherit!important;table-layout:fixed!important}</style>

<script>

$(document).ready(function () {

    // Setup - add a text input to each footer cell

    $('#trn_dlr_pi_inv thead tr')

        .clone(true)

        .addClass('filters')

        .appendTo('#trn_dlr_pi_inv thead');

 

    var table = $('#trn_dlr_pi_inv').DataTable({

           autoWidth: false,

         "bAutoWidth": false,

        // orderCellsTop: true,

        // fixedHeader: true,

        "aoColumnDefs": [{ "sWidth": "10%", "aTargets": [ -1 ] }],

         // "fnInitComplete": function() {

        //     $("#trn_dlr_pi_inv").css("width","60%");

        // },

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

                    $(cell).html('<input class="form-control" type="text" placeholder="' + title + '" />');

 

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

    <!-- SELECT 2 -->

    <script>

   $(document).ready(function() {

    $('.js-example-basic-multiple').select2();

    });

    </script>

<!-- SELECT 2 END -->

   <!-- INSERT FORM VALIDATION -->

   

       

       <script>

           // for more info visit the official plugin documentation: 

               // http://docs.jquery.com/Plugins/Validation

               

               jQuery.validator.addMethod("lettersonly", function(value, element) {

                return this.optional(element) || /^[a-z]+$/i.test(value);

              }, "Alphabetic only allowed"); 

              var form1 = $('#work_order');

               var error1 = $('.alert-danger', form1);

               var success1 = $('.alert-success', form1);

   

               form1.validate({

                   errorElement: 'span', //default input error message container

                   errorClass: 'help-block help-block-error', // default input error message class

                   focusInvalid: false, // do not focus the last invalid input

                   ignore: "",  // validate all fields including form hidden input

                 

                   rules: {

                    // quo_no: {

                          

                    //        required: true

                    //    },

                    //    wo_no: {

                          

                    //       required: true

                    //   },

                    //   prod_name: {

                          

                    //       required: true

                    //   },

                    //   ddl_pro_unt: {

                          

                    //       required: true

                    //   },

                    //   ddl_pro_unit: {

                          

                    //       required: true

                    //   },

                    //   ddl_pro_qty: {

                          

                    //       required: true

                    //   },

                    //   ddl_pro_spec: {

                          

                    //       required: true

                    //   },

                    //   sup_id: {

                          

                    //       required: true

                    //   },

                    //   sup_amt: {

                          

                    //       required: true

                    //   },

                    //   disc_amt: {

                          

                    //       required: true

                    //   },

                    //   gst_amt: {

                          

                    //       required: true

                    //   },

                    //   tot: {

                          

                    //       required: true

                    //   }

                       

                     

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

                   url:'work_order_back.php',

                   data: data,

                   cache: false,

                   contentType: false,

                   processData: false,

                   type: 'POST',

                   success: function (response)

                   {

                       if(response == "Work Order Details Stored Sucessfully")

                       {

                            $('.form-control').val('');

                            alert(response); 

                            window.location="work_order.php";

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

</body>

</html>