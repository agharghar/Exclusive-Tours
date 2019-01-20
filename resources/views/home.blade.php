@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  ">
                  <span> Home </span>
                </div>

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                   <div class="centre">
                       
                    <a href="\chauffeur" class="btn btn-dark home-btn" id="chauffeurs" >Chauffeurs</a>
                    <a href="\bus" class="btn btn-dark home-btn" id="vehicules" >Véhicules</a>
                    <a href="\trajet" class="btn btn-dark home-btn" id="trajet" >Trajets</a>
                    <a href="\facture" class="btn btn-dark home-btn" id="factures" >Factures</a>
                    <a href="\tour" class="btn btn-dark home-btn" id="tours" >Tours</a>
                    <a href="\fournisseur" class="btn btn-dark home-btn" id="founisseur" >Fournisseur</a>
                    <a href="\client" class="btn btn-dark home-btn" id="client" >Clients</a>

                   </div>

            </div>
        </div>
    </div>

@endsection