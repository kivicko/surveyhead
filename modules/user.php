<?php
		session_start();
		if( !isset($_SESSION["role"])){
			$_SESSION["role"]=3 ;
		}
		if( $_SESSION["role"] == 1 ){
			
?>
<table border="1">
<tr>
<th>ID</th>
<th>Username</th>
<th>Name</th>
<th>Surname</th>
<th>Age</th>
<th>Phone</th>
<th>Email</th>
 <!--<th>Creation Date</th>
<th>Last Update</th> -->
</tr>

<?php
		
	    $mysqli = new mysqlConnect();
        $dbRowSet = $mysqli->connect();
        $query = "SELECT * FROM user";
       
        if($result = $dbRowSet->query($query))        {

		echo "<form name='input' action='?action=userUpdate' method='post' enctype='multipart/form-data'>";

		while($row = $result-> fetch_assoc() ) {
			echo "<tr>";
			echo "<td><input type='text' name='id[]' value='" . $row["user_id"] .  "' readonly> </td>";
			echo "<td><input type='text' name='username[]' value='" . $row["username"] . "'> </td>";
			echo "<td><input type='text' name='name[]' value='" . $row["name"] . "'> </td>";
			echo "<td><input type='text' name='surname[]' value='" . $row["surname"] . "'> </td>";
			echo "<td><input type='text' name='age[]' value='" . $row["age"] . "'> </td>";
			echo "<td><input type='text' name='phone[]' value='" . $row["phone"] . "'> </td>";
			echo "<td><input type='text' name='email[]' value='" . $row["email"] . "'> </td>";
			//echo "<td>" . $row["creation_date"] . "</td>";
			//echo "<td>" . $row["last_update"] . " </td>";
			echo "</tr>";
		}
		echo "<td><input type='submit' value='Change!'></td>";
		echo "</form>"; 
		echo "</table>";
	}
		echo "<table>";
		echo "<tr>";
		echo "<form name='input' action='?action=userOption' method='post' enctype='multipart/form-data'><br>";
		echo "<td><input type='text' name='username' value='' placeholder='username'></td><br>";
		echo "<td><input type='password' name='password' value='' placeholder='password'></td><br>";
		echo "<td><input type='text' name='name' value='' placeholder='name'></td>";
		echo "<td><input type='text' name='surname' value='' placeholder='surname'></td></tr>";
		echo "<tr><td><input type='text' name='role' value='' placeholder='role'></td>";
		echo "<td><input type='text' name='age' value='' placeholder='age'></td>";
		echo "<td><input type='text' name='phone' value='' placeholder='phone'></td>";
		echo "<td><input type='text' name='email' value='' placeholder='email'></td>";
		echo "</tr>";
		echo "<td><input type='submit' value='Add User'></td>";
		echo "</form>";
		echo "</table>";

		echo "<table>";
		echo "<tr>";
		echo "<form name='input' action='?action=userDelete' method='post' enctype='multipart/form-data'><br>";
		echo "<td><input type='text' name='userID' value='' placeholder='user id'></td><br>";
		echo "</tr>";
		echo "<td><input type='submit' value='Delete User'></td>";
		echo "</form>";
		echo "</table>";

}else{
	echo"YOU DONT HAVE PERMISSON TO ENTER HERE.";
	header("Refresh: 1 ; url=?action=main");

}

	?>


