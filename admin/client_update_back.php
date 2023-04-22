<?php



require_once("database/connect.php");

$db=new Database;

$db->connect();

if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 

    

    if($_POST['e_room_no'] == "" )

    {

        echo "Error! Room No Missing Try Again"; exit; 

    }

     elseif($_POST['e_block'] == "" ){

        echo "Error! Block NO Missing Try Again"; exit;

    }

    $room_no=$_POST['e_room_no'];

    $block=$_POST['e_block'];

    $emp =$db->query('SELECT (count(room_no)) FROM client where room_no = "'.$room_no.'"');

    $resul= $emp->fetch();

    $coun = $resul[0];

    //echo $emp_data; exit;

    //echo $datd; 

    $e_cl_id=$_POST['e_cl_id'];     

    // if($coun != 0)

	// {   

    //     echo "Error! ".$room_no." Already Exists Try Again"; exit; 

    // }

    // else

    // {

        // echo "hii"; exit;

        $asd =('UPDATE `client` SET `room_no`="'.$room_no.'", `block`="'.$block.'" WHERE `cl_id`="'.$e_cl_id.'"');

		$datd = $db->query($asd);

		if($datd)

					{

						echo "Client Details Updated Sucessfully."; exit;

					}

			else{

				echo "Error! Please try again."; exit;

			}

    // }

		

}

catch(Exception $my_e)

{

	echo "err";

	echo $my_e->getMessage();

} 



?>