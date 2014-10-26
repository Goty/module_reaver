 <?php
   /**
   *Implement reaver functions
   */
    class reaver {
    	    private $time;
        
        function __construct() {
            
        }
        function __destructor(){
        }
        
        
        public function getIfaces(){
        	$ifaces = exec("/sbin/ifconfig -a | cut -c 1-8 | sort | uniq -u |grep -v lo|sed ':a;N;$!ba;s/\\n/|/g'");
        	$ifaces = str_replace(" ","",$ifaces);
        	$ifaces = explode("|", $ifaces);
        	return $ifaces;
        }
        
        public function checkIface($service, $action, $io_in_iface_extra){
        	if ($service == "mon0") {
        		if ($action == "start") {
        			// START MONITOR MODE (mon0)
        			start_monitor_mode($io_in_iface_extra);
        		} else {
        			// STOP MONITOR MODE (mon0)
        			stop_monitor_mode($io_in_iface_extra);
        		}
        	}
        }
        
        public function getWash($service, $action){
        	if ($service == "wash") {
        		if ($action == "start") {
        			$name=gmdate("ymd-H-i-s").".log";
        			$exec = "timeout 7s wash -i mon0 -o".$name;
        			exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
        			$exec = "mv ".$name." includes/logs/";
        			exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
        			
        			$data = open_file("./includes/logs/".$name);
            
        			 $data_array = explode("\n", $data);
        			 $data = implode("\n",$data_array);
        			 return $data;
        			
        		} else {
        			
        		}
        	}
        }
        
        public function getNet($data){
        	
        	$arra = array();
        	
        	$data_array=explode("\n", $data);
        	for ($i = 2; $i < count($data_array); $i++){ 
        		
        		$line = $data_array[$i];
        		$bssid = substr($line,0, 17);
        		
        		array_push($arra, $bssid);
        	
        		for ($j = 0; $j<strlen($line); $j++){
        			$char = $line[$j];
        			if ($char == "o" or $char == "s"){
        			$essid = substr($line,$j+2);
        			break;
        			}

        		}
        	
        	}
        	return $arra;
        
        }   
        
    }
   
?> 
