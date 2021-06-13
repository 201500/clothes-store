<?php
include "config.php";
$email = $_REQUEST["email"];
$name = $_REQUEST["name"];
$password1 = $_REQUEST["password1"];
$password2 = $_REQUEST["password2"];
if(strcmp($password1, $password2) !== 0){
    die("Password are not same");
}
$password = hash("sha1", $password1);
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($link, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
if($result != false){
    die("This email is already exists");
}
$sql = "INSERT INTO user (email, password, name) VALUES ('$email', '$password', '$name')";
mysqli_query($link, $sql);
$_SESSION["email"] = $email;