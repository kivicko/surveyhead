<?php
	session_start();
	include "userClass.php";
	$userid = $_POST["userID"];
	$reacher = new userClass;
	if($reacher->delete($userid)){
		header("Location:?action=user");
	}else{
		header("Location:?action=user");
	}
?>