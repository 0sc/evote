<?php
	 session_start();
	 require 'scripts/conf.inc.php';
	 
	 $query = mysql_query("SELECT published FROM jega") or die('False '.mysql_error());
	 $query = mysql_fetch_assoc($query);
	 $isPublished = $query['published'] === 'TRUE';
	 
	 if(!$isPublished){
		 $_SESSION['notification']['lockdown'] = array('info' => 'Error! results have not been published.', 'type' => 'error');
		 header("location: lockdown.php");
		 exit;
	 }
	 
	 require 'scripts/election_posts.php';
	 require 'scripts/rFunctions.php';
	 
	 $posts = getPosts();
	 
	 $aspVotes = array(); //stores the number of votes each aspirants gets
	 $aspData  = getAspirantsData(); 
	 $aspPost  = $aspData[1];//stores post each asp is vying for
	 $aspData  = $aspData[0];//stores the aspirants data
	 $postCont = setPostContenders($posts,$aspPost);
	 $aspVotes = intializeVotes($aspPost); //sets everyones votes to 0
	 
	 $votes = mysql_query("SELECT * FROM votes") or die('Error processing results '.mysql_error());
	 $totalVotes = mysql_num_rows($votes);
	 
	 while($row = mysql_fetch_assoc($votes)){
		 foreach($posts as $post){
			 if(empty($nullVotes[$post])) $nullVotes[$post] = 0;
			 if(empty($validVotes[$post])) $validVotes[$post] = 0;
			 
			 $candID = $row[strtolower($post)];
			 if($candID == 0){
				 $nullVotes[$post]++;
				 continue; //escape zero entries
			 }
			 if(empty($aspVotes[$candID])) $aspVotes[$candID] = 0;
			 $aspVotes[$candID]++;
			 $validVotes[$post]++; //count as valid
		 }
	 }

	 $postWinners = rearrangeContenders($postCont,$aspVotes);
	 $winners = setScores($postWinners,$aspPost,$aspVotes);	 
?>
<?php include ("scripts/cHead.php"); ?>
		 <link rel="stylesheet" href="./css/result.css" type="text/css" />
</head>
<body>
<div id='registration' style='width: 60%;'>
	 <h2>Election Results</h2>
	 <form>
	 <fieldset>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr class='heading'>
    <td width="25%"><p align="center"><strong>POST</strong></p></td>
    <td width="55%"><p align="center"><strong>ASPIRANTS</strong></p></td>
    <td width="10%"><p align="center"><strong>VOTES</strong></p></td>
    <td width="10%"><p align="center"><strong>VERDICT</strong></p></td>
  </tr>
<?php
	 foreach($posts as $post){
		 $postRowSpan = count($postCont[$post]);
?>
	 <tr>
		 <td width="25%" class='center label' rowspan ="<?php=$postRowSpan+1;?>"><?php=str_replace('_',' ',$post);?></td>
<?php
		 foreach($postCont[$post] as $candId){
			 //$isWinner = $winners[$post]['winner'] == $cand['name'];
			 $cand = $aspData[$candId];
			 echo '<tr>';
			 echo '<td width="55%">'.$cand['surname'].' '.$cand['other_name'].'</td>';
			 echo '<td width="10%" class="center">'.$aspVotes[$candId].'</td>';
			 if(!empty($winners[$candId])){
				 $is_2_3rd = ($aspVotes[$candId] / $totalVotes) >= (2/3);
				 
				 if($winners[$candId] == 'WINNER') $color =  'rgb(140,255,10)'; 
				 if($winners[$candId] == 'TIE') $color = 'rgb(106,106,255)';
				 if(!$is_2_3rd){
					 $winners[$candId] = 'LOST<br /><small style="color: orange;">failed 2/3rd</small>';
					 $color = 'rgb(177,10,10)';
				 }
				 
				 echo '<td width="10%" class="center"';
				 if(!empty($color)) echo "style='color: $color;'";
				 echo '>'.$winners[$candId].'</td>';
			 }
			 echo '</tr>';
			 $color = '';
		 }
?>
	 </tr>
	 <tr><td class="newPost">&nbsp;</td></tr>
<?php
	 }
?>
</table>
</fieldset>
</form>
</div>
<p>&emsp;</p>
<p>&emsp;</p>
<p>&emsp;</p>
<div id='registration'>
	 <h2>Total Votes Cast: <?php=$totalVotes;?></h2>
	 <form>
		 <fieldset>
			 <table border="1" cellspacing="0" cellpadding="0" width="100%">
				 <tr class='heading'>
					 <td width="25%"><p align="center"><strong>POST</strong></p></td>
					 <td width="50%"><p align="center"><strong>VALID VOTES</strong></p></td>
					 <td width="60%"><p align="center"><strong>NULL VOTES</strong></p></td>
				 </tr>
		 <?php
			 foreach($posts as $post){
		 ?>
				 <tr>
					 <td width="25%" class='center label'><?php=str_replace('_',' ',$post);?></td>
					 <td class='center'><?php=$validVotes[$post];?></td>
					 <td class='center'><?php=$nullVotes[$post];?></td>
				 </tr>
		 <?php } ?>
			 </table>
		 </fieldset>
	 </form>
</div>
<?php include "scripts/footer.php"; ?>
</body>
</html>