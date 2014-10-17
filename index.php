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
</head>
<body>

<?php
include "_info_.php";
include "../../functions.php";

function __autoload($class_name) {
    include $class_name . '.php';
}

include "../menu.php";

$obj = new reaver();

$obj->checkIface($_GET["service"], $_GET["action"], $io_in_iface_extra);

?>

<br>
<div class="rounded-top" align="left"> &nbsp; <b>Reaver</b> </div>
<div class="rounded-bottom">
    &nbsp;&nbsp;version <?=$mod_version?><br>
    &nbsp;&nbsp;&nbsp;&nbsp; reaver <font style="color:lime">installed</font>
</div>
<br>

<div class="rounded-top" align="center"> Adidtional Interfaces </div>
<div class="rounded-bottom">

    <form action="" method="post" style="margin:0px">
    &nbsp;&nbsp;&nbsp;Monitor 
    
    <?
    $iface_mon0 = exec("/sbin/ifconfig |grep mon0"); 
    $ifaces = $obj->getIfaces();
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
            echo "<b><a href='index.php?service=mon0&action=start'>start</a></b> [<font color='red'>mon0</font>]";
        } else {
            echo "<b><a href='index.php?service=mon0&action=stop'>stop</a></b>&nbsp; [<font color='lime'>mon0</font>]";
        }
        
    ?>
    
    <input type="hidden" name="iface" value="wifi_extra">
    </form>
    
</div>
<?php

?>

<!-- Additional INTERFACES END -->
    </div>

<?php





?>