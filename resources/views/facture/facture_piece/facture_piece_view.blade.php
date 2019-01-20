@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">

                    <span class="ml-5 ">Factures Maintenance</span>
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                    <a class="al btn btn-outline-secondary mr-3 float-right" href="/facture">Factures </a>
                    @if(Request::path() == "facture/piece")
                        <a class="al btn btn-outline-secondary mr-3 float-right" id="add-piece">Créer Nouveau Facture Maintenance</a>
                        <span class="ml-5 "> N° Facture Maintenance : {{$countPiece}}</span>
                    @endif

                    <span class="ml-5 ">Totale Montant :<strong> {{$totalMontant}} DH</strong></span>


                    {!! Form::open(['url' => 'facture/piece/search' , 'class' => 'search-form ml-5 mt-3'] ) !!}
                    {{Form::text('num_facture','',['class'=> 'search-box' , 'placeholder' => 'N° Facture'])}}
                    {{Form::submit('Search',['class' => 'search-button ml-2 floa' ,'id' => 'search-button'])}}
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
                            <th>N° Facture</th>
                            <th>Designation</th>
                            <th>Matricule</th>
                            <th>Date</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Montant</th>
                            <th id="case-edit"></th>
                            <th id="case-delete"></th>
                        </thead>
                        <tbody>  
                             @foreach($factures as $facture)
                                    <tr index="{{$loop->index}}" id_attr="{{$facture->id}}">
                                        <td>{{$facture->num_facture}}</td>                                
                                        <td>{{$facture->designation}}</td>  
                                         <td bus_id="{{$facture->bus_id}}" ><a href="{{route('bus.info' , $facture->bus_id) }}">{{ $facture->buses->matricule}}</a></td>                     
                                        <td>{{$facture->date}}</td>                       
                                        <td>{{$facture->pu}}</td> 
                                        <td>{{$facture->nu}}</td>                                   
                                        <td>{{$facture->nu*$facture->pu}}</td>   
                                        <td><button class="btn btn-primary edit" edit_id="{{$facture->id}}">Edit</button></td>     
                                        <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$facture->id}}">Delete</button>

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
                                                <button type="button" class="btn btn-danger delete" delete_id="{{$facture->id}}" data-dismiss="modal">Delete</button>
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
                    {{$factures->links()}}
                    </div>
                </section>
            </div>
        </div>
    </div>

<!-- JS -->
<script type="text/javascript" src="{{ asset('js\facture\facture_piece\facture_piece.js') }} "></script>
@endsection