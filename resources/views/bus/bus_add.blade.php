<link rel="stylesheet" type="text/css" href="{{ asset('css/bus/bus_add.css') }}">

{!! Form::model(bus::class, ['route' => 'bus.add']) !!}

<div class="form-group col-6 ">
  {!! Form::label('matricule', 'Matricule') !!}
  {!! Form::text('matricule', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('num_carte_grisse', 'N° Carte Grisse ') !!}
  {!! Form::text('num_carte_grisse', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('pv', 'PV') !!}
  {!! Form::text('pv', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<div class="form-group col-6">
  {!! Form::label('autorisation_num', 'N° Autorisation') !!}
  {!! Form::text('autorisation_num', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('autorisation_num_dossier', 'autorisation: N° Dossier') !!}
  {!! Form::text('autorisation_num_dossier', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<div class="form-group col-6">
  {!! Form::label('assurance_num_odre', 'Assurance N° Odre') !!}
  {!! Form::text('assurance_num_odre', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('date_debut', ' Assurance :Date Debut') !!}
  {!! Form::date('date_debut', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6">
  {!! Form::label('date_fin', 'Assurance: Date Fin') !!}
  {!! Form::date('date_fin', '', ['class' => 'form-control' ,'required' => 'required']) !!}
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
