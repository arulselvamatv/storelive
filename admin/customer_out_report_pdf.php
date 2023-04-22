<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">



    <title>Store Out Report</title>



    <style>

        table,

        td,

        tr {

            border: 1px solid black;

        }

    </style>

</head>

<body>

    

<?php



require_once("database/connect.php");



$db=new Database;



$db->connect();



$po_no    = $_REQUEST['po_no'];

$clinet = '';

$date = '';



if( $po_no != 1 ) 

{

    $from_date= $_REQUEST['from_date'];

    $to_date  = $_REQUEST['to_date'];

    $client_name = $_REQUEST['client_name'];



	if( !empty( $from_date ) && !empty( $to_date ) )

	{

		$date = " AND s.crn_date_time between '". $from_date ."' and '". $to_date ."' ";

	}

    

    if( empty( $to_date ) && isset( $from_date ) && !empty( $from_date ) ) 

    {

        $date = " AND DATE( s.crn_date_time ) = '". $from_date ."'";

    }



	if(empty( $from_date ) &&  isset( $to_date ) && !empty( $to_date ) ) 

	{

		$date = " AND DATE( s.crn_date_time ) = '". $to_date ."' ";

	} 

    

    if( isset( $client_name ) && !empty( $client_name ) ) 

    {

        $clinet = " AND s.dep_name = " . $client_name;

    }

}



  echo '<section>

        <div class="container">

            <div class="row py-3">

                <div class="col-lg-12">

                    <h2 class="text-center">Store Out Report</h2>

                <br>    <table class="table table-bordered"> 

                        <tbody align="center">

                          

                          



                            <tr> 

                                <td>S No. </td>

                                <td>Date</td>

                                <td>Client Name</td>

                                <td>Product Name</td>

                                <td>Qty</td>

                                

                            </tr>';



$asd =('SELECT * FROM store_list as s 

		INNER join client as c on c.cl_id =s.dep_name

		WHERE s.`active_record` =1 and s.`active_record` =1 '. $clinet .' '. $date .' group by s.prod_name ');

 

//echo $asd;exit;



   $data = $db->query($asd);

   $i=0;

     while($row = $data->fetch(PDO::FETCH_ASSOC))

   

            { 

              $i++;  

         	$crn_date_time = $row['crn_date_time'];

         	$dep_name = $row['dep_name'];

         	$prod_name = $row['prod_name'];

         	$ddl_pro_qty = $row['ddl_pro_qty'];

        //   echo $crn_date_time;exit;

          

                             echo '<tr> 

                                <td>'.$i.'</td>

                                <td>'.$crn_date_time.'</td>

                                <td>'.$dep_name.'</td>

                                <td>'.$prod_name.'</td>

                                <td>'.$ddl_pro_qty.'</td>

                            </tr>';

               

            }



                

            

       



                        echo '</tbody>

                    </table>

 

                </div>

            </div>

        </div> 

    </section>'

 	?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    

    

</body>



</html>

















<!--<!?php-->

<!--require_once("../database/connect.php");-->

<!--$db=new Database;-->

<!--$con=$db->connect();-->



<!--$po_no    = $_REQUEST['po_no'];-->

<!--$supplier = '';-->

<!--$date = '';-->

<!--if( $po_no != 1 ) {-->

<!--    $from_date= $_REQUEST['from_date'];-->

<!--    $to_date  = $_REQUEST['to_date'];-->

<!--    $sup_name = $_REQUEST['sup_name'];-->



    

<!--    if( !empty( $from_date ) && !empty( $to_date ) ) {-->

<!--		$date = " AND wo.date_time between '". $from_date ."' and '". $to_date ."' ";-->

<!--	}-->

    

<!--    if( empty( $to_date ) && isset( $from_date ) && !empty( $from_date ) ) {-->

<!--        $date = " AND DATE( wo.date_time ) = '". $from_date ."'";-->

<!--    }-->



<!--	if(empty( $from_date ) &&  isset( $to_date ) && !empty( $to_date ) ) {-->

<!--		$date = " AND DATE( wo.date_time ) = '". $to_date ."' ";-->

<!--	} -->

    

<!--    if( isset( $sup_name ) && !empty( $sup_name ) ) {-->

<!--        $supplier = " AND wo.suplier_id = " . $sup_name;-->

<!--    }-->

<!--}-->



<!--$HTML="";-->

<!--	if($con)-->

<!--	{-->

		

		

<!--		$asd =('SELECT wo.suplier_id as suplier_id, s.name as supplier_name,(wo.prod_name) as item_name,wo.ddl_pro_qty, wo.date_time as `po_date` -->

<!--        FROM work_order as wo-->

<!--		INNER join suplier as s on s.sup_id =wo.suplier_id-->

<!--		WHERE wo.`active_record` =1 '. $supplier .' '. $date .' group by wo.prod_name');-->

		

		<!--//echo $asd; exit;-->

<!--		$e=0;-->

<!--		$prdt_data = $db->query($asd);-->

<!--            while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))-->

<!--            {-->

<!--                ++$e;-->

<!--                echo '<tr>'.-->

<!--                '<th>'.-->

<!--                $e.-->

<!--                '</th>'.-->

<!--                '<th>'.-->

<!--                $prd['po_date'].-->

<!--                '</th>'.-->

<!--                '<th>'.-->

<!--                $prd['supplier_name'].-->

<!--                '</th>'.-->

<!--                '<th>'.$prd['item_name'].-->

<!--                '</th>'.-->

<!--                '<th>'.$prd['ddl_pro_qty'].-->

<!--                '</th>'.-->

<!--                '</tr>';-->

<!--            }-->

            

<!--        if( $e == 0 ) {-->

<!--            echo '<tr><th colspan="5">No data to display.</th></tr>';-->

<!--        }-->

<!--	}-->

	



	

	    

<!--?>-->

<!--

