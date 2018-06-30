<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Faculty;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.usuarios.asesor.create')
            ->with(compact('facultads', $facultads));
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $asesor = $request->asesor;
            $consultants = Consultant::where('nombre', 'like','%'. $asesor.'%')->paginate(5);
            $datos = compact('consultants',$consultants);
            $vista = view('administrador.usuarios.asesor.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'nivel_estudio' => 'required',
            'especialidad' => 'required',
            'correo' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ],[
            'nombre.required' => 'Es necesario ingresar un nombre',
            'apellido.required' => 'Es necesario ingresar un apellido',
            'nivel_estudio.required' => 'Es necesario ingresar un nivel de estudio',
            'especialidad.required' => 'Es necesario ingresar una especialidad',
            'correo.required' => 'Es necesario ingresar un email',
            'correo.email' => 'Debe introducir un correo electrónico válido',
            'password.required' => 'Es necesario una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
        ]);

        $Consultant = new Consultant();
        $Consultant->nombre = $request->nombre;
        $Consultant->apellido = $request->apellido;
        $Consultant->nivel_estudio = $request->nivel_estudio;
        $Consultant->especialidad = $request->especialidad;
        $Consultant->correo = $request->correo;
        $Consultant->password = $request->password;
        $Consultant->save();

        return view('administrador.usuarios.asesor.ajax.exito');
    }

    public function read(Request $request){
        $vista = view('administrador.usuarios.asesor.read');
        if($request->ajax()){
            $asesor = $request->asesor;
            $consultants = Consultant::where('nombre', 'like','%'. $asesor.'%')->paginate(5);
            $datos = compact('consultants',$consultants);
            $vista = view('administrador.usuarios.asesor.ajax.tabla', $datos)->render();
        }
        return $vista;
    }

    public function edit(Consultant $consultant){
        $consultants = Consultant::all(['id','nombre','apellido','nivel_estudio','especialidad','correo']);
        return view('administrador.usuarios.asesor.edit',compact('consultant'))
            ->with(compact('consultants',$consultants));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'nivel_estudio' => 'required',
            'especialidad' => 'required',
            'correo' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ],[
            'nombre.required' => 'Es necesario ingresar un nombre',
            'apellido.required' => 'Es necesario ingresar un apellido',
            'nivel_estudio.required' => 'Es necesario ingresar un nivel de estudio',
            'especialidad.required' => 'Es necesario ingresar una especialidad',
            'correo.required' => 'Es necesario ingresar un email',
            'correo.email' => 'Debe introducir un correo electrónico válido',
            'password.required' => 'Es necesario una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
        ]);

        $Consultant = Consultant::findOrFail($id);
        $Consultant -> nombre = $request->nombre;
        $Consultant -> apellido = $request-> apellido;
        $Consultant -> nivel_estudio = $request -> nivel_estudio;
        $Consultant -> especialidad = $request -> especialidad;
        $Consultant -> correo = $request -> correo;
        $Consultant -> password = bcrypt($request->password);

        $Consultant -> save();

        return view('administrador.usuarios.asesor.ajax.exito');
    }

}
