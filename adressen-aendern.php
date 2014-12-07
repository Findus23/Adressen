<!DOCTYPE html>
<html>
<?php
require_once "locale.php"; //Lokalisierung starten
?>
<head>
	<title><?php echo _("Change Address") ?></title>
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
		<td><?php echo _("First Name") ?>:</td>
		<td><input type="text" name="vorname" required autofocus value="<?php echo $vorname; //jeweils für value='' den Wert einsetzen ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("Surname") ?>: </td>
		<td><input type="text" name="nachname" required  value="<?php echo $nachname; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("postcode") ?>: </td>
		<td><input type="text" name="plz" required  value="<?php echo $plz; ?>"/></td>
	</tr>
	<tr>
		<td><?php echo _("City") ?>: </td>
		<td><input type="text" name="ort" required  value="<?php echo $ort; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("Street") ?>: </td>
		<td><input type="text" name="strasse" required  value="<?php echo $strasse; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("House Number") ?>: </td>
		<td><input type="text" name="hausnummer" required  value="<?php echo $hausnummer; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("Phone") ?>: </td>
		<td><input type="text" name="telefon" value="<?php echo $telefon; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("E-Mail") ?>: </td>
		<td><input type="text" name="email" required value="<?php echo $email; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _("Comment") ?>: </td>
		<td><textarea name="bemerkung" rows="5" cols="25"><?php echo $bemerkung; ?></textarea></td>
	</tr>
</table>
<input type="hidden" name="id" value="<?php echo $_GET['id']; //verstecktes Formularfeld, in dem die id mitgeschickt wird (wäre sonst beim absenden nicht mehr vorhanden) ?>" />
<input type="submit" id="submit" name="submit" value="<?php echo _("change address") ?>">
</form>

<p><a href="./adressen-auslesen.php" >zum Auslesen</a></p>

<?php
if (isset($_POST["submit"])) { //Wenn die Daten abgeschickt wurden ...

$sql= "UPDATE adressen SET vorname = '$_POST[vorname]',nachname = '$_POST[nachname]',plz = '$_POST[plz]',ort = '$_POST[ort]',strasse = '$_POST[strasse]',hausnummer = '$_POST[hausnummer]',email = '$_POST[email]',telefon = '$_POST[telefon]',bemerkung = '$_POST[bemerkung]' WHERE id = $_POST[id];"; //Alle Felder updaten
#Durchführen der Eintragung + Rückmeldung ob Erfolg
if ($mysqli->query($sql)) {
	echo "<p><strong>" . _("Submission was successful") . "</p>";
} else {
	echo "<p><strong>" . _("Submission was not successful. The following error occurred:") . $mysqli->error . "</strong></p>";
}
}
} else { # Falls keine ID über GET übertragen wurde
?>
<p> <strong><?php echo _("Please enter the ID of the address you like to change.") ?></strong></p>
<form method="GET" action="./adressen-aendern.php">
<input type="number" name="id" min="0" required /> 
<input type="submit" value="<?php echo _("change address") ?>"/>
</form>
<br />
<?php 

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
}
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
