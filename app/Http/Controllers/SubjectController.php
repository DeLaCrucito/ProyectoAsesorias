<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);

        return view('administrador.unidada.create')
            ->with(compact('facultads',$facultads));
    }

    public function ajaxlicenciatura(Request $request){
        if($request->ajax()){
            $facultad = $request->facultad;
            $degrees = Degree::all(['id','facultad','nombre'])->where('facultad',$facultad);
            $datos = compact('degrees',$degrees);
            $vista = view('administrador.unidada.ajax.selectlicenciatura', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function create(Request $request)
    {
        $Subject = new Subject();
        $Subject-> licenciatura = $request->licen;
        $Subject-> nombre = $request->nombre;
        $Subject-> fase = $request->fase;
        $Subject-> semestre = $request->semestre;
        $Subject-> clave = $request->clave;
        $Subject-> save();
        return view('administrador.unidada.read');

    }
}
