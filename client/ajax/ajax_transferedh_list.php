<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->Connect();

$HTML="";
if($con)
{
    $asd=('SELECT t.fromdep,t.to_sup,t.todep, t.reason,st.dep, cl.dep_name as from_dep, c.dep_name, st.`store_id`, st.code, st.invoice_no, st.wrt_date,s.company_name, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
    INNER join grb as g on g.grb_no =st.grb_id
    INNER join work_order as wo on wo.wo_id =st.po_id
    INNER join client as c on c.cl_id =st.dep
   	INNER join transfer as t on t.seno = st.se_no
    INNER join client as cl on cl.cl_id =t.fromdep
    inner join clientusers as cu on cu.dep_name=c.cl_id
    INNER join suplier as s on s.sup_id =wo.suplier_id 
    WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep!=0  and history=1 and cu.id='.$user_id.' group by  t.t_id');
   $i=0;
    $prdt_data=$db->query($asd);
    while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
    { 
        $i++;
        echo '<tr>'.
    
        '<td>'.$prd['se_no'].
        '<input type="hidden" name="seno[]" id="seno_'.$i.'" value="'.$prd['se_no'].'"/>'.
        '</td>'.
        '<td>'.$prd['item_name'].
        '</td>'.
        '<td>'.$prd['from_dep'].
        '<input type="hidden" name="sup[]" id="sup_'.$i.'" value="'.$prd['fromdep'].'"/>'.
        '</td>';
        if($prd['reason']=="Client"){
            echo'<td>Client To Client'.
            '<input type="hidden" name="sup[]" id="sup_'.$i.'" value="'.$prd['Client'].'"/>'.
            '</td>';
        }
        else{
            if($prd['todep']==0){
                $asda=('SELECT `sup_id`, `company_name`, `name`, `mobile`, `address`, `gstin_no`, `pan_no`, `bank1`, `bank2`, `active_record`, `date_time` FROM `suplier` WHERE `active_record`=1 and sup_id='.$prd['to_sup'].'');
    
                $prdt_dataa=$db->query($asda);
                while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))
                { 
                    echo'<td>'.$prd['reason'].' Not Returned From '.$prda['company_name'].'<input type="hidden" name="sup[]" id="sup_'.$i.'" value="'.$prd['sup_id'].'"/>'.
                    '</td>'; 
                
                }
               
            }
            else{
                $asda=('SELECT `sup_id`, `company_name`, `name`, `mobile`, `address`, `gstin_no`, `pan_no`, `bank1`, `bank2`, `active_record`, `date_time` FROM `suplier` WHERE `active_record`=1 and sup_id='.$prd['to_sup'].'');
    
                $prdt_dataa=$db->query($asda);
                while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))
                { 
                echo'<td>'.$prd['reason'].'('.$prda['company_name'].
                ')<input type="hidden" name="sup[]" id="sup_'.$i.'" value="'.$prd['sup_id'].'"/>'.
                '</td>';
                }
            }
        }
        if($prd['todep']==0){
        }
        else{

            $asda=('SELECT `cl_id`, `dep_name`, `date_time`, `active_record` FROM `client` WHERE `cl_id`='.$prd['todep'].'');
    
                $prdt_dataa=$db->query($asda);
                while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))
                { 
                    echo'<td>'.$prda['dep_name'].
                    '<input type="hidden" name="dep[]" id="dep_'.$i.'" value="'.$prd['todep'].'"/>'.
                    '</td>';
                }            
        }
        echo '</tr>';
    }
}
  
?>
<script>
   $(document).ready(function() {
    $(".js-example-basic-multiple").select2();
    });
    </script>
    <script>
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#trn_dlr_pi_invv thead tr')
        .appendTo('#trn_dlr_pi_invv thead');
 
    var table = $('#trn_dlr_pi_invv').DataTable({
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
});
        </script>


  

	