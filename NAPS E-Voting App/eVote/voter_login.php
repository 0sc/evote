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

<html>
<head>
		 <link rel="stylesheet" href="./css/css.css" type="text/css" />
		 <link rel="stylesheet" href="./css/forms.css" type="text/css" />
		 <script type="text/javascript" src="./js/jquery.min.js"></script>
		 <script type="text/javascript" src="./js/forms.js"></script>
</head>
<body>
	 <? getNotification('login');?>
	 <div id='registration'>
	 <h2>Enter your Voting pin</h2>
	 <form action ='scripts/user.php' method='post' id="RegisterUserForm">
		 <fieldset>
		 <p>
			 <label for="password">Enter Your voting pin</label>
			 <input type='text' name ='pin' required = 'required' id='password' class='text'/>
		 </p>
		 <? setToken(); ?>
		 <p><input type='submit' name='verify' class='button' value='Proceed'/></button>
		 </fieldset>
	 </form>
	 </div>
</body>
</html>