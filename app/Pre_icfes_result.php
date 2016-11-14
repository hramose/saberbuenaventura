<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pre_icfes_result extends Model
{
    protected $table = 'pre_icfes_result';

    protected $fillable = ['critical_reading_score', 'math_score', 'social_score', 'natural_sciences_score', 'english_score', 'total_score', 'student_id', 'pre_icfes_id'];

    public function student(){
    	return; $this->belongsTo('App\Student');
    }

    public function pre_icfes(){
    	return $this->belongsTo('App\Pre_icfes');
    }

    public function saveScore($score, $area_id){
    	return $this->fillable[$area_id];
    }

    public static function getResult($student_id, $pre_icfes_id){
    	return  Pre_icfes_result::select('*')
                ->where([
                    ['student_id', '=', $student_id],
                    ['pre_icfes_id', '=', $pre_icfes_id]
                ])
                ->first();
    }

}