<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_room extends Model
{
    protected $table = 'class_rooms';

    protected $fillable = ['name', 'grade', 'institution_id'];

    public function institution(){
    	return $this->belongsTo('App\Institution');
    }

    public function students(){
    	return $this->hasMany('App\Student');
    }

    public function pre_icfes(){
    	return $this->hasMany('App\Pre_icfes');
    }
}
