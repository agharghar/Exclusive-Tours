<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [ 'slug' , 'type' ];
    protected $table = 'roles' ; 


    public function users()
    {
    	return $this->hasMany('App\user','user_id','id');
    }

}
