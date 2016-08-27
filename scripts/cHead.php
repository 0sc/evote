<?php  $endException = array('vote.php','results.php','lockdown.php','printPins.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->
	 <head>
		 <title>NAPS e-Voting &copy;Osmond, Tolu, Justin; 2013::v1.0</title>
		 <meta charset="utf-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		 <link rel="stylesheet" href="./css/css.css" type="text/css" />
		 <link rel="stylesheet" href="./css/forms.css" type="text/css" />
		 <link rel="stylesheet" type="text/css" href="css/StyleSheet1.css" />
		 <script type="text/javascript" src="./js/jquery.min.js"></script>
		 <script type="text/javascript" src="./js/forms.js"></script>
<?php if (!in_array(basename($_SERVER['PHP_SELF']),$endException)){ ?>
	 </head>
<body>
<?php } ?>
<div id="banner"><img alt="" src="images/PhysicsBanner.JPG" height="200px" width="100%" /></div>
<header id="header">Welcome to the NAPS E-Voting Platform</header>
