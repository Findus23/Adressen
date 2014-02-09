<!DOCTYPE html>
<html>

<head>
	<title>Adressen ändern</title>
	<meta charset="utf-8" />
</head>

<body>

<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden

if ($stmt = $mysqli->prepare("SELECT * FROM adressen WHERE id = ?")) { // Datenbank auslesen um alte Daten einzufügen
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $stmt->bind_result($id, $vorname, $nachname, $plz, $ort, $strasse, $hausnummer, $email, $telefon, $bemerkung);
        $stmt->fetch();
        $stmt->close();
} else {echo "Ein Fehler ist aufgetreten.";}
?>

<h1>Adressen ändern</h1>
<form action="adressen-aendern.php" method="POST">
<table>
	<tr>
		<td>Vorname:</td>
		<td><input type="text" name="vorname" required autofocus value="<?php echo $vorname; ?>" /></td>
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
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<input type="submit" id="submit" name="submit" value="Adresse ändern">
</form>

<p><a href="./adressen-auslesen.php" >zum Auslesen</a></p>

<?php
if (isset($_POST["submit"])) {

# falls Klick auf Submit-Button --> mit Datenbank verbinden
include("verbindungsaufbau.php");

#Definieren der SQL-INSERT Anweisung
$sql= "UPDATE adressen SET vorname = '$_POST[vorname]',nachname = '$_POST[nachname]',plz = '$_POST[plz]',ort = '$_POST[ort]',strasse = '$_POST[strasse]',hausnummer = '$_POST[hausnummer]',email = '$_POST[email]',telefon = '$_POST[telefon]',bemerkung = '$_POST[bemerkung]' WHERE id = $_POST[id];";
#Durchführen der Eintragung + Rückmeldung ob Erfolg
if ($mysqli->query($sql)) {
	echo "<p><strong>Eintragung erfolgreich</p>";
} else {
	echo "<p><strong>Eintragung nicht erfolgreich. Der folgende Fehler ist aufgetreten:" . $mysqli->error . "</strong></p>";
}
}
?>

</body>
</html>
