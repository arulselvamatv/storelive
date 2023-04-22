<html>

<body>

<!-- <body onload="window.print();"> -->

<!-- <center><img src="img/Header.jpg">

</center> -->

<hr/>

<?php

require_once("database/connect.php");

$db=new Database;

$db->connect();

$po_no=$_GET['po_no'];

$po = "PO_".$po_no;

if(isset($_GET['header']))

{

    $header=$_GET['header'];

}

else

{

    $header=0;

}

/// Header

if($header==0)

{

    echo "<table style='width:100%;'><thead><tr><td></td></tr></thead>";

    /* echo '

    <style>

        @page

        {

            margin: 250mm 250mm 25mm 25mm;

        }

    </style>

    '; */

}

elseif($header==1)

{

    echo "<table style='width:100%;'><thead><tr><td>";

    echo "<center><img src=\"img/Header.jpg\"></center>";

    echo "<hr/></td></tr></thead>";

    //echo "<center><img src=\"images/header.jpg\"></center>";

}

// elseif($header==3)

// {

//  echo "<table style='width:100%;'><thead><tr><td>";

//  echo "<center><img src=\"img/Header.jpg\"></center>";

//  echo "<hr/></td></tr></thead>";

//  //echo "<center><img src=\"images/header.jpg\"></center>";

// }

// elseif($header==4)

// {

//  echo "<table style='width:100%;'><thead><tr><td>";

//  echo "<center><img src=\"img/Header.jpg\"></center>";

//  echo "<hr/></td></tr></thead>";

//  //echo "<center><img src=\"images/header.jpg\"></center>";

// }

// elseif($header==5)

// {

//  echo "<table style='width:100%;'><thead><tr><td>";

//  echo "<center><img src=\"img/Header.jpg\"></center>";

//  echo "<hr/></td></tr></thead>";

//  //echo "<center><img src=\"images/header.jpg\"></center>";

// }

else

{

    echo "<table style='width:100%;'><thead><tr><td><div style='height:25mm;'></div></td></tr></thead>";

}

//echo "<hr/>";

