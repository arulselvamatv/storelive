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

                        <h4 class="text-themecolor">Kare Store Dashboard</h4>

                    </div>

                    <div class="col-md-7 align-self-center text-endS">

                        <div class="d-flex justify-content-end align-items-center">

                            <ol class="breadcrumb justify-content-end">

                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                                <li class="breadcrumb-item active">Kare Store Dashboard</li>

                            </ol>

                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button> -->

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

                                <h5 class="card-title text-uppercase">Total No of Products In Store</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="ti-home text-info"></i></h1>

                                    <div class="ms-auto">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT count(*) as instore FROM `store_entry` WHERE `dep`=0');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                $prda = $datd->fetch(PDO::FETCH_ASSOC);

							    $instore = $prda['instore'];	

                                

                                echo "<h1 class='text-muted'>".$instore."</h1>";

    

                                ?>

                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-sm-6 col-xs-12">

                        <div class="card card-height">

                            <div class="card-body">

                                <h5 class="card-title text-uppercase">Total No of Products Transferd</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="icon-tag text-purple"></i></h1>

                                    <div class="ms-auto">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT count(*) as count FROM `store_list` WHERE `active_record`=1');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                $prda = $datd->fetch(PDO::FETCH_ASSOC);

							    $tot_count = $prda['count'];	

                                

                                echo "<h1 class='text-muted'>".$tot_count."</h1>";

    

                                ?>

                                    

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-sm-6 col-xs-12">

                        <div class="card card-height">

                            <div class="card-body">

                                <h5 class="card-title text-uppercase">Total No of Products in Each Department</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="icon-basket text-danger"></i></h1>

                                    <div class="ms-auto">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT st.`dep_name`, count(st.`dep_name`) as dep_count, c.dep_name as dep_nam FROM `store_list` as st

                                inner join client as c on c.cl_id=st.dep_name

                                WHERE st.`active_record`=1 

                                group by st.`dep_name`');

                                //echo $asd; exit;

                                $datd = $db->query($asd);	

                                while($row = $datd->fetch(PDO::FETCH_ASSOC))

                                {

                                    echo "<h6 class='text-muted'>".$row['dep_nam']."-".$row['dep_count']."</h6>";

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

                                <h5 class="card-title text-uppercase">Total Amount in Store</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="ti-wallet text-success"></i></h1>

                                    <div class="ms-auto">

                                        <!-- <h1 class="text-muted">$8170</h1> -->

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-3 col-sm-6 col-xs-12">

                        <div class="card card-height">

                            <div class="card-body">

                                <h5 class="card-title text-uppercase">Total No of PO Generated</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="ti-home text-info"></i></h1>

                                    <div class="ms-auto">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT count(`wo_no`) as no_po FROM `quot_sup_amt_sel` WHERE `active_record`=1 ');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                $prda = $datd->fetch(PDO::FETCH_ASSOC);

							    $no_po = $prda['no_po'];	

                                

                                echo "<h1 class='text-muted'>".$no_po."</h1>";

    

                                ?>

                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-sm-6 col-xs-12">

                        <div class="card card-height">

                            <div class="card-body">

                                <h5 class="card-title text-uppercase">Store Assest Count</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="icon-tag text-purple"></i></h1>

                                    <div class="ms-auto">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT count(`pro_ty`) as counts FROM `store_entry` WHERE dep=0 and `pro_ty`="Assets"');

                                //echo $asd; exit;

                                $datd = $db->query($asd);

                                $prda = $datd->fetch(PDO::FETCH_ASSOC);

							    $counts = $prda['counts'];	

                               // Print_r($arrayString);

                                

                                echo "<h1 class='text-muted'>".$counts."</h1>";

    

                                ?>

                                    

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-sm-6 col-xs-12">

                        <div class="card card-height">

                            <div class="card-body">

                                <h5 class="card-title text-uppercase">Total No of Asset Products in Each Department</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="icon-basket text-danger"></i></h1>

                                    <div class="ms-auto">

                                    <?php

								

                                require_once("database/connect.php");

                                $db=new Database;

                                $db->connect();

                                $asd =('SELECT c.dep_name as names, count(store_list.`pro_ty`) as counts FROM `store_list`

                                inner join client as c on c.cl_id= store_list.dep_name

                                WHERE store_list.active_record=1 and store_list.`pro_ty`="Assets" group by store_list.dep_name');

                                //echo $asd; exit;

                                $datd = $db->query($asd);	

                                while($row = $datd->fetch(PDO::FETCH_ASSOC))

                                {

                                    echo "<h6 class='text-muted'>".$row['names']."-".$row['counts']."</h6>";

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

                                <h5 class="card-title text-uppercase">Total Amount in Each department</h5>

                                <div class="d-flex align-items-center no-block m-t-20 m-b-10" style="height: 190px;overflow-y: auto;">

                                    <h1><i class="ti-wallet text-success"></i></h1>

                                    <div class="ms-auto">

                                        <!-- <h1 class="text-muted">$8170</h1> -->

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

                    <div class="col-lg-8">

                        <div class="card card-radius">

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

                    <div class="col-lg-4">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card m-b-15 card-radius">

                                    <div class="card-body">

                                        <h5 class="card-title">PROPERTY SALES INCOME</h5>

                                        <div class="row">

                                            <div class="col-6 m-t-30">

                                                <!-- <h1 class="text-info">$64057</h1> -->

                                                <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>

                                            <div class="col-6">

                                                <div id="sparkline2dash" class="text-end"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="card bg-purple m-b-15 card-radius">

                                    <div class="card-body">

                                        <h5 class="text-black card-title">PROPERTY ON RENT INCOME</h5>

                                        <div class="row">

                                            <div class="col-6 m-t-30">

                                                <!-- <h1 class="text-black">$30447</h1> -->

                                                <p class="text-black">APRIL 2017</p> <b class="text-black">(110 Sales)</b> </div>

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

                <!--<div class="row">

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

                </div>-->

                <!-- /.row -->

                <!-- ============================================================== -->

                <!-- End Comment - chats -->

                <!-- ============================================================== -->

                <!-- ============================================================== -->

                <!-- Over Visitor, Our income , slaes different and  sales prediction -->

                <!-- ============================================================== -->

                <!-- .row  -->

                

                <!-- /.row  -->

                <!-- ============================================================== -->

                <!-- End Page Content -->

                <!-- ============================================================== -->

                <!-- ============================================================== -->

                <!-- Right sidebar -->

                <!-- ============================================================== -->

                <!-- .right-sidebar -->

                <div class="right-sidebar">

                    <div class="slimscrollright">

                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>

                        <div class="r-panel-body">

                            <ul id="themecolors" class="m-t-20">

                                <li><b>With Light sidebar</b></li>

                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>

                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>

                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>

                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>

                            </ul>

                            <ul class="m-t-20 chatonline">

                                <li><b>Chat option</b></li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>

                                </li>

                                <li>

                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

                <!-- ============================================================== -->

                <!-- End Right sidebar -->

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

