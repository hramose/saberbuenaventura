<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['name', 'weighted_value', 'grade'];

    public function pre_icfes(){
    	return $this->belongsToMany('App\Pre_icfes');
    }

    public function asignatures(){
    	return $this->hasMany('App\Asignature');
    }

    public function competences(){
    	return $this->hasMany('App\Competence');
    }
}
