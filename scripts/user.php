<?php
	 require 'authenticate.php';
	 
	 if(empty($_POST['token']) || !verifyToken($_POST['token'])){
		 $_SESSION['notification']['login'] = array('info' => 'Unverified login attempt. Please try again.', 'type' => 'error');
		 header('location: ../voter_login.php'); //refuse access
	 }
	 
	 //check if system is registered
	 $registered = authorized(false);
	 if(!$registered){
		 $_SESSION['notification']['registration'] = array('info' => 'Authorization is required for that action', 'type' => 'error');
		 header('location: ../');
		 exit;
	 }
	 
	 $pin = empty($_POST['pin'])? '' : sanitize($_POST['pin']);
	 
	 $pin = trim(strtolower($pin));
	 //echo $pin;
	 $pin = mysql_real_escape_string(md5($pin,'#$%GOD&^*~')); 
	 //echo $pin; exit;
	 $query = mysql_query("SELECT voters.id, surname, other_name, matric, level, used FROM voters, pins WHERE pin = '$pin' AND student_Id = voters.id") or die('Pin not found '.mysql_error());
	 
	 if(mysql_num_rows($query) !== 1){
		 $info = 'Error ! The pin you entered is invalid. Please try again. If problems persist please contact the Electoral Chairman.';
		 $_SESSION['notification']['login'] = array('info'=>$info, 'type' => 'error');
		 
		 session_write_close();
		 header('Location: ../voter_login.php');
		 exit;
	 }
	 
	 $query = mysql_fetch_assoc($query);
	 $stu_Id= $query['id'];
	 
	 if($query['used'] == 'TRUE'){ //pin has been used
		 
		 $timeUsed = mysql_query("SELECT time FROM votes WHERE student_Id = $stu_Id") or die(mysql_error());
		 
		 $timeUsed = mysql_fetch_assoc($timeUsed);
		 
		 require 'time_function.php';
		 $secsDiff = getTimeDifference(time() - $timeUsed['time']);
		 
		 $timeUsed = date('h:i A',$timeUsed['time']);
		 
		 $name = explode(' ',$query['other_name']);
		 $name = $name[0];
		 $info = "Hello $name! You've already voted.<br />Your vote was cast <b>$secsDiff</b> ago (at <b>$timeUsed</b>)";
		 
		 $_SESSION['notification']['login'] = array('info' => $info, 'type' => 'error');
		 
		 session_write_close();

		 header('Location: ../voter_login.php');
		 exit;
	 }
	 
	 //allow user
	 $_SESSION['user_data'] = $query;
	 $_SESSION['user_data']['student_Id'] = $stu_Id;
	 $_SESSION['user_data']['verified'] = false;
	 
	 $_SESSION['notification']['vote'] = array('info' => 'Welcome!', 'type' => 'success');
	 session_write_close();
	 header('location: ../voter_verification.php');
	 exit;
?>