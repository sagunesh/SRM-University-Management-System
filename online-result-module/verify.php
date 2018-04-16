<?php
	session_start();
	include('connect_to_mysql.php');
	$conn = mysql_connect("$host","$dir","$pass") or die (mysql_error());
	mysql_select_db("$dbname") or die (mysql_error());

	$rollno=$_POST['rollno'];
	
	$result = mysql_query("select * from details where rollno='$rollno'",$conn)
		or die("Could not execute the select query.");

	$row = mysql_fetch_assoc($result);
	
	if(is_array($row) && !empty($row))
		{
			$validuser = $row['rollno'];
			$_SESSION['rollno'] = $validuser;
				if(isset($validuser))
				{
				header('location:progressbar.php');
				}
		}
	else
		{
			header('location:error.php');
			
		}


	

	
?>
