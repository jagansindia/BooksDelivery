<?php 
function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}

function createRandomPassword() {
$chars = "abcdefghijkmnopqrstuvwxyz023456789";
srand((double)microtime()*1000000);
$i = 0;
$pass = '' ;
   while ($i <= 7) {
     $num = rand() % 33;
     $tmp = substr($chars, $num, 1);
     $pass = $pass . $tmp;
     $i++;
    }
    return $pass;
}

function showstatus($data)
{
	if($data==1)
	{
		$data="Active";
	}
	else if($data==2)
	{
		$data="Deactivated";
	}
	else 	{
		$data="Inactive";
	}

return $data;	
}
function paidstatus($data)
{
	if($data==1)
	{
		$data="Paid";
	}
	else if($data==2)
	{
		$data="Paid - 2";
	}
	else 	{
		$data="Not Paid";
	}

return $data;	
}

//US date to database date conversion [13th Oct 2012]
function ustodbdate($data)
{
//MM/DD/YYYY to YYYY-MM-DD
$date=explode("/",$data);
$data=$date[2]."-".$date[0]."-".$date[1];
return $data;
}
//US date to database date conversion [13th Oct 2012]
function dbtoindate($data)
{
//YYYY-MM-DD to DD/MM/YYYY
$date=explode("-",$data);
$data=$date[2]."/".$date[1]."/".$date[0];
return $data;
}
//IN date to database date conversion [12th Nov 2013]
function intodbdate($data)
{
//DD/MM/YYYY to YYYY-MM-DD
$date=explode("/",$data);
$data=$date[2]."-".$date[1]."-".$date[0];
return $data;
}
//Find age using dob [06th August 2013]
function findage($data)
{
//date in YYYY-MM-DD format; or it can be in other formats as well
         //explode the date to get month, day and year
         $birthDate = explode("-", $data);
         //get age from date or birthdate
         $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
    return $age;
}

//booksdelivery seller app - 14th April 2015

function checkprice($product_id)
{
	include("db.php");
	$query=mysqli_query($conn,"select price from product where product_id='$product_id'");//Order valid status
	$row=mysqli_fetch_array($query);
	$data=$row['price'];
	return $data;
}

function checkdiscount($product_id,$username)
{
	include("db.php");
	$query=mysqli_query($conn,"select manufacturer_id from product where product_id='$product_id'");//Order valid status
	$row=mysqli_fetch_array($query);
	$manufacturer_id=$row['manufacturer_id'];
	$query=mysqli_query($conn,"select discount from seller_manufacturer_discount where manufacturer_id='$manufacturer_id' and seller_id='$username'");//Order valid status
	$row=mysqli_fetch_array($query);
	return $row['discount'];
}

?>