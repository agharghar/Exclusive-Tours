<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bus;
use DB;


class BusController extends Controller
{

    public function index()
    {
        $buses = bus::paginate(15) ;
        $b = bus::all() ;
        $totalGazoile = 0 ;
        $totalFraisGazoile =0;
        $totalFrais =0;
        $totalLavage =0;
        $totalAutoroute =0;
        $totalPiece =0;
        $totalVisite =0;
        foreach ($b as $bus) {
            foreach ($bus->bills as $value) {
                $totalGazoile +=  $value->pu*$value->litrage ;
                $totalLavage +=  $value->peage_lavage ;
                $totalAutoroute +=  $value->peage_autoroute ;
            }

            foreach ($bus->facture_pieces as $value) {
                $totalPiece += $value->pu*$value->nu ;
            }

            foreach ($bus->facture_visites as $value) {
                $totalVisite += $value->montant ;
            }


        }
        $totalFraisGazoile =  $totalGazoile+$totalLavage+$totalAutoroute ;
        $totalFrais = $totalFraisGazoile + $totalVisite + $totalPiece ;

        $countBus = bus::count() ;
        return view('bus\bus_index',compact('buses','countBus','totalGazoile','totalFraisGazoile','totalLavage','totalAutoroute','totalVisite','totalPiece','totalFrais'));
     
    }

    public function info($id )
    {
    	$bus = \App\bus::findOrFail(\Request('id'));
    	return  view('bus\bus_info', compact('bus')) ;
    }



    public function new()
    {
        $last = \App\chauffeur::count();
        $result = DB::table('chauffeurs')->select('id','num_chauffeur')->get();
        $numeroChauffeurs = [];

        foreach ($result as  $value) {
            $numeroChauffeurs[$value->id] = $value->num_chauffeur ;
        }

    	return view('bus\bus_add',compact('last','numeroChauffeurs'));
    }

    public function add(Request $request)
    {

        $validate = $this->validate($request,[
            'matricule' => 'required',
            'num_carte_grisse' => 'required' ,
            'pv' => 'required' ,
            'autorisation_num' => 'required' ,
            'autorisation_num_dossier' => 'required' ,
            'assurance_num_odre' => 'required' ,
            'date_debut' => 'required' ,
            'date_fin' => 'required' ,
            'chauffeur_id' => 'max:1000'


        ]);
    
        $bus = new bus($validate);
        $bus->save(); 
        return redirect()->back();
    }

    public function assuranceExpire()
    {
        $notification = '';
        $data = DB::table('buses')->where('date_fin' ,'<=', DB::raw("DATE_ADD(curdate(), INTERVAL 15 DAY)"))->get();
        $notificationCount = count($data);
        foreach ($data as $value) {
            
            $notification .= "<div class='dropdown-item'><a class='btn btn-secondary' href='".\Route('bus.info',['id' => $value->id])."'>Date D'expiration : ".$value->date_fin."</a></div>" ;
        }

        
        return ['notification' => $notification , 'count' => $notificationCount ];

    }


    public function update(Request $request)
    {
        if($request->ajax()){
            $error = DB::table("buses")->where('id',$request->input("id"))->update(
            [
                "matricule" => $request->input("matricule") ,
                "num_carte_grisse" => $request->input("num_carte_grisse") ,
                "pv" => $request->input("pv") ,
                "autorisation_num" => $request->input("autorisation_num") ,
                "autorisation_num_dossier" => $request->input("autorisation_num_dossier") ,
                "assurance_num_odre" => $request->input("assurance_num_odre") ,
                "date_debut" => $request->input("date_debut") ,
                "date_fin" => $request->input("date_fin") ,
            ]);

        return $error ;

        }
    }

    public function delete( Request $request)
    {
        if($request->ajax()){

            $error = DB::table("buses")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 

    public function search(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('buses')->where('matricule',$request->input('matricule'))->first() ;

            if($result){
                return response()->json(['result' => $result]); ;
            }
        }
    }


    public function search_date(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('tours')
            ->select("trajets.from" , "trajets.to" , 'trajets.km' , 'dates.date')
            ->join('trajets','trajets.id','tours.trajet_id')
            ->join('buses','buses.id' ,'=','tours.bus_id')
            ->join('dates','dates.id','=','tours.date_id')
            ->whereDate('dates.date', $request->input('date'))
            ->where('buses.id', $request->input('id'))
            ->get();

            if($result){

                return response()->json(['result' => $result ]);
            }
        }
    }



}
