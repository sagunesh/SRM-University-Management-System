
<?php
session_start();
// Unset all of the session variables
$_SESSION = array();
// If it's desired to kill the session, also delete the session cookie
if (isset($_COOKIE['idCookie'])) {
    setcookie("idCookie", '', time()-42000, '/');
	setcookie("passCookie", '', time()-42000, '/');
}
// Destroy the session variables
session_destroy();
// Check to see if their session is in fact destroyed
header("location: index.php"); // << makes the script send them to any page we set
exit();
 
?> 