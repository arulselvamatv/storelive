<?php

require_once("header.php");

require_once("login_action.php");



$user_id = $_SESSION['user_log_email'];

$user_type = $_SESSION['user_log_type'];

?>

 <?php

 

        if(!empty($_REQUEST['po_no']))

        {

            $po_no=$_REQUEST['po_no'];

            $po = "PO_".$po_no;

            

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

                                <h4 class="mb-0 text-white">PO Edit</h4>

                            </div>

                                <div class="form-body">

                                    <div class="card-body">

                                        <div class="row pt-3">  

                                            <form action="po_edit.php" method="post" autocomplete="off">

                                            <?php

                                            require_once("database/connect.php");

                                            $db=new Database;

                                            $db->connect();

                                            $asd =('SELECT `term_cond`,`remarks`,`postatus`,`poreason`,po_no FROM `work_order` WHERE work_order.`active_record`=1 and work_order.po_no ="'.$po.'"  group by work_order.po_no');

                                            //echo $asd; exit;

                                            $datd = $db->query($asd);

                                            while($data=$datd->fetch(PDO::FETCH_ASSOC)){

                                            ?>

                                            <div class="form-body">

                                                <div class="card-body"> 

                                                <div class="form-group">

                                                    <label class="form-label">Terms and Conditions:</label>

                                                    <input type="text" class="form-control" id="term_cond" name="term_cond" value="<?php print $data['term_cond']?>">

                                                    <input type="hidden" class="form-control" id="po_nos" name="po_nos" value="<?php print $data['po_no']?>">

                                                </div> 

                                                <div class="form-group">

                                                    <label class="form-label">Remarks:</label>

                                                    <input type="text" class="form-control" id="remarks" name="remarks" value="<?php print $data['remarks']?>">

                                                </div> 

                                                <?php

                                                 if($user_type == 6){?>

                                                 

                                                 <div class="form-group">

                                                    <label class="form-label">PO Status:</label>

                                                    <select class="js-example-basic-multiple form-control" id="postatus" name="postatus" onchange="yesnoCheck(this);">

                                                        <option value="" disabled selected hidden>Select the PO Status</option>

                                                        <option value="approved">Approved</option>

                                                        <option value="redo">Redo the PO</option>

                                                        <option value="cancelled">Cancelled</option>

								                    </select>

							                    </div>

						                        <div class="form-group">

								                    <div id="cancelled" style="display: none;">

                                                        <label for="poreason">Enter Reason:</label> 

                                                        <input class="form-control" type="text" id="poreason" name="poreason" /><br />

                                                    </div>

								                </div>

								                <!--<div class="form-group">-->

								                <!--    <div id="approvesign_blk" style="display: none;">-->

                        <!--                                <label for="poreason">Signature:</label> -->

                        <!--                                <input class="form-control" type="file" id="approvesign" name="approvesign" /><br />-->

                        <!--                            </div>-->

								                <!--</div>-->

								                

								                <?php } ?>

                                                <div class="col-sm-12">

                                                    <center><button type="submit" class="btn btn-success">Submit</button></center>

                                                </div>

                                            </div>

                                            <!-- form body ended -->

                                            <?php

                                            }

                                            ?>



                                            </form>



                                        </div> 

                                        <!-- Row pt end   -->

                                    </div> 

                                    <!--card-body end   -->

                                </div>

                                <!--form-body end   -->

                        </div>

                         <!-- card ended -->

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

            <!-- Container ended -->

        </div>

        <!-- Page wrapper ended -->



        <?php

        }

        else

        {

            ?>



        <div class="page-wrapper">

            <div class="container-fluid">

                <div class=row>

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header bg-info">

                                <h4 class="mb-0 text-white">PO List</h4>

                            </div>

                                <div class="form-body">

                                    <div class="card-body">

                                        <div class="row pt-3">  

                                            <div class="table-responsive">

                                                <table class="table table-bordered" style="font-size:inherit!important;" id="trn_dlr_pi_inv">

                                                  <thead>

                                                    <tr>

                                                    <th class="text-center">No</th>

                                                    <!--<th class="text-center">Purchase Order No</th>-->

                                                    <th class="text-center">Department No</th>

                                                    <th class="text-center">Company Name</th>

                                                    <th class="text-center">Date</th>

                                                    <th class="text-center">PDF</th>

                                                    <th class="text-center">PO Status</th>

                                                      <th class="text-center">PO Reason</th>

                                                    </tr>

                                                  </thead>

                                                  <tbody>

                                                      <?php

                                                  $asd =('SELECT s.company_name,`wo_id`, dep_no, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, `ddl_pro_qty`, `product_spec`, `suplier_id`, `sup_amt`, `disc_amt`, `tot`,`postatus`,`poreason`, work_order.`active_record`, work_order.`date_time` FROM `work_order` 

                                                    inner join suplier as s on s.sup_id = work_order.suplier_id WHERE work_order.`active_record`=1  group by po_no order by work_order.`date_time` desc ');

                                                    //echo $asd; exit;

                                                    $i=0;

                                                    $prdt_data = $db->query($asd);

                                                    while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)){ 

                                                        $i = ++$i;

                                                        echo '<tr>'.

                                                        '<th ><center>'.$i.'</center></th>'.

                                                        // '<th>'.

                                                        // '<center>'.$prd['po_no'].'</center>'.

                                                        // '</th>'.

                                                        '<th>'.

                                                        '<center><input type="hidden" class="dep_no" name="dep_no[]" id="dep_no_'.$prd['po_no'].'" value="'.$prd['dep_no'].'"/>'.$prd['dep_no'].'</center>'.

                                                        '</th>'.

                                                        '<th>'.

                                                        '<center>'.$prd['company_name'].'</center>'.

                                                        '</th>'.

                                                        '<th>'.

                                                        '<center>'.$prd['date_time'].'</center>'.

                                                        '</th>'.

                                                        '<th>'.

                                                        '<center><input type="button" class="view" name="view-button[]" id="view-button_'.$prd['po_no'].'" value="View"/></center>'.

                                                        '</th>'.

                                                            

                                                        '<th>'.

                                                        '<center>'.$prd['postatus'].'</center>'.

                                                        '</th>'.

                                                          '<th>'.

                                                        '<center>'.$prd['poreason'].'</center>'.

                                                        '</th>'.

                                                        '</tr>';

                                                    }?>


                                                  </tbody>

                                                </table>

                                                <div id="update_div"></div>

                                                <div id="update_div2"></div>

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

   </div>

   <?php } ?>



