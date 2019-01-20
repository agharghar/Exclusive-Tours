$(function() {


		/*Search*/

	$(".search-button[type='submit']").on('click',function(event){
  		event.preventDefault();
  		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
			$.post('/chauffeur/search_date',{
				'date':$('.search-box').val(),
				'id':$("table[chauffeur_id]").attr('chauffeur_id') ,

			},function(data){
				if(data.result.length > 0){
					var content = $("table:first tbody");
					content.empty() ;
					content.parent().addClass('table');
					$("table:last").remove() ;
					$(".pagination").remove();
					$.each(data.result,function(index,value){
						var link = "http://"+window.location.host+'/bus/'+value.bus_id ;
						$("<tr></tr>").appendTo(content);
						tr = content.children("tr").last();
						$("<td>"+"<a href='"+link+"'>"+value.matricule+"</a></td>").appendTo(tr);
						$("<td>"+value.from+"</td>").appendTo(tr);
						$("<td>"+value.to+"</td>").appendTo(tr);
						$("<td>"+value.km+"</td>").appendTo(tr);
						$("<td>"+value.date+"</td>").appendTo(tr);

						
					});

					


					
				

				}
			});
		
	});






















}); //end document ready 