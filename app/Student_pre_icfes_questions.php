<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_pre_icfes_questions extends Model
{
    protected $table = 'student_pre_icfes_questions';

    protected $fillable = ['question_id', 'pre_icfes_id', 'student_id', 'option_id'];

    public function option(){
        return $this->belongsTo('App\Question_option');
    }

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
