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

?>
<?php
function output_file($file, $name, $mime_type='')
{
if(!is_readable($file)) die('File not found or inaccessible!');

$size = filesize($file);
$name = rawurldecode($name);
$known_mime_types=array(
"pdf" => "application/pdf",
"txt" => "text/plain",
"html" => "text/html",
"htm" => "text/html",
"exe" => "application/octet-stream",
"zip" => "application/zip",
"doc" => "application/msword",
"xls" => "application/vnd.ms-excel",
"mp3" => "application/mp3",
"ppt" => "application/vnd.ms-powerpoint",
"gif" => "image/gif",
"png" => "image/png",
"jpeg"=> "image/jpg",
"jpg" => "image/jpg",
"php" => "text/plain"
);
if($mime_type==''){
$file_extension = strtolower(substr(strrchr($file,"."),1));
if(array_key_exists($file_extension, $known_mime_types)){
$mime_type=$known_mime_types[$file_extension];
} else {
$mime_type="application/force-download";
};
};

@ob_end_clean();


if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');
header('Content-Type: ' . $mime_type);
header('Content-Disposition: attachment; filename="'.$name.'"');
header("Content-Transfer-Encoding: binary");
header('Accept-Ranges: bytes');
header("Cache-control: private");
header('Pragma: private');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
if(isset($_SERVER['HTTP_RANGE']))
{
list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
list($range) = explode(",",$range,2);
list($range, $range_end) = explode("-", $range);
$range=intval($range);
if(!$range_end) {
$range_end=$size-1;
} else {
$range_end=intval($range_end);
}
$new_length = $range_end-$range+1;
header("HTTP/1.1 206 Partial Content");
header("Content-Length: $new_length");
header("Content-Range: bytes $range-$range_end/$size");
} else {
$new_length=$size;
header("Content-Length: ".$size);
}
$chunksize = 1*(1024*1024);
$bytes_send = 0;
if ($file = fopen($file, 'r'))
{
if(isset($_SERVER['HTTP_RANGE']))
fseek($file, $range);

while(!feof($file) &&
(!connection_aborted()) &&
($bytes_send<$new_length)
)
{
$buffer = fread($file, $chunksize);
print($buffer);
flush();
$bytes_send += strlen($buffer);
}
fclose($file);
} else

die('Error - can not open file.');
die();
}
set_time_limit(0);
$file_path='files/'.$branch.'/'.$_REQUEST['filename'];
output_file($file_path, ''.$_REQUEST['filename'].'', 'text/plain');
?>