<?php 
require_once "app/core/init.php";
require_once "app/templates/header.php";

//Paginasi
$perPage   = 3;
$pageNow   = isset($_GET['page']) ? $_GET['page'] : 1;
$start     = ($pageNow > 1) ? ($pageNow * $perPage) - $perPage : 0;

$blog      = tampilkanBlog();
$blogLimit = tampilkanBlogLimit();

$totalBlog = mysqli_num_rows($blog); 

$pages    = ceil($totalBlog/$perPage);
?>

<div class="homelinkblog">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
	<br>
	<center>
		<p><a href="post/tag/cerita">Cerita</a> | <a href="post/tag/opini">Opini</a> | <a href="postlist">List</a> | <a href="public/feed/rssblog">RSS</a></p>
	</center>
</div>

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
$readtime = str_word_count($row['isi'])/200;
if ($readtime >= 1)
{
	$readtime = ceil($readtime) . ' min read';
} else {
	$readtime = ceil($readtime * 60) . ' sec read';
}
?>

<div class="artikel">
	<div class="title">
		<h1><a href="blog/<?=$row['slug'];?>"><?= $row['judul']; ?></a></h1>
	</div>
	<div class="aftertitle"><?= date('d F Y', strtotime($row['waktu'])); ?> • <?=$readtime;?> • <a href="post/tag/<?=$row['tag'];?>"><?= $row['tag']; ?></a></div>
	<p class="content"><?=$text;?></p>
</div>

<?php endwhile;?>

<div class="prevnext">
	<?php if(isset($pages)) { ?>
		<?php if($pages > 1) { ?>
			<?php if($pageNow > 1) {?>
				<a href="blog?page=<?php echo $pageNow - 1 ?>">&lt; Prev</a>
			<?php } else { ?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
			<?php if($pageNow < $pages) {?>
				<a href="blog?page=<?php echo $pageNow + 1 ?>">Next &gt;</a>
			<?php } else {?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"app/templates/footer.php";?>