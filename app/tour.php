<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tour extends Model
{
    protected $table = 'tours';
    protected $fillable = ['bus_id' , 'trajet_id' ,'date_id'] ;

    public function bus()
    {
    	return $this->belongsTo('\App\bus','bus_id','id');
    }

    public function trajet()
    {
    	return $this->belongsTo('\App\trajet','trajet_id','id');
    }


    public function date()
    {
    	return $this->belongsTo('\App\date','date_id','id');
    }


}
