<?php
session_start();

$_SESSION = [];
unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['user']);

session_unset();
session_destroy();

unset($_COOKIE['login']);
unset($_COOKIE['loginus']);
setcookie('login', null, time() - 3600);
setcookie('loginus', null, time() - 3600);

header('location: index.php');
exit;