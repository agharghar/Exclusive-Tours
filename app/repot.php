<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class repot extends Model
{
   	protected $table ='repots';
   	protected $fillable = ['date_debut','date_fin','nombre_jour','chauffeur_id'];


    public function chauffeur()   {
    	
    	return $this->belongsTo(\App\chauffeur::class,'chauffeur_id','id');
    }
}
