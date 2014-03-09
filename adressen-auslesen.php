<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Adressen auslesen</title>
	<style>
	#navigation { /* Da nav.a nicht funktioniert */
	margin-left: 80px;
	margin-right: 10px;
	</style>
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden
$ergebnis = $mysqli->query("SELECT * FROM adressen ORDER BY vorname");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>ID</th><th>Vorname</th><th>Nachname</th><th>Ort</th><th>Adresse</th><th>Telefon</th><th>email</th><th>bemerkung</th><th>ändern</th><th>löschen</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) { // für jeden Wert in der Datenbank eine Tabellenzeile
		echo "<tr><td>" . htmlspecialchars($zeile["id"]) . "</td>"
        . "<td>" . htmlspecialchars($zeile['vorname']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['nachname']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['plz']) . " " . htmlspecialchars($zeile['ort']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['strasse']) . " " . htmlspecialchars($zeile['hausnummer']) . "</td>"
		. "<td>" . htmlspecialchars($zeile['telefon']) . "</td>"
		. "<td>" . htmlspecialchars($zeile['email']) . "</td>"
		. "<td>" . htmlspecialchars($zeile['bemerkung']) . "</td>"
        . "<td><a href='./adressen-aendern.php?id=" . htmlspecialchars($zeile['id']) . "'>ändern</a></td>" // für jede Zeile wird ein Link der Art "./loeschen.php?id=1" erstellt, um in der Datei auszuwählen, welcher Kontakt bearbeitet/gelöscht werden soll
        . "<td><a href='./adressen-loeschen.php?id=" . htmlspecialchars($zeile['id']) . "'>löschen</a></td>"
        ."</td></tr>\n" ;
}
echo "</table>";
$ergebnis->close();
$mysqli->close();


?>
<nav>
<a id="navigation" href="./adressen-eingeben.php" >zur Eingabe</a>
<a id="navigation" href="./adressen-auslesen.php" >zum Auslesen</a>
<a id="navigation" href="./adressen-aendern.php" >zum Ändern</a>
<a id="navigation" href="./adressen-loeschen.php" >zum Löschen</a>
</nav>
</body>
</html>
