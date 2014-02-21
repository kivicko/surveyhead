<?php
	session_start();
	include "surveyClass.php";
	if( !isset($_SESSION["role"])){
			$_SESSION["role"]=3;
		}
	if( $_SESSION["role"] == 1 || $_SESSION["role"] == 2){
		//trying to get which surveys should user see.
		$mysqli = new mysqlConnect();
        $dbRowSet = $mysqli->connect();
        
		$username = $_SESSION["username"];
		$query = "SELECT user_id FROM user WHERE username = '$username'";

		if($userIDX = $dbRowSet->query($query)){
				while($row=$userIDX->fetch_assoc()){
					$userID = $row["user_id"];
				}
			}

		$query = "SELECT * FROM survey sur LEFT JOIN survey_related s_r	ON ( sur.survey_id = s_r.id_survey) WHERE id_user = (SELECT user_id FROM user WHERE username = '$username')"  ;
		$result = array();
		$result = $dbRowSet->query($query);
		
		echo "<form method='post' action='?action=survey'>";
		echo "<select name='nameSelect'>";
		

		while($row = $result->fetch_assoc()){
			echo "<option value='" . $row["template_filename"] . "'>" . $row["name"] . "</option>";
			$survey_ID = $row["survey_id"];
      	}

		echo "</select>";
		echo "<input type='submit' value='Show me'>";
		echo "</form>";

		if(isset($_POST["nameSelect"])){
			$sender = new surveyClass;
			echo "<table>";
			//echo "<form name='input' action='?action=surveyOption' method='post' enctype='multipart/form-data'><br>";
			$sender->selectSurvey($_POST["nameSelect"],$survey_ID);
			//echo "<td><input type='submit' value='Send'></td>";
			echo "</table>";

		}

	} else{
	echo"YOU DONT HAVE PERMISSON TO ENTER HERE.";
	header("Refresh: 1 ; url=?action=main");
	
}



?>












