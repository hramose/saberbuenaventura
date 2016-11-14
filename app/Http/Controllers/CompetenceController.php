<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Area;
use App\Competence; 
use App\Http\Requests\CompetenceRequest;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competences = Competence::orderBy('id', 'DES')->paginate(5);
        $competences->each(function($competences){
            $competences->area;
        });

        return view('admin.partials.competence.index')
               ->with('competences', $competences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::orderBy('id','DES')->lists('name', 'id');
        return view('admin.partials.competence.create')
               ->with('areas', $areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetenceRequest $request)
    {
        $competence = new Competence($request->all());
        $competence->save();

        flash('La competencia <b>'.$competence->name.'</b> se ha creado correctamente', 'success');
        return redirect()->route('admin.competence.index');
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
        $competence = Competence::find($id);
        $areas      = Area::orderBy('id','DES')->lists('name', 'id');

        return view('admin.partials.competence.edit')
               ->with('competence', $competence)
               ->with('areas', $areas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompetenceRequest $request, $id)
    {
        $competence          = Competence::find($id);
        $competence->name    = $request->name;
        $competence->area_id = $request->area_id;
        $competence->save();

        flash('La competencia <b>'.$competence->name.'</b> se ha actualizado correctamente', 'success');
        return redirect()->route('admin.competence.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competence = Competence::find($id);
        $competence->delete();

        flash('La competencia <b>'.$competence->name.'</b> se ha eliminado correctamente', 'success');
        return redirect()->route('admin.competence.index');
    }
}
