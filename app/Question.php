<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['description', 'author_id', 'asignature_id', 'competence_id'];

    public function author(){
    	return $this->belongsTo('App\Author');
    }

    public function asignature(){
        return $this->belongsTo('App\Asignature');
    }

    public function competence(){
        return $this->belongsTo('App\Competence');
    }

    public function pre_icfes(){
    	return $this->belongsToMany('App\Pre_icfes', 'student_pre_icfes_questions')->withPivot('student_id', 'option_id');
    }

    public function students(){
    	return $this->belongsToMany('App\Student', 'student_pre_icfes_questions')
    				->withPivot('pre_icfes_id', 'option_id');
    }

    public function options(){
    	return $this->hasMany('App\Question_option');
    }

    public function student_pre_icfes_questions(){
        return $this->hasMany('App\Student_pre_icfes_questions');
    }

}
