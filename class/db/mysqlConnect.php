<?php
	class mysqlConnect {
	public function connect(){
		//Options for db.
		$query = "";
      $db_user = "root";
		// changed for web server
		//$db_user = "a1482798_root";

		$db_host = "localhost";
		//$db_host = "mysql17.000webhost.com";
//		changed for web server.
		//$db_password = "anil182";
		$db_password = "123456";
		//$db_name = "a1482798_survey2";
		$db_name = "surveyhead2";

		$mysqli = new mysqli($db_host,$db_user,$db_password,$db_name);

		// Check connection
		if ($mysqli -> connect_errno > 0)
		  {
		  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		return $mysqli;
	}
}


?>