<?php
	 session_start();
	 require 'scripts/conf.inc.php';
	 require 'scripts/data_functions.php';
	 
	 $lockdown_time  = mktime(16,0,0,03,19,2014);
	 $time = time();
	 
	 if($time < $lockdown_time){ //if not election end time
		 require 'scripts/time_function.php';
		 $timeLeft = getTimeDifference($lockdown_time - $time);
		
		 $_SESSION['notification']['login'] = $_SESSION['notification']['registration']= array('type'=>'error', 'info' => "<b>ACCESS DENIED</b>! Results are not available till the voting period is over.<br /> Check back in <b>$timeLeft</b>");
		 
		 header('Location: voter_login.php');
		 exit;
	 }
	 
	 //check if electoral chairman has authorized viewing of results
	 $query = mysql_query("SELECT published FROM jega") or die('False '.mysql_error());
	 $query = mysql_fetch_assoc($query);
	 $isPublished = $query['published'] === 'TRUE';
	 $resultLink = ($isPublished)? 'results.php' : '#jegaPortal'
?>
<?php include ("scripts/cHead.php"); ?>
		 <script type="text/javascript" src="./js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
		 <!-- Add fancyBox -->
		 <link rel="stylesheet" href="./js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		 <script type="text/javascript" src="./js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		 
		 <script type="text/javascript">
			 $(document).ready(function() {
				 $(".fancybox").fancybox({type : "inline", minWidth: 500});
				 
				 $("#authorize").click(function(){
					 $("input[name=authorize]").trigger("click");
				 });
			 });
		 </script>
	 </head>
	 <body>
		 <?php getNotification('lockdown');?>
		 <div id='registration'>
			 <h2>Voting has Closed!</h2>
			 <form action='scripts/publishResults.php' method='POST' id='RegisterUserForm'>
				 <fieldset>
				 <p>The voting process for the NAPS 2012/2013 Election has been concluded.</p>
				 <p>&emsp;</p>
				 <p><a href="<?php=$resultLink;?>" class='fancybox button'>Click here to view the results</a></p>
			 <?php
				 if(!$isPublished){ ?>
				 <div id='jegaPortal' style='display: none;'>
					 <p>Electoral Chairman authorization</p>
					 <p><input type='password' name='password' required = 'required' id='password' class='text' style='width: 90%;'/></p>
					 <p><a class='button' id='authorize'>Authorize</a><p>
				 </div>
				 <?php setToken(); ?>
				 <input type ='submit' name='authorize' style='display: none;'/>
			 <?php } ?>
				 </fieldset>
			 </form>
		 </div>
		 <?php include "scripts/footer.php"; ?>
	 </body>
</html>