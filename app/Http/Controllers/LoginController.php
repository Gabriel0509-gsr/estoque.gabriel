<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function mostrarlogin(Request $request)
    {
        return view('login_aula');
    }
}
