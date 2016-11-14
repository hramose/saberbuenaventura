<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthInstitutionController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/institution';
    protected $loginView = 'auth.institution.login';
    protected $guard = 'institutions';
}
