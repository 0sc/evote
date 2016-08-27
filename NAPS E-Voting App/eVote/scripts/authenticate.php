<?
	 //take of necessary authentications
	 session_start();
	 
	 require 'sss_functions.php';
	 require 'data_functions.php';
	 require 'conf.inc.php';
	 
	 function authorized($userSide=true){
		 managePlatforms();
		 
		 $allow = verifySystem();
		 
		 if(!$allow) return false; //failed
		 
		 if($userSide) $allow = verifyUser();
		 
		 return $allow;
	 }
	 
	 function managePlatforms(){ //use to deactivate handhelds
		 if(isset($_SESSION['timeout']) && $_SESSION['timeout']){
			 $_SESSION['system'] = NULL;
			 $_SESSION['user_data'] = NULL;
		 }
	 }
?>