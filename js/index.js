// JavaScript Document - 13th April 2015
var serviceurl="http://booksdelivery.com/seller/";

	
	if(window.localStorage["username"] == undefined)
{
	window.location = "login.html";
}
else
{
	var username = window.localStorage["username"];
	//alert(username);
	$('.iavatar').html(username);

//Pick list refresh function
function pickrefresh() {
//picking list
	$.getJSON( serviceurl+"core/picklist.php?username="+username,
				function(data){
						//alert("Username or Password Wrong!");
						$('#picklist li').remove();
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Good Job! No oustanding Pick!</a></ul>');	
						}
						else
						{
						//$(".msg").html(data).fadeIn("slow");
						//display pick list items
						$.each(data.picklist, function(i,pick){
$('#picklist').append('<li class="collection-item avatar"><img src="http://booksdelivery.com/image/'+ pick.image +'" alt="Photo" class="circle responsive-img"><span class="title">' + pick.product_name + '</span><p class="truncate">'+ pick.author + '<br>'+ pick.manufacturer_name +'</p><a href="#!" class="secondary-content"><h5 class="teal white-text">&nbsp;' + pick.pick_quantity + '&nbsp;</h5> </a></li>');
					    });
					   }
				       })
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })						}//pick refresh ends

//New orders refresh function
function newordersrefresh(){
//new order list
var orders;
	$.getJSON( serviceurl+"core/neworders.php",
				function(data){
						//alert("Username or Password Wrong!");
						$('#neworders li').remove();
						if(!data)
						{
						$("#test2").html('<ul class="collection"><a href="#!" class="collection-item  center-align">No New orders!</a></ul>');	
						}
						else
						{
							//display new order list items
$.each(data.orders, function(i,order){
$('#neworders').append('	<li class="collection-item teal lighten-3 white-text" id="a'+ order.order_id +'"><div><p> Order '+ order.order_id +'<a href="#"  class="secondary-content white" onclick="pickclick('+ order.order_id +')">&nbsp;Pick <i class="mdi-content-send"></i>&nbsp;</a></p></div></li>');
});
					//	$(".msg").html(data).fadeIn("slow");
						}
				})
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Response from Server</p>') })
	
}//new order refresh ends

function pickclick(orderid) {
	//alert("Youclicked");
//	var orderid=(this).attr('id');
//alert(data);	
	
	$.get( serviceurl+"core/createpicks.php?username="+username+"&orderid="+orderid,
				function(data){
						//alert("Username or Password Wrong!");
						$(".msg").html('<div class="progress"><div class="indeterminate"></div></div>').fadeIn("slow");
						$('#picklist li').remove();
						if(!data)
						{
						//$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Good Job! No oustanding Pick!</a></ul>');	alert("oops");
						$('#test2').hide();
						$('#test1').show();
						$('#tab1').addClass("active");
						$('#tab1').removeClass("active");
						pickrefresh();
						$('#a'+orderid).hide();
						$(".msg").hide();
						}
						else
						{
						$('#a'+orderid).hide();
						$('#test1').show();
						}
				})
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })
	
}	
	
//on new page load all contents and lists
pickrefresh(); //picking list refresh
newordersrefresh(); //new orders refresh

//Functions are written out of document load



	//	return false;
} //end of IF

