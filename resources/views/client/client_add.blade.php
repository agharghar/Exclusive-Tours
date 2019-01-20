
				{!! Form::model(client::class, ['route' => 'client.add']) !!}

				    <div class="form-group col-6">
				      {!! Form::label('desigranion', 'Desigranion') !!}
				      {!! Form::text('desigranion', '', ['class' => 'form-control' ,'required' => 'required']) !!}
				    </div>

				    <button class="btn btn-success ml-3" type="submit">Ajout</button>

			  	{!! Form::close() !!}

