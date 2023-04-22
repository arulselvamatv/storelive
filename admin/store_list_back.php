<?php
error_reporting(0);
require_once("database/connect.php");
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
$todep = $_POST['todep'];

$indent_no = $_POST['indent_no'];

$se_no_arr = array_column($trans_data,0);
$se_no_str = implode("','",$se_no_arr);

$error = false;

$store_entry_qry = "SELECT `st`.`se_no`, `st`.`store_id`, `wo`.`quo_no`, `wo`.`po_no`, `wo`.`prod_name`, `wo`.`product_spec`, `st`.`per_amt`, count(`st`.`store_id`) as received_qty, (`st`.`per_amt` * count(`st`.`store_id`)) as total_rate, `st`.`received_date`, `s`.`sup_id`, `s`.`name` as supname
FROM `store_entry` AS `st` INNER JOIN `grb` AS `g` ON (`g`.`grb_no` = `st`.`grb_id`) INNER JOIN `work_order` AS `wo` ON (`wo`.`wo_id` = `st`.`po_id`) INNER JOIN `suplier` AS `s` ON (`s`.`sup_id` = `wo`.`suplier_id`)
WHERE `st`.`se_no` IN ('" . $se_no_str . "') AND `wo`.`active_record` = 1 AND `s`.`active_record` = 1 AND `st`.`dep` = 0 GROUP BY `wo`.`prod_name`";
$se_data = $db->query($store_entry_qry);
while ($row = $se_data->fetch(PDO::FETCH_ASSOC)) {

    $arrayString = explode(" ", $row['prod_name']);

    $asda = ('SELECT  pd.`pro_ty` as pro_ty FROM `product_details`as pd INNER JOIN product_details_info as pdi on pdi.pro_id = pd.`pro_id` WHERE pd.`active_record` =1 and pdi.pro_code="' . $arrayString[0] . '" ');
    $datda = $db->query($asda);
    $prdaa = $datda->fetch(PDO::FETCH_ASSOC);
    $pro_ty = $prdaa['pro_ty'];

    $field_values = array();

    $field_values[0] = htmlentities($row['quo_no'], ENT_QUOTES);
    $field_values[1] = htmlentities($row['po_no'], ENT_QUOTES);
    $field_values[2] = htmlentities($row['prod_name'], ENT_QUOTES);
    $se_no_i = array_search($row['se_no'], $se_no_arr);
    $trans_qty = $trans_data[$se_no_i][1];
    $field_values[3] = htmlentities($trans_qty, ENT_QUOTES);
    $field_values[4] = htmlentities($row['product_spec'], ENT_QUOTES);
    $field_values[5] = htmlentities($row['sup_id'], ENT_QUOTES);
    $field_values[6] = htmlentities($row['total_rate'], ENT_QUOTES);
    $field_values[7] = htmlentities($row['received_date'], ENT_QUOTES);
    $field_values[8] = htmlentities(($todep), ENT_QUOTES);
    $field_values[9] = htmlentities(($pro_ty), ENT_QUOTES);
    $field_values[10] = htmlentities(($indent_no), ENT_QUOTES);

    if ($trans_qty > 0) {
        if ($trans_qty > 1) {
            $ddl_pro = $trans_qty;

            for ($e = 0; $e < $ddl_pro; $e++) {
                $asdf = ('SELECT se.se_no FROM store_entry  as se inner join work_order as wo on wo.wo_id = se.po_id WHERE se.dep=0 and  wo.prod_name="' . $row['prod_name'] . '"  order by se.store_id DESC');
                $datds = $db->query($asdf);
                while ($datas = $datds->fetch(PDO::FETCH_ASSOC)) {
                    $ghh = $datas['se_no'];
                }
                $field_values[11] = htmlentities(($ghh), ENT_QUOTES);
                 $field_values[12] = $date;
                $rdata = $db->insertreturnid('store_list', $field_values, " quo_no, po_no, prod_name, ddl_pro_qty, ddl_pro_spec, supname, rate, date_time, dep_name, pro_ty, indent_no,se_no,	crn_date_time");
                if ($rdata) {
                    $today = date("Y-m-d H:i:s");
                    $datd = $db->query("UPDATE store_entry SET dep='" . $todep . "' , dep_date='" . $today . "' WHERE `se_no`='" . $ghh . "' AND dep=0");
                    if (isset($code)) {
                        $resultsd = "SL" . substr_replace('0000', trim($code), -strlen(trim($code)));
                        $datdaaaa = $db->query("UPDATE store_list SET code='" . $code . "', sl_no='" . $resultsd . "' WHERE `sl_id`='" . $rdata . "'");
                    } else {
                        $datdaaa = $db->query('SELECT `code`  FROM `store_list` order by `sl_id` DESC Limit 1');
                        $pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
                        $codea = $pra['code'];
                        $resultsd = "SL" . substr_replace('0000', trim($codea), -strlen(trim($codea)));
                        $datdaaaa = $db->query("UPDATE store_list SET code='" . $codea . "', sl_no='" . $resultsd . "' WHERE `sl_id`='" . $rdata . "'");
                    }

                } else {
                    $error = true;
                }
            }

        } else {

            $field_values[11] = htmlentities(($row['se_no']), ENT_QUOTES);
            $field_values[12] = $date;
            $rdata = $db->insertreturnid('store_list', $field_values, " quo_no, po_no, prod_name, ddl_pro_qty, ddl_pro_spec, supname, rate, date_time, dep_name, pro_ty, indent_no,se_no,	crn_date_time");
            if ($rdata) {
                $today = date("Y-m-d H:i:s");
                $datd = $db->query("UPDATE store_entry SET dep='" . $todep . "' , dep_date='" . $today . "' WHERE `se_no`='" . $row['se_no'] . "' AND dep=0");
                if (isset($code)) {
                    $resultsd = "SL" . substr_replace('0000', trim($code), -strlen(trim($code)));
                    $datdaaaa = $db->query("UPDATE store_list SET code='" . $code . "', sl_no='" . $resultsd . "' WHERE `sl_id`='" . $rdata . "'");
                } else {
                    $datdaaa = $db->query('SELECT `code`  FROM `store_list` order by `sl_id` DESC Limit 1');
                    $pra = $datdaaa->fetch(PDO::FETCH_ASSOC);
                    $codea = $pra['code'];
                    $resultsd = "SL" . substr_replace('0000', trim($codea), -strlen(trim($codea)));
                    $datdaaaa = $db->query("UPDATE store_list SET code='" . $codea . "', sl_no='" . $resultsd . "' WHERE `sl_id`='" . $rdata . "'");
                }
            } else {
                $error = true;
            }
        }
    }

}

if(!$error){
    $response['status'] = true;
    $response['code']  = $code;
}else{
    $response['status'] = false;
    $response['err_msg'] = 'Some error occured while transfer!';
}

echo json_encode($response);
