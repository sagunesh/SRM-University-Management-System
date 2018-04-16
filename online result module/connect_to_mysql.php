
<?php
$host="localhost";
$dir="root";
$dbname="srm_result";
$pass="";
//connection for progress bar header
mysql_connect("$host","$dir","$pass") or die (mysql_error());
mysql_select_db("$dbname") or die (mysql_error());
?>
