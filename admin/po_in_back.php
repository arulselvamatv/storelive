<?php
error_reporting(0);
if(!isset($_POST['po_row_id']))
{
	echo '<script type="text/javascript">alert("Invalid Stock Entry!"); history.back();</script>';
	exit(0);
}
require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
try
{ 
	//////////
	$asdaa =('SELECT ((`code`)+1) as code  FROM `po_entry` order by `store_id` DESC Limit 1');
	$datdaa = $db->query($asdaa);
	$pras = $datdaa->fetch(PDO::FETCH_ASSOC);
	$code = $pras['code'];	

	$row_ids=$_POST['po_row_id'];
	$no_row=count($row_ids);

// 	if($_POST['bill_date'] == "" || $_POST['bill_no'] == "")
// 		{
// 			echo('<script type="text/javascript">alert("Bill Date or Bill No Missing");window.location="store_in.php";</script>'); exit;
// 			// echo "Bill Date or Bill No Missing"; exit;

// 		}
	
// valitation command 

	// for($l=0;$l<$no_row;$l++)
	// { 
	// 	if($_POST['chk_'.$row_id[$i]])
	// 	{ 
	// 		if($_POST['bill_no_'.$row_ids[$l]] != "" || $_POST['po_id_'.$row_ids[$l]] != "" || $_POST['overall_total'] != "" || $_POST['po_id_'.$row_id[$l]] != "" || $_POST['act_qty_'.$row_id[$l]] != "" || $_POST['qty_'.$row_id[$l]] != "" || $_POST['bill_amt_'.$row_id[$l]] != "" || $_POST['unit_'.$row_id[$l]] != "" || $_POST['wrt_date_'.$row_id[$l]] != "" || $_POST['gst_amt_'.$row_id[$l]] != "" || $_POST['disc_amt_'.$row_id[$l]] != "" || $_POST['tot_'.$row_id[$l]] != "" || $_POST['nos_'.$row_id[$l]] != "" || $_POST['nosunit_'.$row_id[$l]] != "")
	// 		{
	// 		}
	// 		else
	// 		{
	// 			echo('<script type="text/javascript">alert("Some Fields Are Missing on Row No:' .$l.' ");window.location="store_in.php";</script>'); exit;
	// 			// echo "Some Fields Are Missing on Row No:" .$e; exit;
	// 		}
	// 	}
	// }


	for($l=0;$l<$no_row;$l++)
	{ 
	    $row_ids=$_POST['po_row_id'];
	    
		if($_POST['chk_'.$row_ids[$l]])
		{ 
		  //  echo 'chk_'.$row_ids[$l];exit;
		    if($_POST['bill_no_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Bill No Missing");window.location="po_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    		}
		    if($_POST['bill_date_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Bill Date Missing");window.location="po_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    		}
    		 if($_POST['qty_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Quantity  Select is  Missing");window.location="po_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    		}
    		 if($_POST['nos_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert(" Quantity  number is Missing");window.location="po_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    		}
    		 if($_POST['nosunit_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Unit Missing");window.location="po_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    		}
		}
	}



	for($i=0;$i<$no_row;$i++)
	{ 
		
		    
			$row_id=$_POST['po_row_id'];
			$no_rows=count($row_id);
			//echo "no_rows".$no_rows; 
			$po_id="0";
			//echo "chk_id";
			//print_r($_POST['chk_'.$row_id[$i]]);
			if($_POST['chk_'.$row_id[$i]])
			{ 
				$wo_idz = $_POST['po_id_'.$row_id[$i]];
				//echo $row_id[$i];exit;
				$asd =('SELECT `prod_name` FROM `work_order1` WHERE `wo_id`="'.$wo_idz.'" ');
				//echo $asd; exit;
				$datd = $db->query($asd);
            	$prda = $datd->fetch(PDO::FETCH_ASSOC);
				$pro_name = $prda['prod_name'];	
                $arrayString=  explode(" ", $pro_name );
								

				$asda =('SELECT  pd.`pro_ty` as pro_ty FROM `product_details`as pd 
				INNER JOIN product_details_info as pdi on pdi.pro_id = pd.`pro_id`
				WHERE pd.`active_record` =1 and pdi.pro_code="'.$arrayString[0].'" ');
                // echo $asd; exit;
                $datda = $db->query($asda);
                $prdaa = $datda->fetch(PDO::FETCH_ASSOC);
				$pro_ty = $prdaa['pro_ty'];	
							if($_POST['bill_date_'.$row_id[$i]]==''){
							    $bill_date=date("Y-m-d H:i:s");
							}	
							else{
							    $bill_date=$_POST['bill_date_'.$row_id[$i]];
							}
					//echo "hii"; exit;
					$po_id=$_POST['po_id_'.$row_id[$i]];
					$field_values=array();
					$field_values[0]=$_POST['po_no'];
					//echo "po_id".$field_values[0]; 
					$field_values[1]=$_POST['act_qty_'.$row_id[$i]];
					//echo "act_qty".$field_values[1]; 
					$field_values[2]=$_POST['qty_'.$row_id[$i]];
					$field_values[3]=$_POST['bill_no_'.$row_id[$i]];
					$field_values[4]=date('Y-m-d',strtotime($bill_date));
					$field_values[5]=$row_id[$i];
					
					if(!isset($_POST['chk_'.$row_id[$i]]))
					{
						$field_values[6]='0';
					}
					else
					{
						$field_values[6]='1';
					}
					$field_values[7]=1;
					$field_values[8]=$_POST['bill_amt_'.$row_id[$i]];
					$field_values[9]=$_POST['unit_'.$row_id[$i]];
					$field_values[10]=$_POST['gst_amt_'.$row_id[$i]];
					$field_values[11]=$_POST['disc_amt_'.$row_id[$i]];
					$field_values[12]=$_POST['tot_'.$row_id[$i]];
					
					$field_values[13]="NO";
					//print_r($field_values);
					$quantity = $_POST['qty_'.$row_id[$i]];
					//echo $quantity; exit;
					//print_r($field_values); exit;
					if($quantity != 0){
					$sub_quantity =$_POST['nos_'.$row_id[$i]];
					//echo "quantity".$quantity; 
							
							
							$results = "1";
							$field_values[14]=$results;
							$field_values[15]=$pro_ty;
							
							$field_values[16]=$_POST['nos_'.$row_id[$i]];
							$field_values[17]=$_POST['nosunit_'.$row_id[$i]];

							// $field_values[16]=$_POST['nos_'.$row_id[$i]];
							// $field_values[17]=$_POST['nosunit_'.$row_id[$i]];
							
							$field_values[18]=$_POST['overall_total'];
								
							$field_values[19]=$_POST['adv'];
								
							$field_values[20]=$_POST['tran_charge'];
							$field_values[21]=$_POST['tran_charge_per'];
							$field_values[22]=$_POST['tran_charge_gst'];
								
								
							$field_values[23]=$_POST['ser_charge'];
							$field_values[24]=$_POST['ser_charge_per'];
							$field_values[25]=$_POST['ser_charge_gst'];
								
							$field_values[26]=0;
								
							$grand_tot=$_POST['grand_tot'];
								
					if($grand_tot < '0' )
					{
						$field_values[27]='0';
					}
					else
					{
						$field_values[27]=$_POST['grand_tot'];
					}

							$field_values[28]=0;
							$field_values[29]=0;
							$field_values[30]=0;	
						$field_values[31]=$_POST['disc_amt_entry'.$row_id[$i]];

						$field_values[32]=$_POST['pro_otr_amt'];
					
							
							
						
										
							$rdata=$db->insertreturnid('po_entry',$field_values,"po_id, actual_qty, received_qty, billno, bill_date, p_row_id, verified, u_id, bill_amt, unit,gst_amt,disc_amt,per_amt,installation,se_no, pro_ty,nos_qty,nosunit,total,adv,tran_charge,tran_charge_per,tran_charge_gst,ser_charge,ser_charge_per,ser_charge_gst,balance,grand_total,adv_total,grb_edit_history,payment_status,dis_amt_value");
		
							//echo $rdata;exit;

							$adv_dublicate = $_POST['adv_rde_bal'];
					
							//	echo $adv_dublicate;exit;
									
									if($adv_dublicate < '0' )
										{
											$field_values[33]='0';
										}
										else
										{
											$field_values[33]=$_POST['adv_balance'];
										}
							
							$sd =('UPDATE work_order1 SET adv_dublicate='.$field_values[33].'   WHERE `po_no`="'.$field_values[0].'"  and   `wo_id`="'.$field_values[5].'" ');
				// echo $sd;
				// exit;
							
							$datd = $db->query($sd); 

								//echo $fdg; 

								if(isset($code)){

								$resultd = "GRB";
								$resultsd = $resultd.substr_replace('0000', trim($code), -strlen(trim($code)));
								$sda =('UPDATE po_entry SET code='.$code.', invoice_no="'.$resultsd.'" WHERE `store_id`='.$rdata.' ');
								$datdaaaa = $db->query($sda);
									
								}
								else{
								$asdaa =('SELECT `code`  FROM `po_entry` order by `store_id` DESC Limit 1');
								//echo $asd; exit;
								$datdaaa = $db->query($asdaa);
								$pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
								$codea = $pra['code'];
								//echo $fdg; exit;
								$resultd = "GRB";
								$resultsd = $resultd.substr_replace('0000', trim($codea), -strlen(trim($codea)));
								$sda =('UPDATE po_entry SET code='.$codea.', invoice_no="'.$resultsd.'" WHERE `store_id`='.$rdata.' ');
								$datdaaaa = $db->query($sda);
									
							    }
										 
									 
						$qty =('SELECT `wo_id`, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, `ddl_pro_qty`, `product_spec`, `suplier_id`, `sup_amt`, `disc_amt`, `gst_amt`, `tot`, `po_status`, `active_record`, `date_time` FROM `work_order1` WHERE `po_no`="'.$field_values[0].'" and prod_name="'.$pro_name.'" ');
                               // echo $asd; exit;
                                $data = $db->query($qty);
                                $praa = $data->fetch(PDO::FETCH_ASSOC);
							    $po_status = $praa['po_status'] +$quantity;	
						$sds =('UPDATE work_order1 SET po_status='.$po_status.' WHERE `po_no`="'.$field_values[0].'" and prod_name="'.$pro_name.'" ');
								$datdasd = $db->query($sds);
					}
				}
						
		
			
			
	}
	
	//exit;
/////////
if($rdata)
			{
				echo('<script type="text/javascript">alert("Updated"); window.location="po_in.php";</script>');exit;
				//  echo "Updated";
			}
			else
			{
				//exit;
				echo('<script type="text/javascript">alert("Failed");window.location="po_in.php";</script>');exit;
				// echo "Failed";
			}



	
			
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>