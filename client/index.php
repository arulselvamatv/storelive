<?php
include("login_action.php");
user_log_vals();
//echo $_SESSION['user_log_email']; exit;
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
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Client Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Client Dashboard</li>
                            </ol>
                           
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!--.row -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="card card-height">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Total Stocks</h5>
                                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                                    <h1><i class="ti-home text-info"></i></h1>
                                    <div class="ms-auto">
                                        <?php
                                    $asd =('SELECT  count(st.`store_id`)  as received_qty  FROM `store_entry` as st 
                                INNER join grb as g on g.grb_no =st.grb_id
                                INNER join work_order as wo on wo.wo_id =st.po_id
                                INNER join suplier as s on s.sup_id =wo.suplier_id 
                                INNER join client as c on c.cl_id =st.dep
                                INNER join clientusers as cu on cu.dep_name =c.dep_name
                                WHERE wo.`active_record` =1 and s.`active_record` =1 and cu.email="'.$user_id.'"   ');
                                //echo $asd; exit;
                                $datd = $db->query($asd);
                                while($row = $datd->fetch(PDO::FETCH_ASSOC))
                                {
                                    
                                    ?> 
                                        <h1 class="text-muted"><?php print $row['received_qty']?></h1>
                                <?php
                                }
                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="card card-height">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Product Name / Quantity</h5>
                                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                                    <h1><i class="icon-tag text-purple"></i></h1>
                                    <div class="ms-auto">
                                        <?php
                                        $asda =('SELECT  wo.prod_name,count(st.`store_id`)  as received_qty  FROM `store_entry` as st 
                                        INNER join grb as g on g.grb_no =st.grb_id
                                        INNER join work_order as wo on wo.wo_id =st.po_id
                                        INNER join suplier as s on s.sup_id =wo.suplier_id 
                                        INNER join client as c on c.cl_id =st.dep
                                        INNER join clientusers as cu on cu.dep_name =c.dep_name
                                        WHERE wo.`active_record` =1 and s.`active_record` =1 and cu.email="'.$user_id.'" group by wo.prod_name ');
                                        //echo $asd; exit;
                                        $datda = $db->query($asda);
                                        while($rowa = $datda->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?> 
                                        <h6 class="text-muted"><?php print $rowa['prod_name']?> / (<?php print $rowa['received_qty']?>)</h6>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="card card-height">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Properties for Rent</h5>
                                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                                    <h1><i class="icon-basket text-danger"></i></h1>
                                    <div class="ms-auto">
                                        <h1 class="text-muted">311</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="card card-height">
                            <div class="card-body">
                            
                            
                                <h5 class="card-title text-uppercase">Total Products value</h5>
                                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                                    <h1><i class="ti-wallet text-success"></i></h1>
                                    <div class="ms-auto">
                                    <?php
                                        $asda =('SELECT sum(st.`per_amt`) as sum_amt, c.dep_name,st.`store_id`, st.code, st.invoice_no, st.wrt_date,s.company_name, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
                                        INNER join grb as g on g.grb_no =st.grb_id
                                        INNER join work_order as wo on wo.wo_id =st.po_id
                                        INNER join suplier as s on s.sup_id =wo.suplier_id 
                                        INNER join client as c on c.cl_id =st.dep
                                        INNER join clientusers as cu on cu.dep_name =c.dep_name
                                        WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep!=0 and st.tranf = 0 and cu.email="'.$user_id.'"  group by c.dep_name');
                                        //echo $asd; exit;
                                        $datda = $db->query($asda);
                                        while($rowa = $datda->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?> 
                                        <h1 class="text-muted"><?php print $rowa['sum_amt']?></h1>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex m-b-40 align-items-center">
                                    <h5 class="card-title">PROPERTIES STATS</h5>
                                    <div class="ms-auto">
                                        <ul class="list-inline font-12">
                                            <li><i class="fa fa-circle text-cyan"></i> For Sale</li>
                                            <li><i class="fa fa-circle text-primary"></i> For Rent</li>
                                            <li><i class="fa fa-circle text-purple"></i> All</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="morris-bar-chart" style="height:352px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-b-15">
                                    <div class="card-body">
                                        <h5 class="card-title">PROPERTY SALES INCOME</h5>
                                        <div class="row">
                                            <div class="col-6 m-t-30">
                                                <h1 class="text-info">$64057</h1>
                                                <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
                                            <div class="col-6">
                                                <div id="sparkline2dash" class="text-end"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card bg-purple m-b-15">
                                    <div class="card-body">
                                        <h5 class="text-white card-title">PROPERTY ON RENT INCOME</h5>
                                        <div class="row">
                                            <div class="col-6 m-t-30">
                                                <h1 class="text-white">$30447</h1>
                                                <p class="text-white">APRIL 2017</p> <b class="text-white">(110 Sales)</b> </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div id="sales1" class="text-end"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Comment - table -->
                <!-- ============================================================== -->
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Logs</h5>
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Order ID</th>
                                                <th>Photo</th>
                                                <th>Property</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Steave Jobs</td>
                                                <td>#85457898</td>
                                                <td> <img src="../assets/images/property/prop1.jpeg" alt="iMac" width="80"> </td>
                                                <td>Swanim villa</td>
                                                <td>Sold</td>
                                                <td>10-7-2017</td>
                                                <td> <span class="label label-success font-weight-100">Paid</span> </td>
                                                <td><a href="javascript:void(0)" class="text-dark p-r-10" data-bs-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-dark" title="Delete" data-bs-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>Varun Dhavan</td>
                                                <td>#95457898</td>
                                                <td> <img src="../assets/images/property/prop2.jpeg" alt="iPhone" width="80"> </td>
                                                <td>River view home</td>
                                                <td>On Rent</td>
                                                <td>09-7-2017</td>
                                                <td> <span class="label label-warning font-weight-100">Pending</span> </td>
                                                <td><a href="javascript:void(0)" class="text-dark p-r-10" data-bs-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-dark" title="Delete" data-bs-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>Ritesh Desh</td>
                                                <td>#68457898</td>
                                                <td> <img src="../assets/images/property/prop3.jpeg" alt="apple_watch" width="80"> </td>
                                                <td>Gray Chair</td>
                                                <td>12</td>
                                                <td>08-7-2017</td>
                                                <td> <span class="label label-success font-weight-100">Paid</span> </td>
                                                <td><a href="javascript:void(0)" class="text-dark p-r-10" data-bs-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-dark" title="Delete" data-bs-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>Hrithik</td>
                                                <td>#45457898</td>
                                                <td> <img src="../assets/images/property/prop3.jpeg" alt="mac_mouse" width="80"> </td>
                                                <td>Pure Wooden chair</td>
                                                <td>18</td>
                                                <td>02-7-2017</td>
                                                <td> <span class="label label-danger font-weight-100">Failed</span> </td>
                                                <td><a href="javascript:void(0)" class="text-dark p-r-10" data-bs-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-dark" title="Delete" data-bs-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- End Comment - chats -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2021 Eliteadmin by themedesigner.in
            <a href="https://www.wrappixel.com/">WrapPixel</a>
        </footer>
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
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="../assets/node_modules/raphael/raphael-min.js"></script>
    <script src="../assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="../assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="../assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="dist/js/dashboard1.js"></script>
</body>

</html>
