<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Contracts\Validation\Validator;
use DB ;
use App\chauffeur ;

class ChauffeurController extends Controller{

    public function index()
    {

       $chauffeurs = \App\chauffeur::orderBy('num_chauffeur','asc')->paginate(15);
       $countChauffeur = \App\chauffeur::count();
        return view('chauffeur\chauffeur_index',compact('chauffeurs','countChauffeur'));
    }

    public function info($id)
    {
        $totalRepot = 0 ;
    	$chauffeur = \App\chauffeur::findOrFail(\Request('id'));
        $Trajets = [] ; 
        foreach ($chauffeur->repots as $value) {
            $totalRepot += $value->nombre_jour ; 
        }


    	return view('chauffeur\chauffeur_info',compact('chauffeur','Trajets','totalRepot'));
    }

    public function new()
    {
        $last = \App\bus::count();
        $first = 1 ;
        if ($last === 0) {
            $first = 0 ;
        }
        
    	return  view('chauffeur\chauffeur_add',compact('first','last')) ;
    }

    public function add(Request $request)
    {
        $validate = $this->validate($request,[
            'cin' => 'required',
            'permis' => 'required' ,
            'nom' => 'required' ,
            'prenom' => 'required' ,
            'address' => 'required' ,
            'cnss' => 'required' ,
            'dossier' => 'required' ,
            'num_chauffeur' => 'required' ,
            'tele' => 'required' ,

        ]);
        $chauffeur = new chauffeur($validate);
        $chauffeur->save(); 
    	return redirect()->back();
    }

    public function repot_add(Request $request)
    {
        $validate = $this->validate($request,[
            'chauffeur_id' => 'required',
            'date_debut' => 'required' ,
            'date_fin' => 'required' ,
            'nombre_jour' => 'required' ,


        ]);
        $repot = new \App\repot($validate);
        $repot->save(); 
        return redirect()->back();
    }

    public function repot_new()
    {
        $last = \App\chauffeur::count();
        $result = DB::table('chauffeurs')->select('id','num_chauffeur')->get();
        $numeroChauffeurs = [];

        foreach ($result as  $value) {
            $numeroChauffeurs[$value->id] = $value->num_chauffeur ;
        }

        return view('chauffeur\chauffeur_repot_add',compact('last','numeroChauffeurs'));
    }

    public function update(Request $request)
    {
        if($request->ajax()){
            $error = DB::table("chauffeurs")->where('id',$request->input("id"))->update(
            [
                "cin" => $request->input("cin") ,
                "permis" => $request->input("permis") ,
                "nom" => $request->input("nom") ,
                "prenom" => $request->input("prenom") ,
                "address" => $request->input("address") ,
                "cnss" => $request->input("cnss") ,
                "dossier" => $request->input("dossier") ,
                "num_chauffeur" => $request->input("num_chauffeur") ,
                "tele" => $request->input("tele") ,
              


            ]);

        return $error ;

        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("chauffeurs")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 


    public function search(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('chauffeurs')->where('num_chauffeur',$request->input('num_chauffeur'))->first() ;

            if($result){
                return response()->json(['result' => $result]); ;
            }
        }
    }

    public function search_date(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('tours')
            ->select("tours.bus_id" ,'buses.matricule' ,"trajets.from" , "trajets.to" , 'trajets.km' , 'dates.date')
            ->join('trajets','trajets.id','tours.trajet_id')
            ->join('buses','tours.bus_id' ,'=','buses.id')
            ->join('chauffeurs','chauffeurs.id','=','buses.chauffeur_id')
            ->join('dates','dates.id','=','tours.date_id')
            ->whereDate('dates.date', $request->input('date'))
            ->where('chauffeurs.id',$request->input('id'))
            ->get();

            if($result){

                return response()->json(['result' => $result ]);
            }
        }
    }


    public function repotAll(Request $request)
    {
        $totalRepot = 0;
        $chauffeurs = \App\chauffeur::paginate(15);
        $repots = \App\repot::all();
        $repotsCount = DB::table('repots')->count();

        foreach ($repots as $value) {

            $totalRepot += $value->nombre_jour ; 

        }

        return  view('chauffeur\chauffeur_repotAll',compact('chauffeurs','repotsCount','totalRepot')) ;
    }

    public function repot_delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("repots")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 


    public function repot_update(Request $request)
    {
        if($request->ajax()){
            $error = DB::table("repots")->where('id',$request->input("id"))->update(
            [
                "chauffeur_id" => $request->input("chauffeur_id") ,
                "date_debut" => $request->input("date_debut") ,
                "date_fin" => $request->input("date_fin") ,
                "nombre_jour" => $request->input("nombre_jour") ,
            ]);

        return $error ;

        }
    }



    public function search_repot(Request $request)
    {

        if($request->ajax()){

            $result = DB::table('repots')
            ->select('repots.id','chauffeurs.num_chauffeur','chauffeur_id','chauffeurs.nom','chauffeurs.prenom','date_debut','date_fin','nombre_jour')
            ->join('chauffeurs','chauffeurs.id','=','repots.chauffeur_id')
            ->where('chauffeurs.num_chauffeur',$request->input('num_chauffeur'))
            ->get() ;
            if($result){
                return response()->json(['result' => $result]); ;
            }
        }
    }


    public function getChauffeurs(){

        return chauffeur::all();

    }

}
