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

    public function performance_level(){
        return $this->hasMany('App\Performance_level');
    }

    public static function getAreaByGrade($grade){
        return Area::select('*')
                ->where('grade','=',$grade)
                ->orderBy('name','ASC')
                ->get();       
    }
}
