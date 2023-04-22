<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$prod_name=$_GET['prod_name'];
$code=$_GET['code'];

$HTML="";
	if($con)
	{
        $asdaa =('SELECT  count(`invoice_no`) as ca , ins_qty, ins_amt ,ins_prod_name  FROM `installtion` WHERE `active_record`=1 and code='.$code.' and ins_prod_name="'.$prod_name.'"');
			$datda = $db->query($asdaa);
			$prd = $datda->fetch(PDO::FETCH_ASSOC);
			$ins_qty = $prd['ins_qty'];


		$asd =('SELECT st.`store_id`, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, st.installation, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt,st.disc_amt as disc_amt, st.gst_amt as gst_amt, st.unit as unit,st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
        INNER join grb as g on g.grb_no =st.grb_id
        INNER join work_order as wo on wo.wo_id =st.po_id
        INNER join suplier as s on s.sup_id =wo.suplier_id
        WHERE wo.`active_record` =1 and s.`active_record` =1 and st.`installation` ="Yes" and wo.prod_name ="'.$prod_name.'" and st.code ="'.$code.'"  group by  st.code');
		//echo $asd; exit;
		$datdaaa = $db->query($asd);
		$pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
		$received_qty = $pra['received_qty'] - $ins_qty;
        if($received_qty== 0){
            echo "All Installed";
        }
        else{
            echo "<select name='ins_qty' id='ins_qty' class='js-example-basic-multiple' style='width:100%;' > 
            <option value=''>Select Quantity</option>";	
            for($i=1;$i<$received_qty;$i++)
                {
                echo "<option value=".$i.">".$i."</option>";
                }
            echo "<option value='".$received_qty."'  selected='selected'>".$received_qty."</option></select>";

        }
			

    }
	    
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>


<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="../assets/global/plugins/select2/js/select2.min.js"></script>
 
<script>
    $( document ).ready(function() {
		$(".js-example-basic-multiple").select2();
    });
</script>

