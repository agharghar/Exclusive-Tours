<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;


class chauffeur extends Model
{
    protected $fillable = ['nom' ,'prenom' ,'cin' ,'permis' ,'address' ,'cnss' , 'dossier' ,'num_chauffeur','tele' ];
    protected $table = 'chauffeurs' ; 



   public function buses()
    {
        return $this->hasMany('App\bus','chauffeur_id','id');
    }


    public function repots()
    {
    	return $this->hasMany(\App\repot::class,'chauffeur_id','id');
    }

}

/* Information chauffeurs 


n°cnss 
n° dossier 
N° de chauffeurs 
N° Tele 



*/