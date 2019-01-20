@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bus/bus_info.css') }}">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">

                    @php
                        $totalVisite = 0 ;
                        $totalService = 0 ;
                        $totalMaintenance = 0 ;
                        $totalTour = 0;
                        $totalKmFacture = 0 ;
                        $totalKmTrajet = 0 ;
                        $totalLavage = 0 ;
                        $totalAutoroute = 0 ;
                        $totalGazoile = 0 ;
                        $totalFraisGazoile = 0 ;
                        $totalFrais = 0 ;
                        $totalPiece = 0 ;
                        $nombreTrajet = [];
                        $trajets = [] ;
                    @endphp


                    @foreach($bus->bills as $bill)

                        @php($totalKmFacture += $bill->km)
                        @php($totalLavage += $bill->peage_lavage)
                        @php($totalAutoroute += $bill->peage_autoroute)
                        @php($totalGazoile += $bill->pu*$bill->litrage)

                    @endforeach
                        @php($totalFraisGazoile = $totalGazoile+$totalAutoroute+$totalLavage)

                    <span class="ml-5 ">Matricule :</span>
                    <span class="mr-5">{{$bus->matricule}}</span>

                    @if(is_object($bus->chauffeur))
                    <span class="mr-5">Chauffeur Responsable : <strong><a href="{{route('chauffeur.info',['id' => $bus->chauffeur->id])}}">{{$bus->chauffeur->nom.' '.$bus->chauffeur->prenom}}</a></strong></span >
                    @endif


                    <!-- Total visite technique -->
                    @foreach($bus->facture_visites as $facture)
                        @php($totalVisite += $facture->montant )
                    @endforeach
                    <span >Totale Facture Visite Technique :</span>
                    <span class="mr-5"><strong>{{$totalVisite}} DH </strong></span> 


                    <!-- Total visite technique -->
                    @foreach($bus->facture_pieces as $facture)
                        @php($totalPiece += $facture->montant )
                    @endforeach
                    <span >Totale Facture Visite Technique :</span>
                    <span class="mr-5"><strong>{{$totalPiece}} DH </strong></span>


                    <!-- TOtale Piece -->
                    @foreach($bus->facture_pieces as $facture)
                        @php($totalMaintenance += $facture->nu * $facture->pu )

                    @endforeach
                    <span >Totale Facture Maintenance :</span>
                    <span class="mr-5"><strong>{{$totalMaintenance}} DH </strong> </span><br>

                    <!-- Totale Tour --> 
                    @foreach($bus->tour as $tour)
                                @php($totalTour++) 
                    @endforeach
                    <span class="ml-5 ">N° Tour : </span>
                    <span ><strong>{{$totalTour}} </strong></span>

                    <!-- Total Trajet -->
                    @foreach($bus->tour as $tour)
                           
                               @if(!in_array($tour->trajet_id,$nombreTrajet))
                                    @php(array_push($nombreTrajet,$tour->trajet_id))
                                @endif
                          
                    @endforeach
                    <span class="ml-5 ">Total Trajet :</span>
                    <span ><strong>{{count($nombreTrajet)}}</strong></span>

                    <!-- Total Km -->
                    @foreach($bus->tour as $tour)
                            @php($totalKmTrajet += $tour->trajet->km )
 
                    @endforeach
                    <span class="ml-5 ">Total Km(Trajet) :</span>
                    <span ><strong>{{$totalKmTrajet}} KM</strong></span>
                    <span class="ml-5 ">Total Km(Facture Gazoile) :</span>
                    <span ><strong>{{$totalKmFacture}} KM</strong></span>

                    <span class="ml-5 ">Date Fin Assurance : </span>
                    <span class="mr-5 text-danger"><strong>{{$bus->date_fin}}</strong></span>
                 

                    <span class="ml-5 ">Total Gazoile :</span>
                    <span ><strong>{{$totalGazoile}} DH</strong></span><br>  

                    <span class="ml-5 ">Total Lavage :</span>
                    <span ><strong>{{$totalLavage}} DH</strong></span> 

                    <span class="ml-5 ">Total Auto-Route :</span>
                    <span ><strong>{{$totalAutoroute}} DH</strong></span>  

                    <span class="ml-5 ">Total Frais Facture Gazoile :</span>
                    <span ><strong>{{$totalFraisGazoile}} DH</strong></span>

                    @php($totalFrais = $totalFraisGazoile + $totalMaintenance + $totalVisite + $totalPiece)
                    <span class="ml-5 ">Total Frais  :</span>
                    <span ><strong>{{$totalFrais}} DH</strong></span>

                    {!! Form::open(['url' => 'bus/search_date' , 'class' => 'search-form ml-5 mt-3'] ) !!}
                    {{Form::date('date','',['class'=> 'search-box' , 'placeholder' => 'Date'])}}
                    {{Form::submit('Search',['class' => 'search-button ml-2' ,'id' => 'search-button'])}}
                    {!! Form::close() !!}

                </div>

                <div class="card-body mx-auto" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table bus_id="{{$bus->id}}">
                        <thead>
                            <th>From</th>
                            <th>To</th>
                            <th>Km</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                                    @foreach($bus->tour as $t)
                                <tr class="list-groupe">
                                    <td>
                                        {{$t->trajet->from}}
                                    </td>
                                    <td>{{$t->trajet->to}}</td>
                                    <td>{{$t->trajet->km}}</td>
                                    <td>{{$t->date->date}}</td>                                    
                                </tr>
                                    @endforeach
                        </tbody>
                        <tfoot>
                            <nav aria-label="Page navigation example">
                              <ul class="pagination">
                                <li class="page-item">
                                  <a class="page-link previous-page" href="javascript:void(0)" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                <li class="page-item current-page active"><a class="page-link" href="javascript:void(0)">1</a></li>
                              </ul>
                            </nav>
                        </tfoot>

                    </table>
                    <table class="float-left mr-2">
                        <thead>
                            <th>From</th>
                            <th>To</th>

                        </thead>
                        <tbody>

                                    @foreach($bus->tour as $tour)
                            <tr>
                                            
                                               @if(!in_array($tour->trajet->id , $trajets))
                                                    @php(array_push($trajets , $tour->trajet->id))
                                                <td>{{$tour->trajet->from}}</td>
                                                <td>{{$tour->trajet->to}}</td>
                                                @endif
                            </tr>
                                    @endforeach
                        </tbody>

                    </table>



                </div>
        </div>
    </div>

<!--  javascript  -->
<script type="text/javascript" src="{{ asset('js/bus/bus_info.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bus/paginate.js') }}"></script>
<!--  javascript  -->


@endsection