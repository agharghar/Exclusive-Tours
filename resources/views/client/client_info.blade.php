@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">

                    <span class="ml-5">Designation : <strong>{{$client->designation}}</strong></span>
                    @php($totalFactures = 0)
                    @foreach($client->facture_services as $facture)
                        @php($totalFactures += $facture->montant)
                    @endforeach                    
                    <span class="ml-5">Total Factures Client : <strong>{{$totalFactures}} DH</strong></span>
        
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
                            <th>Date Facture</th>
                            <th>montant</th>

                        </thead>
                        <tbody>
                            @foreach($client->facture_services as $facture)
                                <tr class="list-groupe">
                                    <td >
                                            {{$facture->num_facture}}
                                    </td>
                                    <td>{{$facture->designation}}</td>
                                    <td>{{$facture->date}}</td>
                                    <td>{{$facture->montant}}</td>
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
<script type="text/javascript" src="{{asset('js\client\paginate.js')}}"></script>
    

@endsection