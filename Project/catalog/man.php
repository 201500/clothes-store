<?php
if(isset($_COOKIE["man"]))
    setcookie("man", "", time() - 3600);
else
    setcookie("man", "true", time() + 3600 * 24 * 30);
header("Location: ../catalog ");