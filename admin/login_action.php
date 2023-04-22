<?php 



session_start();



include("database/connect.php");

$db=new Database;

$db->connect();



$log_succ = "";



$log_err = "";



$_SESSION['login_time'] =""; 



if(isset($_POST['user_login']))



{

	//echo "hii"; exit;



	$user_name =  $_POST['user_name'];



	$user_pass = $_POST['user_pass'];



	$ip_address = $_SERVER['REMOTE_ADDR'];



	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));



	$log_date = $date->format('Y-m-d H:i:s');



	$dbsel_q1 = $db->query("select * from users where email='$user_name' and pass='$user_pass' and status='1'") or die("select query not working");



	$userlog_ct = $dbsel_q1->fetch();

	$userlog_cnt = $userlog_ct[0];



	if($userlog_cnt>0)



	{

		

		//$sel_res1 = $dbsel_q1->fetch();



		$user_id = $userlog_ct['id'];

		//echo $user_id; exit;



		$_SESSION['user_log_id'] = $user_id;



		$_SESSION['user_log_email'] = $userlog_ct['email'];

        $_SESSION['user_log_type'] = $userlog_ct['user_type'];

		$_SESSION['login_time'] = time();



		$log_update = $db->query("update users set log_status='1',login_ip='$ip_address',last_login='$log_date' where id='$user_id'") or die("login date and time update not working!");



		if($log_update)



		{

			//echo "hii"; exit;



			header("Location:index.php");exit;



			//var_dump($sel_res1);



		}



		else



		{



			header("Location:login.php?log_err=1"); exit;



		}



		



	}



	else



	{



		//$log_err =  "<p style='color:#ff0000'> Invalid user name and password </p> ";



		header("Location:login.php?log_err=1"); exit;



	}



}







if(!empty($_REQUEST['userlog_out']))



{



	$user_id = $_SESSION['user_log_id'];



	$log_update = $db->query("update users set log_status='0' where id='$user_id'") or die("session timeout logout update date and time update not working!");



	if($log_update)



	{



		unset($_SESSION['user_log_id']);



		unset($_SESSION['user_log_email']);



		session_destroy();



		header("Location:../login.php");exit;



	}







}







function val_encryt($string) {



    // you may change these values to your own



    $secret_key = 'AnandTechverce';



    $secret_iv = 'my_simple_secret_iv';







    $output = false;



    $encrypt_method = "AES-256-CBC";



    $key = hash( 'sha256', $secret_key );



    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );



   



    $output = base64_encode(openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );



    



    return $output;



}







function val_decrypt($string) {



	// you may change these values to your own



	$secret_key = 'AnandTechverce';



	$secret_iv = 'my_simple_secret_iv';







	$output = false;



	$encrypt_method = "AES-256-CBC";



	$key = hash( 'sha256', $secret_key );



	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );



	$output = openssl_decrypt( base64_decode($string), $encrypt_method, $key, 0, $iv );







	return $output;



}







function user_log_vals()



{



	if(!isset($_SESSION['user_log_id']))



	{



		header("Location:login.php");



	}



}



function active_status($status)



{



	if($status==1)



	{



		return "Active";



	}



	else if($status==0)



	{



		return "<span style='color:yellow'>Inactive</span>";



	}



	else if($status ==2)



	{



		return "<span style='color:red'>Deleted</span>";



	}



	else



	{



		return "None";



	}



}









if(!empty($_GET['blog_id']))



{



	$blog_id = $_GET['blog_id'];



	$process = $_GET['process'];



	if($process =="delete")



	{



		$dbupd_q1 = $db->query("update blogs set status='2' where id='$blog_id'") or die("mysql delete query not working");



		if($dbupd_q1)



		{



			echo "<span style='color:red'> Your blog deleted successfully!</span>";



		}



		else



		{



			echo "<span style='color:red'> We can not able to delete your record! </span>";



		}



	}



	else if($process =="status_update")



	{



		if($_GET['status_msg']==1)



		{



			$dbupd_q1 = $db->query("update blogs set status='0' where id='$blog_id'") or die("mysql delete query not working");



			if($dbupd_q1)



			{



				echo "<span style='color:orange'> Your blog has been Inactivated! </span>";



			}



			else



			{



				echo "<span style='color:red'> We can not able to activate your record! </span>";



			}



		}



		if($_GET['status_msg']==0)



		{



			$dbupd_q1 = $db->query("update blogs set status='1' where id='$blog_id'") or die("mysql delete query not working");



			if($dbupd_q1)



			{



				echo "<span style='color:green'> Your blog activated successfully! </span>";



			}



			else



			{



				echo "<span style='color:red'> We can not able to activate your record! </span>";



			}



		}



	}



	



}



if(!empty($_GET['comm_ids']))

{



	$comm_ids = $_GET['comm_ids'];



	$process1 = $_GET['process1'];



	if($process1 =="delete1")



	{

		$dbupd_q1 = $db->query("delete from comments where id='$comm_ids'") or die("mysql delete query not working");



		if($dbupd_q1)



		{



			echo "<span style='color:red'> Your record deleted successfully!</span>";



		}



		else



		{



			echo "<span style='color:red'> We can not able to delete your record! </span>";



		}



	}



	else if($process1 =="status_update_com")



	{



		if($_GET['acts']==1)



		{



			$dbupd_q1 = $db->query("update comments set isactive='0' where id='$comm_ids'") or die("mysql delete query not working");



			if($dbupd_q1)



			{



				echo "<span style='color:orange'> Your Comments has been Inactivated! </span>";



			}



			else



			{



				echo "<span style='color:red'> We can not able to activate your record! </span>";



			}



		}



		if($_GET['acts']==0)



		{



			$dbupd_q1 = $db->query("update comments set isactive='1' where id='$comm_ids'") or die("mysql delete query not working");



			if($dbupd_q1)



			{ 



				echo "<span style='color:green'> Your Comments activated successfully! </span>";



			}



			else



			{



				echo "<span style='color:red'> We can not able to activate your record! </span>";



			}



		}



	}

   

}



 



// inactive in seconds



$inactive = 10*60;



if( !isset($_SESSION['timeout']) )



$_SESSION['timeout'] = time() + $inactive; 



$session_life = time() - $_SESSION['timeout'];



if($session_life > $inactive)



{  



	$user_id = $_SESSION['user_log_id'];



	$log_update = $db->query("update users set log_status='0' where id='$user_id'") or die("session timeout logout update date and time update not working!");



	if($log_update)



	{



		unset($_SESSION['user_log_id']);



		unset($_SESSION['user_log_email']);



		session_destroy();



		header("Location:login.php?ses_exp=1");



	}



	    



}







$_SESSION['timeout']=time();







?>