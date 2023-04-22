<?php
error_reporting(0);
require_once("../database/connect.php");

$db=new Database;
$db->connect();
$seno=$_GET['seno'];
$reason=$_GET['reason'];
$reasons=$_GET['reasons'];
$dep=$_GET['dep'];
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 
    
        $asd =('UPDATE transfer SET to_sup="'.$reasons.'" WHERE `seno`="'.$seno.'" order by t_id desc limit 1');
        //  echo $asd; exit;
                $datd = $db->query($asd);
                if($datd)
                {
                    echo'sucess'; exit;
                }
                else
                {
                    echo'error'; exit;
                }
   

    
}
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>