<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function nuevaSolicitud(){
        return view('alumno.confirmacion');
    }

    public function confirmaSolicitud(){
        return view('alumno.exito');
    }
}
