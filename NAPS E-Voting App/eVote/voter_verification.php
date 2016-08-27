<?
	 require 'scripts/authenticate.php';
	 $registered = authorized();
	 
	 if(!$registered){
		 //send to voter_login page
		 $info = 'Unauthorized Verification attempt. Please try again.';
		 $_SESSION['notification']['login'] = array('info' => $info, 'type' => 'error');
		 header('Location: voter_login.php');
		 exit;
	 }
	 $userData = $_SESSION['user_data'];
	 
	 if($userData['verified']) header("Location: vote.php");
?>
<html>
<head>
	  <link rel="stylesheet" href="./css/css.css" type="text/css" />
	  <link rel="stylesheet" href="./css/forms.css" type="text/css" />
</head>
<body>
	 <div id="registration">
		 <fieldset>
			 <h2>Please confirm your Personal data</h2>
			 <p>Name:&emsp;<?=$userData['surname'].'&nbsp;'.$userData['other_name'];?></p>
			 <p>Matric:&emsp;<?=$userData['matric'];?></p>
			 <p>Level:&emsp;<?=$userData['level'];?></p>
			 <p>&emsp;</p>
			 <p><center><a href='./vote.php' class='button'>Ok</a> &emsp;&emsp; <a href='voter_login.php' class='button wrong'>Wrong</a></center></p>
		 </fieldset>
	 </div>
</body>	
</html>