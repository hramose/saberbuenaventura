<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthAdminController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/admin';
    protected $loginView = 'auth.admin.login';
    protected $guard = 'admins';
}
