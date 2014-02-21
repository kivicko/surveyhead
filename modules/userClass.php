<?php

	class userClass{

		public $id = '';

		public function delete($_id){
			$id = $_id;
			

			$mysqli = new mysqlConnect();
			$dbRowSet = $mysqli->connect();

			$query = 	"DELETE FROM user WHERE user_id = $id ";

					if($dbRowSet->query($query)){
						return true;
					}else{
						return false;
					}
		}

		public function add( $_name, $_surname, $_username, $_password, $_age, $_role, $_phone, $_email){
			$mysqli = new mysqlConnect();
			$dbRowSet = $mysqli->connect();
			$name = $_name;
			$surname = $_surname;
			$username = $_username;
			$password = $_password;
			$age = $_age;
			$role = $_role;
			$phone = $_phone;
			$email = $_email;
			$query = "INSERT INTO user (username,password,name,surname,age,phone,email) 
			VALUES ('$username','$password','$name','$surname','$age','$phone','$email')";
			$query2 = "INSERT INTO user_role (id_user,id_role) 
			VALUES( (SELECT user_id from user where username = '$username') , $role )";
			if($dbRowSet->query($query)){
				if($dbRowSet->query($query2)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}

		public function update($_name, $_surname,$_username, $_age, $_phone, $_email, $_id){
			$mysqli = new mysqlConnect();
			$dbRowSet = $mysqli->connect();

			
			$name = $_name;
			$surname = $_surname;
			$username = $_username;
			$age = $_age;
			$phone = $_phone;
			$email = $_email;
			$id = $_id;
			$query = "UPDATE user SET name = '$name', surname = '$surname', username = '$username', age = '$age', phone = $phone, email = '$email'
					  WHERE user_id = $id";
			if($dbRowSet->query($query)){
				return true;
			}else{
				return false;
			}

		}

	}




?>