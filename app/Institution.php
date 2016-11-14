<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Institution extends Authenticatable
{
    protected $table = 'institutions';

    protected $cast = [
    	'rol'   =>  'institution'
    ];

    protected $fillable = ['name', 'street_address', 'phone', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function class_rooms(){
    	return $this->hasMany('App\Class_room');
    }
}
