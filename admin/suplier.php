<?php
require_once("header.php");
require_once("database/connect.php");
$db = new Database;
$db->connect();
?>
        
<div class="page-wrapper">
    <?php if (!empty($_REQUEST['sup_id'])): ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card"></br>
                        </br>
                            <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Edit Suplier Details</h4>
                            </div>
                            <?php
                                $asd =('SELECT `sup_id`, `company_name`, `name`, `mobile`, `address`,`password`,`email`, `gstin_no`, `pan_no`, `bank1`, `bank2`,`supliercat`, `active_record`, `date_time` FROM `suplier` where active_record=1 and sup_id="'.$_REQUEST['sup_id'].'"');
                              //  echo $asd;exit;
                                $datd = $db->query($asd);
                        while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                            <form id="suplier_update" autocomplete="off">
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label">Company Name<span style="color: red"> *</span></label>
                                                    <input class="form-control" type="hidden" id="e_c_id" name="e_c_id" value="<?php print $row['sup_id']?>">
                                                    <input class="form-control" type="text" id="e_c_name" name="e_c_name" value="<?php print $row['company_name']?>">
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Person</label>
                                                    <input class="form-control" type="text" id="e_name" name="e_name" value="<?php print $row['name']?>">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">  
                                            <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="form-label">Mobile Number<span
                                                                style="color: red"> *</span></label>
                                                    <input class="form-control" type="text" id="e_mobile" name="e_mobile"
                                                           value="<?php print $row['mobile'] ?>">
                                                    </div>
                                                </div>   
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label> Address for Communication<span
                                                                style="color: red"> *</span></label>
                                                    <textarea class="form-control" id="e_address" name="e_address"
                                                              rows="1"><?php print $row['address'] ?></textarea>
                                                    </div>
                                                </div>       
                                        </div> 
                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email Address</label>
                                                    <input class="form-control" type="email" id="e_email" name="e_email" value="<?php print $row['email'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Password</label>
                                                    <input class="form-control" type="password" id="e_password" name="e_password" value="<?php print $row['password'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Choose Category</label>
                                                    <select class="form-control js-example-basic-multiple" id="e_supliercat" name="e_supliercat[]" size="10" multiple>
                                                    <?php
                                                    require_once("database/connect.php");
                                                    $db = new Database;
                                                    $db->connect();
                                                    $asd = ('SELECT `ca_id`,`category_name` FROM `category` where active_record=1 ');
                                                    //echo $asd; exit;
                                                    $datd = $db->query($asd);
                                                    while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $data['ca_id'] . "'>" . $data['category_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="row">  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>GSTIN Number</label>
                                                    <input type="text" class="form-control" id="e_gstin_no"
                                                           name="e_gstin_no" value="<?php print $row['gstin_no'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>PAN Number</label>
                                                    <input type="text" class="form-control" id="e_pan_no" name="e_pan_no"
                                                           value="<?php print $row['pan_no'] ?>">
                                                    </div>
                                                </div>
                                        </div>            
                                        <div class="row">  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bank Details - I</label>
                                                    <textarea class="form-control" id="e_bank1" name="e_bank1"
                                                              placeholder="Acc.no, Bank Name, Branch, IFSC Code."><?php print $row['bank1'] ?></textarea>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Secondary Account(Bank Details -II)</label>
                                                    <textarea class="form-control" id="e_bank2" name="e_bank2"
                                                              placeholder="Acc.no, Bank Name, Branch, IFSC Code."><?php print$row['bank2'] ?></textarea>
                                                        </div>
                                                    </div>  
                                        </div>
                                        
                                        <div class="col-sm-12">
                                                            <center>
                                                            
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                            
                                                            </center>
                                                            
                                                        </div>
                                    </div>   
                                </div>
                                </form>
                                <?php } ?>
                                </div>
                    
                    </div>
                
                </div>

            </div>

    <?php else: ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card"></br>
                        </br>
                            <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Add Suplier Details</h4>
                            </div>
                            
                            <form id="suplier" autocomplete="off">
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label">Company Name<span style="color: red"> *</span></label>
                                                    <input class="form-control" type="text" id="c_name" name="c_name">
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Person</label>
                                                    <input class="form-control" type="text" id="name" name="name">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Mobile Number<span style="color: red"> *</span></label>
                                                        <input class="form-control" type="text" id="mobile" name="mobile">
                                                    </div>
                                                </div>   
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Address for Communication<span style="color: red"> *</span></label>
                                                        <textarea class="form-control" id="address" name="address" rows="1"></textarea>
                                                    </div>
                                                </div>       
                                        </div> 
                                        <div class="row">
                                            <div class=col-md-6>
                                                <div class=form-group>
                                                    <label class=form-label>Email Address</label>
                                                    <input class=form-control type=email id=email name=email>
                                                </div>
                                            </div>
                                             <div class=col-md-6>
                                                <div class=form-group>
                                                    <label class=form-label>Password</label>
                                                    <input class=form-control type=password id=password name=password>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=row>
                                            <div class=col-md-12>
                                                <div class=form-group>
                                                    <label class=form-label>Choose Category</label>
                                                    <select class="form-control js-example-basic-multiple" id="supliercat" name="supliercat[]" size="10" multiple>
                                                    <?php
                                                    require_once("database/connect.php");
                                                    $db = new Database;
                                                    $db->connect();
                                                    $asd = ('SELECT `ca_id`,`category_name` FROM `category` where active_record=1 ');
                                                    $datd = $db->query($asd);
                                                    while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $data['ca_id'] . "'>" . $data['category_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">  
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
                                        <div class="row">  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bank Details - I</label>
                                                        <textarea class="form-control" id="bank1" name="bank1" placeholder="Acc.no, Bank Name, Branch, IFSC Code."></textarea>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Secondary Account(Bank Details -II)</label>
                                                            <textarea class="form-control" id="bank2" name="bank2" placeholder="Acc.no, Bank Name, Branch, IFSC Code."></textarea>
                                                        </div>
                                                    </div>  
                                        </div>
                                        
                                        <div class="col-sm-12">
                                        <center><button type="submit" class="btn btn-success">Submit</button></center>
                                                        </div>
                                    </div>   
                                </div>
                                </form>

                       <div class="container-fluid">
                           <div><hr>
                               <h4 class="font-weight-bold">Supplier Report</h4><hr>
                           </div>
                           <div class="container">
                               <div class="row">
                                   <div class="col-md-5">
                                       <a href="uploads/sample/sample_suplier_import.xlsx" class="btn btn-outline-secondary bg-info text-white"><i class="fa fa-file-excel"> </i> Sample <i class="fa fa-download"></i></a>
                                   </div>
                                   <div class="col-md-5 ms-auto">
                                       <div class="input-group">
                                           <input type="file" class="form-control" name="suplier_xl" id="suplier_xl" aria-describedby="bulk_upload_xl" aria-label="Upload" required>
                                           <button class="btn btn-outline-secondary bg-info text-white" type="button" id="bulk_upload_xl">Bulk Import</button>
                                       </div>
                                       <div style="color:red;">Note: Special characters like , , " are not allowed</div>
                                   </div>
                               </div>
                           </div>

                                <div class="table-responsive pb-5">
								
                               <?php
                                $asd =('SELECT `sup_id`, `company_name`, `name`, `mobile`, `address`,`email`, `password`,`gstin_no`, `pan_no`, `bank1`, `bank2`,`supliercat`, `active_record`, `date_time` FROM `suplier` where active_record=1');
                                $datd = $db->query($asd);
                                
                               echo '<table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';
                               echo "<thead><tr>";
                               echo "<th>S.No</th>";
                               echo "<th>Company Name</th>";
                               echo "<th>Name</th>";
                               echo "<th>Mobile No</th>";
                               echo "<th>Address</th>";
                               echo "<th>Email</th>";
                               echo "<th>Pass</th>";
                               echo "<th>GSTIN No</th>";
                               echo "<th>PAN No</th>";
                               echo "<th>Bank 1</th>";
                               echo "<th>Bank 2</th>";
                               echo "<th>Category</th>";
                               echo "<th>Datetime</th>";
                               echo "<th>Edit</th>";
                               echo "</tr></thead><tbody>";
                               $sno=0;
                               while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>".$row['sup_id']."</td>";//".(++$sno).".
                                echo "<td>".$row['company_name']."</td>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['mobile']."</td>";
                                echo "<td>".$row['address']."</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>".$row['gstin_no']."</td>";
                                echo "<td>".$row['pan_no']."</td>";
                                echo "<td>".$row['bank1']."</td>";
                                echo "<td>".$row['bank2']."</td>";
                                echo "<td>" . $row['supliercat'] . "</td>";
                                echo "<td>".$row['date_time']."</td>";
                                echo "<td><div id='outer'>
                                
                                <center>
                                <a href='?sup_id=".$row['sup_id']."'><div class='inner'><input class='btn btn-primary editz' name='edit-button[]' id='edit-button_".$row['sup_id']."' value='Edit' style='display:block' /></div></a>
                                </center>
                                
                                </div></td>";
                                echo "</tr>";
                                }
                                echo "</tbody></table>";
                                ?>
                                </div>

                       </div>
                        <br>
                        </div>
                    
                    </div>
                
                </div>

            </div>

    <?php endif; ?>
