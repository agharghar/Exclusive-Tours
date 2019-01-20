<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\client;
use DB;

class clientController extends Controller
{
        public function index()
    {
    	$clients = \App\client::paginate(15);
    	$countclient = client::count();
    	return view('client\client_index',compact('clients','countclient'));
    }


    public function new()
    {
       
    	return  view('client\client_add') ;
    }

    public function add(Request $request)
    {

        $validate = $this->validate($request,[
            'designation' => 'required',

        ]);
        $client = new client($validate);
        $client->save(); 
    	return redirect()->back();
    }

    public function info($id)
    {
    	$client = client::find($id);
    	return view('client\client_info',compact('client')) ;
    }

    public function update(Request $request)
    {
        if($request->ajax()){
            $error = DB::table("clients")->where('id',$request->input("id"))->update(
            [
                "designation" => $request->input("designation") ,

            ]);

        return $error ;

        }
    }

    public function delete( Request $request)
    {
        if($request->ajax()){

            $error = DB::table("clients")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 


    public function search(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('clients')
            ->where('designation', $request->input('designation'))
            ->first();

            if($result){

                return response()->json(['result' => $result ]);
            }
        }
    }
}
