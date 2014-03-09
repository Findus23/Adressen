<!DOCTYPE html>
<html>

<head>
	<title>Adressen ändern</title>
	<meta charset="utf-8" />
</head>

<body>

<?php //die id wird in der Übersicht per "?id=" in der URL (also GET) mitgeschickt und ist mit $_GET["id"] ausgelesen
include("verbindungsaufbau.php"); //mit Datenbank verbinden
if (isset($_GET["id"]) && is_numeric($_GET["id"]) || isset($_POST["id"]) && is_numeric($_POST["id"])) { // das ganze Skript nur ausführen, wenn die id eine Zahl ist
require_once "verbindungsaufbau.php"; //mit Server verbinden

if ($stmt = $mysqli->prepare("SELECT * FROM adressen WHERE id = ?")) { // Datenbank auslesen um alte Daten einzufügen (? ist ein Platzhalter) - alternative Methode
        $stmt->bind_param("i", $_GET["id"]);	// diesen Platzhalter durch $id ersetzen ("i" bedeutet, dass nur eine Zahl eingesetzt werden kann)
        $stmt->execute(); // den Befehl ausführen
        $stmt->bind_result($id, $vorname, $nachname, $plz, $ort, $strasse, $hausnummer, $email, $telefon, $bemerkung); // die herrausbekommenen Werte Variablen zuordnen
        $stmt->fetch(); //Zuordnung ausführen
        $stmt->close(); 
} else {echo "Ein Fehler ist aufgetreten.";}
?>

<h1>Adressen ändern</h1>
<form action="adressen-aendern.php" method="POST">
<table>
	<tr>
		<td>Vorname:</td>
		<td><input type="text" name="vorname" required autofocus value="<?php echo $vorname; //jeweils für value='' den Wert einsetzen ?>" /></td>
	</tr>
	<tr>
		<td>Nachname: </td>
		<td><input type="text" name="nachname" required  value="<?php echo $nachname; ?>" /></td>
	</tr>
	<tr>
		<td>PLZ: </td>
		<td><input type="text" name="plz" required  value="<?php echo $plz; ?>"/></td>
	</tr>
	<tr>
		<td>Ort: </td>
		<td><input type="text" name="ort" required  value="<?php echo $ort; ?>" /></td>
	</tr>
	<tr>
		<td>Straße: </td>
		<td><input type="text" name="strasse" required  value="<?php echo $strasse; ?>" /></td>
	</tr>
	<tr>
		<td>Hausnummer: </td>
		<td><input type="text" name="hausnummer" required  value="<?php echo $hausnummer; ?>" /></td>
	</tr>
	<tr>
		<td>Telefon: </td>
		<td><input type="text" name="telefon" value="<?php echo $telefon; ?>" /></td>
	</tr>
	<tr>
		<td>E-Mail: </td>
		<td><input type="text" name="email" required value="<?php echo $email; ?>" /></td>
	</tr>
	<tr>
		<td>Bemerkung: </td>
		<td><textarea name="bemerkung" rows="5" cols="25"><?php echo $bemerkung; ?></textarea></td>
	</tr>
</table>
<input type="hidden" name="id" value="<?php echo $_GET['id']; //verstecktes Formularfeld, in dem die id mitgeschickt wird (wäre sonst beim absenden nicht mehr vorhanden) ?>" />
<input type="submit" id="submit" name="submit" value="Adresse ändern">
</form>

<p><a href="./adressen-auslesen.php" >zum Auslesen</a></p>

<?php
if (isset($_POST["submit"])) { //Wenn die Daten abgeschickt wurden ...

$sql= "UPDATE adressen SET vorname = '$_POST[vorname]',nachname = '$_POST[nachname]',plz = '$_POST[plz]',ort = '$_POST[ort]',strasse = '$_POST[strasse]',hausnummer = '$_POST[hausnummer]',email = '$_POST[email]',telefon = '$_POST[telefon]',bemerkung = '$_POST[bemerkung]' WHERE id = $_POST[id];"; //Alle Felder updaten
#Durchführen der Eintragung + Rückmeldung ob Erfolg
if ($mysqli->query($sql)) {
	echo "<p><strong>Eintragung erfolgreich</strong></p>";
} else {
	echo "<p><strong>Eintragung nicht erfolgreich. Der folgende Fehler ist aufgetreten:" . $mysqli->error . "</strong></p>";
}
}
} else { # Falls keine ID über GET übertragen wurde
?>
<p> <strong> Bitte die ID des Freundes eingeben, den Sie ändern möchten: </strong></p>
<form method="GET" action="./adressen-aendern.php">
<input type="number" name="id" min="0" required /> 
<input type="submit" value="Adresse bearbeiten"/>
</form>
<br />
<?php 

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


}
?>

</body>
</html>
