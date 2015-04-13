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


//Get ID using the Unqidi - 9th August 2013
function getid($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select ID from user_login where uniqid='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['ID'];
	return $data;
	
}

//Cms to feet conversion - 9th August 2013
function getfeet($data) {
	$meters=($data/100);
    return floatval($meters) * 3.2808399;
}

//Choose right select box values - 17th August 2013
function getselectbox($data)
{
	switch ($data) {
    case "religion":
        $data=1;
        break;
    case "subcaste":
        $data=2;
        break;
    case "language":
        $data=3;
        break;
    case "education":
        $data=4;
        break;
    case "star":
        $data=5;
        break;
    case "rasi":
        $data=6;
        break;
    case "lagnam":
        $data=7;
        break;
    case "height":
        $data=8;
        break;
    case "country":
        $data=9;
        break;
	}
	return $data;
}

//Get system select category value - 17th August 2013
function getcategory($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select ID from select_category where category='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['ID'];
	return $data;
	
}
//Get system select category value - 17th August 2013
function showcategory($data)
{
	if(!$data==0)
	{
	include("db.php");
	$query=mysqli_query($conn,"select category from category where ID='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['category'];
	}
	else
	{
		$data="None";
	}
	return $data;
	
}
//Get system select category value - 17th August 2013
function showstore($data)
{
	if(!$data==0)
	{
	include("db.php");
	$query=mysqli_query($conn,"select store_name from store where ID='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['store_name'];
	}
	else
	{
		$data="None";
	}
	return $data;
	
}


//Get Profile ID function - 22nd August 2013
function getuserid()
{
include("db.php");
$query=mysqli_query($conn,"select userid from user_login order by ID DESC limit 1");
$count=mysqli_num_rows($query);
	if($count==0)
	{
		$data="VM10000";
	}
	else
	{
		$row=mysqli_fetch_array($query);
		$data=substr($row['userid'], 2);
		$data=$data+1;
		$data="VM".$data;
		
	}
return $data;
}

//Get profile few words - 22nd August 2013
function fewwords($data)
{
	switch ($data) {
    case "Self":
        $data="Myself";
        break;
    case "Son":
        $data="My Son";
        break;
    case "Daughter":
        $data="My Daughter";
        break;
    case "Brother":
        $data="My Brother";
        break;
    case "Sister":
        $data="My Sister";
        break;
    case "Relative":
        $data="My Relative";
        break;
    case "Friend":
        $data="My Friend";
        break;
	default:
		$data="Profile";
		break;	
	}
	return $data;	
}

//Get Uniqid using the user ID - 22nd August 2013
function getuniqid($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select uniqid from user_login where userid='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['uniqid'];
	return $data;
}

//Get Total Profile Views by uniqid - 12th September 2013
function gettotalviews($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select  SUM(views) AS totalviews from profile_views where uniqid='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['totalviews'];
	return $data;
}

//Get Daily Profile Views by uniqid - 12th September 2013
function getdailyviews($data)
{
	include("db.php");
	$date=date("Y-m-d");
	$query=mysqli_query($conn,"select  SUM(views) AS dailyviews from profile_views where uniqid='$data' and date='$date'");
	$row=mysqli_fetch_array($query);
	$data=$row['dailyviews'];
	return $data;
}

//Get Daily Profile Views by uniqid - 12th September 2013
function getonlineusers($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select  SUM(online) AS onlineusers from user_login where online='1'");
	$row=mysqli_fetch_array($query);
	$data=$row['onlineusers'];
	return $data;
}

//Update Profile Views by uniqid - 12th September 2013
function updateviews($data)
{
	include("db.php");
	$date=date("Y-m-d");
	$query=mysqli_query($conn,"select  * from profile_views where uniqid='$data' and date='$date'");
	$count=mysqli_num_rows($query);
	if($count==0)
	{
		$query=mysqli_query($conn,"insert into profile_views (uniqid,date,views) values('$data','$date','1')");
	}
	else
	{
		$row=mysqli_fetch_array($query);
		$views=$row['views']+1;
		$query=mysqli_query($conn,"update profile_views set views='$views' where uniqid='$data' and date='$date'");
	}
}

//Get User ID using uniqid - 14th September 2013
function getprofileid($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select userid from user_login where uniqid='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['userid'];
	return $data;
}

//Get User ID using uniqid - 14th September 2013
function getname($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select firstname from user_login where uniqid='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['firstname'];
	return $data;
}
//Get email ID using using uniqid - 14th September 2013
function getemail($data)
{
	include("db.php");
	$query=mysqli_query($conn,"select email from user_login where uniqid='$data'");
	$row=mysqli_fetch_array($query);
	$data=$row['email'];
	return $data;
}

//Log Every clicks and Request user on profile - 14th September 2013
function sendrequest($from,$to,$action)
{
/********************
User Track Actions Codes:
1. Request Photo
2. Request Phone
3. Request Horoscope
4. Express Intrest
5. Send Message
6. Send SMS
7. View Reference
8. View Phone Number
9. View Horoscope
*********************/
	include("db.php");
	$query=mysqli_query($conn,"insert user_track(`from`,`to`,`actions`) values('$from','$to','$action')");
	$fromuserid=getprofileid($from);	
	$profiletitle=profiletitle($from);
	$fromname=getname($from);
//Action codes
switch ($action) {
    case 1:
        $data="Photo Request from $fromname";
		$content="$profiletitle requested profile photo. Kindly upload your photo on profile to get more views";
        break;
    case 2:
        $data="Phone Number Request from $fromname";
		$content="$profiletitle requested your phone number. Kindly update your phone number so that they can contact you directly";
        break;
    case 3:
        $data="Horoscope Request from $fromname";
		$content="$profiletitle requested your Horoscope details. Kindly upload Horoscope under Upload section and help them to get more details on your profile";
        break;
    case 4:
        $data="$fromname Expressed Interest on Profile";
		$content="VannarMatri $profiletitle expressed Interest on You. Check out the $fromuserid profile by login into your VannarMatri.com account!";
        break;
    case 5:
        $data="$profiletitle sent you message";
		$content="$profiletitle sent you message on VannarMatri.com. Login into your account to view the message!";
        break;
    case 6:
        $data="$profiletitle sent you SMS";
		$content="$profiletitle sent you SMS";
        break;
    case 7:
        $data="$fromname viewed your profile reference";
		$content="Your profile reference has been accessed by $profiletitle!";
        break;
    case 8:
        $data="$fromname viewed your Phone Number";
		$content="$profiletitle viewed your profile phone number at VannarMatri.com. Thank You";
        break;
    case 9:
        $data="$fromname viewed your Horoscope";
		$content="$profiletitle viewed your profile Horoscope at VannarMatri.com. Thank You";
        break;
	}

	//Send Request Email
$name=getname($to);	
$to =getemail($to);
$subject = "$data";
$message = "<p>Hi $name,</p>\r\n";
$message.= "<br>\r\n";
$message.= "<p>$content</p>\r\n";
$message.= "<br>\r\n";
$message.= "<p>For any queries send mail to info@vannarmatri.com</p>\r\n";
$message.= "<br>\r\n";
$message.= "<p>Regards,</p>\r\n";
$message.= "<p>VannarMatri.com</p>\r\n";
$headers = "From: VannarMatri.com <noreply@vannarmatri.com> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to,$subject,$message,$headers);	

}

//Recalculate/Decrease credits based on view - 14th September 2013
function usercredits($from,$action)
{
	include("db.php");
	if($action=="phone")
	{
	$query=mysqli_query($conn,"select phone from user_credits where uniqid='$from'");
	$row=mysqli_fetch_array($query);
	$data=$row['phone']-1;
	$query=mysqli_query($conn,"update user_credits set phone='$data' where uniqid='$from'");
	}
	else if($action=="message")
	{
	$query=mysqli_query($conn,"select message from user_credits where uniqid='$from'");
	$row=mysqli_fetch_array($query);
	$data=$row['message']-1;
	$query=mysqli_query($conn,"update user_credits set message='$data' where uniqid='$from'");
	}
	else if($action=="sms")
	{
	$query=mysqli_query($conn,"select sms from user_credits where uniqid='$from'");
	$row=mysqli_fetch_array($query);
	$data=$row['sms']-1;
	$query=mysqli_query($conn,"update user_credits set sms='$data' where uniqid='$from'");
	}
}

//Check requests before making new one on profile - 14th September 2013
function checkrequest($from,$to,$action)
{
	include("db.php");
	$query=mysqli_query($conn,"select * from  user_track where `from`='$from' and `to`='$to' and `actions`='$action'");
	$count=mysqli_num_rows($query);
	if($count>0)
	{
		$data="yes";
	}
	else
	{
		$data="no";
	}
	return $data;
}

function profiletitle($data)
{
	include("db.php");
	$query=mysqli_query($conn,"SELECT * FROM user_login INNER JOIN user_details on user_login.uniqid = user_details.uniqid where user_login.uniqid='$data'");
	$row=mysqli_fetch_array($query);
	$data= $row['firstname']." (".$row['userid'].") " .$row['city'];
	return $data;
}
?>