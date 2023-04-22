<?php

require_once("database/connect.php");



// ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL);





$db=new Database;

$db->connect();





date_default_timezone_set('Asia/Kolkata');



$date = date('Y-m-d H:i:s');





if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 	

   

   //  echo "<pre/>hi";print_r($_POST);exit;

    

            $quo_no=$_POST['quo_no'];

			$wo_no=$_POST['wo_no'];

			$prod_name=$_POST['prod_name'];

            $ddl_pro_unit=$_POST['ddl_pro_unit'];

            $ddl_pro_qty=$_POST['ddl_pro_qty'];

            $product_spec=$_POST['ddl_pro_spec'];

            $sup_name =$_POST['sup_name'];

            $sup_id =$_POST['sup_id'];

            $sup_amt =$_POST['sup_amt'];

            $disc_amt =$_POST['disc_amt'];

            $gst_amt =$_POST['gst_amt'];

            $tot =$_POST['tot'];

			$term_cond =$_POST['term_cond'];

			$remarks =$_POST['remarks'];

			$dept =$_POST['dept'];

			$tran_charge =$_POST['tran_charge'];

			$tran_charge_per =$_POST['tran_charge_per'];

			$tran_charge_gst =$_POST['tran_charge_gst'];

			$ser_charge =$_POST['ser_charge'];

			$ser_charge_per =$_POST['ser_charge_per'];

			$ser_charge_gst =$_POST['ser_charge_gst'];

			$adv =$_POST['adv'];

			$location =$_POST['location'];

			$bill_type= $_POST['bill_type'];



			$no_rows=count($prod_name);

			for($e=0;$e<$no_rows;$e++)

			{

				if($quo_no[$e] != "" && $wo_no[$e] != "" && $prod_name[$e] != "" && $ddl_pro_unit[$e] != ""  && $sup_id[$e] != "" && $sup_amt[$e] != "" && $disc_amt[$e] != "" && $gst_amt[$e] != "" && $tot[$e] != ""&& $term_cond != ""&& $remarks != "")

				{

				}

				else

				{

					echo "Some Fields Are Missing on Row No:".$e;exit;

				}

			}



			$emp_data =$db->query('SELECT (count(`wo_id`)) as count FROM `work_order` WHERE  `wo_no` ="'.$wo_no[$i].'" and `active_record` =1 ');

							//	echo $emp_data; exit;

					 $result = $emp_data->fetch();

					 $count = $result[0];

				// 	 echo $field_values[1];exit;

					 if($count != 0){

						 

						$field_value=array();

						$field_value['active_record']= 0;

						$rdaa=$db->update('work_order', $field_value,'wo_no=\''.$wo_no[$i].'\'');

						$rdaa1=$db->update('work_order1', $field_value,'wo_no=\''.$wo_no[$i].'\'');

					 }

			for($i=0;$i<$no_rows;$i++)

			{

				

				

				

							$field_values=array();

							$field_values[0]=htmlentities(($quo_no[$i]),ENT_QUOTES);

                            $field_values[1]=htmlentities(($wo_no[$i]),ENT_QUOTES);

							$field_values[2]=htmlentities(($prod_name[$i]),ENT_QUOTES);

							$field_values[3]=htmlentities(($ddl_pro_unit[$i]),ENT_QUOTES);

							$field_values[4]=htmlentities(($ddl_pro_qty[$i]),ENT_QUOTES);

							$field_values[5]=htmlentities(($product_spec[$i]),ENT_QUOTES);

							$field_values[6]=htmlentities(($sup_id[$i]),ENT_QUOTES);

                            $field_values[7]=htmlentities(($sup_amt[$i]),ENT_QUOTES);

                            $field_values[8]=htmlentities(($disc_amt[$i]),ENT_QUOTES);

							$field_values[9]=htmlentities(($gst_amt[$i]),ENT_QUOTES);

                            $field_values[10]=htmlentities(($tot[$i]),ENT_QUOTES);

							

							

							$asdf =('SELECT `po_no`, `dep_no` FROM `work_order` WHERE `suplier_id`="'.$field_values[6].'" and  quo_no="'.$field_values[0].'"');

							

						//	echo $asdf;exit;

						

							$e=0;							

							$prdt_dataa = $db->query($asdf);

							$res = 0;

							$prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC);

							

							$po_no = isset($prda['po_no']) && $prda['po_no']!=''?$prda['po_no']:'';

							$dep_no = isset($prda['dep_no']) && $prda['dep_no']!=''?$prda['dep_no']:'';		

							

								if( isset($po_no) && $po_no!='' && isset($dep_no) && $dep_no!=''  )

								{

								$field_values[11]=htmlentities(($po_no),ENT_QUOTES);

								$field_values[12]=htmlentities(($dep_no),ENT_QUOTES);

								}

								else{

									$asdf =('SELECT `po_no` FROM `work_order`');

									$res=0;							

									$prdt_dataa = $db->query($asdf);

									while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))

									{									

									$po_no = $prda['po_no'];

									$po_no_array = explode("_",$po_no);																	

									if($res < $po_no_array[1]){

									$res = $po_no_array[1];										

									}

									}

										$res = $res+1;

										$wo_number = "PO_".$res;

										

										$field_values[11]=htmlentities(($wo_number),ENT_QUOTES);	

										

									$asdfa =('SELECT `dep_id_gen` FROM `department` WHERE `d_name`="'.$dept.'"');

									

							//	echo $asdfa;exit;

								

									$prdt_dataaa = $db->query($asdfa);

									while($prdaa = $prdt_dataaa->fetch(PDO::FETCH_ASSOC))

									//$i= 1;

									{

									    $dep_no = $prdaa['dep_id_gen'] + 1;

									}

									

								//	echo $dep_no;exit;

								$dept_number = $dept."_".$dep_no;

								$field_values[12]=htmlentities(($dept_number),ENT_QUOTES);

								$rdaa =$db->query('UPDATE `department` SET `dep_id_gen`='.$dep_no.' WHERE d_name ="'.$dept.'"');

								}

								$field_values[13]=htmlentities(($term_cond),ENT_QUOTES);

						    	$field_values[14]=htmlentities(($remarks),ENT_QUOTES);

								$field_values[15]=htmlentities(($dept),ENT_QUOTES);

								$field_values[16]=htmlentities(($tran_charge),ENT_QUOTES);

								$field_values[17]=htmlentities(($tran_charge_per),ENT_QUOTES);

								$field_values[18]=htmlentities(($tran_charge_gst),ENT_QUOTES);

								$field_values[19]=htmlentities(($ser_charge),ENT_QUOTES);

								$field_values[20]=htmlentities(($ser_charge_per),ENT_QUOTES);

								$field_values[21]=htmlentities(($ser_charge_gst),ENT_QUOTES);

								$field_values[22]=htmlentities(($adv),ENT_QUOTES);

								$field_values[23]=htmlentities(($location),ENT_QUOTES);

								$field_values[24] = $date;

								$field_values[25]=htmlentities(($bill_type[$i]),ENT_QUOTES);

								$field_values[26]=htmlentities((0),ENT_QUOTES);

								$field_values[27]=htmlentities((0),ENT_QUOTES);

								//$db->query

				

					 //echo $wo_no[$i]; exit;	,tran_charge,tran_charge_per,tran_charge_gst,ser_charge,ser_charge_per,ser_charge_gst,adv	

					

				

				$rdata=$db->insertreturnid('work_order',$field_values," quo_no, wo_no, prod_name, ddl_pro_unit, ddl_pro_qty, product_spec, suplier_id, sup_amt, disc_amt, gst_amt, tot, po_no, dep_no, term_cond, remarks,dept,tran_charge,tran_charge_per,tran_charge_gst,ser_charge,ser_charge_per,ser_charge_gst,adv,location,date_time,bill_type,poreason,po_status");			

				

				//update start here 
					$sd =('UPDATE quot_sup_amt_sel SET ddl_pro_qty ='.$field_values[4].', suplier_amt ='.$field_values[7].', disc_amt ='.$field_values[8].', gst_amt ='.$field_values[9].' , tot  ='.$field_values[10].' WHERE `wo_no`="'.$field_values[1].'" and `prod_name`="'.$field_values[2].'" ');
					$datd = $db->query($sd); 
			   //update end here

				

				$field_values[28]=htmlentities(($sup_amt[$i]),ENT_QUOTES);

                $field_values[29]=htmlentities(($disc_amt[$i]),ENT_QUOTES);

				$field_values[30]=htmlentities(($gst_amt[$i]),ENT_QUOTES);

                $field_values[31]=htmlentities(($tot[$i]),ENT_QUOTES);

				$field_values[32]=htmlentities((0),ENT_QUOTES);

				$field_values[33]=htmlentities((0),ENT_QUOTES);



			$rdata1=$db->insertreturnid('work_order1',$field_values," quo_no, wo_no, prod_name, ddl_pro_unit, ddl_pro_qty, product_spec, suplier_id, sup_amt, disc_amt, gst_amt, tot, po_no, dep_no, term_cond, remarks,dept,tran_charge,tran_charge_per,tran_charge_gst,ser_charge,ser_charge_per,ser_charge_gst,adv,location,date_time,bill_type,poreason,po_status,sup_amt1, disc_amt1, gst_amt1, tot1,adv_dublicate,advance_paid_statues");

            }

			

// 			exit;



		if($rdata)

		{

        

			echo "Work Order Details Stored Sucessfully";

		

		}

		else

		{

			echo "Error! Work Order Details not updated try again.";

		}

			

 }

catch(Exception $my_e)

{

	echo "err";

	echo $my_e->getMessage();

} 



?>