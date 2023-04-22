
var i=$('#auto_change.table tr').length;
$(".update").on('click', function() {
	
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
	
	if(document.getElementById('u_PRO').value.length<=0 || document.getElementById('u_AMT_UNIT').value<=0 || document.getElementById('u_QTY').value<=0)
	{
		alert("Enter Product Details.");
		return false;
	}
	var total=0.00;
	try{
		var weight=document.getElementById('u_QTY').value;
		var amt=(document.getElementById('u_AMT_UNIT').value)*weight;
		//var vat=document.getElementById('u_VAT_').value;
		var gst=document.getElementById('u_GST_').value;
		var disc=document.getElementById('u_DISC_').value;
		//total=amt+(amt*vat/100)+(amt*gst/100)-(amt*disc/100);
		total=(amt-(amt*disc/100));
		total=total+(total*gst/100);
	}
	catch(err)
	{
		alert("Error in input! Please check your inputs.");
		return false;
	}
	count=$('#auto_change.table tr').length;
	var data='<tr>';
		data=data+'<td><input class="case" type="checkbox" id="'+i+'"></td>';
		data=data+'<td><span id="snum'+i+'">'+count+'</span></td>';
		data=data+'<td><input class="form-control" id="Product_'+i+'" name="product[]" type="hidden" value=\''+document.getElementById('u_PRO').value+'\'>';
		data=data+'<input class="form-control" id="Product_det_'+i+'" name="product_det[]" type="hidden" value=\''+document.getElementById('u_PRO_DET').value+'\'>';
		data=data+'<b>' + document.getElementById('u_PRO').value + '</b> ' + document.getElementById('u_PRO_DET').value;
		data=data+'</td>';
		data=data+'<td><input class="form-control " id="weight_'+i+'" name="weight[]" type="hidden" value=\''+document.getElementById('u_QTY').value+'\'>';
		data=data+'<input id="units_'+i+'" name="units[]" type="hidden" value=\''+document.getElementById('u_units').value+'\'>';
		data=data+document.getElementById('u_QTY').value+ ' ' + document.getElementById('u_units').value;
		data=data+'</td>';
		data=data+'<td><input class="form-control " id="amt_'+i+'" name="amt[]" type="hidden" value=\''+document.getElementById('u_AMT_UNIT').value+'\'> ';
		data=data+document.getElementById('u_AMT_UNIT').value;
		data=data+'</td>';
		
		data=data+'<td><input class="form-control " id="disc_'+i+'" name="disc[]" type="hidden" value=\''+document.getElementById('u_DISC_').value+'\'>';
		data=data+document.getElementById('u_DISC_').value;
		data=data+'</td>';
		
		//data=data+'<td><input class="form-control " id="vat_'+i+'" name="vat[]" type="hidden" value=\''+document.getElementById('u_VAT_').value+'\'>';
		//data=data+document.getElementById('u_VAT_').value;
		//data=data+'</td>';
		data=data+'<td><input class="form-control " id="gst_'+i+'" name="gst[]" type="hidden" value=\''+document.getElementById('u_GST_').value+'\'> ';
		data=data+document.getElementById('u_GST_').value;
		data=data+'</td>';
		
		data=data+'<td><input class="form-control " id="tot_amt_'+i+'" name="tot_amt[]" type="hidden" value=\''+total+'\' >';
		data=data+total;
		data=data+'</td>';
		data=data+'</tr>';
	
	//alert(data);					  	
	$('#auto_change.table').append(data);
	row = i ;
	i++;
	document.getElementById('u_PRO').value='';
	document.getElementById('u_PRO_DET').value='';
	document.getElementById('u_QTY').value=0;
	document.getElementById('u_AMT_UNIT').value=0;
	//document.getElementById('u_VAT_').value=0;
	document.getElementById('u_GST_').value=0;
	document.getElementById('u_DISC_').value=0;
	//$('#u_PRO').focus();
	total_amt();
	alert("UPDATED");
	
	$('#myModal3').modal('toggle');
		
	
});
$(".edit").on('click', function() {
	var e=$(".case:checked");
	//alert(e.length);
	if(e.length==1)
	{

		var id=e.attr('id');
		//alert(id);
		document.getElementById('u_id').value=id;
		document.getElementById('u_PRO').value=document.getElementById('Product_'+id).value;
		document.getElementById('u_PRO_DET').value=document.getElementById('Product_det_'+id).value;
		document.getElementById('u_QTY').value=document.getElementById('weight_'+id).value;
		document.getElementById('u_units').value=document.getElementById('units_'+id).value;
		document.getElementById('u_AMT_UNIT').value=document.getElementById('amt_'+id).value;
		//document.getElementById('u_VAT_').value=document.getElementById('vat_'+id).value;
		document.getElementById('u_GST_').value=document.getElementById('gst_'+id).value;
		document.getElementById('u_DISC_').value=document.getElementById('disc_'+id).value;
		
	
		$('#u_PRO').focus();
		
		$('#myModal3').modal();
		//alert("asdfas");
	}
	else{
		alert("Select One PO for editing."); return false;
		//location.reload();
	}
	
	
});
	      
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
	//alert("deleted");
	total_amt();
});


