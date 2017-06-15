<?php
require "../src/StellarCrawler.php";
$publicKey = 'GXXX550025';
$crawler = new StellarCrawler($publicKey , true);
echo 'offers:'.$crawler->getLinks()['offers']->getHref().'<br/>';
var_dump($crawler->getData());
?>