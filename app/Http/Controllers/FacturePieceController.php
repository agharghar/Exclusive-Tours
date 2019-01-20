<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facture_piece;
use DB;

class FacturePieceController extends Controller
{
    public function info()
    {
        $factures = \App\facture_piece::paginate(15);       
        $f = \App\facture_piece::all();       
    	$countPiece = \App\facture_piece::count();   
        $totalMontant = 0;
        foreach($f as $facture){
            $totalMontant += $facture->pu * $facture->nu ;
        }
	
    	return view('facture/facture_piece/facture_piece_view',compact('factures','countPiece','totalMontant'));

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

    	return view('facture/facture_piece/facture_piece_add',compact('numeroBus','last'));
    }

    public function add(Request $request)
    {

        $validate = $this->validate($request,[
            'num_facture' => 'required',
            'designation' => 'required' ,
            'date' => 'required' ,
            'pu' => 'required' ,
            'nu' => 'required' ,
            'bus_id' => 'required' ,
        ]);


        $facture = new facture_piece($validate);
        $facture->save(); 
    	return redirect()->back();
    }

    public function update(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_pieces")->where('id',$request->input("id"))->update(
            [
                "bus_id" => $request->input("bus_id") ,
                "num_facture" => $request->input("num_facture") ,
                "designation" => $request->input("designation") ,
                "pu" => $request->input("pu") ,
                "nu" => $request->input("nu") ,
                "date" => $request->input("date") ,

              


            ]);



        return $error ;

        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){

            $error = DB::table("facture_pieces")->where("id",$request->input('id'))->delete();
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
            $result = DB::table('facture_pieces')->where('num_facture',$request->input('num_facture'))->first() ;

            if($result){
                $bus = DB::table('buses')->where('id',$result->bus_id)->get();
                return response()->json(['result' => $result , 'bus' => $bus]); ;
            }
        }
    }
    



}
