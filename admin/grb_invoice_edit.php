<?php
include_once("header.php");
?>
<!-- BEGIN CONTENT -->
	<link rel="stylesheet" type="text/css" media="all" href="cal/jsDatePick_ltr.min.css" />
	
	<script type="text/javascript" src="cal/jsDatePick.min.1.3.js"></script>
	<script type="text/javascript">
	function fnload()
	{
	new JsDatePick({useMode:2, target:"p_dob", dateFormat:"%d-%m-%Y",selectedDate:{day:1,month:1,year:2000}});
	}

	</script>
	<div class="page-wrapper">
		<div class="container-fluid">
			
			<div class="row"> 
				<div class="col-sm-12">
					<div class="card"></br>
                        </br>
                        <div class="card-header bg-info">
                            <h4 class="mb-0 text-white">Grb Invoicce Edit </h4>
                        </div></br>
                        </br>
                        <div id="update_div">
  						<div class="form-group px-4 py-5">
							<label class="control-label col-sm-4"><big><font color="red">Edit GRB Entry</font></big> :: Enter GRB Number</label>
						
									                        <!?php
								
                                                            <!--require_once("database/connect.php");-->
                                                            <!--$db=new Database;-->
                                                            <!--$db->connect();-->
                                                            
                                                            <!--// $asd =('SELECT `po_no` FROM `work_order1` WHERE `active_record`=1 group by po_no');-->
                                                            <!--//echo $asd; exit;-->
                                                            
                                                            <!--$asd =('SELECT wo.`dep_no`,wo.`po_no` FROM `work_order1` as wo WHERE `active_record`=1 AND (SELECT SUM(`ddl_pro_qty` - `po_status`) as nodata FROM `work_order1` INNER JOIN suplier AS s ON s.sup_id = work_order1.suplier_id WHERE work_order1.po_no=wo.po_no AND work_order1.`active_record`=1) > 0 GROUP BY `date_time` desc');-->
                                                            <!--$datd = $db->query($asd);-->
                                                            <!--while($data=$datd->fetch(PDO::FETCH_ASSOC))-->
                                                            <!--    {-->
                                                                    <!--echo "<option value='".$data['po_no']."'>".''.$data['dep_no']."/".$data['po_no']."</option>";-->
                                                            <!--}-->
									                        <!--?>-->
									                        
									                        <div class="col-sm-6">
                                							<select name="po_no" id="po_no" class="js-example-basic-multiple" style="width:100%;" onkeypress="view(event);" > 
                                							<option value="">Select GRB No</option>
									                         <?php
								
                                                            require_once("database/connect.php");
                                                            $db=new Database;
                                                            $db->connect();
                                                            
                                                            // $asd =('SELECT `po_no` FROM `work_order1` WHERE `active_record`=1 group by po_no');
                                                            //echo $asd; exit;
                                                            
                                                            $asd =('SELECT `invoice_no` ,`code`,`payment_status` FROM `po_entry` group by `code` ');
                                                            
                                                            //echo $asd;
                                                            
                                                            $datd = $db->query($asd);
                                                            while($data=$datd->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                 if($data['payment_status']!= 0){
                                                                echo "<option value='".$data['invoice_no']."' disabled> finance paid ".$data['invoice_no']."  </option>";
                                                                
                                                                 }
                                                               
                                                                 else 
                                                                 {
                                                                  echo "<option value='".$data['invoice_no']."'>".$data['invoice_no']."</option>";  
                                                                 }
                                                                }
                                                                
									                        ?>
									                        
									                        
								</select>
							</div>
						</div>
                        </div>
					</div>
				</div>	
			</div>

		</div>
			<!-- ============================================================== -->
			</div>
    <!--END continerfluid -->
	<?php require_once("footer.php");?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
	
<!--</form>-->
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


	<link rel="stylesheet" href="assets/jquery-ui.css">
	<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>

<!-- AJAX BODY -->
<script>
    $( document ).ready(function() {
    $(document).on('change', '#po_no', function( e ) {
        
        //alert('#po');
        
	    var this_val = $.trim($(this).val());
	    
		$.ajax({
		type: "GET",
	
		url: 'ajax/get_po_entry_edit.php?val='+$("#po_no").val(),
		
		success: function(data)
	
		{
			$("#update_div").html(data);
		}
		
		});
			//$('#update_div').load('po_preview.php?pid='+$('#po_no').val());
	
	
	});
    });
</script>
<!-- AJAX BODY END -->
<!-- SELECT 2 & DATE PICKER -->

	<script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $( ".bill" ).datepicker({
		changeMonth: true,
		changeYear: true,
	});
    });
    </script>
    <!-- SELECT 2 & DATE PICKER END-->
     