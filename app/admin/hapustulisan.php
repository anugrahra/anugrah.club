<?php 
require_once "../templates/headerhome.php";
require_once "../db/db.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])){
	header('location: ../adminadminan.php');
	exit;
}

$id = $_GET['id'];

if(isset($_GET['id'])){
	hapusTulisan($id);
	header('location: edittulisan.php');
}