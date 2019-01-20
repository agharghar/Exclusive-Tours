<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facture_gazoile ;
use DB;

class FactureGazoileController extends Controller
{
       public function index()
    {

        $factures = facture_gazoile::paginate(15);
        $f = facture_gazoile::all();
    	$countGazoile = facture_gazoile::count();

        $total = 0;
        $lavage = 0 ;
        $gazoile = 0 ;
        $autoroute = 0 ;
        foreach ($f as $facture) {
            foreach($facture->bills as $bill) {
             
                    $lavage += $bill->peage_lavage ; 
                    $autoroute += $bill->peage_autoroute ;
                    $gazoile += $bill->pu * $bill->litrage ; 

            }
        }

        $total = $lavage + $autoroute + $gazoile ; 

    	return view('facture/facture_gazoile/facture_gazoile_view',compact('factures','countGazoile','gazoile','autoroute','lavage','total'));
    }


    public function new()
    {
        $lastFounisseur = \App\fournisseur::count();
        if ($lastFounisseur === 0) {
            $lastFounisseur = 0 ;
        }

        $lastBus = \App\bus::count();
        if ($lastBus === 0) {
            $lastBus = 0 ;
        }

        $result = DB::table('fournisseurs')->select('id' , 'nomFournisseur')->get();
        $numeroFournisseur = [];  

        $r = DB::table('buses')->select('id' , 'matricule')->get();
        $numeroBus = [];

        foreach ($result as  $value) {
            $numeroFournisseur[$value->id] = $value->nomFournisseur ;
        }

        foreach ($r as  $value) {
            $numeroBus[$value->id] = $value->matricule ;
        }

    	return view('facture/facture_gazoile/facture_gazoile_add',compact('numeroFournisseur','numeroBus','lastFounisseur','lastBus'));
    }

    public function add(Request $request)
    {


        $facture = new facture_gazoile();
        $facture->num_facture = $request->input('facture');
        $facture->designation = $request->input('designation');
        $facture->fournisseur_id = $request->input('fournisseur_id');
        $facture->save();

        foreach ($request->input('date') as $key => $value) {
            $bill = new \App\bill() ;
            $bill->facture_gazoile_id = $facture->id ;
            $bill->bus_id = $request->input('bus_id')[$key] ;
            $bill->pu = $request->input('pu')[$key] ;
            $bill->litrage = $request->input('litrage')[$key] ;
            $bill->num_carte = $request->input('num_carte')[$key] ;
            $bill->km = $request->input('km')[$key] ;
            $bill->date = $request->input('date')[$key] ;
            $bill->peage_autoroute = $request->input('peage_autoroute')[$key] ;
            $bill->peage_lavage = $request->input('peage_lavage')[$key] ;
            $bill->save();
        }
        return 1;
    }

    public function update(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_gazoiles")->where('id',$request->input("id"))->update(
            [
                "fournisseur_id" => $request->input("fournisseur_id") ,
                "num_facture" => $request->input("num_facture") ,
                "designation" => $request->input("designation") ,
            ]);



        return $error ;

        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_gazoiles")->where("id",$request->input('id'))->delete();
            return $error ;
        
         }//end ajax
    }// end delete

    public function bill_delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("bills")->where("id",$request->input('id'))->delete();
            return $error ;
        
         }//end ajax
    }// end delete 

    public function bill_update(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("bills")->where('id',$request->input("id"))->update(
            [
                "bus_id" => $request->input("bus_id") ,
                "pu" => $request->input("pu") ,
                "litrage" => $request->input("litrage") ,
                "num_carte" => $request->input("num_carte") ,
                "km" => $request->input("km") ,
                "date" => $request->input("date") ,
                "peage_lavage" => $request->input("peage_lavage") ,
                "peage_autoroute" => $request->input("peage_autoroute") ,
            ]);



        return $error ;

        }

    }
    

    public function info(Request $request ,$id)
    {

        $bills = \App\bill::where('facture_gazoile_id',\Request('id'))->paginate(15);

        $total = 0;
        $lavage = 0 ;
        $gazoile = 0 ;
        $autoroute = 0 ;

        foreach($bills as $bill) {
         
                $lavage += $bill->peage_lavage ; 
                $autoroute += $bill->peage_autoroute ;
                $gazoile += $bill->pu * $bill->litrage ; 

        }

        $total = $lavage + $autoroute + $gazoile ; 
        

        return  view('facture/facture_gazoile/facture_gazoile_info', compact('bills','gazoile','autoroute','total','lavage')) ;

    } 

    public function getFournisseurs(Request $request)
    {
        if($request->ajax()){
            $fournisseurs = DB::table('fournisseurs')->select('id','nomFournisseur')->get();
            if($fournisseurs){
                return $fournisseurs ;
            }
        }
    }

    public function getNumFacture(Request $request)
    {
        if($request->ajax()){
            $numFactures = DB::table('facture_gazoiles')->select('num_facture','id')->get();
            if($numFactures){
                return $numFactures ;
            }
        }
    }


    
    public function search(Request $request)
    {

        if($request->ajax()){
        
            $result = \App\facture_gazoile::where('num_facture',$request->input('num_facture'))->first() ;
        


            if($result){
                $total = 0;
                foreach ($result->bills as $bill) {
                    $total += $bill->pu*$bill->litrage ;
                }
                $fournisseur = DB::table('fournisseurs')->where('id',$result->fournisseur_id)->get();
                return response()->json(['result' => $result , 'fournisseur' => $fournisseur ,'montant' => $total]); ;
            }
        }
    }


}
