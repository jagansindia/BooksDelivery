<?php
//April 22nd 2015 - Product Picked Module
require_once("../include/db.php");
require_once("../include/functions.php");
$order_product_id=$_GET['order_product_id'];
$pickedtime=date("Y-m-d H:i:s");
$query=mysqli_query($conn,"UPDATE seller_picklist set picked='1',picked_time='$pickedtime' where order_product_id='$order_product_id'");//update picked in pick list table
$query1=mysqli_query($conn,"UPDATE order_product set packed='1' where order_product_id='$order_product_id'");//update packed in core table
?>