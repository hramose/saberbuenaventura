<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;
use App\Competence;
use App\Asignature;
use App\Http\Requests\AreaRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::orderBy('id', 'DES')->paginate(5);
        return view('admin.partials.area.index')
               ->with('areas', $areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.partials.area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $area                   = new Area($request->all());
        $area->weighted_value   = (int) $request->weighted_value;
        $area->save();

        flash('El area <b> '.$area->name.' </b> ha sido creada con exito', 'success');

        return redirect()->route('admin.area.index');
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
        $area = Area::find($id);

        return view('admin.partials.area.edit')
               ->with('area', $area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $area                   = Area::find($id);
        $area->fill($request->all());
        $area->weighted_value   = (int) $request->weighted_value;

        $area->save();

        flash('El area <b> '.$area->name.' </b> ha sido actualizada con exito', 'success');
        return redirect()->route('admin.area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();
        flash('El area <b> '.$area->name.' </b> ha sido eliminada con exito', 'success');

        return redirect()->route('admin.area.index');
    }


    public function getCompetencesByArea(Request $request, $id){
        if($request->ajax()){
            $competences = Competence::getCompetencesByArea($id);

            return response()->json($competences);
        }
    }

    public function getAsignaturesByArea(Request $request, $id){
        if($request->ajax() && $id != null){
            $asignatures = Asignature::getAsignaturesByArea($id);

            return response()->json($asignatures);
        }
    }
}
