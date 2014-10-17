 <?php
   /**
   *Implement reaver functions
   */
    class reaver {
        public $name;
        private $wlan;
        
        function __construct($DogName) {
            $this->name = $DogName;
        }
        
        
        public function ifaceMonitor($iface, $value){
        	echo nl2br("starting mon0\n");

        	$exec = "airmon-ng " . $value ." ". $iface ."";
        	exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
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
        
       
        
    }
   
?> 
