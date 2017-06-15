<?php
require "StellarLink.php";

class StellarCrawler {
	private $history;
	private $links;
	private $data;
	
	public function __construct($publicKey, $ispublic = true) {
		$server = ($ispublic)?'https://horizon.stellar.org/accounts/':'https://horizon-testnet.stellar.org/accounts/';
		$link = new StellarLink($server.$publicKey, $this);
		$link->follow();
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
}