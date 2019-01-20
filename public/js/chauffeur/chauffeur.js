var cache_id ;

$(document).ready(function() {
	
	$('#add-chauffeur').on('click',function(event){
		$('.table-index').hide();
		var link = "http://"+window.location.host+"/chauffeur/new";
		$.ajaxSetup({
	   		 headers: {
	       		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   		 }	
		});
		$.get(link,function(data){
		$('.card-body').html(data);
		});

		$(this).hide();
		$("div .card-body").removeClass("mx-auto");
		$(".card-header:contains('Home')").append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/chauffeur">Chauffeurs</a>');
	});


	$("a:contains('Chauffeurs')").on("click",function(){
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
			
			$.each($(td),function(index,value){
			if(index == 9)
				return false ;

			td.eq(index).html("<input type='text' value='"+$(td).eq(index).text()+"' />") ;

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

			$.post('/chauffeur/update',{
				"id":id , 
				"num_chauffeur":$(td).eq(0).children("input").val() ,
				"prenom":$(td).eq(1).children("input").val() ,
				"nom":$(td).eq(2).children("input").val() ,
				"cin":$(td).eq(3).children("input").val() ,
				"permis":$(td).eq(4).children("input").val() ,
				"address":$(td).eq(5).children("input").val() ,
				"cnss":$(td).eq(6).children("input").val() ,
				"dossier":$(td).eq(7).children("input").val() ,
				"tele" : $(td).eq(8).children("input").val() ,
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
			if(index == 9)
				return false ;

			if(index == 1 || index == 2 ){
				var value = $(td).eq(index).children("input").val() ;
				var link = "http://"+window.location.host+'/chauffeur/'+$(td).parent().attr("id_attr") ;
				td.eq(index).html("<a href='"+link+"'>"+value+"</a>") ;
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

		$.post('/chauffeur/delete',{
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

			$.post('/chauffeur/search',{
				'num_chauffeur':$('.search-box').val(),

			},function(data){
				if(data){
					var link = "http://"+window.location.host+'/chauffeur/'+data.result.id ;
					var tr = $("table tbody tr:first") ;
					var td = tr.children('td') ;
					tr.nextAll().remove();
					$(".pagination").remove();
					tr.attr('id_attr',data.result.id);
					tr.find(".edit").attr('edit_id',data.result.id);
					tr.find(".first-delete").attr('delete_iid',data.result.id);
					tr.find(".delete").attr('delete_id',data.result.id);
					td.eq(0).text(data.result.num_chauffeur);
					td.eq(1).html("<a href='"+link+"'>"+data.result.prenom+"</a>");
					td.eq(2).html("<a href='"+link+"'>"+data.result.nom+"</a>");
					td.eq(3).text(data.result.cin);
					td.eq(4).text(data.result.permis);
					td.eq(5).text(data.result.address);
					td.eq(6).text(data.result.cnss);
					td.eq(7).text(data.result.dossier);
					td.eq(8).text(data.result.tele);


					
				

				}
			});
		}
	});







	/*Search*/
});