<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 

if($_POST['payment_amount'] > $_POST['overall_total_1'])
   {
    // echo "asdasd1"; exit;
	echo('<script type="text/javascript">alert("Payment Amount is greater than overall Total"); window.location="finance_in.php";</script>'); exit;
  }


$inv=$_POST['grb_number']; 

$po_no=$_POST['po_number']; 

//echo $po_no;

//echo $inv;exit;



   $asda =('SELECT sum(`payment_amount`) as payment_amount FROM `grb_payment` WHERE inv_no="'.$po_no.'"  group by `inv_no`');

 //	echo $asda; exit;
 	
	$dataa = $db->query($asda);
	$pras = $dataa->fetch(PDO::FETCH_ASSOC);
	
	$code = $pras['payment_amount'];
//	echo 'code value'.$code;exit;
	
	
    $payment_amount_1=$code + $_POST['payment_amount'];
    
    
   //echo $payment_amount_1; exit;
   
                if($payment_amount_1 > $_POST['overall_total_1'])
            {
                // echo "asdasd2"; exit;
            echo('<script type="text/javascript">alert("Payment Amount is greater than overall Total"); window.location="finance_in.php";</script>'); exit;
            }
            if($_POST['grb_payment_for']!='Advance'){
                $payment_type=2;
            }
            else{
                 $payment_type=1;
            }
            // echo  $payment_type; exit;
	                    $field_values=array();
						$field_values[0]=htmlentities(($_POST['payment_mode']),ENT_QUOTES);
						$field_values[1]=htmlentities(($_POST['transaction_no']),ENT_QUOTES);
						$field_values[2]=htmlentities(($_POST['payment_amount']),ENT_QUOTES);
						$field_values[3]=htmlentities(($_POST['po_number']),ENT_QUOTES);
						$field_values[4]=htmlentities(($_POST['grb_number']),ENT_QUOTES);
						$field_values[5]=htmlentities(($payment_type),ENT_QUOTES);
						//print_r($field_values); exit;
						$rdata=$db->insertreturnid('grb_payment',$field_values," payment_mode, transaction_no, payment_amount, inv_no,grb_number,payment_type");
						$rdataa = $db->query($rdata);				
							
				$field_values[6]=1;				      	
				//print_r($field_values); exit;
				$payment_update =('UPDATE po_entry SET payment_status="'.$field_values[6].'" WHERE `invoice_no`="'.$field_values[4].'" ');				   
			    //echo $payment_update;exit;

				$datdasd = $db->query($payment_update);
					if($rdataa)
						{
							echo('<script type="text/javascript">alert("Finance In Updated"); window.location="finance_in.php";</script>'); exit;
				
						}
					else
						{
							echo('<script type="text/javascript">alert("Error! Finance In not updated try again."); window.location="finance_in.php";</script>'); exit;
						}
}
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>