<?php
//April 6th 2015 - Login Authenication System
session_start();
if(isset($_POST))
{
extract($_POST);
require_once("../include/db.php");
require_once("../include/functions.php");
$username=xss_clean(stripslashes($username));
$password=xss_clean(stripslashes($password));
$query=mysqli_query($conn,"select * from user where username='$username'");
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
	if($count==1)
	{
		$salt=$row['salt'];
		$password=(sha1($salt . sha1($salt . sha1($password))));
		$query=mysqli_query($conn,"select * from user where username='$username' and password='$password'");
		$count1=mysqli_num_rows($query);
		if($count1==1)
		{
		$row=mysqli_fetch_array($query);
		$_SESSION['user_id']=$row['user_id'];
		$_SESSION['user_group_id']=$row['user_group_id'];
		$_SESSION['username']=$row['username'];
			echo "yes";
		}
		else
		{
		echo "<p class='card-panel teal lighten-2'>Username or Password Wrong!</p>";
		}
	}
	else
	{
	echo "<p class='card-panel teal lighten-2'>No matching username found!</p>";
	}
}
?>