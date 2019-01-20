var cache_id ;


$(document).ready(function() {
	
	$('#add-visite').on('click',function(event){
		$('.table-index').hide();
		$.get("visite/new",function(data){
		$('.card-body').html(data);
		});

		$(this).hide();
		$(".card-body").removeClass("mx-auto");
		$(".card-header:contains('Home')")
		.append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/facture/visite">Factures Visite Technique</a>');
	});
	
	$("a:contains('Factures Visite Technique')").on("click",function(){
		$("div .card-body").addClass("mx-auto");
	});

	$("a:contains('Home')").on("click",function(){
		setInterval(function(){
		$("div .card-body").addClass("mx-auto");
		},1000);
	});

		/*-----------------------------------Edit -----------------------------------*/
		$("table tbody td button.edit").on("click",function(){
		var hint = $("input[name='hidden']") ;
		var td = $(this).parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   

		if(hint.prop("disabled") == true){
			var bus_id = $(td).eq(4).attr('bus_id');
			hint.removeAttr("disabled");
			$(this).text("Done");
			/*Send a get Request To get all the buses Dispo */
			$.get('visite/getBuses',function(data){
			
				$.each($(td),function(index,value){
				if(index == 4){
					var matricule = $(td).eq(4).text();
					$(td).eq(4).html("<select></select>")
					$(td).eq(4).find("select").append("<option value='"+bus_id+"'>"+matricule+"</option>");
					$.each(data,function(index,value){
						if($(td).eq(4).text() == value.id){
							return true ;
						}
						$(td).eq(4).find("select").prepend("<option  value='"+value.id+"'>"+value.matricule+"</option>");

					});

					return false ;
				}
				if (index == 2) {

					td.eq(index).html("<input type='date' value='"+$(td).eq(index).text()+"' />") ;
					
					return true;
				}

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

			$.post('visite/update',{
				"id":id , 
				"num_facture":$(td).eq(0).children("input").val() ,
				"designation":$(td).eq(1).children("input").val() ,
				"date":$(td).eq(2).children("input").val() ,
				"montant":$(td).eq(3).children("input").val() ,
				"bus_id":$(td).eq(4).find("select option:selected").val() ,



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
			if(index == 5)
				return false ;
			if (index == 4) {
				var id = $(td).eq(4).find("select option:selected").val() ;
				var text = $(td).eq(4).find("select option:selected").text() ;
				var link = "http://"+window.location.host+'/bus/'+id ;
				td.eq(index).html("<a href='"+link+"'>"+text+"</a>") ;
				td.eq(index).attr("bus_id",id);
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

		$.post('visite/delete',{
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
			$.post('/facture/visite/search',{
				'num_facture':$('.search-box').val(),

			},function(data){
				if(data){
					var link = "http://"+window.location.host+'/bus/'+data.bus[0].id ;
					var tr = $("table tbody tr:first") ;
					var td = tr.children('td') ;
					tr.nextAll().remove();
					$(".pagination").remove();
					tr.attr('id_attr',data.result.id);
					tr.find(".edit").attr('edit_id',data.result.id);
					tr.find(".first-delete").attr('delete_iid',data.result.id);
					tr.find(".delete").attr('delete_id',data.result.id);
					td.eq(4).attr("bus_id",data.bus[0].id)
					
					td.eq(0).text(data.result.num_facture);
					td.eq(1).text(data.result.designation);
					td.eq(2).text(data.result.date);
					td.eq(3).text(data.result.montant);
					td.eq(4).html("<a href='"+link+"'>"+data.bus[0].matricule+"</a>");


					
				

				}
			});
		
	});



});