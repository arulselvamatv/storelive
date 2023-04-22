<?php

require_once("database/connect.php");

$db=new Database;

$db->connect();

if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 

    

    if($_POST['e_pass'] == "" )

    {

        echo "Error! Password Missing Try Again"; exit; 

    }

    

    $e_pass=$_POST['e_pass'];

    

    $e_dep_id=$_POST['e_dep_id'];     

   

        // echo "hii"; exit;

        $asd =('UPDATE `clientusers` SET `pass`="'.$e_pass.'" WHERE `id`="'.$e_dep_id.'"');

		$datd = $db->query($asd);

		if($datd)

					{

						echo "Client Password Updated Sucessfully."; exit;

					}

			else{

				echo "Error! Please try again."; exit;

			}

    

		

}

catch(Exception $my_e)

{

	echo "err";

	echo $my_e->getMessage();

} 



?>