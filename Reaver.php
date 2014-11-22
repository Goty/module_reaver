<?php

class Reaver {
	
	private $mon;
	private $bssid;
	private $essid;
	private $outputFile;
	private $nameOutputFile;
	
	
	function __construct($network,$mon){
		$this->mon=$mon;
		$this->bssid=$network->getBssid();
		$this->essid=$network->getEssid();
		$this->nameOutputFile="reaver-".gmdate("ymd-H-i-s").".log";
		
	}
	
	/**
	 * Save the log file in a var
	 */
	function setReaverResult(){
		sleep(3);
		$this->outputFile=file_get_contents("./includes/logs/".$this->nameOutputFile);
	}
	
	function getReaverResult(){
		return $this->outputFile;
	
	}
	
	/**
	 * Start attack with reaver
	 * 
	 */
	function startAttack(){	
		$exec = "reaver -i ".$this->mon." -b ". $this->bssid." -o ./includes/logs/".$this->nameOutputFile." -vv > /dev/null 2>&1 &";
		exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
	}
	
	function saveAttack(){
	
	}
	
	/**
	 * Stop reaver attack
	 */
	static function stopAttack(){
		$exec = "killall reaver";
		exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
		sleep(1);
		
	}

	/**
	 * check if is there a reaver attack running
	 * @return string
	 */
	static function checkReaver(){
		return exec('/bin/ps aux |grep -c reaver');
	}
}

?>