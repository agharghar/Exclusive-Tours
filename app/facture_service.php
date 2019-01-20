<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facture_service extends Model
{
    protected $fillable = ['client_id','date' ,'num_facture' ,'designation' ,'etat','montant'] ; 
    protected $table = 'facture_services' ; 

    public function client()
    {
		return $this->belongsTo(\App\client::class,'client_id','id');
	}

}
