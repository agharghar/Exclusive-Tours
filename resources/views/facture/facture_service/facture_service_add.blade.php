<link rel="stylesheet" type="text/css" href="{{ asset('css/facture/facture_service/add.css') }}">

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
{!! Form::model(facture_service::class, ['route' => 'facture.service.add' ]) !!}

<div class="form-group col-6 ">
  {!! Form::label('num_facture', 'N° Facture') !!}
  {!! Form::text('num_facture', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6">
  {!! Form::label('designation', 'Designation') !!}
  {!! Form::text('designation', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>                  

 <div class="form-group col-6">
  {!! Form::label('montant', 'Montant') !!}
  {!! Form::text('montant', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('date', 'date') !!}
  {!! Form::date('date', '', ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<div class="form-group col-6 ">
  {!! Form::label('etat', 'Etat De Facture : ') !!}
  <span>Payé</span>
  {!! Form::radio('etat', '1' ) !!}
  <span>Non Payé</span>
  {!! Form::radio('etat', '0',['checked']) !!}
</div>

<div class="form-group col-6">
  @if($last)
    {!! Form::label('client', 'Clients') !!}
    {!! Form::select('client_id', $numeroClient , ['class' => 'form-control' ,'required' => 'required']) !!} 
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
