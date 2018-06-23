<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.licenciatura.create', compact('facultads', $facultads));
    }

    public function create(Request $request)
    {
        $Degree = new Degree();
        $Degree-> facultad = $request->facultad;
        $Degree-> nombre = $request->nombre;
        $Degree-> save();
        return view('administrador.facultad.read');
    }

}

