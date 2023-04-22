<html>
<body>
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$db=new Database;
$db->connect();
$code=$_GET['se_no'];

//echo $code;exit;

$asd =('SELECT t.reason,t.date_time,st.dep, c.dep_name, st.`store_id`, st.code, st.invoice_no, st.wrt_date,s.company_name, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, 
        st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, 
        g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,
        wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
    
        INNER join grb as g on g.grb_no =st.grb_id
        INNER join work_order as wo on wo.wo_id =st.po_id
        INNER join suplier as s on s.sup_id =wo.suplier_id 
        INNER join client as c on c.cl_id =st.dep
        INNER join transfer as t on t.seno = st.se_no
    
        WHERE wo.`active_record` =1 and s.`active_record` =1 and st.se_no='.$code.' and  st.dep!=0 and st.tranf = 0 and t.to_sup!=0');
        
     
 	//echo $asd;
 		
	//	$i=0;
	
    $prdt_data = $db->query($asd);
    
    //echo $prdt_data;
		
        //$i=1;
      //  $tr2="";

while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))

 echo $prd;
 
		{
//	if($i==1)
//	{
	    //echo $i;exit;
	     
	     echo $prd;
	     
		echo "
		<style>
			@media{
				size:A4 Portrait;
			}
		</style>
		<center><h3>Back To Store Product -  Delivery Slip</h3></center>
		
	<div style=\"text-align:right;\"><b> Dated: ".date("d-m-Y H:m",strtotime($prd['date_time']))."</b></div>
	<span style='color:#ff0000'>*</span><b>The following goods mentioned below are delivered as requested in the Indent no:<b><br>
	<br>
			

		
	<div style=\"text-align:left;\"><b> Company Name: ".$prd['company_name']."</b></div>
			
	<div style=\"text-align:left;\"><b> Department Name: ".$prd['d_name']."</b></div>
				
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
		
	
	
        <td style='font-weight:bold ; text-align:center;'>S.No</td>
		<td style='font-weight:bold ; text-align:center;'>Bill Number</td>
		<td style='font-weight:bold ; text-align:center;'>Bill Date</td>
		<td style='font-weight:bold ; text-align:center;'>Product Name</td>
		<td style='font-weight:bold ; text-align:center;'>Product Specification</td>
		<td style='font-weight:bold ; text-align:center;'>Qty </td>
		<td style='font-weight:bold ; text-alidn:center;'>To</td>

		
		</tr>
		</thead>
		<tbody>
		";
		//$i++;
	//}
	
	//	$tr2=$tr2."<tr>
	
	echo "<tr>
        <td>&nbsp".$i."</td>	
	    <td>&nbsp".$prd['billno']."</td>
	    <td>&nbsp".$prd['bill_date']."</td>
	    <td>&nbsp".$prd['prod_name']."</td>
		<td>&nbsp".$prd['ddl_pro_spec']."</td>
		<td>&nbsp".$prd['ddl_pro_qty']."</td>
		<td>&nbsp".$prd['reason']."</td>

		</tr>";
	
}
// echo $tr1.$tr2."
echo"
</tbody></table>
<br><br><br>

<table width=100% class='mb-5'><tr>

<td><b>Signature of Store Officer </b></td>   

<td style='text-align:center;'><b>The above mentioned goods have been received in good condition</b></td>

<td style='text-align:right;'><b>Signature of the Receiver</b><td></td>
</tr></table></div>";


?>


</body>
</html>