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
function unpaidrefresh() {
//picking list
	$.getJSON( serviceurl+"core/unpaid.php?username="+username,
				function(data){
						//alert("Username or Password Wrong!");
						$('#unpaidlist li').remove();
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Hurray! No outstanding payments!</a></ul>');	
						}
						else
						{
						//$(".msg").html(data).fadeIn("slow");
						//display pick list items
						$.each(data.picklist, function(i,pick){
$('#unpaidlist').append('<li class="collection-item avatar"><img src="http://booksdelivery.com/image/'+ pick.image +'" alt="Photo" class="circle responsive-img"><span class="title">' + pick.product_name + '</span><p class="truncate">'+ pick.manufacturer_name + '<br> <span class="deep-purple white-text"> &nbsp; MRP: '+ pick.mrp +' &nbsp;</span> <span class="blue lighten-1 white-text">  &nbsp;Qty : '+ pick.pick_quantity + ' </span> &nbsp; <span class="orange darken-3 white-text">  &nbsp;'+ pick.pick_discount + '%  &nbsp;</span>  &nbsp;<span class="teal white-text">&nbsp; Rs.' + pick.pick_total + '&nbsp;</span></p></a></li>');
					    });
					   }
				       })
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })						}//pick refresh ends


//on new page load all contents and lists
unpaidrefresh(); //new orders refresh

//Functions are written out of document load



	//	return false;
} //end of IF

