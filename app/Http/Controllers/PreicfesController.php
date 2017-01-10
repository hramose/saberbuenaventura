<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Class_room;
use App\Student;
use App\Institution;
use App\Area;
use App\Pre_icfes;
use App\Pre_icfes_result;
use App\Asignature;
use Carbon\Carbon;
use DB;
use App\Date;

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
        $institution = Auth()->guard('institutions')->user();
        $preicfess = Institution::getPreicfes($institution->id);
        // $preicfess = Pre_icfes::orderBy('name', 'DESC')->paginate(5);

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
        $institution = Auth()->guard('institutions')->user();
        $classrooms = Institution::getCloassroomsList($institution->id);
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

        $institution = Auth()->guard('institutions')->user();
        $classrooms = Institution::getCloassroomsList($institution->id);
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
        $preicfes  = Pre_icfes::find($id);
        $preicfes->delete();
        flash("Se ha eliminado el pre-ICFES <b>$preicfes->name</b> correctamente",'success');

        return redirect()->route('institution.preicfes.index');
    }

    public function PreIcfeschangeStatus(Request $request,$status, $idpreicfes){
        if($request->ajax()){
            $pre_icfes = Pre_icfes::find($idpreicfes);

            if($pre_icfes->state == "en curso" || $pre_icfes->state == "pendiente"){
                $pre_icfes->state = $status;
                $pre_icfes->save();
            }
            return response()->json($pre_icfes);
        }
    }

    public function descriptionTest($id){
        $student    = Auth()->guard('students')->user();
        $preicfes   = Pre_icfes::find($id);
        $preicfes_result    = count(Pre_icfes_result::getResult($student->id, $preicfes->id));
        $preicfes->areas;

        if($preicfes->state == "finalizado"){
            return redirect()->route('student.preicfesAll');
        }

        return view('student.template.preicfes.descriptionTest')
                ->with('student_id', $student->id)
                ->with('preicfes', $preicfes)
                ->with('preicfes_result', $preicfes_result);
    }

    public function preicfesTest($id, $area, $area_id){
        $student    = Auth()->guard('students')->user();
        $area       = str_replace('-',' ',$area);
        
        $preicfes   = Pre_icfes::find($id);
        $questions  = Pre_icfes::getQestionByArea($area);
        $anwsers    = Pre_icfes::getAnwserTest($id, $student->id);

        $action     = 'insert';

        if(count($anwsers) > 0){
            $hasQuestion = false;

            foreach ($anwsers as $anwser) {
                if($anwser->question->asignature->area->id == $area_id){
                    $question_rel = $anwser->question;
                    $question_rel->competence;
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
                $questions->competence;
            });    
        }
        
        if($area == "ingles"){
            $part1 = array();
            $part2 = array();
            $part3 = array();
            $part4 = array();
            $part5 = array();
            $part6 = array();
            $part7 = array();

            if($action == "insert"){
                foreach($questions as $question){
                    if($question->competence->name=="parte 1")
                        array_push($part1, $question);
                    else if($question->competence->name=="parte 2")
                        array_push($part2, $question);
                    else if($question->competence->name=="parte 3")
                        array_push($part3, $question);
                    else if($question->competence->name=="parte 4")
                        array_push($part4, $question);
                    else if($question->competence->name=="parte 5")
                        array_push($part5, $question);
                    else if($question->competence->name=="parte 6")
                        array_push($part6, $question);
                    else if($question->competence->name=="parte 7")
                        array_push($part7, $question);
                }
            }else if($action == "update"){

                foreach($questions as $question){
                    if($question->question->competence->name=="parte 1")
                        array_push($part1, $question);
                    else if($question->question->competence->name=="parte 2")
                        array_push($part2, $question);
                    else if($question->question->competence->name=="parte 3")
                        array_push($part3, $question);
                    else if($question->question->competence->name=="parte 4")
                        array_push($part4, $question);
                    else if($question->question->competence->name=="parte 5")
                        array_push($part5, $question);
                    else if($question->question->competence->name=="parte 6")
                        array_push($part6, $question);
                    else if($question->question->competence->name=="parte 7")
                        array_push($part7, $question);
                }
            }

            return  view('student.template.preicfes.preicfesTestIngles')
                ->with('part1', $part1)
                ->with('part2', $part2)
                ->with('part3', $part3)
                ->with('part4', $part4)
                ->with('part5', $part5)
                ->with('part6', $part6)
                ->with('part7', $part7)
                ->with('area', $area)
                ->with('pre_icfes_id', $id)
                ->with('area_id', $area_id)
                ->with('preicfes', $preicfes)
                ->with('action', $action);  
        }
        
        return  view('student.template.preicfes.preicfesTest')
                ->with('questions', $questions)
                ->with('area', $area)
                ->with('pre_icfes_id', $id)
                ->with('area_id', $area_id)
                ->with('preicfes', $preicfes)
                ->with('action', $action);
        
    }

    public function saveAnwser(Request $request){
        
        $student        = Auth()->guard('students')->user();
        $pre_icfes_id   = $request->pre_icfes_id;
        $anwsers        = explode(';', $request->anwser);

        foreach($anwsers as $anwser){
            $anwser_tmp     = explode('-', $anwser);
            $option_id      = $anwser_tmp[0];
            $question_id    = $anwser_tmp[1];

            DB::table('student_pre_icfes_questions')->insert([
                [
                    'question_id'   => $question_id, 
                    'pre_icfes_id'  => $pre_icfes_id, 
                    'student_id'    => $student->id,
                    'option_id'     => $option_id
                ]
            ]);   
        }

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

    public function saveTest(Request $request){
        Pre_icfes::saveTest((int) $request->pre_icfes_id, (int) $request->student_id);

        return redirect()->route('preicfes.showResults', $request->pre_icfes_id);
    }

    public function showResults($preicfes_id){
        $student = Auth()->guard('students')->user();
        $preicfes   = Pre_icfes::find($preicfes_id);

        $preicfes_result = Pre_icfes_result::getResult($student->id,$preicfes->id);
        
        if($preicfes_result == null){

            return view("student.template.preicfes.notresults")
                    ->with('result', $preicfes)
                    ->with('student', $student);
        }else{
            $preicfes_result->pre_icfes->areas;
            $preicfes_result->pre_icfes->classroom;

            return view("student.template.preicfes.results")
                    ->with('result', $preicfes_result)
                    ->with('student', $student);
        }
        
    }

    public function showResultsPDF($code){
        // $preicfes   = Pre_icfes::find($preicfes_id);

        $preicfes_result = Pre_icfes_result::getResultByCode($code);
        $student = Student::find($preicfes_result->student_id);
        $preicfes_result->pre_icfes->areas;
        $preicfes_result->pre_icfes->classroom;

        // $pdf->loadHTML('<h1>Test</h1>');
        $pdf = \App::make('dompdf.wrapper');
        
        $pdf = \PDF::loadView('pdf.resultTest',[
            'result' => $preicfes_result,
            'student'=> $student
        ]);
        return $pdf->stream('reporte.pdf');
        // return $pdf->download('prueba.pdf');
        // return view("student.template.results.result_table")
        //         ->with('result', $preicfes_result)
        //         ->with('student', $student);
        
    }
}