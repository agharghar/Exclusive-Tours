$(document).ready(function() {
	
	$('#add-trajet').on('click',function(event){
		$('.table-index').hide();
		$.get("trajet/new",function(data){
		$('.card-body').html(data);
		});


		$(".card-header:contains('Home')").append('<a class="al btn btn-outline-secondary mr-3 float-right" href="/trajet">Trajets</a>');
		$(this).hide()
		$(".card-body").removeClass("mx-auto");
		

	});



	$("a:contains('Trajets')").on("click",function(){
		$("div .card-body").addClass("mx-auto")
	});

	$("a:contains('Home')").on("click",function(){
		setInterval(function(){
			$("div .card-body").addClass("mx-auto");
		},1000);
	});

	/*----------------------------*/

		/*Edit Row*/

	$("table tbody td button.edit").on("click",function(){
		var hint = $("input[name='hidden']") ;
		var td = $(this).parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   

		if(hint.prop("disabled") == true){
			hint.removeAttr("disabled");
			$(this).text("Done");
			
			$.each($(td),function(index,value){
			if(index == 3)
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

			$.post('trajet/update',{
				"id":id , 
				"from":$(td).eq(0).children("input").val() ,
				"to":$(td).eq(1).children("input").val() ,
				"km":$(td).eq(2).children("input").val() ,


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
			if(index == 3)
				return false ;


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

		$.post('trajet/delete',{
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

	/*----------------------------*/

			/*Search*/

	$(".search-button[type='submit']").on('click',function(event){
			event.preventDefault();
			$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
			$.post('trajet/search',{
				'from':$(".search-box[name='from']").val(),
				'to':$(".search-box[name='to']").val(),

			},function(data){
				if( data != 0 ){
					console.log(data);
					var tr = $("table tbody tr:last") ;
					var td = tr.children('td') ;
					tr.siblings().remove();
					$(".pagination").remove();
						$.each(data.result , function(index,value){

						tr.attr('id_attr',value.id);
						tr.filter(".edit").attr('edit_id',value.id);
						$("#btn-delete").attr('delete_iid',value.id);
						$("#d").attr('delete_id',value.id);

						td.eq(0).html(value.from);
						td.eq(1).html(value.to);
						td.eq(2).html(value.km);

					tr.parent().append(tr.clone(true,true));
					});

					tr.siblings().last().remove();
					
				

				}
			});
		
	});


});//end Ready