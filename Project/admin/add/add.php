<?php
include "../../config.php";
if(!isset($_SESSION["email"])){
    die("This page is not available for you, please register or login in <a href='/project'>home</a>.");
}
$email = $_SESSION["email"];
$sql = "SELECT * FROM admin WHERE userid = (SELECT id FROM user WHERE email = '$email')";
$result = mysqli_query($link, $sql);
$result = mysqli_fetch_all($result);
if(!$result){
    die("This page is not available for you, please return to <a href='/project'>home</a>.");
}
$name = $_POST["name"];
$cost = $_POST["cost"];
$count = $_POST['count'];
$type = $_POST['type'];
$sql = "INSERT INTO shop (name, cost, count, type) VALUES ('$name', '$cost', '$count','$type')";
mysqli_query($link, $sql);
header("Location: ../");