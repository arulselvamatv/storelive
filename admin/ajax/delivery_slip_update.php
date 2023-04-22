<?php

if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../database/connect.php");
$db=new Database;
$db->connect();

//~ echo "<pre/>999";print_r($_POST);exit;


$seno_arr = explode(',',$_POST['seno']);
$reason = $_POST['reason'];
$toclient = $_POST['toclient'];
$quantity = $_POST['quantity'];
$code = $_POST['code'];



$client_return_no = 'cl_re_no'.rand(100000,10000000);

$response = array('status'=>false);	

if(empty($reason)){
    $response['err'] = 'reason_empty';
    $response['err_msg'] = 'Reason is required for Transfer';
}else if($reason === 'client' && empty($toclient)){
    $response['err'] = 'client_empty';
    $response['err_msg'] = 'Client is required for Transfer';
}else {
    //~ if($reason == 'client' && !empty($toclient)){
        foreach ($seno_arr as $seno)
        {
			$frmclient = ('SELECT wo.dep_no, st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`,
			              count(st.`store_id`)  as received_qty, count(st.po_id) as total_quantity, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, 
			              st.`u_id`,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,
			              wo.suplier_id, wo.po_no as po_no FROM `store_entry` as st 
			              
			              INNER join work_order as wo on  wo.wo_id =st.po_id
			              INNER join suplier as s on  s.sup_id =wo.suplier_id
			              WHERE `se_no`= "'.$seno.'"');	
			              
            $prdt_dataa=$db->query($frmclient);
            $from_client = $prdt_dataa->fetch(PDO::FETCH_ASSOC);
            
            // echo "<pre/>5555555";print_r($from_client);exit;
            
                    $field_values[0]= $from_client['item_name'];
					$field_values[1]= $code;
					$field_values[2]= $from_client['po_no'];
					$field_values[3]= $from_client['po_id'];
					$field_values[4]= $seno;
					$field_values[5]= $toclient;
					$field_values[6]= $client_return_no;
					$field_values[7]= $from_client['actual_qty'];
					$field_values[8]= $from_client['qty'];
					$field_values[9]= $quantity;
					$field_values[10]= $from_client['suplier_id'];

            $PRO_ID=$db->insertreturnid('client_return_products',$field_values,"prd_name, code, po_no, po_id, se_no, client_id, client_return_no, actual_quantity, received_quantity, return_quantity,supplier_id");
            
            if ($PRO_ID) 
            {
                $datd = $db->query('UPDATE store_entry SET history = 1, dep="' . $toclient . '" WHERE `se_no`="' . $seno . '"');

                $response['status'] = true;
            } else 
            {
                $response['err'] = 'client_transfer_fail';
                $response['err_msg'] = 'Failed to Transfer';
            }
        }
    //~ }
}
echo json_encode($response);
