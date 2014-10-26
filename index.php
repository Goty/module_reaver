<? 
/*
	Copyright (C) 2013-2014  xtr4nge [_AT_] gmail.com

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>FruityWifi</title>
<script src="../js/jquery.js"></script>
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../../../style.css" />

<script>
$(function() {
    $( "#action" ).tabs();
    $( "#result" ).tabs();
});

</script>

</head>
<body>

<?
include "_info_.php";
include "../../config/config.php";
include "../../login_check.php";
include "../../functions.php";

include "../menu.php"; 

/**
 *load class form other files
 */
function __autoload($class_name) {
	include $class_name . '.php';
}


?>

<br>

<div class="rounded-top" align="left"> &nbsp; <b>Reaver</b> </div>
<div class="rounded-bottom">
    &nbsp;&nbsp;version <?=$mod_version?><br>
    &nbsp;&nbsp;&nbsp;&nbsp; reaver <font style="color:lime">installed</font>

</div>

<br>
        <?php 


//reaver
if ($_GET["service"] == "reaver"){
	if($_GET["action"] == "start"){
		//START reaver command
		print "entrando en reaver";
		print $reaver;
	}
}

//wash
if (isset($_POST['wash'])){
	// START wash command
	print "funcionando el start";
	$wash = new Wash("mon0");
	print $_POST['time'];
	$wash-> setTime($_POST['time']);
	$wash-> washStart();
	$wash-> setWashResult();
	
	$networks = $wash-> generateNetworks();

}

//reaver
if (isset($_POST['reaver'])){
	//START reaver command
	$reaver = new Reaver($networks[$_POST['net']]);

}

?>

<hr>

<form action="index.php" method="post" style="margin:0px" id="wash">
                           Wash  <input type="submit" value="Start" name="wash"/>
                           Time <select name="time">
                           <option value="10">10s</option>
                           <option value="20">20s</option>
                           <option value="30">30s</option>
                           <option value="40">40s</option>
                           <option value="50">50s</option>
                           
                          		</select>
                        </form>  
                        
                        <hr>

<form action="" method="post" style="margin:0px" id="reaver">
                           Reaver <select class="input" name="net">
                                <option>-</option>
                                <?
                                for ($i = 0; $i < count($networks)-1; $i++) {
										$essid=$networks[$i]->getEssid();
                                        echo "<option value=".$i.">$essid</option>";
                                    }
                                
                                ?>
                            </select> 
                            <input type="submit" value="Start" name="reaver"/>
                        </form>
	
	
<p> Options
<hr>
<?



?>

<br>


<div id="result" class="module" >
    <ul>
        <li><a href="#result-1">Output</a></li>
        <li><a href="#result-2">History</a></li>
    </ul>
    <div id="result-1">
        <form id="formLogs" name="formLogs" method="POST" autocomplete="off">
        <br>

        <?
            if ($logfile != "" and $action == "view") {
                $filename = $mod_logs_history.$logfile.".log";
            } else {
                $filename = $mod_logs;
            }

            /*
            $fh = fopen($filename, "r"); //or die("Could not open file.");
            $data = fread($fh, filesize($filename)); // or die("Could not read file.");
            fclose($fh);
            */
            
            $data = open_file($filename);
            
            $data_array = explode("\n", $data);
            //$data = implode("\n",array_reverse($data_array));
            $data = implode("\n",$data_array);
            
        ?>
        
        
        


        <textarea id="output" class="module-content"><?=$wash->getWashResult();?></textarea>

        <input type="hidden" name="type" value="logs">
        
    </div>
    <div id="result-2">

        <?
        $logs = glob($mod_logs_history.'*.log');
        print_r($a);

        for ($i = 0; $i < count($logs); $i++) {
            $filename = str_replace(".log","",str_replace($mod_logs_history,"",$logs[$i]));
            echo "<a href='?logfile=".str_replace(".log","",str_replace($mod_logs_history,"",$logs[$i]))."&action=delete'><b>x</b></a> ";
            echo $filename . " | ";
            echo "<a href='?logfile=".str_replace(".log","",str_replace($mod_logs_history,"",$logs[$i]))."&action=view'><b>view</b></a>";
            echo "<br>";
        }
        ?>
    </div>

</div>



</body>
</html>

