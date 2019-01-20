$(function() {

	$(".search-button[type='submit']").on('click',function(event){
		event.preventDefault();
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		
		$.post('/bus/search_date',{
			'date':$('.search-box').val(),
			'id':$("table[bus_id]").attr('bus_id') ,

		},function(data){
			if(data.result.length > 0){
				var content = $("table:first tbody");
				content.empty() ;
				content.parent().addClass('table');
				$("table:last").remove() ;
				$(".pagination").remove();
				$.each(data.result,function(index,value){
					$("<tr></tr>").appendTo(content);
					tr = content.children("tr").last();
					$("<td>"+value.from+"</td>").appendTo(tr);
					$("<td>"+value.to+"</td>").appendTo(tr);
					$("<td>"+value.km+"</td>").appendTo(tr);
					$("<td>"+value.date+"</td>").appendTo(tr);

					
				});

			}
		});
	});


});//end Load Function