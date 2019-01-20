var cache_id ;
$(document).ready(function() {
	
	$('#add-tour').on('click',function(event){
		$('.table-index').hide();
		$.get("tour/new",function(data){
		$('.card-body').html(data);
		});

		$(this).hide();

		$(".card-header:contains('Home')")
		.append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/tour">Tours</a>');
		$(".card-body").removeClass("mx-auto");

	});

	$("a:contains('Tours')").on("click",function(){
	$("div .card-body").addClass("mx-auto");
	});

	$("a:contains('Home')").on("click",function(){
		setInterval(function(){
		$("div .card-body").addClass("mx-auto");
		},1000);
	});

	/*--------------------------*/

		/*Edit Row*/

	$("table tbody td button.edit").on("click",function(){
		var hint = $("input[name='hidden']") ;
		var td = $(this).parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   

		if(hint.prop("disabled") == true){
			hint.removeAttr("disabled");
			$(this).text("Done");
			

			
			td.eq(4).html("<input type='date' value='"+$(td).eq(4).text().trim()+"'/>") ;
		}else{
			hint.prop("disabled","true");
			$(this).text("Edit");

			/*Send Data ajax*/
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			$.post('tour/update',{
				"date_id":$(td).eq(4).attr("date_id") , 
				"tour_id":$(td).parent().attr("id_attr") , 
				"date":$(td).eq(4).children("input").val() ,

			},function(data){

				if(parseInt(data,10)){
					$("#case-edit").css("background-color" , "#3490dc");
					setTimeout(function(){
					$("#case-edit").css("background-color","transparent");				
					},1000);
				}

			});


			/*End Send Data*/


			td.eq(4).html($(td).eq(4).children("input").val()) ;


			

		}


	});


	/*END Edit ROw */


	/*Delete row */
	$(".first-delete").on("click",function(){
		$(".delete").attr('delete_id',$(this).attr('delete_iid'));
	});

	$(".delete").on("click",function(){
		
		cache_id = $(this).attr('delete_id');
		var td = $("#btn-delete").parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   
		
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			    }
			});

		$.post('tour/delete',{
			'id':cache_id ,

		},function(data){
			
			if(parseInt(data,10)){
				var td_target = "button[delete_iid='"+ cache_id+"']" ;
				$(td_target).parent().parent().remove();
			}

			$("#case-delete").css("background-color" , "#e3342f");
			setTimeout(function(){
			$("#case-delete").css("background-color","transparent");				
			},1000);		
				
				


		});

	});

	/*End delete row */

	/*Search Date*/

	$(".search-button[type='submit']").on('click',function(event){
	event.preventDefault();
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	$.post('/tour/search_date',{
		'date':$('.search-box').val(),

	},function(data){
		if(data.result.length > 0){
			var content = $("table:first tbody");
			content.children("tr").first().nextAll().remove() ;
			content.parent().addClass('table');
			$(".pagination").remove();
			$.each(data.result,function(index,value){
				var tr = content.children("tr").last() ;
				var link = "http://"+window.location.host+'/bus/'+value.bus_id ;

				tr.attr('index',index);
				tr.attr('id_attr',value.id);
				tr.children('td').eq(0).html("<a href='"+link+"'>"+value.matricule+"</a>");
				tr.children('td').eq(1).text(value.from);
				tr.children('td').eq(2).text(value.to);
				tr.children('td').eq(3).text(value.km);
				tr.children('td').eq(4).text(value.date);
				tr.children('td').eq(4).attr("date_id",value.date_id);
				tr.children('td').eq(5).children("button").attr("edit_id",value.id);
				tr.children('td').eq(6).children("button").attr("delete_iid",value.id);
				tr.children('td .delete').attr("delete_id",value.id);

				content.append(tr.clone(true,true));
			
			});


			content.children("tr").last().remove();

		}
	});
});

	/*--------------------------*/
});