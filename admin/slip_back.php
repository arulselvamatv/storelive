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
            $ddl_pro_unit=$_POST['ddl_pro_unit'];
			$ddl_pro_qty=$_POST['ddl_pro_qty'];
            $ddl_pro_spec=$_POST['ddl_pro_spec'];
            $sup_id =$_POST['sup_id'];
            $sup_amt =$_POST['sup_amt'];
            $disc_amt =$_POST['disc_amt'];
            $gst_amt =$_POST['gst_amt'];
			$per_tot =$_POST['per_tot'];
            $tot =$_POST['tot'];
			$invoice_no=$_POST['invoice_no'];
			$code=$_POST['code'];
			$installation=$_POST['installation'];

// 			echo $quo_no; exit;
			if($_POST['ins_prod_name']!=''){
			   $j =1;
			$field_value=array();
			$field_value[0]=htmlentities(($invoice_no[$j]),ENT_QUOTES);
			$field_value[1]=htmlentities(($_POST['ins_prod_name']),ENT_QUOTES);
			$field_value[2]=htmlentities(($_POST['ins_qty']),ENT_QUOTES);
			$field_value[3]=htmlentities(($_POST['ins_amt']),ENT_QUOTES);
			$field_value[4]=htmlentities(($_POST['code']),ENT_QUOTES);
			
			$asdaa =('SELECT  count(`ins_id`) as ins_count , ins_qty, ins_amt ,ins_prod_name, `invoice_no`  FROM `installtion` WHERE `active_record`=1 and invoice_no="'.$field_value[0].'" and ins_prod_name="'.$field_value[1].'"');
// 			echo $asdaa; exit;
			//echo "-1"; exit;
			$datd = $db->query($asdaa);
			$pra = $datd->fetch(PDO::FETCH_ASSOC);
			$ins_count = $pra['ins_count'];
			$ins_qty = $pra['ins_qty'];
			$ins_amt = $pra['ins_amt'];
			$ins_prod_name = $pra['ins_prod_name']; 
			}
			else{
			    $ins_count = 0;
			}
			

			$as =('SELECT count(`sl_id`) as sl_count, `code`, `invoice_no`, `prod_name` FROM `slip_list` WHERE `active_record`= 1 and `invoice_no`="'.$field_value[0].'" and `prod_name`="'.$field_value[1].'"');
			//echo $asd; exit;
			//echo "-1"; exit;
			$da = $db->query($as);
			$pras = $da->fetch(PDO::FETCH_ASSOC);
			$sl_count = $pras['sl_count'];
