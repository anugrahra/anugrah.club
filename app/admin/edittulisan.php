<?php 
require_once "../templates/headerhome.php";
require_once "../db/db.php";
require_once "../functions/functions.php";

session_start();
if(!isset($_SESSION['id'])) header('location: ../adminadminan.php');

//Paginasi
$perPage   = 5;
$pageNow   = isset($_GET["page"]) ? $_GET["page"] : 1;
$start     = ($pageNow > 1) ? ($pageNow * $perPage) - $perPage : 0;

$blog      = tampilkanBlog();
$blogLimit = tampilkanBlogLimit();

$totalBlog = mysqli_num_rows($blog); 

$pages    = ceil($totalBlog/$perPage);
?>

<div class="homelink">
	<p><a href="logout.php">&lt; log out</a></p>
	<p><a href="home.php">&lt; admin menu</a></p>
</div>

<center><h1>Edit/Delete Blog Post(s)</h1></center>

<br>

<?php
// Spasi Paragraf
while($row = mysqli_fetch_assoc($blogLimit)):

$pecah = explode("\r\n\r\n", $row['isi']);
$text = "";

for($i=0; $i<=count($pecah)-1; $i++)
{
    $part = str_replace($pecah[$i], "<p class='content'>".$pecah[$i]."</p><br>", $pecah[$i]);
    $text .= $part;
}

//Estimasi Waktu Baca
$readtime = str_word_count($row['isi'])/225;
if ($readtime >= 1)
{
	$readtime = ceil($readtime) . ' min read';
} else {
	$readtime = ceil($readtime * 60) . ' sec read';
}
?>

<div class="artikel">
	<div class="title">
		<h1><?= $row['judul']; ?></h1>
	</div>
	<div class="aftertitle"><?= date('d F Y', strtotime($row['waktu'])); ?> • <?=$readtime;?> • <a href=""><?= $row['tag']; ?></a></div>
	<p class="content"><?=excerpt($text);?></p>
	<br>
	<p><a href="editsatutulisan.php?&id=<?=$row['id'];?>">EDIT</a> | <a href="hapustulisan.php?&id=<?=$row['id'];?>" onclick="return confirm('Yakin tulisan ini dihapus?');">DELETE</a></p>
</div>

<?php endwhile; ?>

<div class="prevnext">
	<?php if(isset($pages)) { ?>
		<?php if($pages > 1) { ?>
			<?php if($pageNow > 1) {?>
				<a href="edittulisan.php?page=<?php echo $pageNow - 1 ?>">&lt; Prev</a>
			<?php } else { ?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
			<?php if($pageNow < $pages) {?>
				<a href="edittulisan.php?page=<?php echo $pageNow + 1 ?>">Next &gt;</a>
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