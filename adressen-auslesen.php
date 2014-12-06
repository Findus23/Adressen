<!DOCTYPE html>
<html lang="de">
<?php
require_once "locale.php"; //Lokalisierung starten
?>
<head>
	<meta charset="utf-8" />
	<title><?php echo _("Show Addresses") ?></title>
	<style>
	#navigation {
	margin-left: 80px;
	margin-right: 10px;
	}
	</style>
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden
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
echo "<p>" . $language ."</p>";
$ergebnis->close();
$mysqli->close();
?>
<nav>
<a id="navigation" href="./adressen-eingeben.php" >zur Eingabe</a>
<a id="navigation" href="./adressen-auslesen.php" >zum Auslesen</a>
<a id="navigation" href="./adressen-aendern.php" >zum Ändern</a>
<a id="navigation" href="./adressen-loeschen.php" >zum Löschen</a>
</nav>
</br><a href='./adressen-auslesen.php?lang=<?php
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
