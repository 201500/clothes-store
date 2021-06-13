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
if(!isset($_GET["i"])){
    die("No item is chosen");
}
$id = $_GET["i"];
$sql = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($link, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<html>
<head>
    <title>Edit item</title>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<h1>Ban</h1>
<p>You are going to ban <?=$result[0]["name"]?></p>
<form action="ban.php?i=<?=$id?>" method="post">
    <label for="reason">Reason:</label><br>
    <textarea name="reason"></textarea><br>
    <input type="submit" value="Continue">
    <a href="../">Back</a>
</form>
</body>
</html>