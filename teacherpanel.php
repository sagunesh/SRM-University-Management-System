 <?php
 //preventing unauthorized acesss -____-
 if($type=="c"){
			header('Location:mainlogin.php');
 }
  ?>
 
 <!------Teacher Body Starts Here--->
<!--------Inner Teacher DIV-------->
<!----- Tabs Start Here-------->
    
<ul class="tabs">
    <li><a href="#view1">BTech</a></li>
    <li><a href="#view2">BBA/MBA</a></li>
    <li><a href="#view3">BCom</a></li>
</ul>
<!-------------Btech Tab Starts Here-------------------------->
<div class="tabcontents">

<!---View 1 Starts here---->
    <div id="view1">
     <h1 style="margin-left:24px;"><center>[ Upload Notes ]</center></h2><br>
     	<div id="teacher_msg_container">
        <form enctype="multipart/form-data" method="post" action="">
        	<div id="teacher_checkbox_container">
           	 	<table border="0" cellpadding="0" cellspacing="5">
                	<tr>
                    	<td>
                        <input type="checkbox" name="Btech(CSE)"  value="Btech(CSE)" /><b>BTech(CSE)</b>
                        </td>
                        <td>
                        <input type="checkbox" name="Btech(ECE)" value="Btech(ECE)" /><b>BTech(ECE)</b>
                        </td>
                        <td>
                        <input type="checkbox" name="Btech(EEE)" value="Btech(EEE)" /><b>BTech(EEE)</b>
                        </td>
                        <td>
                        <input type="checkbox"name="Btech(ME)"  value="Btech(ME)" /><b>BTech(ME)</b>
                        </td>
              
                    </tr>
            	</table>
                <table align="right" style="position:absolute; top:5px; right:5px;">
                	<tr> 
                    	<td>
                        <input type="textbox" name="teacher_subject" required="required" placeholder="Subject" class="textbox_edit"/>
                        </td>
                    </tr>
                </table>
        	</div>
            <div id="teacher_textarea_container">
            	<textarea placeholder="Type Your Message Here" name="teacher_message" required="required" style="border-bottom-color:#000;width:99.4%;height:320px;font-size:18px;font-weight:bold;"> 
                </textarea>
                <table border="0" cellpadding="0" cellspacing="8">
                	<tr>
                		<td>
                			<input type="file" name="photo" id="photo" required="required"     class="textbox_edit"  accept="application/pdf,text/plain,text/html,application/x-zip-compressed,application/msword,application/msexcel,application/vnd.ms-powerpoint,.pptx,
                image/x-png, image/gif, image/jpeg ,image/x-ms-bmp"  />
               		 </td>
                    <?php echo $teach_error ?>
                     <td align="right" style="position:absolute;right:5px;"> <input name="teacher_btn" type="submit" class="myButton"  value="Upload" />
                     </td>
                	</tr>
                </table>
        	</div>
         </form>   
        </div>
    </div><!----/View 1 finished---->
    <!---View 2 starting---->
     <div id="view2">
      <h1 style="margin-left:24px;"><center>[ Upload Notes ]</center></h2><br>
     	<div id="teacher_msg_container">
        <form enctype="multipart/form-data" method="post" action="">
        	<div id="teacher_checkbox_container">
           	 	<table border="0" cellpadding="0" cellspacing="5">
                	<tr>
                    	<td>
                        <input type="checkbox" name="bba"  value="bba" /><b>BBA/MBA</b>
                        </td>
                    </tr>
            	</table>
                <table align="right" style="position:absolute; top:5px; right:5px;">
                	<tr> 
                    	<td>
                        <input type="textbox" name="teacher_subject" required="required" placeholder="Subject" class="textbox_edit"/>
                        </td>
                    </tr>
                </table>
        	</div>
            <div id="teacher_textarea_container">
            	<textarea placeholder="Type Your Message Here" name="teacher_message" required="required" style="border-bottom-color:#000;width:99.4%;height:320px;font-size:18px;font-weight:bold;"> 
                </textarea>
                <table border="0" cellpadding="0" cellspacing="8">
                	<tr>
                		<td>
                			<input type="file" name="photo" id="photo" required="required"     class="textbox_edit"  accept="application/pdf,text/plain,text/html,application/x-zip-compressed,application/msword,application/msexcel,application/vnd.ms-powerpoint,.pptx,
                image/x-png, image/gif, image/jpeg ,image/x-ms-bmp"  />
               		 </td>
                    <?php echo $teach_error ?>
                     <td align="right" style="position:absolute;right:5px;"> <input name="teacher_btn" type="submit" class="myButton"  value="Upload" />
                     </td>
                	</tr>
                </table>
        	</div>
         </form>   
        </div>
    </div> <!---/View 2 Ends here---->
    <!---View3 Starts Here-->
    <div id="view3">
     <h1 style="margin-left:24px;"><center>[ Upload Notes ]</center></h2><br>
     	<div id="teacher_msg_container">
        <form enctype="multipart/form-data" method="post" action="">
        	<div id="teacher_checkbox_container">
           	 	<table border="0" cellpadding="0" cellspacing="5">
                	<tr>
                    	<td>
                        <input type="checkbox" name="bcom"  value="bcom" /><b>B.Com</b>
                        </td>
                    </tr>
            	</table>
                <table align="right" style="position:absolute; top:5px; right:5px;">
                	<tr> 
                    	<td>
                        <input type="textbox" name="teacher_subject" required="required" placeholder="Subject" class="textbox_edit"/>
                        </td>
                    </tr>
                </table>
        	</div>
            <div id="teacher_textarea_container">
            	<textarea placeholder="Type Your Message Here" name="teacher_message" required="required" style="border-bottom-color:#000;width:99.4%;height:320px;font-size:18px;font-weight:bold;"> 
                </textarea>
                <table border="0" cellpadding="0" cellspacing="8">
                	<tr>
                		<td>
                			<input type="file" name="photo" id="photo" required="required"     class="textbox_edit"  accept="application/pdf,text/plain,text/html,application/x-zip-compressed,application/msword,application/msexcel,application/vnd.ms-powerpoint,.pptx,
                image/x-png, image/gif, image/jpeg ,image/x-ms-bmp"  />
               		 </td>
                    <?php echo $teach_error ?>
                     <td align="right" style="position:absolute;right:5px;"> <input name="teacher_btn" type="submit" class="myButton"  value="Upload" />
                     </td>
                	</tr>
                </table>
        	</div>
         </form>   
        </div>
    </div><!---/View 3 Ends here---->
</div><!-------------/Btech Tab Ends Here-------------------------->