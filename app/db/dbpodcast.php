<?php
$hostpodcast = 'localhost'; //127.0.0.1
$userpodcast = 'root';
$passpodcast = ''; //root
$dbpodcast   = 'anugrahc_podcast';

$linkpodcast = mysqli_connect($hostpodcast, $userpodcast, $passpodcast, $dbpodcast) or die(mysqli_error());
?>