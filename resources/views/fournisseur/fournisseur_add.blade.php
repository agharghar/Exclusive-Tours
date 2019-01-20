
{!! Form::model(fournisseur::class, ['route' => 'fournisseur.add']) !!}

	<div class="form-group col-6">
	  {!! Form::label('nomFournisseur', 'Desigranion') !!}
	  {!! Form::text('nomFournisseur', '', ['class' => 'form-control' ,'required' => 'required']) !!}
	</div>

	<button class="btn btn-success ml-3" type="submit">Ajout</button>

{!! Form::close() !!}

