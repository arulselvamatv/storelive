<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no    = $_REQUEST['po_no'];
$clinet = '';
$date = '';
if( $po_no != 1 ) {
    $from_date= $_REQUEST['from_date'];
    $to_date  = $_REQUEST['to_date'];
    $client_name = $_REQUEST['client_name'];

	if( !empty( $from_date ) && !empty( $to_date ) ) {
		$date = " AND s.crn_date_time between '". $from_date ."' and '". $to_date ."' ";
	}
    
    if( empty( $to_date ) && isset( $from_date ) && !empty( $from_date ) ) {
        $date = " AND DATE( s.crn_date_time ) = '". $from_date ."'";
    }

	if(empty( $from_date ) &&  isset( $to_date ) && !empty( $to_date ) ) {
		$date = " AND DATE( s.crn_date_time ) = '". $to_date ."' ";
	} 
    
    if( isset( $client_name ) && !empty( $client_name ) ) {
        $clinet = " AND s.dep_name = " . $client_name;
    }
}

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT * FROM store_list as s 
		INNER join client as c on c.cl_id =s.dep_name
		WHERE s.`active_record` =1 and s.`active_record` =1 '. $clinet .' '. $date .' group by s.prod_name');
		//echo $asd; exit;
		$e=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
			++$e;
			echo '<tr>'.
			'<th>'.
			$e.
			'</th>'.
			'<th>'.
			$prd['crn_date_time'].
			'</th>'.
			'<th>'.
			$prd['dep_name'].
			'</th>'.
			'<th>'.$prd['prod_name'].
			'</th>'.
			'<th>'.$prd['ddl_pro_qty'].
			'</th>'.
			'</tr>';
		}
		if( $e == 0 ) {
            echo '<tr><th colspan="5">No data to display.</th></tr>';
        }
	}
	

	
	    
?>
<!-- <script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script> -->
