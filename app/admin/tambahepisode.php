<?php 
require_once "../templates/headerhome.php";
require_once "../db/dbpodcast.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');

$error = '';
if(isset($_POST['submit'])){
	$no_episode = $_POST['no_episode'];
	$judul      = $_POST['judul'];
	$caption    = $_POST['caption'];
	$note       = $_POST['note'];
	$anchor  	= $_POST['anchor'];
    $slug    	= strtolower(str_replace(" ", "-", $judul));

	if(!empty(trim($no_episode)) && !empty(trim($judul)) && !empty(trim($anchor)) && !empty(trim($slug))){
		if(tambahEpisode($no_episode, $judul, $anchor, $caption, $note, $slug)){
			 header('location: editepisode.php');
		}else{
			$error = 'masalah pas nambah data anyeeeng';
		}

	}else{
		$error = 'judul dan linknya isi atuh masebray';
	}
}
?>

<div class="homelink">
	<p><a href="logout.php">&lt; log out</a></p>
	<p><a href="home.php">&lt; admin menu</a></p>
</div>

<h1>New Post For Podcast</h1>

<br>

<form method="post">
	<?=$error;?>
	<label for="no_episode">No. Episode</label><br>
	<input type="number" name="no_episode" class="inputtext"><br>
	<label for="judul">Judul</label><br>
	<input type="text" name="judul" class="inputtext"><br>
	<label for="caption">Caption</label><br>
	<textarea name="caption" rows="5" class="inputtext"></textarea><br>
	<label for="note">Note</label><br>
	<textarea name="note" rows="20" class="inputtext"></textarea><br>
	<label for="anchor">Link Anchor</label><br>
	<input type="text" name="anchor" class="inputtext"><br><br>
	<input type="submit" name="submit" value="Post!">
</form>

<br>

<div class="homelink">
	<p><a href="home.php">&lt; admin menu</a></p>
	<p><a href="logout.php">&lt; log out</a></p>
</div>

<?php require_once	"../templates/footer.php";?>