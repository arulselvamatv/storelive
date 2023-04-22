<html>
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th{ padding:10px;background:#eee; }
</style>
<body style="overflow-x:hidden;margin:20px 70px">
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();
$code=base64_decode($_GET['dep_no']);
	echo "
		<style>
			@media
		{
				size:A4 Portrait;
		}
		
		</style>
		
		<center><h2>Goods Inward Slip</h2></center>
		
	    <div style=\"text-align:left;\"><b>Department Po-No :<span style='padding-left:5px'> ".$code."</span> </b></div>
	
	    <div style=\"text-align:left;\"><b>Department Name :<span style='padding-left:5px'>sdojhdif</span></b></div><br> ";
	   
	    echo" <div style='width:100%;border:3px solid gray;padding:5px;overflow-x:hidden;' border=1> ";
	    
 
        $asd =('SELECT wo.dep_no,wo.remarks,st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`,st.`dc_bill_no`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, 
        
                count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`,wo.suplier_id as suplier_id, s.name as supplier_name,
                
                wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no ,wo.location,wo.adv,
                
                st.`disc_amt`, st.`gst_amt`,
                
        		wo.tran_charge ,wo.tran_charge_per,wo.tran_charge_gst ,
        		wo.ser_charge ,wo.ser_charge_per ,wo. 	ser_charge_gst ,

                wo.po_no as po_no
                
                from store_entry as st
                
                INNER join work_order as wo on  wo.wo_id =st.po_id
                INNER join suplier as s on s.sup_id =wo.suplier_id
                where wo.dep_no ="'.$code.'" group by st.invoice_no');
                
                
	//	echo $asd;
		
		$i=0;
		$prdt_data = $db->query($asd);
        $i=1;



    while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
		    $adv=$prd['adv'];
		    $tcs_amount=$prd['tcs_amount'];
		    $insurance_amount=$prd['insurance_amount'];
		    $tran_charge=$prd['tran_charge'];
		    $tran_charge_per=$prd['tran_charge_per'];
		    $tran_charge_gst=$prd['tran_charge_gst'];
		    $ser_charge=$prd['ser_charge'];
		    $ser_charge_per=$prd['ser_charge_per'];
		    $ser_charge_gst=$prd['ser_charge_gst'];
		     if($prd['billno']!=0)
             {
             echo "<br>
             <div style=\"text-align:right;\"><b> Bill Date: ".date("d-m-Y",strtotime($prd['po_date']))."</b></div>
            <div style=\"text-align:right;\"><b> Store in entry slip Number/Bill Number : ".$prd['invoice_no']."/".$prd['billno']."</b></div>";
            
            }
            else 
             {
             echo "<br>
             <div style=\"text-align:right;\"><b> Bill Date: ".date("d-m-Y",strtotime($prd['po_date']))."</b></div>
             <div style=\"text-align:right;\"><b> Store in entry slip Number/DC Bill Number : ".$prd['invoice_no']."/".$prd['dc_bill_no']."</b></div>";
             
             }
              echo "<span style='color:#ff0000'>*</span> <b>The following goods are recevied from M/s ".$prd['supplier_name']." on ".date("d-m-Y",strtotime($prd['bill_date']))." .<b><br>";
      echo " <br>
      
	
		<table style='width:100%;' border=1 >
		<thead>
		<tr>
		<th style='text-align:center;'>S.No</th>
		<th style='text-align:center;'>Product Name</th>
		<th style='text-align:center;'>Ordered Quantity</th>
		<th style='text-align:center;'>Delivered Quantity</th>
		<th style='text-align:center;'>Supplier Per Amount</th>
		<th style='text-align:center;'>Discount value </th>
		<th style='text-align:center;'>Discount Command </th>
		<th style='text-align:center;'>Discount Amount </th>
		<th style='text-align:center;'>After Dis Per Amount</th>
		<th style='text-align:center;'>GST %</th>
		<th style='text-align:center;'> Total Amount</th>
		</tr>
		</thead>
		";
		
		echo "<tbody>";
		$inv_no=$prd['invoice_no'];
        $asd1 =('SELECT wo.dep_no,wo.remarks,st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`,st.`dc_bill_no`, st.`received_qty` as qty,
        		 st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.dis_amt_value,st.`received_date` as po_date, st.`u_id`,
        		 wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no ,
        		 st.`disc_amt`, st.`gst_amt`,
        		 wo.location, wo.po_no as po_no
        		
                 from store_entry as st
                 INNER join work_order as wo on  wo.wo_id =st.po_id
                 INNER join suplier as s on s.sup_id =wo.suplier_id
                 where wo.dep_no ="'.$code.'" and st.invoice_no="'.$inv_no.'" group by wo.prod_name');

                 //echo $asd1;
                 
        $prdt_data1 = $db->query($asd1);
        
        
       $tot=0;
       $sno=0;
        while($prd1 = $prdt_data1->fetch(PDO::FETCH_ASSOC))
        {
            
           
            

    		$qty=$prd1['qty'];
    		$per_amt=$prd1['per_amt'];
    		$amt  = $qty *$per_amt ;
    		$tot += $qty*$per_amt;
    		
    		$tot1 += $qty*$per_amt;

    		echo"<tr>
    		<td>".(++$sno)."</td>
    		<td><b>&nbsp".$prd1['item_name']."</b><br>".$prd1['item_desc']."</td>
    		<td>&nbsp".$prd1['actual_qty']."</td>
    		<td>&nbsp".$prd1['qty']."</td>
    		<td>&nbsp".$prd1['bill_amt']."</td>
    		<td>&nbsp".$prd1['dis_amt_value']."</td>
    		<td>&nbsp".$prd1['discamt']."</td>
    		<td>&nbsp".$prd1['disc_amt']."</td>
    		<td>&nbsp".$prd1['per_amt']."</td>
    		<td>&nbsp".$prd1['gst_amt']."</td>
    		<td>&nbsp".$amt."</td>
            </tr>";
        }
	echo "</tbody>";
	echo "<tfoot>
          <tr>
               <td colspan='10' style='text-align:right;padding:7px;font-size:18px;'> <b>Bill Total</b></td>
    		   <td style='padding:7px;font-size:18px;'> <b>".$tot."</b></td>
    	  </tr>
     </tfoot>
     </table>";
}
 echo "
<br><br>
<table style='width:100%;' border=1 > <tr>
<td style='text-align:right;padding:7px;font-size:18px;'><b>Grand Total : $tot1</b></td>
</tr>
</table>
<br><br>
<span style='color:red;font-size:15px'>*</span> <b>Other Charges :</b>
<table style='width:100%;padding:5px;border:2px solid gray' border=1>
		<thead>
	<tr>
		<td style='text-align:left;font-weight:600;padding:5px;'>Request Amount For Advance : <span id='adv' name='adv'>$adv</span>
          <input class='form-control' type='hidden' id='adv_balance' name='adv_balance' value='0'></td>
		<td style='text-align:left;font-weight:600;padding:5px;'>Tcs Amount : <span id='balances_amt' name='balances_amt'>$tcs_amount</span></td>
		<td style='text-align:left;font-weight:600;padding:5px;'>Insurance Amount : <span id='balances_amt' name='balances_amt' >$tcs_amount</span></td>
	</tr>
	<tr>
		<td style='text-align:left;font-weight:600;padding:5px;'>Transport Charge : <span id='tran_charge' name='tran_charge'>$tran_charge</span></td>
		<td style='text-align:left;font-weight:600;padding:5px;'>Transport GST Percent : <span id='tran_charge_per' name='tran_charge_per' >$tran_charge_per</span></td>
		<td style='text-align:left;font-weight:600;padding:5px;'>Transport Total Amount : <span id='tran_charge_gst' name='tran_charge_gst'>$tran_charge_gst</span></td>
	</tr>
	<tr>
		<td style='text-align:left;font-weight:600;padding:5px;'>Service Charge : <span id='ser_charge' name='ser_charge' >$ser_charge</span></td>
		<td style='text-align:left;font-weight:600;padding:5px;'>Service GST Percent : <span id='ser_charge_per' name='ser_charge_per'>$ser_charge_per</span></td>
		<td style='text-align:left;font-weight:600;padding:5px;'>Service Total Amount : <span id='ser_charge_gst' name='ser_charge_gst'>$ser_charge_gst</span></td>
	</tr>
		</thead>
</table>
<div>
<br><br>
<table width=100% style='border:1px solid #fff'>

<tr class='text-right'>
<span style='color:#ff0000'>*</span> <b>The quantity and quality have been verified and found to  be correct<b>

<br>
<br>
<br>
<br>
<br>

<td class=' fw-bold' style='border:1px solid #fff'><b> Signature of the Department Representative<b></td>
<td style='text-align:right; border:1px solid #fff'><b>Signature of the Store Officer</b></td>

</tr></table></div>
</div>
";
echo " 

 <br>
 <br>
 <br> 
	";
?>
</body>
</html>