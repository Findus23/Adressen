<!DOCTYPE html>
<html>

<head>
	<title>Adressen ändern</title>
	<meta charset="utf-8" />
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden
if (isset($_GET["id"]) && is_numeric($_GET["id"])) { // nur löschen, wenn id eine Zahl ist

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
?>
<p> <strong> Bitte die ID des Freundes eingeben, den Sie löschen möchten: </strong></p>
<form method="GET" action="./adressen-loeschen.php">
<input type="number" name="id" />
<input type="submit" value="Adresse löschen" />
</form>
<hr />
<?php
}
$ergebnis = $mysqli->query("SELECT * FROM adressen ORDER BY vorname");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>Vorname</th><th>Nachname</th><th>Ort</th><th>Adresse</th><th>Telefon</th><th>email</th><th>bemerkung</th><th>ändern</th><th>löschen</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) { // für jeden Wert in der Datenbank eine Tabellenzeile
		echo "<tr><td>" . htmlspecialchars($zeile["vorname"]) . "</td>"
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

</body>
</html>
