<?php
	 require 'authenticate.php';
	 
	 if(empty($_POST['token']) || !verifyToken($_POST['token'])){
		 //$_SESSION['notification']['lockdown'] = array('info' => 'Unverified login attempt. Please try again.', 'type' => 'error');
		 //header('location: ../voter_login.php'); //refuse access
	 }
	 
	 $password = empty($_POST['password'])? '' : sanitize($_POST['password']);
	 $password = md5($password);
	 
	 mysql_query("UPDATE jega SET published = 'TRUE' WHERE password = '$password'") or die('Invalid Request '.mysql_error());
	 
	 $done = mysql_affected_rows() === 1;
	 
	 if(!$done){
		 //password error
		 $_SESSION['notification']['lockdown'] = array('info'=> 'Invalid authorization password. Please try again!', 'type' => 'error');
		 
		 header('Location: ../lockdown.php');
		 exit;
	 }
	 
	 //results published
	 header("Location: results.php");
?>