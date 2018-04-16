

<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login System</title>
<link type="text/css" rel="stylesheet" href="css/ui.css">
</head>

<body class="bg_body">
<form action="verify.php"  method="post" name="contact_form">
<center>
<img src="images/Logo.png" alt="">
<h1>SRM University Haryana</h1>
	</center>
	
	<fieldset class="login_form_field">
    	<!--<legend class="login_form_legend" align="center">
		
		<center>Student Login</center></legend>-->
		
		<h3><center>Student Login</center></h3>
             <table cellspacing="0" cellpadding="0" class="login_form_table" style="height: auto;">
            	
                <center>
                <tr>
                    <td  align="left" style="vertical-align: top;"><input id="accountname" name="rollno" tabindex="1" spellcheck="false" autocorrect="off" autocapitalize="off" type="text" value="" size="30" maxlength="128" placeholder="Examination Roll no."></td>
                </tr>
               
                
                <tr><td><br/></td></tr>
                <tr> <!--<td  align="center" style="vertical-align: top;">
               <a class="button_large_grey"  href="#"><span>Register</span></a></td>-->
               <td align="center"><input  type="submit" class="button large blue signin-button" id="submitButton2" value="Submit" title="Sign In" tabindex="3">&nbsp;<input  type="reset" class="button_large_grey" id="submitButton2" value="Reset"  tabindex="3">
               
                </td></tr>
                </center>
                
       	 	</table>
  </fieldset>

</form>
</body>
</html>
