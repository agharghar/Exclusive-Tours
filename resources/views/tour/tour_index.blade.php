@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <span class="ml-5 ">Tours</span>
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                    @if(Request::path() == "tour")
                        <a class="al btn btn-outline-secondary mr-3 float-right" id="add-tour">Créer Nouveau Tour</a>
                    @endif
                    <span class="ml-5 "> Total Tour : {{$countTour}}</span>

                    <span class="ml-5 "> Total Km  : {{$totalKm}}</span>

                    {!! Form::open(['url' => 'tour/search_date' , 'class' => 'search-form ml-5'] ) !!}
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
                <section class="table-index">
                    <input type="input" hidden disabled="disabled" name="hidden">
                    <table class="table table-hover">
                        <thead>
                            <th>Bus Matricule</th>
                            <th>Trajet : From </th>
                            <th>Trajet : To</th>
                            <th>N° Km </th>
                            <th>Date</th>
                            <th id="case-edit"></th>
                            <th id="case-delete"></th>
                        </thead>
                        <tbody>  
                             @foreach($tours as $tour)
                                    <tr index="{{$loop->index}}" id_attr="{{$tour->id}}">

                                        <td>
                                        	<a href="{{ route('bus.info',['id' => $tour->bus_id]) }}">{{$tour->bus->matricule}}</a>
                                    	</td>                                            
                                        <td>
                                        	{{$tour->trajet->from}}
                                        </td>                  
                                        <td>
                                        	{{$tour->trajet->to}}
                                   		 </td>                  
                                   		  <td>
                                        	{{$tour->trajet->km}}
                                   		 </td>                  
                                        <td date_id="{{$tour->date->id}}">
                                        	{{$tour->date->date}}
                                        </td> 
                                        <td><button class="btn btn-primary edit" edit_id="{{$tour->id}}">Edit</button></td>     
                                        <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$tour->id}}">Delete</button>

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
                                                <button type="button" class="btn btn-danger delete" delete_id="{{$tour->id}}" data-dismiss="modal">Delete</button>
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
                    {{$tours->links()}}
                    </div>
                </section>
            </div>
        </div>
    </div>

<!-- JS -->
<script type="text/javascript" src="{{ asset('js\tour\tour.js') }} "></script>
    

@endsection