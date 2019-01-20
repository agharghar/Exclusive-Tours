<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class date extends Model
{
	protected $table = 'dates' ; 
	protected $fillable = ['date'] ; 

	public function tour()
    {
        return $this->hasMany('\App\tour','tour_id');
    }


}
