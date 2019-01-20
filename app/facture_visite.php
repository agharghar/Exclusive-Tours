<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facture_visite extends Model
{
    protected $fillable = ['bus_id','date' ,'num_facture' ,'designation' ,'montant'] ; 
    protected $table = 'facture_visites' ; 

    public function buses()
    {
    	return $this->belongsTo('\App\bus','bus_id','id');
    }
}
