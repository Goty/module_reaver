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

<?php
include "_info_.php";
include "../../functions.php";
include "../../login_check.php";

/**
*load class form other files
*/
function __autoload($class_name) {
    include $class_name . '.php';
}

include "../menu.php";

$obj = new reaver();
//Start and stop mon interface
$obj->checkIface($_GET["service"], $_GET["action"], $io_in_iface_extra);

?>

<br>
<div class="rounded-top" align="left"> &nbsp; <b>Reaver</b> </div>
<div class="rounded-bottom">
    &nbsp;&nbsp;version <?=$mod_version?><br>
    &nbsp;&nbsp;&nbsp;&nbsp; reaver <font style="color:lime">installed</font>
</div>
<br>

<div id="action" class="module">
        <ul>
            <li><a href="#action-1">General</a></li>
        </ul>
    
        <br>
        <form action="" method="post" style="margin:0px;color:black">
    &nbsp;&nbsp;&nbsp;Monitor 
    
    <?
    $iface_mon0 = exec("/sbin/ifconfig |grep mon0"); 
    $ifaces = $obj->getIfaces();
    ?>
    
    <?
    $data= $obj->getWash($_GET["service"], $_GET["action"]);
    $net= $obj->getNet($data);
    
    ?>
    
    
    <select class="input" onchange="this.form.submit()" name="io_in_iface_extra" <? if ($iface_mon0 != "") echo "disabled" ?> >
        
        <?
        for ($i = 0; $i < count($ifaces); $i++) {
        	if (strpos($ifaces[$i], "mon") === false) {
            	if ($io_in_iface_extra == $ifaces[$i]) $flag = "selected" ; else $flag = "";
            	echo "<option $flag>$ifaces[$i]</option>";
            }
        }
        ?>
        
    </select> 
    
    <?
   
        if ($iface_mon0 == "") {
        	echo "<b><a href='index.php?service=mon0&action=start' style='color: black'> start</a></b> [<font color='red'>mon0</font>]";
        } else {
            echo "<b><a href='index.php?service=mon0&action=stop' style='color: black'> stop</a></b>&nbsp; [<font color='lime'>mon0</font>]";
        }
        
    ?>
    <hr width=400px align=left>
    <input type="hidden" name="iface" value="wifi_extra">
    
    <p style="color:black">&nbsp;&nbsp;&nbsp;Wash <b><a href='index.php?service=wash&action=start'style='color:black'>start</a></b>&nbsp;(wait 15s)
    <p style="color:black">&nbsp;&nbsp;&nbsp;Options
    <hr width=400px align=left>
    <p style="color:black">&nbsp;&nbsp;&nbsp;Reaver 
    
    <select class="input" name="net_extra" <? if ($iface_mon0 == "") echo "disabled" ?> >
        
        <?
        for ($i = 0; $i < count($net); $i++) {
            	if ($net_extra == $net[$i]) $flag = "selected" ; else $flag = "";
            	echo "<option $flag>$net[$i]</option>";
            
        }
        ?>
        
    </select>
    start attack
    
    <p style="color:black"> &nbsp;&nbsp;&nbsp;Options
    
    </form>
</div>
    

<div id="result" class="module" >
    <ul>
        <li><a href="#result-1">Output</a></li>
        <li><a href="#result-2">History</a></li>
    </ul>
    <div id="result-1">
        <form id="formLogs" name="formLogs" method="POST" autocomplete="off">
        <br>
        <textarea id="output" class="module-content"><?=$data?></textarea>
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