<?php session_start();
	$valid = $_SESSION['rollno'];
	//Connecting to the database
//Connecting to the database
include_once "connect_to_mysql.php";
//query member details
$result = mysql_query("SELECT * FROM details WHERE rollno='$valid'");
while($row = mysql_fetch_array($result)){ 
$year=$row['year'];

}
	?>
<?php include('progressbarheader.php') ?> 

<body>
<div class="container">
<br>
<br>
<br>
<br>
<br>
<br>
  <div class="span12">
   <script type="text/javascript">
	$(document).ready(function()
		{
		 var delay = 2000;
		setTimeout(function(){ window.location = '<?php echo"$year/$valid.pdf" ?>';}, delay);  
    });
	
	

</script>
            <section id="h-default">
              
                <div class="row-fluid">
                   
               
              
						<h2>Loading.....</h2>
                        <div id="prog" class="progress progress-info progress-striped">
                            <div class="bar text-filled-1" data-amount-part="1337" data-amount-total="9000" data-percentage="100"></div>
                        </div>
						
		
             
                </div>
            </section>
            
        </div>
		</div>
		</body>