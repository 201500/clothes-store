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
$sql = "SELECT * FROM user";
$users = mysqli_query($link, $sql);
$users = mysqli_fetch_all($users, MYSQLI_ASSOC);
$sql = "SELECT * FROM admin";
$admins = mysqli_query($link, $sql);
$admins = mysqli_fetch_all($admins, MYSQLI_ASSOC);
?>
<html>
<head>
    <title>Admin panel</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-lg-6">
            <h1>Give admin</h1>
            <form method="post" action="give.php">
                <input type="text" name="userid" placeholder="UserID"><br>
                <input type="submit">
            </form>
            <h1>Pick up admin</h1>
            <form method="post" action="pickup.php">
                <input type="text" name="userid" placeholder="UserID"><br>
                <input type="submit">
            </form>
        </div>

        <div class="col-lg-6">
            <h2>Users list</h2>
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
            <h2>Admin ID list</h2>
            <table>
                <tr>
                    <th>ID</th>
                </tr>
                <?php foreach ($admins as $admin):?>
                    <tr>
                        <td><?=$admin["userid"]?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <style>
    #bbb{
        margin-left: 40%;
    }
    </style>
    <a id="bbb" href="/project/admin">back</a>

</div>

</body>

<script>
    function back(){
        window.location "/project/admin";
    }
</script>

</html>