<?php
require "../src/StellarCrawler.php";
$publicKey = 'GXXX550025';
$crawler = new StellarCrawler($publicKey , true);
echo $crawler->getLinks()[5]['key'];
var_dump($crawler->getData());
?>