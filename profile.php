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
	/*$email = "<a href=\"mailto:$email\" class=\"blue1\" style=\"text-decoration:none;\">$email</a>";*/	
	$sign_up_date = $row["sign_up_date"];
    $sign_up_date = strftime("%b %d, %Y", strtotime($sign_up_date));
	$last_log_date = $row["last_log_date"];
    $last_log_date = strftime("%b %d, %Y", strtotime($last_log_date));	
	$bio_body = $row["bio_body"];	
	$website = $row["website"];
	$youtube = $row["youtube"];
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ------- IF WE ARE PARSING ANY DATA ------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------
// ------- PARSING PICTURE UPLOAD ---------
	
	// If a file is posted with the form
if(isset($_POST['updateBtn1'])){
	if ($_FILES['fileField']['tmp_name'] != "") { 
            $maxfilesize = 5120000; // 5120000 bytes equals 5mb
            if($_FILES['fileField']['size'] > $maxfilesize ) { 

                        $error_msg = '<font color="#FF0000">ERROR: Your image was too large, please try again.</font>';
                        unlink($_FILES['fileField']['tmp_name']); 

            } else if (!preg_match("/\.(gif|jpg|png)$/i", $_FILES['fileField']['name'] ) ) {

                        $error_msg = '<font color="#FF0000">ERROR: Your image was not one of the accepted formats, please try again.</font>';
                        unlink($_FILES['fileField']['tmp_name']); 

            } else { 
                        $newname = "image01.jpg";
                        $place_file = move_uploaded_file( $_FILES['fileField']['tmp_name'], "members/$id/".$newname);
            }
    } 
}
// ------- END PARSING PICTURE UPLOAD ---------
//------------------------------------------------------------------------------------------------------------------------
?>

<!-----Outer Table having basic Layout of the profile------>

<!-----profile------->
<div id="profile_pic">
	<table style="border:1px medium #3B5999;background-color:#3B5999;" width="94%" height="370px">
		<tr>
			<td>
				<font color="white">Picture</font>
			</td>
			<td align="right"><?php 
		   //Script to disable enable edit feature according to profiles
		   		if (isset($_SESSION['idx']) && $logOptions_id != $id) {
						print"";
			}
				elseif (isset($_SESSION['idx']) && $logOptions_id == $id) {
						print"<div align='right'><div class='rem_pic'><button class='white' id='edit_profile_pic'  style='text-decoration:none;'>[edit]</button> </div><div class='add_pic'><button class='white' id='edit_profile_pic'  style='text-decoration:none;'>[cancel]</button></div> </div>";
			}
				else{
						print"";
					}
			?></td>
		</tr>
		<tr>
			<td colspan="2" style="background-color:white;">
		<!----Profile Picture source----->
        <div class="add_pic">
        <br /><br /><br /><br /><br /><br />
        	<center><form action="" method="post" enctype="multipart/form-data">
        	<input type="file"  name="fileField" type="file"  id="fileField" class="textbox_edit"  accept="image/x-png, image/gif, image/jpeg ,image/x-ms-bmp"  />
            <input type="submit" class="myButton" name="updateBtn1"  id="updateBtn1"  value="Upload" />
            </form></center>
        <br /><br /><br /><br /><br /><br /><br /><br />
        </div>
				<div class="rem_pic"><?php  echo $user_pic; ?></div>
			</td>
		</tr>
	</table>
</div>
<!-------------Profile pic Ends here------------------>

<!------------Profile Menu Bar1------------------->
<div id="profile_options">
	<table style="border:1px solid;border-color:#3B5999;" width="94%">
		<tr><td border="1px"><a href="search.php" style="text-decoration:none;" class="blue1">&nbsp;Visualize your Classmates</a></td></tr>
    </table>
	<table style="border-left: 1px solid;border-top: 0px solid;border-right: 1px solid;border-bottom: 1px; solid;border-color:#3B5999;"width="94%">
 		 <tr><td><a href="#" style="text-decoration:none;" class="blue1">&nbsp;Edit my Profile</a></td></tr>
  	</table>
    <table style="border-left: 1px solid;border-top: 1px solid;border-right: 1px solid;border-bottom: 1px; solid;border-color:#3B5999;"width="94%">
    	 <tr><td><a href="#" style="text-decoration:none;" class="blue1">&nbsp;My Account Prefrences</a></td></tr>
    </table>
    <table style="border-left: 1px solid;border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid; border-color:#3B5999;" width="94%">
		 <tr><td><a href="#" style="text-decoration:none;" class="blue1">&nbsp;My Privacy Prefrences</a></td></tr>
   	</table>
 </div>
