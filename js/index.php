<?php
/* To direct user to index page securoty purpose*------------------------------------------------------------------------------------------------*/
?>
<?php 
header("location: ../index.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
?>