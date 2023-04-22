<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 	
            
			$pro_id=$_POST['pro_id'];
			$pro_name=$_POST['pro_name'];
			$pro_quantity=$_POST['pro_quantity'];
			$pro_unit=$_POST['pro_unit'];
            $pro_spec=$_POST['pro_spec'];
            $bill_type=$_POST['bill_type'];
            
            //echo  $pro_name;exit;
             
			//$pro_remarks=$_POST['pro_remarks'];
			//$emp_data =$db->rawquery('SELECT (count(pro_id)) as proid FROM product_details');
            $asd =('SELECT (MAX(`code`)+1) as fdg  FROM `quotation` ');
	        //echo $asd; exit;
			$datd = $db->query($asd);
            while($data=$datd->fetch(PDO::FETCH_ASSOC))
	        {
                    $fdg = $data['fdg'];
            }

			if(($_POST['bill_type'])== "")
			{
				echo "Select bill type"; exit;
			}

            //echo $emp_data; exit;
			$no_rows=count($pro_id);
			for($e=0;$e<$no_rows;$e++)
			{
				if($pro_id[$e] != "" && $pro_name[$e] != "" && $pro_quantity[$e] != ""  && $pro_unit[$e] != ""  )
				{
				}
				else
				{
					echo "Some Fields Are Missing"; exit;
				}
			}
            //echo $no_rows; exit;
			for($i=0;$i<$no_rows;$i++)
			{

				
					//echo $asd; exit;
					$field_values=array();
					$field_values[0]=htmlentities(($pro_id[$i]),ENT_QUOTES);
					$field_values[1]=htmlentities(($pro_name[$i]),ENT_QUOTES);
					$field_values[2]=htmlentities(($pro_quantity[$i]),ENT_QUOTES);
					$field_values[3]=htmlentities(($pro_spec[$i]),ENT_QUOTES);
					$field_values[4]=htmlentities(($pro_unit[$i]),ENT_QUOTES);
					$field_values[5]=htmlentities(($bill_type),ENT_QUOTES);
					$field_values[6]=htmlentities(0);
					
					$rdata=$db->insertreturnid('quotation',$field_values,"pro_id, pro_name, pro_quantity, pro_spec, pro_unit,bill_type,pro_remarks");
					// inserted and returned product_details_info
					//echo $rdata;
					
					if($rdata){
					// echo $rdata; 
					
					$result = "Kare";
					$results = $result.substr_replace('0000', trim($fdg), -strlen(trim($fdg)));
					$field_value=array();
					$field_value['code']= $fdg;
					$field_value['serial_no']= $results;
					$rdaa=$db->update('quotation', $field_value,'qu_id=\''.$rdata.'\'');
					// updated category updated no
					
					}
				
				
			
            }
			if($rdata){
				echo "Quotation Info Stored Sucessfully"; exit;
			}
			else{
				echo "Error! Quotation not updated try again."; exit;
			}
			
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>