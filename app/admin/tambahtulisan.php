<?php 
require_once "../templates/headerhome.php";
require_once "../db/db.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');

if(isset($_POST['submit'])){
	$judul = $_POST['judul'];
	$isi   = $_POST['isi'];
	$tag   = $_POST['tag'];
	$slug  = strtolower(str_replace(" ", "-", $judul));

	if(!empty(trim($judul)) && !empty(trim($isi)) && !empty(trim($slug))){
		if(tambahTulisan($judul, $isi, $tag, $slug)){
			 header('location: edittulisan.php');
		}else{
			echo "<script>alert('masalah pas nambah data anyeeeng!')</script>";
		}

	}else{
		echo "<script>alert('judul / isinya jangan kosong dong bangsaaaat!')</script>";
	}
}
?>

<div class="homelink">
	<p><a href="logout.php">&lt; log out</a></p>
	<p><a href="home.php">&lt; admin menu</a></p>
</div>

<h1>New Post For Blog</h1>

<br>

<form method="post">
	<label for="judul">Judul</label><br>
	<input type="text" name="judul" class="inputtext"><br>
	<label for="isi">Isi</label><br>
	<textarea name="isi" rows="20" class="inputtext"></textarea><br>
	<label for="tag">Tag</label><br>
	<input type="text" name="tag" class="inputtext"><br><br>
	<input type="submit" name="submit" value="Post!">
</form>

<br>

<div class="homelink">
	<p><a href="home.php">&lt; admin menu</a></p>
	<p><a href="logout.php">&lt; log out</a></p>
</div>

<?php require_once	"../templates/footer.php";?>