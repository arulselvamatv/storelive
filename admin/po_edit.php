<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 
    //echo "asdasda"; exit;
    $po=$_POST['po_nos'];
    $term_cond=$_POST['term_cond'];
    $remarks=$_POST['remarks'];
    $postatus=$_POST['postatus'];
    $poreason=$_POST['poreason'];
    $approved_dt= date('Y-m-d H:i:s');
     $sda =('UPDATE work_order1 SET term_cond="'.$term_cond.'", remarks="'.$remarks.'", postatus="'.$postatus.'", poreason="'.$poreason.'", approved_dt="'.$approved_dt.'" WHERE `po_no`="'.$po.'" ');

     $datdaaaa = $db->query($sda);
     if($datdaaaa)
     {
         echo('<script type="text/javascript">alert("Updated Sucessfully"); window.location="po_list.php";</script>');
     }
     else
     {
         echo('<script type="text/javascript">alert("Updated Failed"); window.location="po_list.php";</script>');
     }
}
catch(Exception $my_e)
{
    echo "err";
    echo $my_e->getMessage();
} 
    
?>