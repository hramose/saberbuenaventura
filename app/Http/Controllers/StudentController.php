<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Validator;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use App\Class_room;
use App\Student;
use App\Pre_icfes;
use App\Institution;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;

class StudentController extends Controller
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
        // $students = Student::orderBy('id', 'DES')->paginate(3);
        $institution = Auth()->guard('institutions')->user();
        $students = Institution::getStudent($institution->id);
        
        // dd($students);

        return  view('institution.partials.student.index')
                ->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Class_room::where('institution_id', '=', Auth()->guard('institutions')->user()->id)->lists('name', 'id');

        return  view('institution.partials.student.create')
                ->with('classrooms', $classrooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {   
        $student = new Student($request->all());
        $student->state = 'activo';
        $student->password = bcrypt($request->password);

        $student->save();

        flash("El estudiante <b>$student->name $student->last_name</b> ha si creado correctamente", 'success');

        if($request->request_rol == 'admin') return redirect()->route('admin.institution.show', $request->institution_id);

        return redirect()->route('institution.student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $rol='')
    {
        $student = Student::find($id);
        $pre_icfes_result = $student->results;

        $pre_icfes_result->each(function($pre_icfes_result){
            $pre_icfes_result->pre_icfes->areas;
        });

        if($rol == 'admin'){
            $view = view('admin.partials.student.show');
        }
        else if($rol == 'institution'){
            $institution = Auth()->guard('institutions')->user();

            if($student->class_room->institution->id != $institution->id)
                return redirect()->back();

            $view = view('institution.partials.student.show');


        }

        return  $view
                ->with('student', $student)
                ->with('pre_icfes_result', $pre_icfes_result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id='', $rol='')
    {   
        $student = Student::find($id);
        $classrooms = Class_room::where('institution_id', '=', $student->class_room->institution->id)->lists('name', 'id');

        if($rol == 'student'){

            $view = view('student.template.profile.edit')->with('student', $student);

        }else if($rol == 'institution'){

            $view = view('institution.partials.student.edit')
                    ->with('student', $student)
                    ->with('classrooms', $classrooms);

        }else if($rol == 'admin'){
            $view = view('admin.partials.student.edit')
                    ->with('student', $student)
                    ->with('classrooms', $classrooms);
        }

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, $id)
    {   

        $student = Student::find($id);
        $student->fill($request->all());

        if($request->request_method == 'UpdateInfoFull'){
            
            $rules = [
                'type_document'         => 'required',
                'number_document'       => 'required|min:5|integer',
                'class_room_id'         => 'required',
                'email'                 => 'required|min:10|email',
            ];

            $messages = [
                'type_document.required'         =>  'El tipo de documento es requerido',
                'number_document.required'       =>  'El número de documento es requerido',
                'number_document.min:5'     =>  'El número de documento debe tener mas de 5 números',
                'number_document.integer'   =>  'El Número de documento debe ser númerico',
                'class_room_id.required'    =>  'El salón de clase es requerido',
                'email.required'            =>  'El email es requerido',
                'email.min:10'              =>  'El email debe tener minimo 10 caracteres',
                'email.email'               =>  'Ingrese un email valido'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()){

                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
            }
        }

        $student->save();
        flash("Información Actualizada con exito", 'success');

        if($request->request_rol == 'admin'){
            
            return redirect()->route('admin.student.show', [$student->id, 'admin']);

        }else if($request->request_rol == 'institution'){

            return redirect()->route('institution.student.show', [$student->id, 'institution']);

        }else{

            return redirect()->route('student.about');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student  = Student::find($id);
        $student->delete();


        flash("Se han Eliminado los datos del estudiante <b>$student->name $student->last_name</b> correctamente", 'success');

        return redirect()->route('institution.student.index');
    }

    public function logout(){
        Auth()->guard('students')->logout();

        return redirect('/');
    }
    
    public function dasboardIndex(){

        $student = Auth()->guard('students')->user();
        return  view('student.template.home.home');
    }

    public function viewProfile(){
        
    }

    public function about(){
        $student = Auth()->guard('students')->user();
        
        return view('student.template.profile.about')->with('student', $student);
        
    }
    
    public function preicfesAll(){
        $student = Auth()->guard('students')->user();

        $pre_icfess = Pre_icfes::getPreicfesByStudent($student->id, "questions");

        if(!isset($pre_icfess[0])){
            $pre_icfess = Pre_icfes::getPreicfesByStudent($student->id, "results");
        }

        $pre_icfess->each(function($pre_icfess){
            $pre_icfess->areas;
        });
        
        return view('student.template.preicfes.all')
                ->with('pre_icfess', $pre_icfess);
        
    }

    public function take_preicfes(){
        $student = Auth()->guard('students')->user();
        
        $pre_icfess = Pre_icfes::getActivePreicfes($student->class_room_id);
        
        $pre_icfess->each(function($pre_icfess){
            $pre_icfess->areas;
        });
        
        return  view('student.template.preicfes.take')
                ->with('pre_icfess', $pre_icfess);   
    }

    public function editInfo(){
        $student = Auth()->guard('students')->user();

        return  view('student.template.profile.edit')
                ->with('student', $student);   
    }

    public function changeMyPass(){

        $student = Auth()->guard('students')->user();

        return view('student.template.profile.editPass')
                ->with('student', $student);
    }

    public function editPass($id='', $rol){

        $student = Student::find($id);

        if($rol == 'admin'){
            $view = view('admin.partials.student.changePass');
        }else if($rol == 'institution'){
            $view = view('institution.partials.student.changePass');
        }


        return  $view->with('student', $student);
    }

    public function updatePass(UpdatePasswordRequest $request, $id){
        
        $student = Student::find($id);

        if($request->request_rol == 'student'){

            $rules = [
                'current_password'      =>  'required|min:4',
            ];

            $messages = [
                'current_password.required' =>  'La contraseña actual es requerida',
                'current_password.min:4'    =>  'La contraseña actual debe de ser minimo de 4 caracteres',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()){

                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
            }else{

                if(!Hash::check($request->current_password, $student->password)){

                    return  redirect()
                            ->back()
                            ->with('message', 'Contraseña incorrecta');
                }
            }

        }
        
        $student->password = bcrypt($request->password);
        $student->save();
        flash('La contraseña se ha actualizado correctamente', 'success');
        
        if($request->request_rol == 'admin'){
            
            return redirect()->route('admin.student.show', [$student->id, 'admin']);

        }else if($request->request_rol == 'institution'){

            return redirect()->route('institution.student.show', [$student->id, 'institution']);

        }else{

            return redirect()->route('student.about');

        }
    }
}
