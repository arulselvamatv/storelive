<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 

$gd=$_POST['overall_total_1']; 

$gd1=$_POST['payment_amount']; 
$amt=$_POST['amt']; 

//echo $amt;exit;


// if($_POST['payment_amount'] > $_POST['overall_total_1'])
//   {
//     // echo "asdasd1"; exit;
// 	echo('<script type="text/javascript">alert("Payment Amount is greater than overall Total111"); window.location="finance_in_test.php";</script>'); exit;
//   }
  
  
  if($_POST['payment_amount'] > $_POST['amt'])
   {
    // echo "asdasd1"; exit;
	echo('<script type="text/javascript">alert("Grb Payment Amount Not Shoud be Greater then of Grb Amount"); window.location="finance_in_test.php";</script>'); exit;
   }
 
 
  if($_POST['amt'] > $_POST['payment_amount'])
   {
    // echo "asdasd1"; exit;
	echo('<script type="text/javascript">alert("Grb Payment Amount Not Shoud be less then  Grb Amount"); window.location="finance_in_test.php";</script>'); exit;
   }


$inv=$_POST['grb_number']; 

//echo $inv;

$po_no=$_POST['po_number'];

$grb_payment_for=$_POST['grb_payment_for'];

$amount_value=$_POST['amount_value'];

//echo $amount_value;exit;

//echo $po_no;

//echo $po_no;

//echo $inv;exit;



   $asda =('SELECT sum(`payment_amount`) as payment_amount FROM `grb_payment` WHERE inv_no="'.$po_no.'"  group by `inv_no`');

 //	echo $asda; exit;
 	
	$dataa = $db->query($asda);
	$pras = $dataa->fetch(PDO::FETCH_ASSOC);
	
	$code = $pras['payment_amount'];
//	echo 'code value'.$code;exit;
	
	
    $payment_amount_1=$code + $_POST['payment_amount'];
    
    
  // echo $payment_amount_1; exit;
  
                            // if($_POST['grb_payment_for']!='Advance')
                            // {
                            // $payment_type=2;
                            // }
                            // else
                            // {
                            //      $payment_type=1;
                            // }
  
   
        // if($payment_amount_1 > $_POST['overall_total_1'])
           
        //     {
        //     echo('<script type="text/javascript">alert("Payment Amount is greater than overall Total11"); window.location="finance_in_test.php";</script>'); exit;
        //     }
            
    //         else if($_POST['grb_payment_for']!='Advance')
    //         {
	   //                 $field_values=array();
				// 		$field_values[0]=htmlentities(($_POST['payment_mode']),ENT_QUOTES);
				// 		$field_values[1]=htmlentities(($_POST['transaction_no']),ENT_QUOTES);
				// 		$field_values[2]=htmlentities(($_POST['payment_amount']),ENT_QUOTES);
				// 		$field_values[3]=htmlentities(($_POST['po_number']),ENT_QUOTES);
				// 		$field_values[4]=htmlentities(($_POST['grb_number']),ENT_QUOTES);
				// 		$field_values[5]=htmlentities(($payment_type),ENT_QUOTES);
					

				// 		$rdata=$db->insertreturnid('grb_payment',$field_values," payment_mode, transaction_no, payment_amount, inv_no,grb_number,payment_type");
				// 		$rdataa = $db->query($rdata);
				
				//       	$field_values[6]=1;

				//         $payment_update =('UPDATE po_entry SET payment_status="'.$field_values[6].'" WHERE `invoice_no`="'.$field_values[4].'" ');

				//         $datdasd = $db->query($payment_update);
            
    //         else 
    //         {
                        $field_values=array();
						$field_values[0]=htmlentities(($_POST['payment_mode']),ENT_QUOTES);
						$field_values[1]=htmlentities(($_POST['transaction_no']),ENT_QUOTES);
						$field_values[2]=htmlentities(($_POST['payment_amount']),ENT_QUOTES);
						$field_values[3]=htmlentities(($_POST['po_number']),ENT_QUOTES);
						$field_values[4]=htmlentities(($_POST['grb_number']),ENT_QUOTES);
						$field_values[5]=2;
						$field_values[6]=1;
					
						$rdata=$db->insertreturnid('grb_payment',$field_values," payment_mode, transaction_no, payment_amount, inv_no,grb_number,payment_type,advance_paid_statues");

						$rdataa = $db->query($rdata);
				
				        $payment_update =('UPDATE po_entry SET payment_status="'.$field_values[6].'"  WHERE `invoice_no`="'.$field_values[4].'" ');

				        $datdasd = $db->query($payment_update);
            // }
				
				
	if($rdataa)
		{
			echo('<script type="text/javascript">alert("Finance In Updated"); window.location="finance_in_test.php";</script>'); exit;
		}
	else
		{
			echo('<script type="text/javascript">alert("Error! Finance In not updated try again."); window.location="finance_in_test.php";</script>'); exit;
		}

}



catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>