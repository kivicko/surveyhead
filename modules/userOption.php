<?php
session_start();
	//check if they are empty or not.

	if(strlen($_POST["name"]) <= 0 || strlen($_POST["surname"]) <= 0 || strlen($_POST["username"]) <= 0 || strlen($_POST["password"]) <= 0 || strlen($_POST["role"]) <= 0 ){
		header("Location:?action=user"); 
	}else{
		include "userClass.php";
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$age = $_POST["age"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$role = $_POST["role"];
		if( null !== ($name) && null !== ($surname) && null !==($username) && null !==($password) && 0 !==($age) && null !==($email) && null !==($phone) && null !==("role")){
			$reacher = new userClass();
			if($reacher->add($name,$surname,$username,$password,$age,$role,$phone,$email) ){
				header("Location:?action=user"); 
			}else{
				header("Location:?action=user");
			}
		}else{
			header("Location:?action=user");
		}
	}

?>