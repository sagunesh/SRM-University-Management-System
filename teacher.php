<!----This Script is created by Sagunesh Grover---->
<?php
/*
----------This Script is created by Sagunesh Grover----------*/
//Preventing resubmission of form data by cache clearing
	
?>
<?php
 //connecting to the database
 include "includes/connect_to_mysql.php"; 
 include_once("includes/checkuserlog.php");
?>
 <?php 
// Now let's initialize vars to be printed to page in the HTML section so our script does not return errors 
// they must be initialized in some server environments
$teacher_error="";
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
	///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "members/$id/image01.jpg";//permission of 0 folder to be set on 755 for security reasons in future
	$default_pic = "members/0/image01.jpg";
	if (file_exists($check_pic)) {
    $user_pic = "<img src=\"$check_pic\" width=\"94% \" style=\"padding:8px;\" height=\"340px \" >"; // forces picture to be propotionally wide 
	} else {
	$user_pic = "<img src=\"$default_pic\" width=\"94%\"  style=\"padding:8px;\" height=\"340px\" />";// forces dflt picture to be propotionally wide
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*------parsing teacher menu-------*/
$teach_error='';
if (isset($_POST['teacher_btn'])!="") {		
//CHECKBOX CSE
	if (isset($_POST['Btech(CSE)'])) {
		$cse = $_POST['Btech(CSE)'];

			if ($cse == 'Btech(CSE)') {
				

				$name=$_FILES['photo']['name'];
  				$size=$_FILES['photo']['size'];
 				 $type=$_FILES['photo']['type'];
 				 $temp=$_FILES['photo']['tmp_name'];
             	 move_uploaded_file($temp,"files/Btech(CSE)/".$name);
				 $teacher_subject=$_POST['teacher_subject'];
				 $teacher_name="$firstname $middlename $lastname";
				 $teacher_message=$_POST['teacher_message'];
				 $mysqldate = date( 'Y-m-d H:i:s');
				 $message_date=strtotime( $mysqldate );
				 $insert=mysql_query("insert into upload(name,branch,subject,teacher_name,message,message_date)values('$name','$cse','$teacher_subject','$teacher_name','$teacher_message',$message_date)");
						if($insert){
							
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:green;'>
							Successfully uploaded to CSE students database
                			</td>";
								   }
						else{
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:red;'>
							Error 404 Try Again
                			</td>";
							}
				 
		
					}
}
//CHECKBOX EEE

		if (isset($_POST['Btech(EEE)'])) {
		$eee = $_POST['Btech(EEE)'];

			if ($eee == 'Btech(EEE)') {

				$name=$_FILES['photo']['name'];
  				$size=$_FILES['photo']['size'];
 				 $type=$_FILES['photo']['type'];
 				 $temp=$_FILES['photo']['tmp_name'];
				 $teacher_subject=$_POST['teacher_subject'];
				 $teacher_name="$firstname $middlename $lastname";
				 $teacher_message=$_POST['teacher_message'];
				 $mysqldate = date( 'Y-m-d H:i:s');
				 $message_date=strtotime( $mysqldate );
             	 move_uploaded_file($temp,"files/Btech(EEE)/".$name);
				 $insert=mysql_query("insert into upload(name,branch,subject,teacher_name,message,message_date)values('$name','$eee','$teacher_subject','$teacher_name','$teacher_message','$message_date')");
						if($insert){
						$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:green;'>
						Successfully uploaded to EEE students database
                			</td>";
								   }
						else{
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:red;'>
							Error 404 Try Again
                			</td>";
							}
   				}
 }
//CHECKBOX ECE

	if (isset($_POST['Btech(ECE)'])) {
		$ece = $_POST['Btech(ECE)'];

			if ($ece == 'Btech(ECE)') {

				$name=$_FILES['photo']['name'];
  				$size=$_FILES['photo']['size'];
 				 $type=$_FILES['photo']['type'];
 				 $temp=$_FILES['photo']['tmp_name'];$teacher_subject=$_POST['teacher_subject'];
				 $teacher_name="$firstname $middlename $lastname";
				 $teacher_message=$_POST['teacher_message'];
				 $mysqldate = date( 'Y-m-d H:i:s');
				 $message_date=strtotime( $mysqldate );
             	 move_uploaded_file($temp,"files/Btech(ECE)/".$name);
				 $insert=mysql_query("insert into upload(name,branch,subject,teacher_name,message,message_date)values('$name','$ece','$teacher_subject','$teacher_name','$teacher_message','$message_date')");
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:green;'>
							Successfully uploaded to ECE students database
                			</td>";
								   }
						else{
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:red;'>
							Error 404 Try Again
                			</td>";
							}
      			}
 }
//CHECKBOX ME

	if (isset($_POST['Btech(ME)'])) {
		$me = $_POST['Btech(ME)'];

			if ($me == 'Btech(ME)') {
				$name=$_FILES['photo']['name'];
  				$size=$_FILES['photo']['size'];
 				 $type=$_FILES['photo']['type'];
 				 $temp=$_FILES['photo']['tmp_name'];
             	 $teacher_subject=$_POST['teacher_subject'];
				 $teacher_name="$firstname $middlename $lastname";
				 $teacher_message=$_POST['teacher_message'];
				 $mysqldate = date( 'Y-m-d H:i:s');
				 $message_date=strtotime( $mysqldate );
             	 move_uploaded_file($temp,"files/Btech(ME)/".$name);
				 $insert=mysql_query("insert into upload(name,branch,subject,teacher_name,message,message_date)values('$name','$me','$teacher_subject','$teacher_name','$teacher_message','$message_date')");
						if($insert){
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:green;'>
							Successfully uploaded to ME students database
                			</td>";
								   }
						else{
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:red;'>
							Error 404 Try Again
                			</td>";
							}
    			}
				//CHECKBOX BBA

	if (isset($_POST['bba'])) {
		$me = $_POST['bba'];

			if ($bba == 'bba') {
				$name=$_FILES['photo']['name'];
  				$size=$_FILES['photo']['size'];
 				 $type=$_FILES['photo']['type'];
 				 $temp=$_FILES['photo']['tmp_name'];
             	 $teacher_subject=$_POST['teacher_subject'];
				 $teacher_name="$firstname $middlename $lastname";
				 $teacher_message=$_POST['teacher_message'];
				 $mysqldate = date( 'Y-m-d H:i:s');
				 $message_date=strtotime( $mysqldate );
             	 move_uploaded_file($temp,"files/bba/".$name);
				 $insert=mysql_query("insert into upload(name,branch,subject,teacher_name,message,message_date)values('$name','$bba','$teacher_subject','$teacher_name','$teacher_message','$message_date')");
						if($insert){
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:green;'>
							Successfully uploaded to BBA/MBA students database
                			</td>";
								   }
						else{
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:red;'>
							Error 404 Try Again
                			</td>";
							}
    			}
	}
//posting in all the databases and folders				
	if (isset($_POST['Btech(CSE)'])&&($_POST['Btech(ECE)'])&&($_POST['Btech(EEE)'])&&($_POST['Btech(ME)'])) {
		$all = $_POST['Btech(CSE)']&&$_POST['Btech(ECE)']&&$_POST['Btech(EEE)']&&$_POST['Btech(ME)'];

			if ($all == 'Btech(CSE)'&& $all == 'Btech(EEE)'&&$all == 'Btech(ECE)'&&$all == 'Btech(ME)') {
				$name=$_FILES['photo']['name'];
  				$size=$_FILES['photo']['size'];
 				 $type=$_FILES['photo']['type'];
 				 $temp=$_FILES['photo']['tmp_name'];
             	 $teacher_subject=$_POST['teacher_subject'];
				 $teacher_name="$firstname $middlename $lastname";
				 $teacher_message=$_POST['teacher_message'];
				 $message_date="$last_log_date";
             	 move_uploaded_file($temp,"files/Btech(CSE)/".$name);
				  $file = "files/Btech(CSE)/".$name;
				$newfile = "files/Btech(EEE)/".$name;
				$newfile1 = "files/Btech(ECE)/".$name;
				$newfile2 = "files/Btech(ME)/".$name;
				copy($file, $newfile);
				copy($file, $newfile1);
				copy($file, $newfile2);
				 $insert=mysql_query("insert into upload(name,branch,subject,teacher_name,message,message_date)values('$name','$all','$teacher_subject','$teacher_name','$teacher_message','$message_date')");
						if($insert){
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:green;'>
							Successfully uploaded to engineering  database
                			</td>";
								   }
						else{
							$teach_error=" <td style='border:1px solid;width:300px;position:absolute;left:400px;color:red;'>
							Error 404 Try Again
                			</td>";
							}
    			}
	}
				
}//if isset ends here teacher_btn

	
	



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
$(document).ready(function(){
  $("button#edit_main").click(function(){
    $(".add").fadeToggle(0000);
	$(".rem").fadeToggle(0000);
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("button#edit_profile_pic").click(function(){
    	$(".add_pic").fadeToggle(0000);
		$(".rem_pic").fadeToggle(0000);
    });
});
</script>
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
<!-----Tabs Panel System using AJAX---->
<link href="style/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="js/tabcontent.js" type="text/javascript"></script>

</head>
<body>
<div id="main">
	<div id="header"><?php include "headertemplate.php"; ?></div>
    <div id="sidebar_main_login"><?php include "sidebar.php"; ?></div>
    <div id="navbar"><?php include "navigationbar.php"; ?></div>
    <div id="content_main_login"><?php include"teacherpanel.php"; ?></div>
    <div id="footer_main_login"><?php include "footertemplate.php"; ?></div>
</div>
</body>
</html>

