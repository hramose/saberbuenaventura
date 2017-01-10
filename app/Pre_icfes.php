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
                        ->orwhere('state', '=', 'en curso')
                        ->orwhere('state', '=', 'pediente')
                        ->where('class_room_id', '=', $class_room_id)
                        ->get();
    }

    public static function getPreicfesByStudent($student_id, $type){   

        if($type == "questions"){
            $pre_icfes = Pre_icfes::select('pre_icfes.*')
                ->join('student_pre_icfes_questions', 'pre_icfes.id', '=', 'student_pre_icfes_questions.pre_icfes_id')
                ->where([
                            ['student_pre_icfes_questions.student_id', '=', $student_id],
                            ['pre_icfes.state', '=', 'finalizado']
                        ])
                ->groupBy('student_pre_icfes_questions.pre_icfes_id')
                ->get();    

        }else if($type == "results"){
            
            $pre_icfes = Pre_icfes::select('pre_icfes.*')
                ->join('pre_icfes_result', 'pre_icfes.id', '=', 'pre_icfes_result.pre_icfes_id')
                ->where([
                            ['pre_icfes_result.student_id', '=', $student_id],
                            ['pre_icfes.state', '=', 'finalizado']
                        ])
                ->groupBy('pre_icfes_result.pre_icfes_id')
                ->get();
        }

        return $pre_icfes;
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
                ->take(25)->get();
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
        $field      = $preicfesR->saveScore($score, $area_id);


        $preicfesR->$field          = $score;
        $preicfesR->student_id      = $student_id;
        $preicfesR->pre_icfes_id    = (int) $pre_icfes_id;
        $preicfesR->save();
        // Pre_icfes::saveResult($preicfesR);
        
    }

    public static function saveTest($pre_icfes_id, $student_id){
        $preicfes           = Pre_icfes::find($pre_icfes_id);
        $preicfes_result    = Pre_icfes_result::getResult($student_id, $preicfes->id);

        $preicfes->areas;

        // dd($preicfes->areas);
        
        
        if($preicfes_result == null){
            $preicfes_result = new Pre_icfes_result();

            foreach($preicfes_result['fillable'] as $field){
                if($field != 'pre_icfes_id' && $field != 'student_id' && $field != 'codigo_registro')
                    $preicfes_result->$field = 0;
            }

            $preicfes_result->codigo_registro = 'SB'.time();
            $preicfes_result->student_id = $student_id;
            $preicfes_result->pre_icfes_id = $pre_icfes_id;
            $preicfes_result->save();
            
        }else{

            $sumPoint = 0;
            $sumWeighted = 0;
            $sumAreas = count($preicfes->areas);
            $indGlobal = 0;
            $total_score = 0;

            foreach($preicfes_result['attributes'] as $key => $value){
                
                foreach($preicfes->areas as $area){
                    $area_result = str_replace('_', ' ', $key);
                    if($area_result == $area->name){
                        if($value == null){
                            $value = 0;
                            $preicfes_result->$key = 0;
                        }
                        $sumPoint    += $value * $area->weighted_value;
                        $sumWeighted += $area->weighted_value;
                    }
                }
            }

            $indGlobal = round($sumPoint/$sumWeighted, 3);
            $total_score = ceil($indGlobal * $sumAreas);
            $preicfes_result->total_score = (int) $total_score;
            $preicfes_result->codigo_registro = 'SB'.time();
            $preicfes_result->save();
        }
    }

    public static function getResultByStudent($student_id, $pre_icfes_id){
        
    }
}