<!------------Profile Menu Bar1 Ends------------->

<!-----MaIN Profile Table2 Info starts---------------->
<div id="profile_details">
	<table cellspacing="0" align="right" width="98%"  style=" border:1px solid; border-color:#3B5999;">
		<tr><td width="40%" style="background-color:#3B5999;"><font color="white">&nbsp;<b>Information:</b></font></td>
        	<td width="40%" style="background-color:#3B5999;"></td>
            <td width="20%" style="background-color:#3B5999;">
           <?php 
		   //Script to disable enable edit feature according to profiles
		   		if (isset($_SESSION['idx']) && $logOptions_id != $id) {
						print"";
			}
				elseif (isset($_SESSION['idx']) && $logOptions_id == $id) {
						print"<div align='right'><div class='rem'><button class='white' id='edit_main' style='text-decoration:none;'>[edit]</button> </div><div class='add'><button class='white' id='edit_main' style='text-decoration:none;'>[cancel]</button></div></div>";
			}
				else{
						print"";
					}
			?>
             </td>
        </tr>
		<tr>
        <form method="post" action="">
        	<td  colspan="3" style="margin-left: 20px;margin-top: 20px;margin-right: 80px;margin-bottom: 0px;"><b>&nbsp;&nbsp;Account Info:</b></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Name:</td><td width="40%"><B><div class="rem"><?php print "$firstname $lastname" ?></div>
<div class="add"><input type="text"  required="required" autofocus="autofocus" class="textbox_edit" value="<?php print "$firstname $lastname" ?>" />
</div></B></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Batch:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text"  required="required" autofocus="autofocus" class="textbox_edit" value="" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Last Update:</td><td width="40%"><?php print "$last_log_date" ?></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;<b>Basic Info:</b></td><td width="40%"></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Email:</td><td width="40%"><font color="#5784D7"><div class="rem"><a href="mailto:<?php print "$email" ?>" class="blue1" style="text-decoration:none;"><?php print "$email" ?></a></div><div class="add"><input type="email" required="required" autofocus="autofocus" class="textbox_edit" value="<?php print "$email" ?>" />
</div></font></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Status:</td><td width="40%"><div class="rem">Hey you are on Coursemash!</div><div class="add"><input type="text" class="textbox_edit"  required="required" autofocus="autofocus" value="<?php print "Hey you are on Coursemash!" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Gender:</td><td width="40%"><font color="#5784D7"><div class="rem"><?php print "$gender" ?></div><div class="add"><input type="text"  required="required" autofocus="autofocus" class="textbox_edit" value="<?php print "$gender" ?>" />
</div></font></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;D.O.B:</td><td width="40%"><font color="#5784D7"><div class="rem"><?php print "$birthday"; ?></div><div class="add"><input type="date"  required="required" autofocus="autofocus" class="textbox_edit" value="<?php print "$birthday" ?>" />
</div></font></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Concenteration:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;High School:</td><td width="40%"><font color="#5784D7"><div class="rem"><?php print "$school"; ?></div><div class="add"><input type="text"   required="required" autofocus="autofocus" class="textbox_edit" value="<?php print "$school" ?>" />
</div></font></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;<b>Extended Info:</b></td><td width="40%"></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Screen Name:</td><td width="40%"><font color="#5784D7"><div class="rem"><?php print "$username" ?></div><div class="add"><input type="text"  required="required" autofocus="autofocus" class="textbox_edit" value="<?php print "$username" ?>" />
</div></font></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Looking For:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Interested In:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Hobbies:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
       	</tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Political Views:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
       	</tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Interests:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Favourite Quotation:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;&nbsp;Attendance Record:</td><td width="40%"><div class="rem"></div><div class="add"><input type="text" class="textbox_edit" value="<?php print "" ?>" />
</div></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;</td><td width="40%"><div class="add"><center><input type="submit" class="myButton" value="Update" /></center></td>
        </tr>
		<tr>
        	<td width="40%">&nbsp;</td><td width="40%"></td>
        </tr>
         </form>
	</table>
  
</div>
<!-----MaIN Profile Table2 Info ends---------------->

<!----profile ends here----------------->
