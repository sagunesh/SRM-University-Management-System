

<?php
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include_once("includes/checkuserlog.php");
?>
<?php
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
<script>
    paceOptions = {
      elements: true
    };
  </script>
  <script src="js/loading.js"></script>
  <script>
    function load(time){
      var x = new XMLHttpRequest()
      x.open('GET', "http://localhost:5646/walter/" + time, true);
      x.send();
    };

    load(20);
    load(100);
    load(500);
    load(2000);
    load(3000);

    setTimeout(function(){
      Pace.ignore(function(){
        load(3100);
      });
    }, 4000);

    Pace.on('hide', function(){
      console.log('done');
    });

  </script>


</head>

<body>
<div id="main">
	<div id="header"><?php include "headertemplate.php"; ?></div>
    <div id="sidebar"><?php include "sidebar.php"; ?></div>
    <div id="navbar"><?php include "navigationbar.php"; ?></div>
    <div id="content"><?php include"body.php"; ?></div>
    <div id="footer"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>
