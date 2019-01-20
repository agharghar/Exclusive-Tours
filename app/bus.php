<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    protected $fillable = ['matricule' , 'num_carte_grisse' ,'pv' ,'autorisation_num' ,'autorisation_num_dossier' ,'assurance_num_odre' ,'date_debut' ,'date_fin', 'chauffeur_id'   ];


    protected $table = 'buses' ; 





    public function chauffeur()
    {
        return $this->belongsTo('App\chauffeur','chauffeur_id');
    }

    public function bills()
    {
        return $this->hasMany('App\bill','bus_id');
    }


    public function facture_pieces()
    {
        return $this->hasMany('\App\facture_piece','bus_id');
    }

    public function facture_visites()
    {
        return $this->hasMany('\App\facture_visite','bus_id');
    }

    public function tour()
    {
        return $this->hasMany('\App\tour','bus_id');
    }

}


    
/*N° carte Grisse

PV 


Carte d'autorisation  {
    N° Autorisation
    N° dossier 
}


Assurance {
    
    Num Ordre
    Date Début / Fin 

}

*/