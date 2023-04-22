<?php
error_reporting(0);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if(!isset($_POST['po_row_id']))
{
	echo '<script type="text/javascript">alert("Invalid Stock Entry."); history.back();</script>';
	//exit(0);
}
require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
try
{ 
    
    $inv=$_POST['invoice_no'];
    
    //echo $inv;exit;
    
    $row_ids=$_POST['po_row_id'];
    
    //echo $row_ids;
    
	$no_row=count($row_ids);
	
	//$no_row=count($row_ids);
	
	//echo $no_row;exit;
	
// 		for($l=0;$l<$no_row;$l++)
// 	{ 
// 		if($_POST['chk_'.$row_id[$i]])
// 		{ 
// 			if($_POST['bill_no_'.$row_ids[$l]] != "" || $_POST['po_id_'.$row_ids[$l]] != "" || $_POST['overall_total'] != "" || $_POST['po_id_'.$row_id[$l]] != "" || $_POST['bill_amt_'.$row_id[$l]] != "" || $_POST['unit_'.$row_id[$l]] != "" || $_POST['wrt_date_'.$row_id[$l]] != "" || $_POST['gst_amt_'.$row_id[$l]] != "" || $_POST['disc_amt_'.$row_id[$l]] != "" || $_POST['tot_'.$row_id[$l]] != "" )
// 			{
// 			}
// 			else
// 			{
// 				echo('<script type="text/javascript">alert("Some Fields Are Missing on Row No:' .$l.' ");window.location="store_in.php";</script>'); exit;
// 				// echo "Some Fields Are Missing on Row No:" .$e; exit;
// 			}
// 		}
// 	}
	
	
	
    	
//   	for($l=0;$l<$no_row;$l++)
// 	{ 
// 		if($_POST['chk_'.$row_id[$i]])
// 		{ 
// 			if($_POST['bill_no_'.$row_ids[$l]] != "" || $_POST['po_id_'.$row_ids[$l]] != "" || $_POST['overall_total'] != "" || $_POST['po_id_'.$row_id[$l]] != "" || $_POST['act_qty_'.$row_id[$l]] != "" 
			
// 			   || $_POST['qty_'.$row_id[$l]] != "" || $_POST['bill_amt_'.$row_id[$l]] != "" || $_POST['unit_'.$row_id[$l]] != "" || $_POST['wrt_date_'.$row_id[$l]] != "" || $_POST['gst_amt_'.$row_id[$l]] != ""
			   
// 			   || $_POST['disc_amt_'.$row_id[$l]] != "" || $_POST['tot_'.$row_id[$l]] != "" || $_POST['nos_'.$row_id[$l]] != "" || $_POST['nosunit_'.$row_id[$l]] != "" || $_POST['tran_charge'.$row_id[$l]] != ""
			   
// 			   || $_POST['tran_charge_per'.$row_id[$l]] !="" || $_POST['ser_charge'.$row_id[$l]] !="")
// 			{
			    
// 			}
// 			else
// 			{
// 				echo('<script type="text/javascript">alert("Some Fields Are Missing in Grb Invocie Page.");window.location="grb_invoice_edit.php";</script>'); exit;
// 			}
// 		}
// 	}
	
	
	for($i=0;$i<$no_row;$i++)
	{ 
			$row_id=$_POST['po_row_id'];
			
			$no_rows=count($row_id);
			
			//echo $no_rows;exit;
			
			//$po_id="0";
			
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
				
				//echo $pro_name;exit;
				
                $arrayString=  explode(" ", $pro_name );
								

				$asda =('SELECT  pd.`pro_ty` as pro_ty FROM `product_details`as pd 
				
				INNER JOIN product_details_info as pdi on pdi.pro_id = pd.`pro_id`
				
				WHERE pd.`active_record` =1 and pdi.pro_code="'.$arrayString[0].'" ');
				
                // echo $asd; exit;
                
                $datda = $db->query($asda);
                
                $prdaa = $datda->fetch(PDO::FETCH_ASSOC);
                
				$pro_ty = $prdaa['pro_ty'];	
				
							if($_POST['bill_date_'.$row_id[$i]]=='')
							{
							    $bill_date=date("Y-m-d H:i:s");
							}	
							else{
							    $bill_date=$_POST['bill_date_'.$row_id[$i]];
							}
							
							
					//echo "hii"; exit;
					
					$po_id=$_POST['po_id_'.$row_id[$i]];
					
					$field_values=array();
					
					$field_values[0]=$_POST['po_no'];
					
					//echo "po_id".$field_values[0];exit;
					
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
					
					//print_r($field_values);exit;
					
					$quantity = $_POST['org_qty_'.$row_id[$i]];
					
					 // echo $quantity; exit;
					
					//print_r($field_values); exit;
					
					if($quantity != 0){
					    
					$sub_quantity =$_POST['nos_'.$row_id[$i]];
					
					//echo "quantity".$quantity; 
							
							$results = "1";
							
							$field_values[14]=$results;
							
							$field_values[15]=$pro_ty;
							
							$field_values[16]=$_POST['nos_'.$row_id[$i]];
							
							$field_values[17]=$_POST['nosunit_'.$row_id[$i]];
							
							$field_values[18]=$_POST['overall_total'];
							
							$field_values[19]=$_POST['adv'];
							
							$field_values[20]=$_POST['tran_charge'];
							
							$field_values[21]=$_POST['tran_charge_per'];
							
							$field_values[22]=$_POST['tran_charge_gst'];
							
							
							$field_values[23]=$_POST['ser_charge'];
							
							$field_values[24]=$_POST['ser_charge_per'];
							
							$field_values[25]=$_POST['ser_charge_gst'];
							
							$field_values[26]=$_POST['balances_amt'];
							
							$field_values[27]=$_POST['grand_tot'];
							
							$field_values[28]=$_POST['grb_edit_reason'];
							
						    $grb_edit_history ="1";
							
							$field_values[29]=$grb_edit_history;
							
							
							//print_r($field_values); exit;
							
							//echo $inv;exit;
							

							
							$asdfa =('UPDATE `po_entry` SET `billno`="'.$field_values[3].'",`bill_date`="'.$field_values[4].'",
                 
                            `verified`="'.$field_values[6].'" ,`u_id`="'.$field_values[7].'",`bill_amt`="'.$field_values[8].'",`gst_amt`="'.$field_values[10].'",
                            
                           `disc_amt`="'.$field_values[11].'", `per_amt`="'.$field_values[12].'",
                        
                            `installation`="'.$field_values[13].'",`total`="'.$field_values[18].'",`adv`="'.$field_values[19].'",`tran_charge`="'.$field_values[20].'", 
                        
                            `tran_charge_per`="'.$field_values[21].'",`tran_charge_gst`="'.$field_values[22].'",`ser_charge`="'.$field_values[23].'",`ser_charge_per`="'.$field_values[24].'",
                        
                            `ser_charge_gst` = "'.$field_values[25].'", `balance` = "'.$field_values[26].'",`grand_total` = "'.$field_values[27].'",`grb_edit_reason` = "'.$field_values[28].'" ,`grb_edit_history`="'.$field_values[29].'"
                                                 
                             WHERE invoice_no="'.$inv.'" and `p_row_id`="'.$field_values[5].'"  ');
                             
                            // echo $asdfa;exit;  
                             
                             $datdf = $db->query($asdfa); 
                             
                  
                             
                         
			$qwe =('UPDATE work_order1 SET sup_amt1='.$field_values[8].', disc_amt1='.$field_values[11].',gst_amt1='.$field_values[10].',tot1='.$field_values[12].',
			
			       tran_charge='.$field_values[20].', tran_charge_per='.$field_values[21].',tran_charge_gst='.$field_values[22].',
			        
			      ser_charge='.$field_values[23].',ser_charge_per='.$field_values[24].',ser_charge_gst='.$field_values[25].'
			
			      WHERE `po_no`="'.$field_values[0].'" and `wo_id`="'.$field_values[5].'" ');
			      
			//echo $qwe;exit;
							
							$datd = $db->query($qwe); 
			
					}
				}
	}
	
  if($asdfa)
  {
	echo('<script type="text/javascript">alert("GRB Updated Sucessfully."); window.location="grb_invoice_edit.php";</script>');exit;
	//  echo "Updated";
}
else
{
	//exit;
	echo('<script type="text/javascript">alert("Error! GRB Not Updated try again.");window.location="grb_invoice_edit.php";</script>');exit;
	// echo "Failed";
}


   

   
   
}
catch(Exception $my_e){
	echo "err";
	echo $my_e->getMessage();
} 
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//   for($i=0;$i<$no_rows;$i++){	 			
//       for($z=0;$z<$no_rows;$z++){	
           
           
//          $asdf =('UPDATE `po_entry` SET `received_qty`="'.$e_pro_name[$z].'",`billno`="'.$e_pro_quantity[$z].'",`bill_date`="'.$e_pro_unit[$z].'",`bill_amt`="'.$e_pro_spec[$z].'",
                 
//                         `gst_amt `="'.$gst_amt[$z].'" ,`disc_amt`="'.$disc_amt[$z].'",`per_amt`="'.$per_amt[$z].'",`total`="'.$total[$z].'",`adv`="'.$adv[$z].'",
                        
//                         `balance`="'.$balance[$z].'",`adv_total`="'.$adv_total[$z].'",`tran_charge`="'.$tran_charge[$z].'",`tran_charge_per`="'.$tran_charge_per[$z].'",
                        
//                         `tran_charge_gst`="'.$tran_charge_gst[$z].'",`ser_charge`="'.$ser_charge[$z].'",`ser_charge_per`="'.$ser_charge_per[$z].'",`ser_charge_gst`="'.$ser_charge_gst[$z].'",
                        
//                         `grand_total` = "'.$grand_total[$z].'",`grb_edit_reason` = "'.$grb_edit_reason[$z].'"
                                                 
//                         WHERE serial_no="'.$serial_no.'" and pro_id='.$e_pro_id[$z].'');
                       
// 				        $prdt_dataa = $db->query($asdf);
				        

// 		$sd =('UPDATE work_order1 SET sup_amt1='.$field_values[8].', disc_amt1='.$field_values[13].', gst_amt1='.$field_values[12].', tot1='.$field_values[14].' WHERE `wo_id`="'.$field_values[0].'" ');
// 		$datd = $db->query($sd);    
				        
			
//             }
// 	}

   
   
   
  