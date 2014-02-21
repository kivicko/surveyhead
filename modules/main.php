
<?php
session_start();
echo "Greetings from SurveyHead creator Kivicko.<br><br>";
	if(isset($_SESSION["role"])){
		echo "Feel free to take a look to my site Mr." . $_SESSION["username"];
	}else{
		echo "Do you looking for log-in page? <br> Its <b><a href='?action=login'> HERE </a></b>";
	}
?>
