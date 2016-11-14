<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Asignature;
use App\Area;
use App\Http\Requests\AsignatureRequest;

class AsignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignatures  = Asignature::orderBy('id', 'DESC')->paginate(5);
        
        $asignatures->each(function($asignatures){
            $asignatures->area;
        });

        return view('admin.partials.asignature.index')
               ->with('asignatures',$asignatures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::orderBy('id','DES')->lists('name', 'id');
        return view('admin.partials.asignature.create')
               ->with('areas', $areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsignatureRequest $request)
    {
        $asignature = new Asignature($request->all());
        $asignature->save();

        flash('La asignatura <b>'.$asignature->name.'</b> se ha creado correctamente', 'success');
        return redirect()->route('admin.asignature.index');
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
        $asignature = Asignature::find($id);
        $areas      = Area::orderBy('id','DES')->lists('name', 'id');

        return view('admin.partials.asignature.edit')
               ->with('asignature', $asignature)
               ->with('areas', $areas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AsignatureRequest $request, $id)
    {
        $asignature = Asignature::find($id);
        $asignature->fill($request->all());
        $asignature->save();

        flash('La asignatura <b>'.$asignature->name.'</b> se ha actualizado correctamente', 'success');
        return redirect()->route('admin.asignature.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignature = Asignature::find($id);
        $asignature->delete();
        
        flash('La asignatura <b>'.$asignature->name.'</b> se ha eliminado correctamente', 'success');
        return redirect()->route('admin.asignature.index');
    }
}
