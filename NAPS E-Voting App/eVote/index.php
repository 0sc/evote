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

<html>
	 <head>
		 <link rel="stylesheet" href="./css/css.css" type="text/css" />
		 <link rel="stylesheet" href="./css/forms.css" type="text/css" />
		 <script type="text/javascript" src="./js/jquery.min.js"></script>
		 <script type="text/javascript" src="./js/forms.js"></script>
	 </head>
<body>
	 <? getNotification('registration'); ?>
	 <div id="registration">
		 <h2>Please Register this device</h2>
		 <form action='scripts/system.php' method='post' id="RegisterUserForm">
			 <fieldset>
				 <p>
					 <label for="name">System Owner</label>
					 <input type='text' name='owner' required ='required' class="text" id="name"/>
				 </p>
				 <p>
					 <label for="password">Admin Authorization</label>
					 <input type='password' name='adminPass' required='required' class="text" id="password"/>
				 </p>
				 <? setToken(); ?>
				 <p><button class='button' type='submit'>Register</button></p>
			 </fieldset>
		 </form>
	 </div>
</body>
</html>
<? session_write_close(); ?>