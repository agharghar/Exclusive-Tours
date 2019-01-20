<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facture_visite;
use DB;

class FactureVisiteController extends Controller
{
    public function info()
    {
        $factures = facture_visite::paginate(15);
        $f = facture_visite::all();
    	$countVisite = facture_visite::count();
        $totalMontant = 0;
        foreach($f as $facture){
            $totalMontant += $facture->montant ;
        }
    	return view('facture/facture_visite/facture_visite_view',compact('factures','countVisite','totalMontant'));
    }

    public function new()
    {
        $last = \App\bus::count();
        if ($last === 0) {
            $last = 0 ;
        }

        $result = DB::table('buses')->select('id' , 'matricule')->get();
        $numeroBus = [];

        foreach ($result as  $value) {
            $numeroBus[$value->id] = $value->matricule ;
        }

    	return view('facture/facture_visite/facture_visite_add',compact('numeroBus','last'));
    }

    public function add(Request $request)
    {

        $validate = $this->validate($request,[
            'num_facture' => 'required',
            'designation' => 'required' ,
            'montant' => 'required' ,
            'date' => 'required' ,
            'bus_id' => 'required' ,

        ]);


        $facture = new facture_visite($validate);
        $facture->save(); 
    	return redirect()->back();
    }

    public function update(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_visites")->where('id',$request->input("id"))->update(
            [
                "bus_id" => $request->input("bus_id") ,
                "num_facture" => $request->input("num_facture") ,
                "designation" => $request->input("designation") ,
                "montant" => $request->input("montant") ,
                "date" => $request->input("date") ,

              


            ]);



        return $error ;

        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_visites")->where("id",$request->input('id'))->delete();
            return $error ;
        
         }//end ajax
    }// end delete 


    public function getBuses(Request $request)
    {
        if($request->ajax()){
            $buses = DB::table('buses')->select('id','matricule')->get();
            if($buses){
                return $buses ;
            }
        }
    }

    public function search(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('facture_visites')->where('num_facture',$request->input('num_facture'))->first() ;

            if($result){
                $bus = DB::table('buses')->where('id',$result->bus_id)->get();
                return response()->json(['result' => $result , 'bus' => $bus]); ;
            }
        }
    }

}
