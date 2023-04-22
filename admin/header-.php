<?php
require_once("login_action.php");
user_log_vals();
$user_id = $_SESSION['user_log_email'];
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
<link rel="stylesheet" href="assets\global\plugins\bootstrap\css\bootstrap.min.css">

  <script src="assets\global\plugins\bootstrap\js\bootstrap.min.js"></script>
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

  </style>
 
</head>

<body class="skin-blue fixed-layout">


    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Kare admin</p>
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
                <div>
                    <a class="navbar-brand" href="index.php">
                    </b>
                        <!--End Logo icon -->
                        <center><span><img src="img/favicon/favicons.png" alt="logo" style="width:25px;height:25px;"><span class="font-bold"><?php echo $user_id; ?></span></span></center>
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
                                $purchase ="purchase";
                                $finance ="finance";
                            // ADMIN
                            if($user_id == $admin){?>
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
                            <li> <a class="waves-effect waves-dark" href="transfer.php"><i class="icon-speedometer"></i><span class="hide-menu">Transfer To Store</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="transfered.php"><i class="icon-speedometer"></i><span class="hide-menu">Transfered</span></a>
                            </li>
                            <li class="nav-small-cap">--- Report</li>
                            <li> <a class="waves-effect waves-dark" href="products_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Product Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="supplier_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Supplier Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="quoation_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Quotation Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="client_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Client Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="store_in_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Store In Report</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="store_out_report.php"><i class="icon-speedometer"></i><span class="hide-menu">Store Out Report</span></a>
                            </li>
                            
                            <li class="nav-small-cap">--- Log Out</li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                            <?php
                            }
                            // STORE
                            else if($user_id == $store){?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            <li class="nav-small-cap">--- Dashboard</li>
                            <li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                            </li>

                            <li class="nav-small-cap">--- Quotation</li>
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
                            //purchase
                            else if($user_id == $purchase){?>
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
                            
                            <li class="nav-small-cap">--- Log Out</li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out </a></li>
                            
                            
                                <?php }
                                //finance 
                            else if($user_id == $finance){ ?>
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            <li class="nav-small-cap">--- Dashboard</li>
                            <li> <a class="waves-effect waves-dark" href="index.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                            </li>

                            <li class="nav-small-cap">--- Quotation</li>
                            <li> <a class="waves-effect waves-dark" href="po_list.php"><i class="icon-speedometer"></i><span class="hide-menu">PO List</span></a>
                            </li>
                            
                            <li class="nav-small-cap">--- Store</li>
                            <li> <a class="waves-effect waves-dark" href="store_list.php"><i class="icon-speedometer"></i><span class="hide-menu">Store List</span></a>
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
                            <?php 
                            }
                            ?>

                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
