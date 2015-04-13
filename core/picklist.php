<?php
//April 8th 2015 - Pick List creation System
if(isset($_GET))
{
extract($_GET);
$username=$_GET['username'];
}
require_once("../include/db.php");
require_once("../include/functions.php");
$query=mysqli_query($conn,"select * from seller_picklist where pickedby='$username' and picked='0'");//outstanding picking
$count=mysqli_num_rows($query);
if($count>0)
{
	$row=array();
	while($object=mysqli_fetch_assoc($query))
	{
		$row[] = $object;	
	}
	echo '{"picklist":'.json_encode($row).'}';
}
?>