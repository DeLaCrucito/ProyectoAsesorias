<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Models\Degree;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.usuarios.coordinador.create')
            ->with(compact('facultads',$facultads));
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $facultad = $request->facultad;
            $coordinators = Coordinator::whereHas('degree', function($query) use ($facultad) {
                $query->where('facultad','=',$facultad);
            })->paginate(5);
            $datos = compact('coordinators',$coordinators);
            $vista = view('administrador.usuarios.coordinador.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function create(Request $request){
        $this->validate($request, [
            'licen' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'nombre.required' => 'Debe seleccionar una facultad',
            'apellido.required' => 'Es necesario ingrasar el nombre',
            'email.required' => 'El cambo correo electrónico es obligatorio',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'password.required' => 'Debe introducir una clave válida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
        ]);

        $Coordinator = new Coordinator();
        $Coordinator -> licenciatura = $request->licen;
        $Coordinator -> nombre = $request-> nombre;
        $Coordinator -> apellido = $request -> apellido;
        $Coordinator -> correo = $request -> email;
        $Coordinator -> password = bcrypt($request->password);
        $Coordinator -> save();

        return view('administrador.usuarios.coordinador.ajax.exito');
    }

    public function read(Request $request){
        $facultads = Faculty::all(['id', 'nombre']);
        $vista = view('administrador.usuarios.coordinador.read')->with('facultads',$facultads);
        if($request->ajax()){
            $facultad = $request->facultad;
            $coordinators = Coordinator::whereHas('degree', function($query) use ($facultad) {
                $query->where('facultad','=',$facultad);
            })->paginate(5);
            $datos = compact('coordinators',$coordinators);
            $vista = view('administrador.usuarios.coordinador.ajax.tabla', $datos)->render();
            return $vista;
        }
        return $vista;
    }

    public function edit(Coordinator $coordinator){
        $facultads = Faculty::all(['id','nombre']);
        $degrees = Degree::all(['id','nombre','facultad']);
        return view('administrador.usuarios.coordinador.edit',compact('coordinator'))
            ->with(compact('facultads',$facultads))
            ->with(compact('degrees',$degrees));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'licen' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'nombre.required' => 'Debe seleccionar una facultad',
            'apellido.required' => 'Es necesario ingrasar el nombre',
            'usuario.required' => 'No se pudo encontrar la fase',
            'email.required' => 'El cambo semestre es obligatorio',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'password.required' => 'Es necesario una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
        ]);

        $Coordinator = Coordinator::findOrFail($id);
        $Coordinator -> licenciatura = $request->licen;
        $Coordinator -> nombre = $request-> nombre;
        $Coordinator -> apellido = $request -> apellido;
        $Coordinator -> correo = $request -> email;
        $Coordinator -> password = bcrypt($request->password);

        $Coordinator -> save();

        return view('administrador.usuarios.coordinador.ajax.exito');
    }
}
