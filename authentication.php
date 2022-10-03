<?php

	// Server, database name, sqluserid, and sqlpassword
	// Change to your own server, database, id and password

	$server = "localhost";
	$sqlUsername = "vnaga002";
	$sqlPassword = "Gopal:1234";
	$databaseName = "group10";
	// $server = "localhost";
	// $sqlUsername = "vnaga002";
	// $sqlPassword = "Gopal:1234";
	// $databaseName = "group1";
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else
	{
		echo "Connected successfully";
	}

	//function to authenticate user, and return TRUE or FALSE
	function authenticateUser($connection, $username, $password)
	{
	  // User table which stores userid and password
	  // Change to your own table name
	  $userTable = "USERS";
	  // Test the username and password parameters
	  if (!isset($username) || !isset($password))
		return false;

	  $pa = md5($password);
	  // Formulate the SQL statment to find the user
	  $sql = "SELECT *
		 FROM $userTable
		 WHERE UserName = '$username' AND password = '$pa'";
	  // Execute the query
          $query_result = $connection->query($sql);
          if (!$query_result) {
              echo "Sorry, query is wrong";
              echo $query;
          }

	  // exactly one row? then we have found the user
          $nrows = $query_result->num_rows;
	  if ( $nrows != 1)
		return false;
	  else {
		while($row = $query_result->fetch_assoc()) {
			$_SESSION['userIDS'] = $row["UserID"];
			$_SESSION['role'] = $row["Role"];
			return true;
		}
	  }
		
	}

?>
