<?php
include('includes/connect_to_mysql.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysql_query("select id,firstname,lastname,email from mymembers where firstname like '%$q%' or lastname like '%$q%' or email like '%$q%' order by id LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
$id=$row['id'];
$username=$row['firstname'];
/*ucfirst($username);*/
$email=$row['email'];
$lastname=$row['lastname'];
$b_username='<strong>'.$q.'</strong>';
$b_email='<strong>'.$q.'</strong>';
$b_lastname='<strong>'.$q.'</strong>';
$final_username = str_ireplace($q, $b_username, $username);
$final_email = str_ireplace($q, $b_email, $email);
$final_lastname = str_ireplace($q, $b_lastname, $lastname);
?>

<?php echo '<a  style=" color:black;text-decoration:none;" href="mainlogin.php?id='.$id.'" target="_blank">
<div class="show" align="left">
<img src="images/search.png" style="width:40px; height:40px; float:left; margin-right:6px;" /><span class="name"  style="{color:#3C5A9A}">'.$final_username.' '.$final_lastname.'</span>&nbsp;<br/>'.$final_email.'<br/>
</div></a>'?>
<?php
}
}
?>
