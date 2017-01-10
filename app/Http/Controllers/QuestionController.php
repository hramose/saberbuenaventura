<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Area;
use App\Author;
use App\Question;
use App\Question_option;
use App\Asignature;
use App\Competence;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('id', 'DES')->paginate(5);

        $questions->each(function($questions){
            $questions->options;
            $questions->author;
            $questions->asignature;
            $questions->competence;
        });

        return  view('admin.partials.question.index')
                ->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $areas = Area::orderBy('id','ASC')->lists('name', 'id');
        $authors = Author::orderBy('id','ASC')->lists('source', 'id');

        return  view('admin.partials.question.create')
                ->with('areas', $areas)
                ->with('authors', $authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Question_option::saveOption($request);
 
        flash('La pregunta se ha creado correctamente', 'success');
        return redirect()->route('admin.question.index');
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
        $question = Question::find($id);
        $areas = Area::orderBy('id','ASC')->lists('name', 'id');
        $authors = Author::orderBy('id','ASC')->lists('source', 'id');
        $asignatures = Asignature::where('area_id','=', $question->asignature->area_id)->lists('name', 'id');
        $competences = Competence::where('area_id','=', $question->asignature->area_id)->lists('name', 'id');

        return  view('admin.partials.question.edit')
                ->with('question', $question)
                ->with('areas', $areas)
                ->with('authors', $authors)
                ->with('asignatures', $asignatures)
                ->with('competences', $competences);
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

        Question_option::updateOption($request, $id);
        // dd($request->all());
        // $question                       = Question::find($id);
        // $question->description          = $request->description;
        // $question->author_id            = $request->author_id;
        // $question->asignature_id        = $request->asignature_id;
        // $question->competence_id        = $request->competence_id;
        // $question->save();

        // $cont = 0;
        // foreach($request->option as $key => $value){
        //     $boolean = false;

        //     if($request->value[0] == $key) $boolean = true;

            // DB::table('question_options')
            //     ->where('id', $key)
            //     ->update([
            //         'option'        =>  $value[0],
            //         'option_type'   =>  $request->option_type,
            //         'value'         =>  $boolean,
            //         'question_id'   =>  $question->id,
            //         'created_at'    =>  date('Y-m-d H:m:i'),
            //         'updated_at'    =>  date('Y-m-d H:m:i')
            //     ]);
        // }

        flash('La pregunta se ha actualizo correctamente', 'success');
        return redirect()->route('admin.question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        flash('La pregunta se ha eliminado correctamente', 'success');
        return redirect()->route('admin.question.index');
    }
}
