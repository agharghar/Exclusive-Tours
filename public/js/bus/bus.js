var cache_id ;

	$(document).ready(function() {
	
	$('#add-bus').on('click',function(event){

		$('.table-index').hide();
		$.get("bus/new",function(data){
		$('.card-body').html(data);
		});

		$(this).hide();
		$(".card-body").removeClass("mx-auto");
		$(".card-header:contains('Home')").append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/bus">Buses</a>');
		$(".card-header span , .card-header form ").hide();
		$(".card-header").append("<span>Add Buses</span>");

	});

	$("a:contains('Buses')").on("click",function(){
	$("div .card-body").addClass("mx-auto");
	});

	$("a:contains('Home')").on("click",function(){
		setInterval(function(){
		$("div .card-body").addClass("mx-auto");
		},1000);
	});

		/*Edit Row*/

	$("table tbody td button.edit").on("click",function(){
		var hint = $("input[name='hidden']") ;
		var td = $(this).parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   

		if(hint.prop("disabled") == true){
			hint.removeAttr("disabled");
			$(this).text("Done");
			
			$.each($(td),function(index,value){
			if(index == 8)
				return false ;
			if (index == 6 || index == 7) {

				td.eq(index).html("<input type='date' value='"+$(td).eq(index).text()+"' />") ;
				
				return true;
			}

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

			$.post('/bus/update',{
				"id":id , 
				"matricule":$(td).eq(0).children("input").val() ,
				"num_carte_grisse":$(td).eq(1).children("input").val() ,
				"pv":$(td).eq(2).children("input").val() ,
				"autorisation_num_dossier":$(td).eq(3).children("input").val() ,
				"autorisation_num":$(td).eq(4).children("input").val() ,
				"assurance_num_odre":$(td).eq(5).children("input").val() ,
				"date_debut":$(td).eq(6).children("input").val() ,
				"date_fin":$(td).eq(7).children("input").val() ,

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
			if(index == 8)
				return false ;
			if (index == 0) {
				var value = $(td).eq(index).children("input").val() ;
				var link = "http://"+window.location.host+'/bus/'+$(td).parent().attr("id_attr") ;
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

		$.post('bus/delete',{
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

	/*Search*/

	$(".search-button[type='submit']").on('click',function(event){
  		event.preventDefault();
  		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
			$.post('/bus/search',{
				'matricule':$('.search-box').val(),

			},function(data){
				if(data){
					var link = "http://"+window.location.host+'/bus/'+data.result.id ;
					var tr = $("table tbody tr:first") ;
					var td = tr.children('td') ;
					tr.nextAll().remove();
					$(".pagination").remove();
					tr.attr('id_attr',data.result.id);
					tr.find(".edit").attr('edit_id',data.result.id);
					tr.find(".first-delete").attr('delete_iid',data.result.id);
					tr.find(".delete").attr('delete_id',data.result.id);
					
					td.eq(0).html("<a href='"+link+"'>"+data.result.matricule+"</a>");
					td.eq(1).text(data.result.num_carte_grisse);
					td.eq(2).text(data.result.pv);
					td.eq(3).text(data.result.autorisation_num_dossier);
					td.eq(4).text(data.result.autorisation_num);
					td.eq(5).text(data.result.assurance_num_odre);
					td.eq(6).text(data.result.date_debut);
					td.eq(7).text(data.result.date_fin);


					
				

				}
			});
		
	});

	/*End delete row */


});