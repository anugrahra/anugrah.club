<?php 
require_once "app/core/init.php";
require_once "app/templates/header.php";

$tag = $_GET['tag'];

if(isset($_GET['tag'])){
	$posts = tulisanPerTag($tag);
}

?>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
	<p><a href="../../blog">&lt; blog</a> | <a href="postlist">list of posts</a></p>
</div>

<div class="tagTitle">
	<h1><?=$tag;?>&nbsp;&nbsp;</h1>
</div>

<br>

<?php
// Spasi Paragraf
while($row = mysqli_fetch_assoc($posts)):

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
		<h1><a href="post.php?&slug=<?=$row['slug'];?>"><?= $row['judul']; ?></a></h1>
	</div>
	<div class="aftertitle"><?= date('d F Y', strtotime($row['waktu'])); ?> • <?=$readtime;?> • <a href="tag.php?&tag=<?=$row['tag'];?>"><?= $row['tag']; ?></a></div>
	<p class="content"><?=$text;?></p>
</div>

<?php endwhile; ?>

<div class="homelink">
	<p><a href="../../blog">&lt; list of posts</a></p>
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"app/templates/footer.php";?>