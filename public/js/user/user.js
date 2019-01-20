var cache_id;
$(function() {
	


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

		$.post('user/delete',{
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



		/*-----------------------------------Edit -----------------------------------*/
		$("table tbody td button.edit").on("click",function(){
		var hint = $("input[name='hidden']") ;
		var td = $(this).parent().siblings() ; // ALl tds that containe value 
		var id = $(td).parent().attr("id_attr"); // id of element in database included in tr as attr   

		if(hint.prop("disabled") == true){
			var role_id = $(td).eq(2).attr('role_id');
			hint.removeAttr("disabled");
			$(this).text("Done");
			/*Send a get Request To get all the buses Dispo */
			$.get('user/getRoles',function(data){
			
				$.each($(td),function(index,value){
				if(index == 2){
					var type = $(td).eq(2).text();
					$(td).eq(2).html("<select></select>")
					$.each(data,function(index,value){
						if($(td).eq(2).text() == value.id){
							return true ;
						}
						$(td).eq(2).find("select").prepend("<option  value='"+value.id+"'>"+value.type+"</option>");

					});

					return false ;
				}
				if (index == 1) {

					td.eq(index).html("<input type='email' value='"+$(td).eq(index).text()+"' />") ;
					
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

			$.post('user/update',{
				"id":id , 
				"name":$(td).eq(0).children("input").val() ,
				"email":$(td).eq(1).children("input").val() ,
				"role_id":$(td).eq(2).find("select option:selected").val() ,



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
			if (index == 2) {
				var id = $(td).eq(2).find("select option:selected").val() ;
				var text = $(td).eq(2).find("select option:selected").text() ;
				td.eq(index).html(text) ;
				td.eq(index).attr("role_id",id) ;
				return true;
			}

				td.eq(index).html($(td).eq(index).children("input").val()) ;

		});


			

		}


	});


	/*END Edit ROw */



});//end ready 