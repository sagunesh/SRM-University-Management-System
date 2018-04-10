<!----This Script is created by Sagunesh Grover---->
<?php
/*
----------This Script is created by Sagunesh Grover----------
*/
?>
<?php
 //connecting to the database
 include "includes/connect_to_mysql.php"; 
 include_once("includes/checkuserlog.php");
?>
 <?php 

// Now let's initialize vars to be printed to page in the HTML section so our script does not return errors 
// they must be initialized in some server environments
$id = "";
$username="";
$firstname = "";
$middlename = "";
$lastname = "";
$school ="";
$country = "";	
$state = "";
$city = "";
$zip = "";
$bio_body = "";
$bio_body = "";
$website = "";
$youtube = "";
$user_pic = "";
$blabberDisplayList = "";
$gender= "";
$birthday= "";
// If coming from category page
if (isset($_GET['id'])) {
	 $id = preg_replace('#[^0-9]#i', '', $_GET['id']); // filter everything but numbers
} else if (isset($_SESSION['idx'])) {
	 $id = $logOptions_id;
} else {
   header("location: error.php");
   exit();
}
$id = mysql_real_escape_string($id);
$id = preg_replace("/`/", "", $id);
$sql = mysql_query("SELECT * FROM myMembers WHERE id='$id'");
// Make sure this person a visitor is trying to view actually exists
$existCount = mysql_num_rows($sql);
 if ($existCount == 0) {
	 echo '<h3>Error: The user you are trying to access does not exist in our system. Press back.</h3>';
     exit();
}
// End Make sure this person a visitor is trying to view actually exists
while($row = mysql_fetch_array($sql)){ 
	$id=$row["id"];
	$firstname = $row["firstname"];
	$username = $row["username"];
	$lastname = $row["lastname"];
	$birthday = $row["birthday"];
	$birthday = strftime("%b %d, %Y", strtotime($birthday));
	$school = $row["school"];	
	$country = $row["country"];	
	$state = $row["state"];
	$city = $row["city"];
	$zip = $row["zip"];
	$gender= $row["gender"];
	$email = $row["email"];
	$email = "<a href=\"mailto:$email\" class=\"blue1\" style=\"text-decoration:none;\">$email</a>";	
	$sign_up_date = $row["sign_up_date"];
    $sign_up_date = strftime("%b %d, %Y", strtotime($sign_up_date));
	$last_log_date = $row["last_log_date"];
    $last_log_date = strftime("%b %d, %Y", strtotime($last_log_date));	
	$bio_body = $row["bio_body"];	
	$website = $row["website"];
	$youtube = $row["youtube"];
	$type=$row["account_type"];
	$branch=$row["Branch"];
	///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "members/$id/image01.jpg";//permission of 0 folder to be set on 755 for security reasons in future
	$default_pic = "members/0/image01.jpg";
	if (file_exists($check_pic)) {
    $user_pic = "<img src=\"$check_pic\" width=\"200px \" style=\"padding:8px;\" height=\"200px \" >"; // forces picture to be propotionally wide 
	} else {
	$user_pic = "<img src=\"$default_pic\" width=\"200px\"  style=\"padding:8px;\" height=\"200px\" />";// forces dflt picture to be propotionally wide
	}
	///////  Mechanism to Display Youtube Channel or not  //////////////////////////
	if ($youtube == "") { 
    $youtubeChannel = "<br />This user has no YouTube channel yet.";
	} else {
	$youtubeChannel = ' <script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/youtube.xml&amp;up_channel=' . $youtube . '&amp;synd=open&amp;w=290&amp;h=370&amp;title=&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>  '; // forces default picture to be 100px wide and no more
	}	

} // close while loop

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$style_sheet = "default";(use for changing look of the profles in future)

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
    <div id="content"><?php include"myaccount.php"; ?></div>
    <div id="footer"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>
