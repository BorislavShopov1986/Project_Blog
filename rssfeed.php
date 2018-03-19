<?php
header('Content-Type: text/xml; charset=utf-8', true);

require_once "model.php";
require_once "dbmodel.php";

$rss = new SimpleXMLElement('<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');

$rss->addAttribute('version', '2.0');

$channel = $rss->addChild('channel');
$atom = $rss->addChild('atom:atom:link'); //add atom node
$atom->addAttribute('href', 'http://localhost'); //add atom node attribute
$atom->addAttribute('rel', 'self');
$atom->addAttribute('type', 'application/rss+xml');

$title = $rss->addChild('title','Nikoleta Shopova'); //title of the feed
$description = $rss->addChild('description','RSS of Nikoleta Shopova'); //feed description
$link = $rss->addChild('link','http://localhost/Nikoleta'); //feed site
$language = $rss->addChild('language','en-us'); 

$dateF = date("D, d M Y H:i:s T", time());
$buildDate = gmdate(DATE_RFC2822, strtotime($dateF)); 
$lastBuildDate = $rss->addChild('lastBuildDate',$dateF); //feed last build date
$generator = $rss->addChild('generator','PHP Simple XML');



$dbmodel = DbModel::getInstance();

$data = array();

$data = $dbmodel->getPostsForFeed($data);


    foreach ($data as $key) 
    {
    	$spaceposition = strpos($key['post'], ' ', 30);
        $text = substr($key['post'], 0 ,$spaceposition); 
    	
    	
    	$item = $rss->addChild('item'); //add item node
		$title = $item->addChild('title', $key['post_title']); //add title node under item
		$link = $item->addChild('link', "localhost://nikoleta/post.php?id=$key[post_id]"); //add link node under item
		$guid = $item->addChild('guid', 'localhost://nikoleta/post.php?id='. $key['post_id']); //add guid node under item
		$guid->addAttribute('isPermaLink', 'false'); //add guid node attribute
		
		$description = $item->addChild('description', '<![CDATA['. htmlentities($text) . ']]>'); //add description
		
		$dateRfc = gmdate(DATE_RFC2822, strtotime($key['post_date']));
		$item = $item->addChild('pubDate', $dateRfc);



     }


    
echo $rss->asXML();


