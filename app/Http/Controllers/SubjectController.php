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

    public function ajaxsemestre(Request $request){
        if($request->ajax()){
            $licenciatura = $request->licenciatura;
            $degree = Degree::findOrFail($licenciatura);
            $datos = compact('degree');
            $vista = view('administrador.unidada.ajax.semestres', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $licenciatura = $request->licenciatura;
            $semestre = $request->semestre;
            $subjects = Subject::where([
                ['licenciatura', '=', $licenciatura],
                ['semestre', '=', $semestre]
            ])->paginate(5);
            $datos = compact('subjects',$subjects);
            $vista = view('administrador.unidada.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function create(Request $request){
        $this->validate($request, [
            'licen' => 'required',
            'nombre' => 'required',
            'fase' => 'required',
            'semestre' => 'required',
            'clave' => 'required',
            'tipo' => 'required'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'facultad.required' => 'Debe seleccionar una facultad',
            'nombre.required' => 'Es necesario ingrasar el nombre',
            'fase.required' => 'No se pudo encontrar la fase',
            'semestre.required' => 'El cambo semestre es obligatorio',
            'clave.required' => 'Debe introducir una clave válida',
            'tipo.required' => 'Debe seleccionar el tipo asignatura'
        ]);

        $Subject = new Subject();
        $Subject-> licenciatura = $request->licen;
        $Subject-> nombre = $request->nombre;
        $Subject-> fase = $request->fase;
        $Subject-> semestre = $request->semestre;
        $Subject-> clave = $request->clave;
        $Subject -> tipo = $request->tipo;
        $Subject-> save();
        return view('administrador.unidada.ajax.exito');
    }

    public function read(Request $request){
        $facultads = Faculty::all(['id', 'nombre']);
        $vista = view('administrador.unidada.read')->with('facultads',$facultads);
        if($request->ajax()){
            $licenciatura = $request->licenciatura;
            $semestre = $request->semestre;
            $subjects = Subject::where([
                ['licenciatura', '=', $licenciatura],
                ['semestre', '=', $semestre]
            ])->paginate(5);
            $datos = compact('subjects',$subjects);
            $vista = view('administrador.unidada.ajax.tabla', $datos)->render();
            return $vista;
        }
        return $vista;
    }

    public function edit(Subject $subject){
        $facultads = Faculty::all(['id', 'nombre']);
        $degrees = Degree::all(['id','nombre','facultad','semestres']);

        return view('administrador.unidada.edit',compact('subject',$subject))
            ->with(compact('facultads',$facultads))
            ->with(compact('degrees',$degrees))
            ;
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'licen' => 'required',
            'nombre' => 'required',
            'fase' => 'required',
            'semestre' => 'required',
            'clave' => 'required',
            'tipo' => 'required'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'facultad.required' => 'Debe seleccionar una facultad',
            'nombre.required' => 'Es necesario ingrasar el nombre',
            'fase.required' => 'No se pudo encontrar la fase',
            'semestre.required' => 'El cambo semestre es obligatorio',
            'clave.required' => 'Debe introducir una clave válida',
            'tipo.required' => 'Debe seleccionar el tipo asignatura'
        ]);

        $Subject = Subject::findOrFail($id);
        $Subject-> licenciatura = $request->licen;
        $Subject-> nombre = $request->nombre;
        $Subject-> fase = $request->fase;
        $Subject-> semestre = $request->semestre;
        $Subject-> clave = $request->clave;
        $Subject -> tipo = $request->tipo;
        $Subject-> save();
        return view('administrador.unidada.ajax.exito');
    }
}
