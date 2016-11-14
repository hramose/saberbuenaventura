<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthStudentController extends Controller
{
    use AuthenticatesAndRegistersUsers;


    protected $redirectTo = '/student';
    protected $loginView = 'auth.student.login';
    protected $guard = 'students';
}
