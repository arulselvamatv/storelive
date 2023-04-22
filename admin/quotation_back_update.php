<?php
require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try { 
    
    $e_nxt_pro_id=$_POST['nxt_pro_id'];

    $e_pro_id=$_POST['e_pro_id'];
	$e_pro_name=$_POST['e_pro_name'];
	$e_pro_quantity=$_POST['e_pro_quantity'];
	$e_pro_unit=$_POST['e_pro_unit'];
	$e_pro_spec=$_POST['e_pro_spec'];
	//$pro_remarks=$_POST['pro_remarks'];
	//$emp_data =$db->rawquery('SELECT (count(pro_id)) as proid FROM product_details');
    $fdg =$_POST['pro_code'];
    
    $serial_no=$_POST['serial_no'];
    //echo $asd; exit;
    // $datd = $db->query($quo);
    // while($data=$datd->fetch(PDO::FETCH_ASSOC)){
    //         $fdg = $data['fdg'];
    // }
    //echo $emp_data; exit;
    $no_rows=count($e_pro_id);


    //  get bill Type start here

    $asdfa =('SELECT `bill_type` FROM `quotation` WHERE `serial_no`="'.$serial_no.'"');

    // echo $asdfa;
    // exit;
    $prdt_dataaa = $db->query($asdfa);
    while($prdaa = $prdt_dataaa->fetch(PDO::FETCH_ASSOC))
    {
        $bill_type = $prdaa['bill_type'];
    }


    // echo $bill_type;
    // exit;
     //$dept_number = $dept."_".$dep_no;

    // get bill type end here



   // echo  $no_rows;exit;
    for($e=0;$e<$no_rows;$e++) {
        if($e_pro_id[$e] != "" && $e_pro_name[$e] != "" && $e_pro_quantity[$e] != ""  && $e_pro_unit[$e] != ""){
        }
        else {
            echo "Some Fields Are Missing"; exit;
        }
    }
    
    for($i=0;$i<$no_rows;$i++){	 			
        if($i >= ($e_nxt_pro_id)){
            //  echo '3'; exit;
            $field_values=array();
            $field_values[0]=htmlentities(($e_pro_id[$i]),ENT_QUOTES);
            $field_values[1]=htmlentities(($e_pro_name[$i]),ENT_QUOTES);
            $field_values[2]=htmlentities(($e_pro_quantity[$i]),ENT_QUOTES);
            $field_values[3]=htmlentities(($e_pro_spec[$i]),ENT_QUOTES);
            $field_values[4]=htmlentities(($e_pro_unit[$i]),ENT_QUOTES);
            $field_values[5]=htmlentities(($bill_type));
            $field_values[6]=htmlentities(0);

            $rdata=$db->insertreturnid('quotation',$field_values,"pro_id, pro_name, pro_quantity, pro_spec, pro_unit,bill_type,pro_remarks");
            // inserted and returned product_details_info
            if($rdata){
                $result = "Kare";
                $results = $result.substr_replace('0000', trim($fdg), -strlen(trim($fdg)));
                $field_value=array();
                $field_value['code']= $fdg;
                $field_value['serial_no']= $results;
                $rdaa=$db->update('quotation', $field_value,'qu_id=\''.$rdata.'\'');
                // updated category updated no
            }
        }
        else{
           
           // echo $no_rows; exit;
           // for($z=0;$z<$no_rows;$z++){	
                 
                $string_replace1=str_replace("'","''",$e_pro_name[$i]);
                $string_replace2=str_replace("'","''",$e_pro_spec[$i]);
                 $asdf =("UPDATE `quotation` SET `pro_name`='".$string_replace1."',`pro_quantity`=".$e_pro_quantity[$i].",`pro_unit`='".$e_pro_unit[$i]."',pro_spec='".$string_replace2."' WHERE serial_no='".$serial_no."' and pro_id=".$e_pro_id[$i]." ");
				 		 //echo $asdf.'</br>';		
				$prdt_dataa = $db->query($asdf);
          //  }
           // exit;
            // $field_value=array();
            // $field_value[0]=htmlentities(($e_pro_name[$i]),ENT_QUOTES);
            // $field_value[1]=htmlentities(($e_pro_quantity[$i]),ENT_QUOTES);
            // $field_value[2]=htmlentities(($e_pro_spec[$i]),ENT_QUOTES);
            // $field_value[3]=htmlentities(($e_pro_unit[$i]),ENT_QUOTES);
            // $rdata=$db->update('quotation', $field_value,'serial_no=\''.$serial_no.'\'');
        }
	}

    $results_serial_no = "Kare".substr_replace('0000', trim($fdg), -strlen(trim($fdg)));
    $deldata = $db->delete('quotation',"`quotation`.`pro_id` NOT IN (".implode(',',array_values($e_pro_id)).") AND serial_no = '".$results_serial_no."' AND code='".$fdg."'");

    

    if(isset($rdata) || (isset($deldata) && $deldata || $prdt_dataa )){
        echo "Quotation Info Updated Sucessfully"; exit;
    }
    else{
        echo "Error! Quotation not updated try again."; exit;
    }		
}
catch(Exception $my_e){
	echo "err";
	echo $my_e->getMessage();
} 
?>