<?php
include "../config.php";
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
$sql = "SELECT * FROM shop";
$result = mysqli_query($link, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
$sql = "SELECT * FROM user";
$users = mysqli_query($link, $sql);
$users = mysqli_fetch_all($users, MYSQLI_ASSOC);
$sql = "SELECT * FROM user WHERE email = '$email'";
$user = mysqli_query($link, $sql);
$user = mysqli_fetch_all($user, MYSQLI_ASSOC);
?>
<html>
<head>
    <title>Admin panel</title>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link href="style063.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">XClothes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#" onclick="home()">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" onclick="shop()">Shop<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" onclick="catalog()">Catalog<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/project/profile/profile.php">Profile<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="admin()">//I am Admin//</a>
                </li>


            </ul>
            <i class="fa" style="font-size:24px">
                <img src="/project/shop/images/cart.png" class="cart__icon" onclick="cart()">
            </i>
            <span class='badge badge-warning' id='count' onclick="cart()"><?= count(unserialize($user[0]["cart"]))?></span>
        </div>
    </nav>
<h1 id="addd">Admin page</h1>
    <div class="row">
        <div class="col-lg-6">
<h2>Item list</h2>
<button onclick="add()">Add item</button>
<table>
    <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Cost</th>
        <th>Count</th>
        <th>Type</th>
        <th>Action</th>
    </tr>
    <?php foreach ($result as $item):?>
    <tr>
        <td><?=$item["id"]?></td>
        <td>
        <?php
        $id = $item["id"];
        $filedir = "../images/$id.png";
        if(file_exists($filedir)){
            echo "<img src='../images/$id.png'>";
        } else {
            echo "<img src='/project/shop/images/no.png'>";
        }
        ?>
        </td>
        <td><?=$item["name"]?></td>
        <td><?=$item["cost"]?></td>
        <td><?=$item["count"]?></td>
        <td><?=$item["type"]?></td>
        <td><button onclick="edit(<?=$item["id"]?>)">Edit</button><button onclick="del(<?=$item["id"]?>)">Delete</button></td>
    </tr>
    <?php endforeach; ?>
</table>
    </div>
        <div class="col-lg-6">
<h2>Users list</h2>
<button onclick="give()">Admin settings</button>
<table>
    <tr>
        <th>ID</th>
        <th>EMail</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user):?>
        <tr>
            <td><?=$user["id"]?></td>
            <td><?=$user["email"]?></td>
            <td><?=$user["name"]?></td>
            <?php
            $id = $user["id"];
            $sql = "SELECT * FROM banlist WHERE userid = '$id'";
            $check = mysqli_query($link, $sql);
            $check = mysqli_fetch_all($check);
            if($check): ?>
                <td><button onclick="unban(<?= $user["id"]?>)">Unban</button></td>
            <?php else:; ?>
                <td><button onclick="ban(<?=$user["id"]?>)">Ban</button></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
        </div>
    </div>
</div>
</body>
<script>
    function add(){
        window.location = "add";
    }
    function edit(id){
        window.location = "edit/?i=" + id;
    }
    function del(id){
        window.location = "delete.php?i=" + id;
    }
    function ban(id){
        window.location = "ban/?i=" + id;
    }
    function unban(id){
        window.location = "unban.php?i=" + id;
    }
    function admin(){
        window.location = "/project/admin";
    }
    function shop(){
        window.location = "/project/shop";
    }
    function catalog(){
        window.location = "/project/catalog";
    }
    function home(){
        window.location = "/project";
    }
    function cart(){
        window.location = "/project/shop/cart";
    }
    function give(){
        window.location = "/project/admin/give";
    }

</script>

</html>