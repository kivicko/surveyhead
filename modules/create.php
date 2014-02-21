<?php
	session_start();
	if( !isset($_SESSION["role"])){
			$_SESSION["role"]=3;
		}
	if( $_SESSION["role"] == 1){
		$mysqli = new mysqlConnect();
		$dbRowSet = $mysqli->connect();
		$query = "SELECT username FROM user ";


?>
<html>

<head>
<script src="js/jquery.min.js">
</script>
<script>
$(document).ready(function(){

    $("#btn1").click(function(){
    $("ol").append("<li>Step Information <input type='text' name='information[]' placeholder='info'>  Which Step? <input type='text' name='related_step[]' placeholder='Step Number'> <br></li>");
  });

  $("#btn2").click(function(){
    $("ol").append("<li>Appended question <input type='text' name='question[]' placeholder='Question'>  Related step <input type='text' name='step_no[]' placeholder='Step Number'> <br></li>");
  });
});
</script>
</head>

<body >
<div style="float:left">
<form action="?action=upload_file" method="post" enctype="multipart/form-data">
<b>Survey Name:</b><br>
<input type="text" name="survey_name" placeholder="Survey Name"><br>
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br><br>

<ol>
<div>

<?php		
		if( $result = $dbRowSet->query($query) ) {
		
		while( $row = $result->fetch_assoc()){
			echo "<input type='checkbox' name='usernames[]' value='" . $row["username"] . "'>" . $row["username"] . "  <br> ";
		}
}
?>

</div>
</ol>

<input type="button" button id="btn2" value="Add Question"></button>
<input type="button" button id="btn1" value="Add Step Information"></button><br><br>


<input type="submit" name="submit" value="Submit">
</form>
</div>
<div style="float:middle">
	<b>
	Using this creator is realy simple, just create your own html page as u want users to see.<br>
	there is a sample of html. It includes 10 questions and 3 info steps.<br>
	 Questions seperated on infos as 4-4-2. <br>
	 Download it and check it out!<br><br></div></b>


	 <h4><a href="http://www.4shared.com/zip/ISQyVcFRba/sample.html" target="_blank">HERE</a></h4>

</div>
</body>
</html>

<?php
	} else{
	echo"YOU DONT HAVE PERMISSON TO ENTER HERE.";
	header("Refresh: 1 ; url=?action=main");
	
}



?>