</div>

    <?php require_once("footer.php");?>

    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <script src="dist/js/custom.min.js"></script>

    <!-- This page plugins -->
    <script src="dist/js/pages/jasny-bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>

       <script>
           // for more info visit the official plugin documentation: 
               // http://docs.jquery.com/Plugins/Validation
               
               $(document).ready(function () {

            <!-- INSERT FORM VALIDATION -->
               jQuery.validator.addMethod("lettersonly", function(value, element) {
     return this.optional(element) || /^[a-z]+$/i.test(value);
   }, "Alphabetic only allowed"); 
   var form1 = $('#suplier');
               var error1 = $('.alert-danger', form1);
               var success1 = $('.alert-success', form1);
   
               form1.validate({
                   errorElement: 'span', //default input error message container
                   errorClass: 'help-block help-block-error', // default input error message class
                   focusInvalid: false, // do not focus the last invalid input
                   ignore: "",  // validate all fields including form hidden input
                 
                   rules: {
                    // c_name: {
                          
                    //        required: true
                    //    },
                    //    name: {
                          
                    //       required: true
                    //   },
                    //   mobile: {
                          
                    //       required: true,
                    //       number:true
                    //   },
                    //   address: {
                          
                    //       required: true
                    //   },
                    //   gstin_no: {
                          
                    //       required: true
                    //   },
                    //   bank1: {
                          
                    //       required: true
                    //   }
                       
                     
                   },
   
                   invalidHandler: function (event, validator) { //display error alert on form submit              
                       success1.hide();
                       error1.show();
                       Metronic.scrollTo(error1, -200);
                   },
   
                   highlight: function (element) { // hightlight error inputs
                       $(element)
                           .closest('.form-group').addClass('has-error'); // set error class to the control group
                   },
   
                   unhighlight: function (element) { // revert the change done by hightlight
                       $(element)
                           .closest('.form-group').removeClass('has-error'); // set error class to the control group
                   },
   
                   success: function (label) {
                       label
                           .closest('.form-group').removeClass('has-error'); // set success class to the control group
                   },
   
                   submitHandler: function (form) {
                       success1.show();
                       error1.hide();
                       
                           var data = new FormData($(form)[0]);
                            $.ajax
                                (
                                    {
                                        //data : form.serialize(),
                                        url:'suplier_back.php',
                                        data: data,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        type: 'POST',
                            success: function (response) {
                                if (response == "Suplier Details Entered Sucessfully.") {
                                                    $('.form-control').val('');
                                                    alert(response);	
                                                    location.reload();
                                } else if (response == "Error! Please try again.") {
                                                    alert(response);	
                                } else if (response == "Some Fields Are Missing") {
                                                    alert(response);	
                                } else {
                                                    alert(response);	
                                            }
                                            
                                                        
                                        },
                                        
                                    }
                                ); 
                       
                   }
               });
   <!-- INSERT FORM VALIDATION END-->

       <!-- EDIT FORM VALIDATION -->
               jQuery.validator.addMethod("lettersonly", function(value, element) {
               return this.optional(element) || /^[a-z]+$/i.test(value);
               }, "Alphabetic only allowed"); 
   
               var form1 = $('#suplier_update');
               var error1 = $('.alert-danger', form1);
               var success1 = $('.alert-success', form1);
   
               form1.validate({
                   errorElement: 'span', //default input error message container
                   errorClass: 'help-block help-block-error', // default input error message class
                   focusInvalid: false, // do not focus the last invalid input
                   ignore: "",  // validate all fields including form hidden input
                 
                   rules: {
                    // c_name: {
                          
                    //        required: true
                    //    },
                    //    name: {
                          
                    //       required: true
                    //   },
                    //   mobile: {
                          
                    //       required: true,
                    //       number:true
                    //   },
                    //   address: {
                          
                    //       required: true
                    //   },
                    //   gstin_no: {
                          
                    //       required: true
                    //   },
                    //   bank1: {
                          
                    //       required: true
                    //   }
                       
                     
                   },
   
                   invalidHandler: function (event, validator) { //display error alert on form submit              
                       success1.hide();
                       error1.show();
                       Metronic.scrollTo(error1, -200);
                   },
   
                   highlight: function (element) { // hightlight error inputs
                       $(element)
                           .closest('.form-group').addClass('has-error'); // set error class to the control group
                   },
   
                   unhighlight: function (element) { // revert the change done by hightlight
                       $(element)
                           .closest('.form-group').removeClass('has-error'); // set error class to the control group
                   },
   
                   success: function (label) {
                       label
                           .closest('.form-group').removeClass('has-error'); // set success class to the control group
                   },
   
                   submitHandler: function (form) {
                       success1.show();
                       error1.hide();
                       
                           var data = new FormData($(form)[0]);
                            $.ajax
                                (
                                    {
                                        //data : form.serialize(),
                                        url:'suplier_back_update.php',
                                        data: data,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        type: 'POST',
                            success: function (response) {
                                if (response == "Suplier Details Entered Sucessfully.") {
                                                    $('.form-control').val('');
                                                    alert(response);	
                                                    location.reload();
                                } else if (response == "Error! Please try again.") {
                                                    alert(response);	
                                } else if (response == "Some Fields Are Missing") {
                                                    alert(response);	
                                } else {
                                                    alert(response);	
                                            }
                                            
                                                        
                                        },
                                        
                                    }
                                ); 
                       
                   }
               });
 <!-- EDIT FORM VALIDATION END -->
 

   <!-- Datatables-->
          // Setup - add a text input to each footer cell
          $('#trn_dlr_pi_inv thead tr')
              .clone(true)
              .addClass('filters')
              .appendTo('#trn_dlr_pi_inv thead');
      
          var table = $('#trn_dlr_pi_inv').DataTable({
              orderCellsTop: true,
              fixedHeader: true,
              initComplete: function () {
                  var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                                                    });
                                          });
                                      },
                                });
            <!-- Datatables END -->


            /* BULK SUPLIER UPLOAD */
            $('#bulk_upload_xl').on('click',function (e){
                e.preventDefault();

                var bulk_upload_xl_btn = $('#bulk_upload_xl');

                if(!$('input[name=suplier_xl]')[0].files[0]){
                    alert('Please choose required file to import');
                    return;
                }

                var formData = new FormData();
                formData.append('suplierxl', $('input[name=suplier_xl]')[0].files[0]);

                bulk_upload_xl_btn.attr('disabled',true);

                $.ajax({
                    url: 'suplier_bulk_import.php',
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        console.log(response);
                        if(response['status']){
                            alert('Total:'+ response['total_count'] +' Skipped:'+ response['skip_count'] + ' Success:'+ response['insert_success_count'] + ' Failed:'+ response['insert_fail_count']);
                            bulk_upload_xl_btn.attr('disabled',false);
                            location.reload();
                        }else{
                            alert(response['error_msg']);
                            bulk_upload_xl_btn.attr('disabled',false);
                        }
                    }
                });
            })

            /* /BULK SUPLIER UPLOAD */

                            });

        </script>

</body>
</html>
        