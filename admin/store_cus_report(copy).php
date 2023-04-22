<html>
	<?php
	$code=$_GET['pid'];
	
//	echo $code;exit;
	
?>
<body>
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();

	
echo"<center><h3>Delivery Slip</h3></center>



	<div style=\"text-align:left;\">The following goods mentioned below are delivered as requested in the Indent no : </div>

		
	<div style=\"text-align:right;\"><b> Dated: ".$prd['crn_date_time']."</b></div>
	
	
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
            <th style='font-weight:bold'>Sno.</th>
           
            <th style='font-weight:bold'>Company name</th>
            <th style='font-weight:bold'>Department name</th>
            <th style='font-weight:bold'>Product name</th>
            <th style='font-weight:bold'>Product sepcification</th>
            <th style='font-weight:bold'>Qty </th>
           
        </tr>
		</thead>
		<tbody>";
$asd =('SELECT  (select `dep_name` from client where `cl_id`=sl.`dep_name`  )as d_name ,sl.`sl_id`, sl.`code`, sl.`sl_no`, sl.`se_no`, sl.`quo_no`, sl.`po_no`, sl.`prod_name`, sl.`pro_ty`, sl.`ddl_pro_qty`, sl.`ddl_pro_spec`, sl.`supname`, sl.`rate`, sl.`date_time`, sl.`dep_name`, sl.`crn_date_time`, sl.`active_record`, s.company_name FROM `store_list` as sl 
INNER JOIN suplier as s on s.sup_id = sl.supname
WHERE sl.`active_record`= 1 and sl.code='.$code.' group by sl.`prod_name` ');
		//echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);


while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
			$i++;
		echo"
	    <tr>
            <td align='center'>".$i."</td>
          
            <td align='center'> ".$prd['company_name']."</td>
            <td align='center'> ".$prd['d_name']."</td>
            <td align='center'> ".$prd['prod_name']."</td>
            <td align='center'> ".$prd['ddl_pro_spec']."</td>
            <td align='center'> ".$prd['ddl_pro_qty']."</td>
           
        </tr>";
	
}
echo "
</tbody></table>
<br><br><br>
<table width=100% class='mb-5'><tr>
<td><b>Signature of Store Officer </b></td>

<td style='text-align:center;'><b>The above mentioned goods have been received in good condition</b></td>

<td style='text-align:right;'><b>Signature of the receiver</b><td></td>
</tr></table></div>";


?>
</body>
</html>