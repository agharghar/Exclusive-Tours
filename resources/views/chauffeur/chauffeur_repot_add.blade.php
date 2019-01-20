<link rel="stylesheet" type="text/css" href="{{ asset('css/chauffeur/add_repot.css') }}">

{!! Form::model(bus::class, ['route' => 'chauffeur.repot_add']) !!}



    <div class="form-group col-6 ">
      {!! Form::label('date_debut', ' Date Debut') !!}
      {!! Form::date('date_debut', '', ['class' => 'form-control' ,'required' => 'required']) !!}
    </div>

    <div class="form-group col-6">
      {!! Form::label('date_fin', 'Date Fin') !!}
      {!! Form::date('date_fin', '', ['class' => 'form-control' ,'required' => 'required']) !!}
    </div>

    <div class="form-group col-6 ">
      {!! Form::label('nombre_jour', 'Nombre De Jour') !!}
      {!! Form::text('nombre_jour', '', ['class' => 'form-control' ,'required' => 'required']) !!}
    </div>

    <div class="form-group col-6 ">
      {!! Form::label('chauffeur_id', 'Numero Chauffeur') !!}
      @if($last)
		{!! Form::select('chauffeur_id', $numeroChauffeurs); !!} 
 	  @else
 	  	<div class="btn btn-danger">
 	  			<div>	  				
		 	  		<span>Y'a pas de Chauffeur disponible</span>
 	  			</div>
 	  	</div>
 	  @endif
    </div>

   
    <button class="btn btn-success ml-3" type="submit">Ajout</button>