<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->

<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>

<script src="dist/js/waves.js"></script>

<script src="dist/js/sidebarmenu.js"></script>

<script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>

<script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>

<script src="dist/js/custom.min.js"></script>

<script src="dist/js/pages/jasny-bootstrap.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



<script src="assets/auto.js"></script>

<script src="assets/autocomplete.js"></script>

<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />

<script src="assets/global/plugins/select2/js/select2.min.js"></script>

<script src="assets/datatable/jquery.dataTables.min.js"></script>

<script src="assets/datatable/buttons.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

<!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->

<script type="text/javascript">

    $(document).on('click', '.view', function( e ) {

	    $("#update_div").html("");

        // $("#update_div2").html("");

   

    	var this_attr_id = $.trim($(this).attr("id"));

        var splt_this_id = this_attr_id.split("_");

        var splt_this_id_ar = splt_this_id[2];
        var splt_this_id_ar1 = splt_this_id[1];
        var dep_id="#dep_no_"+splt_this_id_ar1+"_"+splt_this_id_ar;
        var dep_no =$(dep_id).val();
        // alert(dep_no);
        var splt_dep_no = dep_no.split("_");
        var splt_dep_no0 = splt_dep_no[0];



		$.ajax({

		type: "GET",

		url: 'po_view.php?po_no='+splt_this_id_ar+'&header=0',

		success: function(data){



			$("#update_div").html(data);



		}

		});

		

        var htm="<table width='100%'><tr>";

		htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=po_view.php?po_no="+splt_this_id_ar+"&header=0 target='_blank'> Click here to print without header</a></td>";
        if(splt_dep_no0=='KARE'){
		htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=po_view.php?po_no="+splt_this_id_ar+"&header=1 target='_blank'> Click here to print with header</a></td>";
        }
		htm=htm+"<td align='center'><a class=\"btn btn-primary\" href=po_view.php?po_no="+splt_this_id_ar+"&header=2 target='_blank'> Click here to print Blank header</a></td>";

		htm=htm+"<td align='center'><a href='?po_no="+splt_this_id_ar+"'><input type='hidden' name='po' value=\'"+splt_this_id_ar+"\'><button id=\"btnlnk\" class=\"btn btn-primary\" target='_blank'> Click here to Edit PO</button></a></td>";

		htm=htm+"</tr></table>";

		$("#update_div2").html(htm);

	

	

		});

</script>

<style>#trn_dlr_pi_inv{margin:0 auto;clear:both; width:inherit!important;table-layout:fixed!important}</style>

<script>

    $(document).ready(function () {

    // Setup - add a text input to each footer cell

    $('#trn_dlr_pi_inv thead tr')

        .clone(true)

        .addClass('filters')

        .appendTo('#trn_dlr_pi_inv thead');

 

    var table = $('#trn_dlr_pi_inv').DataTable({

        // orderCellsTop: true,

        // fixedHeader: true,

        autoWidth: false,

         "bAutoWidth": false,

        // "bDestroy": true,

        // "bPaginate": false,

        // "bFilter": true,

        // "bScrollCollapse": true,

        // "bPaginate": false,

        // "bJQueryUI": true,

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

<script>

    function yesnoCheck(that){

        if (that.value == "cancelled" || that.value == "redo" ){

            document.getElementById("cancelled").style.display = "block";

        }

        else{

            document.getElementById("cancelled").style.display = "none";

        }

        // if (that.value == "approved"){

        //     document.getElementById("approvesign_blk").style.display = "block";

        // }

        // else{

        //     document.getElementById("approvesign_blk").style.display = "none";

        // }

    }

</script>

</body>

</html>