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

                                <h4 class="mb-0 text-white">Bought List</h4>

                            </div>

                                

                                <hr>

                                <div class="form-body">

                                    <div class="card-body">

                                                



                                        <div class="row pt-3">  

                                            <!--/span-->

                                            <div class="table-responsive">

                                            <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT c.dep_name,st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 

                                INNER join grb as g on g.grb_no =st.grb_id

                                INNER join work_order as wo on wo.wo_id =st.po_id

                                INNER join suplier as s on s.sup_id =wo.suplier_id 

                                INNER join client as c on c.cl_id =st.dep

                                WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep!=0 and tranf=0 group by st.se_no  ');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                echo'<table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';

                                echo "<thead><tr>";

                                echo "<th>Serial No.</th>";

                                echo "<th>Product Name.</th>";

                                echo "<th>Department Name.</th>";

                                echo "</tr></thead><tbody>";

                                $sno=0;

                                while($row = $datd->fetch(PDO::FETCH_ASSOC))

                                {

                                  echo "<tr>";

                                  echo "<td>".$row['se_no']."</td>";//".(++$sno).".

                                  echo "<td>".$row['item_name']."</td>";

                                  echo "<td>".$row['dep_name']."</td>";

                                  //<a href='pdf/quotation_pdf.php?serial_no="($row['serial_no'])."' target='_blank'>Export To PDF-".$row['code']."</a>

                                  // <a href='pdf/quotation_pdf.php?serial_no=".$this->encrypt_decrypt($this->killChars($row['serial_no']), $action = 'encrypt')."' target='_blank'>Export To PDF-".$row['code']."</a>

                                  //".$this->encrypt_decrypt($this->killChars($row['pinvpid']), $action = 'encrypt')."' target='_blank'

                                  echo "</tr>";

                                }

                                echo "</tbody></table>";

                      ?>

                                                    <hr>

                                                  </tbody>

                                                </table>

                                              </div>

                                                   

                                        </div> 

                                        

                                       



                                    </div> 

                                    <!-- card body ended   -->

                                </div>

                                <!-- form body ended -->

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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>



    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->

    <script type="text/javascript">



$(document).on('click', '.view', function( e ) {

	

	$("#update_div").html("");

	

	var this_attr_id = $.trim($(this).attr("id"));

    var splt_this_id = this_attr_id.split("_");

    var splt_this_id_ar = splt_this_id[2];

	//alert(splt_this_id_ar);

	

		$.ajax({

		type: "GET",

		url: 'ajax/po_ajax.php?po_no='+splt_this_id_ar,

		success: function(data){

			

			$("#update_div").html(data);

			

		}

		});

		

		//$("#update_div").html("<table width='100%'><tr><td align='center'><a class=\"btn btn-primary\" href=grb_preview.php?pid="+$('#po_no').val()+" target='_blank'> Click here to print</a> </td></tr></table>");

			//$('#update_div').load('po_preview.php?pid='+$('#po_no').val());

	

	

	

		});

</script>

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

    





</body>



</html>

        