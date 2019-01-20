var cache_id ;
$(document).ready(function() {
	
	$('#add-fournisseur').on('click',function(event){
		$('.table-index').hide();
		$.get("fournisseur/new",function(data){
		$('.card-body').html(data);
		});

		$(this).hide();
		$("div .card-body").removeClass("mx-auto");
		$(".card-header:contains('Home')").append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/fournisseur">Fournisseurs</a>');
	});


	$("a:contains('Fournisseurs')").on("click",function(){
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
			if(index == 1)
				return false ;

			td.eq(index).html("<input type='text' value='"+$(td).eq(index).text().trim()+"' />") ;

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

			$.post('fournisseur/update',{
				"id":id , 
				"nomFournisseur":$(td).eq(0).children("input").val() ,

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
			if(index == 1)
				return false ;
			if( index == 0 ){
				var value = $(td).eq(index).children("input").val() ;
				var link = "http://"+window.location.host+'/fournisseur/'+$(td).parent().attr("id_attr") ;
				td.eq(index).html("<a href='"+link+"'>"+value+"</a>") ;
				return true;
			}

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

		$.post('fournisseur/delete',{
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
			$.post('fournisseur/search',{
				'nomFournisseur':$('.search-box').val(),

			},function(data){
				if(data){

					var link = "http://"+window.location.host+'/fournisseur/'+data.result.id ;
					var tr = $("table tbody tr:first") ;
					var td = tr.children('td') ;
					tr.nextAll().remove();
					$(".pagination").remove();
					tr.attr('id_attr',data.result.id);
					tr.find(".edit").attr('edit_id',data.result.id);
					tr.find(".first-delete").attr('delete_iid',data.result.id);
					tr.find(".delete").attr('delete_id',data.result.id);

					td.eq(0).html("<a href='"+link+"'>"+data.result.nomFournisseur+"</a>");


					
				

				}
			});
		
	});

	
});