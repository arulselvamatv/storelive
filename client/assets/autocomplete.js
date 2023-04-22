$('#c_name').autocomplete({
	source: function( request, response ) {
		
		$.ajax({
  			url : 'ajax/supplier.php',
  			dataType: "json",
			data: {
			   name: request.term,
			   row_num : 1
			},
			 success: function( data ){
				
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[0] + " " + code[1],
						value: code[0],
						data : item
					}
				}));
			}
			});
		},
  	autoFocus: true,	      	
  	minLength: 2,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		$('#name').val(names[2]);
		$('#mobile').val(names[3]);
		$('#address').val(names[1]);
		$('#gstin_no').val(names[4]);
		$('#pan_no').val(names[5]);
		$('#p_bg').val(names[6]);
		$('#bank1').val(names[7]);
		$('#bank2').val(names[8]);
		}		      	
	});
//=============================================================================================//
$('#PRO').autocomplete({
	source: function( request, response ) {
		
		$.ajax({
  			url : 'ajax/product.php',
  			dataType: "json",
			data: {
			   name: request.term,
			   row_num : 1
			},
			 success: function( data ){
				//alert(data);
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					
					return {
						label: code[0] + " " + code[1],
						value: code[0],
						data : item
					}
				}));
			}
			});
		},
  	autoFocus: true,	      	
  	minLength: 2,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		$('#PRO_DET').val(names[1]);
		
		}		      	
	});