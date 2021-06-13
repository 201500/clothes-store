<?php
if(isset($_COOKIE["woman"]))
    setcookie("woman", "", time() - 3600);
else
    setcookie("woman", "true", time() + 3600 * 24 * 30);
header("Location: ../catalog ");