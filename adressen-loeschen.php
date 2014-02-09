<?php
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
require_once "verbindungsaufbau.php"; //mit Server verbinden

$sql= "DELETE FROM adressen WHERE id = '$_GET[id]'";

if ($mysqli->query($sql)) {
	header("Location: http://localhost/mysql/adressen-auslesen.php"); // zur Hauptseite weiterleiten
} else {
	echo "<p><strong>Eintragung nicht erfolgreich. Der folgende Fehler ist aufgetreten:" . $mysqli->error . "</strong></p>";
}

} else {
	echo "<p>Ungültiger Parameter</p>";
}
?>
