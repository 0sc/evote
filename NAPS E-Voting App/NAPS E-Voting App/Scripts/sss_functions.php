<?
	 //security functions
	 
	 function verifyUser(){
		 if(
			 !empty($_SESSION['user_data']) &&
			 !empty($_SESSION['user_data']['student_Id'])
		 ) return true;
		 
		 //failed
		 $_SESSION['user_data'] = NULL;
		 return false;
	 }
	 
	 function verifySystem(){
		 $registered = false;
		 
		 $registered = isset($_SESSION['system']) && $_SESSION['system']['isRegistered'] && !empty($_SESSION['system']['sys_id']);
		 
		 if($registered) return true;
		 
		 //else check for cookie
		 if (isset($_COOKIE['napscom'])){
			 $ckie = sanitize($_COOKIE['napscom']);
			 $ckie = decrypt($ckie);
			 $ckie = explode('*~!~*',$ckie);
			 
			 $query = mysql_query("SELECT id FROM systems WHERE owner = '{$ckie[0]}' AND time = '{$ckie[1]}'") or die('System not found '.mysql_error());
			 
			 if(mysql_num_rows($query) === 1){
				 //re-register system
				 $query = mysql_fetch_assoc($query);
				 
				 $_SESSION['system']['isRegistered'] = true;
				 $_SESSION['system']['sys_id'] = $query['id'];
				 session_write_close();
				 return true;
			 }
		 }
		 
		 //here system is not registered
		 $_SESSION['system'] = NULL;

		 return false;
	 }
?>