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
            'password' => 'required|confirmed|min:8',
            'lugar' => 'required'
        ],[
            'nombre.required' => 'Es necesario ingresar un nombre',
            'apellido.required' => 'Es necesario ingresar un apellido',
            'nivel_estudio.required' => 'Es necesario ingresar un nivel de estudio',
            'especialidad.required' => 'Es necesario ingresar una especialidad',
            'correo.required' => 'Es necesario ingresar un email',
            'correo.email' => 'Debe introducir un correo electrónico válido',
            'password.required' => 'Es necesario una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres',
            'lugar.required' => 'El campo lugar de asesorías es obligatorio'
        ]);

        $Consultant = new Consultant();
        $Consultant->nombre = $request->nombre;
        $Consultant->apellido = $request->apellido;
        $Consultant->nivel_estudio = $request->nivel_estudio;
        $Consultant->especialidad = $request->especialidad;
        $Consultant->correo = $request->correo;
        $Consultant->password = $request->password;
        $Consultant->lugar = $request->lugar;
        $Consultant->save();

        return view('administrador.usuarios.asesor.ajax.exito');
    }

    public function read(Request $request){
        $consultants = Consultant::with('schedules')->paginate(5);
        $vista = view('administrador.usuarios.asesor.read')->with(compact('consultants'));
        if($request->ajax()){
            $asesor = $request->asesor;
            if ($asesor != ''){
                $consultants = (new \App\Models\Consultant)->where('nombre', 'like','%'. $asesor.'%')->paginate(5);
            }
            $vista = view('administrador.usuarios.asesor.ajax.tabla')->with(compact('consultants'))->render();
        }
        return $vista;
    }

    public function edit(Request $request){
        $id = decrypt($request->id);
        $consultant = (new \App\Models\Consultant)->where('id','=',$id)->first();
        return view('administrador.usuarios.asesor.edit',compact('consultant'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'nivel_estudio' => 'required',
            'especialidad' => 'required',
            'correo' => 'required|email',
            'lugar' => 'required'
        ],[
            'nombre.required' => 'Es necesario ingresar un nombre',
            'apellido.required' => 'Es necesario ingresar un apellido',
            'nivel_estudio.required' => 'Es necesario ingresar un nivel de estudio',
            'especialidad.required' => 'Es necesario ingresar una especialidad',
            'correo.required' => 'Es necesario ingresar un email',
            'correo.email' => 'Debe introducir un correo electrónico válido',
            'lugar.required' => 'El campo lugar de asesorías es obligatorio'
        ]);

        $Consultant = (new \App\Models\Consultant)->findOrFail($id);
        $Consultant -> nombre = $request->nombre;
        $Consultant -> apellido = $request-> apellido;
        $Consultant -> nivel_estudio = $request -> nivel_estudio;
        $Consultant -> especialidad = $request -> especialidad;
        $Consultant -> correo = $request -> correo;
        if ($request->password != ''){
            $this->validate($request, [
                'password' => 'required|confirmed|min:8'
            ],[
                'password.required' => 'Es necesario una contraseña',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
            ]);
            $Consultant -> passwd = bcrypt($request->password);
        }
        $Consultant -> lugar = $request -> lugar;

        $Consultant -> save();

        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

    public function listaasesores(Request $request){
        $consultants = Consultant::with('schedules')->orderBy('apellido','asc')->paginate(5);
        $vista = view('coordinador.asesores')->with(compact('consultants'));
        if($request->ajax()){
            $especialidad = $request->especialidad;
            if ($especialidad != 'nada'){
                $consultants = Consultant::where('especialidad', '=',$especialidad)->orderBy('apellido','asc')
                    ->paginate(5);
            }
            $vista = view('coordinador.ajax.tablaasesor')->with(compact('consultants'))->render();
        }
        return $vista;
    }



    public function especialidad(Request $request){
        if($request->ajax()){
            $especialidad = $request->especialidad;
            $consultants = Consultant::where('especialidad', '=',$especialidad)->orderBy('apellido','asc')->paginate
            (5);
            $datos = compact('consultants',$consultants);
            $vista = view('coordinador.ajax.tablaasesor', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function destroy(Request $request){
        $id = decrypt($request->id);
        $post = (new \App\Models\Consultant)->where('id','=',$id)->first();
        $texto = $post->nombre.' '.$post->apellido.' se eliminó correctamente';
        $post -> delete();
        return redirect()->back()->with('message',$texto);
    }

    public function detalles(Request $request){
        $value = Auth::user()->licenciatura;
        $id = decrypt($request->id);
        $consultant = (new \App\Models\Consultant)->where('id','=',$id)->first();
        $schedules = Schedule::with('consultant')->where('asesor','=',$consultant->id)->orderBy('dia','desc')->get();
        $subjects = Assignment::with('subject')->where('asesor','=',$consultant->id)->paginate(5);
        $asignaturas = Assignment::with('subject')->where('asesor','=',$consultant->id)->get();
        $vista = view('coordinador.detalleasesor',compact('consultant'))->with(compact('subjects'))->with(compact('schedules'))->with(compact('asignaturas'));
        if($request->ajax()){
            $vista = view('coordinador.ajax.tabla_asignaturas',compact('subjects'))->with(compact('consultant'));
        }
        return $vista;
    }

    public function asignamateria(Request $request){
        $licenciatura = Auth::user()->licenciatura;
        $subjects = Subject::where('licenciatura','=',$licenciatura)->orderBy('semestre','asc')->paginate(5);
        $degree = Degree::findOrFail($licenciatura);
        $asesor = decrypt($request->consultant);
        $consultant = Consultant::where('id','=',$asesor)->first();
        $vista = view('coordinador.asignacion',compact('subjects'))
            ->with(compact('degree'))->with(compact('consultant'));
        if($request->ajax()){
            $semestre = $request->semestre;
            if(($semestre != 0)){
                $subjects = Subject::where('licenciatura','=',$licenciatura)->where('semestre','=',$semestre)->paginate(5);
            }
            $vista = view('coordinador.ajax.tablaasignacion')->with(compact('subjects'))->with(compact('consultant'))->render();
        }
        return $vista;
    }

    public function tbasignacion(Request $request){
        if($request->ajax()){
            $semestre = $request->semestre;
            $asesor = $request->asesor;
            $consultant = Consultant::where('id','=',$asesor)->first();
            $licenciatura = Auth::user()->licenciatura;
            $subjects = Subject::where('semestre', '=',$semestre)->where('licenciatura','=',$licenciatura)->paginate(5);
            $datos = compact('subjects',$subjects);
            $vista = view('coordinador.ajax.tablaasignacion', $datos)->with(compact('consultant'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function showDatos(){
        $id  =  Auth::id();
        $consultant = (new \App\Models\Consultant)->where('id','=',$id)->first();
        return view('asesor.home')->with(compact('consultant'));
    }

    public function allSolicitudConsultant(Request $request){
        $consultant  =  Auth::id();
        $consultant = (new \App\Models\Consultant)->where('id','=',$consultant)->first();
        $colecion = (new \App\Models\Request)->where('asesor','=',$consultant)->get();
        $materias =$colecion->unique('materia');
        $estados = $colecion->unique('estado');
        $solicituds = (new \App\Models\Request)->where('asesor','=',$consultant)->orderBy('fecha', 'asc')->paginate(5);
        $vista =  view('asesor.historial')->with(compact('solicituds'))->with(compact('materias'))->with(compact
        ('estados'))->with(compact('consultant'));
        if ($request->ajax()){
            $consultant  =  Auth::id();
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$consultant)->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado != 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$consultant)
                    ->where('materia','=',$unidad)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado == 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$consultant)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad == 0 && $estado != 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$consultant)
                    ->where('estado','=',$estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('asesor.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return $vista;
    }

}
