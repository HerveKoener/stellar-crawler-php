<?php
require "StellarLink.php";
require "StellarCrawlerException";

class StellarCrawler {
	private $history;
	private $links;
	private $data;
	
	private function __construct($publicKey, $horizonServer) {
		$server = $horizonServer.'/accounts/';
		$link = new StellarLink($server.$publicKey, $this);
		$link->follow();
	}
	
	public static newInstance($publicKey, $ispublic = true) {
		$server = ($ispublic)?'https://horizon.stellar.org':'https://horizon-testnet.stellar.org';
        return new StellarCrawler($publicKey, $server);
	}
	
	public static newInstanceWithServer($publicKey, $horizonServer) {
		return new StellarCrawler($publicKey, $server);
	}
	
	private function follow($key){
		$links = $this->getlinks();
		if(array_key_exists($key,$links)){
			$links[$key]->follow();
		}else{
			throw new StellarCrawlerException("Link ".$key." not found.");
		}
	}
	
	public function load($json){
		$this->data = $json;
		$c = count($this->history);
		
		$this->links = ($c > 2)
			? ['back' => $this->history[$c-2]]
			: [];
		
		foreach($this->data->_links as $key => $n){
			$this->links[$key] = new StellarLink((strrpos($n->href, '{') != false)?substr($n->href,0,strrpos($n->href, '{')) :$n->href, $this);
		}
	}
	
	public function getHistory(){
		return $this->history;
	}
	
	public function getLinks(){
		return $this->links;
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function followNext(){
		$this->follow('next');
	}
	
	public function followPrev(){
		$this->follow('prev');
	}
	
	public function followBack(){
		$this->follow('back');
	}
}