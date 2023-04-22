<?php 

//~ echo "<pre/>";print_r($_POST);exit;

// $code=base64_decode($_GET['dep_no']);

// echo $code;


$code = $_POST['code'];

require_once("database/connect.php");
$db=new Database;
$conn=$db->Connect();


// DB table to use
$table = 'store_entry';

// Table's primary key
$primaryKey = 'store_id';

$columns = array(
    array( 'db' => '`st`.`store_id`', 'dt' => 1, 'field' => 'store_id' ),
    array( 'db' => '`st`.`se_no`', 'dt' => 2, 'field' => 'se_no' ),
    array( 'db' => '`s`.`company_name`',   'dt' => 3, 'field' => 'company_name' ),
    array( 'db' => '`wo`.`prod_name`',     'dt' => 4, 'field' => 'prod_name'),
    
    array( 'db' => '`wo`.`product_spec`',     'dt' => 5, 'field' => 'product_spec'),
    
    array( 'db' => '`st`.`bill_date`',     'dt' => 6, 'field' => 'bill_date', 'formatter' => function( $d, $row ) {
        return date( 'd-M-Y', strtotime($d));
    }),
    array( 'db' => '`st`.`wrt_date`',     'dt' => 7, 'field' => 'wrt_date', 'formatter' => function( $d, $row ) {
        return date( 'd-M-Y', strtotime($d));
    }),
    array( 'db' => '`wo`.`po_no`',     'dt' => 8, 'field' => 'po_no'),
    array( 'db' => '`st`.`wrt_date`',     'dt' => 9, 'field' => 'wrt_date', 'formatter' => function( $d, $row ) {
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

require('lib/joinssp.class.php' );

$joinQuery = "FROM `store_entry` AS `st` 
INNER JOIN `work_order` AS `wo` ON (`wo`.`wo_id` = `st`.`po_id`)
INNER JOIN `suplier` AS `s` ON (`s`.`sup_id` = `wo`.`suplier_id`)";

//~ INNER JOIN `client` AS `c` ON (`c`.`cl_id` = `st`.`dep`)
//~ echo "<pre/>sql_details";print_r($joinQuery);

$extraWhere = "`wo`.`active_record` = 1 AND `s`.`active_record` = 1 AND `wo`.`dep_no` = '$code' AND`st`.`dep` = 0 AND `st`.`tranf` = 0 ";
$groupBy = "`st`.`se_no`";
$orderBy = "`st`.`store_id`";
$having = "";

echo json_encode(
    JOINSSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
