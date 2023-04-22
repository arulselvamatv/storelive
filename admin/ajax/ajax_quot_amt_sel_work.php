<?php



require_once("../database/connect.php");

$db=new Database;

$con=$db->connect();



$wo_no=$_GET['wo_no'];

$quo_no=$_GET['quo_no'];

$HTML="";

	if($con)

	{

		echo '

		<thead>

		<tr>

		<td colspan="8">

		<h4><strong>Quotaion NO:</strong>'.$quo_no.'      <strong> WorkOrder NO:</strong>'.$wo_no.'</h4>

		</td>

		</tr>

		<tr>

		  <th class="text-center">No</th>

		  <th class="text-center">Product Name</th>

		  <th class="text-center">Quantity</th>

		  <th class="text-center">Specification needed</th>';

		  

				$asd =('SELECT s.company_name,s.name, qsa.`suplier_id` FROM `quot_sup_amt_sel` as qsa

                inner join suplier as s on s.sup_id= qsa.suplier_id

                WHERE `wo_no`="'.$wo_no.'" and qsa.active_record =1 group by suplier_id');

				//echo $asd; exit;

				$datd = $db->query($asd);

				while($data=$datd->fetch(PDO::FETCH_ASSOC))

					{

						echo "<th class='text-center'>".''.$data['company_name']."<input type='hidden' name='sup_name[]' id='sup_name_".$i."' value='".$data['suplier_id']."' /></th>";

					}



					echo '<th class="text-center">Edit</th></tr>

	  </thead>

	  <tbody id="tbody">';


		$asd =('SELECT `qas_id`, `wo_no`, `suplier_id`, `quo_no`,`bill_type`, `prod_name`, `ddl_pro_qty`, `ddl_pro_unit`, `product_spec`, `suplier_amt`, `disc_amt`, `gst_amt`, `tot`, `check_no`, `date_time`, `po_status`, `active_record` FROM `quot_sup_amt_sel` WHERE `wo_no`="'.$wo_no.'" and active_record=1 group by prod_name');

		//echo $asd; exit;

		$i=0;

		$prdt_data = $db->query($asd);

		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))

		{

			$product_name =$prd['prod_name'];

			$check_no =$prd['check_no'];

			$i = ++$i;

			echo '<tr>'.

			'<th>'.$i.'<input type="hidden" class="form-control" name="bill_type[]" id="bill_type'.$i.'" value="'.$prd['bill_type'].'" readonly="readonly" />.</th>'.

			'<th>'.

			'<input type="hidden" class="form-control" name="quo_no[]" id="quo_no'.$i.'" value="'.$prd['quo_no'].'" readonly="readonly" />'.

			'<input type="hidden" class="form-control" name="wo_no[]" id="wo_no'.$i.'" value="'.$prd['wo_no'].'" readonly="readonly" />'.

			'<input class="form-control" name="prod_name[]" id='.$i.' value="'.$prd['prod_name'].'" readonly="readonly" />'.

			'</th>'.

			'<th>'.

			'<input class="form-control" name="ddl_pro_unt[]" id="iunt_'.$i.'" value="Per '.$prd['ddl_pro_unit'].'" readonly="readonly" />

            <input type="hidden"class="form-control" name="ddl_pro_unit[]" id="iunit_'.$i.'" value="'.$prd['ddl_pro_unit'].'" readonly="readonly" />

            <input type="number" class="form-control" name="ddl_pro_qty[]" id="iqty_'.$i.'" value="'.$prd['ddl_pro_qty'].'" readonly="readonly" /></th>'.

			'<th><input class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value="'.$prd['product_spec'].'" readonly="readonly" />'.

			'</th>';

            echo '<th>';

			

            

            echo '<input type="hidden" name="sup_id[]" id="sup_id_'.$i.'" value="'.$prd['suplier_id'].'" readonly="readonly" />

            Supplier Amount:<input class="form-control sup_amts" name="sup_amt[]" id="sup_amt_'.$i.'" value="'.$prd['suplier_amt'].'" readonly="readonly" />

               

               <label>Discount:</label>

               <div style="display:inline-flex">

                <div style="display:inline-block"><input class="form-control disc_amt discount_change" name="disc_amt_entry[]" id="disc_amt_entry'.$i.'" data-key="'.$i.'" value="'.$prd['disc_amt'].'"  readonly="readonly"/></div>

                <div style="display:inline-block">

                     <select class="form-control select discount_change" id="discamt'.$i.'" name="discamt" data-key="'.$i.'">

                        <option selected value="percentage">%</option>

                        <option value="rupees">Rs</option>

                   </select>

                </div>

            </div>

            

            

            </br>

			Discount :<input class="form-control disc_amt" name="disc_amt[]" id="disc_amt_'.$i.'" value="'.$prd['disc_amt'].'" readonly="readonly" /></br>

			GST %:<input class="form-control gst_amt" name="gst_amt[]" id="gst_amt_'.$i.'" value="'.$prd['gst_amt'].'" readonly="readonly" />

			Total:';

            $bill_value= $prd['suplier_amt'] * $prd['ddl_pro_qty'];

			$tmp_disc=($bill_value*$prd['disc_amt']/100);

			$gst=(($bill_value-$tmp_disc)*$prd['gst_amt']/100);

			$total_value=$bill_value-$tmp_disc+$gst;



            echo '<input  name="tot_val[]" id="tot_val_'.$i.'" class="form-control" value="'.round($total_value,2).'" readonly="readonly"/><input type="hidden" name="tot[]" id="tot_'.$i.'" class="form-control" value="'.$prd['tot'].'" readonly="readonly"/>';

               

            echo '</th>';

            echo '<th><input type="button" class="btn btn-primary edits" name="edit-button[]" id="edit-button_'.$i.'" value="Edit" />

			<input type="button" class="btn btn-primary done" name="end-editing[]" id="end-editing_'.$i.'" value="Done" style="visibility:hidden" /></th>';

			echo '</tr>';

		}


        echo "
        <tr>
            <th>";
            
             $asda =('select sum(a.adv_dublicate) as total_balances,suplier_id from (SELECT adv_dublicate as adv_dublicate,suplier_id FROM `work_order1` WHERE `suplier_id`="'.$suplier_id.'" group by dep_no,suplier_id) a');
				
				//echo $asda; exit;
				$datda = $db->query($asda);
				
				
				$dataa=$datda->fetch(PDO::FETCH_ASSOC);
				$total_balances = $dataa['total_balances'];
				
				//echo $total_balances;
					
          if($total_balances == 0)
          {
             echo "Advance Amount Pending In Supplier:<input class='form-control' type='number' id='adv_pending' name='adv_pending' value='0' required  readonly='readonly'/>";
          }
          else
          {
             echo "Advance Amount Pending In Supplier:<input class='form-control' type='number' id='adv_pending' name='adv_pending' value= $total_balances required readonly='readonly'/>";
          }
			
            echo "</th>
            
            
             <th>
                Request Amount For Advance:<input class='form-control' type='number' id='adv' name='adv' value='0' required/>
            </th>
            
           
        </tr>
      

        <tr>

        <th>

        Transport Charge:<input class='form-control' type='number' id='tran_charge' name='tran_charge' value=0 required/>

        </th>

        <th>

        Transport GST Percent:<input class='form-control' type='number' id='tran_charge_per' name='tran_charge_per' value=0 required/>

        </th>

        <th>

        Transport GST Charge:<input class='form-control' type='number' id='tran_charge_gst' name='tran_charge_gst' value=0 readonly='readonly'/>

        </th>

        </tr>

        <tr>

        <th>

        Service Charge:<input class='form-control' type='number' id='ser_charge' name='ser_charge' value=0 required/>

        </th>

        <th>

        Service GST Percent:<input class='form-control' type='number' id='ser_charge_per' name='ser_charge_per' value=0 required/>

        </th>

        <th>

        Service GST Charge:<input class='form-control' type='number' id='ser_charge_gst' name='ser_charge_gst' value=0 readonly='readonly'/>

        </th>

        </tr>

        <tr><th>

      

        Select PO_ID:<select class='form-control select' id='dept' name='dept' >";

        $asda =('SELECT `d_id`, `d_name`, `date_time`, `active_record` FROM `department` WHERE `active_record`=1');

				//echo $asd; exit;

				$datda = $db->query($asda);

				while($dataa=$datda->fetch(PDO::FETCH_ASSOC))

					{

                        echo"<option value=".$dataa['d_name'].">".$dataa['d_name']."</option>";

                    }

        echo"</select>

        </th><th>

      

        Terms and Conditions:<span style='color:#ff0000'>*</span> <input class='form-control' type='text' id='term_cond' name='term_cond' /></div>

        </th>

        <th>

        Remarks:<span style='color:#ff0000'>*</span><input class='form-control' type='text' id='remarks' name='remarks'/>

        

        </th>

        </tr>



        <tr><th>

        <div class='col-sm-12'>

                                                    

        <center>";

        $asdf =('SELECT count(`po_no`) as couns FROM `work_order` WHERE wo_no="'.$wo_no.'"');						

							$prdt_dataa = $db->query($asdf);

							$prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC);

							$couns = $prda['couns'];

      if($couns>0){}

      else{

         echo "<input class='btn btn-success' type='submit' value='Create PO'>&nbsp;";  

      }

       

        

        echo"</center>

        

        </div>

        </th>

        <th>

        <div class='col-sm-12'>

                                                    

        <center>

      

        <input class='btn btn-danger'  type='button' value='Cancel' onClick='window.location.reload();'>

        

        </center>

        

        </div>

        

        </th>

        </tr>";

		echo '</tbody>';

        

		

	}

    



	

	    

