<?php 
require_once("database/connect.php");
$db=new Database;
$con=$db->connect();

$wo_no=$_GET['wo_no'];

//echo $wo_no;
// $quo_no=$_GET['quo_no'];

//echo $wo_no;'<br>';
//echo $quo_no;'<br>';

$HTML="";	
if($con)
	{
        //   $asd =('SELECT s.company_name,s.name, qsa.`suplier_id` FROM `quot_sup_amt_sel` as qsa
        //         inner join suplier as s on s.sup_id= qsa.suplier_id
        //         WHERE `wo_no`="'.$wo_no.'" and qsa.active_record =1 group by suplier_id');
                

		
		//echo $prdt_data;exit;
		
//$i=1;
//$tr2="";

	//if($i==1)
	//{
	//	$tr1="
	echo "<style>
			@media{
				size:A4 Portrait;
			}
		</style>
		<center><img src=\"img/Header.jpg\"></center>
		<center><h3><b>Work Order Preview Slip<b></h3></center>";


		
$asd1 =('SELECT qs.`qas_id`,qs.`wo_no`, qs.`suplier_id`, qs.`quo_no`, qs.`prod_name`, qs.`ddl_pro_qty`, qs.`ddl_pro_unit`, qs.`product_spec`,                qs.`suplier_amt`, qs.`disc_amt`,qs.`bill_type`, 
		qs.`gst_amt`, qs.`tot`, qs.`check_no`, qs.`date_time`, qs.`po_status`,s.sup_id,s.company_name,s.mobile,s.name,s.address,qs.`active_record` FROM `quot_sup_amt_sel` as qs
   inner join suplier as s on s.sup_id= qs.suplier_id
   WHERE `wo_no`='.$wo_no.' and qs.active_record=1 group by prod_name limit 1');

//echo $asd1; exit;

$data1 = $db->query($asd1);

while($row1 = $data1->fetch(PDO::FETCH_ASSOC))
            {
		
	 echo"
	   <style>
    .clearfix:after {
      content: '';
      display: table;
      clear: both;
    }  

    #client {
      padding-left: 6px;
      float: left;
      padding-bottom: 30px;
    }
 
    #invoice {
      float: right;
      text-align: right;
    } 
  </style>
  
   <div id='details' class='clearfix'>
   <div style=\"text-align:left;\"><u><h3 style='margin:0;'>Supplier Details</h3></u></div>
       <div id='client'> 
         
	      <div style=\"text-align:left;\"><b>Company Name&nbsp:&nbsp".$row1['company_name']."</b></div>
	      <div style=\"text-align:left;\"><b>Supplier Name&nbsp&nbsp&nbsp:&nbsp".$row1['name']."</b></div>
		  <div style=\"text-align:left;\"><b>Contact&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp".$row1['mobile']."</b></div>
		  <div style=\"text-align:left;\"><b>Address&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp".$row1['address']."</b></div> 
      </div>

      <div id='invoice'> 
		<div style=\"text-align:right;\"><b>Quotation Number:".$row1['quo_no']."</b></div>
		<div style=\"text-align:right;\"><b>Bill Type:     ".$row1['bill_type']."</b></div>
		<div style=\"text-align:right;\"><b>Work Order Number:".$row1['wo_no']."</b></div>
      </div>
    </div>";
	      
	     
	
		
		
	}



	echo "<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>";
		
	
		    
echo   "<tr>
		<td>Sno</td>
		<td>Product Name</td>
		<td>Specification needed</td>
		<td>Quantity</td>
		<td>Supplier Amount</td>
		<td>Discount</td>
		<td>gst_amt</td>
		<td>Total</td>
		
		</tr>
		</thead>
		<tbody>
		";
		
		$asd =('SELECT qs.`qas_id`,qs.`wo_no`, qs.`suplier_id`, qs.`quo_no`, qs.`prod_name`, qs.`ddl_pro_qty`, qs.`ddl_pro_unit`, qs.`product_spec`, qs.`suplier_amt`, qs.`disc_amt`, qs.`gst_amt`, qs.`tot`, qs.`check_no`, qs.`date_time`, qs.`po_status`,s.sup_id,s.company_name, qs.`active_record` FROM `quot_sup_amt_sel` as qs
        inner join suplier as s on s.sup_id= qs.suplier_id
        WHERE `wo_no`='.$wo_no.' and qs.active_record=1 group by prod_name');
        
        
       //echo $asd;

	//	$i=0;
		$prdt_data = $db->query($asd);
			while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
		

		$i++;
//	}
	  echo "<td>$i</td>
    		<td>".$prd['prod_name']."</td>
    		<td>".$prd['product_spec']."</td>
    		<td>".$prd['ddl_pro_qty']."</td>
    		<td>".$prd['suplier_amt']."</td>
    		<td>".$prd['disc_amt']."</td>
    		<td>".$prd['gst_amt']."</td>
    		<td>".$prd['tot']."</td>
		
		</tr>";
		}
	
"</tbody></table>";

		
}
//echo $tr1.$tr2.";

//	<div style=\"text-align:right;\"><b>Company Name:".$prd['company_name']."</b></div>

?>

</body>
</html>
	



