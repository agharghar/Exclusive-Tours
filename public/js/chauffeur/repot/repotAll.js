var cache_id ;

$(document).ready(function() {
	
	$('#add-repot').on('click',function(event){
		$('.table-index').hide();
		var link = "http://"+window.location.host+"chauffeur/repot_new";
		$.ajaxSetup({
	   		 headers: {
	       		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   		 }	
		});

		$.get("/chauffeur/repot_new",function(data){
		$('.card-body').html(data);
		});


		$(this).hide();
		$("div .card-body").removeClass("mx-auto");
		$(".card-header:contains('Home')").append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/repot">Repots</a>');
	});


	$("a:contains('Repots')").on("click",function(){
		$("div .card-body").addClass("mx-auto");

	});

	$("a:contains('Home')").on("click",function(){
		setInterval(function(){
		$("div .card-body").addClass("mx-auto");
		},1000);
	});


	/*------------------------*/

$("table tbody td button.edit").on("click",function(){
		var hint = $("input[name='hidden']") ;
		var td = $(this).parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   

		if(hint.prop("disabled") == true){
			hint.removeAttr("disabled");
			$(this).text("Done");

			$.get('/chauffeur/getChauffeurs',function(data){
			
				$.each($(td),function(index,value){
				if(index == 0){
					var nom_prenom = $(td).eq(0).text();
					var id = $(td).eq(0).attr("chauffeur_id");

					$(td).eq(0).html("<select></select>");
					$(td).eq(0).find("select").append("<option selected='selected' value='"+id+"'>"+nom_prenom+"</option>");
					
					$.each(data,function(index,value){
						if(id == value.id){
							return true ;
						}
						$(td).eq(0).find("select").prepend("<option  value='"+value.id+"'>"+value.num_chauffeur+"-"+value.nom+" "+value.prenom+"</option>");

					});

					return true ;
				}
				if (index == 2 || index == 1) {

					td.eq(index).html("<input type='date' value='"+$(td).eq(index).text()+"' />") ;
					
					return true;
				}

				if(index ==4){return false;}

				td.eq(index).html("<input type='text' value='"+$(td).eq(index).text()+"' />") ;

				});
			});

			

		}else{
			hint.prop("disabled","true");
			$(this).text("Edit");

			/*Send Data ajax*/
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});


			

			var chauffeur_id =$(td).eq(0).find("select option:selected").val();

			$.post('/chauffeur/repot/update',{
				"id": $(td).parent().attr('id_attr') ,
				"chauffeur_id":chauffeur_id ,
				"date_debut":$(td).eq(1).children("input").val() ,
				"date_fin":$(td).eq(2).children("input").val() ,
				"nombre_jour":$(td).eq(3).children("input").val() ,

			},function(data){

				if(parseInt(data,10)){
					$("#case-edit").css("background-color" , "#3490dc");
					setTimeout(function(){
					$("#case-edit").css("background-color","transparent");				
					},1000);
				}

			});


			/*End Send Data*/

			$.each($(td),function(index,value){
			if(index == 4)
				return false ;

			if(index == 0 ){
				var text =$(td).eq(index).find("select option:selected").text();
				var	 id =$(td).eq(index).find("select option:selected").val();
					 
				$(this).parent().attr('chauffeur_id',id);
				$(this).attr('chauffeur_id',id);
				var link = '/chauffeur/'+id ;
				td.eq(index).html("<a href='"+link+"'>"+text+"</a>") ;
				return true;
			}


				td.eq(index).html($(td).eq(index).children("input").val()) ;

		});


			

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

		$.post('/chauffeur/repot/delete',{
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

	/*------------------------*/

	/*Search*/
	$(".search-button[type='submit']").on('click',function(event){
  		event.preventDefault();
  		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		if($.isNumeric($('.search-box').val()) ){

			$.post('/chauffeur/search_repot',{
				'num_chauffeur':$('.search-box').val(),

			},function(data){
				if(data){

					var content = $("table:first tbody");
					content.children("tr").first().nextAll().remove() ;

					$(".pagination").remove();

					$.each(data.result,function(index,value){
						var tr = content.children("tr").last() ;
						var link = "http://"+window.location.host+'/chauffeur/'+value.chauffeur_id ;
						tr.attr('id_attr',value.id);
						tr.attr('chauffeur_id',value.chauffeur_id);
						tr.children("td:first").attr('chauffeur_id',value.chauffeur_id);

						tr.find(".first-delete").attr('delete_iid',value.id);
						tr.find(".edit").attr('edit_id',value.id);
						tr.find('.delete').attr('delete_id',value.id);
						tr.children('td').eq(0).html("<a href='"+link+"'>"+value.num_chauffeur+"-"+value.nom+" "+value.prenom+"</a>");
						tr.children('td').eq(1).text(value.date_debut);
						tr.children('td').eq(2).text(value.date_fin);
						tr.children('td').eq(3).text(value.nombre_jour);

						content.append(tr.clone(true,true));
					});

					content.children("tr").last().remove();


					
				

				}
			});
		}
	});







	/*Search*/
});