<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Question;
use App\Pre_icfes_result;
use App\Student_pre_icfes_questions;

class Pre_icfes extends Model
{
    protected $table = 'pre_icfes';

    protected $fillable = ['name', 'description', 'grade', 'start_date',  'end_date','class_room_id'];

    public function class_room(){
    	return $this->belongsTo('App\Class_room');
    }

    public function students(){
    	return $this->belongsToMany('App\Student', 'student_pre_icfes_questions')
    				->withPivot('question_id', 'option_id');
    }

    public function questions(){
    	return $this->belongsToMany('App\Question', 'student_pre_icfes_questions')
    				->withPivot('student_id', 'option_id');
    }

    public function results(){
    	return $this->hasMany('App\Pre_icfes_result');
    }

    public function areas(){
    	return $this->belongsToMany('App\Area');
    }

    public static function getMonhtPreicfes($class_room_id, $start_date){

        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
        $nameMonth = jdmonthname(gregoriantojd($start_date->month,1,1), CAL_MONTH_GREGORIAN_LONG);

        $first_day = new Carbon("first day of $nameMonth $start_date->year");
        $last_day = new Carbon("last day of $nameMonth $start_date->year");

        return Pre_icfes::whereBetween('start_date', [
                            $first_day->toDateTimeString(),
                            $last_day->toDateTimeString()
                        ])->where('class_room_id', '=', $class_room_id)
                        ->get();
    }

    public static function getActivePreicfes($class_room_id){

        return  Pre_icfes::select('*')
                        ->where([
                            ['state', '=', 'pendiente'],
                            ['class_room_id', '=', $class_room_id],
                        ])->get();
    }

    public static function getPreicfesByStudent($student_id){   

        return Pre_icfes::select('pre_icfes.*')
                ->join('student_pre_icfes_questions', 'pre_icfes.id', '=', 'student_pre_icfes_questions.pre_icfes_id')
                ->where([
                            ['student_pre_icfes_questions.student_id', '=', $student_id],
                            ['pre_icfes.state', '=', 'finalizado']
                        ])
                ->groupBy('student_pre_icfes_questions.pre_icfes_id')
                ->get();
    }

    public static function getQestionByArea($area){

        $area_db = DB::table('areas')->where('name','=',$area)->first();

        $area_obj = Area::find($area_db->id);

        $ids=array();
        
        foreach($area_obj->asignatures as $asignature){
            array_push($ids, $asignature->id);
        }

        return  Question::where(function($query) use ($ids){
                    foreach($ids as $id){
                        $query->orwhere('asignature_id', '=', $id);
                    }
                })
                ->inRandomOrder()
                ->take(8)->get();
    }

    public static function getAnwserTest($pre_icfes_id, $student_id){
        $anwsers = Student_pre_icfes_questions::select('*')
                ->where([
                    ['student_id', '=', $student_id],
                    ['pre_icfes_id', '=', $pre_icfes_id]
                ])
                ->get();
        
        $anwsers->each(function($anwsers){
            $anwsers->question->asignature->area;
            $anwsers->question->options;
        });

        return $anwsers;
    }

    public static function qualifyTest($pre_icfes_id, $student_id, $area_id){ 
        
        $anwsers_resp   = Pre_icfes::getAnwserTest($pre_icfes_id, $student_id);
        $anwsers_new    = array();

        foreach($anwsers_resp as $anwser)
            if($anwser->question->asignature->area_id == $area_id)
                array_push($anwsers_new, $anwser);

        $value_question = round(100 / count($anwsers_new), 2);
        $score          = 0;

        foreach($anwsers_new as $anwser)
            foreach($anwser->question->options as $option)
                if( ($anwser->option_id == $option->id) && ($option->value) )
                    $score +=$value_question;        

        $score      = (int) round($score, 0);
        $respResult = Pre_icfes_result::getResult($student_id, $pre_icfes_id);
        $preicfesR  = (count($respResult) > 0) ? $respResult : new Pre_icfes_result();
        $field      = $preicfesR->saveScore($score, $area_id-1);


        $preicfesR->$field          = $score;
        $preicfesR->student_id      = $student_id;
        $preicfesR->pre_icfes_id    = (int) $pre_icfes_id;
        $preicfesR->save();
        // Pre_icfes::saveResult($preicfesR);
        
    }

    public static function saveResult(Pre_icfes_result $result){
        // $result->save();
    }

    public static function getResultByStudent($student_id, $pre_icfes_id){
        
    }
}
