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
	$old_password = $_POST['pasold'];
	$new_password = $_POST['password'];
	$old_password = hash("sha1", $old_password);
	$new_password = hash("sha1", $new_password);
	$email = $_POST['email'];

	$queryToGetPassword = "SELECT password FROM user WHERE email = '$email'";
	$result = $connect->query($queryToGetPassword);
	$row = $result->fetch_assoc();
	if (strcmp($row['password'], $old_password) == 0) {
		$queryToChangePassword = "UPDATE user SET password = '$new_password' WHERE email = '$email'";
		$connect->query($queryToChangePassword);
		echo "Password changed succesfully";
	}

?>