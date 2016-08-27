<?
	 require 'scripts/authenticate.php';
	 $registered = authorized();
	 
	 if(!$registered){
		 //send to voter_login page
		 $info = '';
		 header('Location: voter_login.php');
		 exit;
	 }
	 $userData = $_SESSION['user_data'];
?>
<html><head></head>
<body>
	 Please confirm your Personal data
	 <p>Name: <?=$userData['last_name'].'&nbsp;'.$userData['first_name'];?></p>
	 <p>Matric: <?=$userData['matric'];?></p>
	 <p>Level: <?=$userData['level'];?></p>
	 <p></p>
	 <p><a href='./vote.php'>Confirm</a> &emsp;&emsp; <a href='voter_login.php'>Rebut</a></p>
</body>	
</html>