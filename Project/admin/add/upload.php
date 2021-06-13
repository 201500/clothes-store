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
$path = "../../images/$id.png";
if(move_uploaded_file($_FILES["image"]["tmp_name"], $path)){
    if(!file_exists($path)){
        die('Something went wrong uploading file');
    }
} else {
    die('Something went wrong uploading file');
}
header("Location: ../");