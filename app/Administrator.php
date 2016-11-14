<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    
    protected $table = 'administrators';
    
    protected $fillable = [
        'name', 'last_name', 'email', 'password',
    ];

    protected $cast = [
        'rol'   =>  'admin'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
