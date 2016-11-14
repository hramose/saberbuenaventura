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
use App\Http\Requests\StudentRequest;
use App\Http\Requests\ChangePasswordRequest;

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
        $students = Student::orderBy('id', 'DES')->paginate(3);


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

        return redirect()->route('institution.student.index');
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
        $student = Student::find($id);
        $classrooms = Class_room::where('institution_id', '=', Auth()->guard('institutions')->user()->id)->lists('name', 'id');

        return  view('institution.partials.student.edit')
                ->with('student', $student)
                ->with('classrooms', $classrooms);
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
        $student = Auth()->guard('students')->user();

        if($request->input('request') == 'changePass'){

            $rules = [
                'current_password'      =>  'required|min:4',
                'password'              =>  'required|min:4|confirmed',
                'password_confirmation' =>  'required|min:4',
            ];

            $messages = [
                'current_password.required'         =>  'La contraseña actual es requerida',
                'current_password.min:4'            =>  'La contraseña actual debe de ser minimo de 4 caracteres',
                'password.confirmed'                =>  'Las contraseñas no coinciden',
                'password_confirmation.required'    =>  'La confirmación de la contraseña es requerida',
                'password_confirmation.min:4'       =>  'La confirmación de la contraseña actual debe de ser minimo de 4 caracteres',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()){

                return redirect('student/editPass')
                        ->withErrors($validator)
                        ->withInput();
            }else{
                if(Hash::check($request->current_password, $student->password)){
                    $student_obj = new Student();
                    $student_obj->where('email','=',$student->email)
                                ->update([
                                    'password' => bcrypt($request->password)
                                ]);

                    flash('La contraseña se ha actualizado correctamente', 'success');
                    return redirect()->route('student.about');
                }else{
                    return redirect('student/editPass')
                            ->with('message', 'Contraseña incorrecta');
                }
            } 
        }else if($request->input('request') == 'changeInfo'){
            $rules = [
                'name'      =>  'required|min:2',
                'last_name' =>  'required|min:4',
                'sex'       =>  'required',
                'birthday'  =>  'required',
            ];

            $messages = [
                'name.required'      =>  'La contraseña actual es requerida',
                'name.min:2'         =>  'La contraseña actual debe de ser minimo de 4 caracteres',
                'last_name.required' =>  'Las contraseñas no coinciden',
                'last_name.min:2'    =>  'La confirmación de la contraseña es requerida',
                'sex.required'       =>  'La confirmación de la contraseña actual debe de ser minimo de 4 caracteres',
                'birthday'           =>  'required',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()){

                return redirect('student/editInfo')
                        ->withErrors($validator)
                        ->withInput();
            }else{
                $student_obj    =   Student::find($student->id);
                $student_obj->fill($request->all());
                $student_obj->save();

                flash('Los datos se han actualizado correctamente', 'success');
                return redirect()->route('student.about');
            }
        }else{

            $student           = Student::find($id);
            $student->fill($request->all());
            $student->password = bcrypt($request->password);
            $student->save();

            flash("Se han Actualizados los datos del estudiante <b>$student->name $student->last_name</b> correctamente", 'success');

            return redirect()->route('institution.student.index');
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

    public function dasboardIndex(){

        $student = Auth()->guard('students')->user();
        return  view('student.template.home.home')
                ->with('student', $student);
    }

    public function viewProfile(){
        
    }

    public function about(){
        $student = Auth()->guard('students')->user();
        
        return view('student.template.profile.about')->with('student', $student);
        
    }
    
    public function preicfesAll(){
        $student = Auth()->guard('students')->user();

        $pre_icfess = Pre_icfes::getPreicfesByStudent($student->id);

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

    public function editPass(){
        $student = Auth()->guard('students')->user();

        return  view('student.template.profile.editPass')
                ->with('student', $student);
    }
}
