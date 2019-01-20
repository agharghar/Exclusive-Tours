@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/bus/bus_info.css')}}">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">

                    <span class="ml-5">Nom : </span>
                    <span class=" "><strong>{{$chauffeur->nom}}</strong></span>
                    <span class="ml-5">Prenom : </span>
                    <span class=" "><strong>{{$chauffeur->prenom}}</strong></span>
                    <span class="ml-5">Cin : </span>
                    <span class=" "><strong>{{$chauffeur->cin}}</strong></span>
                    <span class="ml-5">N° Permis : </span>
                    <span class=" "><strong>{{$chauffeur->permis}}</strong></span>
                    @can('view',App\Role::class)
                         @php
                            $totalVisite = 0 ;
                            $totalPiece = 0 ;
                            $totalKm = 0 ;
                            $totalTour =0;
                            $nombreTrajet = [];
                            $Trajets = [];

                            
                 
                        @endphp


                        @foreach($chauffeur->buses as $bus)
                            @foreach($bus->facture_visites as $facture)
                                @php
                                     $totalVisite =+ $facture->montant ;
                         
                                @endphp
                            @endforeach
                        @endforeach
                    <span class="ml-5 ">Total Facture Visite Technique :</span>
                    <span ><strong>{{$totalVisite}} DH</strong></span>

                        @foreach($chauffeur->buses as $bus)
                            @foreach($bus->facture_pieces as $facture)
                                @php
                                     $totalPiece =+ $facture->pu * $facture->nu ;
                         
                                @endphp
                            @endforeach
                        @endforeach
                    <span class="ml-5 ">Total Facture Maintenance  :</span>
                    <span ><strong>{{$totalPiece}} DH</strong></span>




                        @foreach($chauffeur->buses as $bus)
                            @foreach($bus->tour as $tour)
                                    @php
                                        $totalTour++ ;
                                    @endphp
                            @endforeach
                        @endforeach
                    <span class="ml-5 ">N° Tour :</span>
                    <span ><strong>{{$totalTour}} </strong></span>

                        @foreach($chauffeur->buses as $bus)
                            @foreach($bus->tour as $tour)
                                    @php
                                        $totalKm += $tour->trajet->km ;
                                    @endphp
                            @endforeach
                        @endforeach
                    <span class="ml-5 ">Total Km :</span>
                    <span ><strong>{{$totalKm}} KM</strong></span>

                        @foreach($chauffeur->buses as $bus)
                            @foreach($bus->tour as $tour)
                                    @php
                                       if(!in_array($tour->trajet_id,$nombreTrajet)){
                                            array_push($nombreTrajet,$tour->trajet_id);
                                        }
                                    @endphp
                            @endforeach
                        @endforeach

                    <span class="ml-5 ">Total Trajet :</span>
                    <span ><strong>{{count($nombreTrajet)}}</strong></span>
                    <span class="ml-5 ">Total Jour Repot : <strong>{{$totalRepot}}</strong></span>


                    @endCan

                    {!! Form::open(['url' => 'chauffeur/search_date' , 'class' => 'search-form ml-5 mt-3'] ) !!}
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

                    <table chauffeur_id="{{$chauffeur->id}}">
                        <thead>
                            <th>Bus Matricule</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Km</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @foreach($chauffeur->buses as $bus)
                                    @foreach($bus->tour as $t)
                                <tr class="list-groupe">
                                    <td><a href="{{route('bus.info',['id' => $bus->id])}}">{{$bus->matricule}}</a></td>                                                            
                                        <td>
                                            {{$t->trajet->from}}
                                        </td>
                                        <td>{{$t->trajet->to}}</td>
                                        <td>{{$t->trajet->km}}</td>
                                        <td>{{$t->date->date}}</td>
                                </tr>
                                    @endforeach
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

                                @foreach($chauffeur->buses as $bus)
                                    @foreach($bus->tour as $tour)
                            <tr>
                                @if(!in_array($tour->trajet->id , $Trajets ))
                                @php(array_push($Trajets , $tour->trajet->id))
                                <td>{{$tour->trajet->from}}</td>
                                <td>{{$tour->trajet->to}}</td>
                                @endif
                            </tr>
                                    @endforeach
                                @endforeach
                        </tbody>

                    </table>


                 </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/chauffeur/chauffeur_info.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/chauffeur/paginate.js')}}"></script>

@endsection
