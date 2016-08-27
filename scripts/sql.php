<?php
	 require 'conf.inc.php';
	 
	 $query = mysql_query("SELECT * FROM voter2") or die(mysql_error());
	 
	 $new = "INSERT INTO voters (id,surname, other_names, matric, sex, level) VALUES ";
	 $data = array();
	 
	 while($row = mysql_fetch_assoc($query)){
		 $name = explode(' ',$row['surname']);
		 $sName = $name[0];
		 $oName = str_replace("$sName ",'',$row['surname']);
		 $id = ($row['id'] > 43)? $row['id'] + 159: $row['id'];
		 $data [] = "($id,'$sName','$oName',{$row['matric']},'{$row['sex']}', '200')";
	 }
	 
	 $new .= implode(',',$data);
	 
	 echo $new;
	 /*
	 $query = mysql_query("SELECT id,surname FROM voters WHERE level = 100") or die('error_fetching '.mysql_error());
	 
	 //$s = 'UPDATE voters SET surname = '', other_name = '' WHERE id = ';
	 while($row = mysql_fetch_assoc($query)){
		 $names = explode(' ',$row['surname']);
		 $sName = $names[0];
		 $id = $row['id'];
		 $oName = str_replace("$sName ",'',$row['surname']);
		 echo "$id $sName => $oName<br/>";
		 
		 $a = mysql_query("UPDATE voters SET surname = '$sName', other_name = '$oName' WHERE id = $id") or die("Not done ".mysql_error());
	 }*/
	 
	 //ALTER TABLE table_name AUTO_INCREMENT = 1
?>