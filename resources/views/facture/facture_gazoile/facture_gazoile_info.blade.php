@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <span class="ml-5 ">N° Facture  :<strong> {{$bills->first()->facture->num_facture}}</strong></span>
                    <span class="ml-5 ">N° Facture  :<strong> {{$bills->count()}}</strong></span>

                    <span class="ml-5 ">Total Lavage   :<strong> {{$lavage}} DH</strong></span>
                    <span class="ml-5 ">Total Autoroute :<strong> {{$autoroute}} DH</strong></span>
                    <span class="ml-5 ">Total Gazoile :<strong> {{$gazoile}} DH</strong></span>
                    <span class="ml-5 ">Total Montant :<strong> {{$total}} DH</strong></span>
                    <a class="al btn btn-outline-secondary mr-3 mt-2 float-right" id="home" href="{{route('home')}}">Home</a>
                    <a class="al btn btn-outline-secondary mr-3 mt-2 float-right" href="{{route('facture')}}">Factures </a>
                    <a class="al btn btn-outline-secondary mr-3 mt-2 float-right" href="{{route('facture.gazoile')}}">Factures Gazoile </a>



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
                            <th>Date</th>
                            <th>Numero Carte</th>
                            <th>Matricule</th>
                            <th>Km</th>
                            <th>Litrage</th>
                            <th>Prix Unitaire</th>
                            <th>Lavage</th>
                            <th>Peage Autoroute</th>
                            <th>Montant</th>
                            <th id="case-edit"></th>
                            <th id="case-delete"></th>
                        </thead>
                        <tbody>  
                             @foreach($bills as $bill)
                                    <tr index="{{$loop->index}}" id_attr="{{$bill->id}}">
                                    
                                    <td>{{$bill->date}}</td>  
                                    <td>{{$bill->num_carte}}</td>  
                                    <td bus_id="{{$bill->bus_id}}"><a href="{{route('bus.info',['id' => $bill->bus->id ])}}">{{$bill->bus->matricule}}</a></td>  
                                    <td>{{$bill->km}}</td>  
                                    <td>{{$bill->litrage}}</td>  
                                    <td>{{$bill->pu}}</td>                                      
                                    <td>{{$bill->peage_lavage}}</td>
                                    <td>{{$bill->peage_autoroute}}</td>
                                    <td>{{($bill->pu*$bill->litrage)+$bill->peage_autoroute+$bill->peage_lavage}}</td>
                                    <td><button class="btn btn-primary edit" edit_id="{{$bill->id}}">Edit</button></td>     
                                    <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$bill->id}}">Delete</button>

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
                                                <button type="button" class="btn btn-danger delete" delete_id="{{$bill->id}}" data-dismiss="modal">Delete</button>
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
                    {{$bills->links()}}
                    </div>
                </section>
            </div>
        </div>
    </div>

    
<script type="text/javascript" src="{{ asset('js/facture/facture_gazoile/facture_gazoile_info.js') }} "></script>

@endsection