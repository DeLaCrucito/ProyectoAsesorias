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
        $this->validate($request, [
            'facultad' => 'required',
            'nombre' => 'required',
        ],[
            'facultad.required' => 'Debe seleccionar una facultad',
            'nombre.required' => 'Es necesario ingrasar el nombre'
        ]);

        $Degree = new Degree();
        $Degree-> facultad = $request->facultad;
        $Degree-> nombre = $request->nombre;
        $Degree-> semestres = $request->semestres;
        $Degree-> save();
        return view('administrador.licenciatura.ajax.exito');
    }

    public function read(Request $request){
        $facultads = Faculty::all(['id', 'nombre']);
        $vista = view('administrador.licenciatura.read')->with('facultads',$facultads);
        if($request->ajax()){
            $facultad = $request->facultad;
            $degrees = Degree::where('facultad', '=', $facultad)->paginate(5);
            return view('administrador.licenciatura.ajax.tabla', compact('degrees'))->with('facultads',$facultads);
        }
        return $vista;
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $facultad = $request->facultad;
            $degrees = Degree::where('facultad', '=', $facultad)->paginate(5);
            $datos = compact('degrees',$degrees);
            $vista = view('administrador.licenciatura.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function edit(Degree $degree){
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.licenciatura.edit', compact('degree'))->with('facultads',$facultads);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'facultad' => 'required',
            'nombre' => 'required',
            'semestres' => 'required'
        ],[
            'facultad.required' => 'Debe seleccionar una facultad',
            'nombre.required' => 'Es necesario ingrasar el nombre',
            'semestres.required' => 'Debe introducir los semestres'
        ]);

        $Degree = Degree::findOrFail($id);
        $Degree -> facultad = $request -> facultad;
        $Degree -> nombre = $request -> nombre;
        $Degree -> semestres = $request -> semestres;
        $Degree->save();

        return view('administrador.licenciatura.ajax.exito');
    }

}

