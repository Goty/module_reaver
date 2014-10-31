<?php




class Wash{

	private $mon;
	private $networks;
	private $nameOutputFile;
	private $outputFile;
	
	//parameters of reaver program
	private $time= 12;
	
	function __construct($mon){
		$this->mon = $mon;
		$this->nameOutputFile=gmdate("ymd-H-i-s").".log";

	}
	
	function __destructor(){
		
	}
	

	/**
	 * set the wash outputfile
	 */
	function setWashResult(){
		$this->outputFile = open_file("./includes/logs/wash/".$this->nameOutputFile);
	}
	
	function getWashResult(){
		return $this->outputFile;

	}
	
	/**
	 * start thw wash command and save the log.
	 */
	function washStart(){

		$exec = "timeout ".$this->time." wash -i ".$this->mon." -o".$this->nameOutputFile;
		exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
		
		$exec = "mv ".$this->nameOutputFile." ./includes/logs/wash/";
		exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
		
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

	 * TODO Finish the implementation.
	 */
	function generateNetworks(){
		//Array with all the netwoks
		$networks = Array();
		
		$network = explode("\n", $this->outputFile);
		
		for($i=2; $i<count($network) ;$i++){
			
			//generate diferent networks and add each network to $networks array.
			array_push($networks, new Network($network[$i]));
		}
		
		return $networks;

		
		
	}
}

?>