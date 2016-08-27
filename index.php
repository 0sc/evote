<?php
	 //check whether system is register and redirect appropriately
	 require 'scripts/authenticate.php';
	 $registered = authorized(false);
	 
	 if($registered){
		 //send to login page
		 header('location: voter_login.php');
		 exit;
	 }
?>

<?php include ("scripts/cHead.php"); ?>

	 <?php getNotification('registration'); ?>
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
				 <?php setToken(); ?>
				 <p><button class='button' type='submit'>Register</button></p>
			 </fieldset>
		 </form>
	 </div>
	 <?php include "scripts/footer.php"; ?>
</body>
</html>
<?php session_write_close(); ?>