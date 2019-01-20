<link rel="stylesheet" type="text/css" href="{{ asset('css/chauffeur/add.css') }}">

{!! Form::model(chauffeur::class, ['route' => 'chauffeur.add']) !!}

<div class="form-group col-6 ">
  {!! Form::label('nom', 'Nom') !!}
  {!! Form::text('nom', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('num_chauffeur', 'N° Chauffeur') !!}
  {!! Form::text('num_chauffeur', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('prenom', 'Prenom') !!}
  {!! Form::text('prenom', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('cin', 'CIN') !!}
  {!! Form::text('cin', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<div class="form-group col-6 ">
  {!! Form::label('permis', 'Permis') !!}
  {!! Form::text('permis', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('cnss', 'Cnss') !!}
  {!! Form::text('cnss', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<div class="form-group col-6 ">
  {!! Form::label('dossier', 'Dossier') !!}
  {!! Form::text('dossier', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<div class="form-group col-6 ">
  {!! Form::label('tele', 'Tel') !!}
  {!! Form::text('tele', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('address', 'Address') !!}
  {!! Form::text('address', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>



<button class="btn btn-success ml-3" type="submit">Ajout</button>

{!! Form::close() !!}

