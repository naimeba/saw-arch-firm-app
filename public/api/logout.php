<?php

session_start();
unset($_SESSION["UserId"]);
$_SESSION=array();
setcookie("PHPSESSID","",time()-7200);
header('Location: /index.html');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 2010 00:00:00 GMT');
session_destroy();