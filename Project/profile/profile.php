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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="project.css">
    <script src="https://kit.fontawesome.com/f237661d57.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>
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
</div>



    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="container-fluid text-center">
                    <h1>My Account</h1>
                    <hr>
                </div>
            </div>
        </div>
    </section>

    <div style="width: 400px; float: left; border: solid black; margin-left: 80px;">
    <form class="regis">
       	<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Microsoft_Account.svg/1200px-Microsoft_Account.svg.png" style="width: 200px;">
       	<p><span>@</span>Account Name</p>
    </form>
    </div>
    <div style="width:600px; border: solid black; margin-left: 585px; background-image: linear-gradient(white,#F2F2F3);overflow-y: scroll; height:245px;">
    <form class="regis">
        <h4 style="color: red;">View History</h4>
        <hr>
        <div class="regis">
            <h6 class="istory">1. Maneken asdjgjngadjgnad</h6>
            <hr>
            <h6 class="istory">2. Maneken1 agdhahasfhshs</h6>
            <hr>
            <h6 class="istory">3. Maneken2 ahahdafhah</h6>
            <hr>
            <h6 class="istory">4. Maneken3 ahahfhaf</h6>
            <hr>
            <h6 class="istory">5. Maneken4 ahhahahahahfa</h6>
            <hr>
            <h6 class="istory">6. Maneken5 ahhahfahfhaah</h6>
            <hr>
            <h6 class="istory">7. Maneken6 rywyweryyeer</h6>
            <hr>
        </div>
    </form>
    </div>
    <div style="width:600px; margin-left: 585px;">
            <button style="width: 100%; color:white">Clear</button>
        </div>

    <hr>
    <br>
    <br>
    <div style="margin-left: 80px; background-image: linear-gradient(white,#F2F2F3);height: 400px;">
        <h4 style="color:  rgb(150, 40, 40);">Account Settings</h4>
        <hr>

    <div>
        <select style="color:  rgb(150, 40, 40);">
            <option>Choose Action</option>
            <option value="red" style="color:white; ">Change Password</option>
            <option value="green" style="color:white; ">Change Login</option>
            <option value="blue" style="color:white; ">Change Email</option>
        </select>
    </div>
    <div class="red box">
        <div class="regis">
            <form action="change_password.php" method="POST">
                 <div> <label for="password">Email</label></div>
            <input type="email" name="email" style="width: 40%;">
            <br><br>
                <div> <label for="password">Old Password</label></div>
            <input type="password" name="pasold" style="width: 40%;">
            <br><br>
            <div><label for="password">New Password</label></div>
            <input type="password" name="password" style="width: 40%;">
            <div> <a href="#">Forgot your password ?</a></div>
            <br>
            <button style="width: 40%;">Change My Password(:</button>
            </form>
        </div>
    </div>
    <div class="green box">
        <div class="regis">
            <form action="change_username.php" method="POST">
                  <div> <label for="password">Email</label></div>
            <input type="email" name="email" style="width: 40%;">
            <br><br>
                <div><label for="password">Old Username</label></div>
            <input type="text" name="oldUserName" style="width: 40%;">
            <div><label for="password">New Username</label></div>
            <input type="text" name="newUserName" style="width: 40%;">
            <div> <a href="#">Forgot your username ?</a></div>
            <br>
            <button style="width: 40%;">Change My Login(:</button>
            </form>
        </div>
    </div>
    <div class="blue box">
        <div class="regis">
            <form action="change_email.php" method="POST">
                <div><label for="password">Old Email</label></div>
            <input type="email" name="oldEmail" style="width: 40%;">
                <div><label for="password">New Email</label></div>
            <input type="email" name="newEmail" style="width: 40%;">
            <div> <a href="#">Forgot your email ?</a></div>
            <br>
            <button style="width: 40%;">Change My Email(:</button>
            </form>
        </div>
    </div>
    </div>
<style>
    * {
        font-size: 14px;
        font-weight: normal;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }
    h1, h2, h3, h4, h5, h6, p, ul, ol {
        margin: 0;
        padding: 0;
    }
    .contact_section {
        margin: 0 0 60px 0;
        text-align: center;
    }
    .contact_info p {
        line-height: 28px;
        display: block;
        font-size: 14px;
        color: #7b7b7b;
        margin: 0 0 30px;
    }
    .footer_wrapper .social_links {
        text-align: left;
        margin-bottom: 25px;
    }
    .social_links li {
        display: inline-block;
        margin-right: 4px;
        padding: 0px;
    }
    .contact .social_links li a {
        display: block;
        text-align: center;
        color: #ffffff;
        border: 1px solid #ffffff;
        width: 32px;
        height: 32px;
        line-height: 32px;
    }
    @media (min-width: 1200px){
        .col-lg-4 {
            width: 33.33333333%;
        }
    }
    .contact_section h2{
        font-size: 40px;
        color: #ffffff;
        margin: 0 0 50px 0;
    }
    .page_section.contact {
        padding: 60px 0 50px;
        color: #fff;
    }
    .footer_wrapper {
        background: #2c3036;
    }
    .footer_bottom {
        border-top: 1px solid #171717;
        padding: 25px 0;
    }
    .footer_bottom span {
        display: block;
        font-size: 14px;
        color: #efefef;
        text-align: center;
    }
    .footer_bottom span a {
        display: inline-block;
        color: #b5b5b5;
        font-size: 14px;
        transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
    }
    .footer_bottom span a:hover {
        color: #fff;
    }
    .form-control{
        padding: 12px 15px;
        border-color: #5a5a5a;
        border-radius: 0;
        color: #dedede;
        background: #000;
        height: auto;
    }
    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #737373;
    }
    .btn-primary {
        color: #000000;
        background-color: #ffffff;
        border-color: #ffffff;
        padding: 10px 34px;
        border-radius: 0;
    }
</style>

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
        window.location = "/project/shop/cart";
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
    function man(){
        window.location = "man.php";
    }
    function woman(){
        window.location = "woman.php";
    }
    function catalog(){
        window.location = "/project/catalog"
    }
</script>




</body>

</html>
