<?php

use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   //  	factory(App\Role::class, 5)->create();

        $a = new \App\Role();
        $a->type = 'admin';
        $a->save();
        $b = new \App\Role();
        $b->type = 'user';
        $b->save();
       	factory(App\User::class , 20)->create();
       	 
       	 App\User::all()->each(function ($user){
       	 	$role = App\Role::find(rand(1,2));
       	 	$user->role()->associate($role);

       	 });

         $a = new App\User();
         $a->name = 'administrator' ;
         $a->email = 'admin@admin.com';
         $a->password = bcrypt('admin');
         $a->role()->associate(\App\Role::find(1));
         $a->save();

         $a = new App\User();
         $a->name = 'User' ;
         $a->email = 'user@user.com';
         $a->password = bcrypt('user');
         $a->role()->associate(\App\Role::find(2));
         $a->save();
         
    }
}
