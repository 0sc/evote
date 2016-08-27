<?
	 require 'conf.inc.php';
	 
	 $query = mysql_query("SELECT id,surname FROM voters WHERE level = 100") or die('error_fetching '.mysql_error());
	 
	 //$s = 'UPDATE voters SET surname = '', other_name = '' WHERE id = ';
	 while($row = mysql_fetch_assoc($query)){
		 $names = explode(' ',$row['surname']);
		 $sName = $names[0];
		 $id = $row['id'];
		 $oName = str_replace("$sName ",'',$row['surname']);
		 echo "$id $sName => $oName<br/>";
		 
		 $a = mysql_query("UPDATE voters SET surname = '$sName', other_name = '$oName' WHERE id = $id") or die("Not done ".mysql_error());
	 }
	 
	 //ALTER TABLE table_name AUTO_INCREMENT = 1
?>