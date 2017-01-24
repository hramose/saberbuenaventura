<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;

class MailController extends Controller
{
 	
 	public function contact(Request $request){
 		Mail::send('email.contact', $request->all(), function($msj){
 			$msj->subject('Correo de contacto');
 			$msj->to('saberbuenaventura@gmail.com');
 		});
 		// dd($request->all());
 		return redirect('/');
 	}   
}
