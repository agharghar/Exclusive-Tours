/* BEGIN functions Definitions*/	
function checkNotification() {
	
	$.get('/bus/assuranceExpire',function(data){
	
	$(".notification").html(data.notification);
	$(".count").html(data.count);

});

}


/*functions Definitions END*/	

$(document).ready(function(){

	checkNotification();

	$("a:contains('Exclusive Tours')").on("click",function(){

		setInterval(function(){
		$("div .card-body").addClass("mx-auto");
		},1000);



	});

	setInterval(function(){
		
		checkNotification();
	},1000*60*10);



	});