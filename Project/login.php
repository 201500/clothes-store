<?php
include "config.php";
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$password = hash("sha1", $password);
$sql = "SELECT * FROM user WHERE email = '$email' AND password='$password'";
$result = mysqli_query($link, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
if($result == false){
    die("Email or password is incorrect");
}
$id = $result[0]["id"];
$sql = "SELECT * FROM banlist WHERE userid = '$id'";
$result = mysqli_fetch_all(mysqli_query($link, $sql), MYSQLI_ASSOC);
if($result){
    $reason = $result[0]["reason"];
    die("This account was banned! Reason: $reason");
}
$_SESSION["email"] = $email;