<!DOCTYPE html>
<html>

<head>
	<title>Adressen eingeben</title>
	<meta charset="utf-8" />
</head>

<body>

<h1>Adressen eingeben</h1>
<form action="adressen-eingeben.php" method="POST">
<table>
	<tr>
		<td>Vorname:</td>
		<td><input type="text" name="vorname" required autofocus /></td>
	</tr>
	<tr>
		<td>Nachname: </td>
		<td><input type="text" name="nachname" required  /></td>
	</tr>
	<tr>
		<td>PLZ: </td>
		<td><input type="text" name="plz" required /></td>
	</tr>
	<tr>
		<td>Ort: </td>
		<td><input type="text" name="ort" required  /></td>
	</tr>
	<tr>
		<td>Straße: </td>
		<td><input type="text" name="strasse" required  /></td>
	</tr>
	<tr>
		<td>Hausnummer: </td>
		<td><input type="text" name="hausnummer" required  /></td>
	</tr>
	<tr>
		<td>Telefon: </td>
		<td><input type="text" name="telefon"  /></td>
	</tr>
	<tr>
		<td>E-Mail: </td>
		<td><input type="text" name="email" required  /></td>
	</tr>
	<tr>
		<td>Bemerkung: </td>
		<td><textarea name="bemerkung" rows="5" cols="25"></textarea></td>
	</tr>
</table>
<input type="submit" id="submit" name="submit" value="Adresse hinzufügen">
</form>

<p><a href="./adressen-auslesen.php" >zum Auslesen</a></p>

<?php
if (isset($_POST["submit"])) {

# falls Klick auf Submit-Button --> mit Datenbank verbinden
include("verbindungsaufbau.php");

#Definieren der SQL-INSERT Anweisung
$sql= "INSERT INTO adressen (id, vorname, nachname, plz, ort, strasse, hausnummer, email, telefon, bemerkung) VALUES ('', '$_POST[vorname]', '$_POST[nachname]', '$_POST[plz]', '$_POST[ort]', '$_POST[strasse]', '$_POST[hausnummer]', '$_POST[email]', '$_POST[telefon]', '$_POST[bemerkung]')";

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
