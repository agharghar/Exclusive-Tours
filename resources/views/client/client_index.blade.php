@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <span class="ml-5 ">Clients</span>
                    <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                    @if(Request::path() == "client")
                        <a class="al btn btn-outline-secondary mr-3 float-right" id="add-client">Créer Nouveau client</a>
                    @endif
                    <span class="ml-5 "> Total client : {{$countclient}}</span>

                    {!! Form::open(['url' => 'client/search' , 'class' => 'search-form ml-5'] ) !!}
                    {{Form::text('designation','',['class'=> 'search-box' , 'placeholder' => 'Designation'])}}
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
                            <th>#</th>
                            <th>Designation</th>
                            <th id="case-edit"></th>
                            <th id="case-delete"></th>
                        </thead>
                        <tbody>  
                             @foreach($clients as $client)
                                    <tr index="{{$loop->index}}" id_attr="{{$client->id}}">
                                        <td>
                                            {{$loop->index}}
                                        </td>                  
                                        <td>
                                            <a href="{{route('client.info',['id' => $client->id])}}"> 
                                               {{$client->designation}}
                                            </a>
                                         </td>                  
                                        <td><button class="btn btn-primary edit" edit_id="{{$client->id}}">Edit</button></td>     
                                        <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$client->id}}">Delete</button>

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
                                                <button type="button" class="btn btn-danger delete" delete_id="{{$client->id}}" data-dismiss="modal">Delete</button>
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
                    {{$clients->links()}}
                    </div>
                </section>
            </div>
        </div>
    </div>

<script type="text/javascript" src="{{ asset('js\client\client.js') }} "></script>
    

@endsection