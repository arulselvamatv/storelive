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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db=new Database;
$db->connect();
$code=$_GET['pid'];

$asd =('SELECT sl.`sl_id`, sl.`code`, sl.`sl_no`, sl.`se_no`, sl.`quo_no`, sl.`po_no`, sl.`prod_name`, sl.`pro_ty`, sl.`ddl_pro_qty`, sl.`ddl_pro_spec`, sl.`supname`, sl.`rate`, sl.`date_time`, sl.`dep_name`, sl.`crn_date_time`, sl.`active_record`, s.company_name FROM `store_list` as sl 
INNER JOIN suplier as s on s.sup_id = sl.supname
WHERE sl.`active_record`= 1 and sl.code='.$code.'');
		//echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);

		echo'<section class="bardoce-wrapper">
        <div class="bardoce-container">';
while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
			// $bar=$prd['se_no'];
		    // echo $bar;

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
				   .bardoce-wrapper {width:1600px; margin:0 auto;}
					.bardoce-container {width:100%; float:left; margin:0; padding:0;}
						.bardoce-item {width:8%; float:left; margin:2px; padding:2px; border:1px solid #eee;}
						.bardoce-item svg {height: 70px;display: block;margin: 0 auto;max-width: 100%;}
						.bardoce-item h6 {margin:0; padding:0;}
						.title {text-align:center;}
						img{ bottom: 0;}
						 
			</style>";
		
	  echo "<div class='bardoce-item'><center><h6 class='title'><img src='img/favicon/favicons.png' width='12' height='12'>".$prd['prod_name']."</h6></center>
	  			<span class='border border-secondary'>
					<center>
				   		<div>
							<div class='project-box' data-aos='fade-up'>
								
								<div class='seno'  id='seno".$i."'>
									<svg class='bar' id='barcode_".$i."'></svg>
									<input type='hidden' class='se_no' id='se_no_".$i."' value='".$prd['se_no']."'>
								</div>
							</div>
						</div>
					</center>
				</span>
					
			</div>
			";
	
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
			       // alert (5);
					var this_attr_id = $.trim($(this).attr("id"));
                	var splt_this_id = this_attr_id.split("_");
                	var splt_this_id_ar = splt_this_id[2];              
					//alert(splt_this_id_ar);
					var se_no = $(element).val();
					//alert(se_no);
					JsBarcode("#barcode_"+splt_this_id_ar, se_no);
				});
			});

</script>
	
</body>
</html>