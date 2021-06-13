<?php
include "../../config.php";
if(!isset($_SESSION["email"])){
    die("This page is not available for you, please register or login in <a href='/project'>home</a>.");
}
$email = $_SESSION["email"];
$sql = "SELECT * FROM user WHERE email = '$email'";
$user = mysqli_query($link, $sql);
$user = mysqli_fetch_all($user, MYSQLI_ASSOC);
$array = unserialize($user[0]["cart"]);
$total = 0;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Shop</title>
    <link href="cartstyle1.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
        <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="test.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.16.1, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">


    <style>
        h1#basket {
            font-family: "Audiowide", sans-serif;
        }

        .table_blur {
            background: #f5ffff;
            border-collapse: collapse;
            text-align: left;
            width: 80%;
            border: 1px solid black;
        }
        .table_blur th {
            border-top: 1px solid #777777;
            border-bottom: 1px solid #777777;
            box-shadow: inset 0 1px 0 #999999, inset 0 -1px 0 #999999;
            background: linear-gradient(#9595b6, #5a567f);
            color: white;
            padding: 10px 15px;
            position: relative;
        }
        .table_blur th:after {
            content: "";
            display: block;
            position: absolute;
            left: 0;
            top: 25%;
            height: 25%;
            width: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0), rgba(255,255,255,.08));
        }
        .table_blur tr:nth-child(odd) {
            background: #ebf3f9;
        }
        .table_blur th:first-child {
            border-left: 1px solid #777777;
            border-bottom:  1px solid #777777;
            box-shadow: inset 1px 1px 0 #999999, inset 0 -1px 0 #999999;
        }
        .table_blur th:last-child {
            border-right: 1px solid #777777;
            border-bottom:  1px solid #777777;
            box-shadow: inset -1px 1px 0 #999999, inset 0 -1px 0 #999999;
        }
        .table_blur td {
            border: 1px solid #e3eef7;
            padding: 10px 15px;
            position: relative;
            transition: all 0.5s ease;
        }
        .table_blur tbody:hover td {
            color: transparent;
            text-shadow: 0 0 3px #a09f9d;
        }
        .table_blur tbody:hover tr:hover td {
            color: #444444;
            text-shadow: none;
        }
        .cart {
            float: right;
            margin-top: 30px;
            margin-right: 100px;
        }
        .label-warning[href],
        .badge-warning[href] {
            background-color: #c67605;
        }
        .cart__icon {
            width: 30px;
            height: 30px;
            cursor: pointer;
            margin-left: 40px;
            filter: invert(100%);
        }
        #count {
            font-size: 20px;
            background: #ff0000;
            color: #fff;
            padding: 0 5px;
            vertical-align: top;
            margin-left: -10px;
        }

    </style>
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
                <img src="../images/cart.png" class="cart__icon" onclick="cart()">
            </i>
            <span class='badge badge-warning' id='count' onclick="cart()"><?= count(unserialize($user[0]["cart"]))?></span>
        </div>
    </nav>
</div>


<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <div class="container-sm">


<!--<div id="ani"></div>-->
<h1 id="basket">Basket</h1>



    <table class="table_blur">
        <tr>
            <th>Clothes</th>
            <th>Cost</th>
            <th>Number</th>
            <th>Total</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($array as $item):
            $id = $item["id"];
            $sql = "SELECT * FROM shop WHERE id = '$id'";
            $dis = mysqli_query($link, $sql);
            $dis = mysqli_fetch_all($dis, MYSQLI_ASSOC);
            $total += $dis[0]["cost"] * $item["count"];
            ?>
            <tr>
                <td><?= $dis[0]["name"]?></td>
                <td><?= $dis[0]["cost"]?> KZT</td>
                <td><?= $item["count"] ?></td>
                <td><?= $dis[0]["cost"] * $item["count"]?></td>
            <td><a href="delete.php?i=<?=$item["id"]?>">X</a></td>
            </tr>
        <?php endforeach; ?>


    </table>

    <h3 ><code class="font-effect-emboss">Total: </code><?=$total?></h3>
<h3><button onclick="buy()" type="button" class="btn btn-danger">Buy</button>
    <a  href="../" class="btn btn-outline-secondary">Home</a></h3>

