
var tr_i=$('#auto_change.table tr').length;
var id_=document.getElementById( 'auto_change' ).getElementsByTagName( 'tr' )[tr_i-1].getElementsByTagName( 'td' )[0].getElementsByTagName( 'input' )[0].id;
var i=parseFloat(id_)+parseFloat(1);
//alert(i);
//var i=$('#auto_change.table tr').length;
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
		total=(amt-(amt*disc/100));
		total=total+(total*gst/100);
		//total=amt+(amt*vat/100)+(amt*gst/100)-(amt*disc/100);
	}
	catch(err)
	{
		alert("Error in input! Please check your inputs.");
		return false;
	}
	count=$('#auto_change.table tr').length;
	var old_i=i; // inorder to maintain i value if new item is added.
	
		if(document.getElementById('old_new').value=='new')
		{
			// i=i
		}
		else
		{
			i=document.getElementById('old_new').value;
		}
		
		var data='<tr>';
		data=data+'<td><input class="case" type="checkbox" id="'+i+'"></td>';
		data=data+'<td><span id="snum'+i+'">'+count+'</span></td>';
		data=data+'<td>';
		if(document.getElementById('old_new').value=='new')
		{
			data=data+'<input type="hidden" id="pid_'+i+'" name="pid[]" value="new">';
		}
		else
		{
			data=data+'<input type="hidden" id="pid_'+i+'" name="pid[]" value="'+i+'">';
		}
		data=data+'<input type="hidden" id="status_'+i+'" name="status[]" value="0">';
		data=data+'<input class="form-control" id="Product_'+i+'" name="product[]" type="hidden" value=\''+document.getElementById('u_PRO').value+'\'>';
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
	i=old_i;
	row = i ;
	//i++;
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
	if(e.length==1)
	{
		var id=e.attr('id');
		
		if(document.getElementById('pid_'+id).value=='new')
		{
			document.getElementById('old_new').value='new';
		}
		else
		{
			document.getElementById('old_new').value=id;
		}
		//alert(id);
		document.getElementById('u_id').value=id;
		document.getElementById('u_PRO').value=document.getElementById('Product_'+id).value;
		document.getElementById('u_PRO_DET').value=document.getElementById('Product_det_'+id).value;
		document.getElementById('u_QTY').value=document.getElementById('weight_'+id).value;
		document.getElementById('u_units').value=document.getElementById('units_'+id).value;
		document.getElementById('u_AMT_UNIT').value=document.getElementById('amt_'+id).value;
		document.getElementById('u_GST_').value=(document.getElementById('gst_'+id).value);
		document.getElementById('u_DISC_').value=(document.getElementById('disc_'+id).value);
		
		
	
		$('#u_PRO').focus();
		
		$('#myModal3').modal();
		
	}
	else{
		alert("Select only One PO for editing.");
	}
	
	
});
	      
$(".delete").on('click', function() {
	// .attr is JSON so convert element to JSON using $()
	var e=$(".case:checked");
	for(var i=0;i<e.length;i++)
		{
			id=$(e[i]).attr('id');
			document.getElementById('status_'+id).value=100;
			document.getElementById('weight_'+id).value=0;
			document.getElementById('amt_'+id).value=0;
			document.getElementById('gst_'+id).value=0;
			document.getElementById('disc_'+id).value=0;
			$('.case:checkbox:checked').parents("tr").css('display','none');
		}
	check();
	alert("deleted");
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
	//alert(i);
		data=data+'<td><input class="case" type="checkbox" id="'+i+'"></td>';
		data=data+'<td><span id="snum'+i+'">'+count+'</span></td>';
		data=data+'<td><input type="hidden" id="pid_'+i+'" name="pid[]" value="new"><input class="form-control" id="Product_'+i+'" name="product[]" type="hidden" value=\''+document.getElementById('PRO').value+'\'>';
		data=data+'<input class="form-control" id="Product_det_'+i+'" name="product_det[]" type="hidden" value=\''+document.getElementById('PRO_DET').value+'\'>';
		data=data+'<b>' + document.getElementById('PRO').value + '</b> ' + document.getElementById('PRO_DET').value;
		data=data+'</td>';
		data=data+'<td><input class="form-control " id="weight_'+i+'" name="weight[]" type="hidden" value=\''+document.getElementById('QTY').value+'\'>';
		data=data+'<input id="units_'+i+'" name="units[]" type="hidden" value=\''+document.getElementById('q_units').value+'\'>';
		data=data+document.getElementById('QTY').value+ ' ' +document.getElementById('q_units').value;
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
	document.getElementById('PRO_DET').value='';
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
	var sl=1;
	$.each( obj, function( key, value ) {
		
		id=value.id;
		if($('#'+id).parents("tr").css("display")!="none")
		{
			$('#'+id).html(sl);
			sl++;
		}
		
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
	
	for(var k=0;k<length;k++)
	{
		var ele_id=arr[k].getAttribute('id');
		id=ele_id.split("_")[2];
	//	alert(id);
		var weight=document.getElementById('weight_'+id).value;
		var amt=(document.getElementById('amt_'+id).value)*weight;
		act_sum=act_sum+amt; //parseFloat(document.getElementById('amt_'+i).value);
	//	alert(amt);
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