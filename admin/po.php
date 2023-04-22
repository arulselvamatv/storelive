<?php
require_once("header.php");
?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        </br>
                        </br>
                            <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Add Purchase order</h4>
                            </div>
                            <form id="po" action="po_back.php" method="POST" autocomplete="off">
                                <br>
                                <div class="card-body">
                                    <h4 class="card-title">Customer Details</h4>
                                </div>
                                <hr>
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Institution</label>
                                                    <input list="inst_list" class="form-control" id="inst" name="inst" style="width:100%;" placeholder="Choose Institution Name">
								                        <datalist id="inst_list">
								                            <?php
								
									                        require_once("database/connect.php");
									                        $db=new Database;
									                        $db->connect();
									                        $db->mquery('anands_group','distinct institution');
									                        $data=$db->fetchdata() ;
									                        foreach($data as $row)
									                            {
										                            echo '<option value="'.$row->institution.'">'.$row->institution.'</option>';
									                            }
                                                                
								                            ?>
												
								                        </datalist>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label class="form-label">Department</label>
                                                    <input list="dep_list" class="form-control" id="dept" name="dept" style="width:100%;" placeholder="Choose Department Name">
									                    <datalist id="dep_list">
									                        <?php
								
									                            require_once("database/connect.php");
									                            $db=new Database;
									                            $db->connect();
									                            $db->mquery('anands_group','distinct department');
									                            $data=$db->fetchdata() ;
									                            foreach($data as $row)
									                                {
										                            echo '<option value="'.$row->department.'">'.$row->department.'</option>';
									                                }   
								
									                        ?>
									                    </datalist> 
                                            </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Lab</label>
                                                        <input type="text" id="po_lab" name="po_lab" class="form-control " placeholder="Lab">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group has-success">
                                                        <label class="form-label" >Purchase Type</label>
                                                        <select class="form-control form-select" name="po_type" id="po_type">
                                                            <option value="Purchase">Purchase</option>
										                    <option value="Service">Service</option>
										                    <option value="Miscellaneous">Miscellaneous</option>
                                                        </select>
                                                    </div>
                                                </div>
                                           
                                            
                                   
                                            </div>


                                        </div>
                                        <!--/row-->
                                        <h4 class="card-title mt-5">Supplier Details</h4>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label">Company Name</label>
                                                    <input class="form-control" type="text" id="c_name" name="c_name" list="c_name_list">
                                                    <datalist id="c_name_list">
									                        <?php
								
									                            require_once("database/connect.php");
									                            $db=new Database;
									                            $db->connect();
									                            $db->mquery('suplier','distinct company_name');
									                            $data=$db->fetchdata() ;
									                            foreach($data as $row)
									                                {
										                            echo '<option value="'.$row->company_name.'">'.$row->company_name.'</option>';
									                                }   
								
									                        ?>
									                    </datalist> 
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Person</label>
                                                    <select class="form-control" type="text" id="name" name="name">
                                                    <option>--Select Name--</option>
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row pt-3">  
                                            <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Mobile Number</label>
                                                        <input class="form-control" type="text" id="mobile" name="mobile">
                                                        
                                                    </div>
                                                </div>   
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Denomination</label>
                                                        <select class="form-control form-select" name="currency" id="currency" required>
                                                        <option>--Select Currency--</option>
                                                        <option value="Rupees">Rupees</option>
									                    <option value="Doller">Doller</option>
									                    <option value="Euro">Euro</option>
                                                        </select>
                                                    </div>
                                                </div>       
                                        </div>  
                                    <div class="row pt-3">   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>GSTIN Number</label>
                                                <input type="text" class="form-control" id="gstin_no" name="gstin_no">
                                                            
                                            </div>   
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label>PAN Number</label>
                                                <input type="text" class="form-control" id="pan_no" name="pan_no">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bank Details - I</label>
                                                <input class="form-control" type="text" id="bank1" name="bank1" placeholder="Acc.no, Bank Name, Branch, IFSC Code.">
                                                            
                                            </div>   
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label>Secondary Account(Bank Details -II)</label>
                                                <input class="form-control" type="text" id="bank2" name="bank2" placeholder="Acc.no, Bank Name, Branch, IFSC Code.">
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Address for Communication</label>
                                                <input class="form-control" type="text" id="address" name="address">
                                                       
                                            </div>
                                        </div>  
                                    </div>    

                                    
                                    
                                 <!-------------- Model Dialogue ------------------------->
                                       
                                        
                                        <!-- model 2 -->
                                        <div class="modal fade" id="myModal2" role="dialog">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Add Goods</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Category</label>
                                                        <input type="text" class="form-control" id="PRO" name="PRO" style="width:100%; min-width:100px;" list="PRO_list">
                                                        <datalist id="PRO_list">
									                        <?php
								
									                            require_once("database/connect.php");
									                            $db=new Database;
									                            $db->connect();
									                            $db->mquery('category','distinct category_name');
									                            $data=$db->fetchdata() ;
									                            foreach($data as $row)
									                                {
										                            echo '<option value="'.$row->category_name.'">'.$row->category_name.'</option>';
									                                }   
								
									                        ?>
									                    </datalist> 
                                                            
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label>Product Type</label>
                                                        <select class="form-control" id="PRO_TY" name="PRO_TY" style="width:100%; min-width:100px;">
                                                            <option>--Select Product Type--</option>
                                                            <option value="Assets">Assets</option>
									                        <option value="Consumables">Consumables</option>
                                                        </select>
                                                       
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label>Product Code - Product Name - Product Description</label>
                                                        <select class="form-control" id="PRO_DETS" name="PRO_DETS" style="width:100%;">
                                                            
                                                        
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label>Quantity</label>
                                                        <input class="form-control " id="QTY" name="QTY" type="text" style="min-width:100px;" onkeydown="chk_number(event);">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Units</label>
                                                        <input list="unit_list" class="form-control form-select" id="q_units" name="q_units" style="width:100%; min-width:100px;">
                                                            <datalist id="unit_list">
                                                                <option value ="Nos">Nos</option>
                                                                <option value="Kg">Kg</option>
                                                                <option value="litres">litres</option>
                                                            </datalist>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label>Rate</label>
                                                        <input class="form-control " id="AMT_UNIT" name="AMT_UNIT" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>DISCOUNT IN %</label>
                                                        <input class="form-control " id="DISC_" name="DISC_" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0>
                                                    </div>
                                                    <!--<div class="col-md-12">
                                                        <label>VAT IN %</label>
                                                        <input class="form-control " id="VAT_" name="VAT_" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0>
                                                    </div>-->
                                                    
                                                    <div class="col-md-12">
                                                        <label>GST IN %</label>
                                                        <input class="form-control " id="GST_" name="GST_" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0> 
                                                    </div>
                                                    
                                                    
                                                    <!--
                                                    <div class="col-md-12">
                                                        <label>TOTAL</label>
                                                        <input class="form-control " id="TOT_UNIT_AMT" name="TOT_UNIT_AMT" type="text" style="min-width:50px;" class="fn_call" value=0>
                                                    </div>-->
                                                    <div class="col-md-12">
                                                    <br/>
                                                        <button type="button" class="btn btn-success addmore" id="addmore">+ Add Goods</button>
                                                        <!--<button type="button" class="btn btn-danger delete">- Delete</button>-->
                                                        
                                                    </div>
                                                    
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="form-control btn-primary" type="button"  data-dismiss="modal">Done</button>
                                                </div>
                                        </div>
                                        
                                        </div>
                                    </div>

                                    <!-------------- Model Over ------------------------->
                                    <!-- model 3 -->
                                    <div class="modal fade" id="myModal3" role="dialog">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Goods</h4>
                                            </div>
                                            <div class="modal-body">
                                            <input type="hidden" id="u_id" value="0">
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <label>Goods Type</label>
                                                    <input list="pro_det" class="form-control" id="u_PRO" name="u_PRO" style="width:100%; min-width:100px;">
                                                        <datalist id="pro_det">
                                                            <option value ="Bleaching">Bleaching</option>
                                                            <option value="Colouring">Colouring</option>
                                                            <option value="Raw">Raw</option>
                                                        </datalist>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <label>Goods Description</label>
                                                    <textarea  class="form-control" id="u_PRO_DET" name="u_PRO_DET" style="width:100%;"></textarea>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label>Quantity</label>
                                                    <input class="form-control " id="u_QTY" name="u_" type="text" style="min-width:100px;" onkeydown="chk_number(event);">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Units</label>
                                                    <input list="u_unit_list" class="form-control" id="u_units" name="u_units" style="width:100%; min-width:100px;">
                                                        <datalist id="u_unit_list">
                                                            <option value ="Nos">Nos</option>
                                                            <option value="Kg">Kg</option>
                                                            <option value="litres">litres</option>
                                                        </datalist>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Rate</label>
                                                    <input class="form-control " id="u_AMT_UNIT" name="u_AMT_UNIT" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <label>DISCOUNT IN %</label>
                                                    <input class="form-control " id="u_DISC_" name="u_DISC_" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0>
                                                </div>
                                                
                                                <!--<div class="col-md-12">
                                                    <label>VAT IN %</label>
                                                    <input class="form-control " id="u_VAT_" name="u_VAT_" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0>
                                                </div>-->
                                                
                                                <div class="col-md-12">
                                                    <label>GST IN %</label>
                                                    <input class="form-control " id="u_GST_" name="u_GST_" type="text" style="min-width:50px;" onkeydown="chk_number(event);" value=0> 
                                                </div>
                                                
                                                
                                                <!--
                                                <div class="col-md-12">
                                                    <label>TOTAL</label>
                                                    <input class="form-control " id="TOT_UNIT_AMT" name="TOT_UNIT_AMT" type="text" style="min-width:50px;" class="fn_call" value=0>
                                                </div>-->
                                                <div class="col-md-12">
                                                <br/>
                                                    <button type="button" class="btn btn-success update" id="update">Update</button>
                                                    <!--<button type="button" class="btn btn-danger delete">- Delete</button>-->
                                                    
                                                </div>
                                                
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <!--<button class="form-control btn-primary" type="button"  data-dismiss="modal">Done</button>-->
                                            </div>
                                    </div>
                                    </div>
                                    </div>
                                    <!-- model over-->

                                    <!-------------- Model Dialogue ------------------------->
                                        <div class="modal fade" id="myModal4" role="dialog">
                                        <div class="modal-dialog">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Upload CSV File</h4>
                                            </div>
                                            <div class="modal-body">
                                            <!--<form id="file_up" enctype="multipart/form-data" method="post" action="javascript;">-->

                                                <div class="row" style="margin-bottom:20px;">
                                                <div class="col-md-12">
                                                Select the proper CSV file. <a href="sample.csv">Click here for sample format</a>
                                                </div>
                                                </div>
                                                <div class="row">
                                            
                                                    <div class="col-md-6">
                                                    <input type="file" class="btn btn-info" name="upload" id="upload">
                                                    </div>
                                                    <div class="col-md-6" style="text-align:center;">
                                                    <button type="button" class="btn btn-success csv" id="csv">Update</button>
                                                    </div>

                                                    
                                                    
                                                </div><!-- end row-->	
                                            <!--</form>-->
                                            </div>
                                            <div class="modal-footer">
                                            <button class="form-control btn-primary"  type="button"  data-dismiss="modal">Done</button>
                                            
                                            </div>
                                        </div>
                                        </div>
                                        </div>


                                    <!--model all over -->
                                    <!-------------- Model Over ------------------------->
                                    <div class="table-responsive" style="border: 1px solid blue;">
                                                            <table class="table table-striped" id="auto_change" style="overflow:scroll; width:100%;">
                                                                <tbody><tr>
                                                                    <th style="width:5%"><input class="check_all" onclick="select_all()" type="checkbox"></th>
                                                                    <th style="width:5%">Sl.No.</th>
                                                                    <th>Item / Goods Details</th>
                                                                    <th style="width:10%">Weight/Units</th>
                                                                    <th style="width:10%">Amount / Kg/Unit</th>
                                                                    <th style="width:5%">Discount %</th>
                                                                    <!--<th style="width:5%">VAT %</th>-->
                                                                    <th style="width:5%">GST %</th>
                                                                    
                                                                    <th style="width:10%">Total Amount</th>
                                                                
                                                                    <!--<th>Balance in Stock</th>-->
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                            <table border=0 style="width:100%;">
                                                            <tr>
                                                            <td>
                                                            
                                                                <button type="button" class="btn btn-danger delete">- Delete</button>
                                                                <button type="button" class="btn btn-success edit" id="edit" data-toggle="modal" data-target="#myModal3"># Edit PO</button>
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal4">Upload CSV File</button>
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">+ Add Goods</button>

                                                            
                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            <td style="width:25%;">
                                                            <div id="tot_sum">
                                                            
                                                            </div>
                                                                
                                                            </td>
                                                            </tr>
                                                            </table>
                                            </div>
                                                    <br/>	<div class="row">
                                                    
                                                            <div class="col-md-6">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><strong>Remarks if Any</strong></div>
                                                                    <div class="panel-body">
                                                                        <textarea class="form-control" name="remarks" rows="1"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><strong>Terms and Conditions</strong></div>
                                                                    <div class="panel-body">
                                                                        <textarea class="form-control" name="terms" rows="1"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <center>
                                                            <input type="hidden" name="overall_total" id="overall_total" value="0">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            
                                                            </center>
                                                            
                                                        </div>
                                            
                                                    
                                                    
                                                    <br/>

                                                    
                            </form> 
			
	
	
		<!-- ============================= Content of the page Over Here =========================-->
		</div> <!-- Begin Page Content Over-->
	</div> <!-- Begin Content Over-->         
                                                                    


            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php require_once("footer.php");?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <script>
    $( document ).ready(function() {
    $(document).on('change', '#PRO_TY', function( e ) {
	    var this_val = $.trim($(this).val());
        var PRO = $.trim($('#PRO').val());
       // alert(PRO); exit;
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_po_det.php?PRO='+PRO+'&PRO_TY='+this_val,
				success: function(data){
					
					//$("#PRO_DETS").html(data);
                    $('#PRO_DETS').html(data);
                    //alert(data);
					
				}
			});
    });
    });
    </script>
    <script>
    $( document ).ready(function() {
    $(document).on('change', '#c_name', function( e ) {
	    var this_val = $.trim($(this).val());
        $.ajax({
				type: "GET",
				url: 'ajax/ajax_po_sup_det.php?c_name='+this_val,
				success: function(data){
					
					//$("#PRO_DETS").html(data);
                    $('#name').html(data);
                    //alert(data);
					
				}
			});
            //var this_mobile = $.trim($('#name').find(':selected').attr("data-mobile"));
          
    });
    });
    </script>
    
    <script>
        $( document ).ready(function() {
    $(document).on('change', '#name', function( e ) {
        var this_mobile = $.trim($(this).find('option:selected').attr("data-mobile"));
        var this_address = $.trim($(this).find('option:selected').attr("data-address"));
        var this_gstin_no = $.trim($(this).find('option:selected').attr("data-gstin_no"));
        var this_pan_no = $.trim($(this).find('option:selected').attr("data-pan_no"));
        var this_bank1 = $.trim($(this).find('option:selected').attr("data-bank1"));
        var this_bank2 = $.trim($(this).find('option:selected').attr("data-bank2"));
        
        $('#mobile').val(this_mobile);
        $('#address').val(this_address);
        $('#gstin_no').val(this_gstin_no);
        $('#pan_no').val(this_pan_no);
        $('#bank1').val(this_bank1);
        $('#bank2').val(this_bank2);




        });
    });
    </script>    


</body>

</html>