</div>

             </div>
        <div class="card">


            <div class="u-body">
            <section class="u-align-left u-clearfix u-palette-1-dark-2 u-section-1" id="carousel_28ff">
                <div class="u-clearfix u-sheet u-sheet-1">
                    <div class="u-align-left u-container-style u-group u-group-1">
                        <div class="u-container-layout u-container-layout-1">
                            <h2 class="u-text u-text-1">Make a reservation</h2>
                            <p class="u-text u-text-2">leave your details to place your order </p>
                        </div>
                    </div>
                    <div class="u-form u-form-1">
                        <form action="mail.php" method="POST">
                            <label for="email-f2a8" class="u-label u-text-grey-40">E-mail</label>
                                <input type="email" placeholder="Enter a valid email address" id="email-f2a8" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                                <label for="name-f2a8" class="u-label u-text-grey-40">Name</label>
                                <input type="text" placeholder="Enter your Name" id="name-f2a8" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                                 <label for="date-4441" class="u-label u-text-grey-40">Date</label>
                                <input type="date" placeholder="MM/DD/YYYY" id="date-4441" name="date" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                                <label for="phone-447e" class="u-label u-text-grey-40">Phone</label>
                                <input type="tel" pattern="\+?\d{0,2}[\s\(\-]?([0-9]{3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Enter your phone (e.g. +14155552675)" id="phone-447e" name="phone" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                                <label for="message-f2a8" class="u-label u-text-grey-40">Adress</label>
                                <textarea placeholder="Enter your adress" rows="1" cols="50" id="message-f2a8" name="address" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required=""></textarea>
                                <label for="message-f2a8" class="u-label u-text-grey-40">Message</label>
                                <textarea placeholder="Enter your message" rows="4" cols="50" id="message-f2a8" name="message" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required=""></textarea>

                    
                       <!--  <form action="mail.php" method="POST" class="u-clearfix u-form-spacing-20 u-form-vertical u-inner-form" style="padding: 10px" source="custom" name="form">
                            <div class="u-form-email u-form-group u-form-partition-factor-2 u-form-group-1">
                                <label for="email-f2a8" class="u-label u-text-grey-40">E-mail</label>
                                <input type="email" placeholder="Enter a valid email address" id="email-f2a8" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                            </div>
                            <div class="u-form-group u-form-name u-form-partition-factor-2 u-form-group-2">
                                <label for="name-f2a8" class="u-label u-text-grey-40">Name</label>
                                <input type="text" placeholder="Enter your Name" id="name-f2a8" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                            </div>
                            <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-3">
                                <label for="date-4441" class="u-label u-text-grey-40">Date</label>
                                <input type="date" placeholder="MM/DD/YYYY" id="date-4441" name="date" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                            </div>
                            <div class="u-form-group u-form-partition-factor-2 u-form-phone u-form-group-4">
                                <label for="phone-447e" class="u-label u-text-grey-40">Phone</label>
                                <input type="tel" pattern="\+?\d{0,2}[\s\(\-]?([0-9]{3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Enter your phone (e.g. +14155552675)" id="phone-447e" name="phone" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required="">
                            </div>
                            <div class="u-form-group u-form-message u-form-group-5">
                                <label for="message-f2a8" class="u-label u-text-grey-40">Adress</label>
                                <textarea placeholder="Enter your adress" rows="1" cols="50" id="message-f2a8" name="address" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required=""></textarea>
                            </div>
                            <div class="u-form-group u-form-message u-form-group-5">
                                <label for="message-f2a8" class="u-label u-text-grey-40">Message</label>
                                <textarea placeholder="Enter your message" rows="4" cols="50" id="message-f2a8" name="message" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-1" required=""></textarea>
                            </div>

                            <div class="u-align-left u-form-group u-form-submit u-form-group-6">
                                <a href="#" class="u-border-2 u-border-white u-btn u-btn-rectangle u-btn-submit u-button-style u-none u-btn-1">Submit</a>
                                <input type="submit" value="submit" class="u-form-control-hidden">
                            </div> -->
                            <input type="submit" style="background-color: transparent;height: 40px;width: 150px;border: 1px solid #fff;" value="Submit">
                           <!--  <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
                            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div> -->
                           <!--  <input type="hidden" value="" name="recaptchaResponse"> -->
                        </form>
                    </div>
                </div>
            </section>


            </div>


        </div>
    </div>


</div>
</div>

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

    function buy(){
        window.location = "buy.php";
    }
    function cart(){
        window.location = "../cart";
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