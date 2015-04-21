<?php
//April 8th 2015 - Pick List creation System
require_once("../include/db.php");
require_once("../include/functions.php");
$query=mysqli_query($conn,"select order_id from `order` where order_status_id='2'");//processsing status orders
$count=mysqli_num_rows($query);
if($count>0)
{
	$row=array();
	while($object=mysqli_fetch_assoc($query))
	{
		$row[] = $object;	
	}
	echo '{"orders":'.json_encode($row).'}';
}
else
{
	echo '0';
}
?>