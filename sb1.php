<?php
/*
-
-
------------------------------This Script Is Made By Sagunesh Grover-----------------
-
-
-
*/
?>

<!-----------------------------Search Bar  Starts Here------------------------------->
<table cellspacing="0" cellpadding="0" style="border: 1px dashed #3B5999;margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 3px;"width="100%" height="3%"><tr><td> 
<center><table cellspacing="0" style="border:none;"><tr><td colspan="2"><input autocomplete="off" class="search" id="searchid" placeholder="Search for classmates" name="text" type="text"  style="font-family: Verdana; font-weight: bold; font-size: 12px; background-color:#D8DEEA;width:95%;border-color:#000000; border-width:1px;" /><div id="result">
</div>
</td></tr>
<tr><td><b>quick search</b></td><td><input type="submit" value="go" name="searchbtn3" class="myButton"></td></tr>
</table></center>
</td></tr></table>
<!---------------------------Search Bar Ends Here------------------------------------->
<!---------------------------Navigation Menu Starts Here------------------------------->
<table cellspacing="0" cellpadding="0" style="border: 1px dashed #3B5999;" width="100%" height="3%"><tr><td>

   <center><table cellspacing="0"><tr><td><a href="mainlogin.php"style="text-decoration: none"class="blue1">My Profile</a>&nbsp;&nbsp;&nbsp;<a href="#"style="text-decoration: none"class="blue1">[edit]</a></td></tr>
<tr><td><a href="pm_inbox.php"style="text-decoration: none"class="blue1">My Messages</a>&nbsp;</td></tr>
<tr><td><a href="info.php"style="text-decoration: none"class="blue1">MyInfo</a></td></tr>
<tr><td><a href="account.php"style="text-decoration: none"class="blue1">My account</a></td></tr>
<?php if($type=='a'){
			
				echo "<tr><td><a href='teacher.php'style='text-decoration: none' class='blue1'>Teacher Pannel</a></td></tr>";
				echo "<tr><td><a href='#'style='text-decoration: none' class='blue1'>Admin Panel</a></td></tr>";
				}
				elseif($type=='b'){
					echo "<tr><td><a href='teacher.php'style='text-decoration: none' class='blue1'>Teacher Pannel</a></td></tr>";
				}
				
			?>
<tr><td><a href="logout.php"style="text-decoration: none"class="blue1">Logout</a></td></tr>
</table></center>


</td>
</tr>
</table>
<!----------------------Navigation Menu Ends Here------------------------------------->