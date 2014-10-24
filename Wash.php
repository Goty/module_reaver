<?php

class Wash{

	private $mon;
	private $washResult;
	private $networks;
	private $outputFile;
	
	//parameters of reaver program
	private $time= 15;
	
	function __constructor($mon){
		$this->mon = $mon;
		$this->outputFile=gmdate("ymd-H-i-s").".log";
	}
	
	function __destructor(){
		
	}
	
	
	/**
	 * save the actual log in a $var
	 */
	function setwashResult(){
		
	}
	
	/**
	 * start thw wash command and save the log.
	 */
	function washStart(){
		exec("wash -i".$mon."-t".$time."-o".$outputFile);
		exec("mv ".$outputFile." ./includes/logs/");
	}
	
	/**
	 * Change de default time for reaver command.
	 * @param unknown $time
	 */
	function setTime($time){
		$this->time = $time;
	}
	
	/**
	 * Array with all the networks scanned by wash.
	 * Rows are each network.
	 * Columns have diferent information(BSSID, Channel, RSSI, WPS Version, WPS Locked, ESSID.
	 * 
	 * TODO Finish the implementation.
	 */
	function generateNetworks (){
		//Array with all the netwoks
		$networks = Array();
		
		$data = open_file("./includes/logs/".$name);
		$network = explode("\n", $data);
		
		//
		for($i=0; $i<count($network) ;$i++){
		//send each row to generate diferents networks.
		$network = new network($network);	
		//add each network to $networks array.
		array_push($networks,$network);
		
		return $networks;
		}
		
		
	}
}

?>