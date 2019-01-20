@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/standard.css') }}">



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="ml-5 "> Chauffeurs</span>
                  <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                    @if(Request::path() == "chauffeur")
                        <a class="al btn btn-outline-secondary mr-3 float-right" id="add-chauffeur">Créer Nouveau Chauffeur</a>
                    @endif
                    <span class="ml-5 "> Total Chauffeurs : {{$countChauffeur}}</span>
                    {!! Form::open(['url' => 'chauffeur/search' , 'class' => 'search-form ml-5'] ) !!}
                    {{Form::text('num_chaufffeur','',['class'=> 'search-box' , 'placeholder' => '#'])}}
                    {{Form::submit('Search',['class' => 'search-button ml-2' ,'id' => 'search-button'])}}
                    {!! Form::close() !!}

                    <a href="{{route('chauffeur.repotAll')}}"class="al btn btn-outline-secondary mr-3 float-right" id="add-chauffeur">Chauffeurs Repot</a>
                </div>

                <div class="card-body mx-auto" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="table-index">
                        
                    <table class="table table-hover">
                    <input type="input" hidden disabled="disabled" name="hidden"> 
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>Cin</th>
                                <th>N° Permis</th>
                                <th>Address</th>
                                <th>N° Cnss</th>
                                <th>N° Dossier</th>
                                <th>Télephone</th>
                                <th id="case-edit"></th >
                                <th id="case-delete"></th >
                            <tr>

                        </thead>
                        <tbody>
                            @foreach($chauffeurs as $chauffeur)
                                <tr index="{{$loop->index}}" id_attr="{{$chauffeur->id}}">
                                    <td>{{$chauffeur->num_chauffeur}}</td>                                    
                                    <td><a href="{{ route('chauffeur.info' , ['id' => $chauffeur->id] ) }}">{{$chauffeur->prenom}}</a></td>                                    
                                    <td><a href="{{ route('chauffeur.info' , ['id' => $chauffeur->id] ) }}">{{$chauffeur->nom}}</a></td>                                    
                                    <td>{{$chauffeur->cin}}</td>                                    
                                    <td>{{$chauffeur->permis}}</td>                                    
                                    <td>{{$chauffeur->address}}</td>                                    
                                    <td>{{$chauffeur->cnss}}</td>                                    
                                    <td>{{$chauffeur->dossier}}</td>                                    
                                    <td>{{$chauffeur->tele}}</td>
                                    <td><button class="btn btn-primary edit" edit_id="{{$chauffeur->id}}">Edit</button></td>     
                                    <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$chauffeur->id}}">Delete</button>

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
                                            <button type="button" class="btn btn-danger delete" delete_id="{{$chauffeur->id}}" data-dismiss="modal">Delete</button>
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
                        {{$chauffeurs->links()}}                
                    </div>
                    </section>
                </div>


            </div>
        </div>
    </div>

<script type="text/javascript" src="{{ asset('js//chauffeur/chauffeur.js') }}"></script>
@endsection