?>

<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>





<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />

<script src="../assets/global/plugins/select2/js/select2.min.js"></script>

<script>

    $( document ).ready(function() {

            $( '.chk' ).each(function( index ) {



                var this_attr_id = $.trim($(this).attr("id"));

                var splt_this_id = this_attr_id.split("_");

                var splt_this_id_ar = splt_this_id[1];

                if ($('#iqty_'+splt_this_id_ar).val()<=0) {

                    //prevent the default form submit if it is not checked

                    alert("Plz select atleast one quantity to submit");

                    e.preventDefault();

                    }

           

        });

        //ON keyup tran_charge

    $(document).on('keyup', '#tran_charge', function( e ) {

        // alert("asdas"); exit;

                var price = $('#tran_charge').val();

                

                var gst = $('#tran_charge_per').val();

                var tax = (price / 100) * gst;

                // var gst_amount = ( price * gst% ) / 100;

                var net_price = Number(price) + Number(tax);

                

                $('#tran_charge_gst').val(net_price);

                });

                //ON keyup tran_charge_per

    $(document).on('keyup', '#tran_charge_per', function( e ) {

        // alert("asdas"); exit;

                var price = $('#tran_charge').val();

                

                var gst = $('#tran_charge_per').val();

                var tax = (price / 100) * gst;

                // var gst_amount = ( price * gst% ) / 100;

                var net_price = Number(price) + Number(tax);

                

                $('#tran_charge_gst').val(net_price);

                });

                //ON keyup ser_charge

    $(document).on('keyup', '#ser_charge', function( e ) {

        // alert("asdas"); exit;

                var price = $('#ser_charge').val();

                

                var gst = $('#ser_charge_per').val();

                var tax = (price / 100) * gst;

                // var gst_amount = ( price * gst% ) / 100;

                var net_price = Number(price) + Number(tax);

                

                $('#ser_charge_gst').val(net_price);

                });

                //ON keyup serv_charge_per

    $(document).on('keyup', '#ser_charge_per', function( e ) {

        // alert("asdas"); exit;

                var price = $('#ser_charge').val();

                

                var gst = $('#ser_charge_per').val();

                var tax = (price / 100) * gst;

                // var gst_amount = ( price * gst% ) / 100;

                var net_price = Number(price) + Number(tax);

                

                $('#ser_charge_gst').val(net_price);

                });

    // ON keyup disc_amt

    $(document).on('keyup', '.disc_amt', function( e ) {

        var this_attr_id = $.trim($(this).attr("id"));

        var splt_this_id = this_attr_id.split("_");

        var splt_this_id_ar = splt_this_id[2];

        // var discamt = $('#discamt_'+splt_this_id_ar).val();

        var disc = $('#disc_amt_'+splt_this_id_ar).val();

        var price = $('#sup_amt_'+splt_this_id_ar).val();

        var prices = $('#sup_amt_'+splt_this_id_ar).val()*$('#iqty_'+splt_this_id_ar).val();

                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10

                //alert(dec);

                var mult = price * dec;

                var mults = prices * dec; // gives the value for subtract from main value

                var discount = price - mult;

                var discounts = prices - mults;

                

                var gst = $('#gst_amt_'+splt_this_id_ar).val();

                var tot_price = Number(discount * gst / 100) + Number(discount);

                var tot_prices = Number(discounts * gst / 100) + Number(discounts);

                // alert(disc); exit;

                

                $('#tot_'+splt_this_id_ar).val(tot_price);

                $('#tot_val_'+splt_this_id_ar).val(tot_prices);

                });

                // ON keyup disc_amt END

                // ON keyup gst_amt

                

                $(document).on('keyup', '.gst_amt', function( e ) {

                var this_attr_id = $.trim($(this).attr("id"));

                var splt_this_id = this_attr_id.split("_");

                var splt_this_id_ar = splt_this_id[2];



                var disc = $('#disc_amt_'+splt_this_id_ar).val();

                var price = $('#sup_amt_'+splt_this_id_ar).val();

                var prices = $('#sup_amt_'+splt_this_id_ar).val()*$('#iqty_'+splt_this_id_ar).val();

                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10

                //alert(dec);

                var mult = price * dec;

                var mults = prices * dec; // gives the value for subtract from main value

                var discount = price - mult;

                var discounts = prices - mults;

                

                var gst = $('#gst_amt_'+splt_this_id_ar).val();

                var tot_price = Number(discount * gst / 100) + Number(discount);

                var tot_prices = Number(discounts * gst / 100) + Number(discounts);

                // alert(disc); exit;

                

                $('#tot_'+splt_this_id_ar).val(tot_price);

                $('#tot_val_'+splt_this_id_ar).val(tot_prices);

                });

                // ON keyup gst_amt END

                // ON keyup supplier_amt

                $(document).on('keyup', '.sup_amts', function( e ) {

                   

                var this_attr_id = $.trim($(this).attr("id"));

                var splt_this_id = this_attr_id.split("_");

                var splt_this_id_ar = splt_this_id[2];



                var disc = $('#disc_amt_'+splt_this_id_ar).val();

                var price = $('#sup_amt_'+splt_this_id_ar).val();

                var prices = $('#sup_amt_'+splt_this_id_ar).val()*$('#iqty_'+splt_this_id_ar).val();

                var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10

                //alert(dec);

                var mult = price * dec;

                var mults = prices * dec; // gives the value for subtract from main value

                var discount = price - mult;

                var discounts = prices - mults;

                

                var gst = $('#gst_amt_'+splt_this_id_ar).val();

                var tot_price = Number(discount * gst / 100) + Number(discount);

                var tot_prices = Number(discounts * gst / 100) + Number(discounts);

                // alert(disc); exit;

                

                $('#tot_'+splt_this_id_ar).val(tot_price);

                $('#tot_val_'+splt_this_id_ar).val(tot_prices);

                });

	});

