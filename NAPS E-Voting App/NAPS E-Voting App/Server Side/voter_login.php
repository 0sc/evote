<?
	 require 'scripts/authenticate.php';
	 $registered = authorized(false);
	 
	 if(!$registered){
		 //send to registration page
		 header ('location: index.php');
		 exit;
	 }
	 
	 $_SESSION['user_data'] = NULL;
?>

<html><head></head>
<body>
	 <? getNotification('login');?>
	 <form action ='scripts/user.php' method='post'>
		 <p><input type='text' name ='pin' required = 'required'/></p>
		 <? setToken(); ?>
		 <p><input type='submit' name='verify' value='enter'/></p>
	 </form>
</body>
</html>