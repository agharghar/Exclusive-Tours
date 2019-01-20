<link rel="stylesheet" type="text/css" href="{{ asset('css/facture/facture_visite/add.css') }}">

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
{!! Form::model(facture_visite::class, ['route' => 'facture.visite.add']) !!}

<div class="form-group col-6 ">
  {!! Form::label('num_facture', 'N° Facture') !!}
  {!! Form::text('num_facture', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6">
  {!! Form::label('designation', 'Designation') !!}
  {!! Form::text('designation', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('date', 'date') !!}
  {!! Form::date('date', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6">
  {!! Form::label('montant', 'Montant') !!}
  {!! Form::text('montant', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6">
  @if($last)
    {!! Form::label('Bus Matricule ', 'Bus') !!}
    {!! Form::select('bus_id', $numeroBus , ['class' => 'form-control']) !!} 
  @else
    <div class="btn btn-danger">
            <div>                   
                <span>Y'a pas de Bus disponible</span>
            </div>
    </div>
  @endif
</div>


<button class="btn btn-success ml-3" type="submit">Ajout</button>

{!! Form::close() !!}
