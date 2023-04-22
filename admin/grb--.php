<?php
include_once("header.php");
?>
<!-- BEGIN CONTENT -->
	<link rel="stylesheet" type="text/css" media="all" href="cal/jsDatePick_ltr.min.css" />
	<script type="text/javascript" src="cal/jsDatePick.min.1.3.js"></script>
	<script type="text/javascript">
	function fnload(){
				
				new JsDatePick({useMode:2, target:"p_dob", dateFormat:"%d-%m-%Y",selectedDate:{day:1,month:1,year:2000}});
				
				}

	</script>
	<div class="page-wrapper">
		<div class="container-fluid">
			
			<div class="row"> 
				<div class="col-sm-12">
					<div class="card">
                        <div class="card-header bg-info">
                            <h4 class="mb-0 text-white">Generate GRB</h4>
                        </div>
  						

<div id="update_div" class="p-4"></div>

                                <?php
								
					require_once("database/connect.php");
					$db=new Database;
					$db->connect();
          $asd =('SELECT  sl.`invoice_no`, sl.`ddl_pro_qty`, sl.`ins_id`, sl.`installation`, sl.`tran_charge`, sl.`packing`, sl.`advance`, s.company_name, s.name, sl.date_time FROM `slip_list` as sl
          inner join suplier as s on s.sup_id =  sl.sup_id
          WHERE sl.`active_record`=1  group by sl.`invoice_no` order by sl.`invoice_no` desc');
                    //echo $asd; exit;
                    $datd = $db->query($asd);
                    echo'<div class="px-4 pb-4"><b>GRB Slip  Report</b><hr /><table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';
                    echo "<thead><tr>";
                    echo "<th>S.No.</th>";
                    echo "<td>Invoice No.</td>";
                    echo "<td>Suplier Name.</td>";
                    echo "<td>Date & Time</td>";
                    echo "<td>Edit</td>";
                    echo "<td>View</td>";
                    echo "</tr></thead><tbody>";
                    $sno=0;
                    while($row = $datd->fetch(PDO::FETCH_ASSOC))
                    {
                      echo "<tr>";
                      echo "<td>".(++$sno).".</td>";//".(++$sno).".
                      echo "<td>".$row['invoice_no']."</td>";
                      echo "<td>".$row['company_name']."</td>";
                      echo "<td>".$row['date_time']."</td>";
                      echo "<td><input type='button' class='editer' name='edit-button[]' id='edit-button_".$row['invoice_no']."' value='Edit'/></td>";
                      echo "<td><input type='button' class='view' name='view-button[]' id='view-button_".$row['invoice_no']."' value='View'/></td>";
                      //<a href='pdf/quotation_pdf.php?serial_no="($row['serial_no'])."' target='_blank'>Export To PDF-".$row['code']."</a>
                      // <a href='pdf/quotation_pdf.php?serial_no=".$this->encrypt_decrypt($this->killChars($row['serial_no']), $action = 'encrypt')."' target='_blank'>Export To PDF-".$row['code']."</a>
                      //".$this->encrypt_decrypt($this->killChars($row['pinvpid']), $action = 'encrypt')."' target='_blank'
                      echo "</tr>";
                    }
                    echo "</tbody></table></div>";
          ?>
<!--</form>-->
		</div>
</div>	
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
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>

<script type="text/javascript">

$(document).on('click', '.view', function( e ) {
	
	$("#update_div").html("");
	
	var this_attr_id = $.trim($(this).attr("id"));
    var splt_this_id = this_attr_id.split("_");
    var splt_this_id_ar = splt_this_id[1];
	//alert(splt_this_id_ar);
	
		$.ajax({
		type: "GET",
		url: 'ajax/get_GRB_entry.php?inv='+splt_this_id_ar+'&a=1',
		success: function(data){
			
			$("#update_div").html(data);
			
		}
		});
		
		//$("#update_div").html("<table width='100%'><tr><td align='center'><a class=\"btn btn-primary\" href=grb_preview.php?pid="+$('#po_no').val()+" target='_blank'> Click here to print</a> </td></tr></table>");
			//$('#update_div').load('po_preview.php?pid='+$('#po_no').val());
	
	
	
		});
</script>
<script type="text/javascript">

$(document).on('click', '.editer', function( e ) {
	
	$("#update_div").html("");
	
	var this_attr_id = $.trim($(this).attr("id"));
    var splt_this_id = this_attr_id.split("_");
    var splt_this_id_ar = splt_this_id[1];
	//alert(splt_this_id_ar);
	
		$.ajax({
		type: "GET",
		url: 'ajax/get_GRB_entry.php?inv='+splt_this_id_ar+'&a=2',
		success: function(data){
			
			$("#update_div").html(data);
			
		}
		});
		
		//$("#update_div").html("<table width='100%'><tr><td align='center'><a class=\"btn btn-primary\" href=grb_preview.php?pid="+$('#po_no').val()+" target='_blank'> Click here to print</a> </td></tr></table>");
			//$('#update_div').load('po_preview.php?pid='+$('#po_no').val());
	
	
	
		});
</script>
	<script>
	$(document).ready(function() {				
		
		//=====auto complete function while typing name =========
    
		// end of id search ===================
		Layout.init(); // init layout	
		});
	</script>
	
	
	