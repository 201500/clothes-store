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
?>
<html>
<head>
    <title>Add item</title>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<h1>Add item</h1>
<form method="post" action="add.php">
    <input type="text" name="name" placeholder="Name"><br>
    <input type="number" name="cost" placeholder="Cost"><br>
    <input type="number" name="count" placeholder="Count"><br>
    <input type="number" name="type" placeholder="Type"><br>
    <input type="submit">
</form>
<h2>Add image</h2>
<form action="upload.php?i=<?=$_GET["i"]?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image"><br>
    <input type="submit" value="Upload">
</form>
<a id="bbb" href="/project/admin">back</a>
</html>