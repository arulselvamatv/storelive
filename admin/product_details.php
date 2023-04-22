<?php
require_once("header.php");
require_once("database/connect.php");
$db = new Database;
$db->connect();
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
                            <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Add Product Details</h4>
                            </div>
                            <form id="product_details"  autocomplete="off">
                               
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label">Category<span style="color: red"> *</span></label>
                                                    <select class="form-control form-control-lg js-example-basic-multiple" id="c_name" name="c_name" size="10">
                                                    
									                    <?php
								
                                                          require_once("database/connect.php");
                                                          $db=new Database;
                                                          $db->connect();
                                                          $asd =('SELECT `category_name` FROM `category` where active_record=1 ');
                                                          //echo $asd; exit;
                                                          $datd = $db->query($asd);
                                                while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {
                                                                  echo "<option value='".$data['category_name']."'>".$data['category_name']."</option>";
                                                              }


									                    ?>
									                </select> 
									                       
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Product Type<span style="color: red"> *</span></label>
                                                    <select class="form-control form-select" name="pro_ty" id="pro_ty">
                                                        <option value="">--Select Product Type--</option>
                                                        <option value="Assets">Assets</option>
									                    <option value="Consumables">Consumables</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  

                                        <div class="row pt-3">  
                                            <!--/span-->
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                  <thead>
                                                    <tr>
                                                      <th class="text-center">Product ID</th>
                                                      <th class="text-center">Product Name<span style="color: red"> *</span></th>
                                                      <th class="text-center">Product Description</th>
                                                      <th class="text-center">Unit<span style="color: red"> *</span></th>
                                          
                                                      <th class="text-center">Remove Row</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">
                                            
                                                  </tbody>
                                                </table>
                                              </div>
                                            
                                        </div> 
                                        
                                        <div class="col-sm-12">
                                            <center>
                                                             <button class="btn btn-md btn-primary" 
                                                id="addBtn" type="button">
                                                  Add new Row
                                              </button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                            
                                            </center>
                                                            
                                        </div>

                                    </div> 
                                    <!-- card body ended   -->
                                </div>
                                <!-- form body ended -->
                    </form>

                    <div class="container-fluid">
                        <div>
                                <hr>
                            <h4 class="font-weight-bold">Product Details Report</h4>
                            <hr>
                        </div>
                        
                        
                                <div class="col-md-8 offset-md-2 text-center alert alert-info">
                                <form method="GET" action="cat_download.php"  target="_blank" >
                                    
                                    <div class="row">
                             <div class="col-md-4 text-end h3 pt-1">Category Name :</div>
                            <div class="col-md-5">
                                     
                                     
                            <?php
                                    echo '<select class="form-select asd"  name="unit" id="unit">
                                          <option value ="">Select Category </option>';
                                          $asd =('SELECT `ca_id`, `category_name`, `updated_no`, `active_record`,`date_time` FROM `category` WHERE `active_record`=1');
                                          //echo $asd; exit;
                                          $datd = $db->query($asd);
                                          while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                                          echo'<option value ="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                                         }
                            ?>
                                 </select>
                                 </div>
                                  <div class="col-md-3">  
                                     <button type="submit" class="btn btn-success px-5">VIEW</button>
                                     </div>
                                     </div>
                                        </form>
                                        </div>
                        
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5">
                                    <a href="uploads/sample/sample_product_import.xlsx"
                                       class="btn btn-outline-secondary bg-info text-white"><i
                                                class="fa fa-file-excel"> </i> Sample <i class="fa fa-download"></i></a>
                                </div>
                                <div class="col-md-5 ms-auto">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="product_xl" id="product_xl"
                                               aria-describedby="bulk_upload_xl" aria-label="Upload" required>
                                        <button class="btn btn-outline-secondary bg-info text-white" type="button"
                                                id="bulk_upload_xl">Bulk Import
                                        </button>
                                    </div>
                                    <div style="color:red;">Note: Special characters like , , " are not allowed</div>
                                </div>
                            </div>
                        </div>
								
                        <div class="table-responsive pb-5">

                            <?php
          $asd =('SELECT pd.`pro_id`, pd.`cat_name`, pd.`pro_ty`, pd.`active_record`, pd.`date_time`, pdi.`proi_id`, pdi.`pro_id`, pdi.`pro_code`, pdi.`pro_name`, pdi.`pro_desc`, pdi.`unit`, pdi.`active_record`, (pdi.`date_time`) as date FROM `product_details`as pd inner join product_details_info as pdi on pdi.pro_id= pd.pro_id where pd.active_record=1 and pdi.active_record=1');
                    $datd = $db->query($asd);
                            echo '<table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';
                    echo "<thead><tr>";
                    echo "<th>S.No.</th>";
                      echo "<th>Category Name.</th>";
                      echo "<th>Product Type.</th>";
                      echo "<th>Product Code.</th>";
                      echo "<th>Product Name.</th>";
                      echo "<th>Product Description</th>";
                      echo "<th>Unit</th>";
                      echo "<th>date_time</th>";
                      echo "</tr></thead><tbody>";
                      $sno=0;
                            while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                      echo "<tr>";
                      echo "<td>".$row['proi_id']."</td>";//".(++$sno).".
                      echo "<td>".$row['cat_name']."</td>";
                      echo "<td>".$row['pro_ty']."</td>";
                      echo "<td>".$row['pro_code']."</td>";
                      echo "<td>".$row['pro_name']."</td>";
                      echo "<td>".$row['pro_desc']."</td>";
                      echo "<td>".$row['unit']."</td>";
                      echo "<td>".$row['date']."</td>";
                      echo "</tr>";
                    }
                    echo "</tbody></table>";
          ?>
                        </div>
                    </div>
                    <br>
                        </div>
                        <!-- card ended -->
                    
                    </div>
                
                </div>
                <!-- row ended -->

            </div>
   </div>

