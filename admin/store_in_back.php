<?php
error_reporting(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ALL ^ E_DEPRECATED);

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
	$asdaa =('SELECT ((`code`)+1) as code  FROM `store_entry` order by `store_id` DESC Limit 1');
	$datdaa = $db->query($asdaa);
	$pras = $datdaa->fetch(PDO::FETCH_ASSOC);
	$code = $pras['code'];

	// echo $code;
	// exit;

	$row_ids=$_POST['po_row_id'];
	$no_row=count($row_ids);
// 	if($_POST['bill_date'] == "" || $_POST['bill_no'] == "")
// 		{
// 			echo('<script type="text/javascript">alert("Bill Date or Bill No Missing");window.location="store_in.php";</script>'); exit;
// 			// echo "Bill Date or Bill No Missing"; exit;

// 		}

	// validation commant 

	// for($l=0;$l<$no_row;$l++)
	// {
	// 	if($_POST['chk_'.$row_id[$i]])
	// 	{ 
	// 		if($_POST['bill_no_'.$row_ids[$l]] != "" || $_POST['po_id_'.$row_ids[$l]] != "" || $_POST['overall_total'] != "" || $_POST['po_id_'.$row_id[$l]] != "" || $_POST['act_qty_'.$row_id[$l]] != "" || $_POST['qty_'.$row_id[$l]] != "" || $_POST['bill_amt_'.$row_id[$l]] != "" || $_POST['unit_'.$row_id[$l]] != "" || $_POST['wrt_date_'.$row_id[$l]] != "" || $_POST['gst_amt_'.$row_id[$l]] != "" || $_POST['disc_amt_'.$row_id[$l]] != "" || $_POST['tot_'.$row_id[$l]] != "" || $_POST['yes_no_'.$row_id[$l]] != "" || $_POST['nos_'.$row_id[$l]] != "" || $_POST['nosunit_'.$row_id[$l]] != "")
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
    			echo('<script type="text/javascript">alert("Bill No Missing");window.location="store_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    
    		}
    		
		    if($_POST['bill_date_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Bill Date Missing");window.location="store_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    
    		}
    		
    		 if($_POST['wrt_date_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Warrantity  Date Missing");window.location="store_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    
    		}
    		
    		
    		 if($_POST['qty_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Quantity  Select is  Missing");window.location="store_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    
    		}
    		
    		
    		
    		 if($_POST['nos_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert(" Quantity  number is Missing");window.location="store_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    
    		}
    		
    		
    		 if($_POST['nosunit_'.$row_ids[$l]] == "")
    		{
    			echo('<script type="text/javascript">alert("Unit Missing");window.location="store_in.php";</script>'); exit;
    			// echo "Bill Date or Bill No Missing"; exit;
    
    		}
		}
	}


	for($i=0;$i<$no_row;$i++)
	{
		$field_values=array();
		$field_values[0]=htmlentities(($_POST['po_id_'.$row_ids[$i]]),ENT_QUOTES);
		$field_values[1]=htmlentities(($_POST['overall_total']),ENT_QUOTES);
		$field_values[2]=1;

		$field_values[3]=0;
		$field_values[4]=0;
		$field_values[5]=0;
		$field_values[6]=0;
		$field_values[7]=0;
		$field_values[8]=0;
		$field_values[9]=0; 
		$field_values[10]=0;
		$field_values[11]=0;
		$field_values[12]=0;
		$field_values[13]=0;
		$field_values[14]=0;
		$field_values[15]=0;
		
		$PRO_ID=$db->insertreturnid('grb',$field_values,'po_no, overall_total,u_id ,bill_total,service_charges,transport_charges,gst_charges,discounts,grb_book_id,grb_book_page,grb_book_vol,packing_charges,advance,add_amt,per_add_amt,r_id');

		// echo $PRO_ID;
		// exit;

		if($PRO_ID)
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
				$asd =('SELECT `prod_name` FROM `work_order` WHERE `wo_id`="'.$wo_idz.'" ');
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
					$field_values[0]=$_POST['po_id_'.$row_id[$i]];
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
					$field_values[9]=$PRO_ID;
					$field_values[10]=$_POST['unit_'.$row_id[$i]];
					$field_values[11]=date('Y-m-d',strtotime($_POST['wrt_date_'.$row_id[$i]]));
					$field_values[12]=$_POST['gst_amt_'.$row_id[$i]];
					$field_values[13]=$_POST['disc_amt_'.$row_id[$i]];
					$field_values[14]=$_POST['tot_'.$row_id[$i]];
					$field_values[15]=$_POST['yes_no_'.$row_id[$i]];
					//print_r($field_values);
					$quantity = $_POST['qty_'.$row_id[$i]];
					//echo $quantity; exit;
					//print_r($field_values); exit;
					if($quantity != 0){
					$sub_quantity =$_POST['nos_'.$row_id[$i]];
					//echo "quantity".$quantity; 
					for($j=0;$j<$sub_quantity;$j++)
						{
							
							$asd =('SELECT (count(`po_id`)+1) as fdg  FROM `store_entry` ');
							//echo $asd; exit;
							$datd = $db->query($asd);
							while($data=$datd->fetch(PDO::FETCH_ASSOC))
							{
									$fdgs = $data['fdg'];
							}

							$result = "SE";
							$results = $result.substr_replace('0000', trim($fdgs), -strlen(trim($fdgs)));
							$field_values[16]=$results;
							$field_values[17]=$pro_ty;
							$field_values[18]=$_POST['nos_'.$row_id[$i]];
							$field_values[19]=$_POST['nosunit_'.$row_id[$i]];
							$field_values[20]=0;
							$field_values[21]=0;
							$field_values[22]=0;
							$field_values[23]=0;

							$field_values[24]=$_POST['dc_bill_no_'.$row_id[$i]];

							// $field_values[25]=$_POST['discamt'.$row_id[$i]];

							$field_values[25]=$_POST['disc_amt_entry'.$row_id[$i]];

						//print_r($field_values);exit;
							// $field_values[19]=$_POST['overall_total'];
										
	$rdata=$db->insertreturnid('store_entry',$field_values,"po_id, actual_qty, received_qty, billno, bill_date, p_row_id,
								verified, u_id, bill_amt, grb_id, unit, wrt_date, gst_amt, disc_amt, per_amt, installation, 
								se_no, pro_ty, nos_qty,nosunit,dep,tranf,history,tranf_from,dc_bill_no,dis_amt_value");

								//echo $rdata;exit;
					
								$qty =('SELECT `wo_id`, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, `ddl_pro_qty`, `product_spec`, `suplier_id`, `sup_amt`, `disc_amt`, `gst_amt`, `tot`, `po_status`, `active_record`, `date_time` FROM `work_order` WHERE `wo_id`="'.$field_values[0].'" ');
                               // echo $asd; exit;
                                $data = $db->query($qty);
                                $praa = $data->fetch(PDO::FETCH_ASSOC);
							    $po_status = $praa['po_status'] +$quantity;	
									
								$sd =('UPDATE work_order SET sup_amt='.$field_values[8].', disc_amt='.$field_values[13].', gst_amt='.$field_values[12].', tot='.$field_values[14].' WHERE `wo_id`="'.$field_values[0].'" ');
								$datd = $db->query($sd); 
									 //echo $fdg; 

						// echo $code;
						// exit;
									   
										if(isset($code)){

										$resultd = "INV";
										$resultsd = $resultd.substr_replace('0000', trim($code), -strlen(trim($code)));
										$sda =('UPDATE store_entry SET code='.$code.', invoice_no="'.$resultsd.'" WHERE `store_id`='.$rdata.' ');
									   	$datdaaaa = $db->query($sda);
											
										}
										else{
										$asdaa =('SELECT `code`  FROM `store_entry` order by `store_id` DESC Limit 1');
										//echo $asd; exit;
										$datdaaa = $db->query($asdaa);
										$pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
										$codea = $pra['code'];
										//echo $fdg; exit;
										$resultd = "INV";
										$resultsd = $resultd.substr_replace('0000', trim($codea), -strlen(trim($codea)));
										$sda =('UPDATE store_entry SET code='.$codea.', invoice_no="'.$resultsd.'" WHERE `store_id`='.$rdata.' ');
									   	$datdaaaa = $db->query($sda);
										}
										 
									 
						}
						$sds =('UPDATE work_order SET po_status='.$po_status.' WHERE `wo_id`="'.$field_values[0].'" ');
								$datdasd = $db->query($sds);
					}
				}
						
		}
			
			
	}
	
	//exit;
/////////
if($rdata)
			{
				echo('<script type="text/javascript">alert("Updated"); window.location="store_in.php";</script>');exit;
				//  echo "Updated";
			}
			else
			{
				//exit;
				echo('<script type="text/javascript">alert("Failed");window.location="store_in.php";</script>');exit;
				// echo "Failed";
			}



	
			
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>