<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fournisseur extends Model
{
    protected $table = 'fournisseurs' ;
    protected $fillable = ['nomFournisseur'];


    public function facture_gazoiles()
    {
    	return $this->hasMany('App\facture_gazoile','fournisseur_id','id');
    }
}
