<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'students';

    protected $cast = [
    	'rol'   =>  'student'
    ];
    
    protected $fillable = ['name', 'last_name', 'type_document', 'number_document', 'sex', 'email', 'password', 'birthday', 'state', 'class_room_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function class_room(){
    	return $this->belongsTo('App\Class_room');
    }

    public function results(){
        return $this->hasMany('App\Pre_icfes_result');
    }

    public function questions(){
        return $this->belongsToMany('App\Question', 'student_pre_icfes_questions')
                    ->withPivot('pre_icfes_id', 'option_id');
    }

    public function pre_icfes(){
        return $this->belongsToMany('App\Pre_icfes', 'student_pre_icfes_questions')->withPivot('question_id', 'option_id');
    }

    public static function checkPassword($id, $password){
        return  Student::where([
                    ['id', '=', $id],
                    ['password', '=', $password],
                ])->get();
    }
}
