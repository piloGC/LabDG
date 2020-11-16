<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','user']);
    }
    public function index(){
        
        $usuario =auth()->user();

        return view('alumno.index',compact('usuario'));
    }
}
