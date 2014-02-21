<?php
	session_start();
	if(isset($_SESSION["enterance"])){
		echo "Welcome Brother";
	}else{
		echo("Session not found, try again.");
		header("Refresh: 3 ; url=?action=login");
		
	}

?>