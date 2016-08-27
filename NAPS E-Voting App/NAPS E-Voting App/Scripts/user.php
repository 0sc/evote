<?
	 require 'authenticate.php';
	 
	 if(empty($_POST['token']) || !verifyToken($_POST['token'])){
		 //header('location: ../voter_login.php'); //refuse access
	 }
	 
	 //check if system is registered
	 $registered = authorized(false);
	 if(!$registered){
		 $_SESSION['nofication']['registration'] = array('info' => 'Authorization is required for that action', 'type' => 'error');
		 header('location: ../');
		 exit;
	 }
	 
	 $pin = empty($_POST['pin'])? '' : sanitize($_POST['pin']);
	 $pin = strrev($pin);
	 
	 $query = mysql_query("SELECT voters.id, first_name, last_name, matric, level, used FROM voters, pins WHERE pin = '$pin' AND student_Id = voters.id") or die('Pin not found '.mysql_error());
	 
	 if(mysql_num_rows($query) !== 1){
		 $info = 'Error ! The pin you entered is invalid. Please try again. If problems persist please contact the Electoral Chairman.';
		 $_SESSION['notification']['login'] = array('info'=>$info, 'type' => 'error');
		 
		 session_write_close();
		 header('Location: ../voter_login.php');
		 sexit;
	 }
	 
	 $query = mysql_fetch_assoc($query);
	 $stu_Id= $query['id'];

	 if($query['used'] == 'TRUE'){ //pin has been used
		 $timeUsed = mysql_query("SELECT time FROM votes WHERE student_Id = $stu_Id") or die(mysql_error());
		 
		 $timeUsed = mysql_fetch_assoc($timeUsed);
		 $timeUsed = date('h:i A',$timeUsed['time']);
		 
		 $info = "Hello {$query['first_name']}! You've already voted. Your vote was cast xxx ago ($timeUsed)";
		 $_SESSION['notification']['login'] = array('info' => $info, 'type' => 'error');
		 
		 session_write_close();
		 header('Location: ../voter_login.php');
		 exit;
	 }
	 
	 //allow user
	 $_SESSION['user_data']['student_Id'] = $stu_Id;
	 $_SESSION['user_data']['matric']	= $query['matric'];
	 $_SESSION['user_data']['level']	= $query['level'];
	 $_SESSION['user_data']['last_name']= $query['last_name'];
	 $_SESSION['user_data']['first_name']=$query['first_name'];
	 
	 $_SESSION['nofication']['vote'] = array('info' => 'Welcome!', 'type' => 'success');
	 session_write_close();
	 header('location: ../voter_verification.php');
	 exit;
?>