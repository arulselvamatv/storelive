<?php 
require_once("../database/connect.php");

$client_log_id = $_POST['user_log_id'];

// DB table to use
$table = 'store_entry';

// Table's primary key
$primaryKey = 'store_id';

$columns = array(
    array( 'db' => '`st`.`store_id`', 'dt' => 1, 'field' => 'store_id' ),
    array( 'db' => '`st`.`se_no`', 'dt' => 2, 'field' => 'se_no' ),
    array( 'db' => '`c`.`dep_name`',  'dt' => 3, 'field' => 'dep_name' ),
    array( 'db' => '`s`.`company_name`',   'dt' => 4, 'field' => 'company_name' ),
    array( 'db' => '`wo`.`prod_name`',     'dt' => 5, 'field' => 'prod_name'),
    array( 'db' => '`st`.`bill_date`',     'dt' => 6, 'field' => 'bill_date', 'formatter' => function( $d, $row ) {
        return date( 'd-M-Y', strtotime($d));
    }),
    array( 'db' => '`st`.`wrt_date`',     'dt' => 7, 'field' => 'wrt_date', 'formatter' => function( $d, $row ) {
        return date( 'd-M-Y', strtotime($d));
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
INNER JOIN `suplier` AS `s` ON (`s`.`sup_id` = `wo`.`suplier_id`)
INNER JOIN `client` AS `c` ON (`c`.`cl_id` = `st`.`dep`)
INNER JOIN `clientusers` AS `cu` ON (`cu`.`dep_name` = `c`.`cl_id`)";

$extraWhere = "`wo`.`active_record` = 1 AND `s`.`active_record` = 1 AND `st`.`dep` != 0 AND `st`.`tranf` = 0 AND `cu`.`id` = '".$client_log_id."'";
$groupBy = "`st`.`se_no`";
$having = "";

echo json_encode(
    JOINSSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);