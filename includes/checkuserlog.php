<?php
ob_start();
session_start(); // Start Session First Thing
include_once "connect_to_mysql.php"; // Connect to the database
$dyn_www = $_SERVER['HTTP_HOST']; // Dynamic www.domainName available now to you in all of your scripts that include this file
//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
$logOptions = ''; // Initialize the logOptions variable that gets printed to the page
// If the session variable and cookie variable are not set this code runs
if (!isset($_SESSION['id'])) { 
  if (!isset($_COOKIE['idCookie'])) {  
     $logOptions = '&nbsp;&nbsp;&nbsp;<a href="login.php"style="text-decoration: none;" class="white">Login</a>&nbsp;&nbsp;&nbsp;<a href="terms.php" style="text-decoration: none;" class="white">Terms</a>&nbsp;&nbsp;&nbsp;<a href="about.php" style="text-decoration: none;" class="white">About</a>';
   }
}
// If session ID is set for logged in user without cookies remember me feature set
if (isset($_SESSION['id'])) { 

    $logOptions_id = $_SESSION['id'];
     // cut user name down in length if too long
    // Ready the output for this logged in user
    $logOptions = '<a href="home.php" style="text-decoration: none;" class="white">Home</a>
	&nbsp;&nbsp;&nbsp;<a href="mainlogin.php?id=' . $logOptions_id . '" style="text-decoration: none;" class="white">Profile</a>
	&nbsp;&nbsp;&nbsp;<a href="myinfo.php" style="text-decoration: none;" class="white">MyInfo</a>&nbsp;&nbsp;&nbsp;<a href="myaccount.php" style="text-decoration: none;" class="white">My Account</a>&nbsp;&nbsp;&nbsp;<a href="logout.php" style="text-decoration: none;" class="white">Logout</a>';

} else if (isset($_COOKIE['idCookie'])) {// If id cookie is set, but no session ID is set yet, we set it below and update stuff
	
    $userID = $_COOKIE['idCookie'];
	$userPass = $_COOKIE['passCookie'];
	// Get their user first name to set into session var
    $sql_uname = mysql_query("SELECT firstname FROM myMembers WHERE id='$userID' AND password='$userPass' LIMIT 1"); 
    while($row = mysql_fetch_array($sql_uname)){ 
	    $firstName = $row["firstname"];
	}
    session_register('id'); // register the session
    $_SESSION['id'] = $userID; // now add the value we need to the session variable
    session_register('firstname');
    $_SESSION['firstname'] = $firstName;

    $logOptions_id = $userID;
    $logOptions_uname = $firstName;
    $logOptions_uname = substr('' . $logOptions_uname . '', 0, 15); 
    ///////////          Update Last Login Date Field       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    mysql_query("UPDATE myMembers SET last_log_date=now() WHERE id='$logOptions_id'"); 
     // Ready the output for this logged in user
     $logOptions = '<a href="http://' . $dyn_www . '/mainlogin.php?id=' . $logOptions_id . '" style="text-decoration: none;" class="white">' . $logOptions_firstname . '</a><a href="profile1.php?id=' . $logOptions_id . '" style="text-decoration: none;" class="white">profile</a>
	&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;<a href="faq.php" style="text-decoration: none;" class="white">faqs</a>&nbsp;&nbsp;&nbsp;<a href="terms.php" style="text-decoration: none;" class="white">terms</a>&nbsp;&nbsp;&nbsp;<a href="logout.php" style="text-decoration: none;" class="white">logout</a>';
}
ob_end_flush();
?>












