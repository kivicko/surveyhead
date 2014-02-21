<?php
session_start();
	//check if they are empty or not.

	if(!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["username"]) || !isset($_POST["age"]) || !isset($_POST["email"]) || !isset($_POST["phone"]) ){
		echo "ERROR, FILL THEM!";
	}else{
		include "userClass.php";

		$id = array();
		$name = array();
		$surname = array();
		$username = array();
		$age = array();
		$email = array();
		$phone = array();
		$id = $_POST["id"];
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$username = $_POST["username"];
		$age = $_POST["age"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$reacher = new userClass();
		$numberOfCircle = count($id);
		for($i=0;$i<$numberOfCircle;$i++){	
			$name1=$name[$i];
			$surname1=$surname[$i];
			$username1=$username[$i];
			$age1=$age[$i];
			$email1=$email[$i];
			$phone1=$phone[$i];
			$id1=$id[$i];
			if($reacher->update($name1,$surname1,$username1,$age1,$phone1,$email1,$id1) ){
				header("Location:?action=user"); 
			}else{
				echo "Error";
			}
		}
	}

?>