<?php

if( isset($_POST["username"]) && isset($_POST["password"]) ){
	
		$username = $_POST["username"];
		$password = $_POST["password"];

		$mysqli = new mysqlConnect();

		$dbRow = $mysqli->connect();

		$query = "SELECT * FROM user WHERE username = '$username' " ;

		if($result = $dbRow->query($query)){

			$row = $result->fetch_assoc();

			if($row["username"]==$username && $row["password"] == $password){
				
				$userID = $row["user_id"];

				$query2 = "SELECT * FROM user_role WHERE id_user = $userID ";
				if($result2 = $dbRow -> query($query2)){
					$row2 = $result2->fetch_assoc();
					$role = $row2["id_role"];


					session_start();
					$_SESSION["username"]=$username;
					$_SESSION["password"]=$password;
					$_SESSION["role"]=$role;
					$_SESSION["enterance"] = true;
					header("Refresh: 0 ; url=?action=start");
					
					exit;

				}else{
					echo("There is a problem with your Account, Please contact with your admin!");
					header("Refresh: 1 ; url=?action=login");
					exit;
				}

			}else{
				echo "You typed wrong Password. Please Try again.";
				header("Refresh: 1 ; url=?action=login");
				exit;
			}		
		}else{
				echo "You typed wrong username/password combination. Please Try again.";
				header("Refresh: 1 ; url=?action=login");
				exit;
		}
	}else{
		echo("Username/Password should be filled.");
		header("Refresh: 1 ; url=?action=login");
		exit;
	}	

?>