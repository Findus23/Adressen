<?php
$mysqli = new mysqli("localhost", "root", "", "informatik-7a"); //Mit MySQL verbinden
if ($mysqli->connect_error) {
	echo _("Connecting Error: ") . mysql_connect_error();
	exit;
}
if (!$mysqli->set_charset("utf8")) { //Zeichensatz auf UTF-8 setzen (Umlaute!)
	echo _("Error while loading UTF-8");
}
?>
