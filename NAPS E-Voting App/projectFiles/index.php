<?
	 //check whether system is register and redirect appropriately
	 require 'scripts/authenticate.php';
	 $registered = authorized(false);
	 
	 if($registered){
		 //send to login page
		 header('location: voter_login.php');
		 exit;
	 }
?>

<html><head></head>
<body>
	 <? getNotification('registration'); ?>
	 <form action='scripts/system.php' method='post'>
		 <p><input type='text' name='owner' required ='required' placeholder='Your name'/></p>
		 <p><input type='password' name='adminPass' required='required' placeholder='Admin authorization pls!'/></p>
		 <? setToken(); ?>
		 <p><input type='submit' name='register' value='register' /></p>
	 </form>
</body>
</html>
<? session_write_close(); ?>