<?php
include "../../config.php";
$id = $_GET["i"];
if(!isset($_SESSION["email"])){
    die("This page is not available for you, please register or login in <a href='/project'>home</a>.");
}
$email = $_SESSION["email"];
$sql = "SELECT * FROM user WHERE email = '$email'";
$user = mysqli_query($link, $sql);
$user = mysqli_fetch_all($user, MYSQLI_ASSOC);
$array = unserialize($user[0]["cart"]);
array_splice($array, array_search($id, $array), 1);
$array = serialize($array);
$sql = "UPDATE user SET cart = '$array' WHERE email = '$email'";
mysqli_query($link , $sql);
header("Location: /project/shop/cart");
