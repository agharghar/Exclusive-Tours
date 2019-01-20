<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\trajet;

class trajetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trajets = \App\trajet::paginate(15);
        $countTrajet = \App\trajet::count();
        return view('trajet\trajet_index',compact('trajets','countTrajet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }






     public function new()
    {

        return view('trajet\trajet_add');
    }



    public function add(Request $request)
    {

         $validate = $this->validate($request,[
            'from' => 'required',
            'to' => 'required' ,
            'km' => 'required' ,


        ]);
        $trajet = new trajet($validate);
        $trajet->save(); 
        return redirect()->back();
        
    }

    public function update(Request $request)
    {
        if($request->ajax()){
            $error = DB::table("trajets")->where('id',$request->input("id"))->update(
            [
                "from" => $request->input("from") ,
                "to" => $request->input("to") ,
                "km" => $request->input("km") ,
            ]);

        return $error ;

        }
    }

    public function delete( Request $request)
    {
        if($request->ajax()){

            $error = DB::table("trajets")->where("id",$request->input('id'))->delete();
            return $error ;
        
        }//end ajax
    }// end delete 

    public function search(Request $request)
    {
        
        if($request->ajax()){
            $from = $request->input('from');
            $to = $request->input('to');

            if($request->input('from') == ''){
                $from ='%';
            }
            if($request->input('to') == ''){
                $to ='%';
            }

            if(($request->input('from') == '') && ($request->input('to') == '')){
                return 0 ;
            }

            $result = DB::table('trajets')
            ->where('from', 'like' ,$from)
            ->where('to', 'like' ,$to)
            ->get();

            if($result){

                return response()->json(['result' => $result ]);
            }
        }
    }


}
