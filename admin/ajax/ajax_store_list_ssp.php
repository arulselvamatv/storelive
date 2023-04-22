<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();
// DB table to use
$table = 'store_entry';

// Table's primary key
$primaryKey = 'store_id';

$columns = array(
    array('db' => '`st`.`se_no`', 'dt' => 0, 'field' => 'se_no'),
    array('db' => '`st`.`store_id`', 'dt' => 1, 'field' => 'store_id'),
    array('db' => '`wo`.`quo_no`', 'dt' => 2, 'field' => 'quo_no'),
    array('db' => '`wo`.`po_no`', 'dt' => 3, 'field' => 'po_no'),
    array('db' => '`wo`.`prod_name`', 'dt' => 4, 'field' => 'prod_name'),
    array('db' => '`wo`.`product_spec`', 'dt' => 5, 'field' => 'product_spec'),
    array('db' => '`st`.`per_amt`', 'dt' => 6, 'field' => 'per_amt'),
    array('db' => 'count(`st`.`store_id`) as received_qty', 'dt' => 7, 'field' => 'received_qty'),
    array('db' => '(`st`.`per_amt` * count(`st`.`store_id`)) as total_rate', 'dt' => 9, 'field' => 'total_rate'),
    array('db' => '`st`.`received_date`', 'dt' => 10, 'field' => 'received_date', 'formatter' => function ($d, $row) {
        return date('d-M-Y', strtotime($d));
    })
);

// SQL server connection information
$sql_details = array(
    'user' => Database::$user,
    'pass' => Database::$pass,
    'db'   => Database::$dbname,
    'host' => Database::$host
);

require('../lib/joinssp.class.php' );


$joinQuery = "FROM `store_entry` AS `st` 
INNER JOIN `grb` AS `g` ON (`g`.`grb_no` = `st`.`grb_id`)
INNER JOIN `work_order` AS `wo` ON (`wo`.`wo_id` = `st`.`po_id`)
INNER JOIN `suplier` AS `s` ON (`s`.`sup_id` = `wo`.`suplier_id`)";

$extraWhere = "`wo`.`active_record` = 1 AND `s`.`active_record` = 1 AND `st`.`dep` = 0";
$groupBy = "`wo`.`prod_name`";
$having = "";

echo json_encode(
    JOINSSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
