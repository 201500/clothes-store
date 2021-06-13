<?php
if(isset($_COOKIE["LightCookie"]))
    setcookie("LightCookie", "", time() - 3600);
else
    setcookie("LightCookie", "true", time() + 3600 * 24 * 30);
header("Location: ../shop");