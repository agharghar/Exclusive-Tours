var cache_id ;

$(document).ready(function() {

	$('#add-gazoile').on('click',function(event){
		$('.table-index').hide();
		$.get("gazoile/new",function(data){
		$('.card-body').html(data);
		});

		$(this).hide();
		$(".card-body").removeClass("mx-auto");
		$(".card-header:contains('Home')")
		.append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/facture/gazoile">Factures Gazoiles</a>');
	});

	$("a:contains('Factures Gazoiles')").on("click",function(){
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
			var bus_id = $(td).eq(2).attr('bus_id');
			hint.removeAttr("disabled");
			$(this).text("Done");
			/*Send a get Request To get all the fournisseur Dispo */
			$.get('/facture/visite/getBuses',function(data){
			
				$.each($(td),function(index,value){
					if(index == 2){
						var matricule = $(td).eq(index).text();
						$(td).eq(index).html("<select></select>")
						$(td).eq(index).find("select").append("<option selected value='"+bus_id+"'>"+matricule+"</option>");
						$.each(data,function(index,value){
							if($(td).eq(2).attr('bus_id') == value.id){
								return true ;
							}
							$(td).eq(2).find("select").prepend("<option  value='"+value.id+"'>"+value.matricule+"</option>");

						});


						return true;
					}

					if (index == 0) {

						td.eq(index).html("<input type='date' value='"+$(td).eq(index).text()+"' />") ;
						
						return true;
					}
					if(index == 8){return false ;}

					td.eq(index).html("<input required type='text' value='"+$(td).eq(index).text()+"' />") ;



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

			$.post('/facture/gazoile/bill/update',{
				"id":id , 
				"date":$(td).eq(0).children("input").val() ,
				"num_carte":$(td).eq(1).children("input").val() ,
				"bus_id":$(td).eq(2).find("select option:selected").val() ,
				"km":$(td).eq(3).children("input").val() ,
				"litrage":$(td).eq(4).children("input").val() ,
				"pu":$(td).eq(5).children("input").val() ,
				"peage_lavage":$(td).eq(6).children("input").val() ,
				"peage_autoroute":$(td).eq(7).children("input").val() ,
				"montant":$(td).eq(8).children("input").val()*$(td).eq(4).children("input").val(),



			},function(data){


				if(parseInt(data,10)){
					
					// parseFloat($(td).eq(5).children("input").val()); 
					$("#case-edit").css("background-color" , "#3490dc");
					setTimeout(function(){
					$("#case-edit").css("background-color","transparent");				
					},1000);
				}

			});


			/*End Send Data*/

			$.each($(td),function(index,value){
			if (index == 2) {
				var id = $(td).eq(index).find("select option:selected").val() ;
				var text = $(td).eq(index).find("select option:selected").text() ;
				var link = "http://"+window.location.host+'/bus/'+id ;
				td.eq(index).html("<a href='"+link+"'>"+text+"</a>") ;
				return true;
			}


			if(index == 8){return false ;}

				td.eq(index).text($(td).eq(index).children("input").val()) ;

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

		$.post('/facture/gazoile/bill/delete',{
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
/*
	$(".search-button[type='submit']").on('click',function(event){
  		event.preventDefault();
  		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
			$.post('/facture/gazoile/search',{
				'num_facture':$('.search-box').val(),

			},function(data){
				if(data){
					var link = "http://"+window.location.host+'/fournisseur/'+data.fournisseur[0].id ;
					var tr = $("table tbody tr:first") ;
					var td = tr.children('td') ;
					tr.nextAll().remove();
					$(".pagination").remove();
					tr.attr('id_attr',data.result.id);
					$(".edit").attr('edit_id',data.result.id);
					$(".first-delete").attr('delete_iid',data.result.id);
					$(".delete").attr('delete_id',data.result.id);
					
					td.eq(0).text(data.result.num_facture);
					td.eq(1).text(data.result.designation);
					td.eq(2).text(data.result.date);
					td.eq(3).text(data.result.pu);
					td.eq(4).text(data.result.litrage);
					td.eq(5).text(data.result.litrage*data.result.pu);
					td.eq(6).html("<a href='"+link+"'>"+data.fournisseur[0].nomFournisseur+"</a>");


					
				

				}
			});
		
	});*/

});