<?
/*
 * From xtr4nge
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @Goty
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
 * load class form other files
 */
function __autoload($class_name) {
	include $class_name . '.php';
}
?>

<br>

	<div class="rounded-top" align="left">
		&nbsp; <b>Reaver</b>
	</div>
	<div class="rounded-bottom">
    &nbsp;&nbsp;version <?=$mod_version?><br> &nbsp;&nbsp;&nbsp;&nbsp;
		reaver <font style="color: lime">installed</font>

	</div>

	<br>
        <?php
		// wash
		if (isset ( $_POST ['wash'] )) {
			// START wash command
			$wash = new Wash ( $_POST ['iface'] );
			$wash->setTime ( $_POST ['time'] );
			$wash->washStart ();
			$wash->setWashResult ();			
			$networks = $wash->generateNetworks ();
			session_Start ();
			$_SESSION ['networks'] = $networks;
			}
		// reaver
		if (isset ( $_POST ['net'] )) {					
			if (isset ( $_POST ['reaver_start'] )) {
				if (isset ( $_SESSION ['networks'] )) {
											
					session_start ();
					$reaver = new Reaver ( $_SESSION ['networks'] [$_POST ['net']], $_POST ['iface']);
					$reaver->startAttack ();
					$reaver->setReaverResult ();
				}
			}
		} 
		else {
			if (isset ( $_POST ['reaver_stop'] )) {
				Reaver::stopAttack ();
			}
		}	
		?>

<hr>

	<form action="index.php" method="post" style="margin: 0px" id="wash">
		<div id="action" class="module">
			<ul>
				<li><a href="#action-1">Wash</a></li>
				<li><a href="#action-2">Reaver</a></li>
				<script>
		</script>
			</ul>
			<div id="action-1">
				Wash Time <select name="time">
					<option value="10">10s</option>
					<option value="20">20s</option>
					<option value="30">30s</option>
					<option value="40">40s</option>
					<option value="50">50s</option>
				</select> Mon interface<select name="iface">
					<option value="mon0">mon0</option>
				</select>
				<p>Options
				<p><input type="submit" value="Start" name="wash" />
			</div>
	</form>

	<form action="index.php" method="post" style="margin: 0px" id="reaver">
		<div id="action-2">
			Reaver <select class="input" name="net">			
                                
                                <?
									for($i = 0; $i < count ( $networks ) - 1; $i ++) {
										$essid = $networks [$i]->getEssid ();
										echo "<option value=" . $i . ">$essid</option>";
									}
								?>
								
                            </select> Mon interface<select name="iface">
				<option value="mon0">mon0</option>
			</select>

			 <p>Options<br> <input type="checkbox" name="defaultpin" value="" checked>Try with default pin
			 				<input type="checkbox" name="dbpin"  value="" checked>Use WPSdb
			 <p><input type="text" name="" value="" maxlength="8">Use your own
			pin<br>
	
			<?php
			// check if reaver is running
			if (Reaver::checkReaver () > 2) {
				print "<p>reaver is <span style='color:lime'><b>running</b> ";
				print ' <p><input type="submit" name="reaver_stop" value="Stop">';
			} else {
				print '<p><input type="submit" name="reaver_start" value="Start">';
			}
			
			?>
		</div>
	</div>
	</form>
	
	<br>

	<div id="result" class="module">
		<ul>
			<li><a href="#result-1">Output</a></li>
			<li><a href="#result-2">History</a></li>
		</ul>
		<div id="result-1">
			<form id="formLogs" name="formLogs" method="POST" autocomplete="off">
				<input value="refresh" type="button"
					onclick='window.location.reload(true);'> <br>

        <?
								if ($logfile != "" and $action == "view") {
										$filename = $mod_logs_history . $logfile . ".log";
															
								} else {

									$filename = $mod_logs;
								}
								
								$data = open_file ( $filename );
								
								$data_array = explode ( "\n", $data );
								
								$data = implode ( "\n", $data_array );
								
								?>
		<?php if (isset($_POST['wash'])){?>
        <textarea id="output" class="module-content"><?=$wash->getWashResult();?></textarea>
        <?php
		
				} else {
			if (isset ( $_POST ['reaver_start'] )) {
				?>
        <textarea id="output" class="module-content"><?=$reaver->getReaverResult();?></textarea>
        
        <?php }}?>

				<input type="hidden" name="type" value="logs">
			</form>

		</div>
		<div id="result-2">

        <?
								$logs = glob ( $mod_logs_history . '*.log' );
								print_r ( $a );
								
								for($i = 0; $i < count ( $logs ); $i ++) {
									$filename = str_replace ( ".log", "", str_replace ( $mod_logs_history, "", $logs [$i] ) );
									echo "<a href='?logfile=" . str_replace ( ".log", "", str_replace ( $mod_logs_history, "", $logs [$i] ) ) . "&action=delete'><b>x</b></a> ";
									echo $filename . " | ";
									echo "<a href='?logfile=" . str_replace ( ".log", "", str_replace ( $mod_logs_history, "", $logs [$i] ) ) . "&action=view'><b>view</b></a>";
									echo "<br>";
								}
								?>
    </div>

	</div>


</body>
</html>

