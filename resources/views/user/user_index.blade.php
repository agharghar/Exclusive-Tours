@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/standard.css') }}">



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="ml-5 "> users</span>
                  <a class="al btn btn-outline-secondary mr-3 float-right" id="home" href="/home">Home</a>
                    @if(Request::path() == "user")
                        <a class="al btn btn-outline-secondary mr-3 float-right" href="{{ route('register') }}" id="add-user">Créer Nouveau Utilisateur</a>
                    @endif
                    <span class="ml-5 "> Total users : {{$countUser}}</span>
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

                                <th>Nom</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th id="case-edit"></th >
                                <th id="case-delete"></th >
                            <tr>

                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr index="{{$loop->index}}" id_attr="{{$user->id}}">
                                    <td>{{$user->name}}</td>                                  
                                    <td>{{$user->email}}</td>                                    
                                    <td role_id="{{$user->role_id}}">{{$user->role['type']}}</td>                                    

                                    <td><button class="btn btn-primary edit" edit_id="{{$user->id}}">Edit</button></td>     
                                    <td><button class="btn btn-danger first-delete" id="btn-delete" data-toggle="modal" data-target="#delete" delete_iid="{{$user->id}}">Delete</button>

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
                                            Voulez Vous Vraiment Supprimer L'utilisateur  .
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger delete" delete_id="{{$user->id}}" data-dismiss="modal">Delete</button>
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
                        {{$users->links()}}                
                    </div>
                    </section>
                </div>


            </div>
        </div>
    </div>

    <!-- Javascript Style -->

    <script type="text/javascript" src="{{ asset('js/user/user.js') }}"></script>

    <!-- Javascript Style -->
@endsection