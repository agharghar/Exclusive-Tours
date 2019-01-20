<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facture_piece extends Model
{
        protected $fillable = ['bus_id','date' ,'num_facture' ,'designation' , 'pu' ,'nu'] ; 
        protected $table = 'facture_pieces' ; 



      	public function buses(){
      		
    	return $this->belongsTo('\App\bus','bus_id','id');
    }

}
