@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">

                    <span class="ml-5 mt-3 d-inline-block mt-2">Factures Gazoile</span>
                    <a class="al btn btn-outline-secondary mr-3 mt-2 float-right" id="home" href="/home">Home</a>
                    <a class="al btn btn-outline-secondary mr-3 mt-2 float-right" href="/facture">Factures </a>
                    @if(Request::path() == "facture/gazoile")
                        <a class="al btn btn-outline-secondary mr-3 mt-2 float-right" id="add-gazoile">Créer Nouveau Facture Gazoile</a>
                        <span class="ml-5 "> N° Facture Gazoile : {{$countGazoile}}</span>
                    @endif

                    <span class="ml-5 ">Totale Lavage:<strong> {{$lavage}} DH</strong></span>
                    <span class="ml-5 ">Totale Auto-Route:<strong> {{$autoroute}} DH</strong></span>
                    <span class="ml-5 ">Totale Gazoile:<strong> {{$gazoile}} DH</strong></span>
                    <span class="ml-5 ">Totale Des Montants :<strong> {{$total}} DH</strong></span>

                    {!! Form::open(['url' => 'facture/gazoile/search' , 'class' => 'search-form ml-5 mt-3'] ) !!}
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
                            <th>Fournisseur</th>
                            <th>Montant Facture</th>
                            <th id="case-edit"></th>
                            <th id="case-delete"></th>
                        </thead>
                        <tbody>  
                             @foreach($factures as $facture)
                                    @php($montant = 0 )
                                    <tr index="{{$loop->index}}" id_attr="{{$facture->id}}">
                                    <td><a href="{{route('facture.gazoile.info',['id' => $facture->id])}}">{{$facture->num_facture}}</a></td>          
                                    <td>{{$facture->designation}}</td>  
                                    
                                    @foreach($facture->bills as  $val) 
                                        @php($montant += ($val->pu * $val->litrage)+$val->peage_autoroute+$val->peage_lavage )
                                    @endforeach
                                    <td fournisseur_id="{{$facture->fournisseur_id}}"><a href="{{route('fournisseur.info' , ['id' => $facture->fournisseur_id]) }}">
                                        {{$facture->fournisseur['nomFournisseur']}}
                                        </a>
                                    <td>{{$montant}}</td>
                                    </td>
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

    
    <script type="text/javascript" src="{{ asset('js\facture\facture_gazoile\facture_gazoile.js') }} "></script>

@endsection