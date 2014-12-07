<?php
// use sessions
session_start();
 
// get language preference
if (isset($_GET["lang"])) {
    $language = $_GET["lang"];
}
else if (isset($_SESSION["lang"])) {
    $language  = $_SESSION["lang"];
}
else if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	switch (locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		case "de":
		case "de_AT":
		case "de_DE":
			$language = "de_AT.utf8";
			break;
		case "fr":
		case "fr_FR":
			$language = "fr_FR.utf8";
			break;
		default:
			$language = "en_US";
			break;
	}
}
else {
	$language = "de_AT.utf8";
}

// save language preference for future page requests
$_SESSION["lang"]  = $language;
 
$folder = "Locale";
$domain = "messages";
$encoding = "UTF-8";
 
putenv("LANG=" . $language); 
setlocale(LC_ALL, $language);
 
bindtextdomain($domain, $folder); 
bind_textdomain_codeset($domain, $encoding);
 
textdomain($domain);
?>
