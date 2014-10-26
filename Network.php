<?php
/**
 * Generate all the information about a network scanned by wash
 */

class Network{
	
	//Array with information to generate this Network
	
	private $network;
	
	private $bssid;
	private $channel;
	private $rssi;
	private $wpsVersion;
	private $wpsLocked;
	private $essid;
		
	function __construct($networkArray){
		
		$this->network = $this->generateNetwork($networkArray);
		$this->bssid = $this->network[0];
		$this->channel = $this->network[1];
		$this->rssi = $this->network[2];
		$this->wpsVersion = $this->network[3];
		$this->wpslocked = $this->network[4];
		$this->essid = $this->network[5];
		
	}
	
	function __destruct(){
		
	}
	
	
	/**
	 * Split all the information about the network.
	 * @param unknown $networkArray String with the information about the network.
	 * @return unknown $network Array with all the information about the network splitted.
	 */
	
	private function generateNetwork($networkArray){
		$output = preg_replace('!\s+!', ' ', $networkArray);
		$net = explode(" ", $output);
		return $net;
			
	}
	
	//All getters
	
	function getBssid(){
		return $this->bssid;
	}
	
	function getChannel(){
		return $this->channel;
	}
	
	function getRssi(){
		return $this->rssi;
	}
	
	function getWpsVersion(){
		return $this->wpsVersion;
	}
	
	function getWpsLocked(){
		return $this->wpsLocked;
	}
	
	function getEssid(){
		return $this->essid;
	}

}