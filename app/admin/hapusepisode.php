<?php 
require_once "../templates/headerhome.php";
require_once "../db/dbpodcast.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');

$id = $_GET['id'];

if(isset($_GET['id'])){
	hapusEpisode($id);
	header('location: editepisode.php');
}