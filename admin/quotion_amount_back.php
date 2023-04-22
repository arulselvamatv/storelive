<?php
require_once("database/connect.php");
$db=new Database;
$db->connect();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 

        $quo_no=$_POST['quo_no'];

        $prod_name=$_POST['prod_name'];

        $ddl_pro_qty=$_POST['ddl_pro_qty'];

        $ddl_pro_spec=$_POST['ddl_pro_spec'];

        $supplier_name=$_POST['suplier_name'];

        $supplier_amt=$_POST['supplier_amt'];

        $disc_amt=$_POST['disc_amt'];

        $gst_amt=$_POST['gst_amt'];

        $tot=$_POST['tot'];

        $bill_type=$_POST['bill_type'];

        $timelinedays=$_POST['timelinedays'];

        $asd =('SELECT (MAX(`code`)+1) as fdg  FROM `quot_sup_amt` ');

        //echo $asd; exit;

        $datd = $db->query($asd);

        while($data=$datd->fetch(PDO::FETCH_ASSOC))

        {

        $fdg = $data['fdg'];

        }

        $no_rows=count($prod_name);
        $emp_data =$db->query('SELECT (count(suplier_name)) FROM quot_sup_amt where suplier_name = "'.$supplier_name.'" and quo_no="'.$quo_no.'"');
        $result = $emp_data->fetch();
        $count = $result[0];

        //echo $supplier_name; exit;
        //echo $datd; 
        // $emp_dat =$db->query('SELECT `sup_id` FROM `suplier` WHERE `sup_id` = "'.$supplier_name.'" and `active_record`=1');
        // $resul = $emp_dat->fetch();
        // $sup_id = $resul[0];
        // //echo $sup_id; exit;     

        if($count == 0)
		{
            for($i=0;$i<$no_rows;$i++)
			{
                $quo_no=$_POST['quo_no'];
                $prod_name=$_POST['prod_name'];
                $ddl_pro_qty=$_POST['ddl_pro_qty'];
                $ddl_pro_spec=$_POST['ddl_pro_spec'];
                $supplier_amt=$_POST['supplier_amt'];
                $ddl_pro_unit=$_POST['ddl_pro_unit'];
                $timelinedays=$_POST['timelinedays'];
                $bill_type=$_POST['bill_type'];
                $field_values=array();

				$field_values[0]=htmlentities(($quo_no),ENT_QUOTES);

				$field_values[1]=htmlentities(($prod_name[$i]),ENT_QUOTES);

				$field_values[2]=htmlentities(($ddl_pro_qty[$i]),ENT_QUOTES);

                $field_values[3]=htmlentities(($ddl_pro_spec[$i]),ENT_QUOTES);

                $field_values[4]=htmlentities(($supplier_name),ENT_QUOTES);

                $field_values[5]=htmlentities(($supplier_amt[$i]),ENT_QUOTES);

                $field_values[6]=htmlentities(($supplier_name),ENT_QUOTES);

                $field_values[7]=htmlentities(($ddl_pro_unit[$i]),ENT_QUOTES);

                $field_values[8]=htmlentities(($disc_amt[$i]),ENT_QUOTES);

                $field_values[9]=htmlentities(($gst_amt[$i]),ENT_QUOTES);

                $field_values[10]=htmlentities(($tot[$i]),ENT_QUOTES);

               $field_values[11]=htmlentities(($timelinedays),ENT_QUOTES);

               $field_values[12]=htmlentities(($bill_type[$i]),ENT_QUOTES);

              
                //print_r($field_values);

                // echo( 'INSERT INTO `quot_sup_amt`( `quo_no`, `product_name`, `product_quantity`, `product_spec`) VALUES("'.$quo_no.'","'.$prod_name[$i].'", '.$ddl_pro_qty[$i].', "'.$ddl_pro_spec[$i].'")'); exit;

				$rdata=$db->insertreturnid('quot_sup_amt',$field_values," quo_no, product_name, product_quantity, product_spec,suplier_name,suplier_amt, suplier_id, ddl_pro_unit,disc_amt,gst_amt,tot,timelinedays,bill_type");

                //print_r($rdata); exit;

                if($rdata){

                    // echo $rdata; 
                    $result = "Po";
                    $results = $result.substr_replace('0000', trim($fdg), -strlen(trim($fdg)));
                    //echo $results; exit; 
                    $field_value=array();
                    $field_value['code']= $fdg;
                    $field_value['po_no']= $results;
                    $rdaa=$db->update('quot_sup_amt', $field_value,'qsa_id=\''.$rdata.'\'');
                    // updated category updated no
                }

                

            } 

            if($rdata)

            {

                echo "Quotation Suplier Amount Info Stored Sucessfully"; exit;

            }

            else

            {

                echo "Error! Quotation Suplier Amount Not Updated Try Again."; exit;

            }

            

        }

        else

        {

            for($i=0;$i<$no_rows;$i++)

            {

                $quo_no=$_POST['quo_no'];

                $supplier_amt=$_POST['supplier_amt'];

                $prod_name=$_POST['prod_name'];

                $disc_amt=$_POST['disc_amt'];

                $gst_amt=$_POST['gst_amt'];

                $tot=$_POST['tot'];

                $timelinedays=$_POST['timelinedays'];

                $sda =('UPDATE quot_sup_amt SET `suplier_amt`='.$supplier_amt[$i].', `disc_amt`="'.$disc_amt[$i].'", `gst_amt`="'.$gst_amt[$i].'", `tot`="'.$tot[$i].'", `timelinedays`="'.$timelinedays.'" WHERE `product_name`="'.$prod_name[$i].'" and `quo_no`= "'.$quo_no.'" ');

				$datdaaaa = $db->query($sda);

                // exit;

            }

            if($datdaaaa){

                echo "Supplier Amt Sucessfully Updated"; exit;

            }

            else{

                echo "Error! Supplier Amt Not Updated Try Again."; exit;

            }

        }
}

catch(Exception $my_e)

{

    echo "err";

    echo $my_e->getMessage();

} 

        

?>