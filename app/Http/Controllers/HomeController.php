<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Student;
use App\Pre_icfes_result;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        // phpinfo();

        // dd($results);
        return view('home');
    }

    public function certificate(){

        return view('certificate');
        
    }

    public function getCertificates(Request $request, $number_document, $type_document){

        if($request->ajax()){
            $student = Student::getByCedula($number_document, $type_document);

            // dd($student)            
            if(count($student) == 0){
                $view = '<h2 class="text-center">No hay resultado</h2>';
            
            }else{
                $student->results;
                $view = view('sectionRender.certificate')->with('student', $student)->render();
            }
            
            return response()->json(array('view' => $view));
        }
    }
}
