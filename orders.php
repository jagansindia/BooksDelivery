<html>
<head>
<style>
.CSSTableGenerator {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #3f7f00;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	background-color:#d4ffaa;
		

}
.CSSTableGenerator td{
	vertical-align:middle;
	
	background-color:#ffffff;

	border:1px solid #3f7f00;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	/*font-size:10px;*/
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #5fbf00 5%, #3f7f00 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5fbf00), color-stop(1, #3f7f00) );
	background:-moz-linear-gradient( center top, #5fbf00 5%, #3f7f00 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5fbf00", endColorstr="#3f7f00");	background: -o-linear-gradient(top,#5fbf00,3f7f00);

	background-color:#5fbf00;
	border:0px solid #3f7f00;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #5fbf00 5%, #3f7f00 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5fbf00), color-stop(1, #3f7f00) );
	background:-moz-linear-gradient( center top, #5fbf00 5%, #3f7f00 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5fbf00", endColorstr="#3f7f00");	background: -o-linear-gradient(top,#5fbf00,3f7f00);

	background-color:#5fbf00;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>

</head>

<body>
<div class="CSSTableGenerator" >
                <table >
                    <tr>
                        <td>
                            Outstanding Orders to be picked by sellers
                        </td>

                    </tr>
                    
              
<?php

$host="localhost";
//echo $_SERVER['HTTP_HOST'];
if($_SERVER['HTTP_HOST']=="seller.booksdelivery.com")
{
$dbusername="booksdel_estore"; //database username
$dbpassword="472s!PH@SV"; //database password
$dbname="booksdel_estore"; //database name
}
else
{
$dbusername="root"; //database username
$dbpassword=""; //database password
$dbname="booksdelivery"; //database name
}
$conn = mysqli_connect($host,$dbusername,$dbpassword,$dbname) or die("wrong username database");
//$database= mysqli_select_db($dbname) or ("cannot select database");

/*
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'booksdel_estore');
define('DB_PASSWORD', '472s!PH@SV');
define('DB_DATABASE', 'booksdel_estore');
define('DB_PREFIX', '');
*/



$query=mysqli_query($conn,"select * from `order` where order_status_id='1' or order_status_id='2'");
?>


<?php
while($row=mysqli_fetch_array($query))
{
	$orderid=$row['order_id'];
	$query1=mysqli_query($conn,"select * from `order_product` where order_id='$orderid'");

	while($row1=mysqli_fetch_array($query1))
	{
	?>
	<tr>
	<td>
	<?php 	echo "Order ID: ".$row1['order_id']." - PID: ".$row1['order_product_id']." - ".$row1['name']." by ".$row1['model']."<br>"; ?>
	</td>
	</tr>
	<?php
	}
	?>
	
<?php	

}

?>

  </table>
            </div>
</body>
</html>            
            