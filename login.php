<?php
ob_start();
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include_once("includes/checkuserlog.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coursematch</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="main">
	<div id="header"><?php include "headertemplate.php"; ?></div>
    <div id="navbar_login"><?php include "navigationbar.php"; ?></div>
    <div id="content_login"><?php include"bodylogin.php"; ?></div>
    <div id="footer"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>
<?php  ob_end_flush(); ?>