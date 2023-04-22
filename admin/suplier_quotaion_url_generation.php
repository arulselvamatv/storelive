<?php
require_once("header.php");
require_once("database/connect.php");
$db = new Database;
$db->connect();
?>
        
<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card"></br>
                        </br>
                            <div class="card-header bg-info">
                                <h4 class="mb-0 text-white">Suplier Quotaion URL Generation</h4>
                            </div>
                            
                            <form id="suplier_quotaion_url_generation" autocomplete="off">
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class=col-md-6>
                                                <div class=form-group>
                                                    <label class=form-label>Supplier (COMPANY) Name</label>
                                                    <select class="form-control" id="supplier_name" name="supplier_name" >
                                                    <?php
                                                    $asd = ('SELECT `sup_id`,`name`,`company_name` FROM `suplier` WHERE `active_record`=1');
                                                    $datd = $db->query($asd);
                                                    while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $data['sup_id'] . "'>" . $data['name'].'('.$data['company_name'] .')'. "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=col-md-6>
                                                <div class=form-group>
                                                    <label class=form-label>Quotation No</label>
                                                    <select class="form-control" id="quo_no" name="quo_no" >
                                                    <?php
                                                    $asd = ('SELECT `serial_no` FROM `quotation` as a where (`serial_no`) not in ( SELECT `quo_no` FROM `quot_sup_amt_sel` WHERE `active_record`=1  group by quo_no)  group by serial_no order by serial_no desc');
                                                    $datd = $db->query($asd);
                                                    while ($data = $datd->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $data['serial_no'] . "'>" . $data['serial_no'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-12">
                                        <center><button type="button" id="button" class="btn btn-success">Submit</button></center>
                                    </div>
                                </div>   
                                
                    </form>

                       <div class="container-fluid">
                           <div><hr>
                               <h4 class="font-weight-bold">Suplier Quotaion URL Generation Report</h4><hr>
                           </div>

                                <div class="table-responsive pb-5">
								
                               <?php
                                $asd =('SELECT a.sup_id,b.name,b.company_name,a.quo_no,a.genertated_url FROM `suplier_quotaion_url_generation` as a  
                                INNER JOIN (select `sup_id`,`name`,`company_name` from suplier where `active_record` =1) as b on a.sup_id=b.sup_id
                                WHERE  a.active_record=1');
                                $datd = $db->query($asd);
                                
                               echo '<table id="trn_dlr_pi_inv" style="border-collapse:collapse; width:100%;" border="1" cellpadding="5" class="table table-bordered">';
                               echo "<thead><tr>";
                               echo "<th>S.No</th>";
                               echo "<th>Company Name</th>";
                               echo "<th>Name</th>";
                               echo "<th>Quotation No</th>";
                               echo "<th>Generated URL</th>";
                               echo "</tr></thead><tbody>";
                               
                                $sno=1;
                                
                               while ($row = $datd->fetch(PDO::FETCH_ASSOC)) 
                               {
                                echo "<tr>";
                                echo "<td>".$sno++."</td>";
                                echo "<td>".$row['company_name']."</td>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['quo_no']."</td>";
                                echo "<td>".$row['genertated_url']."</td>";
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
  <?php require_once("footer.php");?>
            </div>


  

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
                   
                   
                   
                   
                    $('.numbers').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
//alert('asdasd');
// <!-- INSERT FORM VALIDATION -->
$("#button").on("click", function(){
        try { 
           // alert('asdasd');
            if($('#supplier_name').val()=='') {
                 throw {
                    msg:"Select Supplier Name",
                    foc:'#supplier_name'
                }
           
                return false;
            }
            if($('#quo_no').val()=='') {
                 throw {
                    msg:"Select Quotation No",
                    foc:'#quo_no'
                }
           
                return false;
            }
            let myform = document.getElementById("suplier_quotaion_url_generation");
            let data = new FormData(myform);
            
	        $.ajax({
				//data : form.serialize(),
				url:'suplier_quotaion_url_generation_back.php',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success: function (response)
				{
                    if(response=="Url Genertated Sucessfully.")
                    {
                        $('.form-control').val('');
                        alert(response);	
                        window.location="suplier_quotaion_url_generation.php";
                    }
                    else if(response=="Error! Please try again.")
                    {
                        $('.form-control').val('');
                        alert(response);	
                        return false;
                        // window.location="suplier_quotaion_url_generation.php";
                    }
                    else
                    {
                        alert(response);
                        return false;
                    }
                   
								
				}
				
			}); 

            return true;
        }catch(e){
            // alert(e);
             alert(e.msg);
            $(e.foc).focus();
            return false;
        }
    });
               
//   <!-- INSERT FORM VALIDATION END-->

//    <!-- Datatables-->
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
            // <!-- Datatables END -->



                            });

        </script>

</body>
</html>
        