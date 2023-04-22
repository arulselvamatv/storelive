<?php



require_once("database/connect.php");

$db=new Database;

$db->connect();

if(session_status()===PHP_SESSION_NONE){session_start();}

 try

{ 

    if($_POST['dep_name']==""){

        echo "Error! Department Name Missing Try Again"; exit;

    }

    if($_POST['usr_name']==""){

        echo "Error! User Name Missing Try Again"; exit;

    }

    if($_POST['pass']==""){

        echo "Error! Password Missing Try Again"; exit;

    }

    $dep_name=$_POST['dep_name'];

    $usr_name=$_POST['usr_name'];

    $pass=$_POST['pass'];

    $emp_dataa =$db->query('SELECT (count(`id`)) FROM clientusers where `email`= "'.$usr_name.'"');

    $resulta = $emp_dataa->fetch();

    $counta = $resulta[0];

    $emp =$db->query('SELECT (count(cu.`id`)) FROM clientusers as cu 

                    INNER join client as c on c.cl_id=cu.dep_name

                    where cu.`dep_name`= "'.$dep_name.'"');

    $resu = $emp->fetch();

    $coun = $resu[0];

    if($counta != 0)

		{

            

            echo "Error! ".$usr_name." Already Exists Try Again"; exit;

            

        }

    elseif($coun != 0){

        echo "Error! ".$dep_name." Already Exists Try Again"; exit;

    }

    else{

       // echo "hii"; exit;

		$field_values=array();

		$field_values[0]=htmlentities(($_POST['dep_name']),ENT_QUOTES);

        $field_values[1]=htmlentities(($_POST['usr_name']),ENT_QUOTES);

        $field_values[2]=htmlentities(($_POST['pass']),ENT_QUOTES);

		

		

		

		$PRO_ID=$db->insertreturnid('clientusers',$field_values,"dep_name, email, pass");

		

		if($PRO_ID)

				{

                    echo "Client Details Stored Sucessfully."; exit;

                }

        else    {

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