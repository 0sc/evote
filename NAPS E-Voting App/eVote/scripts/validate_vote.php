<?
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
	 $_SESSION['notification']['login'] = array("info" => $_SESSION['user_data']['last_name'].' thank you for voting. Your vote has been processed successful. You may exit now.', 'type' => 'success');
	 $_SESSION['user_data'] = NULL;
	 
	 header("Location: ../");
?>