
<?php
require_once("login_action.php");
user_log_vals();
$user_id = $_SESSION['user_log_email'];
// echo $user_id;
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
    
    <title>Asis Store</title>
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


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


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

.logo_class {padding-top: 0px;position: inherit;z-index: 10;top: 0px;}
/*--------- SEP 30 --------*/
.bgclr{
    background:#094e6c !important ; 
}
.card-height {
    min-height: 300px;
    border-radius: 15px;
    border: 1px solid #c4c4c4;
    -webkit-box-shadow: 0 0 10px #c4c4c4;
    box-shadow: 0 0 10px #c4c4c4;
    background: linear-gradient(to right, #FDFBFB, #99DDFB 420%);
}    
.icon_class {
    line-height: 0px;
    color: #094e6c !important;
}
.card-header {
    padding: 0.75rem 1.25rem; 
}
.table_class, thead, tr {
    background: #f6feff !important; 
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
            <p class="loader__label">Asis Client</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar bgclr">
            <nav class="navbar navbar-expand-md navbar-dark mb-0 p-0">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="logo_class">
                    <a class="navbar-brand p-0" href="index.php">
                         
                        <!--End Logo icon -->
                        <span class="ms-3"><img src="img/favicon/favicons.png" alt="logo" style="width:55px;height:45px;"></span>
                        <span class="fw-bold text-uppercase pt-5"><?php echo $user_id; ?></span>
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
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="bi bi-justify"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark text-white" href="javascript:void(0)"><i class="bi bi-justify h2"></i></a> </li>
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
                    <a class="navbar-brand pt-4" href="logout.php"> 
                        <!--End Logo icon -->
                        <i class="icon-key"></i><span class="fw-bold text-uppercase "> Log Out</span> 
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
            <aside class="left-sidebar pt-0">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            
                            <li class="nav-small-cap"><?php $user_id ?></li>
                            <li> <a class="waves-effect waves-dark text-decoration-none" href="index.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Dashboard</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark text-decoration-none" href="dep_bought_list.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">List Of Product Bought By Department</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark text-decoration-none" href="waranty.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Waranty Check</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark text-decoration-none" href="transfer.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfer</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark text-decoration-none" href="transfered.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Transfered</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark text-decoration-none" href="client_report.php"><i class="bi bi-arrow-right-square-fill icon_class"></i><span class="hide-menu">Client Report</span></a>
                            </li>
                                            
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
