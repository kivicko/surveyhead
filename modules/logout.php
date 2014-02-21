
<?php
	session_start();
	if($_SESSION["role"] == 1 || $_SESSION["role"] == 2){
	echo"You're redirecting...";
	session_destroy();
	header("Refresh: 1 ; url=?action=main");
	}else{
		echo "First, you have to log-in.";
		header("Refresh: 1 ; url=?action=login");
	}
?>
