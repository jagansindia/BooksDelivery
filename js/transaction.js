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
var totalitems=0;
var totalamount=0;
	$.getJSON( serviceurl+"core/transactions.php?username="+username,
				function(data){
						//alert("Username or Password Wrong!");
						$('#transactions li').remove();
						if(!data)
						{
						$("#test1").html('<ul class="collection"><a href="#!" class="collection-item  center-align">No Transactions found!</a></ul>');	
						}
						else
						{
						$(".msg").html(data).fadeIn("slow");
						//display pick list items
						$.each(data.transactions, function(i,pick){
$('#transactions').append('<li class="collection-item"><p class="truncate"><span class="blue-text">Payment ID: '+pick.ID+'</span><br><span class="teal-text"> Reference: '+ pick.paid_reference + '</span><br><span class="">Transaction Time: '+pick.timestamp+'</span><br><span class="blue white-text"><b>&nbsp;Date: '+ pick.date +'&nbsp;</b></span> &nbsp; <span class="teal white-text"><b>&nbsp;Amount: Rs.'+ parseFloat(pick.amount) +'&nbsp;</b></span></p></a></li>');
						
						totalamount=totalamount+parseFloat(pick.amount);
					    });
						$("#pendingamount").html('<p>Rs.'+totalamount+'</p>');
					
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

