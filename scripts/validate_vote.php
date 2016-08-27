<?php
	 require 'authenticate.php';
	 
	 if(empty($_POST['token']) || !verifyToken($_POST['token'])){
		 header('location: ../voter_login.php'); //refuse access
	 }
	 
	 //check if user is registered
	 $authorized = authorized();
	 if(!$authorized){
		 $_SESSION['notification']['login'] = array('info' => 'Access denied! Please try again.', 'type' => 'error');
		 header('location: ../voter_login.php');
		 exit;
	 }
	 
	 require 'election_posts.php';
	 $posts = getPosts();
	 $vote  = array();
	 
	 foreach($posts as $p) {
		 $vote[] = empty($_POST[$p])? '0' : $_POST[$p];
	 }
	 
	 $std_Id = $_SESSION['user_data']['student_Id'];
	 $sys_Id = $_SESSION['system']['sys_id'];
	 $time 	 = time();
	 
	 $query = 'INSERT INTO votes (student_id,time,system_Id,'.implode(',',$posts).") VALUES ('$std_Id','$time','$sys_Id',".implode(',',$vote).')';

	 mysql_query($query) or die('Error could not save vote '.mysql_error());
	 
	 //disable pin
	 $query = mysql_query("UPDATE pins SET used = 'TRUE' WHERE student_Id = $std_Id") or die('Error disabling pin '.mysql_error());
	 
	 //destroy session data
	 $name = explode(' ',$_SESSION['user_data']['other_name']);
	 $name = $name[0];
	 
	 $_SESSION['notification']['login'] = array("info" => $name.' thank you for voting. Your vote has been processed successful. You may exit now.', 'type' => 'success');
	 
	 $_SESSION['user_data'] = NULL;
	 
	 if($_SESSION['system']['type'] == 'MOBILE'){
		 $txt = $_SESSION['notification']['login'];
		 
		 session_destroy();
		 session_start();
		 
		 $_SESSION['notification']['registration'] = $txt;
	 }
	 
	 header("Location: ../");
?>