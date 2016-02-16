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
//unpaid list
var totalitems=0;
var totalamount=0;
	$.getJSON( serviceurl+"core/paid.php?username="+username,
				function(data){
						//alert("Username or Password Wrong!");
						$('#unpaidlist li').remove();
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Ohoh! You did not have anything to get paid!</a></ul>');	
						}
						else
						{
						$(".msg").html(data).fadeIn("slow");
						//display pick list items
						$.each(data.picklist, function(i,pick){
$('#unpaidlist').append('<li class="collection-item"><p class="truncate"><span class="title">ID:'+pick.order_product_id +' - ' + pick.product_name +'</span><br>'+ pick.manufacturer_name + '<br>Order No:'+pick.order_id +' &nbsp; Picked:'+pick.picked_time+'<br><span class="deep-purple white-text"> &nbsp; MRP: '+ parseFloat(pick.mrp) +' &nbsp;</span> <span class="blue lighten-1 white-text">  &nbsp;Qty : '+ pick.pick_quantity + '</span> &nbsp; <span class="orange darken-3 white-text">  &nbsp;'+ pick.pick_discount + '%  &nbsp;</span>  &nbsp;<span class="teal white-text">&nbsp; Rs.' + parseFloat(pick.pick_total) + '&nbsp;</span></p></a></li>');
						totalitems=totalitems+parseFloat(pick.pick_quantity);
						totalamount=totalamount+parseFloat(pick.pick_total);
					    });
						$("#pendingamount").html('<p>Rs.'+totalamount+'</p>');
						$("#totalbook").html('<p>'+totalitems+'</p>');
					   }
				       })
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })						}//pick refresh ends


//on new page load all contents and lists
unpaidrefresh(); //new orders refresh

//Functions are written out of document load



	//	return false;
} //end of IF

