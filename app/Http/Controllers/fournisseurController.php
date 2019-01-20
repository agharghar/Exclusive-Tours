<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\fournisseur ;
use DB;

class fournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = \App\fournisseur::paginate(15);
    	$fs = \App\fournisseur::all();
    	$nbFornisseur = fournisseur::count();

        $total_facture = 0 ;
        foreach($fs as $fournisseur ){
            foreach($fournisseur->facture_gazoiles as $facture_gazoile ){
                foreach($facture_gazoile->bills as $bill ){
                    $total_facture += ($bill->pu*$bill->litrage)+$bill->peage_lavage + $bill->peage_autoroute  ;
                }
            }
        }

    	return view('fournisseur\fournisseur_index',compact('fournisseurs','nbFornisseur','total_facture'));
    }

    public function new()
    {
       
        return  view('fournisseur\fournisseur_add') ;
    }

    public function add(Request $request)
    {

        $validate = $this->validate($request,[
            'nomFournisseur' => 'required',

        ]);
        $fournisseur = new fournisseur($validate);
        $fournisseur->save(); 
        return redirect()->back();
    }

    public function info($id)
    {
    	$fournisseur = fournisseur::findOrFail($id);
    	return view('fournisseur\fournisseur_info',compact('fournisseur')) ;
    }

    public function update(Request $request)
    {
        if($request->ajax()){
            $error = DB::table("fournisseurs")->where('id',$request->input("id"))->update(
            [
                "nomFournisseur" => $request->input("nomFournisseur") ,

            ]);

        return $error ;

        }
    }

    public function delete( Request $request)
    {
        if($request->ajax()){

            $error = DB::table("fournisseurs")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 


    public function search(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('fournisseurs')
            ->where('nomFournisseur', $request->input('nomFournisseur'))
            ->first();

            if($result){

                return response()->json(['result' => $result ]);
            }
        }
    }

}