<?php require_once("footer.php"); ?>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    
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
    

    <script src="assets/auto.js"></script>
	<script src="assets/autocomplete.js"></script>
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/global/plugins/select2/js/select2.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/buttons.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/datatable/jquery.datatables.min.css"/>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <!-- SELECT 2 -->
    <script>
 $( document ).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

    </script> 
    <!-- SELECT 2 END-->
    <!-- ADD ROW -->
    <script>
        $(document).ready(function () {
      
          // Denotes total number of rows
          var rowIdx = 0;
          
          // jQuery button click event to add a row
          $('#addBtn').on('click', function () {
           
            var cname = $( "#c_name" ).val();
            var cname_2 = cname.substring(0, 2);
            //alert(cname);
            
            // Adding a row inside the tbody.
            $('#tbody').append(`<tr id="R${++rowIdx}">
                 <td class="row-index text-center">
                 <input class="form-control" type="text" id="pro_id_`+rowIdx+`" name="pro_id[]" value="${cname_2}00${rowIdx}" readonly>
                 </td>
    
                 <td class="row-index text-center">
                 <div class="form-group"><input class="form-control" type="text" id="pro_name_`+rowIdx+`" name="pro_name[]"></div>
                 </td>
    
                 <td class="row-index text-center">
                 <textarea class="form-control" type="text" id="pro_desc_`+rowIdx+`" name="pro_desc[]"></textarea>
                 </td>
                 <td class="row-index text-center">
                 <?php
                 echo'<select class="form-control js-example-basic-multiple"  name="unit[]" id="unit_`+rowIdx+`">
                  <option value ="">Select Unit</option>';
                  
                   $asd =('SELECT `u_id`, `u_name`, `date_time`, `active_record` FROM `unit` WHERE `active_record`=1');
                    //echo $asd; exit;
                    $datd = $db->query($asd);
            while ($row = $datd->fetch(PDO::FETCH_ASSOC)) {
                    echo'<option value ="'.$row['u_name'].'">'.$row['u_name'].'</option>';
                    }
                  ?>
                  
                  </select>
                 </td>
                 <td class="row-index text-center">
                 <p>Row ${rowIdx}</p>
                 </td>
                  <td class="text-center">
                    <button class="btn btn-danger remove"
                      type="button">Remove</button>
                    </td>
                  </tr>`);
          });
      
          // jQuery button click event to remove a row.
          $('#tbody').on('click', '.remove', function () {
      
            // Getting all the rows next to the row
            // containing the clicked button
            var child = $(this).closest('tr').nextAll();
      
            // Iterating across all the rows 
            // obtained to change the index
            child.each(function () {
      
              // Getting <tr> id.
              var id = $(this).attr('id');
      
              // Getting the <p> inside the .row-index class.
              var idx = $(this).children('.row-index').children('p');
      
              // Gets the row number from <tr> id.
              var dig = parseInt(id.substring(1));
      
              // Modifying row index.
              idx.html(`Row ${dig - 1}`);
      
              // Modifying row id.
              $(this).attr('id', `R${dig - 1}`);
            });
      
            // Removing the current row.
            $(this).closest('tr').remove();
      
            // Decreasing total number of rows by 1.
            rowIdx--;
          });
        });
      </script>
      <!-- ADD ROW END -->
     <!-- INSERT FORM VALIDATION -->
    <script src="../assets/node_modules/jqueryvalidation/jquery.validate.js"></script>
       
       <script>
           // for more info visit the official plugin documentation: 
               // http://docs.jquery.com/Plugins/Validation
               
               jQuery.validator.addMethod("lettersonly", function(value, element) {
     return this.optional(element) || /^[a-z]+$/i.test(value);
   }, "Alphabetic only allowed"); 
   var form1 = $('#product_details');
               var error1 = $('.alert-danger', form1);
               var success1 = $('.alert-success', form1);
   
               form1.validate({
                   errorElement: 'span', //default input error message container
                   errorClass: 'help-block help-block-error', // default input error message class
                   focusInvalid: false, // do not focus the last invalid input
                   ignore: "",  // validate all fields including form hidden input
                 
                   rules: {
                    pro_name: {
                          
                          required: true
                      },
                    pro_desc: {
                          
                          required: false
                      },
                    unit: {
                          
                          required: true
                      }
                       
                     
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
                   url:'product_details_back.php',
                   data: data,
                   cache: false,
                   contentType: false,
                   processData: false,
                   type: 'POST',
                    success: function (response) {
                        if (response == "Error In Data Store") {
                        $('.form-control').val('');
                        alert(response); 
                        window.location="product_details.php";
                        } else if (response == "Product Details Stored Sucessfully") {
                        $('.form-control').val('');
                        alert(response); 
                        window.location="product_details.php";
                        } else if (response == "Category name or product type not stored") {
                        $('.form-control').val('');
                        alert(response); 
                        window.location="product_details.php";
                        } else {
                        alert(response); 
                    }
                    
                    },
                   
               }
           ); 
                       
                   }
               });
   
   </script>
   <!-- INSERT FORM VALIDATION END -->
   <!-- DATATABLES -->
    <script>
          $(document).ready(function () {
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




        /* BULK PRODUCT UPLOAD */
        $('#bulk_upload_xl').on('click',function (e){
            e.preventDefault();

            var bulk_upload_xl_btn = $('#bulk_upload_xl');

            if(!$('input[name=product_xl]')[0].files[0]){
                alert('Please choose required file to import');
                return;
            }

            var formData = new FormData();
            formData.append('productxl', $('input[name=product_xl]')[0].files[0]);

            bulk_upload_xl_btn.attr('disabled',true);

            $.ajax({
                url: 'product_bulk_import.php',
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

        /* /BULK PRODUCT UPLOAD */
});
        </script>
        <!-- DATATABLES END -->
        
</body>

</html>
        