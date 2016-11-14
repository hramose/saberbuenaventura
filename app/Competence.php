<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $table = 'competences';

    protected $fillable = ['name', 'area_id'];

    public function area(){
    	return $this->belongsTo('App\Area');
    }

    public function questions(){
    	return $this->hasMany('App\Question');
    }

    public function achievements(){
    	return $this->hasMany('App\Achievement');
    }

    public static function getCompetencesByArea($id){
        return Competence::where('area_id', '=', $id)->get();
    }
}
