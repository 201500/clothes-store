<?php
include "../config.php";
$sql = "SELECT * FROM shop";
$result = mysqli_query($link, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
function email(){
    if(!isset($_SESSION["email"])){
        throw new Exception("This page is not available for you, please register or login in <a href='/project'>home</a>.");
    }
    return $_SESSION["email"];
}
try{
    $email = email();
}
catch (Exception $e){
    die($e);
}
$sql = "SELECT * FROM user WHERE email = '$email'";
$user = mysqli_query($link, $sql);
$user = mysqli_fetch_all($user, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Shop</title>
    <link href="style3.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" onclick="light()">XClothes</a>
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
                <img src="images/cart.png" class="cart__icon" onclick="cart()">
            </i>
            <span class='badge badge-warning' id='count' onclick="cart()"><?= count(unserialize($user[0]["cart"]))?></span>
        </div>
    </nav>
</div>
<div class="content">
    <?php foreach ($result as $item):
    if($item["count"] > 0):
    ?>
        <div class="item">
            <?php
            $id = $item["id"];
            $filedir = "../images/$id.png";
            if(file_exists($filedir)){
                echo "<img src='../images/$id.png'>";
            } else {
                echo "<img src='images/no.png'>";
            }
            ?>
            <p class="dis"><?= $item["name"] ?> | <?= $item["cost"] ?> KZT</p>
            <input type="number" style="width: 50px" value="1" id="<?=$item['id']?>" max="<?=$item["count"]?>" oninput="edit(id, <?=$item["count"]?>)">
            <button onclick="add(<?=$item['id']?>)">Buy</button>
            <p>Only <?=$item["count"]?> available</p>
        </div>
    <?php endif; endforeach; ?>
</div>


<!-- footer -->

<footer class="footer_wrapper" id="contact">
    <div class="container">
        <section class="page_section contact" id="contact">
            <div class="contact_section">
                <h2>Get In Touch</h2>
                <h6>Write me</h6>
            </div>
            <div class="row">
                <div class="col-lg-4 wow fadeInLeft">
                    <div class="contact_info">
                        <div class="detail">
                            <h4>BoostedMeerkat</h4>
                            <p>100, Pushkin, Semey, Kazakhstan</p>
                        </div>
                        <div class="detail">
                            <h4>call us</h4>
                            <p>+7 (705) 263 73 88</p>
                        </div>
                        <div class="detail">
                            <h4>Email us</h4>
                            <p>didarplay4@gmail.com</p>
                        </div>
                    </div>
                    <ul class="social_links">
                        <li class="twitter animated bounceIn wow delay-02s"><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li class="facebook animated bounceIn wow delay-03s"><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li class="pinterest animated bounceIn wow delay-04s"><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                        <li class="gplus animated bounceIn wow delay-05s"><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 wow fadeInLeft delay-06s">
                    <!--NOTE: Update your email Id in "contact_me.php" file in order to receive emails from your contact form-->
                    <form name="sentMessage" id="contactForm"  novalidate>
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" class="form-control"
                                       placeholder="Full Name" id="name" required
                                       data-validation-required-message="Please enter your name" />
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="email" class="form-control" placeholder="Email"
                                       id="email" required
                                       data-validation-required-message="Please enter your email" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
<textarea rows="10" cols="100" class="form-control"
          placeholder="Message" id="message" required
          data-validation-required-message="Please enter your message" minlength="5"
          data-validation-minlength-message="Min 5 characters"
          maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"> </div> <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary pull-right">Send</button><br />
                    </form>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <div class="footer_bottom"><span>Copyright © 2021. <a href="https://webthemez.com/free-bootstrap-templates/" target="_blank">Bootstrap Templates</a> By BoostedMeerkat</span> </div>
    </div>
</footer>
<!-- //footer 14 -->
<script src="https://use.fontawesome.com/df966d76e1.js"></script>


</body>

<script>
    $(document).ready(function () {

    });

    function edit(id, max){
        if($("#"+id).val() > max){
            $("#"+id).val(max);
        }
        if($("#"+id).val() == ""){
            $("#"+id).val(0);
        }
    }
    function add(id){
        var string = "#" + id;
        var count = $(string).val();
        $.post("addToCart.php", {id: id, count: count}, function (data, status) { //Jquery post php connection
            var string = JSON.parse(data);
            $("#count").html(string.length);
        })
    }
    function cart(){
        window.location = "cart";
    }
    function home(){
        window.location = "/project";
    }
    function admin(){
        window.location = "/project/admin";
    }
    function shop(){
        window.location = "/project/shop"
    }
    function catalog(){
        window.location = "/project/catalog"
    }
</script>
</html>