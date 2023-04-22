<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 	
            
	$quo_no=$_POST['quo_no'];
	$po_no=$_POST['po_no'];
	$prod_name=$_POST['prod_name'];
	$ddl_pro_qty=$_POST['ddl_pro_qty'];
	$ddl_pro_spec=$_POST['ddl_pro_spec'];
	$supliername=$_POST['supliername'];
	$rate=$_POST['rate'];
	
	$no_rows=count($quo_no);
	//echo $no_rows; exit;
	for($i=0;$i<$no_rows;$i++)
	{
		$field_values=array();
		$field_values[0]=htmlentities(($quo_no[$i]),ENT_QUOTES);
		$field_values[1]=htmlentities(($po_no[$i]),ENT_QUOTES);
		$field_values[2]=htmlentities(($prod_name[$i]),ENT_QUOTES);
		$field_values[3]=htmlentities(($ddl_pro_qty[$i]),ENT_QUOTES);
		$field_values[4]=htmlentities(($ddl_pro_spec[$i]),ENT_QUOTES);
		$field_values[5]=htmlentities(($supliername[$i]),ENT_QUOTES);
		$field_values[6]=htmlentities(($rate[$i]),ENT_QUOTES);
		
		$rdata=$db->insertreturnid('invoice_product',$field_values,"quo_no, po_no, product_name, product_quantity, product_spec, supliername, suplier_amount");
		// inserted and returned product_details_info
		//echo $rdata; exit;
		}
		
		
	if($rdata){
	echo('<script type="text/javascript">alert("Product Invoice Stored Sucessfully"); window.location="pi.php";</script>');
	}
	else{
		echo('<script type="text/javascript">alert("Error! Product Invoice not updated try again."); window.location="pi.php";</script>');
	}	
		
		
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>
<!-- CREATE TABLE invoice_product
(
ipid int,
quo_no varchar(255),
po_no varchar(255),
product_name varchar(255),
product_quantity varchar(255),
product_spec varchar(255),
supliername varchar(255),
suplier_amount int,
date_time int,
active_record varchar(255)
); -->