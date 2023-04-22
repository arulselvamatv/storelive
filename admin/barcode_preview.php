<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Barcodes</title>
</head>
<body>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();
$code=$_GET['pid'];

$asd =('SELECT sl.`sl_id`, sl.`code`, sl.`sl_no`, sl.`se_no`, sl.`quo_no`, sl.`po_no`, sl.`prod_name`, sl.`pro_ty`, sl.`ddl_pro_qty`, sl.`ddl_pro_spec`, sl.`supname`, sl.`rate`, sl.`date_time`, sl.`dep_name`, sl.`crn_date_time`, sl.`active_record`, s.company_name FROM `store_list` as sl 
INNER JOIN suplier as s on s.sup_id = sl.supname
WHERE sl.`active_record`= 1 and sl.se_no="'.$code.'"');
		// echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);

		echo'<section class="bardoce-wrapper">
        <div class="bardoce-container">';
while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
			$i++;
			echo"
			<style>
				@media{
					size:A4 Portrait;
				}
				div.b128{
					border-left: 1px black solid;
					height: 10px;
				   }
				   .bardoce-wrapper {width:1140px; margin:0 auto;}
					.bardoce-container {width:100%; float:left; margin:0; padding:0;}
						.bardoce-item {width:24%; float:left; margin:20px 0; padding:0;}
						.bardoce-item svg {height: 100px;}
						 
			</style>";
		
	  echo "<div class='bardoce-item'>
	  			<span class='border border-secondary'>
					<center>
				   		<div>
							<div class='project-box' data-aos='fade-up'>
								<h5 style='margin:0'>".$prd['prod_name']."</h5>
								<div class='seno'  id='seno".$i."'>
									<svg class='bar' id='barcode_".$i."'></svg>
									<input type='hidden' class='se_no' id='se_no_".$i."' value='".$prd['se_no']."'>
								</div>
							</div>
						</div>
					</center>
				</span>
					
			</div>";
	
}
echo'
</div>
</section>';

?>
<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/jquery_ui/jquery-ui.js"></script>
<script src="assets/JsBarcode.all.min.js"></script>

<script>
	$(document).ready(function() {	
		$(".se_no").each(function (index, element) {
					var this_attr_id = $.trim($(this).attr("id"));
                	var splt_this_id = this_attr_id.split("_");
                	var splt_this_id_ar = splt_this_id[2];
					var se_no = $(element).val();
					 JsBarcode("#barcode_"+splt_this_id_ar, se_no);
				});
			});

</script>
	
</body>
</html>