<?php
require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
try
{  
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
		$ins_date = date('Y-m-d H:i:s');
		
		$field_values=array();
		$field_values[0]=htmlentities($ins_date,ENT_QUOTES);
		$field_values[1]=htmlentities(($_POST['mobile']),ENT_QUOTES);
		$field_values[2]=htmlentities(($_POST['inst']),ENT_QUOTES);
		$field_values[3]=htmlentities(($_POST['dept']),ENT_QUOTES);
		$field_values[4]=htmlentities(($_POST['po_type']),ENT_QUOTES);
		$field_values[5]=htmlentities(($_POST['po_lab']),ENT_QUOTES);
		$field_values[6]=htmlentities(($_POST['overall_total']),ENT_QUOTES);
		$field_values[7]=htmlentities(($_POST['remarks']),ENT_QUOTES);
		$field_values[8]=htmlentities(($_POST['terms']),ENT_QUOTES);
		$field_values[9]=$_SESSION['sid'];
		
		
		
		$PRO_ID=$db->insertreturnid('po',$field_values,'po_date,supplier,institution,department,type,lab,po_worth,remarks,terms,u_id');
		
		if($PRO_ID)
		{
			$product=$_POST['product'];
			$product_desc=$_POST['product_det'];
			$units=$_POST['weight'];
			$unit_amt=$_POST['amt'];
			$pro_total_amt=$_POST['tot_amt'];
			$p_units=$_POST['units'];
			//$vat=$_POST['vat'];
			$gst=$_POST['gst'];
			$disc=$_POST['disc'];
			$currency=htmlentities(($_POST['currency']),ENT_QUOTES);
			$status=0;
			$supplier=htmlentities(($_POST['mobile']),ENT_QUOTES);
			
			
			$no_rows=count($product);
			for($i=0;$i<$no_rows;$i++)
			{
				$field_values=array();
				$field_values[0]=htmlentities(($product[$i]),ENT_QUOTES);
				$field_values[1]=htmlentities(($units[$i]),ENT_QUOTES);
				$field_values[2]=htmlentities(($unit_amt[$i]),ENT_QUOTES);
				$field_values[3]=htmlentities(($pro_total_amt[$i]),ENT_QUOTES);
				$field_values[4]=$currency;
				$field_values[5]=$status;
				$field_values[6]=$PRO_ID;
				$field_values[7]=$supplier;
				$field_values[8]=0;//htmlentities(($vat[$i]));
				$field_values[9]=htmlentities(($gst[$i]),ENT_QUOTES);
				$field_values[10]=htmlentities(($disc[$i]),ENT_QUOTES);
				$field_values[11]=htmlentities(($product_desc[$i]),ENT_QUOTES);
				$field_values[12]=$_SESSION['sid'];
				$field_values[13]=htmlentities(($p_units[$i]),ENT_QUOTES);
				$rdata=$db->insert('po_details',$field_values,"item_name, quantity, unit_price, total, currency, status, po_no, supplier,vat,gst,disc,item_desc,u_id,units");
			}
			
			$db->squery('supplier','*','mobile=\''.$supplier.'\'');
			$data=$db->fetchdata() ;
			if($data and $supplier==$data->mobile)
			{
				$field_values=array();
				$field_values['contact_person']=htmlentities(($_POST['name']),ENT_QUOTES);
				$field_values['supplier_name']=htmlentities(($_POST['c_name']),ENT_QUOTES);
				$field_values['address']=htmlentities(($_POST['address']),ENT_QUOTES);
				$field_values['gstin']=htmlentities(($_POST['gstin_no']),ENT_QUOTES);
				$field_values['pan']=htmlentities(($_POST['pan_no']),ENT_QUOTES);
				$field_values['bank1']=htmlentities(($_POST['bank1']),ENT_QUOTES);
				$field_values['bank2']=htmlentities(($_POST['bank2']),ENT_QUOTES);
				
				$rdata=$db->update('supplier',$field_values,'mobile=\''.$supplier.'\'');
				if($rdata)
				{
					echo('<script type="text/javascript">
					var win = window.open(\'po_preview.php?pid='.$PRO_ID.'&header=0\', \'_blank\');
					if (win) {
						//Browser has allowed it to be opened
						win.focus();
					} else {
						//Browser has blocked it
						alert(\'Please allow popups for this website\');
						
					}
					window.location="po.php";
					</script>');
					
					
					//echo('<script type="text/javascript">alert("PO Generated with Number:'.$PRO_ID.'"); window.location="po.php"</script>');
				}
				else
				{
					echo('<script type="text/javascript">alert("Error! Please try again."); window.location="po.php";</script>');
				}
			}
			else
			{
				$field_values=array();
				$field_values[0]=$supplier;
				$field_values[1]=htmlentities(($_POST['name']),ENT_QUOTES);
				$field_values[2]=htmlentities(($_POST['c_name']),ENT_QUOTES);
				$field_values[3]=htmlentities(($_POST['address']),ENT_QUOTES);
				$field_values[4]=htmlentities(($_POST['gstin_no']),ENT_QUOTES);
				$field_values[5]=htmlentities(($_POST['pan_no']),ENT_QUOTES);
				$field_values[6]=htmlentities(($_POST['bank1']),ENT_QUOTES);
				$field_values[7]=htmlentities(($_POST['bank2']),ENT_QUOTES);
				$rdata=$db->insert('supplier',$field_values,"mobile, contact_person, supplier_name, address, gstin, pan, bank1,bank2");
				if($rdata)
				{
					echo('<script type="text/javascript">alert("PO Generated with Number:'.$PRO_ID.'"); window.location="po.php";</script>');
				}
				else
				{
					echo('<script type="text/javascript">alert("Error! Please try again."); window.location="po.php";</script>');
				}
			}
		}   
		else
		{
			echo('<script type="text/javascript">alert("Error in PO! Please try again."); window.location="po.php";</script>');
			
		}
		
		
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>