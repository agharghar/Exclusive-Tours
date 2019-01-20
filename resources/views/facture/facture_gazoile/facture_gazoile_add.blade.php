
<link rel="stylesheet" type="text/css" href="{{ asset('css/facture/facture_gazoile/add.css') }}">
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
{!! Form::model(facture_gazoile::class, ['route' => 'facture.gazoile.add']) !!}

<header>
	<div class="form-group col-6">
	  {!! Form::label('facture', 'N° Facture') !!}
	  {!! Form::text('facture', '', ['class' => 'form-control' ,'required' => 'required']) !!}
	</div>

	<div class="form-group col-6">
	  {!! Form::label('designation', 'Designation') !!}
	  {!! Form::text('designation', '', ['class' => 'form-control' , 'required' => 'required']) !!}
	</div>
	
	<div class="form-group col-6">
	  @if($lastFounisseur)
	    {!! Form::label('fournisseur_id ', 'Fournisseur') !!}
	    {!! Form::select('fournisseur_id', $numeroFournisseur , ['class' => 'form-control']) !!} 
	  @else
	    <div class="btn btn-danger">
	            <div>                   
	                <span>Y'a pas de Fournisseur</span>
	            </div>
	    </div>
	  @endif
	</div>

 </header>

<section class="core">

	<div class="form-group col-6">
	  {!! Form::label('date', 'date') !!}
	  {!! Form::date('date', '', ['class' => 'form-control' ,'required' => 'required']) !!}
	</div>

	<div class="form-group col-6">
	  @if($lastBus)
	    {!! Form::label('bus_id ', 'Matricule') !!}
	    {!! Form::select('bus_id', $numeroBus , ['class' => 'form-control']) !!} 
	  @else
	    <div class="btn btn-danger">
	            <div>                   
	                <span>Y'a pas de bus</span>
	            </div>
	    </div>
	  @endif
	</div>

	<div class="form-group col-6">
	  {!! Form::label('num_carte', 'Numero Carte') !!}
	  {!! Form::text('num_carte', '', ['class' => 'form-control' ,'required' => 'required']) !!}
	</div>

	<div class="form-group col-6">
	  {!! Form::label('pu', 'Prix Unitaire') !!}
	  {!! Form::text('pu', '0', ['class' => 'form-control' , 'required' => 'required']) !!}
	</div>

	<div class="form-group col-6">
	  {!! Form::label('litrage', 'Litrage') !!}
	  {!! Form::text('litrage', '0', ['class' => 'form-control' , 'required' => 'required']) !!}
	</div>


	<div class="form-group col-6">
	  {!! Form::label('km', 'Km') !!}
	  {!! Form::text('km', '0', ['class' => 'form-control' , 'required' => 'required']) !!}
	</div>

	<div class="form-group col-6">
	  {!! Form::label('peage_lavage', 'Peage Lavage') !!}
	  {!! Form::text('peage_lavage', '0', ['class' => 'form-control' , 'required' => 'required']) !!}
	</div>

	<div class="form-group col-6">
	  {!! Form::label('peage_autoroute', 'Peage Autoroute') !!}
	  {!! Form::text('peage_autoroute', '0', ['class' => 'form-control' , 'required' => 'required']) !!}
	</div>

</section>
		<button class="btn btn-success ml-3 " type="submit">Ajout</button>
		<button class="btn btn-primary ml-3 " type="button">+</button>
		<button class="btn btn-primary ml-3 " type="button">-</button>

{!! Form::close() !!}


<script type="text/javascript" src="{{ asset('js\facture\facture_gazoile\facture_gazoile_add.js') }} "></script>

