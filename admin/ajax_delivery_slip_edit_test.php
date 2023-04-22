<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$code=base64_decode($_GET['dep_no']);

echo $code;

require_once("header.php"); ?>

<style>
    #hidden_div
    {
        display: none;
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Transfer To Store</h4>
                    </div>

                    

                    <div class="card-body">
                        <div class="row pt-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="trn_dlr_pi_inv">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center">Serial NO.</th>
                                        <th class="text-center">Company Name.</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Product Specification</th>
                                        <th class="text-center">Bill Date</th>
                                        <th class="text-center">Warranty Date</th>
                                        <th class="text-center">PO No</th>
                                         <th class="text-center">Transferred Date</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="col-md-12 mt-5 mb-5">
                                <div class="col-md-4">
									<input type ="hidden" name="code" value="<?php echo $code; ?>">
                                    <select name="reason" class="form-control" id="reason">
                                        <option value="" selected disabled>Select Reason</option>
<!--
                                        <option value="warranty">Warranty</option>
-->
<!--
                                        <option value="unwarranty">UnWarranty</option>
-->
<!--
                                        <option value="unwarranty">Back To Store</option>
-->
                                        <option value="client">Client</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="toclient_blk" style="display: none;">
                                    <select name="toclient" class="form-control" id="toclient">
                                        <option value="" selected disabled>Select Client</option>
                                        <?php
                                        $client_data = $db->query('SELECT `cl_id`, `dep_name`,`block`,`room_no` FROM `client` WHERE `active_record`= 1');
                                        while ($clda = $client_data->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $clda['cl_id'] . '">' . $clda['dep_name'] . ' - ' . $clda['block'] . ' - ' . $clda['room_no'] . ' </option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4"><label>Selected Count</label>
                                    <input type = "text" name= "checkbox_count" readonly class="checkbox_count" id= "checkbox_count">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success mt-2 w-75 py-2 text-uppercase fw-bold" id="transfer_btn">Transfer</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("footer.php");?>

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/waves.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
<script src="dist/js/custom.min.js"></script>
<script src="dist/js/pages/jasny-bootstrap.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!--<script src="assets/auto.js"></script>-->
<!--<script src="assets/autocomplete.js"></script>-->
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"/>
<script src="assets/global/plugins/select2/js/select2.min.js"></script>
<!--<script src="assets/datatable/jquery.dataTables.min.js"></script>-->

<link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/datatables/select/css/select.dataTables.min.css"/>

<script src="assets/datatables/datatables.min.js"></script>
<script src="assets/datatables/select/js/dataTables.select.min.js"></script>

<script>
    $(document).ready(function () {
		//~ if(client_log_id) {
            var rows_selected = [];
            var code = '<?php echo $code; ?>'; 
            console.log(code);
            var Otable = $('#trn_dlr_pi_inv').DataTable({
                columnDefs: [{
                    targets: 0,
                    data: null,
                    defaultContent: '',
                    orderable: false,
                    className: 'dtbl-checkbox',
                    'render': function (data, type, full, meta){
                        return '<input type="checkbox" name="dt_checkbox">';
                    }
                }, {
                    target: 1,
                    data: 1,
                    visible: false,
                    searchable: false,
                    render: function (id) {
                        return '<input type="hidden" name="store_id[]" value="' + id + '" data-id="' + id + '" />';
                    }
                }],
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
               order: [[ 1, 'asc' ]],
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthMenu": [[25, 50, 100, 250], [25, 50, 100, 250]],
                "ajax": {
                    "type": "POST",
                    "data": {code: code},
                    "url": "delivery_slip_return_test.php",
                },
                "rowCallback": function(row, data, dataIndex){
                    let rowId = data[2];
                    if($.inArray(rowId, rows_selected) !== -1){
                        $(row).find('input[name="dt_checkbox"]').prop('checked', true);
                        $(row).addClass('selected');
                    }
                }
            });


            $('#trn_dlr_pi_inv tbody').on('click', 'input[name="dt_checkbox"]', function(e){
                var tbl_row = $(this).closest('tr');
                var data = Otable.row(tbl_row).data();
                var rowId = data[2];
                 var check = $('input[type="checkbox"]:checked').length;
                 $("#checkbox_count").val(check);
                   // alert(check);
                var index = $.inArray(rowId, rows_selected);
                if(this.checked){
                    if(index === -1) rows_selected.push(rowId);
                    tbl_row.addClass('selected');
                } else {
                    if(index !== -1) rows_selected.splice(index, 1);
                    tbl_row.removeClass('selected');
                }

                e.stopPropagation();
            });

            $('#trn_dlr_pi_inv').on('click', 'tbody td:first-child', function(e){
                $(this).parent().find('input[name="dt_checkbox"]').trigger('click');
            });


            $("#transfer_btn").click(function(){
                let transfer_seno = rows_selected;

                if(transfer_seno.length > 0){
                    var reason_elem = $('#reason');
                    var toclient_elem = $('#toclient');
                   var selected_quantity =  $('#checkbox_count');
                     
                    var reason_val = reason_elem.val();
                    var toclient_val = toclient_elem.val();
                    var selected_quantity_val = selected_quantity.val();

                    if(!reason_val){
                        alert('Select Transfer Reason');
                    }else if(reason_val === 'client' && !toclient_val){
                        alert('Select Client for Transfer');
                    }else{
                        var formData = new FormData();
                        //~ formData.append('frmclient', fromdep);
                        formData.append('seno', transfer_seno);
                        formData.append('reason', reason_val);
                        formData.append('quantity', selected_quantity_val);
                        formData.append('code', code);
                        if (reason_val === 'client') {
                            formData.append('toclient', toclient_val);
                        }

                        $.ajax({
                            url: 'ajax/delivery_slip_update.php',
                            type: 'post',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (res) {
                                if(res.status){
                                    alert('Transfered Successfully');
                                    location.reload();
                                }else{
                                    if(res.err_msg){
                                        alert(res.err_msg);
                                    }else{
                                        alert('Failed to Transfer! Try Again');
                                    }
                                }
                            }
                        });
                    }

                }else{
                    alert('Select Checkboxes for Transfer');
                }

            });
		//~ }

        $('.js-example-basic-multiple').select2();

        $('#reason').on('change',function (){
            var transfer_to = $(this).val();
            var toclient_blk_elm = $('#toclient_blk');
            if(transfer_to === 'client'){
                toclient_blk_elm.css('display','block');
            }else{
                toclient_blk_elm.css('display','none');
            }
        })

    });

</script>

</body>
</html>
