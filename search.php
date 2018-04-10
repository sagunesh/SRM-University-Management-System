<!----This Script is created by Sagunesh Grover---->
<?php
 
/*
----------This Script is created by Sagunesh Grover----------
*/
?>
<?php
 //connecting to the database
 include_once "includes/connect_to_mysql.php"; 
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
//Build the Output Section Here
$outputList='';
while($row = mysql_fetch_array($sql)){ 
	$id=$row["id"];
	$firstname = $row["firstname"];
	$username = $row["username"];
	$lastname = $row["lastname"];
	$birthday = $row["birthday"];
	$birthday = strftime("%b %d, %Y", strtotime($birthday));
	$school = $row["school"];	
	$branch=$row["Branch"];
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
	///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "members/$id/image01.jpg";//permission of 0 folder to be set on 755 for security reasons in future
	$default_pic = "members/0/image01.jpg";
	/*if (file_exists($check_pic)) {
    $user_pic = "<img src=\"$check_pic\" width=\"80px \"  height=\"80px \"  >"; // forces picture to be propotionally wide 
	} else {*/
	$user_pic = "<img src=\"$default_pic\" width=\"80px\"  height=\"80px \"  />";// forces dflt picture to be propotionally wide
	/*}*/
	///////  Mechanism to Display Youtube Channel or not  //////////////////////////
	if ($youtube == "") { 
    $youtubeChannel = "<br />This user has no YouTube channel yet.";
	} else {
	$youtubeChannel = ' <script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/youtube.xml&amp;up_channel=' . $youtube . '&amp;synd=open&amp;w=290&amp;h=370&amp;title=&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>  '; // forces default picture to be 100px wide and no more
	}	
	

} // close while loop

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$style_sheet = "default";(use for changing look of the profles in future)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*---------------------------Search Member Script----------------------------------------------*/
////////////////////////////////////////////////Pagination Setup///////
//////////////////////////////////// Sagunesh's Pagination Logic ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$nr = mysql_num_rows($sql); // Get total of Num rows from the database query
if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
    //$pn = ereg_replace("[^0-9]", "", $_GET['pn']); // filter everything but numbers for security(deprecated)
} else { // If the pn URL variable is not present force it to be value of page number 1
    $pn = 1;
} 
//This is where we set how many database items to show on each page 
$itemsPerPage = 6; 
// Get the value of the last page in the pagination result set
$lastPage = ceil($nr / $itemsPerPage);
// Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
if ($pn < 1) { // If it is less than 1
    $pn = 1; // force if to be 1
} else if ($pn > $lastPage) { // if it is greater than $lastpage
    $pn = $lastPage; // force it to be $lastpage's value
} 
// This creates the numbers to click in between the next and back buttons
$centerPages = ""; // Initialize this variable
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
	$centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
$sql2 = mysql_query("SELECT id,firstname,lastname,state,Branch FROM myMembers  WHERE email_activated='1' ORDER BY id ASC $limit"); 
//////////////////////////////// END Sagunesh's Pagination Logic ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Sagunesh's Pagination Display Setup ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is not equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1"){
    // This shows the user what page they are on, and the total number of pages
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '<img src="images/clearImage.gif" width="48" height="1" alt="Spacer" />';
	// If we are not on page 1 we can place the Back button
    if ($pn != 1) {
	    $previous = $pn - 1;
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Back</a> ';
    } 
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
		$paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
    } 
}

///////////////////////////////////// END Sagunesh's Pagination Display Setup /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Build the Output Section Here
//Default query string
$queryString= "WHERE email_activated='1' ORDER BY id ASC  $limit";
//Default query string
$queryMsg= "Showing Oldest to Newest by default";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Set up search criteria
if(isset($_POST['searchbtn1'])){	
	if(($_POST['listbyq']=="Freshers")){
	$queryString= "WHERE email_activated='1' ORDER BY id DESC  $limit";
	$queryMsg= "Showing Freshers to Seniors";
	}
}
//Method to search by class
elseif(isset($_POST['searchbtn2'])){
	if ($_POST['listbyq'] == "B.Com") {

    $queryString = "WHERE Branch ='B.Com' AND email_activated='1' ORDER BY id DESC  $limit";
    $queryMsg = "Showing Members with stream B.Com";
	 }
	 elseif ($_POST['listbyq'] == "Btech(CSE)") {

    $queryString = "WHERE Branch ='Btech(CSE)' AND email_activated='1' ORDER BY id DESC  $limit";
    $queryMsg = "Showing Members with stream Btech(CSE)";
	 }
	  elseif ($_POST['listbyq'] == "Btech(ECE)") {

    $queryString = "WHERE Branch ='Btech(ECE)' AND email_activated='1' ORDER BY id DESC  $limit";
    $queryMsg = "Showing Members with stream Btech(ECE)";
	 }
	  elseif ($_POST['listbyq'] == "Btech(EEE)") {

    $queryString = "WHERE Branch ='Btech(EEE)' AND email_activated='1' ORDER BY id DESC  $limit";
    $queryMsg = "Showing Members with stream Btech(EEE)";
	 }
	  elseif ($_POST['listbyq'] == "Btech(ME)") {

    $queryString = "WHERE Branch ='Btech(ME)' AND email_activated='1' ORDER BY id DESC  $limit";
    $queryMsg = "Showing Members with stream Btech(ME)";
	 }
	  elseif ($_POST['listbyq'] == "BBA/MBA") {

    $queryString = "WHERE Branch ='BBA/MBA' AND email_activated='1' ORDER BY id DESC  $limit";
    $queryMsg = "Showing Members with stream BBA/MBA";
	 }
	  elseif ($_POST['listbyq'] == "") {
    $queryMsg = "Showing Members with ";
	 }
	 
	
}
 //Search by firstname
