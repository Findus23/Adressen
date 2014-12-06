<!DOCTYPE html>
<html>
<?php
require_once "locale.php"; //Lokalisierung starten
?>
<head>
	<title><?php echo _("Enter Address") ?></title>
	<meta charset="utf-8" />
</head>

<body>

<h1><?php echo _("Enter Address") ?></h1>
<form action="adressen-eingeben.php" method="POST">
<table>
	<tr>
		<td><?php echo _("First Name") ?>:</td>
		<td><input type="text" name="vorname" required autofocus /></td>
	</tr>
	<tr>
		<td><?php echo _("Surname") ?>: </td>
		<td><input type="text" name="nachname" required  /></td>
	</tr>
	<tr>
		<td><?php echo _("Address") ?>: </td>
		<td><input type="text" name="plz" required /></td>
	</tr>
	<tr>
		<td><?php echo _("City") ?>: </td>
		<td><input type="text" name="ort" required  /></td>
	</tr>
	<tr>
		<td><?php echo _("Street") ?>: </td>
		<td><input type="text" name="strasse" required  /></td>
	</tr>
	<tr>
		<td><?php echo _("House Number") ?>: </td>
		<td><input type="text" name="hausnummer" required  /></td>
	</tr>
	<tr>
		<td><?php echo _("Phone") ?>: </td>
		<td><input type="text" name="telefon"  /></td>
	</tr>
	<tr>
		<td><?php echo _("E-Mail") ?>: </td>
		<td><input type="text" name="email" required  /></td>
	</tr>
	<tr>
		<td><?php echo _("Comment") ?>: </td>
		<td><textarea name="bemerkung" rows="5" cols="25"></textarea></td>
	</tr>
</table>
<input type="submit" id="submit" name="submit" value="<?php echo _("submit address") ?>">
</form>

<p><a href="./adressen-auslesen.php" ><?php echo _("to list of addresses") ?></a></p>

<?php
if (isset($_POST["submit"])) {

# falls Klick auf Submit-Button --> mit Datenbank verbinden
include("verbindungsaufbau.php");

#Definieren der SQL-INSERT Anweisung
$sql= "INSERT INTO adressen (id, vorname, nachname, plz, ort, strasse, hausnummer, email, telefon, bemerkung) VALUES ('', '$_POST[vorname]', '$_POST[nachname]', '$_POST[plz]', '$_POST[ort]', '$_POST[strasse]', '$_POST[hausnummer]', '$_POST[email]', '$_POST[telefon]', '$_POST[bemerkung]')";

#Durchführen der Eintragung + Rückmeldung ob Erfolg
if ($mysqli->query($sql)) {
	echo "<p><strong>" . _("Submission was successful") . "</p>";
} else {
	echo "<p><strong>" . _("Submission was not successful. The following error occurred:") . $mysqli->error . "</strong></p>";
}

}
?>

</body>
</html>
