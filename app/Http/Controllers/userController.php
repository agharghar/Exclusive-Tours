<?php

namespace App\Http\Controllers;

use App\User ;
use Illuminate\Http\Request;
use DB;

class userController extends Controller
{
    public function index()
    {
    	$users = user::paginate(15);
    	$countUser = user::count();
    	return view('user\user_index',compact('users','countUser'));
    }


    public function update(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("users")->where('id',$request->input("id"))->update(
            [
                "role_id" => $request->input("role_id") ,
                "email" => $request->input("email") ,
                "name" => $request->input("name") ,

            ]);



        return $error ;

        }
    }


    public function delete( Request $request)
    {
        if($request->ajax()){

            $error = DB::table("users")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 


    public function getRoles(Request $request)
    {
        if($request->ajax()){
            $roles = DB::table('roles')->get();
            if($roles){
                return $roles ;
            }
        }

    }//end getroles




}//end controller
