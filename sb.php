<?php
/*
--------------------------------Sagunesh Gover-----------------------------*/

// Force script errors and warnings to show on page in case php.ini file is set to not display them
error_reporting(E_ALL);
ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------
// Initialize some vars
$errorMssg = '';
$email = '';
$pass = '';
$remember = '';
if (isset($_POST['email'])) {
	
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	if (isset($_POST['remember'])) {
		$remember = $_POST['remember'];
	}
	$email = stripslashes($email);
	$pass = stripslashes($pass);
	$email = strip_tags($email);
	$pass = strip_tags($pass);
	
	// error handling conditional checks go here
	if ((!$email) || (!$pass)) { 

		$errorMssg = 'Please fill in both fields';

	} else { // Error handling is complete so process the info if no errors
		include 'includes/connect_to_mysql.php'; // Connect to the database
		$email = mysql_real_escape_string($email); // After we connect, we secure the string before adding to query
	    //$pass = mysql_real_escape_string($pass); // After we connect, we secure the string before adding to query
		$pass = $pass; // in future Add MD5 Hash here md5($pass)to the password variable they supplied after filtering it
		// Make the SQL query
        $sql = mysql_query("SELECT * FROM myMembers WHERE email='$email' AND password='$pass' AND email_activated='1'"); 
		$login_check = mysql_num_rows($sql);
        // If login check number is greater than 0 (meaning they do exist and are activated)
		if($login_check > 0){ 
    			while($row = mysql_fetch_array($sql)){
					
					// Pleae note: Sagunesh removed all of the session_register() functions cuz they were deprecated and
					// he made the scripts to where they operate universally the same on all modern PHP versions(PHP 4.0  thru 5.3+)
					// Create session var for their raw id
					$id = $row["id"];   
					$_SESSION['id'] = $id;
					// Create the idx session var
					$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id");
                    // Create session var for their username
					$username = $row["username"];
					$_SESSION['username'] = $username;
					// Create session var for their email
					$useremail = $row["email"];
					$_SESSION['useremail'] = $useremail;
					// Create session var for their password
					$userpass = $row["password"];
					$_SESSION['userpass'] = $userpass;

					mysql_query("UPDATE myMembers SET last_log_date=now() WHERE id='$id' LIMIT 1");
        
    			} // close while
	
    			// Remember Me Section
    			/*if($remember == "yes"){
                    $encryptedID = base64_encode("saguneshg4enm2c0c4y3dn3727553$id");
    			    setcookie("idCookie", $encryptedID, time()+60*60*24*100, "/"); // Cookie set to expire in about 30 days
			        setcookie("passCookie", $pass, time()+60*60*24*100, "/"); // Cookie set to expire in about 30 days
    			} */
    			// All good they are logged in, send them to homepage then exit script
    			header("location: home.php?test=$id"); 
    			exit();
	
		} else { // Run this code if login_check is equal to 0 meaning they do not exist
		    $errorMssg = "Incorrect login data, please try again";
		}


    } // Close else after error checks

} //Close if (isset ($_POST['uname'])){

?>
<!---This Script is Created By Sagunesh Grover---->

<table cellspacing="0" style="border: 1px dashed #3B5999;" width="100%" height="3%"><tr><td><div align="left"> <form action="" method="post" enctype="multipart/form-data" name="signinform" id="signinform">Email:<br />
<input type="text" name="email" id="email" STYLE="font-family: Verdana; font-weight: normal; font-size: 12px; background-color:#D8DEEA;width:99.9%;border-color:#000000;border-width:1px;"><br /> 
Password:<br /><INPUT type="password" name="pass" id="pass"  STYLE="font-family: Verdana; font-weight: normal; font-size: 12px; background-color:#D8DEEA;width:99.9%;border-color:#000000; border-width:1px;"><br />
</div>

  <center> <table cellspacing="0"><tr><td><input name="remember" type="checkbox" id="remember" value="yes" checked="checked" />
        Remember Me</td><td><td>
    <input type="submit" class="myButton" value="login" />
  </form></td>
</tr></table>
  </center>
<center><font color="#3B5999"><?php print "$errorMssg"; ?></font></center>
<p>
</tr>
</table>