<!DOCTYPE html>
<html>
<?php
require_once "locale.php"; //Lokalisierung starten
?>
<head>
	<title><?php echo _("Delete Address") ?></title>
	<meta charset="utf-8" />
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden
if (isset($_GET["id"]) && is_numeric($_GET["id"])) { // nur löschen, wenn id eine Zahl ist

$sql= "DELETE FROM adressen WHERE id = '$_GET[id]'";

if ($mysqli->query($sql)) {
	$host =htmlspecialchars($_SERVER["HTTP_HOST"]); // optional: Host herausfinden (z.B.: localhost oder google.at)
	$link= rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\"); // optional: link zur Datei herrausfinden (z.B.: /adressen/loeschen.php)
	$URL = "http://$host$link";	// optional:http://, Host und Link zusammenfügen um Url zur Datei zu bekommen
	header("Location: ". $URL ."/adressen-auslesen.php"); // zur Hauptseite weiterleiten /alternativ: echo "Die Datei wurde erfolgreich gelöscht"
} else {
	echo "<p><strong>" . _("Deletion was not successful. The following error occurred:") . $mysqli->error . "</strong></p>";
}

} else { # Falls keine ID über GET empfangen wurde
?>
<p> <strong><?php echo _("Please enter the ID of the address you like to delete.") ?></strong></p>
<form method="GET" action="./adressen-loeschen.php">
<input type="number" name="id" min="0" required /> 
<input type="submit" value="<?php echo _("delete address") ?>" />
</form>
<hr />
<?php
}
$ergebnis = $mysqli->query("SELECT * FROM adressen ORDER BY vorname");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>" . _("ID") . "</th><th>" . _("First Name") . "</th><th>" . _("Surname") . "</th><th>" . _("City") . "</th><th>" . _("Address") . "</th><th>" . _("Phone") . "</th><th>" . _("E-Mail") . "</th><th>" . _("Comment") . "</th><th>" . _("Change") . "</th><th>" . _("Delete") . "</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) { // für jeden Wert in der Datenbank eine Tabellenzeile
		echo "<tr><td>" . htmlspecialchars($zeile["id"]) . "</td>"
        . "<td>" . htmlspecialchars($zeile['vorname']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['nachname']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['plz']) . " " . htmlspecialchars($zeile['ort']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['strasse']) . " " . htmlspecialchars($zeile['hausnummer']) . "</td>"
		. "<td>" . htmlspecialchars($zeile['telefon']) . "</td>"
		. "<td>" . htmlspecialchars($zeile['email']) . "</td>"
		. "<td>" . htmlspecialchars($zeile['bemerkung']) . "</td>"
        . "<td><a href='./adressen-aendern.php?id=" . htmlspecialchars($zeile['id']) . "'>" . _("Change") . "</a></td>" // für jede Zeile wird ein Link der Art "./loeschen.php?id=1" erstellt, um in der Datei auszuwählen, welcher Kontakt bearbeitet/gelöscht werden soll
        . "<td><a href='./adressen-loeschen.php?id=" . htmlspecialchars($zeile['id']) . "'>" . _("Delete") . "</a></td>"
        ."</td></tr>\n" ;
}
echo "</table>";
$ergebnis->close();
$mysqli->close();
?>
<a style="position:absolute;top:10px;right:10px" href='?lang=<?php
switch ($language) {
	case "en_US":
		echo "de_AT.utf8'>zu Deutsch wechseln";
		break;
	case "de_AT.utf8":
		echo "en_US'>switch to English";
		break;
	default:
		echo "de_AT.utf8'>zu Deutsch wechseln";
		break;
}
?></a>
</body>
</html>
