<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 	
	
		$field_values=array();
		$field_values[0]=htmlentities(($_POST['c_name']),ENT_QUOTES);
		$field_values[1]=htmlentities(($_POST['pro_ty']),ENT_QUOTES);
		
		
		
		$PRO_ID=$db->insertreturnid('product_details',$field_values,'cat_name,pro_ty');
        //echo $PRO_ID; exit;
		
		if($PRO_ID)
		{
			if(($_POST['c_name'])== "")
			{
				echo "Select Category Name"; exit;

			}
			$cat_name=$_POST['c_name'];
			if(($_POST['pro_ty'])== "")
			{
				echo "Select Product Type"; exit;

			}
			$pro_ty=$_POST['pro_ty'];
			if(isset($_POST['pro_id'])){

			}
			else
			{
				echo "Add A ROW"; exit;
			}
			$pro_code=$_POST['pro_id'];
			
			$pro_name=$_POST['pro_name'];
			$pro_desc=$_POST['pro_desc'];
			$unit=$_POST['unit'];
			//$emp_data =$db->rawquery('SELECT (count(pro_id)) as proid FROM product_details');
            
            //echo $emp_data; exit;
			$no_rows=count($pro_code);
			for($e=0;$e<$no_rows;$e++)
    			{
    			 //   $db->query
				$emp_data =$db->query('SELECT count(pdi.`proi_id`) FROM `product_details_info` as pdi
				inner join product_details as pd on pd.pro_id = pdi.pro_id
				WHERE pdi.`pro_name`="'.$pro_name[$e].'" and pd.cat_name="'.$cat_name.'" and pd.pro_ty="'.$pro_ty.'"');
				// echo $emp_data; exit;
    			$result = $emp_data->fetch();
    			$count = $result[0];
				if($count>0)
				{
				    	echo "Error! ".$pro_name[$e]." Already Exists Try Again"; exit; 
				}
				
				if($pro_code[$e] != "" && $pro_name[$e] != ""  && $unit[$e] !="")
				{
				}
				else{
					echo "Some Fields Are Missing On Line:".$pro_code[$e]; exit;
				}
			}
			
            //echo $no_rows; exit;
			for($i=0;$i<$no_rows;$i++)
			{
				
				
					
						$asd =htmlentities(($_POST['c_name']),ENT_QUOTES);
						//echo $asd; exit;
						$field_values=array();
						$field_values[0]=htmlentities(($PRO_ID),ENT_QUOTES);
						$field_values[1]=htmlentities(($pro_code[$i]),ENT_QUOTES);
						$field_values[2]=htmlentities(($pro_name[$i]),ENT_QUOTES);
						$field_values[3]=htmlentities(($pro_desc[$i]),ENT_QUOTES);
						$field_values[4]=htmlentities(($unit[$i]),ENT_QUOTES);
						
						$rdata=$db->insertreturnid('product_details_info',$field_values,"pro_id,pro_code, pro_name, pro_desc, unit");
						// inserted and returned product_details_info
						//exit;
						if($rdata){
						$field_value=array();
						$field_value['updated_no']=$rdata;
						$rdaa=$db->update('category', $field_value,'category_name=\''.$asd.'\'');
						// updated category updated no


						$result = substr($asd, 0, 2);
						$results = $result.substr_replace('0000', trim($rdata), -strlen(trim($rdata)));
						$field_vale=array();
						$field_vale['pro_code']=$results;
						//echo $field_vale; exit;
						$rda=$db->update('product_details_info', $field_vale,'proi_id =\''.$rdata.'\'');
						//echo $rda; exit;
						//updated product_details_info pro_code
						
						}
						else{
							echo "Error In Data Store"; exit;
						}
					
				
				
			
            }
			
			echo "Product Details Stored Sucessfully"; exit;
		}
		else
		{
			echo "Category name or product type not stored";  exit;
		}
			
		
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>