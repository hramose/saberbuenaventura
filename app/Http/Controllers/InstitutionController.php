<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use App\Http\Requests;
use App\Http\Requests\InstitutionCreate;
use App\Http\Requests\InstitutionUpdate;
use App\Http\Requests\UpdatePasswordRequest;
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
        $institution = Institution::find($id);
        $class_rooms = $institution->class_rooms;
        $class_rooms->each(function($class_rooms){
            $class_rooms->students;
            $class_rooms->pre_icfes;
        });

        return view('admin.partials.institution.show')
                ->with('institution', $institution)
                ->with('class_rooms', $class_rooms);
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

    public function editPassByAdmin($id){

        $institution = Institution::find($id);

        // dd($institution);
        return  view('admin.partials.institution.editPass')
                ->with('institution',$institution);
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

    public function updatePass(UpdatePasswordRequest $request, $id){

        $institution = Institution::find($id);
        $institution->password = bcrypt($request->password);
        $institution->save();
        flash('La contraseña se ha actualizado correctamente', 'success');
        
        if($request->request_rol == 'admin'){
            
            return redirect()->route('admin.institution.show', $institution->id);

        }
        // else if($request->request_rol == 'institution'){

        //     return redirect()->route('institution.institution.show', [$institution->id, 'institution']);
        // }
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
