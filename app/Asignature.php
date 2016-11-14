<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignature extends Model
{
    protected $table = 'asignatures';

    protected $fillable = ['name', 'area_id'];

    public function area(){
    	return $this->belongsTo('App\Area');
    }

    public function questions(){
    	return $this->hasMany('App\Question');
    }

    public static function getAsignaturesByArea($id){
        return Asignature::where('area_id', '=', $id)->get();
    }
}
