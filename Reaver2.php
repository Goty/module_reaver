<?php

class Reaver {
	
	private $mon;
	private $network;
	private $bssid;
	private $essid;
	private $pid;
	
	
	function __constructor($mon,$bssid,$essid){
		$this->mon=$mon;
		$this->bssid=$bssid;
		$this->essid=$essid;
	}
	
	function __destructor(){
		
	}
	
	/**
	 * Start attack with reaver
	 * 
	 */
	function startAttack(){
		exec("reaver -i mon0 -b $bssid -o outputfile.log");
		
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
}

?>