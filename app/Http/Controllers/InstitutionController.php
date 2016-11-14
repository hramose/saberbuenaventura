<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InstitutionCreate;
use App\Http\Requests\InstitutionUpdate;
use App\Institution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $schools = Institution::orderBy('id', 'DES')->paginate('5');

        return view('admin.partials.institution.index')
                ->with('schools', $schools);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partials.institution.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionCreate $request)
    {
        
        $school = new Institution($request->all());
        $school->password = bcrypt($request->password);
        $school->save();

        flash('La institución <b>'.$school->name.'</b> se ha creado con exito', 'success');

        return redirect()->route('admin.institution.index');
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
        $school = Institution::find($id);

        return view('admin.partials.institution.edit')
               ->with('school', $school);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionUpdate $request, $id)
    {
        $school = Institution::find($id);
        $school->fill($request->all());
        $school->save();

        flash('La institución <b>'.$school->name.'</b> se ha actualizado con exito', 'success');
        return redirect()->route('admin.institution.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = Institution::find($id);
        $school->delete();

        flash('La institución <b>'.$school->name.'</b> se ha eliminado con exito', 'success');
        return redirect()->route('admin.institution.index');
    }


    public function dasboardIndex(){

        return view('institution.dashboard.index');
    }

    public function logout(){
        Auth()->guard('institutions')->logout();

        return redirect('/');
    }
}
