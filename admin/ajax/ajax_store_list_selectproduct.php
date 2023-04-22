<?php
error_reporting(0);
require_once("../database/connect.php");
$db = new Database;
$db->connect();

date_default_timezone_set('Asia/Kolkata');

$date = date('Y-m-d H:i:s');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$datdaa = $db->query('SELECT ((`code`)+1) as code  FROM `store_list` order by `sl_id` DESC LIMIT 1');
$pras = $datdaa->fetch(PDO::FETCH_ASSOC);
$code = $pras['code'];

$trans_data = json_decode($_POST['trans_data'],true);
$se_no_arr = array_column($trans_data,0);
$se_no_str = implode("','",$se_no_arr);

$store_entry_qry = "SELECT `st`.`se_no`, `st`.`store_id`, `wo`.`quo_no`, `wo`.`po_no`, `wo`.`prod_name`, `wo`.`product_spec`, `st`.`per_amt`, count(`st`.`store_id`) as received_qty, (`st`.`per_amt` * count(`st`.`store_id`)) as total_rate, `st`.`received_date`, `s`.`sup_id`, `s`.`name` as supname
FROM `store_entry` AS `st` INNER JOIN `grb` AS `g` ON (`g`.`grb_no` = `st`.`grb_id`) INNER JOIN `work_order` AS `wo` ON (`wo`.`wo_id` = `st`.`po_id`) INNER JOIN `suplier` AS `s` ON (`s`.`sup_id` = `wo`.`suplier_id`)
WHERE `st`.`se_no` IN ('" . $se_no_str . "') AND `wo`.`active_record` = 1 AND `s`.`active_record` = 1 AND `st`.`dep` = 0 GROUP BY `wo`.`prod_name`";

$se_data = $db->query($store_entry_qry);
$response = ""; 
$i=0;
while ($row = $se_data->fetch(PDO::FETCH_ASSOC)) 

{
    $i++;
    
     $se_no_i = array_search($row['se_no'], $se_no_arr);
    $trans_qty = $trans_data[$se_no_i][1];
    
    $response .= '<tr><td>'.$i.'</td><td>'.$row['quo_no'].'</td><td>'.$row['po_no']. '</td><td>'.$row['prod_name'].'</td><td>'.$row['product_spec'].'</td><td>'.$row['per_amt'].'</td><td>'.$trans_qty.'</td><td>'.$row['received_date'].'</td></tr>';
}

echo $response;


// <td>'.$row['total_rate'].'</td><td>'.$row['received_qty'].'</td>
