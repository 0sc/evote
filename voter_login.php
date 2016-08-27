<?php
	 require 'scripts/authenticate.php';
	 
	 $registered = authorized(false);
	 
	 if(!$registered){
		 //send to registration page
		 $_SESSION['notification']['registration'] = array('type'=>'error', 'info' => 'Error! This system is not registered. Please request the attention of a systems\' admin for registration.');
		 header ('location: index.php');
		 exit;
	 }
	 
	 $_SESSION['user_data'] = NULL;
?>

<?php include ("scripts/cHead.php"); ?>
	 <?php getNotification('login');?>
	 <div id='registration'>
	 <h2>Enter your Voting pin</h2>
	 <form action ='scripts/user.php' method='post' id="RegisterUserForm">
		 <fieldset>
		 <p>
			 <label for="password">Enter Your voting pin</label>
			 <input type='text' name ='pin' required = 'required' id='password' class='text'/>
		 </p>
		 <?php setToken(); ?>
		 <p><input type='submit' name='verify' class='button' value='Proceed'/></p>
		 </fieldset>
	 </form>
	 </div>
	 <?php include "scripts/footer.php"; ?>
</body>
</html>