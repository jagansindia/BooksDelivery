<?php
//April 8th 2015 - Pick List creation System
session_start();
if(isset($_GET))
{
extract($_GET);
$username=$_GET['username'];
}
require_once("../include/db.php");
require_once("../include/functions.php");



?>
    <div id="test1" class="col s12 no-padding"> <ul class="collection ">
    <?php 
$query=mysqli_query($conn,"select * from seller_picklist where pickedby='$username' and picked='0'");//outstanding picking
$count=mysqli_num_rows($query);
if($count>0)
{
while($row=mysqli_fetch_array($query))
{
	
$query1=mysqli_query($conn,"select * from seller_picklist where pickedby='$username' and picked='0'");

?> 
    
    <li class="collection-item avatar">
      <img src="images/yuna.jpg" alt="" class="circle">
      <span class="title">Title</span>
      <p>First Line <br>
         Second Line
      </p>
      <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
    </li>
<?php 
}
}
else
{
?>
    <li class="collection-item avatar">
No outstanding to Pick! Good Job!</i></a>
    </li>

<?php
}
?>
  </ul></div>
 
    <div id="test2" class="col s12 no-padding"><ul class="collection">
    <?php 
$query1=mysqli_query($conn,"select * from `order` where order_status_id='2'");//processsing status orders
$count1=mysqli_num_rows($query1);
if($count1>0)
{
while($row1=mysqli_fetch_array($query1))
{

?> 
        <a href="#!" class="collection-item"> Order <?php echo $row1['order_id']; ?><span class="badge">Pick</span></a>
<?php
}
}
else
{
?>
        <a href="#!" class="collection-item">No new orders!</a>

<?php
}
?>
      </ul>
      </div>
