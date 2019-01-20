@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="ml-5 "> Bus </span>
                  <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                 @if(Request::path() == "bus")
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="add-bus">Créer Nouveau Bus</a>
                    <span class="ml-5 "> Total Bus : {{$countBus}}</span>
                    <span class="ml-5 "> Total Gazoile : <strong>{{$totalGazoile}}</strong> DH</span>
                    <span class="ml-5 "> Total Lavage : <strong>{{$totalLavage}}</strong> DH</span>
                    <span class="ml-5 "> Total Auto-Route : <strong>{{$totalAutoroute}}</strong> DH</span>
                    <span class="ml-5 "> Total Frais Facture Gazoile: <strong>{{$totalFraisGazoile}}</strong> DH</span>
                    <span class="ml-5 "> Total Frais Facture Visite: <strong>{{$totalVisite}}</strong> DH</span>
                    <span class="ml-5 "> Total Frais Facture Maintenance: <strong>{{$totalPiece}}</strong> DH</span>
                    <span class="ml-5 "> Total Frais : <strong>{{$totalFrais}}</strong> DH</span>


                    

                @endif
                {!! Form::open(['url' => 'bus/search' , 'class' => 'search-form ml-5'] ) !!}
                {{Form::text('matricule','',['class'=> 'search-box' , 'placeholder' => 'Matricule'])}}
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
                                    <th>Matricule</th>
                                    <th>N° Carte Grisse</th>
                                    <th>PV</th>
                                    <th>Autorisation N° Dossier </th>
                                    <th>N° Autorisation</th>
                                    <th>Assurance N° D'ordre</th>
                                    <th>Assurance Date debut</th>
                                    <th>Assurance Date Fin</th>
                                    <th id="case-edit"></th>
                                    <th id="case-delete"></th>
                                <tr>

                            </thead>
                            <tbody>
                                @foreach($buses as $bus)
                                    <tr index="{{$loop->index}}" id_attr="{{$bus->id}}">
                                        <td><a href="{{ route('bus.info' ,  $bus->id ) }}">{{$bus->matricule}}</a></td>                                                                     
                                        <td>{{$bus->num_carte_grisse}}</td>                                    
                                        <td>{{$bus->pv}}</td>                                    
                                        <td>{{$bus->autorisation_num_dossier}}</td>   
                                        <td>{{$bus->autorisation_num}}</td>                                    
                                        <td>{{$bus->assurance_num_odre}}</td> 
                                        <td>{{$bus->date_debut}}</td>                                    
                                        <td>{{$bus->date_fin}}</td>
                                        <td><button class="btn btn-primary edit" edit_id="{{$bus->id}}">Edit</button></td>     
                                        <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$bus->id}}">Delete</button>


                                        <!-- ---------------------------------------------------------- >

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog"  aria-labelledby="deleteLabel" aria-hidden="true" >
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
                                                <button type="button" class="btn btn-danger delete" delete_id="{{$bus->id}}" data-dismiss="modal">Delete</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>                                 



                                        <!-- ---------------------------------------------------------- -->

                                        </td>                             
                                    </tr> 

                                @endforeach
                                </tr> 
                            </tbody>

                        </table>
                        <div class="clearfix"></div>
                        <div class="w-25 mx-auto mt-5">
                            {{$buses->links()}}                
                        </div>
                    </section>
                </div>


            </div>
        </div>
    </div>


<script type="text/javascript" src="{{ asset('js/bus/bus.js') }}"></script>



@endsection