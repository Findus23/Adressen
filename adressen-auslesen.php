<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Adressen auslesen</title>
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden
$ergebnis = $mysqli->query("SELECT * FROM adressen");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>Vorname</th><th>Nachname</th><th>Ort</th><th>Adresse</th><th>ändern</th><th>löschen</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) { // für jeden Wert in der Datenbank eine Tabellenzeile
		echo "<tr><td>" . htmlspecialchars($zeile["vorname"]) . "</td>"
        . "<td>" . htmlspecialchars($zeile['nachname']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['plz']) . " " . htmlspecialchars($zeile['ort']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['strasse']) . " " . htmlspecialchars($zeile['hausnummer']) . "</td>"
        . "<td><a href='./adressen-aendern.php?id=" . htmlspecialchars($zeile['id']) . "'>ändern</a></td>"
        . "<td><a href='./adressen-loeschen.php?id=" . htmlspecialchars($zeile['id']) . "'>löschen</a></td>"
        ."</td></tr>\n" ;
}
echo "</table>";
$ergebnis->close();

   if ($stmt = $mysqli->prepare("SELECT vorname,nachname, plz, ort, strasse, hausnummer FROM adressen")) {
        $stmt->execute();
        $stmt->bind_result($vorname, $nachname, $plz, $ort, $strasse, $hausnummer);    
        $stmt->fetch();
        $stmt->close();
    }



$mysqli->close();


?>
<p><a href="./adressen-eingeben.php" >zur Eingabe</a></p>
</body>
</html>
