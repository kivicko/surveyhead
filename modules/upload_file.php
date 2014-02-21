<?php
session_start();
if( !isset($_SESSION["role"])){
    $_SESSION["role"]=0;
  }
if( $_SESSION["role"] == 1 ){

//only .html and .htm files could be uploaded.
  $allowedExts = array("htm", "html");
  $temp = explode(".", $_FILES["file"]["name"]);
  $extension = end($temp);

  //we decleare the upload size as 40kb. Changeable if needed.
  if ( ($_FILES["file"]["size"] < 40000) && in_array($extension, $allowedExts))
    {
    if ($_FILES["file"]["error"] > 0)
      {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
      }
    else
      {
      echo "Upload: " . $_FILES["file"]["name"] . "<br>";
      echo "Type: " . $_FILES["file"]["type"] . "<br>";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

      if (file_exists("../upload/" . $_FILES["file"]["name"]))
        {
        echo $_FILES["file"]["name"] . " already exists. ";
        exit;
        }
      else
        {
          if($_POST["survey_name"] == NULL || empty($_POST["question"]) || empty($_POST["information"]) || empty($_POST["step_no"]) || empty($_POST["related_step"]) ){
            echo "<b> ERROR! </b> <br>You should full fill the name and question/information areas.<br>";
            echo "upload = Interrupted.";
            
          }else{ /// controlled area starts
            
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "../upload/" . $_FILES["file"]["name"]);
            echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];

            $question = array(); // question  string
            $information = array(); // step string
            $question_step = array(); // which questions to step
            $information_step = array(); // which information on which step.
            $question = $_POST["question"];
            $information = $_POST["information"];
            $question_step = $_POST["step_no"];
            $information_step = $_POST["related_step"];


            $survey_name = $_POST["survey_name"];
            $file_name = $_FILES["file"]["name"];

            $mysqli = new mysqlConnect();
            $dbRowSet = $mysqli->connect();
            $query = "INSERT INTO survey (name,template_filename) VALUES ('$survey_name','$file_name') ";
            $dbRowSet->query($query);
            $username = $_SESSION["username"];
            $query2 = "INSERT INTO owner (id_user,id_survey) 
                      VALUES( (SELECT user_id from user where username = '$username'),
                              (SELECT survey_id from survey where name = '$survey_name') )";

            $dbRowSet->query($query2);

            $totalQuestionNumber = count($question_step);
            $totalInformationNumber = count($information_step);

            
            for($i=0;$i<$totalInformationNumber;$i++){
              $information_insert=$information[$i];
              $query = "INSERT INTO step (id_survey,introduction) VALUES ( (SELECT survey_id FROM survey WHERE name = '$survey_name'),'$information_insert') ";
              $dbRowSet->query($query);
            }
            //matching the step numbers with values.
            for($i=0;$i<$totalInformationNumber;$i++){
              for($k=0;$k<$totalQuestionNumber;$k++){
                if($information_step[$i]==$question_step[$k]){
                  $information_insert=$information[$i];
                  $question_insert = $question[$k];
                  $query="INSERT INTO question (id_step,question) VALUES ( (SELECT step_id FROM step WHERE introduction = '$information_insert'), '$question_insert')  ";
                  $dbRowSet->query($query);
                }
              }
            }

            
            $usernames = $_POST["usernames"];
            for($i=0;$i<count($usernames);$i++){
              $userNameSet = $usernames[$i];
              $query ="INSERT INTO survey_related (id_survey,id_user) VALUES ( (SELECT survey_id FROM survey WHERE name = '$survey_name'),
                    (SELECT user_id FROM user WHERE username='$userNameSet') )";
              $dbRowSet->query($query);

            }

          } // <<controlled area ends>>      
        }
      }
    }
    
  else
    {
      echo "Invalid file";
    }
} else{
    echo"YOU DONT HAVE PERMISSON TO ENTER HERE.";
    header("Refresh: 1 ; url=?action=login");
    exit;
}

?>