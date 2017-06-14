<?php
include('./httpful.phar');

public class StellarLink {
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

		$crawler->load(\Httpful\Request::get(http_build_url($this->href))->send()->body);
	}
}