// echo $sl_count.'</br>'.$ins_count; exit;
		if($sl_count != 0 && $ins_count != 0)
			{
				// 	echo "1"; exit;
				$add_ins_qty = $ins_qty + $_POST['ins_qty'];
				//echo $add_ins_qty; exit;
				$add_ins_amt = $ins_amt + $_POST['ins_amt'];
				$sda =('UPDATE installtion SET  ins_qty='.$add_ins_qty.', ins_amt='.$add_ins_amt.'  WHERE invoice_no="'.$field_value[0].'" and ins_prod_name="'.$field_value[1].'" ');
				$datdaaaa = $db->query($sda);

					if($datdaaaa)
					{
						

						echo('<script type="text/javascript">alert("Installation Updated Sucessfully"); window.location="slip.php";</script>');
					
					}
					else
					{
						//exit;
						echo('<script type="text/javascript">alert("Error! Installation not updated try again."); window.location="slip.php";</script>');
					}
			}
		
		elseif($sl_count == 0 && $ins_count == 0)
			{
				// 	echo "2"; exit;
					if($_POST['ins_prod_name']!=''){
					   $PRO_ID=$db->insertreturnid('installtion',$field_value, "invoice_no,ins_prod_name, ins_qty, ins_amt, code"); 
					}
				
		if($PRO_ID!=''){
		    $PRO_ID=$PRO_ID;
		    
		} 
		else{
		     $PRO_ID=0;
		    
		}
		
					//$sup_amt =$_POST['sup_amt'];
					$no_rows=count($prod_name);
					for($i=0;$i<$no_rows;$i++)
					{
						$k=1;
						
									
						$field_values=array();
									
						$field_values[0]=htmlentities(($quo_no[$i]),ENT_QUOTES);
						$field_values[1]=htmlentities(($po_no[$i]),ENT_QUOTES);
						$field_values[2]=htmlentities(($prod_name[$i]),ENT_QUOTES);
						$field_values[3]=htmlentities(($ddl_pro_unit[$i]),ENT_QUOTES);
						$field_values[4]=htmlentities(($ddl_pro_qty[$i]),ENT_QUOTES);
						$field_values[5]=htmlentities(($ddl_pro_spec[$i]),ENT_QUOTES);
						$field_values[6]=htmlentities(($sup_id[$i]),ENT_QUOTES);
						$field_values[7]=htmlentities(($sup_amt[$i]),ENT_QUOTES);
						$field_values[8]=htmlentities(($disc_amt[$i]),ENT_QUOTES);
						$field_values[9]=htmlentities(($gst_amt[$i]),ENT_QUOTES);
						$field_values[10]=htmlentities(($per_tot[$i]),ENT_QUOTES);
						$field_values[11]=htmlentities(($tot[$i]),ENT_QUOTES);
						$field_values[12]=htmlentities(($_POST['bill_tot']),ENT_QUOTES);
						$field_values[13]=htmlentities(($_POST['ser_charge']),ENT_QUOTES);
						$field_values[14]=htmlentities(($_POST['tran_charge']),ENT_QUOTES);
						$field_values[15]=htmlentities(($_POST['packing']),ENT_QUOTES);
						$field_values[16]=htmlentities(($_POST['advance']),ENT_QUOTES);
						$field_values[17]=htmlentities(($_POST['overall_total']),ENT_QUOTES);
						$field_values[18]=htmlentities(($invoice_no[$i]),ENT_QUOTES);
						$field_values[19]=htmlentities(($_POST['code']),ENT_QUOTES);
						$field_values[20]=htmlentities(($PRO_ID),ENT_QUOTES);
						$field_values[21]=htmlentities(($installation[$i]),ENT_QUOTES);
						$field_values[22]=htmlentities(($_POST['ser_charge_per']),ENT_QUOTES);
						$field_values[23]=htmlentities(($_POST['ser_charge_gst']),ENT_QUOTES);
						$field_values[24]=htmlentities(($_POST['tran_charge_per']),ENT_QUOTES);
						$field_values[25]=htmlentities(($_POST['tran_charge_gst']),ENT_QUOTES);
						//print_r($field_values); exit;
						$rdata=$db->insertreturnid('slip_list',$field_values," quo_no, po_no, prod_name, ddl_pro_unit, ddl_pro_qty, ddl_pro_spec, sup_id, sup_amt, disc_amt, gst_amt, per_tot, tot, bill_tot, ser_charge, tran_charge, packing, advance, overall_total, invoice_no, code, ins_id, installation,ser_charge_per,ser_charge_gst,tran_charge_per,tran_charge_gst");
							
						//exit;
					
					}
					//exit;
					if($rdata)
						{
							echo('<script type="text/javascript">alert("Instalation Started For This Invoice Sucessfully"); window.location="slip.php";</script>');
				
						}
					else
						{
							//exit;
							echo('<script type="text/javascript">alert("Error! GRB not updated try again."); window.location="slip.php";</script>');
						}
				

		
			}

		elseif($sl_count != 0 && $ins_count == 0)
			{
				// echo "3"; exit;
				$INS_ID=$db->insertreturnid('installtion',$field_value, "invoice_no,ins_prod_name,ins_qty, ins_amt, code");
				
				//echo "sada"; exit;
				$sdaa =('UPDATE slip_list SET  ins_id='.$INS_ID.'  WHERE invoice_no="'.$field_value[0].'" and prod_name="'.$field_value[1].'" ');
				$dat = $db->query($sdaa);

				if($dat)
					{
						

						echo('<script type="text/javascript">alert("Installation Updated Sucessfully"); window.location="slip.php";</script>');
					
					}
					else
					{
						//exit;
						echo('<script type="text/javascript">alert("Error! Installation not updated try again."); window.location="slip.php";</script>');
					}

			}
			
		
				
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>