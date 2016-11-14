<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Class_room;
use App\Http\Requests\ClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Class_room::orderBy('name', 'ASC')->paginate(5);

        return  view('institution.partials.classroom.index')
                ->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institution.partials.classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {   

        $classroom = new Class_room($request->all());
        
        // dd($classroom);
        $classroom->save();

        flash("El salon de clase <b>$request->name</b> se ha creado correctamente", 'success');

        return redirect()->route('institution.classroom.index');
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
        $classroom = Class_room::find($id);

        return  view('institution.partials.classroom.edit')
                ->with('classroom', $classroom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request, $id)
    {   
        $classroom          = Class_room::find($id);
        $classroom->name    = $request->name;
        $classroom->grade   = $request->grade;
        $classroom->save();

        flash("El salon de clase <b>$request->name</b> se ha actualizado correctamente", 'success');

        return redirect()->route('institution.classroom.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom          = Class_room::find($id);
        $classroom->delete();
        flash("El salon de clase <b>$classroom->name</b> se ha eliminado correctamente", 'success');

        return redirect()->route('institution.classroom.index');
    }
}
