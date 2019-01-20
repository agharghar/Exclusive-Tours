<link rel="stylesheet" type="text/css" href="{{ asset('css/trajet/add.css') }}">

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
{!! Form::model(trajet::class, ['route' => 'trajet.add' ,'required' => 'required']) !!}


<div class="form-group col-6">
  {!! Form::label('from', 'From') !!}
  {!! Form::text('from', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<div class="form-group col-6">
  {!! Form::label('to', 'To') !!}
  {!! Form::text('to', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6">
  {!! Form::label('km', 'N° Km') !!}
  {!! Form::text('km', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>


<button class="btn btn-success ml-3" type="submit">Ajout</button>
