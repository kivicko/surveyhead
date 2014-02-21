<?php
	class surveyClass{

			public function selectSurvey($_nameSelect, $_survey_ID){
	
			$nameSelect = $_nameSelect;
			$survey_ID = $_survey_ID;
			if(is_file("../upload/" . $nameSelect)){
				$surveyHtml = file_get_contents("../upload/" . $nameSelect);

			}else{
				echo "Cannot locate the theme!";
			}
			//getting the informations

			$mysqli = new mysqlConnect();
			$dbRowSet = $mysqli->connect();
			$query = "SELECT step_id,introduction FROM step WHERE id_survey = $survey_ID";
			
			$result = $dbRowSet->query($query);

			$helper = 0;

			while( $row = $result->fetch_assoc() ){

				$surveyHtml = str_replace( "{information" . $helper . "}" , $row["introduction"] , $surveyHtml );
	
				$step_array[$helper] = $row["step_id"];
				
				$helper++;
			}

			$helper = 1;
			//getting the questions
			for($i=0;$i<count($step_array);$i++){
				$step_arrayINT = $step_array[$i];
				
				$query = "SELECT question FROM question WHERE id_step = $step_arrayINT ";
			
				$dbRowSet = $mysqli -> connect();
				$result= $dbRowSet->query($query);
				
				while ($row3 = $result->fetch_assoc()){
					$surveyHtml = str_replace( "{" . $helper . "}" , $row3["question"], $surveyHtml);
					$helper++;
				}
			}

			echo $surveyHtml;

		}

	}



?>

