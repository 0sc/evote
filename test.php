<?php
	 require 'scripts/conf.inc.php';
	 
	  $query = mysql_query("SELECT * FROM prep") or die(mysql_error());
	  //$sid = mysql_query("SELECT id FROM voters ") or die(mysql_error());
	  
	  $toSave = array();
	  
	  while($row = mysql_fetch_assoc($query)){
		 $toSave[] = "(".$row['student_id'].",'".addslashes($row['data'])."')";
		 
		 $pin = trim(strtolower($row['pin']));
		 $pin = mysql_real_escape_string(md5($pin,'#$%GOD&^*~'));
		 $id = $row['student_id'];		 
		 
		 mysql_query("UPDATE pins SET pin = '$pin' WHERE student_Id = $id") or die('Error '.mysql_error());
		 
		 /*$pin = strtolower($row['pin']);
		 $data = mysql_real_escape_string(md5($pin,'#$%GOD&^*~')); 
		 $id = $row['id'];
		 
		 mysql_query("UPDATE prep SET data = '$data' WHERE id = $id") or die(mysql_error()); */
	  }
	  
	  
	  //$toSave = "INSERT INTO pins(student_Id,pin) VALUES".implode(',',$toSave);
	 //echo $toSave;

?>