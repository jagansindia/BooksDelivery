<?php
$host="localhost";
//echo $_SERVER['HTTP_HOST'];
if($_SERVER['HTTP_HOST']=="booksdelivery.com")
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
?>