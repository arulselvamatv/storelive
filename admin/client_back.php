<?php



require_once("database/connect.php");

$db=new Database;

$db->connect();

if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 

    if($_POST['dep_name'] == "" )

    {

        echo "Error! Department Name Missing Try Again"; exit; 

    }

    elseif($_POST['block'] == "" ){

        echo "Error! Block NO Missing Try Again"; exit;

    }

     elseif($_POST['room_no'] == "" ){

        echo "Error! Room No Missing Try Again"; exit;

    }



    // if($_POST['room_no'] == "" )

    // {

    //     echo "Error! Room No Missing Try Again"; exit; 

    // }

    // elseif($_POST['dep_name'] == "" ){

    //     echo "Error! Department Name Missing Try Again"; exit;

    // }

    //  elseif($_POST['block'] == "" ){

    //     echo "Error! Block NO Missing Try Again"; exit;

    // }

    $dep_name=$_POST['dep_name'];

    $block=$_POST['block'];

    $room_no=$_POST['room_no'];

    $empt =$db->query('SELECT (count(dep_name)) FROM client where dep_name = "'.$dep_name.'" and block="'.$block.'" and room_no="'.$room_no.'" ');

    // echo 'SELECT (count(dep_name)) FROM client where dep_name = "'.$dep_name.'" and block="'.$block.'" and room_no="'.$room_no.'"'; exit;

    $result= $empt->fetch();

    $count = $result[0];

    // $room_no=$_POST['room_no'];

    

    //echo $emp_data; exit;

            //echo $datd; 

            

    if($count != 0)

	{   

        echo "Error! ".$dep_name." Already Exists Try Again"; exit; 

    }

    else

    {

        // echo "hii"; exit;

        $field_values=array();

        $field_values[0]=htmlentities(($_POST['dep_name']),ENT_QUOTES);

        $field_values[1]=htmlentities(($_POST['room_no']),ENT_QUOTES);

        $field_values[2]=htmlentities(($_POST['block']),ENT_QUOTES);

            

        $PRO_ID=$db->insertreturnid('client',$field_values,"dep_name, room_no, block");

            

        if($PRO_ID)

        {

            echo "Client Details Stored Sucessfully."; exit;

        }

        else    

        {

            echo "Error! Please try again."; exit;

        }

    }

		

}

catch(Exception $my_e)

{

	echo "err";

	echo $my_e->getMessage();

} 



?>