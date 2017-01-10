<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Performance_level;
use App\Area;

class Performance_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $performances = Performance_level::orderBy('id', 'DES')->paginate(5);
        return view('admin.partials.performance.index')
               ->with('performances', $performances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.partials.performance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $performance = new Performance_level();
        $performance->fill($request->all());
        $performance->save();

        flash('El nivel de desempeño ha sido creada con exito', 'success');

        return redirect()->route('admin.performance.index');
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
        $performance = Performance_level::find($id);
        $areas = Area::getAreaByGrade($performance->area->grade)->lists('name', 'id');

        return view('admin.partials.performance.edit')
               ->with('performance', $performance)
               ->with('areas', $areas);
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
        $performance = Performance_level::find($id);
        $performance->fill($request->all());
        $performance->save();

        flash('El nivel de desempeño ha sido actualizado con exito', 'success');

        return redirect()->route('admin.performance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $performance = Performance_level::find($id);
        $performance->delete();

        flash('El nivel de desempeño ha sido eliminado con exito', 'success');

        return redirect()->route('admin.performance.index');
    }
}
