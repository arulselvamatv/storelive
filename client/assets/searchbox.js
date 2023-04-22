		$("#fid").keypress(function(e){
					if(e.which==13 || e.keyCode==13)
					{
						var s_data=$("#fid").val();
							//	$("#curr_user").html("<center><h3 style="color:red;">You have selected ID - <b>"+r.msg+" </b>for Adding / Modifying Details!</h3>You can use the options under menu to do corresponding changes.<br></center>");
						
						$.ajax({
								url : 'set.php',
								dataType: "json",
								data: {
								    id: s_data
								},
								 success: function( r ){
									$("#curr_user").html("<center><h3 style='color:red;'>You have selected ID - <b>"+r.msg+" </b>for Adding / Modifying Details!</h3>You can use the options under left side menu to do corresponding changes.<br/><br/></center>");
									location.reload();
									
								}
						});
						
					}
				});