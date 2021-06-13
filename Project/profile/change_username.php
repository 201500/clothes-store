<?php
	$server_name = "localhost";
	$database_username = "root";
	$database_password = "";
	$database_name = "project";
	
	$connect = new mysqli($server_name, $database_username, $database_password, $database_name);

	if($connect->connect_error){
		echo "ERROR";
	}
	if(session_id() == '') {
    	session_start();
	}
	$email = $_POST['email'];
	$newUserName = $_POST['newUserName'];
	$oldUserName = $_POST['oldUserName'];

	$queryToGetUsername = "SELECT name FROM user WHERE email = '$email'";
	$result = $connect->query($queryToGetUsername);
	$row = $result->fetch_assoc();
	if (strcmp($row['name'], $oldUserName) == 0) {
		$queryToChangeUsername = "UPDATE user SET name = '$newUserName' WHERE email = '$email'";
		$connect->query($queryToChangeUsername);
		echo "Username changed succesfully";
	}

?>