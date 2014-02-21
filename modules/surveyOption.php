<?php
	session_start();

	$allAnswer = $_POST["answer"];
	// total question equals to total answer.
	$totalAnswer = count($allAnswer);
	$allQuestion = $_POST["question"];
	$userName = $_SESSION["username"];

	echo "<br><br>";

	for($i=0;$i<$totalAnswer;$i++){
		$mysqli = new mysqlConnect();
        $dbRowSet = $mysqli->connect();
        $currentQuestion = $allQuestion[$i];
        $currentAnswer = $allAnswer[$i];
		$query ="INSERT INTO result (id_user,id_question,answer) 
				  VALUES ( (SELECT user_id from user where username = '$userName'), 
				           (SELECT question_id from question where question='$currentQuestion'),
				           '$currentAnswer' )";
		$dbRowSet->query($query);
		
	}
	echo "Thanks for filling the survey, now you can go and check for other surveys!";


?>