$(".addmore").on('click',function(){
	if(document.getElementById('PRO').value.length<=0 || document.getElementById('AMT_UNIT').value<=0 || document.getElementById('QTY').value<=0)
	{
		alert("Enter Product Details.");
		return false;
	}
	var total=0.00;
	try{
		var weight=document.getElementById('QTY').value;
		var amt=(document.getElementById('AMT_UNIT').value)*weight;
		//var vat=document.getElementById('VAT_').value;
		var gst=document.getElementById('GST_').value;
		var disc=document.getElementById('DISC_').value;
		//total=amt+(amt*vat/100)+(amt*gst/100)-(amt*disc/100);
		total=(amt-(amt*disc/100));
		total=total+(total*gst/100);
	}
	catch(err)
	{
		alert("Error in input! Please check your inputs.");
		return false;
	}
	count=$('#auto_change.table tr').length;
	var data='<tr>';
		data=data+'<td><input class="case" type="checkbox" id="'+i+'"></td>';
		data=data+'<td><span id="snum'+i+'">'+count+'</span></td>';
		data=data+'<td><input class="form-control" id="Product_'+i+'" name="product[]" type="hidden" value=\''+document.getElementById('PRO').value+'\'>';
		data=data+'<input class="form-control" id="Product_ty_'+i+'" name="product_ty[]" type="hidden" value=\''+document.getElementById('PRO_TY').value+'\'>';
		data=data+'<input class="form-control" id="Product_det_'+i+'" name="product_det[]" type="hidden" value=\''+document.getElementById('PRO_DETS').value+'\'>';
		data=data+'<b>' + document.getElementById('PRO').value + '</b> ' + document.getElementById('PRO_DETS').value;
		data=data+'</td>';
		data=data+'<td><input class="form-control " id="weight_'+i+'" name="weight[]" type="hidden" value=\''+document.getElementById('QTY').value+'\'>';
		data=data+'<input id="units_'+i+'" name="units[]" type="hidden" value=\''+document.getElementById('q_units').value+'\'>';
		data=data+document.getElementById('QTY').value + ' ' +document.getElementById('q_units').value;
		data=data+'</td>';
		data=data+'<td><input class="form-control " id="amt_'+i+'" name="amt[]" type="hidden" value=\''+document.getElementById('AMT_UNIT').value+'\'> ';
		data=data+document.getElementById('AMT_UNIT').value;
		data=data+'</td>';
		
		data=data+'<td><input class="form-control " id="disc_'+i+'" name="disc[]" type="hidden" value=\''+document.getElementById('DISC_').value+'\'>';
		data=data+document.getElementById('DISC_').value;
		data=data+'</td>';
		
		//data=data+'<td><input class="form-control " id="vat_'+i+'" name="vat[]" type="hidden" value=\''+document.getElementById('VAT_').value+'\'>';
		//data=data+document.getElementById('VAT_').value;
		//data=data+'</td>';
		data=data+'<td><input class="form-control " id="gst_'+i+'" name="gst[]" type="hidden" value=\''+document.getElementById('GST_').value+'\'> ';
		data=data+document.getElementById('GST_').value;
		data=data+'</td>';
		
		data=data+'<td><input class="form-control " id="tot_amt_'+i+'" name="tot_amt[]" type="hidden" value=\''+total+'\' >';
		data=data+total;
		data=data+'</td>';
		data=data+'</tr>';
	
	//alert(data);					  	
	$('#auto_change.table').append(data);
	row = i ;
	i++;
	document.getElementById('PRO').value='';
	document.getElementById('PRO_TY').value='';
	document.getElementById('PRO_DETS').value='';
	document.getElementById('QTY').value=0;
	document.getElementById('AMT_UNIT').value=0;
	//document.getElementById('VAT_').value=0;
	document.getElementById('GST_').value=0;
	document.getElementById('DISC_').value=0;
	$('#PRO').focus();
	total_amt();
});

