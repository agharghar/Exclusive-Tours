@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/standard.css') }}">



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="ml-5 "> Chauffeurs</span>

                    <span class="ml-5 ">N° Repot :</span>
                    <span ><strong>{{$repotsCount}} </strong></span>
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="{{route('chauffeur.index')}}">Chauffeurs</a>
                    @if(Request::path() == "chauffeur/repot")
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="add-repot">Nouveau Repot</a>
                    <span class="ml-5 ">Total Jour Repot : <strong>{{$totalRepot}}</strong></span>
                    @endif

                    {!! Form::open(['url' => '/chauffeur/search_repot' , 'class' => 'search-form ml-5'] ) !!}
                    {{Form::text('num_chaufffeur','',['class'=> 'search-box' , 'placeholder' => '#'])}}
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
                        
                    <table class="table table-hover">
                    <input type="input" hidden disabled="disabled" name="hidden"> 
                        <thead>
                            <tr>
                                <th># Chauffeur</th>
                                <th>Date Debut</th>
                                <th>Date Fin</th>
                                <th>Nombre De Jour</th>
                                <th id="case-edit"></th >
                                <th id="case-delete"></th >
                            <tr>

                        </thead>
                        <tbody>
                            @foreach($chauffeurs as $chauffeur)
                                @foreach($chauffeur->repots as $repot)

                                    <tr index="{{$loop->index}}" id_attr="{{$repot->id}}" chauffeur_id="{{$chauffeur->id}}">
                                        <td chauffeur_id="{{$chauffeur->id}}" class="chauffeur">
                                            <a href="{{ route('chauffeur.info' , ['id' => $chauffeur->id] ) }}">
                                                {{$chauffeur->num_chauffeur}}-{{$chauffeur->nom}} {{$chauffeur->prenom}}
                                            </a>
                                        </td>
                                        <td>{{$repot->date_debut}}</td>  
                                        <td>{{$repot->date_fin }}</td>    
                                        <td>{{$repot->nombre_jour}}</td>                                    
                                        <td><button class="btn btn-primary edit" edit_id="{{$repot->id}}">Edit</button></td>     
                                        <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$repot->id}}">Delete</button>

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
                                                <button type="button" class="btn btn-danger delete" delete_id="{{$repot->id}}" data-dismiss="modal">Delete</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>                                 



                                        <!-- ---------------------------------------------------------- -->    

                                        </td>                                   

                                    </tr> 
                                @endforeach    
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

<script type="text/javascript" src="{{ asset('js/chauffeur/repot/repotAll.js') }}"></script>
@endsection

