<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$s_date=$_GET['s_date'];
$e_date=$_GET['e_date'];
// echo $e_date; exit;

$HTML="";
	if($con)
	{
		echo '<!DOCTYPE html>
		<html lang="en">
		  <head>
			<meta charset="UTF-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<title>Suplier Bills History</title>
			<style>
      body {
        background-color: white;
      }

      header {
        background-color: #368bc1;
        border: 2px solid #368bc1;
        height: 45px;
        margin-top: 50px;
        padding: 0px;
        text-align: center;
        color: white;
        font-size: 10px;
        box-sizing: border-box;
      }

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td,
      th {
        border: 2px solid #dddddd;
        text-align: left;
        padding: 10px;
      }

    </style>
	  </head>
  	<body>
    <header>
      <h1>Suplier Bills History</h1>
    </header>
    <div>
      <h3>From: '.$s_date.'</h3>
    </div>
	<div style="padding-left: 60%; text-align: left; position: absolute; top: 85px">
      <h3 style="padding: 5px 10px">To: '.$e_date.'</h3>
    </div>';
	$asd =('select st.`bill_date`, s.company_name, s.gstin_no , st.billno from store_entry as st 
	inner join work_order as w on w.wo_id = st.po_id
	inner join suplier as s on s.sup_id =w.suplier_id
	where st.bill_date >= "'.$s_date.'" and st.bill_date <= "'.$e_date.'" group by s.sup_id');
	// echo $asd; exit;
	$prdt_data = $db->query($asd);
	while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
	{ 
		echo '
    <div>
      <h2 style="color: #ff0000">
        Suplier Name: '.$prd['company_name'].'
        <span style="margin-left: 5rem">GST NO: '.$prd['gstin_no'].'</span>
      </h2>
    </div>
	<div>
      <h2>Bill No: '.$prd['billno'].'</h2>
    </div>
	<table>
      <tr style="background-color: #f5f5f5;">
        <th>SNO.</th>
        <th>Date</th>
        <th>Item Name/ Desc</th>
        <th>Rate</th>
        <th>Qty</th>
        <th>Dis%</th>
        <th>GST%</th>
        <th>Total</th>
      </tr>';
	$asda =('select st.`bill_date`, s.company_name, st.billno, s.gstin_no, w.prod_name,w.product_spec,st.bill_amt, count(st.store_id) as qty, st.gst_amt, st.disc_amt from store_entry as st 
	inner join work_order as w on w.wo_id = st.po_id
	inner join suplier as s on s.sup_id =w.suplier_id
	where st.bill_date >= "'.$s_date.'" and st.bill_date <= "'.$e_date.'" and s.company_name="'.$prd['company_name'].'" group by w.prod_name , st.`bill_date` ORDER  BY st.`bill_date` DESC');
			// echo $asd; exit;
			$prdt_dataa = $db->query($asda);
			$i=0;
			while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))
			{ $i++;
	$bill_value= $prda['bill_amt'] * $prda['qty'];
	$tmp_disc=($bill_value*$prda['disc_amt']/100);
	$gst=(($bill_value-$tmp_disc)*$prda['gst_amt']/100);
	echo '
      <tr>
        <td>'.$i.'</td>
        <td>'.$prda['bill_date'].'</td>
        <td>'.$prda['prod_name'].'/'.$prda['product_spec'].'</td>
        <td>'.$prda['bill_amt'].'</td>
        <td>'.$prda['qty'].'</td>
        <td>'.$prda['disc_amt'].'%<input type="hidden" class="disc_amt" id="disc_amt_'.$i.'" value='.$prda['disc_amt'].' ><input type="hidden" class="disc_amts" id="disc_amts_'.$i.'" value='.$tmp_disc.' ></td>
        <td>'.$prda['gst_amt'].'%<input type="hidden" class="gst_amt" id="gst_amt_'.$i.'" value='.$prda['gst_amt'].' ><input type="hidden" class="gst_amts" id="gst_amts_'.$i.'" value='.$gst.' ></td>
        <td>'.$bill_value.'<input type="hidden" class="tots" id="tots_'.$i.'" value='.$bill_value.' ></td>
      </tr>';
	}
      echo'<tr>
	  	<td colspan=6></td>
        <td>Unit Total</td>
        <td class="unit_total"></td>
      </tr>
      <tr>
	  <td colspan=6></td>
		<td>Discount</td>
		<td class="disc"></td>
      </tr>
      <tr>
	  <td colspan=6></td>
		<td>Sub Total</td>
		<td class="sub_total"></td>
      </tr>
	  <tr>
	  <td colspan=6></td>
		<td>GST</td>
		<td class="gst"></td>
      </tr>
	  <tr style="background-color: #f5f5f5;">
	  <td colspan=6></td>
		<td>Overall Total</td>
		<td class="grand_total"></td>
      </tr>
    </table>';
			
		}?>
		<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>
<script>
	$(document).ready(function() {				
		var total = 0;
				$(".tots").each(function (index, element) {
					
					total = Number(total) + Number($(element).val());
				});
				var total_r=total.toFixed();
		$(".unit_total").html(total_r);
		var discount = 0;

				$(".disc_amts").each(function (index, element) {
					var this_attr_id = $.trim($(this).attr("id"));
                	var splt_this_id = this_attr_id.split("_");
                	var splt_this_id_ar = splt_this_id[2];
					var tots = $('#tots_'+splt_this_id_ar).val();
					var disc_amt = $(element).val();
					
					 discount = Number(discount) + Number(disc_amt);
					
				});
				var discount_r=discount.toFixed();
				$(".disc").html(discount_r);
				$(".sub_total").html( Number(total_r) - Number(discount_r));

		var gst = 0;

				$(".gst_amts").each(function (index, element) {
					var this_attr_id = $.trim($(this).attr("id"));
					var splt_this_id = this_attr_id.split("_");
					var splt_this_id_ar = splt_this_id[2];
					var tots = $('#tots_'+splt_this_id_ar).val();
					var gst_amt = $(element).val();
					gst = Number(gst) + Number(gst_amt);
					
				});
				var gst_r=gst.toFixed();
				$(".gst").html(gst_r);
				$(".grand_total").html( Number(total_r) - Number(discount_r) + Number(gst_r));		
				var amt_wrrd = Number(total_r) - Number(discount_r) + Number(gst_r);
				function price_in_words(price) {
  var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
    dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
    tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
    handle_tens = function(dgt, prevDgt) {
      return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt])
    },
    handle_utlc = function(dgt, nxtDgt, denom) {
      return (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") + (0 != nxtDgt || dgt > 0 ? " " + denom : "")
    };

  var str = "",
    digitIdx = 0,
    digit = 0,
    nxtDigit = 0,
    words = [];
  if (price += "", isNaN(parseInt(price))) str = "";
  else if (parseInt(price) > 0 && price.length <= 10) {
    for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--) switch (digit = price[digitIdx] - 0, nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0, price.length - digitIdx - 1) {
      case 0:
        words.push(handle_utlc(digit, nxtDigit, ""));
        break;
      case 1:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 2:
        words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2] ? " and" : "") : "");
        break;
      case 3:
        words.push(handle_utlc(digit, nxtDigit, "Thousand"));
        break;
      case 4:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 5:
        words.push(handle_utlc(digit, nxtDigit, "Lakh"));
        break;
      case 6:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 7:
        words.push(handle_utlc(digit, nxtDigit, "Crore"));
        break;
      case 8:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 9:
        words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2] ? " and" : " Crore") : "")
    }
    str = words.reverse().join("")
  } else str = "";
  return str

}
				
				$(".amt_wrd").html(price_in_words(amt_wrrd));	

		});
	</script>
	<?php
    
	  

	}
	    
?>