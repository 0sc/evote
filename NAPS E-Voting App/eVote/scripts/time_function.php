<?
	 function getTimeDifference($secs){
		 $hr = 0;
		 $mins = 0;
		 
		 while($secs >= 60){
			 $mins = $mins + 1;
			 $secs = $secs - 60;
			 
			 if($mins >= 60){
				 $hr = $hr + 1;
				 $mins = $mins - 60;
			 }
		 }
		 
		 $hhr = ($hr > 1)? 'hrs' : 'hr';
		 $mmin= ($mins > 1)? 'mins' : 'min';
		 $sec = ($secs > 1)? 'secs' : 'sec';
		 
		 return "$hr $hhr $mins $mmin $secs $sec";
	 }
?>