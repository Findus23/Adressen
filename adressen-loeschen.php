<?php
if (isset($_GET["id"]) && is_numeric($_GET["id"])) { // nur löschen, wenn id eine Zahl ist
require_once "verbindungsaufbau.php"; //mit Server verbinden

$sql= "DELETE FROM adressen WHERE id = '$_GET[id]'";

if ($mysqli->query($sql)) {
	$host =htmlspecialchars($_SERVER["HTTP_HOST"]); // optional: Host herrausfinden (z.B.: localhost oder google.at)
	$link= rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\"); // optional: link zur Datei herrausfinden (z.B.: /adressen/loeschen.php)
	$URL = "http://$host$link";	// optional:http://, Host und Link zusammenfügen um Url zur Datei zu bekommen
	header("Location: ". $URL ."/adressen-auslesen.php"); // zur Hauptseite weiterleiten /alternativ: echo "Die Datei wurde erfolgreich gelöscht"
} else {
	echo "<p><strong>Eintragung nicht erfolgreich. Der folgende Fehler ist aufgetreten:" . $mysqli->error . "</strong></p>";
}

} else {
	echo "<p>Ungültiger Parameter</p>";
}
?>
