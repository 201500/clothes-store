<?php
include "../config.php";
if(!isset($_SESSION["email"])){
    die("Hello");
}
$email = $_SESSION['email'];
$sql = "SELECT cart FROM user WHERE email = '$email'";
$result = mysqli_query($link , $sql);
$result = mysqli_fetch_all($result);
$id = $_POST["id"];
$count = $_POST["count"];
$array = unserialize($result[0][0]);
$is = true;
for($i = 0; $i < count($array); $i++){
    if($array[$i]["id"] == $id){
        $array[$i]["count"] += $count;
        $is = false;
        break;
    }
}
if($is) {
    $arr = Array("id" => $id, "count" => $count);
    array_push($array, $arr);
}
$results = serialize($array);
$sql = "UPDATE user SET cart = '$results' WHERE email = '$email'";
mysqli_query($link , $sql);
echo json_encode($array);
