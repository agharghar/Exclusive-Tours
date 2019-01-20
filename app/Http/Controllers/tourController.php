<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tour ; 
use DB;

class tourController extends Controller
{
    public function index()
    {
    	
        $tours = tour::paginate(15);
        $t = tour::all();
    	$countTour = tour::count();
        $totalKm = 0;
        foreach($t as $tour){
            $totalKm += $tour->trajet->km ;
        }
            
    	return view('tour\tour_index',compact('tours','countTour','totalKm'));


    }

    public function new()
    {
        $lastBus = \App\bus::count();
        if ($lastBus === 0) {
            $lastBus = 0 ;
        }

        $lastTrajet = \App\trajet::count();
        $firstTrajet = 1 ;
        if ($lastTrajet === 0) {
            $firstTrajet = 0 ;
        }

        $result = DB::table('buses')->select('id' , 'matricule')->get();
        $rt = DB::table('trajets')->select('id' , 'from' ,'to')->get();
        $numeroBus = [];
        $resultTrajet = [];

        foreach ($result as  $value) {
            $numeroBus[$value->id] = $value->matricule ;
        }

        foreach ($rt as  $value) {
            $resultTrajet[$value->id] = "From : ".$value->from." To : ".$value->to ;
        }



        return view('tour\tour_add',compact('lastBus','firstTrajet','lastTrajet','numeroBus','resultTrajet'));
    }



    public function add(Request $request)
    {


         $validate = $this->validate($request,[
            'bus_id' => 'required',
            'date' => 'required' ,
            'trajet_id' => 'required' ,


        ]);


         foreach (\App\date::all() as  $date) {



    		if($date->date == \Request::input('date')){
			
    			$tour = new tour([

		        	'date_id' => $date->id,
		        	'bus_id' => \Request::input('bus_id'),
		        	'trajet_id' => \Request::input('trajet_id'),

		        ]);
		        $tour->save(); 

		        	return redirect()->back();
    		}

    	}


    		$date = new \App\date([
    			'date' => \Request::input('date'),
	    		]);

			$date->save();

    		$tour = new tour([

	        	'date_id' => $date->id,
	        	'bus_id' => \Request::input('bus_id'),
	        	'trajet_id' => \Request::input('trajet_id'),

	        ]);
	        $tour->save(); 

    			

		return redirect()->back();
 
    }

    public function update(Request $request)
    {
        if($request->ajax()){

            $date = DB::table("dates")->select('id')->where('date',$request->input("date"))->first();

            if($date){
                $result = DB::table('tours')->where('id',$request->input("tour_id"))->update([

                    'date_id' => $date->id , 
                ]);

                return $result ;
            }


            DB::table("dates")->insert([
                'date' => $request->input('date'),

            ]);
            $date = DB::table("dates")->select('id')->where('date',$request->input("date"))->first();

            $result = DB::table('tours')->where('id',$request->input("tour_id"))->update([

            'date_id' => $date->id, 

            ]);

            return $result ;
            
            
        }
    }

    public function delete( Request $request)
    {
        if($request->ajax()){

            $error = DB::table("tours")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 

    public function search_date(Request $request)
    {

        if($request->ajax()){
            $result = DB::table('tours')
            ->select("tours.id" , "tours.date_id" , "tours.bus_id" , "buses.matricule" , "trajets.from" , "trajets.to" , 'trajets.km' , 'dates.date')
            ->join('trajets','trajets.id','tours.trajet_id')
            ->join('buses','buses.id' ,'=','tours.bus_id')
            ->join('dates','dates.id','=','tours.date_id')
            ->whereDate('dates.date', $request->input('date'))
            ->get();

            if($result){

                return response()->json(['result' => $result ]);
            }
        }
    }

}
