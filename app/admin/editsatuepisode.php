<?php 
require_once "../templates/headerhome.php";
require_once "../db/dbpodcast.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');

$error = '';
$id    = $_GET['id'];

if(isset($_GET['id'])){
	$episode = episodePerId($id);
	while ($row = mysqli_fetch_assoc($episode)){
		$no_episode_awal = $row['no_episode'];
		$judul_awal  	 = $row['judul'];
		$caption_awal 	 = $row['caption'];
		$note_awal  	 = $row['note'];
		$anchor_awal  	 = $row['anchor'];
	}
}

if(isset($_POST['submit'])){
	$no_episode = $_POST['no_episode'];
	$judul   	= $_POST['judul'];
	$caption 	= $_POST['caption'];
	$note       = $_POST['note'];
	$anchor  	= $_POST['anchor'];
	$slug  		= strtolower(str_replace(" ", "-", $judul));

	if(!empty(trim($no_episode)) && !empty(trim($judul)) && !empty(trim($anchor)) && !empty(trim($slug))){
		if(editEpisode($no_episode, $judul, $caption, $note, $anchor, $slug, $id)){
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

<h1>Edit A Podcast Episode</h1>

<br>

<form method="post">
	<?=$error;?>
	<label for="no_episode">No Episode</label><br>
	<input type="number" name="no_episode" class="inputtext" value="<?=$no_episode_awal;?>"><br>
	<label for="judul">Judul</label><br>
	<input type="text" name="judul" class="inputtext" value="<?=$judul_awal;?>"><br>
	<label for="caption">Caption</label><br>
	<textarea name="caption" rows="5" class="inputtext"><?=$caption_awal;?></textarea><br>
	<label for="note">Note</label><br>
	<textarea name="note" rows="20" class="inputtext"><?=$note_awal;?></textarea><br>
	<label for="anchor">Link Anchor</label><br>
	<input type="text" name="anchor" class="inputtext" value="<?=$anchor_awal;?>"><br><br>
	<input type="submit" name="submit" value="Post!">
</form>

<br>

<div class="homelink">
	<p><a href="home.php">&lt; admin menu</a></p>
	<p><a href="logout.php">&lt; log out</a></p>
</div>

<?php require_once	"../templates/footer.php";?>