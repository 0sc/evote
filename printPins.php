<?php
	 require 'scripts/authenticate.php';
	 $registered = authorized(false);
	 
	 if(!$registered){
		 //send to registration page
		 $_SESSION['notification']['registration'] = array('type'=>'error', 'info' => 'Error! This system is not registered. Please request the attention of a systems\' admin for registration.');
		 header ('location: index.php');
		 exit;
	 }
?>
<?php include "scripts/cHead.php"; ?>
	 <link rel="stylesheet" href="./css/printPin.css" type="text/css" />
</head>
<body>
	 <div id='registration' style='width: 60%;'>
		 <h2 style="color: gold;">Voters Pin (<span style="color: red; font-style: oblique;">Confidential</span>)</h2>
		 <form>
			 <?php printPins(); ?>
		 </form>
	 </div>
<?php include "scripts/footer.php"; ?>

</body>
</html>

<?php
	 function printPins(){
		 $lvls = array(100,200,300,400);
		 
		 foreach ($lvls as $lvl) print4lvls($lvl);
	 }
	 
	 function print4lvls($lvl){
		 $query = mysql_query("SELECT surname, other_name, matric, level, sex, prep.pin AS pin FROM voters, pins, prep WHERE voters.id = prep.student_id AND pins.pin = prep.data AND level = $lvl") or die('Error with pins '.mysql_error());
		 
		 $id = 0;
		 
		 echo '<table table border="1" cellspacing="0" cellpadding="0" width="95%" align="center">';
		 echo "<tr><td colspan='6' class='center'><h2 style='color: orange;'>$lvl level</h2></td></tr>";
		 
		 echo '<tr class="heading center"><td width="10%">S/N</td><td width="20%">Matric No.</td><td width="50%">Name</td><td width="10%">level</td><td>Sex</td><td width="15%">Voting Pin</td></tr>';
		 
		 while($row = mysql_fetch_assoc($query)){
			 $mat 	= $row['matric'];
			 $name  = $row['surname'].' '.$row['other_name'];
			 $sex	= $row['sex'];
			 $level	= $row['level'];
			 $pin 	= $row['pin'];
			 
			 echo '<tr>';
			 echo '<td width="10%" style="color: grey;" class="center">'.++$id.'</td>';
			 echo "<td width='20%' class='center'>$mat</td>";
			 echo "<td width='40%'>$name</td>";
			 echo "<td width='10%'>$level</td>";
			 echo "<td class='center'>$sex</td>";
			 echo "<td width='15%' class='center' style='color: brown;'>$pin</td>";
			 echo '</tr>';
		 }
		 echo '</table>';
		 echo '<br/><br/>';
	 }
?>