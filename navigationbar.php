<?php
/*
*
*
--------------------------------This script is created by Sagunesh Grover-------------------------
*
*/
?>
<div id="navbar_container">
	<font color="#FFFFFF">&nbsp;<?php 
	ob_start();
	
	if (isset($_SESSION['idx']) && $logOptions_id != $id) {
	print" $username's profile";
	}
	elseif (isset($_SESSION['idx']) && $logOptions_id == $id) {
	print" $username(This is you)";
	}
	else{
		print"Welcome to Srmuhums.in!";
	}
	ob_end_flush();
	?>
    </font>
</div>