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
        $degree = Degree::findOrFail($licenciatura);
        $asesor = decrypt($request->consultant);
        $consultant = Consultant::where('id','=',$asesor)->first();
        $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
        $materias = array();
        foreach ($assigns as $assign){
            $materias[] = $assign->materia;
        }
        $subjects = (new \App\Models\Subject)->whereNotIn('id',$materias)->orderBy('semestre','asc')->paginate(5);

        $vista = view('coordinador.asignacion',compact('subjects'))
            ->with(compact('degree'))->with(compact('consultant'));
        if($request->ajax()){
            $semestre = $request->semestre;
            if(($semestre != 0)){
                $subjects = (new \App\Models\Subject)->whereNotIn('id',$materias)->where('licenciatura','=',$licenciatura)
                    ->where('semestre','=',$semestre)->paginate(5);
            }
            $vista = view('coordinador.ajax.tablaasignacion')->with(compact('subjects'))->with(compact('consultant'))->render();
        }
        return $vista;
    }

    public function tbasignacion(Request $request){
        if($request->ajax()){
            $semestre = $request->semestre;
            $asesor = $request->asesor;
            $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
            $materias = array();
            foreach ($assigns as $assign){
                $materias[] = $assign->materia;
            }
            $consultant = Consultant::where('id','=',$asesor)->first();
            $licenciatura = Auth::user()->licenciatura;
            $subjects = (new \App\Models\Subject)->whereNotIn('id',$materias)->where('licenciatura','=',$licenciatura)
                ->where('semestre','=',$semestre)->paginate(5);            $datos = compact('subjects',$subjects);
            $vista = view('coordinador.ajax.tablaasignacion', $datos)->with(compact('consultant'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function showDatos(){
        $id  =  Auth::id();
        $consultant = (new \App\Models\Consultant)->where('id','=',$id)->first();

        $solicituds = (new \App\Models\Request)->where('asesor','=',$id)->get();
        $ids = array();
        foreach ($solicituds as $solicitud){
            $ids[] = $solicitud->id;
        }

        $evaluations = (new \App\Models\Evaluation)->whereIn('solicitud',$ids)->count();
        $insuficiente = (new \App\Models\Evaluation)->whereIn('solicitud',$ids)->where('aprovechamiento','=',1)->count();
        $satisfactorio = (new \App\Models\Evaluation)->whereIn('solicitud',$ids)->where('aprovechamiento','=',2)->count();
        $bueno = (new \App\Models\Evaluation)->whereIn('solicitud',$ids)->where('aprovechamiento','=',3)->count();
        $excelente = (new \App\Models\Evaluation)->whereIn('solicitud',$ids)->where('aprovechamiento','=',4)->count();


        if ( $evaluations > 0){
            $insuficientes = $insuficiente/$evaluations*100;
            $satisfactorios = $satisfactorio/$evaluations*100;
            $buenos = $bueno/$evaluations*100;
            $excelentes = $excelente/$evaluations*100;
        } else{
            $insuficientes =0;
            $satisfactorios = 0;
            $buenos = 0;
            $excelentes = 0;
        }

        return view('asesor.home')->with(compact('consultant'))
            ->with(compact('insuficientes'))
            ->with(compact('satisfactorios'))
            ->with(compact('buenos'))
            ->with(compact('excelentes'));;
    }

    public function allSolicitudConsultant(Request $request){
        $asesor  =  Auth::id();
        $colecion = (new \App\Models\Request)->where('asesor','=',$asesor)->get();
        $materias =$colecion->unique('materia');
        $estados = $colecion->unique('estado');
        $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
        $facultades = array();
        foreach ($assigns as $assign){
            $facultades[] = $assign->subject->degree->facultad;
        }
        $faculties = (new \App\Models\Faculty())->whereIn('id',$facultades)->get();
        $solicituds = (new \App\Models\Request)->where('asesor','=',$asesor)->orderBy('fecha', 'asc')->paginate(5);
        $vista =  view('asesor.historial')->with(compact('solicituds'))->with(compact('materias'))->with(compact
        ('estados'))->with(compact('faculties'));
        if ($request->ajax()){
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$asesor)->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado != 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$asesor)
                    ->where('materia','=',$unidad)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado == 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$asesor)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad == 0 && $estado != 0){
                $solicituds = (new \App\Models\Request)->where('asesor','=',$asesor)
                    ->where('estado','=',$estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('asesor.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return $vista;
    }

    public function filtros(Request $request)
    {
        if ($request->ajax()) {
            $asesor = Auth::id();
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0) {
                $solicituds = (new \App\Models\Request)->where('asesor', '=', $asesor)->orderBy('fecha', 'asc')
                    ->paginate(5);
            } elseif ($unidad != 0 && $estado != 0) {
                $solicituds = (new \App\Models\Request)->where('asesor', '=', $asesor)
                    ->where('materia', '=', $unidad)
                    ->where('estado', '=', $estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            } elseif ($unidad != 0 && $estado == 0) {
                $solicituds = (new \App\Models\Request)->where('asesor', '=', $asesor)
                    ->where('materia', '=', $unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            } elseif ($unidad == 0 && $estado != 0) {
                $solicituds = (new \App\Models\Request)->where('asesor', '=', $asesor)
                    ->where('estado', '=', $estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('coordinador.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return response()->json(array('success' => true, 'html' => $vista));
    }

    function showunidades(Request $request){
        if ($request->ajax()){
            $semestre = $request->semestre;
            $licenciatura = $request->licenciatura;
            $asesor  =  Auth::id();
            $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
            $materias = array();
            foreach ($assigns as $assign){
                $semes = $assign->subject->semestre;
                $licen = $assign->subject->licenciatura;
                if ($licen == $licenciatura && $semestre == $semes){
                    $materias[] = $assign->materia;
                }
            }
            $subjects = (new \App\Models\Subject)->whereIn('id',$materias)->get();
            $vista = view('asesor.ajax.selectunidades', compact('subjects'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    function selectFacultad(Request $request){
        if ($request->ajax()){
            $id = $request->facultad;
            $asesor  =  Auth::id();
            $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
            $licenciaturas = array();
            foreach ($assigns as $assign){
                $licenciaturas[] = $assign->subject->licenciatura;
            }
            $degrees = (new \App\Models\Degree)->whereIn('id', $licenciaturas)->where('facultad','=',$id)->get();
            $vista = view('asesor.ajax.selectlicenciatura')->with(compact('degrees'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    function selectLicen(Request $request){
        if ($request->ajax()){
            $id = $request->licenciatura;
            $asesor  =  Auth::id();
            $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
            $semestres = array();
            foreach ($assigns as $assign){
                $licen = $assign->subject->licenciatura;
                if ($licen == $id){
                    $semestres[] = $assign->materia;
                }
            }
            $subject = Subject::whereIn('id',$semestres)->get();
            $subjects = $subject->unique('semestre');
            $vista = view('asesor.ajax.semestres')->with(compact('subjects'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function verDetalles(Request $request){
        $id = decrypt($request->id);
        $solicitud = (new \App\Models\Request)->where('id','=',$id)->first();
        return view('asesor.solicitud')->with(compact('solicitud'));
    }

    public function misMaterias(Request $request){
        $asesor  =  Auth::id();
        $assigns = (new \App\Models\Assignment)->where('asesor','=',$asesor)->get();
        $facultades = array();
        foreach ($assigns as $assign){
            $facultades[] = $assign->subject->degree->facultad;
        }
        $faculties = (new \App\Models\Faculty())->whereIn('id',$facultades)->get();
        $subjects = (new \App\Models\Subject)->whereHas('assignments',function ($query) use ($asesor){
            $query->where('asesor','=',$asesor);
        })->paginate(5);
        $vista =  view('asesor.unidades')->with(compact('subjects'))->with(compact
        ('estados'))->with(compact('faculties'));
        if ($request->ajax()){
            $asesor  =  Auth::id();
            $semestre = $request->semestre;
            $licenciatura = $request->licenciatura;
            if ($semestre != 0){
                $subjects = (new \App\Models\Subject)->whereHas('assignments',function ($query) use ($asesor){
                    $query->where('asesor','=',$asesor);
                })->where('semestre','=',$semestre)->where('licenciatura','=',$licenciatura)->paginate(5);
            }
            $vista = view('asesor.ajax.tablaunidades')->with(compact('subjects'))->render();
        }
        return $vista;
    }

    public function ajaxmismaterias(Request $request){
        if ($request->ajax()){
            $asesor  =  Auth::id();
            $semestre = $request->semestre;
            $licenciatura = $request->licenciatura;
            if ($semestre != 0){
                $subjects = (new \App\Models\Subject)->whereHas('assignments',function ($query) use ($asesor){
                    $query->where('asesor','=',$asesor);
                })->where('semestre','=',$semestre)->where('licenciatura','=',$licenciatura)->paginate(5);
            }
            $vista = view('asesor.ajax.tablaunidades')->with(compact('subjects'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function misHoras(Request $request){
        $asesor  =  Auth::id();
        $schedules = Schedule::with('consultant')->where('asesor','=',$asesor)->orderBy('dia','desc')->paginate(5);
        $vista = view('asesor.horarios')->with(compact('schedules'));
        if($request->ajax()){
            $vista = view('asesor.ajax.tablahoras')->with(compact('schedules'))->render();
        }
        return $vista;
    }

    public function detalleunidad(Request $request){
        $id = decrypt($request->id);
        $subject = (new \App\Models\Subject())->where('id','=',$id)->first();
        return view('asesor.ajax.unidad')->with(compact('subject'));
    }

}
