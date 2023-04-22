



<html>

	<?php

	$code=$_GET['pid'];

	

?>

<body>

<center><img src="img/Header.jpg">

</center>



<hr/>

<?php 

require_once("database/connect.php");

$db=new Database;

$db->connect();



$qu_date=('SELECT `qu_id`, `code`, `serial_no`, `pro_id`, `pro_name`,`bill_type`, `pro_quantity`, `pro_unit`, `pro_spec`, `active_record`, `time_date` FROM `quotation` WHERE  serial_no="'.$code.'" and active_record= 1 limit 1');
$quotation_date = $db->query($qu_date);
while($quotation_date_only = $quotation_date->fetch(PDO::FETCH_ASSOC))
{
echo"<center><h3>Quotation  Dated: ".date("d-m-Y",strtotime($quotation_date_only['time_date']))."</h3></center>
<div style=\"text-align:left;\"><b>Bill Type:".$quotation_date_only['bill_type']." </b></div>";
}


// echo"<center><h3>Quotation  Dated:".date("d-m-Y")."</h3></center>



echo"	<div style=\"text-align:right;\"><b>Kare Order No:".$code." </b></div>

		This is to certify that the below mentioned goods have been received and the working condition of the goods have also been verified.<br>

		<div style='border: 1px solid black;'>

		<table style='width:100%;' border=1>

		<thead>

		<tr>

            <th style='font-weight:bold'>Sno.</th>

            <th style='font-weight:bold'>Product Name </th>

            <th style='font-weight:bold'>Specification</th>

            <th style='font-weight:bold'>Product Quantity / Unit</th>

        </tr>

		</thead>

		<tbody>";

$asd =('SELECT `qu_id`, `code`, `serial_no`, `pro_id`, `pro_name`, `pro_quantity`, `pro_unit`, `pro_spec`, `active_record`, `time_date` FROM `quotation` WHERE  serial_no="'.$code.'" and active_record= 1');

		//echo $asd; exit;

		$i=0;

		$prdt_data = $db->query($asd);





while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))

		{

			$i++;

		echo"

	    <tr>

            <td align='center'>".$i."</td>

            <td align='center'>".$prd['pro_name']." </td>

            <td align='center'> ".$prd['pro_spec']."</td>

            <td align='center'>".$prd['pro_quantity']." / ".$prd['pro_unit']."</td>

        </tr>";

	

}

echo "

</tbody></table>

<br><br><br>

<table width=100%><tr>

<td><b>Signature of Technical Officer </b></td><td style='text-align:right;'><b>Signature of the head of Department</b><td></td>

</tr></table></div>";





?>

</body>

</html>