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
	$type=$row["account_type"];
	$univ_id=$row["univ_id"];
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
//random password for messaging system
$password="Click Generate";
if(isset($_POST['generate']))
    {
           $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?';
           $string_shuffled = str_shuffle($string);
           $password = substr($string_shuffled, 1, 4);
		    $password = base64_encode($password);
		    $password = str_replace(' ', '-', $password); // Replaces all spaces with hyphens.
            $password = preg_replace('/[^A-Za-z0-9\-]/', '', $password);//Filters everything removes special charactres
          	 $query = mysql_query("UPDATE pms_users SET password='".$password."' WHERE id = '$id' ");
           	$qry_run = mysql_query($query);
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
<script type="text/javascript" src="js/jquery.min.js"></script><!--should be included at the top because of compiler-->
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

<body>
<div id="main">
	<div id="header"><?php include "headertemplate.php"; ?></div>
    <div id="sidebar_main_login"><?php include "sidebar.php"; ?>
    	<table cellspacing="0" cellpadding="0" style="border: 1px dashed #3B5999;margin-left: 0px;margin-top: 5px;margin-right: 0px;margin-bottom: 3px;"width="100%" height="3%"><tr><td> 
<center><table cellspacing="0" style="border:none;">
		<tr>
        	<td style="text-align:center"><b>My Messages Login Details</b></td></tr>
        	<tr><td style="text-align:center"><font color="#5784D7">Username:</font><font color="#00CC66"><?php echo"$univ_id" ?></font></td></tr>
           <form action="" method="post"> <tr><td style="text-align:center"><font color="#5784D7">Password:</font><font color="#FF0000"><?php echo"$password" ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
       </tr>
	   <tr>
       	<td style="text-align:center"><input type="submit" value="Generate" name="generate" class="myButton"></td></tr></form>
	</table></center>
	</td></tr>
	</table>
    
    </div>
    <div id="navbar"><?php include "navigationbar.php"; ?></div>
    <div id="content_main_login"><iframe src="pms/index.php" style="position:absolute;top:2px; border:none;" width="100%" height="595px"></iframe></div>
    <div id="footer_main_login"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>
