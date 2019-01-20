@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <span class="ml-5 ">trajet</span>
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                @if(Request::path() == "trajet")
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="add-trajet">Créer Nouveau Trajet</a>
                @endif
                    <span class="ml-5 ">Total Trajet : {{$countTrajet}}</span>

                    {!! Form::open(['url' => 'trajet/search' , 'class' => 'search-form ml-5'] ) !!}
                    {{Form::text('from','',['class'=> 'search-box' , 'placeholder' => 'From'])}}
                    {{Form::text('to','',['class'=> 'search-box' , 'placeholder' => 'To'])}}
                    {{Form::submit('Search',['class' => 'search-button ml-2' ,'id' => 'search-button'])}}
                    {!! Form::close() !!}
                </div>

                <div class="card-body mx-auto" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <section class="table-index">
                <input type="input" hidden disabled="disabled" name="hidden">
                <table class="table table-hover">
                    <thead>
                        <th>From</th>
                        <th>To</th>
                        <th>Km</th>
                        <th id="case-edit"></th>
                        <th id="case-delete"></th>
                    </thead>
                    <tbody>  
                         @foreach($trajets as $trajet)
                                <tr index="{{$loop->index}}" id_attr="{{$trajet->id}}">
                                    <td>{{$trajet->from}}</td>                      
                                    <td>{{$trajet->to}}</td>                      
                                    <td>{{$trajet->km}}</td>
                                    <td><button class="btn btn-primary edit" edit_id="{{$trajet->id}}">Edit</button></td>     
                                    <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$trajet->id}}">Delete</button> 
                                    <!-- ---------------------------------------------------------- >

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            Voulez Vous Vraiment Supprimer Cette Element .
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger delete" id="d"delete_id="{{$trajet->id}}" data-dismiss="modal">Delete</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>                                 



                                    <!-- ---------------------------------------------------------- -->

                                    </td>
                                        
                                </tr>
                            @endforeach    
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <div class="w-25 mx-auto mt-5">
                {{$trajets->links()}}
                </div>
                </section>    
            </div>
        </div>
    </div>

    <!-- JS -->
<script type="text/javascript" src="{{ asset('js\trajet\trajet.js') }} "></script>

@endsection