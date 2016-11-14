<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Class_room;
use App\Area;
use App\Pre_icfes;
use App\Pre_icfes_result;
use App\Asignature;
use Carbon\Carbon;
use DB;

class PreicfesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        Carbon::setLocale('es');
    }
    
    public function index()
    {   
        $preicfess = Pre_icfes::orderBy('name', 'DESC')->paginate(5);

        return  view('institution.partials.preicfes.index')
                ->with('preicfess', $preicfess);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $classrooms = Class_room::orderBy('name','ASC')->lists('name', 'id');
        $areas = Area::orderBy('name','ASC')->lists('name', 'id');

        return  view('institution.partials.preicfes.create')
                ->with('classrooms', $classrooms)
                ->with('areas', $areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $preicfesActive = Pre_icfes::getMonhtPreicfes($request->class_room_id, $request->start_date.' '.$request->hour_start);

        // dd($preicfesActive);
        if(count($preicfesActive) < 10){
            $preicfes = new Pre_icfes($request->all());
            $preicfes->state        =   'pendiente';
            $preicfes->start_date   =   $request->start_date.' '.$request->hour_start;
            $preicfes->end_date     =   $request->end_date.' '.$request->hour_end;
            $preicfes->save();

            $preicfes->areas()->sync($request->area_id);
            
            flash("Se ha actualizado el pre-ICFES <b>$preicfes->name</b> correctamente",'success');

            return redirect()->route('institution.preicfes.index');
        }

        flash("Solo se pueden crear dos <b>(2)</b> pruebas por salón en un mes",'danger');

        return redirect()->route('institution.preicfes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preicfes = Pre_icfes::find($id);
        
        $my_areas = $preicfes->areas->lists('id')->ToArray();

        $classrooms = Class_room::orderBy('name','ASC')->lists('name', 'id');
        $areas = Area::orderBy('name','ASC')->lists('name', 'id');

        return  view('institution.partials.preicfes.edit')
                ->with('preicfes', $preicfes)
                ->with('classrooms', $classrooms)
                ->with('areas', $areas)
                ->with('my_areas', $my_areas)
                ->with('start_date', explode(' ', $preicfes->start_date))
                ->with('end_date', explode(' ', $preicfes->end_date));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $preicfes               = Pre_icfes::find($id);
        $preicfes->fill($request->all());
        $preicfes->start_date   =   $request->start_date.' '.$request->hour_start;
        $preicfes->end_date     =   $request->end_date.' '.$request->hour_end;
        $preicfes->state        = $request->state;
        $preicfes->save();

        $preicfes->areas()->sync($request->area_id);

        flash("Se ha actualizado el pre-ICFES <b>$preicfes->name</b> correctamente",'success');

        return redirect()->route('institution.preicfes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preicfes               = Pre_icfes::find($id);
        $preicfes->delete();
        flash("Se ha eliminado el pre-ICFES <b>$preicfes->name</b> correctamente",'success');

        return redirect()->route('institution.preicfes.index');
    }

    public function description($id){

    }

    public function descriptionTest($id){

        $preicfes = Pre_icfes::find($id);

        $preicfes->areas;

        return view('student.template.preicfes.descriptionTest')
                ->with('preicfes', $preicfes);
    }

    public function preicfesTest($id, $area, $area_id){
        $student    = Auth()->guard('students')->user();
        $area       = str_replace('-',' ',$area);
        
        $questions  = Pre_icfes::getQestionByArea($area);
        $anwsers    = Pre_icfes::getAnwserTest($id, $student->id);

        $action     = 'insert';

        if(count($anwsers) > 0){
            $hasQuestion = false;

            foreach ($anwsers as $anwser) {
                if($anwser->question->asignature->area->id == $area_id){
                    $hasQuestion = true;
                }
            }

            if($hasQuestion){
                $questions = $anwsers;
                $action = 'update';
            }
        }else{
            $questions->each(function($questions){
                $questions->options;
            });    
        }
        
        // dd($questions);
        return  view('student.template.preicfes.preicfesTest')
                ->with('questions', $questions)
                ->with('area', $area)
                ->with('pre_icfes_id', $id)
                ->with('area_id', $area_id)
                ->with('action', $action);
        
    }

    public function saveAnwser(Request $request){
        
        $student        = Auth()->guard('students')->user();
        $pre_icfes_id   = $request->pre_icfes_id;
        $anwsers        = explode(';', $request->anwser);

        // foreach($anwsers as $anwser){
        //     $anwser_tmp     = explode('-', $anwser);
        //     $option_id      = $anwser_tmp[0];
        //     $question_id    = $anwser_tmp[1];

        //     DB::table('student_pre_icfes_questions')->insert([
        //         [
        //             'question_id'   => $question_id, 
        //             'pre_icfes_id'  => $pre_icfes_id, 
        //             'student_id'    => $student->id,
        //             'option_id'     => $option_id
        //         ]
        //     ]);   
        // }

        Pre_icfes::qualifyTest($pre_icfes_id, $student->id, $request->area_id);

        flash("Ha terminado las preguntas de <b>$request->asignature</b>",'success');

        return redirect()->route('preicfes.description', $pre_icfes_id);
    }

    public function updateAnwser(Request $request){
        
        $student        = Auth()->guard('students')->user();
        $pre_icfes_id   = $request->pre_icfes_id;
        $anwsers        = explode(';', $request->anwser);

        foreach($anwsers as $anwser){
            $anwser_tmp     = explode('-', $anwser);

            $option_id      = $anwser_tmp[0];
            $question_id    = $anwser_tmp[1];
            $anwser_id      = $anwser_tmp[2];
            
            DB::table('student_pre_icfes_questions')
                ->where('id',$anwser_id)
                ->update(['option_id' => $option_id]);   
        }

        Pre_icfes::qualifyTest($pre_icfes_id, $student->id, $request->area_id);
        
        flash("Se han actualizados las preguntas de <b>$request->asignature</b>",'success');

        return redirect()->route('preicfes.description', $pre_icfes_id);
    }


    public function showResults($preicfes_id){
        $student = Auth()->guard('students')->user();

        // $result = Pre_icfes::getResultByStudent($student->id, $preicfes_id);

        // $anwsers = Pre_icfes::qualifyTest($preicfes_id, $student->id);

        // dd($anwsers);

    }
}