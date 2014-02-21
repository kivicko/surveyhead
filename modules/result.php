<?php
	session_start();
	if( !isset($_SESSION["role"])){
			$_SESSION["role"]=3;
		}
	if( $_SESSION["role"] == 1 ){
		$mysqli = new mysqlConnect();
        $dbRowSet = $mysqli->connect();


		//getting user id
		$username = $_SESSION["username"];
		$query = "SELECT user_id FROM user where username = '$username' ";
		if($result = $dbRowSet->query($query)){
			while($row = $result->fetch_assoc()){
				$user_id = $row["user_id"];
			}
		}

		//getting the survey name and survey id

		$query ="SELECT id_survey from owner where id_user = $user_id";
		if($result = $dbRowSet->query($query)){
			while($row = $result->fetch_assoc()){
				$id_survey[] = $row["id_survey"];
			}
		}

		echo "<form method='post' action='?action=result'>";
		echo "<select name='userSelect'>";
		//printing survey name's with id's at option section
		for($i=0;$i<count($id_survey); $i++){
			$selectedID = $id_survey[$i];
			$query = "SELECT name,survey_id from survey where survey_id = $selectedID ";
			$result = $dbRowSet->query($query);
			while($row = $result->fetch_assoc()){
				$optionRegentID[] = $row["survey_id"];
				$optionRegentName[] = $row["name"];
			}
			
			echo "<option value='" . $optionRegentID[$i] . "'>" . $optionRegentName[$i] . "</option>";
		}

		echo "</select>";
		echo "<input type='submit' value='Show me'>";
		echo "</form>";

		// Printing users selection
		if(isset($_POST["userSelect"])  ){
			$selectedID = $_POST["userSelect"];

			$query = "SELECT * FROM step s 
				LEFT JOIN question q ON (s.step_id = q.id_step)
				LEFT JOIN result r ON (q.question_id = r.id_question)
				LEFT JOIN user u ON (r.id_user = u.User_id)
				WHERE s.id_survey = $selectedID ";
				
				$result = $dbRowSet->query($query);
				while ($row = $result -> fetch_assoc()){
					$username1[]=$row["username"];
					$introduction[]=$row["introduction"];
					$question[]=$row["question"];
					$answer[]=$row["answer"];
					$stepID[]=$row["step_id"];
					

				}
				$introductionSort = '';
				$questionSort = '';
			for($i=0;$i<count($question);$i++){

					if($introduction[$i] !== $introductionSort)
						echo "<br>  STEP ->> " .$introduction[$i] ."<br>";
					if($question[$i] !== $questionSort)
						echo "<br>" .$question[$i] ."<br>";
					echo $username1[$i] ." answer : " . $answer[$i] ."<br>";
					
					$introductionSort=$introduction[$i];
					$questionSort=$question[$i];
			}
				
		}

	} else{
	echo"YOU DONT HAVE PERMISSON TO ENTER HERE.";
	header("Refresh: 1 ; url=?action=main");
	
}

?>