<?php 
require_once "../templates/headerhome.php";
require_once "../db/dbpodcast.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');

//Paginasi
$perPage       = 5;
$pageNow       = isset($_GET["page"]) ? $_GET["page"] : 1;
$start         = ($pageNow > 1) ? ($pageNow * $perPage) - $perPage : 0;

$episodes      = tampilkanPodcast();
$episodesLimit = tampilkanPodcastLimit();

$totalEpisodes = mysqli_num_rows($episodes); 

$pages         = ceil($totalEpisodes/$perPage);
?>

<div class="homelink">
	<p><a href="logout.php">&lt; log out</a></p>
	<p><a href="home.php">&lt; admin menu</a></p>
</div>

<center><h1>Edit/Delete Podcast Episode(s)</h1></center>

<br>

<?php while($row = mysqli_fetch_assoc($episodesLimit)): ?>

<div class="listepisodes">
	<h1 class="titlepodcast"><a href="<?= $row['anchor']; ?>"><?=$row['no_episode'];?>.&nbsp;<?=$row['judul'];?></a></h1>
	<p class="captionpodcast"><?=$row['caption'];?></p>
	<br>
	<p><a href="editsatuepisode.php?&id=<?=$row['id'];?>">EDIT</a> | <a href="hapusepisode.php?&id=<?=$row['id'];?>" onclick="return confirm('Yakin episode ini dihapus?');">DELETE</a></p></p>
</div>

<?php endwhile; ?>

<div class="prevnext">
	<?php if(isset($pages)) { ?>
		<?php if($pages > 1) { ?>
			<?php if($pageNow > 1) {?>
				<a href="editepisode.php?page=<?php echo $pageNow - 1 ?>">&lt; Prev</a>
			<?php } else { ?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
			<?php if($pageNow < $pages) {?>
				<a href="editepisode.php?page=<?php echo $pageNow + 1 ?>">Next &gt;</a>
			<?php } else {?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>

<br>

<div class="homelink">
	<p><a href="home.php">&lt; admin menu</a></p>
	<p><a href="logout.php">&lt; log out</a></p>
</div>

<?php require_once	"../templates/footer.php";?>