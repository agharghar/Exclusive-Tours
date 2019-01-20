@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">

                    <a class="al btn btn-outline-secondary mr-3 float-right"  href="{{route('fournisseur.index')}}">Fournisseurs</a>
                    <span class="ml-5">Designation : <strong>{{$fournisseur->nomFournisseur}}</strong></span>
                    @php($totalFactures = 0)
                    @php($nom_facture = 0)
                        @foreach($fournisseur->facture_gazoiles as $facture_gazoile)
                            @php($nom_facture++)
                            @foreach($facture_gazoile->bills as $bill)
                                @php($totalFactures += ($bill->pu*$bill->litrage)+$bill->peage_lavage + $bill->peage_autoroute )
                            @endforeach
                        @endforeach                   
                    <span class="ml-5">Total Factures Fournisseur : <strong>{{$totalFactures}} DH</strong></span>
                    <span class="ml-5">Nombre De Factures : <strong>{{$nom_facture}}</strong></span>
        
                </div>

                <div class="card-body mx-auto" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <th>N° Facture</th>
                            <th>Designation Facture</th>
                            <th>montant</th>

                        </thead>
                        <tbody>
                            @foreach($fournisseur->facture_gazoiles as $facture)
                                @php($montant = 0)
                                <tr class="list-groupe">
                                    <td>
                                        <a href="{{route('facture.gazoile.info',['id' => $facture->id])}}">
                                            {{$facture->num_facture}}
                                        </a>
                                    </td>
                                    <td>{{$facture->designation}}</td>
                                    @foreach($facture->bills as $bill)
                                        @php($montant += ($bill->pu*$bill->litrage)+$bill->peage_lavage+$bill->peage_autoroute )
                                    @endforeach
                                    <td>{{$montant}}</td> 
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

                 </div>
        </div>
    </div>



 <script type="text/javascript" src="{{asset('js/fournisseur/paginate.js')}}"></script>


    

@endsection