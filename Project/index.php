<?php session_start() ?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Home</title>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="header" id="header">
            <h3>Menu</h3>
        </div>
        <div class="container__body" id="body">
            <ul>
                <li><a href="#">Home</a></li>
                <?php if(isset($_SESSION["email"])): ?>
                    <li><a href="shop">Shop</a></li>
                    <li><a href="logout.php">LogOut</a></li>
                <?php else: ?>
                    <li><a onclick="openLogin()">Authorize</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="login-wrap">
    <div class="login-html">
        <a class="login__close" onclick="closeLogin()"><h5 style="color: red">Close</h5></a>
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
        <div class="login-form">
            <div class="sign-in-htm">
                <p id="logerror" style="color: red"></p>
                <div class="group">
                    <label for="email" class="label">EMail</label>
                    <input id="logemail" type="text" class="input">
                </div>
                <div class="group">
                    <label for="pass" class="label">Password</label>
                    <input id="logpassword" type="password" class="input" data-type="password">
                </div>
                <div class="group">
                    <input type="submit" class="button" value="Sign In" id="signin">
                </div>
            </div>
            <div class="sign-up-htm">
                <p id="regerror" style="color: red"></p>
                <div class="group">
                    <label for="user" class="label">Full name</label>
                    <input id="user" type="text" class="input">
                </div>
                <div class="group">
                    <label for="pass" class="label">Password</label>
                    <input id="pass1" type="password" class="input" data-type="password">
                </div>
                <div class="group">
                    <label for="pass" class="label">Repeat Password</label>
                    <input id="pass2" type="password" class="input" data-type="password">
                </div>
                <div class="group">
                    <label for="pass" class="label">Email Address</label>
                    <input id="email" type="text" class="input">
                </div>
                <div class="group">
                    <input type="submit" class="button" value="Sign Up" id="signup">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="page">
        <div class="intro-header">
            <div class="bg-image parallax-bg"></div>
            <div class="header-content row">
                <h1>XClothes</h1>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <span>
                Attention he extremity unwilling on otherwise. Conviction up partiality as delightful is discovered. Yet jennings resolved disposed exertion you off. Left did fond drew fat head poor. So if he into shot half many long. China fully him every fat was world grave.
                </span>
                <span>
                Improve ashamed married expense bed her comfort pursuit mrs. Four time took ye your as fail lady. Up greatest am exertion or marianne. Shy occasional terminated insensible and inhabiting gay. So know do fond to half on. Now who promise was justice new winding. In finished on he speaking suitable advanced if. Boy happiness sportsmen say prevailed offending concealed nor was provision. Provided so as doubtful on striking required. Waiting we to compass assured.
                </span>
                <span>
                Bringing unlocked me an striking ye perceive. Mr by wound hours oh happy. Me in resolution pianoforte continuing we. Most my no spot felt by no. He he in forfeited furniture sweetness he arranging. Me tedious so to behaved written account ferrars moments. Too objection for elsewhere her preferred allowance her. Marianne shutters mr steepest to me. Up mr ignorant produced distance although is sociable blessing. Ham whom call all lain like.
                </span>
            </div>
            <div class="gal">
                <div class="box">
                    <img src="images/w.png">
                    <span>Winter</span>
                </div>
                <div class="box">
                    <img src="images/s.png">
                    <span>Spring</span>
                </div>
                <div class="box">
                    <img src="images/su.png">
                    <span>Summer</span>
                </div>
                <div class="box">
                    <img src="images/a.png">
                    <span>Autumn</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $("#signin").click(function () {
            var email = $("#logemail").val();
            var password = $("#logpassword").val();
            $.post("login.php", {email: email, password: password}, function (data, status) {
                $("#logerror").html(data);
                if(data.length == 0){
                    window.location="/project";
                }
            });
        });
        $("#signup").click(function () {
            var name = $("#user").val();
            var password1 = $("#pass1").val();
            var password2 = $("#pass2").val();
            var email = $("#email").val();
            if(name.length === 0 || password1.length === 0 || password2.length === 0 || email.length === 0){
                $("#regerror").html("Please fill all fields");
                return;
            }
            $.post("signup.php", {email: email, password1: password1, password2: password2, name: name}, function (data, status) {
                $("#regerror").html(data);
                if(data.length == 0){
                    window.location="/project";
                }
            })
        });
        $(".login-wrap").fadeOut(0);
        $(".card").animate({height: "70px"});
        $(".header").animate({borderRadius: "10px"});
        $("#body").slideToggle();
        var a = true;
        $("#header").click(function(){
            if(a == false)
            {
                $(".card").animate({height: "70px"});
                $(".header").animate({borderRadius: "10px"});
                $("#body").slideToggle();
                a = true;
            }
            else
            {
                $(".card").animate({height: "<?php if(isset($_SESSION['email'])){echo 250;}else{echo 200;}?>px"});
                $(".header").animate({borderRadius: "10px 10px 0px 0px"});
                $("#body").slideToggle();
                a = false;
            }
        });
        var $parallaxElement = $('.parallax-bg');
        var elementHeight = $parallaxElement.outerHeight();
        function parallax() {
            var scrollPos = $(window).scrollTop();
            var transformValue = scrollPos/40;
            var opacityValue =  1 - ( scrollPos / 2000);
            var blurValue = Math.min(scrollPos / 100, 3);
            if ( scrollPos < elementHeight ) {
                $parallaxElement.css({
                    'transform': 'translate3d(0, -' + transformValue + '%, 0)',
                    'opacity': opacityValue,
                    '-webkit-filter' : 'blur('+blurValue+'px)'
                });
            }
        }
        $(window).scroll(function() {
            parallax();
        });
    });
    function openLogin() {
        $(".login-wrap").fadeIn(100);
    }
    function closeLogin() {
        $(".login-wrap").fadeOut(100);
    }
</script>
</html>