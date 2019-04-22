<?php 
require_once "app/core/init.php";
require_once "app/templates/header.php";

$blog = tampilkanBlog();
?>

<div class="homelinkblog">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
	<p><a href="blog">&lt; blog</a></p>
</div>

<div class="tagTitle">
	<h1>Posts on Blog&nbsp;&nbsp;</h1>
</div>

<br>
<ul>

	<?php
	while($row = mysqli_fetch_assoc($blog)):

	//Estimasi Waktu Baca
	$readtime = str_word_count($row['isi'])/200;
	if ($readtime >= 1)
	{
		$readtime = ceil($readtime) . ' min read';
	} else {
		$readtime = ceil($readtime * 60) . ' sec read';
	}
	?>

	<li>
		<a href="blog/<?=$row['slug'];?>" style="color: black;"><b><?= $row['judul']; ?></b></a> | <span style="color: grey;"><?= date('d F Y', strtotime($row['waktu'])); ?> • <?=$readtime;?> • </span><a href="post/tag/<?=$row['tag'];?>" style="color: orange;"><b><?= $row['tag']; ?></b></a>
	</li>

	<?php endwhile;?>

</ul>

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
	<p><a href="blog">&lt; blog</a></p>
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"app/templates/footer.php";?>