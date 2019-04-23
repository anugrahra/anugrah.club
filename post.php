<?php 
require_once "app/core/init.php";
require_once "app/templates/header.php";

$slug = $_GET['slug'];

if(isset($_GET['slug'])){
	$post = tulisanPerSlug($slug);
	while ($row = mysqli_fetch_assoc($post)){
		$judul = $row['judul'];
		$isi   = $row['isi'];
		$tag   = $row['tag'];
		$selag = $row['slug'];
		$waktu = $row['waktu'];
	}
}

// Spasi Paragraf
$pecah = explode("\r\n\r\n", $isi);
$text = "";

for($i=0; $i<=count($pecah)-1; $i++)
{
    $part = str_replace($pecah[$i], "<p class='content'>".$pecah[$i]."</p><br>", $pecah[$i]);
    $text .= $part;
}

//Estimasi Waktu Baca
$readtime = str_word_count($isi)/225;
if ($readtime >= 1)
{
	$readtime = ceil($readtime) . ' min read';
} else {
	$readtime = ceil($readtime * 60) . ' sec read';
}
?>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
	<p><a href="../blog">&lt; blog</a> | <a href="../postlist">list of posts</a></p>
</div>

<div class="artikel">
	<div class="title">
		<h1><a href="<?=$selag;?>"><?=$judul;?></a></h1>
	</div>
	<div class="aftertitle"><?= date('d F Y', strtotime($waktu)); ?> • <?=$readtime;?> • <a href="../post/tag/<?=$tag;?>"><?= $tag; ?></a></div>
	<p class="content"><?=$text;?></p>
</div>

<hr>

<div id="disqus_thread"></div>
  <script>          
    var disqus_config = function () {
    this.page.url = "http://anugrah.club/blog";  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = '<?php echo $slug; ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://blog-ymdq9ff8qf.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
  </script>
  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<div class="homelink">
	<p><a href="../blog">&lt; blog</a> | <a href="../postlist">list of posts</a></p>
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"app/templates/footer.php";?>