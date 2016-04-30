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
function transactions() {
//unpaid list
	$.getJSON( serviceurl+"core/manufacturer.php?username="+username,
				function(data){
						//alert("Username or Password Wrong!");
						$('#transactions li').remove();
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">Manufacturer Settings not available</a></ul>');	
						}
						else
						{
						$(".msg").html(data).fadeIn("slow");
						//display pick list items
						$.each(data.transactions, function(i,pick){
$('#transactions').append('<li class="collection-item"><span class=""> ID: '+pick.smid+' - '+ pick.name + '</span><br><span class="orange white-text"><b>&nbsp;Discount: '+ pick.discount +'%&nbsp;</b></span> &nbsp; <span class="purple white-text"><b>&nbsp;Credit: '+ parseFloat(pick.creditdays) +' Days&nbsp;</b></span></a></li>');
						
						
					    });
						
					
					   }
				       })
				.fail(function() { $(".msg").html('<p class="card-panel teal lighten-2">No Internet Connection</p>') })						
					return false;
				}//pick refresh ends



//on new page load all contents and lists
transactions(); //transactions list refresh
//Functions are written out of document load



	//	return false;
} //end of IF

