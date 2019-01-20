<link rel="stylesheet" type="text/css" href="{{ asset('css/tour/add.css') }}">

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
{!! Form::model(tour::class, ['route' => 'tour.add']) !!}


    <div class="form-group col-6">
      @if($lastBus)
        {!! Form::label('bus_id', 'Bus Matricule ') !!}
        {!! Form::select('bus_id', $numeroBus , ['class' => 'form-control' ,'required' => 'required']) !!} 
      @else
        <div class="btn btn-danger">
                <div>                   
                    <span>Y'a pas de Bus disponible</span>
                </div>
        </div>
      @endif
    </div>

<div class="form-group col-6">
  @if($firstTrajet)
        {!! Form::label('trajet_id', 'Trajets') !!}
        {!! Form::select('trajet_id', $resultTrajet , ['class' => 'form-control' ,'required' => 'required']) !!} 
      @else
  	<div class="btn btn-danger">
  			<div>	  				
 	  		<span>Y'a pas de Trajet disponible</span>
  			</div>
  	</div>
  @endif
</div>

 <div class="form-group col-6">
          {!! Form::label('date', 'Date') !!}
          {!! Form::date('date', '', ['class' => 'form-control' ,'required' => 'required']) !!}
        </div>

<button class="btn btn-success ml-3" type="submit">Ajout</button>

{!! Form::close() !!}