elseif(isset($_POST['searchbtn3'])){	
	if(($_POST['listbyq']=="by_firstname")){
	$fname=$_POST['fname'];
	$fname=stripslashes($fname);
	$fname=strip_tags($fname);
	$fname=mysql_real_escape_string($fname);
	$queryString= "WHERE firstname LIKE '%$fname%' AND email_activated='1'";
	$queryMsg= "Showing mates with name you searched for";
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Set up search criteria end
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Query for members using$queryString variables value
$sql1=mysql_query("SELECT id,firstname,lastname,state,Branch FROM myMembers $queryString");

$outputList = '';
while($row = mysql_fetch_array($sql1)){ 
	$id=$row["id"];
	$firstname = $row["firstname"];
	$branch = $row["Branch"];
	$lastname = $row["lastname"];
	$state = $row["state"];
	$outputList .= '
<table width="100%" border="1px">
	<tr>
		<td width="80px" height="20px" rowspan="3" align="center"><div style="height:100px;overflow:hidden;margin-top:13px;"><a href="mainlogin.php?id='.$id.'" target="_blank">'.$user_pic.'</a></div></td>
	</tr>
	<tr>
		<td width="14%" ><div align="left"><b>Name</b></div></td><td width="63%" ><a href="mainlogin.php?id='.$id.'" target="_blank" class="blue1" style="text-decoration:none;">'.$firstname.' '.$lastname.'</a></td>
	</tr>
		<tr>
		<td width="14%" ><div align="left"><b>Branch</b></div></td><td width="63%" >'.$branch.'</td>
	</tr>
	
</table>


';
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "$firstname Home" ?></title>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
//script for ajax search
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
	$.ajax({
	type: "POST",
	url: "ajaxsearch.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	}
	});
}return false;    
});

jQuery("#result").live("click",function(e){ 
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut(); 
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});
});
</script>
</head>
<body>
<div id="main">
	<div id="header"><?php include "headertemplate.php"; ?></div>
    <div id="sidebar_main_search"><?php include "sidebar.php"; ?></div>
    <div id="navbar"><?php include "navigationbar.php"; ?></div>
    <div id="content_main_search">
    	<div id="search_container">
        	<center><h1>[Search Your Classmate]</h1></center><br />
            	<div id="search_fields">
                	<table cellpadding="0" cellspacing="0" border="1px" style="border-color:#FFF" width="100%">
                    	<tr>
                        	<td width="33.3%"><form action="#" method="post"><center><b>Browse Freshers</b>&nbsp;<input type="submit" class="myButton" name="searchbtn1" value="go" /><input type="hidden" name="listbyq" value="Freshers" /></center></form>
                            </td>
                            <td width="33.3%"><form action="#" method="post"><center><select name="listbyq" class="textbox_edit" style="width:70%; color:black;">
                            
                            <option  value="">Search By Class</option>
                            <option name="listbyq" value="B.Com">B.Com</option>
                            <option name="listbyq" value="Btech(CSE)">Btech(CSE)</option>
                            <option name="listbyq" value="Btech(ECE)">Btech(ECE)</option>
                            <option name="listbyq" value="Btech(EEE)">Btech(EEE)</option>
                            <option name="listbyq" value="Btech(ME)">Btech(ME)</option>
                            <option name="listbyq" value="BBA/MBA">BBA/MBA</option>
                            </select>&nbsp;<input type="submit" class="myButton" name="searchbtn2" value="go" /></center>
                            </form>
                            </td>
                            <td width="33.3%"><center><form action="search.php" method="post"><input type="text" name="fname" class="textbox_edit" style="width:70%; color:black;" placeholder="Search By Name" id="fname" required="required" autofocus="autofocus"  /><input type="hidden" name="listbyq" value="by_firstname" />&nbsp;<input type="submit" name="searchbtn3" class="myButton" value="go" /></form></center>
                            </td>
                        </tr>
                    </table>
                 </div>
               <div>      <h4><?php echo $paginationDisplay; ?></h4></div>
                <div id="output_search"><?php echo "$outputList"; ?></div> 
        </div>
    
    </div>
    <div id="footer_main_search"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>
