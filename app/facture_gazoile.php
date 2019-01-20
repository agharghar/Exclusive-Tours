<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facture_gazoile extends Model
{
    
    protected $fillable = ['num_facture' ,'designation' ,'fournisseur_id'] ; 
    protected $table = 'facture_gazoiles' ;


    public function fournisseur(){

    	return $this->belongsTo(\App\fournisseur::class,'fournisseur_id','id');
    }

    public function bills()
    {
    	return $this->hasMany(\App\bill::class,'facture_gazoile_id','id');
    }

}
