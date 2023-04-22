<?php
require_once("login_action.php");
user_log_vals();
$user_id = $_SESSION['user_log_email'];
$user_type = $_SESSION['user_log_type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicons.png">
    
    <title>Kare Store</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="dist/css/new_style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- page css -->
    <!-- <link href="dist/css/pages/file-upload.css" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    
<![endif]-->
<!-- <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/> -->
<!-- <link rel="stylesheet" href="assets\global\plugins\bootstrap\css\bootstrap.min.css"> -->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
  <!--<script src="assets\global\plugins\bootstrap\js\bootstrap.min.js"></script>-->
  <link rel="stylesheet" href="assets\datatables\jquery.dataTables.min.css">
  <link rel="stylesheet" href="assets\datatables\buttons.dataTables.min.css">
  <style>
.scroll {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 200px;
height: 200px;
overflow: scroll;
}
::-webkit-scrollbar {
width: 12px;
height: 12px;
}
::-webkit-scrollbar-track {
border: 1px solid #03a9f3;
border-radius: 10px;
}
::-webkit-scrollbar-thumb {
background: #03a9f3;
border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
background: #03a9f3;
}

.logo_class {padding-top: 0px;position: inherit;z-index: 10;top: 0px;}
  </style>
 
</head>

<body class="skin-blue fixed-layout">


    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">KARE ADMIN</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="logo_class">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                        <!-- Light Logo icon -->
                        <!-- <img src="img/favicon/favicons.png" alt="homepage" class="light-logo" style="width=20px; height=20px" /> -->
                    </b>
                        <!--End Logo icon -->
                        <span><img src="img/favicon/favicons.png" alt="logo" style="width:25px;height:25px;"><span><?php echo $user_id; ?></span></span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li> -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="logout.php">
                    </b>
                        <!--End Logo icon -->
                        <center><span><i class="icon-key"></i><span class="font-bold"> Log Out</span></span></center>
                    </a>
                    
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            
                        <?php   
                        //echo $user_id; exit;
                                $admin = "admin";
                                $store ="store";
                                $quotation ="quotation";
                                $purchase="purchase";
                                $finance="finance";
                            // ADMIN
                            if($user_id == $admin){?>
                            <!--<li class="nav-small-cap"><?php $user_id ?></li>-->
                            <li class="nav-title"><span class="hide-menu">Dashboard</span></li>
                            <li> <a class="waves-effect waves-dark" href="index.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Dashboard</span></a>
                            </li>
                            <li class="nav-title"><span class="hide-menu">Purchase Order</span></li>
                            <li> <a class="waves-effect waves-dark" href="suplier.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Suplier Details</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="po.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Purchase Order</span></a>
                            </li> -->

                            <li class="nav-title"><span class="hide-menu">Product Details</span></li>
                            <li> <a class="waves-effect waves-dark" href="unit.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Unit</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="categary.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Categary</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="product_details.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Product Details</span></a>
                            </li>
                            

                            <li class="nav-title"><span class="hide-menu">Quotation</span></li>
                            <li> <a class="waves-effect waves-dark" href="quotion.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Quotation</span></a>

                            <li> <a class="waves-effect waves-dark" href="suplier_quotaion_url_generation.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Genarate Url For Supplier</span></a>
                            </li>

                            </li>
                            <li> <a class="waves-effect waves-dark" href="quotion_amount.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Quotation Supplier Amount </span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="quotion_amount_select.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Quotation Supplier Amount Select</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="work_order.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Work Order List</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="po_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">PO List</span></a>
                            </li>
                            <li><a class="waves-effect waves-dark" href="po-reminder-report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">PO Reminder Report</span></a>
                            </li>
                            <li class="nav-title"><span class="hide-menu">Store</span></li>
                            <li> <a class="waves-effect waves-dark" href="client.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Client</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="client_details.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Client Details</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="pi.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Invoice Product</span></a>
                            </li> -->
                            
                            <li> <a class="waves-effect waves-dark" href="store_in.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store IN Entry</span></a>
                            </li>
                            
                            
                             <!-- <li> <a class="waves-effect waves-dark" href="delivery_slip.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">Inward Slip</span></a>
                            </li> -->

                            <li> <a class="waves-effect waves-dark" href="delivery_slip_test.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">Inward Slip</span></a>
                            </li>
                            
                            <li> <a class="waves-effect waves-dark" href="store_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store List</span></a>
                            </li>
                            
                             <li> <a class="waves-effect waves-dark" href="store_stock_list.php" ><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store Stock List</span></a>
                            </li>

                            <li> <a class="waves-effect waves-dark" href="po_in.php"><i class="bi bi-arrow-right-square-fill icon_class me-1 "></i><span class="hide-menu">GRB Entry</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="slip.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">GRB Verification Slip</span></a>
                            </li>
                            
                            <li> <a class="waves-effect waves-dark" href="grb.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">GRB List</span></a>
                            </li>

                            <li> <a class="waves-effect waves-dark" href="grb_invoice_edit.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">GRB List Edit</span></a>
                            </li>

                            <!--<li> <a class="waves-effect waves-dark" href="slip.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class"></i>Verification Slip</span></a>-->
                            <!--</li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="grb.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class"></i>GRB List</span></a>-->
                            <!--</li>-->
                            
                            
                            <li class="nav-title"><span class="hide-menu">FINANCE INWARD</span></li>
                          
                           <!-- <li class="nav-title"><span class="hide-menu"> Finance inward Start</span></li> -->

                            <!-- <li> <a class="waves-effect waves-dark" href="finance_in.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">Finance In Entry</span></a>
                            </li> -->
                            
                            <li> <a class="waves-effect waves-dark" href="finance_in_advance.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i>Finance In Entry For Advance</span></a>
                            </li>
                            
                            <li> <a class="waves-effect waves-dark" href="finance_in_test.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i>Finance In Entry For Payment</span></a>
                            </li>
                            
                            
                            
                            <li class="nav-title"><span class="hide-menu">Client</span></li>
                            
                            <li> <a class="waves-effect waves-dark" href="dep_bought_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">List Of Product Bought By Department</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="waranty.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Waranty Check</span></a>
                           </li>
                            <li> <a class="waves-effect waves-dark" href="transfer.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfer To Store</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="transfered.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class"></i>Transfered</span></a>
                            </li> -->

                            <li> <a class="waves-effect waves-dark" href="transfer_return_report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfer To Store(store in Report)</span></a>
                            </li>


                             <li> <a class="waves-effect waves-dark" href="transfered_datatable.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfered</span></a>
                            </li> 

                           
                            <li> <a class="waves-effect waves-dark" href="transfered_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfered List</span></a>
                            </li>

                            <li> <a class="waves-effect waves-dark" href="back_to_store_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Back To Store List</span></a>
                            </li>

                            <!-- <li> <a class="waves-effect waves-dark" href="transfered_history_list_report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfered History List (Report)</span></a>
                            </li> -->
                            
                             <li> <a class="waves-effect waves-dark" href="transfered_history_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfered History  List</span></a>
                            </li>
                            
                            <li class="nav-title"><span class="hide-menu">Report</span></li>

                            <li> <a class="waves-effect waves-dark" href="client_out_report.php"><i class="bi bi-arrow-right-square-fill icon_class me-2"></i><span class="hide-menu">Store Out Report</span></a>
                            </li>


                            <li> <a class="waves-effect waves-dark" href="supplier_in_report.php"><i class="bi bi-arrow-right-square-fill icon_class me-2"></i><span class="hide-menu">Supplier In Report</span></a>
                            </li>

                            <li> <a class="waves-effect waves-dark" href="store_in_excel_report.php"><i class="bi bi-arrow-right-square-fill icon_class me-2"></i><span class="hide-menu">Store In Excel Report</span></a>
                            </li>
                            
                            
                              <li> <a class="waves-effect waves-dark" href="grb_in_excel_report.php"><i class="bi bi-arrow-right-square-fill icon_class me-2"></i><span class="hide-menu">GRB In Excel Report</span></a>
                            </li>

                            <!-- <li class="nav-title"><span class="hide-menu">Report</span></li> -->

                            <!-- <li> <a class="waves-effect waves-dark" href="products_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Product Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="supplier_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Supplier Report</span></a>
                            </li> -->
                            <!-- <li> <a class="waves-effect waves-dark" href="quoation_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Quotation Report</span></a>
                            </li> -->
                            <li> <a class="waves-effect waves-dark" href="client_report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Client Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="store_in_report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store In Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="store_out_report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store Out Report</span></a>
                            </li>
                            <li class="nav-title"><span class="hide-menu">Log Out</span></li>
                            <li><a href="logout.php"><i class="icon-key"></i><span class="hide-menu"> Log Out </span></a></li>
                            <?php
                            }
                             // SUPERADMIN
                          else  if($user_type == 6){?>
                            <li class=nav-small-cap><?php $user_id ?></li>
                            <li class=nav-small-cap>--- Dashboard</li>
                            <li><a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
                            <li class=nav-small-cap>--- Quotation</li>
                            <li><a class="waves-effect waves-dark" href="po_list.php"><i class=icon-speedometer></i><span class="hide-menu">PO List</span></a></li>
                            <li><a class="waves-effect waves-dark" href=quotion_amount_select.php><i class=icon-speedometer></i><span class="hide-menu">Add Quotation Supplier Amount Select</span></a></li>
                            <li class=nav-small-cap>--- Signature</li>
                            <li><a class="waves-effect waves-dark" href=add_signature.php><i class=icon-speedometer></i><span class="hide-menu">Add Signature</span></a></li>
                            <li class=nav-small-cap>--- Log Out</li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                             <?php
                            }
                            
                            // TEST
                            else if($user_id == $test){?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            <li class="nav-small-cap">--- Dashboard</li>
                            <li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                            </li>
                            <li class="nav-small-cap">--- Purchase Order</li>
                            <li> <a class="waves-effect waves-dark" href="suplier.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Suplier Details</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="po.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Purchase Order</span></a>
                            </li> -->

                            <li class="nav-small-cap">--- Product Details</li>
                            <li> <a class="waves-effect waves-dark" href="categary.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Categary</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="product_details.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Product Details</span></a>
                            </li>
                            

                            <li class="nav-small-cap">--- Quotation</li>
                            <li> <a class="waves-effect waves-dark" href="quotion.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="quotion_amount.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount </span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="quotion_amount_select.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount Select</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="work_order.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Work Order List</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="po_list.php"><i class="icon-speedometer"></i><span class="hide-menu">PO List</span></a>
                            </li>
                            
                            <li class="nav-small-cap">--- Store</li>
                            <li> <a class="waves-effect waves-dark" href="client.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Client</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="client_details.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Client Details</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="pi.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Invoice Product</span></a>
                            </li> -->
                            
                            <li> <a class="waves-effect waves-dark" href="store_in.php"><i class="icon-speedometer"></i><span class="hide-menu">Store IN Entry</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="store_list.php"><i class="icon-speedometer"></i><span class="hide-menu">Store List</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="slip.php"><i class="icon-speedometer"></i><span class="hide-menu">Verification Slip</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="grb.php"><i class="icon-speedometer"></i><span class="hide-menu">GRB List</span></a>
                            </li>
                            <li class="nav-small-cap">--- Client</li>
                            <li> <a class="waves-effect waves-dark" href="dep_bought_list.php"><i class="icon-speedometer"></i><span class="hide-menu">List Of Product Bought By Department</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="waranty.php"><i class="icon-speedometer"></i><span class="hide-menu">Waranty Check</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="#Transfer"><i class="icon-speedometer"></i><span class="hide-menu">Transfer</span></a>
                            </li>
                            <li class="nav-small-cap">--- Log Out</li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                            <?php }
                            //STORE
                            else if($user_type == 2){?>
                            <li class="nav-small-cap"><?php $user_id ?></li>

                            <li class="nav-title"><span class="hide-menu">Dashboard</span></li>
                            <li> <a class="waves-effect waves-dark" href="index.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Dashboard</span></a>
                            </li>
                            <li class="nav-title"><span class="hide-menu">Store</span></li>
                            <li> <a class="waves-effect waves-dark" href="client.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Client</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="client_details.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Add Client Details</span></a>
                            </li> -->
                            <!-- <li> <a class="waves-effect waves-dark" href="pi.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Invoice Product</span></a>
                            </li> -->
                            
                            <li> <a class="waves-effect waves-dark" href="store_in.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store IN Entry</span></a>
                            </li>
                            
                            
                             <li> <a class="waves-effect waves-dark" href="delivery_slip.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">Inward Slip</span></a>
                            </li>
                            
                            <li> <a class="waves-effect waves-dark" href="store_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store List</span></a>
                            </li>
                            
                             <li> <a class="waves-effect waves-dark" href="store_stock_list.php" ><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Store Stock List</span></a>
                            </li>

                            <li> <a class="waves-effect waves-dark" href="supplier_in_report.php"><i class="bi bi-arrow-right-square-fill icon_class me-2"></i><span class="hide-menu">Supplier In Report</span></a>
                            </li>

                            
                            <li> <a class="waves-effect waves-dark" href="client_out_report.php"><i class="bi bi-arrow-right-square-fill icon_class me-2"></i><span class="hide-menu">Client Out Report</span></a>
                            </li>


                            <li> <a class="waves-effect waves-dark" href="po_in.php"><i class="bi bi-arrow-right-square-fill icon_class me-1 "></i><span class="hide-menu">GRB Entry</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="slip.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">GRB Verification Slip</span></a>
                            </li>
                            
                            <li> <a class="waves-effect waves-dark" href="grb.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">GRB List</span></a>
                            </li>

                            <li> <a class="waves-effect waves-dark" href="grb_invoice_edit.php"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><span class="hide-menu">GRB List Edit</span></a>
                            </li>
                                <!-- <li class="nav-small-cap">--- Client</li>
                                <li> <a class="waves-effect waves-dark" href="dep_bought_list.php"><i class="icon-speedometer"></i><span class="hide-menu">List Of Product Bought By Department</span></a>
                                </li>
                                <li> <a class="waves-effect waves-dark" href="waranty.php"><i class="icon-speedometer"></i><span class="hide-menu">Waranty Check</span></a>
                                </li> -->
                                <li class="nav-title"><span class="hide-menu">Log Out</span></li>                                <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                                <!-- <li> <a class="waves-effect waves-dark" href="#Transfer"><i class="icon-speedometer"></i><span class="hide-menu">Transfer</span></a>
                                </li>  -->
                                <?php }
                                //QUOTATION 
                            else if($user_id == $quotation){ ?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                                <li class="nav-small-cap">--- Quotation</li>
                                <li> <a class="waves-effect waves-dark" href="quotion.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation</span></a>
                                </li>
                                <li> <a class="waves-effect waves-dark" href="quotion_amount.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount </span></a>
                                </li>
                                <li> <a class="waves-effect waves-dark" href="quotion_amount_select.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount Select</span></a>
                                </li> 
                                <li class="nav-small-cap">--- Log Out</li>
                                <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>  
                            <?php 
                            }
                            else if($user_type == 3){?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            <li class="nav-small-cap">--- Dashboard</li>
                            <li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                            </li>
                            <li class="nav-small-cap">--- Suplier Details</li>
                            <li> <a class="waves-effect waves-dark" href="suplier.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Suplier Details</span></a>
                            </li>
                            <!-- <li> <a class="waves-effect waves-dark" href="po.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Purchase Order</span></a>
                            </li> -->

                            <li class="nav-small-cap">--- Product Details</li>
                            <li> <a class="waves-effect waves-dark" href="categary.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Categary</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="product_details.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Product Details</span></a>
                            </li>
                            

                            <li class="nav-small-cap">--- Quotation</li>
                            <li> <a class="waves-effect waves-dark" href="quotion.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="quotion_amount.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount </span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="quotion_amount_select.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount Select</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="work_order.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Work Order List</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="po_list.php"><i class="icon-speedometer"></i><span class="hide-menu">PO List</span></a>
                            </li>

                            <li class="nav-small-cap">--- Store</li>
                            <li> <a class="waves-effect waves-dark" href="store_list.php"><i class="icon-speedometer"></i><span class="hide-menu">Store List</span></a>
                            </li>
                            <!--<li><a class="waves-effect waves-dark" href="grb.php"><i class="icon-speedometer"></i><span class="hide-menu">GRB List</span></a></li>-->
                            
                            <li class="nav-small-cap">--- Log Out</li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                            
                                <?php }
                                //suplier
                                 else if($user_type == 5){?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            <li class="nav-small-cap">--- Dashboard</li>
                            <!--<li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>-->
                            </li>
                            

                            <li class="nav-small-cap">--- Quotation</li>
                            <li><a class="waves-effect waves-dark" href="quotation_suplier_amount.php"><i class="icon-speedometer"></i><span class="hide-menu">Add Quotation Supplier Amount </span></a></li>
                            <li class="nav-small-cap">--- Log Out</li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                            
                            <?php }
                            //finance 
                            else if($user_id == $finance){ ?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            
                            <li class="nav-title">Dashboard</li>
                            
                             <li> <a class="waves-effect waves-dark" href="index.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1 "></i><b>Dashboard</b></span></a>
                            </li>
                            
                            <!--<li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>-->
                            
                            
                             <li class="nav-title">PO INWARD</li>
                            <li> <a class="waves-effect waves-dark" href="po_in.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1 "></i><b>PO IN Entry</b></span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="slip.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><b>Verification Slip</b></span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="grb.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><b>GRB List</b></span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="finance_in.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><b>Finance In Entry</b></span></a>
                            </li>
                            
                            
                            <!--<li class="nav-small-cap">--- Dashboard</li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>-->
                            <!--<li class="nav-small-cap">--- Quotation</li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="po_list.php"><i class="icon-speedometer"></i><span class="hide-menu">PO List</span></a></li>-->
                            <!--<li class="nav-small-cap">--- Store</li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="store_list.php"><i class="icon-speedometer"></i><span class="hide-menu">Store List</span></a></li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="grb.php"><i class="icon-speedometer"></i><span class="hide-menu">GRB List</span></a></li>-->
                            <!--<li class="nav-small-cap">--- Client</li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="dep_bought_list.php"><i class="icon-speedometer"></i><span class="hide-menu">List Of Product Bought By Department</span></a></li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="waranty.php"><i class="icon-speedometer"></i><span class="hide-menu">Waranty Check</span></a></li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="#Transfer"><i class="icon-speedometer"></i><span class="hide-menu">Transfer</span></a></li> -->
                            
                            
                            <li class="nav-title">Log Out</li>
                            
                             <li> <a class="waves-effect waves-dark" href="logout.php"><span class="hide-menu"><i class="bi bi-arrow-right-square-fill icon_class me-1"></i><b>Log Out</b></span></a>
                            </li>
                            
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li> 
                            <?php  } ?>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
