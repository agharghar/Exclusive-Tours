$(function() {

	$("button[type='button']:contains('+')").on('click',function() {

		var form = $("section.core:first").clone('true','true') ;
		form.find('input').val('');
		form.insertAfter(".core:last");

	});
	
	$("button[type='button']:contains('-')").on('click',function() {

		if($(".core").length == 1){
			return false ;
		}
		$(".core:last").remove();

	});

	$("button[type='submit']").on('click',function(event){
		event.preventDefault();
		var km = [];
		var date = [];
		var bus_id = [];
		var num_carte = [];
		var pu = [];
		var litrage = [];
		var peage_lavage = [];
		var peage_autoroute = [];
		var designation = $("input[name='designation']").val();
		var facture = $("input[name='facture']").val();
		var fournisseur_id = $("select[name='fournisseur_id'] option:selected").val();
		$(".core").each(function(index) {
			km.push($("input[name='km']").eq(index).val());
			date.push($("input[name='date']").eq(index).val());
			bus_id.push($("select[name='bus_id'] option:selected").eq(index).val());
			pu.push($("input[name='pu']").eq(index).val());
			num_carte.push($("input[name='num_carte']").eq(index).val());
			litrage.push($("input[name='litrage']").eq(index).val());
			peage_lavage.push($("input[name='peage_lavage']").eq(index).val());
			peage_autoroute.push($("input[name='peage_autoroute']").eq(index).val());

		});
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.post('/facture/gazoile/add',{

			'km':km ,
			'date':date ,
			'bus_id':bus_id ,
			'num_carte':num_carte ,
			'pu':pu ,
			'litrage':litrage ,
			'peage_lavage':peage_lavage ,
			'peage_autoroute':peage_autoroute ,
			'facture':facture ,
			'designation':designation ,
			'fournisseur_id':fournisseur_id ,

		},function(data) {
		
			if(data == 1){

				location.reload(); 
			}
		});//end call back
	});//end post


























});//end 