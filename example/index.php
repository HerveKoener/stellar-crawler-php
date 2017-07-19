<?php
include('../StellarCrawler.phar');
$publicKey = 'GXXX550025';
$crawler = StellarCrawler::newInstance($publicKey , true);
echo 'offers:'.$crawler->getLinks()['offers']->getHref().'<br/>';
var_dump($crawler->getData());
?>