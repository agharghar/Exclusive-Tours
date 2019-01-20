@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/standard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/facture/facture.css') }}">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  ">
                  <span class="ml-5 "> Factures </span>
                  <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                </div>

                <div class="card-body centre" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="centre">
                        
                    <a href="{{ route('facture.visite') }}" class="btn btn-dark facture-btn"  >Facture Visite Technique</a>
                    <a href="{{ route('facture.gazoile') }}" class="btn btn-dark facture-btn"  >Facture Gazoile</a>
                    <a href="{{ route('facture.service') }}" class="btn btn-dark facture-btn"  >Facture Service</a>
                    <a href="{{ route('facture.piece') }}" class="btn btn-dark facture-btn"  >Facture Maintenance</a>

                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection