<?php
//April 14th 2015 - Pick List creation System
if(isset($_GET))
{
extract($_GET);
$username=$_GET['username'];
$order_id=$_GET['orderid'];
$picktime=date("Y-m-d H:i:s");

//db connection
require_once("../include/db.php");
require_once("../include/functions.php");

//update picker name
$query=mysqli_query($conn,"select * from `order` where order_id='$order_id' and order_status_id='2'");//Order valid status
$count=mysqli_num_rows($query);
  if($count==1)
  {
	  //Assign order to Picker
	  $query1=mysqli_query($conn,"update `order` set order_status_id='17', username='$username', order_picked_time='$picktime' where order_id='$order_id'");
	  //Create Product pick list for the user
	  $query2=mysqli_query($conn,"select * from `order_product` where order_id='$order_id'");//Order valid status
	  while($row=mysqli_fetch_array($query2))
	  {
		  $order_product_id=$row['order_product_id'];
		  $product_id=$row['product_id'];
		  $quantity=$row['quantity'];
		  $price=checkprice($product_id); //Get MRP of the product
		  $discount=checkdiscount($product_id,$username); //Get discount percentage for the supplier/seller
		  $total=($price-($price*($discount/100)))*$quantity;
		  //Insert into pick list db
		  $query3=mysqli_query($conn,"insert into `seller_picklist` 
		  (`order_product_id`, `order_id`, `product_id`, `price`, `quantity`, `discount`, `total`, `pickedby`)
		  values('$order_product_id','$order_id','$product_id','$price','$quantity','$discount','$total','$username')");
	  }
  }
  

  
  
}