function call_click(eve)
{
	//	alert("Call");
		var ee=eve.keyCode || eve.which;
		if(ee==9)
		{
			$('#addmore').click();
			$('#snum'+(i-1)).focus();
		}
		
}		
function select_all() {
	$('input[class=case]:checkbox').each(function(){ 
		if($('input[class=check_all]:checkbox:checked').length == 0){ 
			$(this).prop("checked", false); 
		} else {
			$(this).prop("checked", true); 
		} 
	});
}

function check(){
	obj=$('#auto_change.table tr').find('span');
	$.each( obj, function( key, value ) {
		id=value.id;
		$('#'+id).html(key+1);
	});
}
/* function total(ele,eve)
{
	var ee=eve.keyCode || eve.which;
	//alert(ee);
	if(($.inArray(ee,[8,9,127,27,37,39,46,48,49,50,51,52,53,54,55,56,57])<0))
	{
			eve.preventDefault();
			return false;
	}
	
	var ele_id=ele.id;
	id=ele_id.split("_")[1];
	
	var weight=document.getElementById('weight_'+id).value;
	var amt=(document.getElementById('amt_'+id).value)*weight;
	
	//var vat=document.getElementById('vat_'+id).value;
	var gst=document.getElementById('gst_'+id).value;
	var disc=document.getElementById('disc_'+id).value;
	
	//var total=amt+(amt*vat/100)+(amt*gst/100)-(amt*disc/100);
	
	var total=amt-(amt*disc/100);
	total=total+(total*gst/100);
	
	//var tot_id='tot_'+ele_id;
	
	document.getElementById('tot_amt_'+id).value=total;//document.getElementById(ele_id).value*document.getElementById(weight).value;
	total_amt();
} */
function chk_number(eve)
{
	var ee=eve.keyCode || eve.which;

	if(($.inArray(ee,[8,9,127,27,37,39,46,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,190,110])<0))
	{
			eve.preventDefault();
			//alert(ee);
			alert("Enter Only Numbers!");
			return false;
	}
	
}
function total_amt()
{
	//alert("in");
	var arr=document.getElementsByName('tot_amt[]');
	var length=arr.length;
	//alert(length);
	
	var sum=0.00;
	var gst=0.00;
	//var vat=0.00;
	var disc=0.00;
	var act_sum=0.00;
	var disc_sum=0.00;
	
	for(var i=0;i<length;i++)
	{
		var ele_id=arr[i].getAttribute('id');
		id=ele_id.split("_")[2];
		//alert(id);
		var weight=document.getElementById('weight_'+id).value;
		var amt=(document.getElementById('amt_'+id).value)*weight;
		act_sum=act_sum+amt; //parseFloat(document.getElementById('amt_'+i).value);
		//gst=gst+(amt * document.getElementById('gst_'+id).value /100);
		//vat=vat+(amt * document.getElementById('vat_'+id).value /100);

		disc=(amt * document.getElementById('disc_'+id).value /100);
		//alert(disc);
		disc_sum=disc_sum+disc;
		gst=gst+((amt-disc) * document.getElementById('gst_'+id).value /100);
		//alert(gst);
		
		//sum=sum+parseFloat(arr[i-1].value);
	}
	var sub_tot=act_sum-disc_sum;
	var sub_tot_1=sub_tot+gst;
	document.getElementById("overall_total").value=sub_tot_1;
	document.getElementById("tot_sum").innerHTML="<table><tr><td>Total</td><td style='text-align:right;'>"+act_sum+"</td></tr><tr><td>Discount</td><td style='text-align:right;'>"+disc_sum+"</td></tr><tr><td>Total After Discount</td><td style='text-align:right;'>"+sub_tot+"</td></tr><tr><td>GST</td><td style='text-align:right;'>"+gst+"</td></tr><tr><td>Total With GST</td><td style='text-align:right;'>"+sub_tot_1+"</td></tr></table>";
}
//Below is for updating CSV Files
$(".csv").on('click',function(){
	
	//=============================//
	// Get file data of the form//
	if($("#upload")[0].files.length<=0)
	{
		alert("File Not Selected!");
		return false;
	}
	var fd=new FormData();
	fd.append("files",$("#upload")[0].files[0]);
	//ajax to upload file //
	$.ajax({
		url:'ajax/fil.php',
		type:'POST',
		data: fd,
		async:false,
		cache:false,
		contentType:false,
		processData: false,
		success: function(rd)
		{
			
			var Data=JSON.parse(rd);
			var len=JSON.parse(rd).length;
			var u="";
			for(var fil_row=0;fil_row<len;fil_row++)
			{
				var row=Data[fil_row].split("|");
				
				//local update//
				
				var total=0.00;
				try{
					if(isNaN(row[2]) || isNaN(row[2]) || isNaN(row[2]) || isNaN(row[2]))
					{
						alert("Error in the input file format");
						return false;
					}
					var weight=parseFloat(row[2]);
					//alert(weight);
					var amt=parseFloat(row[4])*weight;
					//alert(amt);
					var gst=parseInt(row[6]);
					var disc=parseInt(row[5]);
					total=(amt-(amt*disc/100));
					total=total+(total*gst/100);
					//alert(total);
				}
				catch(err)
				{
					alert(err);
					//alert("Error in input! Please check your inputs.");
					return false;
				}
				count=$('#auto_change.table tr').length;
				var data='<tr>';
					data=data+'<td><input class="case" type="checkbox" id="'+i+'"></td>';
					data=data+'<td><span id="snum'+i+'">'+count+'</span></td>';
					data=data+'<td><input class="form-control" id="Product_'+i+'" name="product[]" type="hidden" value=\''+row[0]+'\'>';
					data=data+'<input class="form-control" id="Product_det_'+i+'" name="product_det[]" type="hidden" value=\''+row[1]+'\'>';
					data=data+'<b>' + row[0] + '</b> ' + row[1];
					data=data+'</td>';
					data=data+'<td><input class="form-control " id="weight_'+i+'" name="weight[]" type="hidden" value=\''+row[2]+'\'>';
					data=data+'<input id="units_'+i+'" name="units[]" type="hidden" value=\''+row[3]+'\'>';
					data=data+row[2] + ' ' +row[3];
					data=data+'</td>';
					data=data+'<td><input class="form-control " id="amt_'+i+'" name="amt[]" type="hidden" value=\''+row[4]+'\'> ';
					data=data+row[4];
					data=data+'</td>';
					
					data=data+'<td><input class="form-control " id="disc_'+i+'" name="disc[]" type="hidden" value=\''+row[5]+'\'>';
					data=data+row[5];
					data=data+'</td>';

					data=data+'<td><input class="form-control " id="gst_'+i+'" name="gst[]" type="hidden" value=\''+row[6]+'\'> ';
					data=data+row[6];
					data=data+'</td>';
					
					data=data+'<td><input class="form-control " id="tot_amt_'+i+'" name="tot_amt[]" type="hidden" value=\''+total+'\' >';
					data=data+total;
					data=data+'</td>';
					data=data+'</tr>';
				
				//alert(data);					  	
				$('#auto_change.table').append(data);
				row = i ;
				i++;
			
				
				//u=u+"<tr><td>"+row[0]+"</td><td>"+row[1]+"</td><td>"+row[2]+"</td><td>"+row[3]+"</td><td>"+row[4]+"</td><td>"+row[5]+"</td><td>"+row[6]+"</td></tr>";
				
			}
			total_amt();
			//$("#u").html(u);
		}
		
	});
	
	//=============================//
	
});