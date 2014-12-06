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
