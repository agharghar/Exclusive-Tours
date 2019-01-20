<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;
use DB;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    protected $table = 'users' ; 


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
       
        if($this->role['type'] == 'admin'){
            return true ;
        }
        return false ;
    }


    public function role()
    {
        return $this->belongsTo('\App\role','role_id','id');
    }


    public function addRole(){
       
        $roles = Role::all();
        $slug = [];
        foreach ($roles as $value) {
           array_push($slug, $value->value) ;
        }


        $val= validator::make(request()->all(),[

            'user_type' => 'required|in_array:'.implode(',', $slug) ,

        ]);
            
        $role = DB::table('roles')->where('type',request('user_type'))->first();
        
        $this->role()->associate($role);  
        $this->role()->save();  
        

    }
}
