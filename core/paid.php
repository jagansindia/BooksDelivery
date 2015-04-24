<?php
//April 8th 2015 - Pick List creation System
if(isset($_GET))
{
extract($_GET);
$username=$_GET['username'];
}
require_once("../include/db.php");
require_once("../include/functions.php");
//$query=mysqli_query($conn,"select * from seller_picklist where pickedby='$username' and picked='0'");//outstanding picking
$query=mysqli_query($conn,"SELECT pd.name as product_name,pr.model as author,pr.image,manuf.name as manufacturer_name,sp.quantity as pick_quantity,sp.total as pick_total,sp.discount as pick_discount, pr.price as mrp, sp.picked_time, sp.order_product_id, sp.order_id FROM seller_picklist sp LEFT JOIN product pr ON sp.product_id=pr.product_id JOIN product_description pd ON pr.product_id=pd.product_id  JOIN manufacturer manuf ON manuf.manufacturer_id=pr.manufacturer_id where sp.pickedby='$username' and sp.paid='1' and sp.picked='1'");
$count=mysqli_num_rows($query);
if($count>0)
{
	
	$row=array();
	while($object=mysqli_fetch_assoc($query))
	{
		$row[] = $object;
			
	}
//	print_r($row);
	echo '{"picklist":'.json_encode($row).'}';
}
else
{
	echo '0';
}
//SELECT emp_name, dept_name FROM Employee e JOIN Register r ON e.emp_id=r.emp_id JOIN Department d ON r.dept_id=d.dept_id;
?>



