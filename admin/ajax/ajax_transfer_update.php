<?php
error_reporting(0);

if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../database/connect.php");
$db=new Database;
$db->connect();

//~ echo "<pre/>999";print_r($_POST);exit;
$frmclient = $_POST['frmclient'];
$seno_arr = explode(',',$_POST['seno']);
$reason = $_POST['reason'];
$toclient = $_POST['toclient'];

$response = array('status'=>false);	


 $asd =('SELECT (MAX(`code`)+1) as ret  FROM `transfer` ');
	        //echo $asd; exit;
			$datd = $db->query($asd);
            while($data=$datd->fetch(PDO::FETCH_ASSOC))
	        {
                    $ret = $data['ret'];
                 // $ret= $data['ret_full'];
            }

        // if($ret!='')
        // {
        // $ret=$ret; 
        // }else{
        // $ret=1;  
        // }

if(empty($reason))
{
    $response['err'] = 'reason_empty';
    $response['err_msg'] = 'Reason is required for Transfer';
}
else if($reason === 'client' && empty($toclient))
{
    $response['err'] = 'client_empty';
    $response['err_msg'] = 'Client is required for Transfer';
}
else
{
    if($reason == 'client' && !empty($toclient))
    {
        foreach ($seno_arr as $seno)
        {
			 //~ echo "<pre/>seno";print_r($seno);exit;
			$frmclient = ('SELECT `dep` FROM `store_entry` WHERE `se_no`= "'.$seno.'" ');		
            $prdt_dataa=$db->query($frmclient);
            $from_client = $prdt_dataa->fetch(PDO::FETCH_ASSOC);
         
            $field_values = array();
            $field_values[0] = htmlentities(($seno), ENT_QUOTES);
            $field_values[1] = htmlentities(($reason), ENT_QUOTES);
            $field_values[2] = htmlentities(($from_client['dep']), ENT_QUOTES);
            $field_values[3] = htmlentities(($toclient), ENT_QUOTES);
            $field_values[4] = 0;
            $field_values[5] = 0;
              
            $PRO_ID = $db->insertreturnid('transfer', $field_values, 'seno, reason, fromdep, todep,active_record,to_sup');
            
    //         	if($PRO_ID)
				// 	{
				// 	// echo $rdata; 
				// 	$result = "return";
				// 	$results = $result.substr_replace('0000', trim($ret), -strlen(trim($ret)));
				// 	$field_value=array();
				// 	$field_value['code']= $ret;
				// 	$field_value['return_number']= $results;
				// 	$rdaa=$db->update('transfer', $field_value,'t_id=\''.$rdata.'\'');
					
				// 	// updated category updated no
				// 	}
				
					if($PRO_ID)
					{
					   // echo $ret; exit;
					//echo $PRO_ID;
					$result = "return";
					$results = $result.substr_replace('0000', trim($ret), -strlen(trim($ret)));
					$rdaa = $db->query('UPDATE transfer SET code='.$ret.',return_number = "'.$results.'" WHERE `t_id`='.$PRO_ID.'');
					}
				
				
				
            if ($PRO_ID)
            {
                $datd = $db->query('UPDATE store_entry SET history = 1, dep="'.$toclient.'"  WHERE `se_no`="'.$seno.'" ');
                $response['status'] = true;
            } 
            else 
            {
                $response['err'] = 'client_transfer_fail';
                $response['err_msg'] = 'Failed to Transfer';
            }
        }
    }
    
    else if ($reason == 'Backtostore')
    {
        // echo $ret; exit;
        foreach ($seno_arr as $seno)
        {
			$frmclient = ('SELECT `dep` FROM `store_entry` WHERE `se_no`= "'.$seno.'" ');		
            $prdt_dataa=$db->query($frmclient);
            $from_client = $prdt_dataa->fetch(PDO::FETCH_ASSOC);
            
            $field_values = array();
            $field_values[0] = htmlentities(($seno), ENT_QUOTES);
            $field_values[1] = htmlentities(($reason), ENT_QUOTES);
            $field_values[2] = htmlentities(($from_client['dep']), ENT_QUOTES);
            $field_values[3] = 0;
            $field_values[4] = 0;


            $PRO_ID = $db->insertreturnid('transfer', $field_values, 'seno, reason, fromdep,todep,to_sup');
            
            	if($PRO_ID)
					{
					// echo $ret; exit;
					// echo $PRO_ID;
					$result = "return";
					$results = $result.substr_replace('0000', trim($ret), -strlen(trim($ret)));
					$rdaa = $db->query('UPDATE transfer SET code='.$ret.',return_number = "'.$results.'" WHERE `t_id`='.$PRO_ID.'');
					}
            
            
            if ($PRO_ID) 
            {
                $datd = $db->query('UPDATE store_entry SET dep=0,history = 1,tranf = 1 WHERE `se_no`="' . $seno . '"');
                $response['status'] = true;
            } 
            else
            {
                $response['err'] = 'transfer_fail';
                $response['err_msg'] = 'Failed to Transfer';
            }
        }
        
        
    }
    
    else
    {
        foreach ($seno_arr as $seno)
        {
			$frmclient = ('SELECT `dep` FROM `store_entry` WHERE `se_no`= "'.$seno.'" ');		
            $prdt_dataa=$db->query($frmclient);
            $from_client = $prdt_dataa->fetch(PDO::FETCH_ASSOC);
            
            $field_values = array();
            $field_values[0] = htmlentities(($seno), ENT_QUOTES);
            $field_values[1] = htmlentities(($reason), ENT_QUOTES);
            $field_values[2] = htmlentities(($from_client['dep']), ENT_QUOTES);
            $field_values[3] = 0;
            $field_values[4] = 0;

            $PRO_ID = $db->insertreturnid('transfer', $field_values,'seno, reason, fromdep,todep,to_sup');
            
//         	if($PRO_ID)
// 			{
// 			// echo $rdata; 
// 			$result = "return";
// 			$results = $result.substr_replace('0000', trim($ret), -strlen(trim($ret)));
// 			$field_value=array();
// 			$field_value['code']= $ret;
// 			$field_value['return_number']= $results;
// 			$rdaa=$db->update('transfer', $field_value,'t_id=\''.$rdata.'\'');
		
// 			}



	if($PRO_ID)
					{
					   // echo $ret; exit;
					//echo $PRO_ID;
					$result = "return";
					$results = $result.substr_replace('0000', trim($ret), -strlen(trim($ret)));
					$rdaa = $db->query('UPDATE transfer SET code='.$ret.',return_number = "'.$results.'" WHERE `t_id`='.$PRO_ID.'');
					}
            
            
            if ($PRO_ID) 
            {
                $datd = $db->query('UPDATE store_entry SET history = 1, tranf = 1 WHERE `se_no`="' . $seno . '"');
                $response['status'] = true;
            } else {
                $response['err'] = 'transfer_fail';
                $response['err_msg'] = 'Failed to Transfer';
            }
        }
    }
}
echo json_encode($response);
