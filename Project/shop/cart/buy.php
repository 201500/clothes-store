<?php
include "../../config.php";
if(!isset($_SESSION["email"])){
    die("This page is not available for you, please register or login in <a href='/project'>home</a> page.");
}
$email = $_SESSION["email"];
$sql = "SELECT cart FROM user WHERE email = '$email'";
$array = unserialize(mysqli_fetch_all(mysqli_query($link, $sql), MYSQLI_ASSOC)[0]["cart"]);
foreach ($array as $item){
    $id = $item["id"];
    $count = $item["count"];
    $sql = "UPDATE shop SET count = count - '$count' WHERE id = '$id'";
    mysqli_query($link, $sql);
}
$array = serialize(Array());
$sql = "UPDATE user SET cart = '$array' WHERE email = '$email'";
mysqli_query($link, $sql);
echo mysqli_error($link);
header("Location: /project/shop");