</script>

<script>

	jQuery(function ($) {

    //form submit handler

    $('#store_list').submit(function (e) {

        //check atleat 1 checkbox is checked

        if (!$('.chk').is(':checked')) {

            //prevent the default form submit if it is not checked

            alert("Plz select The Supplier Amouunt")

            e.preventDefault();

        }

       

       

    })

})

	</script>

    <script>

        $(document).on('click', '.edits', function( e ) {

                //var this_val = $.trim($("#quo_no").val());

                var this_attr_id = $.trim($(this).attr("id"));

                var splt_this_id = this_attr_id.split("_");

                var splt_this_id_ar = splt_this_id[1];

                //alert(splt_this_id_ar); exit;

                $('#iqty_'+splt_this_id_ar).attr("readonly", false); 

                $('#sup_amt_'+splt_this_id_ar).attr("readonly", false); 

                $('#gst_amt_'+splt_this_id_ar).attr("readonly", false); 

                $('#disc_amt_'+splt_this_id_ar).attr("readonly", false); 

                $('#disc_amt_entry'+splt_this_id_ar).attr("readonly", false);

                $('#editing_'+splt_this_id_ar).toggle();

                document.getElementById("end-editing_"+splt_this_id_ar).style.visibility = 'visible';

                document.getElementById("edit-button_"+splt_this_id_ar).style.visibility = 'hidden';





                });



                $(document).on('change keyup', '.discount_change', function( e ) {

                    var discount_percent = 0;

                    var keyindex = $(this).data('key');

                    var disc_amt_entry = $('#disc_amt_entry'+keyindex).val();

                    var discamt = $('#discamt'+keyindex).val();

                    if(discamt == 'rupees'){

                        var sup_amt = $('#sup_amt_'+keyindex).val();

                        discount_percent = (100 * ((sup_amt - (sup_amt - disc_amt_entry)) / sup_amt)).toFixed(3);

                        if (Math.sign(discount_percent) === -1 || disc_amt_entry=='') discount_percent = 0;

                    }else{

                        discount_percent = disc_amt_entry;

                    }

                    $('#disc_amt_'+keyindex).val(discount_percent);

                    

                })

                

                

                $(document).on('click', '.done', function( e ) {

                //var this_val = $.trim($("#quo_no").val());

                var this_attr_id = $.trim($(this).attr("id"));

                var splt_this_id = this_attr_id.split("_");

                var splt_this_id_ar = splt_this_id[1];

                $('#iqty_'+splt_this_id_ar).attr("readonly", true); 

                $('#sup_amt_'+splt_this_id_ar).attr("readonly", true); 

                $('#disc_amt_entry'+splt_this_id_ar).attr("readonly", true);

                $('#gst_amt_'+splt_this_id_ar).attr("readonly", true); 

                $('#disc_amt_'+splt_this_id_ar).attr("readonly", true); 

                document.getElementById("end-editing_"+splt_this_id_ar).style.visibility = 'hidden';

                document.getElementById("edit-button_"+splt_this_id_ar).style.visibility = 'visible';



                });



                

        </script>