<?php
require_once("header.php");
?>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style=padding:10px></br></br>
                            <div class="card-header bg-info"><h4 class="mb-0 text-white">Add Signature</h4></div>
                            <form id="signature" autocomplete="off" enctype="multipart/form-data" method="POST">
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>Select Image File:</label><input class="form-control" type="file" name="signature"  required>
                                                    <button class="btn btn-success" style=margin-top:10px type="submit" name="upload">UPLOAD</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div><hr>
                            </form>
                            <?php
				            require_once("database/connect.php");
			            	$db=new Database;
				            $db->connect();
                            $asd =('SELECT * FROM `role` ORDER BY `role`.`id`  DESC LIMIT 1');
                            $datd = $db->query($asd);
                            while($row = $datd->fetch(PDO::FETCH_ASSOC)){
                                   echo "<img style=width:340px;height:91px src=../admin/assets/".$row['signature'].">"; 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php require_once("footer.php");?>
      
   </div>
    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="dist/js/pages/jasny-bootstrap.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>
  
<script>
	$(document).ready(function () {
		$('#signature').submit(function(e){
		    e.preventDefault();
		    var form = $('#signature')[0];
            var formData = new FormData(form);
				$.ajax({
					url:"add_signature_back.php",
					method:'post',
					data:formData,
				    cache: false,
                    contentType: false,
                    processData: false,
                    // type: 'POST',
					success: function (response){
					    console.log(response);
					   // var res = jQuery.parseJSON(data);
                        if(response=="success"){
                            alert('Image uploaded successfully');	
                           
                        }else{
                               alert('Image uploaded failed');	
                             
                        }
                         window.location="add_signature.php";
    				},
    				
					
				});
		
		});
	});
	
    // var form1 = $('#signature');
    // var error1 = $('.alert-danger', form1);
    // var success1 = $('.alert-success', form1);
    // var data = new FormData($(form)[0]);

</script>
</body>
</html>