//header over

    $asd =('SELECT s.name,s.mobile,s.company_name, s.address,`wo_id`, dep_no, dept,bill_type,`location`, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, `ddl_pro_qty`, `product_spec`, `suplier_id`, `sup_amt`, `disc_amt`, `gst_amt`, `tot`, work_order1.`active_record`, work_order1.`date_time` FROM `work_order1` 

    inner join suplier as s on s.sup_id = work_order1.suplier_id

    WHERE work_order1.`active_record`=1 and work_order1.po_no ="'.$po.'"  group by work_order1.prod_name');

    //echo $asd; exit;

    $data = $db->query($asd);

$i=0;

$tr2="";

$j=1;

$rowcnt=1;

$tr1="";

while($row = $data->fetch(PDO::FETCH_ASSOC))

            {

            $dept_w=$row['dept'];
            $bill_type=$row['bill_type'];

    $dept =('SELECT  `d_name`, `institution`, `address`, `email_phoneno`, `authorised_signature` FROM `department` WHERE d_name="'.$dept_w.'" ');

    $dept_1 = $db->query($dept);

    //  echo $dept; exit;

   while($depts = $dept_1->fetch(PDO::FETCH_ASSOC))

            {

	$institution = $depts['institution'];

	$address = $depts['address'];

	$email_phoneno = $depts['email_phoneno'];

	$authorised_signature = $depts['authorised_signature'];

            }

    if($i==0)

    {

        echo "

        <style>

            @media print{

                size:A4 Portrait;

                margin: 25mm 25mm 25mm 25mm;

            .pnt_fnt{

                font-size:16px;

            }

            table{

                font-size:18px;

            }

                

            }

            .pnt_fnt{

                font-size:16px;

            }

            table{

                font-size:14px;

            }

        </style>

        </style>

        <tbody><tr><td>";

        if($bill_type=="serviceorder")
        {
            echo " <center><h3>========== Services Order ==========</h3></center>";
        }
        else
        {
             echo " <center><h3>========== Purchase Order ==========</h3></center>";
        }

        echo"<div style=\"text-align:right;\"> <b>Order No:</b>".$row['dep_no']."<b> / Dated: ".$row['date_time']."</b></div>

        <div style='border: 1px solid black;'></tr></td></tbody></table>

        <table style='width:100%' border='1'><tr><td style=\"width:50%;vertical-align:top;\"><u><h3 style='margin:0;'>Invoice To</h3></u>";

        echo"<b>Institution:</b></br>".$institution;

        echo"<br><b>Department/Location:</b><br>".$row['location'];

        echo"<br><b>Address:</b><br>".$address;

        echo"<br><b>E-mail / Phone No:</b><br>".$email_phoneno;

        echo"</td>";

        echo"<td style=\"vertical-align:top\"><u><h3 style='margin:0;'>Supplier Details</h3></u>";

        echo"<b>Supplier:</b><br><b>".$row['company_name']." </b><br> ".$row['address'];

        echo"<br><b>Contact:</b><br>".$row['name']." / ".$row['mobile']."</td></tr></table>

        </div>";

        echo"<table style='width:100%;' border=1>

        <thead>

        <tr>

        <td>Sl.No.</td>

        <td>Product</td>

        <td style=text-align:right>Qty.</td>

        

        <td style=text-align:right>Per Product Amount.</td>

        <td style=text-align:right>Discount %</td>

        <td style=text-align:right>GST %</td>

        <td style=text-align:right>Total Amount</td>

        

        </tr>

        </thead>

        <tbody>

        ";

        $i++;

    }

        if($j==1)

            {

                    $tr='<tr>

                        <td>'.$i.'</td>

                        

                        

                        

                        ';

            }

            else

            {

                $tr='<tr><td>'.$i.'</td>';

            }

            $bill_value= $row['sup_amt'] * $row['ddl_pro_qty'];

            // $temp=($row['ddl_pro_qty'] * $row->unit_price);

    //$vat=$vat+($temp*$row->vat/100);

    $tmp_disc=($bill_value*$row['disc_amt']/100);

    // $disc=$disc+$tmp_disc;

     $gst=(($bill_value-$tmp_disc)*$row['gst_amt']/100);

        $tr2=$tr2.$tr.  "<td>".$row['prod_name'].", ".$row['product_spec']."</td>".

        "<td style=text-align:right>".$row['ddl_pro_qty']." (".$row['ddl_pro_unit'].")</td>".

        

        "<td style=text-align:right>".number_format($row['sup_amt'],2)."<input type='hidden' class='sup_amt' id='sup_amt_".$i."' value=".number_format($row['sup_amt'],2)." ></td>".

                        "<td style=text-align:right>".number_format($row['disc_amt'],2)."%<input type='hidden' class='disc_amt' id='disc_amt_".$i."' value=".number_format($row['disc_amt'],2)." ><input type='hidden' class='disc_amts' id='disc_amts_".$i."' value=".$tmp_disc." ></td>".

                        "<td style=text-align:right>".number_format($row['gst_amt'],2)."%<input type='hidden' class='gst_amt' id='gst_amt_".$i."' value=".number_format($row['gst_amt'],2)." ><input type='hidden' class='gst_amts' id='gst_amts_".$i."' value=".$gst." ></td>".

                        "<!--<td style='width:10%;'>".date("d-m-Y",strtotime($row['date_time']))."</td>-->".

                        "<td style=text-align:right>".$bill_value."<input type='hidden' class='tots' id='tots_".$i."' value=".$bill_value." ></td>

                        </tr>";

        if($rowcnt==1 or $rowcnt==$j)

            {

                $j=1;

            }

            else{

                $j=$j+1;

            }

        $i++;

}

echo $tr1.$tr2."

</tbody></table>

</div>";

$postatus = false;

$asda =('SELECT s.company_name, s.address,`wo_id`, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, sum(`ddl_pro_qty`) as qty, `product_spec`, `suplier_id`, `sup_amt`, `disc_amt`, sum(`tot`) as tot, work_order1.`active_record`, work_order1.`date_time`, work_order1.`postatus` FROM `work_order1` 

inner join suplier as s on s.sup_id = work_order1.suplier_id

WHERE work_order1.`active_record`=1 and work_order1.po_no ="'.$po.'"  group by work_order1.po_no');

    //echo $asd; exit;

    $dataa = $db->query($asda);

    while($rows = $dataa->fetch(PDO::FETCH_ASSOC))

    {

        echo"<table style='width:100%;' border=0>";

        echo"<tr><td colspan=5 style='border: 1px solid black; text-align:right;'>Unit Total</td><td class='unit_total' style='border: 1px solid black; text-align:right;' ></td></tr>";

        echo"<tr><td colspan=5 style='border: 1px solid black; text-align:right;'>Discount</td><td style='border: 1px solid black; text-align:right;' class='disc'></td></tr>";

        echo"<tr><td colspan=5 style='border: 1px solid black; text-align:right;'>Sub Total</td><td style='border: 1px solid black; text-align:right;' class='sub_total'></td></tr>";

        echo"<tr><td colspan=5 style='border: 1px solid black; text-align:right;'>GST</td><td style='border: 1px solid black; text-align:right;' class='gst'></td></tr>";

        echo"<tr><td colspan=5 style='border: 1px solid black; text-align:right;'>Overall Total</td><td style='border: 1px solid black; text-align:right;' class='grand_total'></td></tr>";

echo "</table>";

echo "<b>Amount in words:</b> <div class='amt_wrd'></div></br>";

$postatus = $rows['postatus'];

}

?>  

<div>

<br>

<table width="100%">

    <tr>

    <td style="text-align:right;"><?php echo $authorised_signature;?></br>

    <?php

    if($postatus && (strtolower($postatus) == 'approved')){

        echo '<img style=text-align:right;width:200px;height:81px src="../assets/sig.png">';

    }else{

        echo "</br>";

    }

    ?>

    </br>

    Authorised Signature</td></tr>

</table>

<?php

echo "<div style='text-align:right;'></div>";

$asdaa =('SELECT `term_cond`,`remarks` FROM `work_order1` 

WHERE work_order1.`active_record`=1 and work_order1.po_no ="'.$po.'"  group by work_order1.po_no');

    //echo $asd; exit;

    $dataaa = $db->query($asdaa);

    while($rowas = $dataaa->fetch(PDO::FETCH_ASSOC))

    {

echo "<hr/>

<b>Terms and Conditions: </b> ".$rowas['term_cond']."

<br/>

<b>Remarks: </b> ".$rowas['remarks'];

    }

?>

</div>

</body>

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>

<script>

    $(document).ready(function() {

        var total = 0;

                $(".tots").each(function (index, element) {

                    total = Number(total) + Number($(element).val());

                });

        $(".unit_total").html(total);

        var discount = 0;

                $(".disc_amts").each(function (index, element) {

                    var this_attr_id = $.trim($(this).attr("id"));

                    var splt_this_id = this_attr_id.split("_");

                    var splt_this_id_ar = splt_this_id[2];

                    var tots = $('#tots_'+splt_this_id_ar).val();

                    var disc_amt = $(element).val();

                     discount = Number(discount) + Number(disc_amt);

                });

                $(".disc").html(discount);

                $(".sub_total").html( Number(total) - Number(discount));

                

                var gst = 0;

                $(".gst_amts").each(function (index, element) {

                    var this_attr_id = $.trim($(this).attr("id"));

                    var splt_this_id = this_attr_id.split("_");

                    var splt_this_id_ar = splt_this_id[2];

                    var tots = $('#tots_'+splt_this_id_ar).val();

                    var gst_amt = $(element).val();

                    gst = Number(gst) + Number(gst_amt);

                });

                $(".gst").html(gst.toFixed(2));

                

                var amt_wrrd = (Number(total) - Number(discount) + Number(gst)).toFixed(2);

                

                $(".grand_total").html(amt_wrrd);

                

                

                

                

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



var pricewords = '';

if(amt_wrrd % 1 != 0){

    let splitNum = amt_wrrd.toString().split('.');

    pricewords = price_in_words(Number(splitNum[0])) + ' and ' + price_in_words(Number(splitNum[1])) + ' paise';

}else{

    pricewords = price_in_words(Number(amt_wrrd).toFixed(0));

}



                $(".amt_wrd").html(pricewords);

        });

    </script>

</html>