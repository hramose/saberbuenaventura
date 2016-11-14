<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_option extends Model
{
    protected $table = 'question_options';

    protected $fillable = ['option', 'option_type', 'value', 'question_id'];

    public function question(){
    	return $this->belongsTo('App\Question');
    }

    public function student_pre_icfes_questions(){
    	return $this->hasMany('App\Student_pre_icfes_questions');
    }
}
