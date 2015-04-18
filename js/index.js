// JavaScript Document - 13th April 2015
var serviceurl="http://booksdelivery.com/seller/";

//$(document).ready(function(){
	
	if(window.localStorage["username"] == undefined)
{
	window.location = "login.html";
}
else
{
	var username = window.localStorage["username"];
	//alert(username);
	$('.iavatar').html(username);
	
//picking list
	$.post( serviceurl+"core/picklist.php?username="+username,
				function(data){
						//alert("Username or Password Wrong!");
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Good Job! No oustanding Pick!</a></ul>');	
						}
						else
						{
						$(".msg").html(data).fadeIn("slow");
						}
				})
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })

//new order list
var orders;
	$.getJSON( serviceurl+"core/neworders.php",
				function(data){
						//alert("Username or Password Wrong!");
						if(!data)
						{
						$("#test2").html('<ul class="collection"><a href="#!" class="collection-item  center-align">No New orders!</a></ul>');	
						}
						else
						{
$.each(data.orders, function(i,order){
$('#neworders').append('	<li class="collection-item"><div> Order '+ order.order_id +'<a href="#" id="'+ order.order_id +'" class="secondary-content" onclick="pickclick('+ order.order_id +')">Pick <i class="mdi-content-send"></i></a></div></li>');
/*$('#neworders').append('<a href="#!" class="collection-item"> Order '+ order.order_id +'<span class="badge pickclick" id="'+ order.order_id +'">Pick</span></a>');*/
});
							
					//	$(".msg").html(data).fadeIn("slow");
						}
				})
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Response from Server</p>') })

	
//}); //end of document ready

//Functions are written out of document load

function pickclick(orderid) {
	//alert("Youclicked");
//	var orderid=(this).attr('id');
//alert(data);	
	
	$.get( serviceurl+"core/createpicks.php?username="+username+"&orderid="+orderid,
				function(data){
						//alert("Username or Password Wrong!");
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Good Job! No oustanding Pick!</a></ul>');	
						}
						else
						{
						$(".msg").html(data).fadeIn("slow");
						}
				})
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })
	
}	

	//	return false;
} //end of IF

