<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Degree;
use App\Models\Faculty;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $consultants = DB::table('consultants')->paginate(5);
        $datos = compact('consultants',$consultants);
        $vista = view('administrador.usuarios.asesor.read',$datos);
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

    public function listaasesores(Request $request){
        $consultants = DB::table('consultants')->paginate(5);
        $datos = compact('consultants',$consultants);
        $vista = view('coordinador.asesores',$datos);
        if($request->ajax()){
            $especialidad = $request->especialidad;
            $consultants = Consultant::where('especialidad', '=',$especialidad)->paginate(5);
            $datos = compact('consultants',$consultants);
            $vista = view('coordinador.ajax.tablaasesor', $datos)->render();
        }
        return $vista;
    }

    public function especialidad(Request $request){
        if($request->ajax()){
            $especialidad = $request->especialidad;
            $consultants = Consultant::where('especialidad', '=',$especialidad)->paginate(5);
            $datos = compact('consultants',$consultants);
            $vista = view('coordinador.ajax.tablaasesor', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function destroy(Request $request){
        $post = Consultant::findOrFail($request -> id);
        $post -> delete();
        return redirect()->route('viewasesor');
    }

    public function detalles(Request $request, Consultant $consultant){
        $value = Auth::user()->licenciatura;
        $schedules = Schedule::with('consultant')->where('asesor','=',$consultant->id)->get();
        $subjects = Assignment::with('subject')->where('asesor','=',$consultant->id)->paginate(5);
        $asignaturas = Assignment::with('subject')->where('asesor','=',$consultant->id)->get();
        $vista = view('coordinador.detalleasesor',compact('consultant'))->with(compact('subjects'))->with(compact('schedules'))->with(compact('asignaturas'));
        if($request->ajax()){
            $consultant = $consultant;
            $subjects = Assignment::with('subject')->where('asesor','=',$consultant->id)->paginate(5);
            $vista = view('coordinador.ajax.tabla_asignaturas',compact('subjects'))->with(compact('consultant'));
        }
        return $vista;
    }

    public function asignamateria(Request $request, Consultant $consultant){
        $licenciatura = Auth::user()->licenciatura;
        $subjects = Subject::where('licenciatura','=',$licenciatura)->paginate(5);
        $degree = Degree::findOrFail($licenciatura);
        $vista = view('coordinador.asignacion',compact('subjects'))
            ->with(compact('degree'))->with(compact('consultant'));
        if($request->ajax()){
            $asesor = $request->asesor;
            $semestre = $request->semestre;
            $subjects = Subject::where('semestre', '=',$semestre)->where('licenciatura','=',$licenciatura)->paginate(5);
            $datos = compact('subjects',$subjects);
            $vista = view('coordinador.ajax.tablaasignacion', $datos)->with(compact('consultant'))->render();
        }
        return $vista;
    }

    public function tbasignacion(Request $request){

        if($request->ajax()){
            $semestre = $request->semestre;
            $consultant = $request->asesor;
            $licenciatura = Auth::user()->licenciatura;
            $subjects = Subject::where('semestre', '=',$semestre)->where('licenciatura','=',$licenciatura)->paginate(5);
            $datos = compact('subjects',$subjects);
            $vista = view('coordinador.ajax.tablaasignacion', $datos)->with(compact('consultant'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }



}
