<?php
require "StellarLink.php";

public class StellarCrawler {
	private $history;
	private $links;
	private $data;
	
	public function __construct($publicKey, $ispublic = true) {
		$server = ($ispublic)?'https://horizon.stellar.org/accounts/':'https://horizon-testnet.stellar.org/accounts/';
		$link = new StellarLink($server.$publicKey, $this);
		$link.follow();
	}
	
	public function load($json){
		$this->data = $json->body;
		$c = count($this->history);
		
		$this->links = (c > 2)
			? [['key' : 'back','link' : $this->history[c-2]]]
			: [];
		
		foreach($this->data->_links as $key => $n){
			$this->links[] = ['key' : $key,'link' :new StellarLink((strrpos($n, '{') != false)?substr($n,0,strrpos($n, '{')+1) :$n, $this)];
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