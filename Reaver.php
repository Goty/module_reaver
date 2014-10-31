<?php

class Reaver {
	
	private $mon;
	private $network;
	private $bssid;
	private $essid;
	private $pid;
	private $nameOutputFile;
	
	
	function __construct($network,$mon){
		$this->mon=$mon;
		$this->bssid=$network->getBssid();
		$this->essid=$network->getEssid();
		$this->nameOutputFile=gmdate("ymd-H-i-s").".log";
		
	}
	
	function __destructor(){
		
	}
	
	/**
	 * Start attack with reaver
	 * 
	 */
	function startAttack(){	
		$exec = "reaver -i ".$this->mon." -b ". $this->bssid." -o ./includes/logs/reaver/".$this->nameOutputFile." -vv > /dev/null 2>&1 &";
		exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
	}
	/**
	 * Stop reaver attack
	 */
	function stopAttack(){
		exec("kill -15".getPid());
		
	}
	
	function saveAttack(){
		
	}
	
	function getPid(){
		
	}

	static function checkReaver(){
		return exec('/bin/ps aux |grep -c reaver');
	}
}


?>