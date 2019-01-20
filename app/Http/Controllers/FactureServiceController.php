<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facture_service;
use DB;

class FactureServiceController extends Controller
{
     public function info()
    {

        $factures = facture_service::orderBy('etat', 'asc')->paginate(15);
        $f = facture_service::all();
    	$countService = facture_service::count();
        $totalMontant = 0 ;
        foreach($f as $facture){
            $totalMontant += $facture->montant;
        }
    	return view('facture/facture_service/facture_service_view',compact('factures','countService','totalMontant'));
    }


    public function new()
    {
        $last = \App\client::count();
        if ($last === 0) {
            $last = 0 ;
        }

        $result = DB::table('clients')->select('id' , 'designation')->get();
        $numeroClient = [];

        foreach ($result as  $value) {
            $numeroClient[$value->id] = $value->designation ;
        }

    	return view('facture/facture_service/facture_service_add',compact('numeroClient','last'));
    }

    public function add(Request $request)
    {

        $validate = $this->validate($request,[
            'num_facture' => 'required',
            'designation' => 'required' ,
            'date' => 'required' ,
            'montant' => 'required' ,
            'client_id' => 'required' ,
            'etat' => 'required' ,
        ]);

        $facture = new facture_service($validate);
        $facture->save(); 
    	return redirect()->back();
    }

    public function update(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_services")->where('id',$request->input("id"))->update(
            [
                "client_id" => $request->input("client_id") ,
                "num_facture" => $request->input("num_facture") ,
                "designation" => $request->input("designation") ,
                "montant" => $request->input("montant") ,
                "date" => $request->input("date") ,
                "etat" => $request->input("etat") ,

              


            ]);



        return $error ;

        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_services")->where("id",$request->input('id'))->delete();
            return $error ;
        
         }//end ajax
    }// end delete 

    public function getClients(Request $request)
    {
        if($request->ajax()){
            $clients = DB::table('clients')->select('id','designation')->get();
            if($clients){
                return $clients ;
            }
        }//end ajax
    }

    public function search(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('facture_services')->where('num_facture',$request->input('num_facture'))->first() ;

            if($result){
                $client = DB::table('clients')->where('id',$result->client_id)->get();
                return response()->json(['result' => $result , 'client' => $client]); ;
            }
        }
    }

}//end Controller
