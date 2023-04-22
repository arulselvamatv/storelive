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
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row page-titles ">
                    <div class="col-md-5 align-self-center">
                        <h4 class=" heading">Transferd History list Report</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-endS">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <!--<li class="breadcrumb-item"><a href="http://lafs-atv.com/family_garden_store/admin/index.php">Home</a></li>-->
                                <!--<li class="breadcrumb-item activepage ">Asset Managmen</li>-->
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card pt-4"> 
                                  
                            <?php
                        require_once("database/connect.php");
                        $db = new Database;
                        
                        $db->connect();
                        $asd = ('SELECT t.fromdep,t.to_sup,t.todep, t.reason,st.dep, cl.dep_name as from_dep, c.dep_name, st.`store_id`, st.code, st.invoice_no, st.wrt_date,s.company_name, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
                                    INNER join grb as g on g.grb_no =st.grb_id
                                    INNER join work_order as wo on wo.wo_id =st.po_id
                                    INNER join client as c on c.cl_id =st.dep
                                   	INNER join transfer as t on t.seno = st.se_no
                                    INNER join client as cl on cl.cl_id =t.fromdep
                                    INNER join suplier as s on s.sup_id =wo.suplier_id 
                                    WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep!=0  and history=1 group by  t.t_id');
                       // SELECT `str_out_list_id`, `date(`time_date`) as date` FROM `store_out_list` WHERE active_record=1 group by `date(`time_date`) as date` order by `date(`time_date`) as date` desc
                        //echo $asd; exit;
                        $datd = $db->query($asd);
                        echo '<div style="overflow-x:auto;">
                        <div class="container-fluid mt-1">  <table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;  overflow-x:auto;" border="1" cellpadding="5" class="table table-bordered">';
                        echo "<thead><tr class='tableclr'>";
                        echo "<th style='width=5%;'>S.No.</th>";
                        echo "<th>Serial number</th>";
                        echo "<th>Supplier.</th>";
                        echo "<th>From Dep</th>";
                        echo "<th>Reson</th>";
                        echo "<th>To department</th>";
                        echo "<th>Return Date</th>";
                        echo "<th>Print Report</th>";
                        echo "</tr></thead><tbody>";
                        $sno = 0;
                        while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td style='width=5%;'>" .(++$sno). "</td>";//".(++$sno).".
                            echo "<td>"  .$row['se_no'].  "</td>";
                            echo "<td>"  .$row['company_name'].  "</td>";
                            echo "<td>"  .$row['from_dep'].  "</td>";
                            echo "<td>"  .$row['reason'].  "</td>";
                            echo "<td>"  .$row['dep_name']."</td>";
                            echo "<td>"  .$row['date_time'].  "</td>";
                            echo "<td><a class=\"btn btn-primary\" href=transfered_history_list_report_pdf.php?se_no=" . $row['se_no'] . "  target='_blank'> Click here to print</a></td>";
                            // echo "<td><a href='?serial_no=" . $row['serial_no'] . "'><div class='inner'><input class='btn btn-primary editz' name='edit-button[]' id='edit-button_" . $row['serial_no'] . "' value='Edit' style='display:block' /></div></a></td>";
                            //<a href='pdf/quotation_pdf.php?serial_no="($row['serial_no'])."' target='_blank'>Export To PDF-".$row['code']."</a>
                            // <a href='pdf/quotation_pdf.php?serial_no=".$this->encrypt_decrypt($this->killChars($row['serial_no']), $action = 'encrypt')."' target='_blank'>Export To PDF-".$row['code']."</a>
                            //".$this->encrypt_decrypt($this->killChars($row['pinvpid']), $action = 'encrypt')."' target='_blank'
                            echo "</tr>";
                        }
                        echo "</tbody></table></div>
                        </div>
                        ";
                        ?>
                                
                         
            </div>
          </div>
         </div>
     </div>
    
         
 <!--echo "<td style='width=5%;'>" . $row['++$sno'] . "</td>";//".(++$sno).".-->
</div>

<?php require_once("footer.php"); ?>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    
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
    

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    
    
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
    
    
    
    
    
      