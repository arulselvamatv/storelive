<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 	        
            $se_no=$_POST['se_no'];
            $quo_no=$_POST['quo_no'];
            $po_no=$_POST['po_no'];
			$prod_name=$_POST['prod_name'];
			$ddl_pro_qty=$_POST['ddl_pro_qty'];
            $ddl_pro_spec=$_POST['ddl_pro_spec'];
			$supname =$_POST['supname'];
            $rate =$_POST['rate'];
            $date_time =$_POST['date_time'];
            $dep_name =$_POST['dep_name'];
			//$sup_amt =$_POST['sup_amt'];
			$asdaa =('SELECT ((`code`)+1) as code  FROM `store_list` order by `sl_id` DESC Limit 1');
			//echo $asd; exit;
			$datdaa = $db->query($asdaa);
			$pras = $datdaa->fetch(PDO::FETCH_ASSOC);
			$code = $pras['code'];	
			//echo $code; exit;
			$no_rows=count($prod_name);
			for($i=0;$i<$no_rows;$i++)
			{
				
				
							$chk=$_POST["chk"];
							$checkbox = $chk[$i];
							//echo $checkbox; exit;
							if(isset($checkbox))
							{
								//echo $checkbox; exit
									$pro_name=$prod_name[$i];
									$arrayString=  explode(" ", $pro_name );
								$asda =('SELECT  pd.`pro_ty` as pro_ty FROM `product_details`as pd 
								INNER JOIN product_details_info as pdi on pdi.pro_id = pd.`pro_id`
								WHERE pd.`active_record` =1 and pdi.pro_code="'.$arrayString[0].'" ');
                               // echo $asd; exit;
                                $datda = $db->query($asda);
                                $prdaa = $datda->fetch(PDO::FETCH_ASSOC);
							    $pro_ty = $prdaa['pro_ty'];	
							
								$field_values=array();
								
								$field_values[0]=htmlentities(($quo_no[$i]),ENT_QUOTES);
								$field_values[1]=htmlentities(($po_no[$i]),ENT_QUOTES);
								$field_values[2]=htmlentities(($prod_name[$i]),ENT_QUOTES);
								$field_values[3]=htmlentities(($ddl_pro_qty[$i]),ENT_QUOTES);
								$field_values[4]=htmlentities(($ddl_pro_spec[$i]),ENT_QUOTES);
								$field_values[5]=htmlentities(($supname[$i]),ENT_QUOTES);
								$field_values[6]=htmlentities(($rate[$i]),ENT_QUOTES);
								$field_values[7]=htmlentities(($date_time[$i]),ENT_QUOTES);
								$field_values[8]=htmlentities(($dep_name),ENT_QUOTES);
								$field_values[9]=htmlentities(($pro_ty),ENT_QUOTES);
							
			
								if ($ddl_pro_qty[$i]>1){
									$ddl_pro=$ddl_pro_qty[$i];

									for($e=0;$e<$ddl_pro;$e++){
										$asdf =('SELECT se.`se_no` FROM `store_entry`  as se
										inner join work_order as wo on wo.wo_id = se.po_id
										WHERE se.dep=0 and wo.po_no="'.$po_no[$i].'" and wo.prod_name="'.$prod_name[$i].'"  order by se.`store_id` DESC');
										//echo $asdf; exit;
										$datds = $db->query($asdf);
										while($datas=$datds->fetch(PDO::FETCH_ASSOC))
											{
											$ghh = $datas['se_no'];
											}
										$field_values[10]=htmlentities(($ghh),ENT_QUOTES);
										$rdata=$db->insertreturnid('store_list',$field_values," quo_no, po_no, prod_name, ddl_pro_qty, ddl_pro_spec, supname, rate, date_time, dep_name, pro_ty, se_no");
										if($rdata){
										$asd =('UPDATE store_entry SET dep='.$dep_name.' WHERE `se_no`="'.$ghh.'" and dep=0 ');
										//echo $asd; exit;
										$datd = $db->query($asd);
											if(isset($code)){
												$resultd = "SL";
												$resultsd = $resultd.substr_replace('0000', trim($code), -strlen(trim($code)));
												$sda =('UPDATE store_list SET code='.$code.', sl_no="'.$resultsd.'" WHERE `sl_id`='.$rdata.' ');
												$datdaaaa = $db->query($sda);
											}
											else{
												$asdaa =('SELECT `code`  FROM `store_list` order by `sl_id` DESC Limit 1');
												//echo $asd; exit;
												$datdaaa = $db->query($asdaa);
												$pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
												$codea = $pra['code'];
												//echo $fdg; exit;
												$resultd = "SL";
												$resultsd = $resultd.substr_replace('0000', trim($codea), -strlen(trim($codea)));
												$sda =('UPDATE store_list SET code='.$codea.', sl_no="'.$resultsd.'" WHERE `sl_id`='.$rdata.' ');
												$datdaaaa = $db->query($sda);
											}
									
										}
									}

								}
								else{
									$field_values[10]=htmlentities(($se_no[$i]),ENT_QUOTES);
									$rdata=$db->insertreturnid('store_list',$field_values," quo_no, po_no, prod_name, ddl_pro_qty, ddl_pro_spec, supname, rate, date_time, dep_name, pro_ty, se_no");
									if($rdata){
											$asd =('UPDATE store_entry SET dep='.$dep_name.' WHERE `se_no`="'.$se_no[$i].'" and dep=0 ');
											//echo $asd; exit;
											$datd = $db->query($asd);
											if(isset($code)){
												$resultd = "SL";
												$resultsd = $resultd.substr_replace('0000', trim($code), -strlen(trim($code)));
												$sda =('UPDATE store_list SET code='.$code.', sl_no="'.$resultsd.'" WHERE `sl_id`='.$rdata.' ');
												$datdaaaa = $db->query($sda);
											}
											else{
												$asdaa =('SELECT `code`  FROM `store_list` order by `sl_id` DESC Limit 1');
												//echo $asd; exit;
												$datdaaa = $db->query($asdaa);
												$pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
												$codea = $pra['code'];
												//echo $fdg; exit;
												$resultd = "SL";
												$resultsd = $resultd.substr_replace('0000', trim($codea), -strlen(trim($codea)));
												$sda =('UPDATE store_list SET code='.$codea.', sl_no="'.$resultsd.'" WHERE `sl_id`='.$rdata.' ');
												$datdaaaa = $db->query($sda);
											}
										}
								}
							
				
                            }
							
				
				
				//exit;
			
            }
			//echo $rdata; exit;	
		//	echo('<script type="text/javascript">alert("Quotation Amount Selected Supplier Stored Sucessfully"); window.location="quotion_amount_select.php";</script>');
		
			//exit;
	
		if($rdata)
		{
			

			echo('<script type="text/javascript">alert(" Transfer Sucessfully"); window.location="store_list.php";</script>');
		
		}
		else
		{
            //exit;
			echo('<script type="text/javascript">alert("Error! Transfer not updated try again."); window.location="store_list.php";</script>');
		}
			
		
		
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>