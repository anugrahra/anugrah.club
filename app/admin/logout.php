<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['user']);

$_SESSION = [];

session_unset();
session_destroy();

header('location: ../adminadminan.php');