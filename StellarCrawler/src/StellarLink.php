<?php

class StellarLink {
	private $href;
	private $crawler;
	
	public function __construct($href, $crawler) {
		$this->href = $href;
		$this->crawler = $crawler;
	}
	
	public function follow(){
		$h = $this->crawler->getHistory();
		$c = count($h);
		if($h[$c-2] == $this){
			array_pop($h);
		}else if($h[$c-1] != $this){
			$h[] = $this;
		}
		
		$result = file_get_contents($this->href);
		$this->crawler->load(json_decode($result));
	}
	
	public function getHref(){
		return $this->href;
	}
}