<?
	 session_start();
	 require 'data_functions.php';
	 require 'mobile_detect.php';
	 
	 if(empty($_POST['token']) || !verifyToken($_POST['token'])){
		 header('location: ../'); //refuse access
	 }
	 
	 require 'conf.inc.php';
	 
	 $fields = array('owner','adminPass');
	 foreach($fields as $data) 
		 $_POST[$data] = empty($_POST[$data])? '' : sanitize($_POST[$data]);
		 
	 $adminPass = md5($_POST['adminPass']);
	 $owner		= $_POST['owner'];
	 $error 	= '';
	 
	 $check = mysql_query("SELECT id FROM admin WHERE password = '$adminPass'") or die('System registration error '.mysql_error());
	 
	 if(mysql_num_rows($check) !== 1 || empty($owner)) $error = 'Invalid registration data. Please contact an admin for assistance.';
	 
	 if(!empty($error)){
		 $_SESSION['notification']['registration'] = array('info' => $error, 'type' => 'error');
		 session_write_close();
		 header('Location: ../');
	 }
	 
	 //all is well at this point
	 //let's register the system
	 $check = mysql_fetch_assoc($check);
	 $adminId = $check['id'];
	 $time 	= time();
	 $platform = 'PC';
	 if(isMobile()) $platform = 'MOBILE';
	 
	 mysql_query("INSERT INTO systems (owner,authorizer,time,type) VALUES ('$owner','$adminId',$time,'$platform')") or die('Oops! could not register system '.mysql_error());
	 
	 $sysId = mysql_insert_id();
	 $_SESSION['system']['isRegistered'] = true;
	 $_SESSION['system']['sys_id'] = $sysId;
	 $_SESSION['system']['type']   = $platform;
	 
	 //save cookie
	 if($platform == 'PC'){
		 $exp = mktime(16,0,0,date('m'),date('d'),date('Y'));
		 $data = decrypt("$owner*~!~*$time",false);
		 setcookie("napscom","$data",$exp,"/");
	 }
	 
	 $_SESSION['notification']['login'] = array('info' => 'System was registered successfully.', 'type' => 'success');
	 session_write_close();
	 header('Location: ../voter_login.php');
?>