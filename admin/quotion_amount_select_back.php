<?php

error_reporting(0);

require_once("database/connect.php");

$db=new Database;

$db->connect();

if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 	

            $quo_no=$_POST['quo_no'];

			$prod_name=$_POST['prod_name'];

			$ddl_pro_qty=$_POST['ddl_pro_qty'];

			$ddl_pro_unit=$_POST['ddl_pro_unit'];

            $product_spec=$_POST['ddl_pro_spec'];

			$bill_type=$_POST['bill_type'];

			

			$sup_name =$_POST['sup_name'];

			$no_rows=count($prod_name);

			$no_col =count($sup_name);

			$no_sup_amt =$no_rows * $no_col;

           

			$emp_data =$db->query('SELECT (count(`qas_id`)) as count FROM `quot_sup_amt_sel` WHERE  `quo_no` ="'.$quo_no.'" and `active_record` =1 ');

		

			$result = $emp_data->fetch();

			$count = $result[0];

			if($count != 0){

				$field_value=array();

				$field_value['active_record']= 0;

				$rdaa=$db->update('quot_sup_amt_sel', $field_value,'quo_no=\''.$quo_no.'\'');

			}

			for($i=0;$i<$no_rows;$i++)

			{

				

				

				

							$field_values=array();

							$field_values[0]=htmlentities(($quo_no),ENT_QUOTES);

							$field_values[1]=htmlentities(($prod_name[$i]),ENT_QUOTES);

							$field_values[2]=htmlentities(($ddl_pro_qty[$i]),ENT_QUOTES);

							$field_values[3]=htmlentities(($product_spec[$i]),ENT_QUOTES);

							$field_values[4]=htmlentities(($bill_type[$i]),ENT_QUOTES);

							

							$check=$_POST["check"];

							$checkbox = $check[$i];

							if( isset($checkbox))

							{

								$field_values[5]=htmlentities(($check[$i]),ENT_QUOTES);

								$suplier_id =$_POST['sup_id'.$check[$i]];

								$field_values[6]=htmlentities(($suplier_id),ENT_QUOTES);

								$disc_amt =$_POST['disc_amt'.$check[$i]];

								$field_values[7]=htmlentities(($disc_amt),ENT_QUOTES);

								$gst_amt =$_POST['gst_amt'.$check[$i]];

								$field_values[8]=htmlentities(($gst_amt),ENT_QUOTES);

								$tot =$_POST['tot'.$check[$i]];

								$field_values[9]=htmlentities(($tot),ENT_QUOTES);

								$field_values[10]=htmlentities(($ddl_pro_unit[$i]),ENT_QUOTES);

								$sup_amt =$_POST['sup_amt'.$check[$i]];

								$field_values[11]=htmlentities(($sup_amt),ENT_QUOTES);



								$asdf =('SELECT `wo_no` FROM `quot_sup_amt_sel` WHERE `suplier_id`="'.$field_values[6].'" and  quo_no="'.$field_values[0].'"');

								$e=0;							

								$prdt_dataa = $db->query($asdf);

								$res = 0;

								$prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC);

								$wo_no = $prda['wo_no'];								

								if( isset($wo_no))

								{

								$field_values[12]=htmlentities(($wo_no),ENT_QUOTES);

								}

								else

								{

									$asdf =('SELECT `wo_no` FROM `quot_sup_amt_sel`');

									$res=0;							

									$prdt_dataa = $db->query($asdf);

									while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))

									{									

									$wo_no = $prda['wo_no'];

									$wo_no_array = explode("_",$wo_no);																	

									if($res < $wo_no_array[1]){

									$res = $wo_no_array[1];										

									}

									}

									$res = $res+1;

									$wo_number = "WO_".$res;

									$field_values[12]=htmlentities(($wo_number),ENT_QUOTES);						

								}



						

			 

										

		

							}





					

			

			

					$rdata=$db->insertreturnid('quot_sup_amt_sel',$field_values," quo_no, prod_name, ddl_pro_qty, product_spec,bill_type,check_no, suplier_id, disc_amt, gst_amt, tot, ddl_pro_unit, suplier_amt, wo_no");

							

			

            }

	

			if($rdata)

			{



				echo "Quotation Amount Selected Supplier Stored Sucessfully"; exit;

			

			}

			else

			{

				echo "Error! Quotation Amount Selected not updated try again."; exit;

			}

			

		

		

		

 }

catch(Exception $my_e)

{

	echo "err";

	echo $my_e->getMessage();

} 



?>