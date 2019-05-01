<?php 
require_once "app/core/init.php";
require_once "app/templates/header.php";

$slug = $_GET['slug'];

if(isset($_GET['slug'])){
	$episode = episodePerSlug($slug);
	while ($row = mysqli_fetch_assoc($episode)){
		$no_episode = $row['no_episode'];
		$judul      = $row['judul'];
		$caption    = $row['caption'];
		$note       = $row['note'];
		$anchor     = $row['anchor'];
		$selag      = $row['slug'];
	}
}

// Spasi Paragraf
$pecah = explode("\r\n\r\n", $note);
$text = "";

for($i=0; $i<=count($pecah)-1; $i++)
{
    $part = str_replace($pecah[$i], "<p class='content'>".$pecah[$i]."</p><br>", $pecah[$i]);
    $text .= $part;
}
?>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
	<p><a href="../../podcast">&lt; list of episodes</a></p>
</div>

<header class="headerpodcast">
	<h1>Podcast <i>dekadensiotak</i></h1>
</header>
<div class="tagline">
	<p>My Code Learning Journal ☕ // New episode every weekend</p>
	<br>
	<p><b>Episode <a href="<?=$selag;?>"><?=$no_episode;?>.&nbsp;<?=$judul;?></a></b></p>
</div>

<div class="framePodcast">
	<iframe src="<?=$anchor;?>" height="150px" width="100%" frameborder="0" scrolling="no"></iframe>
	<center><p><?=$caption;?></p></center>
	<br>
</div>

<br>

<hr>

<div class="artikel">
	<div class="title">
		<h1>Note:</h1>
	</div>
	<br>
	<p class="content"><?=$text;?></p>
</div>

<div id="disqus_thread"></div>
  <script>          
    var disqus_config = function () {
    this.page.url = "http://anugrah.club/podcast";  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = '<?php echo $slug; ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://podcast-dekadensiotak.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
  </script>
  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<br>

<div class="homelink">
	<p><a href="../../podcast">&lt; list of episodes</a></p>
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"app/templates/footer.php";?>