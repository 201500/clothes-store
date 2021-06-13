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
	$newEmail = $_POST['newEmail'];
	$oldEmail = $_POST['oldEmail'];

	$queryToGetEmail = "SELECT email FROM user WHERE email = '$oldEmail'";
	$result = $connect->query($queryToGetEmail);
	$row = $result->fetch_assoc();
	if (strcmp($row['email'], $oldEmail) == 0) {
		$queryToChangeEmail = "UPDATE user SET email = '$newEmail' WHERE email = '$oldEmail'";
		$connect->query($queryToChangeEmail);
		echo "Email changed succesfully";
	}

?>