<?php
	 $query = mysql_query("SELECT aspirants.id, other_name,level,surname,UCASE(post) AS post FROM voters, aspirants WHERE aspirants.student_Id = voters.id") or die('Error fetching aspirants '.mysql_error());
	 
	 $aspirants = array();
	 $scoreSheet= array();
	 
	 while($row = mysql_fetch_assoc($query)){
		 $aspirants [$row['post']][$row['id']] = array(
					 'name' => $row['surname'].' '.$row['other_name'],
					 'level'=> $row['level'],
					 'position' => '',
					 'votes' => 0);
	 }
	 
	 function getAspirantName($id,$post){
		 global $aspirants;
		 
		 return $aspirants[$post][$id]['name'];
	 }
	 
	 function getAspirantLvl($id,$post){
		 global $aspirants;
		 
		 return $aspirants[$post][$id]['level'];
	 }
	 
	 function verifyAspirantList($posts){
		 //for cases where nobody contests for a post
		 global $aspirants;
		 
		 foreach($posts as $post){
			 if(empty($aspirants[$post])){
				 $aspirants[$post][0] = array(
							 'name' => 'Empty Vote',
							 'Level'=> 'N/A',
							 'votes'=> 0
				 );
			 }
		 }
	 }
	 
	 function setWinners($aspirants){
		 $winners = array();
		 
		 foreach($aspirants as $post => $votes){
			 $winners[$post] = array(
								 'winner'	=>'',
								 'total'	=> 0
						);
			 $maxVotes = 0;
			 foreach($votes as $cand){
				 if($cand['votes'] > $maxVotes){
					 $winners[$post]['winner'] = $cand['name'];
					 $maxVotes = $cand['votes'];
				 }
				 else if($cand['votes'] == $maxVotes){
					 $winners[$post]['winner'] = 'TIE BETWEEN: '.$cand['name'].' & '.str_replace('TIE BETWEEN: ','',$winners[$post]['winner']);
					 $maxVotes = $cand['votes'];
				 }
				 $winners[$post]['total'] += $cand['votes'];
			 }
		 }
		 
		 return $winners;
	 }
	 
	 function countVotes($aspirants,$sSheet){
		 //populate the scoresheet
		 foreach ($aspirants as $post => $votes){
			 foreach ($votes as $aspirant){
				 $sSheet[$post][] = array(
					 'name' => $aspirant['name'],
					 'votes'=> $aspirant['votes']
						 );
			 }
		 }
		 $sSheet = arrangeVotes($sSheet);
		 var_dump($sSheet);
	 }
	 
	 function arrangeVotes($array){
		 foreach($array as $post => $data){
			 $total = count($data);
			 for($i = 0; $i < $total; $i++){
				 for($j = $i+1; $j < $total; $j++){
					 if($data[$j]['votes'] > $data[$i]['votes']){
						 $temp = $data[$j];
						 $data[$j] = $data[$i];
						 $data[$i] = $temp;
					 }
				 }
				 $array[$post][$i] = $data[$i];
			 }
		 }
		 return $array;
	 }
?>