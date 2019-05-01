<?php 
require_once "app/core/init.php";
require_once "app/templates/header.php";

//Paginasi
$perPage       = 10;
$pageNow       = isset($_GET["page"]) ? $_GET["page"] : 1;
$start         = ($pageNow > 1) ? ($pageNow * $perPage) - $perPage : 0;

$episodes      = tampilkanPodcast();
$episodesLimit = tampilkanPodcastLimit();

$totalEpisodes = mysqli_num_rows($episodes); 

$pages         = ceil($totalEpisodes/$perPage);

//Podcast Depan
while ($podcastDepan = mysqli_fetch_assoc($episodes)){
	$anchor  = $podcastDepan['anchor'];
	$caption = $podcastDepan['caption'];
}
?>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<header class="headerpodcast">
	<h1>Podcast <i>dekadensiotak</i></h1>
</header>
<div class="tagline">
	<p>My Code Learning Journal ☕ // New episode every weekend</p>
</div>

<div class="framePodcast">
	<iframe src="<?=$anchor;?>" height="150px" width="100%" frameborder="0" scrolling="no"></iframe>
	<center><p><?=$caption;?></p></center>
	<br>
</div>

<br>

<center>
	<p>Listen on <a href="https://open.spotify.com/show/7CXYFUB7c8vx1OqYCSihaC" style="text-decoration: underline;">Spotify</a> | <a href="https://itunes.apple.com/us/podcast/dekadensiotak/id1438352066?mt=2&uo=4" style="text-decoration: underline;">Apple Podcasts</a></p>
	<h1>List of Episodes</h1>
</center>

<br>

<?php while($row = mysqli_fetch_assoc($episodesLimit)): ?>

<div class="listepisodes">
	<h1 class="titlepodcast"><a href="podcast/<?=$row['slug'];?>"><?=$row['no_episode'];?>.&nbsp;<?=$row['judul'];?></a></h1>
	<p class="captionpodcast"><?=$row['caption'];?></p>
</div>

<?php endwhile; ?>

<br>

<div class="prevnext">
	<?php if(isset($pages)) { ?>
		<?php if($pages > 1) { ?>
			<?php if($pageNow > 1) {?>
				<a href="podcast?page=<?php echo $pageNow - 1 ?>">&lt; Prev</a>
			<?php } else { ?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
			<?php if($pageNow < $pages) {?>
				<a href="podcast?page=<?php echo $pageNow + 1 ?>">Next &gt;</a>
			<?php } else {?>
				<a href="" style="display: none;">Hilang</a>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>

<hr>

<div id="disqus_thread"></div>
  <script>          
    var disqus_config = function () {
    this.page.url = "http://anugrah.club/podcast";  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = "podcast"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://podcast-dekadensiotak.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
  </script>
  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<div class="homelink">
	<p><a href="<?=BASEURL;?>">&lt; home</a></p>
</div>

<?php require_once	"app/templates/footer.php";?>