<?php
 ob_start();
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include_once("includes/checkuserlog.php");
if(isset($_SESSION['id'])){
header("Location:mainlogin.php");


}
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
    <div id="sidebar"><?php include "sidebar.php"; ?></div>
    <div id="navbar"><?php include "navigationbar.php"; ?></div>
    <div id="content">
    	<center><H1>[About Us]</H1><br /></center>
        <span style="padding-left:30px;"><b>Sagunesh Grover</b>: It's nice of you to take the time to get know me  better. I am 2nd Year B.Tech CSE Student of SRM University.<br /> <span style="padding-left:30px;">For more details.You can contact me at <a href="mailto:sagunesh@gmail.com" class="blue1" style="text-decoration:none">sagunesh@gmail.com</a></span></span><br /><br /> <br /><br /><br /><br />
    	
       
     </div>
    <div id="footer"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>
<?php  ob_end_flush(); ?>