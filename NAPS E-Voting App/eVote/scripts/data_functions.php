<?
	 function sanitize($txt){
		 global $db;
		 
		 $txt = htmlentities($txt);
		 if ( get_magic_quotes_gpc() ) {
			 $txt = addslashes($txt);
		 }
		 return mysql_real_escape_string(trim($txt),$db);
	 }
	 
	 function getNotification($section){
		 if(isset($_SESSION['notification'][$section])){
			 $styleClass = $_SESSION['notification'][$section]['type'];
			 $message = $_SESSION['notification'][$section]['info'];
			 
			 echo "<div class='$styleClass'>$message</div>";
			 unset($_SESSION['notification'][$section]);
		 }
		 return;
	 }
	 function decrypt($txt,$action=true){
		 //if false encrypt
		 $txt = trim($txt);
		 
		 if(!$action) $txt = base64_encode($txt);
		 
		 else if($action) $txt = base64_decode($txt);
		 
		 return trim($txt);
	 }
	 
	 function setToken(){
		 $token = sha1(mt_rand());
		 if(!isset($_SESSION['tokens'])){
			 $_SESSION['tokens'] = array($token => 1);
		 }
		 else{
			 $_SESSION['tokens'][$token] = 1;
		 }
		 echo "<input type='hidden' name='token' value ='$token' />";
		 return;
	 }
	 
	 function verifyToken($token){
		 if(!empty($_SESSION['tokens'][$token])){
			 unset($_SESSION['tokens'][$token]);
			 return true;
		 }
		 return false;
	 }
?>