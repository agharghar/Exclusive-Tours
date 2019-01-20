@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
<script type="text/javascript" src="{{ asset('js/fournisseur/fournisseur.js') }}"></script>



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="ml-5 "> Fournisseur</span>
                  <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                    @if(Request::path() == "fournisseur")
                        <a class="al btn btn-outline-secondary mr-3 float-right" id="add-fournisseur">Créer Nouveau Fournisseur</a>
                    @endif
                    <span class="ml-5 "> N° Fornisseur : <strong>{{$nbFornisseur}}</strong></span>

                    <span class="ml-5 "> Total Des Factures Fournisseur : <strong>{{$total_facture}} DH</strong></span>

                    {!! Form::open(['url' => 'fournisseur/search' , 'class' => 'search-form ml-5'] ) !!}
                    {{Form::text('nomFournisseur','',['class'=> 'search-box' , 'placeholder' => 'Designation'])}}
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
                                <th>Designation</th>
                                <th id="case-edit"></th>
                                <th id="case-delete"></th>
                            <tr>

                        </thead>
                        <tbody>
                            @foreach($fournisseurs as $fournisseur)
                                <tr index="{{$loop->index}}" id_attr="{{$fournisseur->id}}">
                                    <td><a href="{{route('fournisseur.info',['id' => $fournisseur->id])}}">{{$fournisseur->nomFournisseur}}</a></td>
                                    <td><button class="btn btn-primary edit" edit_id="{{$fournisseur->id}}">Edit</button></td>     
                                    <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$fournisseur->id}}">Delete</button>


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
                                            <button type="button" class="btn btn-danger delete" delete_id="{{$fournisseur->id}}" data-dismiss="modal">Delete</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>                                 



                                    <!-- ---------------------------------------------------------- -->                                    
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>           
                    <div class="clearfix"></div>
                    <div class="w-25 mx-auto mt-5">
                        {{$fournisseurs->links()}}                
                    </div>
                    </section>
                </div>


            </div>
        </div>
    </div>

@endsection