<?php
	 function getAspirantsData(){
		 $query = mysql_query("SELECT aspirants.id, other_name,level,surname,UCASE(post) AS post FROM voters, aspirants WHERE aspirants.student_Id = voters.id") or die('Error fetching aspirants '.mysql_error());
		 
		 $data = array();
		 while($row = mysql_fetch_assoc($query)){
			 $data[$row['id']] = $row;
			 $post[$row['id']] = $row['post'];
		 }
		 
		 $data[0] = array( //for empty contestants
					 'surname' => 'NO CONTESTANT',
					 'other_name' => '',
					 'level' => 'N/A',
					 'matric'=>	'N/A',
					 'post'  => 'N/A'
					 );
		 return array($data,$post);;
	 }
	 
	 function setPostContenders($posts,$aspPost){
		 $array = array(); //stores the id of the contenders for each post
		 foreach($posts as $post){
			 foreach ($aspPost as $aspid => $p){
				 if($p == $post) $array[$post][] = $aspid;
			 }
			 if(empty($array[$post])) $array[$post][] = 0; //if no one contest for a particular post
		 }
		 
		 return $array;
	 }
	 
	 function rearrangeContenders($postCont,$aspVotes){
		 foreach($postCont as $post => $asp){
			 $aspirants = $asp;
			 $lmt = count($asp);
			 for($i = 0; $i < $lmt; $i++){
				 for($j = $i+1; $j<$lmt; $j++){
					 if($aspVotes[$aspirants[$i]] < $aspVotes[$aspirants[$j]]){
						 $temp = $aspirants[$i];
						 $aspirants[$i] = $aspirants[$j];
						 $aspirants[$j] = $temp;
					 }
				 }
			 }
			 $postCont[$post] = $aspirants;
		 }
		 return $postCont;
	 }
	 
	 function intializeVotes($aspPost){
		 $array = array();
		 foreach($aspPost as $id => $p) $array[$id] = 0;
		 $array[0] = 0; //for empty contestant
		 return $array;
	 }
	 
	 function setScores($postCont,$aspPost,$aspVotes){
		 $scoreSheet = array();
		 
		 foreach($aspPost as $aspID => $post){
			 $position = array_search($aspID,$postCont[$post]);
			 $scoreSheet[$aspID] = getVerdict($position);
		 }
		 
		 $scoreSheet = checkTie($postCont,$aspVotes,$scoreSheet);
		 return $scoreSheet;
	 }
	 
	 function getVerdict($arrIndex){
		 if($arrIndex == 0) return 'WINNER';
		 if($arrIndex == 1) return '1st runner up'; 
		 if($arrIndex == 2) return '2nd runner up'; 
		 if($arrIndex == 3) return '3rd runner up'; 
		 if($arrIndex > 3) return $arrIndex.'th runner up'; 
	 }
	 
	 function checkTie($postCont,$aspVotes,$scoresheet){
		 foreach($postCont as $post => $asp){
			 $lmt = count($asp);
			 for($i = 0; $i < $lmt; $i++){
				 for($j = $i+1; $j<$lmt; $j++){
					 if($aspVotes[$asp[$i]] == $aspVotes[$asp[$j]]){
						 $scoresheet[$asp[$i]] = $scoresheet[$asp[$j]] = 'TIE';
					 }
				 }
			 }
		 }
		 return $scoresheet;
	 }
?>