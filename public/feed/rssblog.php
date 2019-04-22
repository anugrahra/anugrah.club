<?php 
require_once("../../app/db/db.php");

header('Content-Type: text/xml; charset=utf-8', true); //set document header content type to be XML
$rss = new SimpleXMLElement('<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');
$rss->addAttribute('version', '2.0');
$channel = $rss->addChild('channel'); //add channel node

$atom = $channel->addChild('atom:atom:link'); //add atom node
$atom->addAttribute('href', 'https://anugrah.club/public/feed/rssblog'); //add atom node attribute
$atom->addAttribute('rel', 'self');
$atom->addAttribute('type', 'application/rss+xml');
$title = $channel->addChild('title','https://anugrah.club/blog'); //title of the feed
$description = $channel->addChild('description','Blog on anugrah.club'); //feed description
$ling = $channel->addChild('link','anugrah.club/blog'); //feed site
$language = $channel->addChild('language','id'); //language
 
//Create RFC822 Date format to comply with RFC822
$date_f = date("D, d M Y H:i:s T", time());
$build_date = gmdate(DATE_RFC2822, strtotime($date_f)); 
$lastBuildDate = $channel->addChild('lastBuildDate',$date_f); //feed last build date
 
$generator = $channel->addChild('generator','PHP Simple XML'); //add generator node
 
 
$results = mysqli_query($link, "SELECT * FROM blogpost ORDER by id DESC");

if($results){ //we have records 
    while($row = mysqli_fetch_array($results)) //loop through each row
    {
        $item = $channel->addChild('item'); //add item node
        $title = $item->addChild('title', $row['judul']); //add title node under item
        $ling = $item->addChild('link', 'https://anugrah.club/blog/'.$row['slug']);
        //add link node under item
        $guid = $item->addChild('guid', 'https://anugrah.club/blog/'.$row['slug']); //add guid node under item
        //$guid->addAttribute('isPermaLink', 'false'); //add guid node attribute
 
        $description = $item->addChild('description', $row['isi']); //add description
 
        $date_rfc = gmdate(DATE_RFC2822, strtotime($row['waktu']));
        $item = $item->addChild('pubDate', $date_rfc); //add pubDate node
    }
}

echo $rss->asXML(); //output XML
?>