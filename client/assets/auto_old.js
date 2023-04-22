
	      
 $(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
	//alert("deleted");
	total_amt();
});
var i=$('#auto_change.table tr').length;

$(".addmore").on('click',function(){
	count=$('#auto_change.table tr').length;
	
	var data='<tr>';
		data=data+'<td><input class="case" type="checkbox"></td>';
		data=data+'<td><span id="snum'+i+'">'+count+'</span></td>';
		data=data+'<td><input list="pro_det" class="form-control" id="Product_'+i+'" name="product[]" style="width:100%; min-width:100px;"><datalist id="pro_det"><option value ="Bleaching">Bleaching</option><option value="Colouring">Colouring</option><option value="Raw">Raw</option></datalist></td>';
		data=data+'<td><input class="form-control " id="weight_'+i+'" name="weight[]" type="text" style="min-width:100px;" onkeypress="chk_number(event);"></td>';
		data=data+'<td><input class="form-control " id="amt_'+i+'" name="amt[]" type="text" style="min-width:50px;" onkeypress="total(this,event);" value=0> </td>';
		data=data+'<td><input class="form-control " id="vat_'+i+'" name="vat[]" type="text" style="min-width:50px;" onkeypress="total(this,event);" value=0> </td>';
		data=data+'<td><input class="form-control " id="gst_'+i+'" name="gst[]" type="text" style="min-width:50px;" onkeypress="total(this,event);" value=0> </td>';
		data=data+'<td><input class="form-control " id="disc_'+i+'" name="disc[]" type="text" style="min-width:50px;" onkeypress="total(this,event);" value=0> </td>';
		data=data+'<td><input class="form-control " id="tot_amt_'+i+'" name="tot_amt[]" type="text" style="min-width:50px;" onkeypress="call_click(event);" value=0 ></td>';
		data=data+'</tr>';
	
						  	
	$('#auto_change.table').append(data);
	row = i ;
	i++;
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
function total(ele,eve)
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
	
	var vat=document.getElementById('vat_'+id).value;
	var gst=document.getElementById('gst_'+id).value;
	var disc=document.getElementById('disc_'+id).value;
	var total=amt+(amt*vat/100)+(amt*gst/100)-(amt*disc/100);
	
	//var tot_id='tot_'+ele_id;
	
	document.getElementById('tot_amt_'+id).value=total;//document.getElementById(ele_id).value*document.getElementById(weight).value;
	total_amt();
}
function chk_number(eve)
{
	var ee=eve.keyCode || eve.which;

	if(($.inArray(ee,[8,9,127,27,37,39,46,48,49,50,51,52,53,54,55,56,57])<0))
	{
			eve.preventDefault();
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
	var vat=0.00;
	var disc=0.00;
	var act_sum=0.00;
	for(var i=1;i<=length;i++)
	{
		var weight=document.getElementById('weight_'+i).value;
		var amt=(document.getElementById('amt_'+i).value)*weight;
		act_sum=act_sum+amt; //parseFloat(document.getElementById('amt_'+i).value);
		gst=gst+(amt * document.getElementById('gst_'+i).value /100);
		vat=vat+(amt * document.getElementById('vat_'+i).value /100);

		disc=disc+(amt * document.getElementById('disc_'+i).value /100);
		//sum=sum+parseFloat(arr[i-1].value);
	}
	var sub_tot=act_sum+gst+vat;
	var sub_tot_1=sub_tot-disc;
	
	document.getElementById("tot_sum").innerHTML="<table><tr><td>Total</td><td>:"+act_sum+"</td></tr><tr><td>GST</td><td>:"+gst+"</td></tr><tr><td>VAT</td><td>:"+vat+"</td></tr><tr><td>Total</td><td>:"+sub_tot+"</td></tr><tr><td>Discount</td><td>:"+disc+"</td></tr><tr><td>Total after Discount</td><td>:"+sub_tot_1+"</td></tr></table>";
}