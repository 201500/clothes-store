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
$sql = "SELECT * FROM shop WHERE id = '$id'";
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
<h1>Edit item</h1>
<form method="post" action="edit.php?i=<?=$_GET["i"]?>">
    <input type="text" name="name" placeholder="Name" value="<?= $result[0]["name"]?>"><br>
    <input type="number" name="cost" placeholder="Cost" value="<?= $result[0]["cost"]?>"><br>
    <input type="number" name="count" placeholder="Count" value="<?= $result[0]["count"]?>"><br>
    <input type="number" name="type" placeholder="Type" value="<?= $result[0]["type"]?>"><br>
    <input type="submit">
</form>
<h2>Add image</h2>
<form action="upload.php?i=<?=$_GET["i"]?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image"><br>
    <input type="submit" value="Upload">
</form>
</body>
</html>