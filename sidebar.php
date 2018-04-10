
<?php 
ob_start();
if (isset($_SESSION['idx']) && $logOptions_id != $id) {
	include("sb1.php");
}
elseif (isset($_SESSION['idx']) && $logOptions_id == $id) {
	include("sb1.php");
	}
	else{
		include("sb.php");
	}
	ob_end_flush();
?>