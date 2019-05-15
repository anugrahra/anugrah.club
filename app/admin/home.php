<?php
require_once "../templates/headerhome.php";
session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');
?>

<div class="homelink">
	<p><a href="logout.php">&lt; log out</a></p>
</div>

<h1>Halo <?=$_SESSION['user'];?>, ciptain sesuatu yang baik ya :)</h1>

<br><br>

<nav class="homemenu">
	<ul>
		<li><b>BLOG</b></li>
		<li><a href="tambahtulisan.php">tambah tulisan</a></li>
		<li><a href="edittulisan.php">edit/hapus tulisan</a></li>
		<li>&nbsp;</li>
		<li><b>PODCAST</b></li>
		<li><a href="tambahepisode.php">tambah episode</a></li>
		<li><a href="editepisode.php">edit/hapus episode</a></li>
	</ul>
</nav>

<br>

<div class="homelink">
	<p><a href="logout.php">&lt; log out</a></p>
</div>

<?php require_once	"../templates/footer.php";?>