<?php
/* 
 * Developed By Sagunesh Grover
 *------------------------------------------------------------------------------------------------*/
// Start_session, check if user is logged in or not, and connect to the database all in one included file
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
if (isset($_SESSION['id'])) {
	
	 $id = $_SESSION['id'];

} else {
	
   include_once "error.php";
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

	$firstname = $row["firstname"];
	$username = $row["username"];
	$lastname = $row["lastname"];
	$birthday = $row["birthday"];
	$school = $row["school"];	
	$country = $row["country"];	
	$state = $row["state"];
	$city = $row["city"];
	$zip = $row["zip"];
	$gender= $row["gender"];
	$email = $row["email"];
	//$email = "<a href=\"mailto:$email\"><u><font color=\"#006600\">Mail</font></u></a>";	
	$sign_up_date = $row["sign_up_date"];
    $sign_up_date = strftime("%b %d, %Y", strtotime($sign_up_date));
	$last_log_date = $row["last_log_date"];
    $last_log_date = strftime("%b %d, %Y", strtotime($last_log_date));	
	$bio_body = $row["bio_body"];	
	$website = $row["website"];
	$youtube = $row["youtube"];
	///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "members/$id/image01.jpg";
	$default_pic = "members/0/image01.jpg";
	if (file_exists($check_pic)) {
    $user_pic = "<img src=\"$check_pic\" width=\"300px\" />"; // forces picture to be 100px wide and no more
	} else {
	$user_pic = "<img src=\"$default_pic\" width=\"300px\" />"; // forces default picture to be 100px wide and no more
	}
	///////  Mechanism to Display Youtube Channel or not  //////////////////////////
	if ($youtube == "") {
    $youtubeChannel = "<br />This user has no YouTube channel yet.";
	} else {
	$youtubeChannel = ' <script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/youtube.xml&amp;up_channel=' . $youtube . '&amp;synd=open&amp;w=290&amp;h=370&amp;title=&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>  '; // forces default picture to be 100px wide and no more
	}	

} // close while loop

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$style_sheet = "default";
?>
<?php
if (!isset($_SESSION['idx'])) {
echo  '<center><h1>[ Error 404 ]</h1></center><br /><br /><center><font color="#FF0000">Your session has timed out</font></center>
<center><p><a href="index.php">Please Click Here</a></p></center>';
exit(); 
}
// Decode the Session IDX variable and extract the user's ID from it
$decryptedID = base64_decode($_SESSION['idx']);
$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
$my_id = $id_array[1];
//$my_uname = $_SESSION['username']; // Put user's first name into a local variable
// ------- ESTABLISH THE INTERACTION TOKEN ---------
$thisRandNum = rand(9999999999999,999999999999999999);
$_SESSION['wipit'] = base64_encode($thisRandNum); // Will always overwrite itself each time this script runs
// ------- END ESTABLISH THE INTERACTION TOKEN ---------
?>
<?php
// Mailbox Parsing for deleting inbox messages
if (isset($_POST['deleteBtn'])) {
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
		if ($key != "deleteBtn") {
		   $sql = mysql_query("UPDATE private_messages SET recipientDelete='1', opened='1' WHERE id='$value' AND to_id='$my_id' LIMIT 1");
		   // Check to see if sender also removed from sent box, then it is safe to remove completely from system
		}
    }
	header("location: pm_inbox.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Messages</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function toggleChecks(field) {
	if (document.myform.toggleAll.checked == true){
		  for (i = 0; i < field.length; i++) {
              field[i].checked = true;
		  }
	} else {
		  for (i = 0; i < field.length; i++) {
              field[i].checked = false;
		  }		
	}
		 
}
$(document).ready(function() { 
$(".toggle").click(function () { 
  if ($(this).next().is(":hidden")) {
	$(".hiddenDiv").hide();
    $(this).next().slideDown("fast"); 
  } else { 
    $(this).next().hide(); 
  } 
}); 
});
function markAsRead(msgID) {
	$.post("scripts_for_profile/markAsRead.php",{ messageid:msgID, ownerid:<?php echo $my_id; ?> } ,function(data) {
		$('#subj_line_'+msgID).addClass('msgRead');
       // alert(data); // This line was just for testing returned data from the PHP file, it is not required for marking messages as read
   });
}
function toggleReplyBox(subject,sendername,senderid,recName,recID,replyWipit) {
	$("#subjectShow").text(subject);
	$("#recipientShow").text(recName);
	document.replyForm.pmSubject.value = subject;
	document.replyForm.pm_sender_name.value = sendername;
	document.replyForm.pmWipit.value = replyWipit;
	document.replyForm.pm_sender_id.value = senderid;
	document.replyForm.pm_rec_name.value = recName;
	document.replyForm.pm_rec_id.value = recID;
    document.replyForm.replyBtn.value = "Send reply to "+recName;
    if ($('#replyBox').is(":hidden")) {
		  $('#replyBox').fadeIn(1000);
    } else {
		  $('#replyBox').hide();
    }      
}
function processReply () {
	
	  var pmSubject = $("#pmSubject");
	  var pmTextArea = $("#pmTextArea");
	  var sendername = $("#pm_sender_name");
	  var senderid = $("#pm_sender_id");
	  var recName = $("#pm_rec_name");
	  var recID = $("#pm_rec_id");
	  var pm_wipit = $("#pmWipit");
	  var url = "scripts_for_profile/private_msg_parse.php";
      if (pmTextArea.val() == "") {
		   $("#PMStatus").text("Please type in your message.").show().fadeOut(6000);
      } else {
		  $("#pmFormProcessGif").show();
		  $.post(url,{ subject: pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderID: senderid.val(), rcpntName: recName.val(), rcpntID: recID.val(), thisWipit: pm_wipit.val() } ,  function(data) {
			   document.replyForm.pmTextArea.value = "";
			   $("#pmFormProcessGif").hide();
			   $('#replyBox').slideUp("fast");
			   $("#PMFinal").html("&nbsp; &nbsp;"+data).show().fadeOut(8000);
           });  
	  }
}
</script>
<style type="text/css"> 
.hiddenDiv{display:none}
#pmFormProcessGif{display:none}
.msgDefault {font-weight:bold;}
.msgRead {font-weight:100;color:#666;}
</style>
<!-----Tabs For Messaging System----->
<link href="style/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="js/tabcontent.js" type="text/javascript"></script>
</head>

<body width="100%" height="100%" style="margin:0px;">
<!---Outer Table  Starts---->
<table cellspacing="0" cellpadding="0" width="100%"   style="border:2px solid #3B5999;">
<tr>
<td>
<!-----Inner Table Containg All frames like Header,Footer and Sidebar---->
<table width="100%" height="100%" border="0" cellspacing="1" cellpadding="0">
<!------Header Template------>
<tr>
<td colspan="2" style="background-color:#3B5999;">
<?php include_once "headertemplate.php"; ?>
</td>
</tr>
<!-----Header Template Ends--->
<!---Sidebar,Navugation Bar,Body Template Starts--->
<tr valign="top">
<!------Side Bar Template Starts--->
<td style="width:20%;text-align:top;">
<?php include_once "sidebar.php"; ?></td>
<!------Side Bar Template Ends--->
<!----Body Template Starts------->
<td style="width:80%;text-align:top;">
<!-----Navigation Bar----->
<?php include_once "navigationbar2.php"; ?>
<!-----Navigation Bar Ends--->
<!------MessageBody Starts Here--->
<table cellspacing="0" cellpadding="0" width="100%"  border="1px" style="border:1px solid #3B5999;">
<tr><td>
<!--------Inner Message Table-------->
<!-----Message Tabs Start Here-------->
<ul class="tabs">
    <li><a href="#view1">Inbox</a></li>
    <li><a href="#view2">Compose</a></li>
    <li><a href="#view3">Sentbox</a></li>
</ul>
<!-------------Inbox Tab Starts Here-------------------------->
<div class="tabcontents">
    <div id="view1">
<table width="100%" style="background-color:white;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="732" valign="top">
  <h1 style="margin-left:24px;"><center>[ Your Inbox ]</center></h2>
<!-- START THE PM FORM AND DISPLAY LIST -->
<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table width="94%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="3%" align="right" valign="bottom"><img src="images/crookedArrow.png" width="16" height="17" alt="Click Here to Delete" /></td>
            <td width="97%" valign="top"><input type="submit" name="deleteBtn" id="deleteBtn" class="myButton" value="Delete" />
              <span id="jsbox" style="display:none"></span>
            </td></tr>
          </tr>
      </table>
        <table width="96%" border="0" align="center" cellpadding="4"  style="border: #999 1px solid;">
          <tr>
            <td width="4%" valign="top">
            <input name="toggleAll" id="toggleAll" type="checkbox" onclick="toggleChecks(document.myform.cb)" />
            </td>
            <td width="20%" valign="top"><B>From</B></td>
            <td width="58%" valign="top"><span class="style2"><b>Subject</b></span></td>
            <td width="18%" valign="top"><B>Date</B></td>
          </tr>
        </table> 
<?php
///////////End take away///////////////////////
// SQL to gather their entire PM list
$sql = mysql_query("SELECT * FROM private_messages WHERE to_id='$my_id' AND recipientDelete='0' ORDER BY id DESC LIMIT 100");

while($row = mysql_fetch_array($sql)){ 

    $date = strftime("%b %d, %Y",strtotime($row['time_sent']));
    if($row['opened'] == "0"){
		    $textWeight = 'msgDefault';
    } else {
			$textWeight = 'msgRead';
    }
    $fr_id = $row['from_id'];    
    // SQL - Collect username for sender inside loop
    $ret = mysql_query("SELECT id, username FROM myMembers WHERE id='$fr_id' LIMIT 1");
    while($raw = mysql_fetch_array($ret)){ $Sid = $raw['id']; $Sname = $raw['username']; }

?>
        <table width="96%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="4%" valign="top">
            <input type="checkbox" name="cb<?php echo $row['id']; ?>" id="cb" value="<?php echo $row['id']; ?>" />
            </td>
            <td width="20%" valign="top"><a href="mainlogin.php?id=<?php echo $Sid; ?>" style="text-decoration:none;" class="blue1"><?php echo $Sname; ?></a></td>
            <td width="58%" valign="top">
              <span class="toggle" style="padding:3px;">
              <a class="<?php echo $textWeight; ?>" id="subj_line_<?php echo $row['id']; ?>" style="cursor:pointer;" onclick="markAsRead(<?php echo $row['id']; ?>)"><?php echo stripslashes($row['subject']); ?></a>
              </span>
              <div class="hiddenDiv"> <br />
                <?php echo stripslashes(wordwrap(nl2br($row['message']), 54, "\n", true)); ?>
                <br /><br /><br />
              </div>
             
  </td>
            <td width="18%" valign="top"><span style="font-size:12px;"><b><?php echo $date; ?></b></span></td>
          </tr>
        </table>
<hr style="margin-left:20px; margin-right:20px;" />
<?php
}// Close Main while loop
?>
<BR /><BR /><BR /><BR /><BR />
</form>
<!-- END THE PM FORM AND DISPLAY LIST -->
<!-- Start Hidden Container the holds the Reply Form -->            
<div id="replyBox" style="display:none; width:680px; height:264px; background-color: #005900; background-repeat:repeat; border: #333 1px solid; top:51px; position:fixed; margin:auto; z-index:50; padding:20px; color:#FFF;">
<div align="right"><a href="javascript:toggleReplyBox('close')"><font color="#00CCFF"><strong>CLOSE</strong></font></a></div>
<h2>Replying to <span style="color:#ABE3FE;" id="recipientShow"></span></h2>
Subject: <strong><span style="color:#ABE3FE;" id="subjectShow"></span></strong> <br>
<form action="javascript:processReply();" name="replyForm" id="replyForm" method="post">
<textarea id="pmTextArea" rows="8" style="width:98%;"></textarea><br />
<input type="hidden" id="pmSubject" />
<input type="hidden" id="pm_rec_id" />
<input type="hidden" id="pm_rec_name" />
<input type="hidden" id="pm_sender_id" />
<input type="hidden" id="pm_sender_name" />
<input type="hidden" id="pmWipit" />
<br />
<input name="replyBtn" type="button" onclick="javascript:processReply()" /> &nbsp;&nbsp;&nbsp; <span id="pmFormProcessGif"><img src="images/loading.gif" width="28" height="10" alt="Loading" /></span>
<div id="PMStatus" style="color:#F00; font-size:14px; font-weight:700;">&nbsp;</div>
</form>
</div>
<!-- End Hidden Container the holds the Reply Form -->     
<!-- Start PM Reply Final Message box showing user message status when needed -->    
 <div id="PMFinal" style="display:none; width:652px; background-color:#005900; border:#666 1px solid; top:51px; position:fixed; margin:auto; z-index:50; padding:40px; color:#FFF; font-size:16px;"></div>
 <!-- End PM Reply Final Message box showing user message status when needed --> 
</td></tr></table>
</div>
<!--------------Inbox Ends Here------------------>
<!---------------Compose Message Starts Here------>
<div id="view2">
        <center><h1>[ Compose Message ]</h1></center>
    </div>
 <!----------Compose Message Ends Here----------->
 <!-------Sent Box Starts Here----------------->
    <div id="view3">
      <table width="920" style="background-color:white;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="732" valign="top">
  <center><h1 style="margin-left:24px;">[ Messages You Sent ]</h1></center>
<!-- START THE PM FORM AND DISPLAY LIST -->
<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table width="94%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="3%" align="right" valign="bottom"><img src="images/crookedArrow.png" width="16" height="17" alt="Click Here to Delete" /></td>
            <td width="97%" valign="top"><input type="submit" name="deleteBtn" id="deleteBtn"  class="myButton" value="Delete"  />
              <span id="jsbox" style="display:none"></span>
            </td>
          </tr>
      </table>
        <table width="96%" border="0" align="center" cellpadding="4" style="  border: #999 1px solid;">
          <tr>
            <td width="4%" valign="top">
            <input name="toggleAll" id="toggleAll" type="checkbox" onclick="toggleChecks(document.myform.cb)" />
            </td>
            <td width="20%" valign="top">To</td>
            <td width="58%" valign="top"><span class="style2">Subject</span></td>
            <td width="18%" valign="top">Date</td>
          </tr>
        </table> 
<?php
///////////End take away///////////////////////
// SQL to gather their entire PM list
$sql = mysql_query("SELECT * FROM private_messages WHERE from_id='$my_id' AND senderDelete='0' ORDER BY id DESC LIMIT 100");

while($row = mysql_fetch_array($sql)){ 

    $date = strftime("%b %d, %Y",strtotime($row['time_sent']));
    $to_id = $row['to_id'];    
    // SQL - Collect username for Recipient 
    $ret = mysql_query("SELECT id, username FROM myMembers WHERE id='$to_id' LIMIT 1");
    while($raw = mysql_fetch_array($ret)){ $Rid = $raw['id']; $Rname = $raw['username']; }

?>
        <table width="96%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="4%" valign="top">
            <input type="checkbox" name="cb<?php echo $row['id']; ?>" id="cb" value="<?php echo $row['id']; ?>" />
            </td>
            <td width="20%" valign="top"><a href="mainlogin.php?id=<?php echo $Rid; ?>" style="text-decoration:none;" class="blue1"><?php echo $Rname; ?></a></td>
            <td width="58%" valign="top">
              <span class="toggle" style="padding:3px;">
              <a class="msgDefault" id="subj_line_<?php echo $row['id']; ?>" style="cursor:pointer;"><?php echo stripslashes($row['subject']); ?></a>
              </span>
              <div class="hiddenDiv"> <br />
                <?php echo stripslashes(wordwrap(nl2br($row['message']), 54, "\n", true)); ?>
                <br />
              </div>
           </td>
            <td width="18%" valign="top"><span style="font-size:12px;"><B><?php echo $date; ?></B></span></td>
          </tr>
        </table>
<hr style="margin-left:20px; margin-right:20px;" />
<?php
}// Close Main while loop
?>
<BR /><BR /><BR /><BR /><BR /><br /><br />
</form></td></tr></table>
    </div>
 <!--------------Sent Box Ends Here---------------->
</div>

<!------Message Body Ends Here----->
</td>
</tr>
</table>
<!---SideBar Navigation Bar Body Template Ends Here--->
<!---Footer Starts Here--->
<center><table>
<tr>
<td colspan="2" style="text-align:center;" width="100%">
<br>
<?php include_once "footertemplate.php"; ?>
<br>
</td>
</tr>
</table>
</center>
<!---Footer Ends Here----->
</table>
<!------Inner Table Ends----->
</td>
</tr>
</table>
<!---Outer Table Ends--->
</body>
</html>
 