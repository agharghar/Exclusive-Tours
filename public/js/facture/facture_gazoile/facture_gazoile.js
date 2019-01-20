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
			var fournisseur_id = $(td).eq(2).attr('fournisseur_id');
			var facture_id = $(td).parent().attr('id_attr');
			hint.removeAttr("disabled");
			$(this).text("Done");
			/*Send a get Request To get all the fournisseur Dispo */
			$.get('gazoile/getFournisseurs',function(data){
			
				$.each($(td),function(index,value){
				if(index == 2){
					var nomFournisseur = $(td).eq(2).text();
					$(td).eq(2).html("<select></select>")
					$(td).eq(2).find("select").append("<option selected value='"+fournisseur_id+"'>"+nomFournisseur+"</option>");
					$.each(data,function(index,value){
						if($(td).eq(2).text() == value.id){
							return true ;
						}
						$(td).eq(2).find("select").prepend("<option  value='"+value.id+"'>"+value.nomFournisseur+"</option>");

					});

					return true ;
				}
				if(index == 3 ){return false;}


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

			$.post('gazoile/update',{
				"id":id , 
				"num_facture":$(td).eq(0).children("input").val() ,
				"designation":$(td).eq(1).children("input").val() ,
				"fournisseur_id":$(td).eq(2).find("select option:selected").val() ,



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
				var link = "http://"+window.location.host+'/fournisseur/'+id ;
				td.eq(index).attr("fournisseur_id",id);
				td.eq(index).html("<a href='"+link+"'>"+text+"</a>") ;
			}
			if(index == 3 ){return false;}
			if (index == 0) {
				var value = $(td).eq(index).children("input").val() ;
				var link = "http://"+window.location.host+'/facture/gazoile/'+$(td).parent().attr("id_attr") ;
				td.eq(index).html("<a href='"+link+"'>"+value+"</a>") ;
				td.eq(index).attr("fournisseur_id",$(td).parent().attr("id_attr"));
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

		$.post('gazoile/delete',{
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
			$.post('/facture/gazoile/search',{
				'num_facture':$('.search-box').val(),

			},function(data){
				if(data){
					var link = "http://"+window.location.host+'/fournisseur/'+data.fournisseur[0].id ;
					var linkFacture = "http://"+window.location.host+'/facture/gazoile/'+data.result.id ;
					var tr = $("table tbody tr:first") ;
					var td = tr.children('td') ;
					var montant = 0 ;
					tr.nextAll().remove();
					$(".pagination").remove();
					tr.attr('id_attr',data.result.id);
					td.eq(2).attr("fournisseur_id",data.fournisseur[0].id);
					tr.find(".edit").attr('edit_id',data.result.id);
					tr.find(".first-delete").attr('delete_iid',data.result.id);
					tr.find(".delete").attr('delete_id',data.result.id);
					
					td.eq(0).html("<a href='"+linkFacture+"'>"+data.result.num_facture+"</a>");
					td.eq(1).text(data.result.designation);
					td.eq(2).html("<a href='"+link+"'>"+data.fournisseur[0].nomFournisseur+"</a>");
					$.each(data.result.bills,function(index,value) {

						montant += (value.pu*value.litrage)+value.peage_autoroute+value.peage_lavage ;

					});
					td.eq(3).text(montant);

					
				

				}
			});
		
	});

});