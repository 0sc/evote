<?php
	 require 'scripts/authenticate.php';
	 $registered = authorized();
	 
	 if(!$registered){
		 //send to voter_login page
		 $info = '';
		 header('Location: voter_login.php');
		 exit;
	 }
	 
	 $_SESSION['user_data']['verified'] = true;
	 
	 $query = mysql_query("SELECT aspirants.id, surname, other_name, level, photo, aka, UCASE(post) as post, manifesto FROM voters, aspirants WHERE student_Id = voters.id") or die('Error fetching aspirants '.mysql_error());
	 
	 $GIANT_ARRAY = array(); //stores aspirants under particular posts
	 
	 while($row = mysql_fetch_assoc($query)){
		 $GIANT_ARRAY[$row['post']] []= $row; 
	 }
	 
	 require 'scripts/election_posts.php';
	 $votingOrder = getPosts();
?>
<?php include ("scripts/cHead.php"); ?>
	 <script type="text/javascript" src="./js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	 <!-- Add fancyBox -->
	 <link rel="stylesheet" href="./js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	 <link rel="stylesheet" href='./css/votingPage.css' type="text/css" media="screen"/>
	 <script type="text/javascript" src="./js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	 <script type="text/javascript" src="./js/voting.js"></script>

	 <script type="text/javascript">
		 $(document).ready(function() {
			 $("#verify").click(function(){
				 var def = "<span class='red'>You've not voted anyone for this post</span>";
				 var $fields = ["<?php echo implode('", "',$votingOrder);?>"];
				 var entry;
		 
				 for (j = 0; j< $fields.length; j++){
					 var field = $fields[j];
			 
					 entry = $("input[name="+field+"]:checked").val();
			 
					 entry = (entry == null)? def : $("#aspirant"+entry).text();
			 
					 //update preview field
					 $("#confirm_"+field).html(entry);
				 }
		 
				 $("#_verify").trigger("click");
			 });
	 
			 $(".fancybox").fancybox({maxWidth: 600, type : "inline", closeClick: true});
		 });
	 </script>
</head>
<body>
	 <div id='registration' style='width: 90%; overflow: hidden;'>
	 <h2>Cast Your Vote</h2>
	 <form action='scripts/validate_vote.php' method='POST'>
	 <?php
		 foreach($votingOrder as $post){
			 if(empty($GIANT_ARRAY[$post])) continue;
			 $aspirants = $GIANT_ARRAY[$post];
			 
			 echo '<fieldset>';
			 echo '<legend>&nbsp;Aspirants for post of '.str_replace('_',' ',$post).'&nbsp;</legend>';
			 echo '<div class="aspirantBox">';
			 foreach ($aspirants as $info){//$i = 0;
				// do{
				 $img = $info['photo'];
				 $aka = $info['aka'];
				 $cv  = $info['manifesto'];
				 $cv  = formatString($cv);
				 
				 $name= $info['surname'].'&nbsp;'.$info['other_name'];
				 $lv  = $info['level'];//$i++;
				 $aid  = $info['id'];
				 
				 echo '<div class="aspirant">';
				 echo "<p><img src='$img' /></p>";
				 echo "<p>Name: $name</p>";
				 echo "a.k.a: $aka</p>";
				 echo "<p>Level: $lv</p>";
				 if(empty($cv)) echo '<span style="color: grey">Manifesto is not available</span>';
				 else echo "<p><a href='#inline$aid' class='fancybox'>View Manifesto</a></p>";
				 echo "<p><input type='radio' name='$post' value='$aid' /><a class='vote_icon' title = 'Vote $name as $post'>&emsp;&emsp;</a></p>";
				 echo '</div>';
				 
				 echo "<div id='inline$aid' class='hide'>
					 <p style='float: left;'><img src='$img' /></p>
					 <p></p>
					 <p>$cv</p>
					 <p></p>
					 <p id='aspirant$aid'>$name</p>
				 </div>";
				// } while($i<9);
			 }
			 echo '</div>';
			 echo '<div class="clear"></div>';
			 echo '</fieldset>';
		 }
	 ?>
	 <?php setToken(); ?>
	 <p><a href='#' id='verify' class='button'>Submit Vote<a/></p>
	 <a href='#verifyVote' id = '_verify' class='fancybox' style='display: none;'></a>
	 <div class='hide'>
		 <input type='reset' name='reset' />
		 <input type='submit' name='submit' />
	 </div>
	 </form>
	 </div>
	 <div id='verifyVote' class='hide'>
		 <h2 style='text-decoration: underline;'>Please confirm your votes!</h2>
		 <ul>
		 <?php
			 foreach($votingOrder as $list){
				 echo "<li><span class='tag'>$list:</span> <b><span id='confirm_$list'></span></b></li>";
			 }
		 ?>
		 </ul>
		 <p>&nbsp;</p>
		 <p style='text-align: center;'><input type = 'submit' value='Vote' id='submitButton' class='button'/> &emsp;<input type='reset' value='Reset Vote' id='resetButton' class='button wrong'/></p>
	 </div>
	 <?php include "scripts/footer.php"; ?>
</body>	
</html>