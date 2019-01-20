<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trajet extends Model
{
    protected $table = 'trajets';
    protected $fillable = ['km' ,'from' ,'to']; 

    public function tour()
    {
        return $this->hasMany('\App\tour','trajet_id');
    }
}
