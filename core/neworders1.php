<?php
//April 8th 2015 - Pick List creation System
require_once("../include/db.php");
require_once("../include/functions.php");
$query=mysqli_query($conn,"select order_id from `order` where order_status_id='2'");//processsing status orders
//echo $query;
$row=mysqli_fetch_array($query);
echo "Single".$row['order_id'];
$count=mysqli_num_rows($query);
if($count>0)
{
	//fetch object
	//echo "Fetch Object: ";
	
	//$row=array();
	while($object=mysqli_fetch_array($query))
	{
		//$row[] = $object;	
		echo "ID: ".$object['order_id']."<br>";
		
	}
	$row=mysqli_fetch_row($query);
	//echo "whID: ".$row['order_id'];
	
	//echo '{"orders":'.json_encode($row).'}';
}
else
{
	echo '0';
}
?>