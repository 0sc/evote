<?
	 $host = 'localhost';
	 $dbuser = 'root';
	 $dbpass = ''; //'4NapsElection';
	 $dbname = 'eVoting';
	 $db = mysql_connect($host,$dbuser,$dbpass) or die(mysql_error());
	 
	 mysql_select_db($dbname,$db) or die (mysql_error());
?>