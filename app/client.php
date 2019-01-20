<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $table = 'clients' ;
    protected $fillable = ['designation'] ;

    public function facture_services()
    {
    	return $this->hasMany('\App\facture_service','client_id','id');
    }

}
