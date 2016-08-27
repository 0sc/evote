<?
	 require 'scripts/authenticate.php';
	 $registered = authorized();
	 
	 if(!$registered){
		 //send to voter_login page
		 $info = '';
		 header('Location: voter_login.php');
		 exit;
	 }
?>
