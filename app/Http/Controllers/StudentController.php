<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Degree;
use App\Models\Faculty;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function nuevaSolicitud(){
        return view('alumno.confirmacion');
    }

    public function confirmaSolicitud(){
        return view('alumno.exito');
    }

    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.usuarios.usuario.create')
            ->with(compact('facultads', $facultads));
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $facultad = $request->facultad;
            $students = Student::whereHas('degree', function($query) use ($facultad) {
                $query->where('facultad','=',$facultad);
            })->paginate(5);
            $datos = compact('students',$students);
            $vista = view('administrador.usuarios.usuario.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function create(Request $request){
        $this->validate($request, [
            'matri' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'licen' => 'required',
            'semestre' => 'required',
            'password' => 'required|confirmed|min:8'
        ],[
            'matri.required' => 'Es necesario ingresar una matricula',
            'nombre.required' => 'Es necesario ingresar el/los nombre(s)',
            'apellido.required' => 'Es necesario ingresar su(s) apellido(s)',
            'email.required' => 'Es necesario ingresar un email',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'licen.required' => 'Debe seleccionar una licenciatura',
            'semestre.required' => 'Debe seleccionar un Semetre',
            'password.required' => 'Es necesario una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
        ]);

        $Student = new Student();
        $Student -> matricula = $request->matri;
        $Student -> nombre = $request-> nombre;
        $Student -> apellido = $request -> apellido;
        $Student -> correo = $request -> email;
        $Student -> licenciatura = $request -> licen;
        $Student -> semestre = $request -> semestre;
        $Student -> passwd = bcrypt($request->password);
        $Student -> save();

        return view('administrador.usuarios.usuario.ajax.exito');
    }

    public function read(Request $request){
        $facultads = Faculty::all(['id', 'nombre']);
        $vista = view('administrador.usuarios.usuario.read')->with('facultads',$facultads);
        if($request->ajax()){
            $facultad = $request->facultad;
            $students = Student::whereHas('degree', function($query) use ($facultad) {
                $query->where('facultad','=',$facultad);
            })->paginate(5);
            $datos = compact('students',$students);
            $vista = view('administrador.usuarios.usuario.ajax.tabla', $datos)->render();
            return $vista;
        }
        return $vista;
    }

    public function edit(Student $student){
        $facultads = Faculty::all(['id','nombre']);
        $degrees = Degree::all(['id','nombre','facultad']);
        return view('administrador.usuarios.usuario.edit',compact('student'))
            ->with(compact('facultads',$facultads))
            ->with(compact('degrees',$degrees));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'matri' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'licen' => 'required',
            'semestre' => 'required',
            'password' => 'required|confirmed|min:8'
        ],[
            'matri.required' => 'Es necesario ingresar una matricula',
            'nombre.required' => 'Es necesario ingresar el/los nombre(s)',
            'apellido.required' => 'Es necesario ingresar su(s) apellido(s)',
            'email.required' => 'Es necesario ingresar un email',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'licen.required' => 'Debe seleccionar una licenciatura',
            'semestre.required' => 'Debe seleccionar un Semetre',
            'password.required' => 'Es necesario una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
        ]);

        $Student = Student::findOrFail($id);
        $Student -> matricula = $request->matri;
        $Student -> nombre = $request-> nombre;
        $Student -> apellido = $request -> apellido;
        $Student -> correo = $request -> email;
        $Student -> licenciatura = $request -> licen;
        $Student -> semestre = $request -> semestre;
        $Student -> passwd = bcrypt($request->password);

        $Student -> save();

        return view('administrador.usuarios.usuario.ajax.exito');
    }
}
