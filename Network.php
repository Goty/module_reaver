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
		
	function __constructor($networkArray){
		
		$this->network= generateNetwork($networkArray);
		$this->bssid = $network[0];
		$this->channel = $network[1];
		$this->rssi = $network[2];
		$this->wpsVersion = $network[3];
		$this->wpslocked = $network[4];
		$this->essid = $network[5];
		
	}
	
	function __destructor(){
		
	}
	
	
	/**
	 * Split all the information about the network.
	 * @param unknown $networkArray String with the information about the network.
	 * @return unknown $network Array with all the information about the network splitted.
	 */
	
	function generateNetwork($networkArray){
		
		return $network;
	}
	
	//All getters
	
	function getBssid(){
		return $bssid;
	}
	
	function getChannel(){
		return $channel;
	}
	
	function getRssi(){
		return $rssi;
	}
	
	function getWpsVersion(){
		return $wpsVersion;
	}
	
	function getWpsLocked(){
		return $wpsLocked;
	}
	
	function getEssid(){
		return $essid;
	}

}