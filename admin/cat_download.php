<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Category View</title>

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

$category_name=$_GET['unit'];

 //echo $category_name;exit;

  echo '<section>
        <div class="container">
            <div class="row py-3">
                <div class="col-lg-12">
                    <h2 class="text-center">Category Name : '.$category_name.'</h2>
                <br>    <table class="table table-bordered"> 
                        <tbody align="center">
                          
                          

                            <tr> 
                                <td>S No. </td>
                                <td>Category Name</td>
                                <td>Products type </td>
                                <td>Product Code </td>
                                <td>product name </td>
                                <td>Product Desctiption</td>
                                <td>unit</td>
                                 
                              
                            </tr>';

$asd =('SELECT pd.`pro_id`, pd.`cat_name`, pd.`pro_ty`, pd.`active_record`, pd.`date_time`, pdi.`proi_id`, pdi.`pro_id`, pdi.`pro_code`,
   pdi.`pro_name`, pdi.`pro_desc`, pdi.`unit`, pdi.`active_record`, (pdi.`date_time`) as date FROM `product_details`as pd
   inner join product_details_info as pdi on pdi.pro_id= pd.pro_id where pd.active_record=1 and pdi.active_record=1 and  `cat_name` = "'.$category_name.'" ');
 
//echo $asd;exit;

   $data = $db->query($asd);
   $i=0;
     while($row = $data->fetch(PDO::FETCH_ASSOC))
   
            { 
              $i++;  
         	$cat_name = $row['cat_name'];
         	$pro_ty = $row['pro_ty'];
         	$pro_code = $row['pro_code'];
         	$pro_name = $row['pro_name'];
         	$pro_desc = $row['pro_desc'];
         		$unit = $row['unit'];
        
           
          
                             echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'.$cat_name.'</td>
                                <td>'.$pro_ty.'</td>
                                <td>'.$pro_code.'</td>
                                <td>'.$pro_name.'</td>
                                <td>'. $pro_desc.'</td>
                                <td>'. $unit.'</td>
                               
                              
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