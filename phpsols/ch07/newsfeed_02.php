<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Pulling in an RSS Feed</title>
</head>

<body>
<h1>The Latest from BBC News</h1>
<?php
$url = 'http://feeds.bbci.co.uk/news/world/rss.xml';
$feed = simplexml_load_file($url, 'SimpleXMLIterator');
$filtered = new LimitIterator($feed->channel->item, 0 , 4);
foreach ($filtered as $item) {
  echo $item->title . '<br>';
}
?>
</body>
</html>