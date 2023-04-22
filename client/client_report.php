<?php
require_once("header.php");
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bgclr mt-5">
                        <h4 class="mb-0 text-white">Client report</h4>
                    </div>

                    <form autocomplete="off"> 
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="trn_dlr_pi_inv">
                                            <thead>
                                            <tr>
                                                <th class="text-center">S.No.</th>
                                                <th class="text-center">Department Name.</th>
                                                <th class="text-center">Block</th>
                                                <th class="text-center">Room No</th>
                                                <th class="text-center no-flt">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody1">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once("footer.php"); ?>

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/waves.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
<script src="dist/js/custom.min.js"></script>

<!-- This page plugins -->
<script src="dist/js/pages/jasny-bootstrap.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
<script src="assets/datatable/jquery.dataTables.min.js"></script>
<script src="assets/datatable/buttons.dataTables.min.js"></script>

<script src="assets/auto.js"></script>
<script src="assets/autocomplete.js"></script>
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"/>
<script src="assets/global/plugins/select2/js/select2.min.js"></script>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

<!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
<script>
    $(document).ready(function () {
        var this_val = 1;
        $.ajax({
            type: "GET",
            url: 'ajax/ajax_client_report.php?po_no=' + this_val,
            success: function (data) {
                $('#tbody1').html(data);
            }
        });

        $('.js-example-basic-multiple').select2();

    });
</script>

</body>
</html>
        