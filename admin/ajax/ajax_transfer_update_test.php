<?php
error_reporting(0);
require_once("../database/connect.php");

$db=new Database;
$db->connect();
$seno=$_GET['seno'];
$reason=$_GET['reason'];
$fromdep=$_GET['fromdep'];
$todep=$_GET['todep'];

//echo $todep;exit;

// echo $todep; exit;
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{    
    
    if($reason=="Client" && $todep!=""){
       
        $field_values=array();
		$field_values[0]=htmlentities(($seno),ENT_QUOTES);
        $field_values[1]=htmlentities(($reason),ENT_QUOTES);
        $field_values[2]=htmlentities(($fromdep),ENT_QUOTES);
        $field_values[3]=htmlentities(($todep),ENT_QUOTES);
        $field_values[4]=htmlentities((0),ENT_QUOTES);
		
		$PRO_ID=$db->insertreturnid('transfer',$field_values,'seno, reason, fromdep, todep,  active_record');
        if($PRO_ID)
            {  
                // echo "hii"; exit;
                $asd =('UPDATE store_entry SET history=1,dep="'.$todep.'" WHERE `se_no`="'.$seno.'"');
                // echo $asd; exit;
                $datd = $db->query($asd);
                echo 'sucess'; exit;
            }
            else
            {
                echo'error'; exit;
            }

    }
    else if($reason=="Client" && $todep==""){
        
        echo 'To Department Not Mentioned'; exit; 

    }
    else{
        $field_values=array();
		$field_values[0]=htmlentities(($seno),ENT_QUOTES);
        $field_values[1]=htmlentities(($reason),ENT_QUOTES);
        $field_values[2]=htmlentities(($fromdep),ENT_QUOTES);
		
		$PRO_ID=$db->insertreturnid('transfer',$field_values,'seno, reason, fromdep');


            if($PRO_ID)
            { $asd =('UPDATE store_entry SET history=1,tranf=1 WHERE `se_no`="'.$seno.'"');
                // echo $asd; exit;
                        $datd = $db->query($asd);
                echo'sucess'; exit;
            }
            else
            {
                echo'error'; exit;
            }
    }
        
}
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>