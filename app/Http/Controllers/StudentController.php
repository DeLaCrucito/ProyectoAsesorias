<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Degree;
use App\Models\Faculty;
use App\Models\Subject;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.usuarios.usuario.create')
            ->with(compact('facultads', $facultads));
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $licenciatura = $request->licenciatura;
            $semestre = $request->semestre;
            $students = (new \App\Models\Student)->where('licenciatura','=',$licenciatura)->where('semestre','=',$semestre)->paginate(5);
            $vista = view('administrador.usuarios.usuario.ajax.tabla')->with(compact('students'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function create(Request $request){

        $this->validate($request, [
            'matri' => 'required|unique:students,matricula',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'facultad' => 'required',
            'licen' => 'required',
            'semestre' => 'required',
            'password' => 'required|confirmed|min:8'
        ],[
            'matri.required' => 'Es necesario ingresar una matricula',
            'nombre.required' => 'Es necesario ingresar el/los nombre(s)',
            'apellido.required' => 'Es necesario ingresar su(s) apellido(s)',
            'email.required' => 'Es necesario ingresar un email',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'facultad.required' => 'Debe seleccionar su facultad',
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
        $Student -> password = bcrypt($request->password);
        $Student -> save();

        return view('exito');
    }

    public function read(Request $request){
        $facultads = Faculty::all(['id', 'nombre']);
        $vista = view('administrador.usuarios.usuario.read')->with('facultads',$facultads);
        if($request->ajax()){
            $licenciatura = $request->licenciatura;
            $semestre = $request->semestre;
            $students = (new \App\Models\Student)->where('licenciatura','=',$licenciatura)->where('semestre','=',$semestre)->paginate(5);
            $datos = compact('students',$students);
            $vista = view('administrador.usuarios.usuario.ajax.tabla', $datos)->render();
        }
        return $vista;
    }

    public function edit(Request $request){
        $id = decrypt($request->id);
        $student = Student::where('id','=',$id)->first();
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
            'semestre' => 'required'
        ],[
            'matri.required' => 'Es necesario ingresar una matricula',
            'nombre.required' => 'Es necesario ingresar el/los nombre(s)',
            'apellido.required' => 'Es necesario ingresar su(s) apellido(s)',
            'email.required' => 'Es necesario ingresar un email',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'licen.required' => 'Debe seleccionar una licenciatura',
            'semestre.required' => 'Debe seleccionar un Semetre',
        ]);


        $Student = Student::findOrFail($id);
        $Student -> matricula = $request->matri;
        $Student -> nombre = $request-> nombre;
        $Student -> apellido = $request -> apellido;
        $Student -> correo = $request -> email;
        $Student -> licenciatura = $request -> licen;
        $Student -> semestre = $request -> semestre;
        if ($request->password != ''){
            $this->validate($request, [
                'password' => 'required|confirmed|min:8'
            ],[
                'password.required' => 'Es necesario una contraseña',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
            ]);
            $Student -> passwd = bcrypt($request->password);
        }


        $Student -> save();

        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

    public function register(){
        $facultads = Faculty::all(['id', 'nombre']);
        return view('registro', compact('facultads', $facultads));
    }

    public function ajaxlicenciatura(Request $request){
        if($request->ajax()){
            $facultad = $request->facultad;
            $degrees = Degree::all(['id','facultad','nombre'])->where('facultad',$facultad);
            $datos = compact('degrees',$degrees);
            $vista = view('alumno.ajax.selectlicenciatura', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function ajaxsemestre(Request $request){
        if($request->ajax()){
            $licenciatura = $request->licenciatura;
            $degree = Degree::findOrFail($licenciatura);
            $datos = compact('degree');
            $vista = view('alumno.ajax.semestres', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function showDatos(){
        $alumno  =  Auth::id();
        $student = Student::findOrFail($alumno);
        $datos = compact('student');
        return view('alumno.home',$datos);
    }

    public function destroy(Request $request){
        $id = decrypt($request->id);
        $post = (new \App\Models\Student)->where('id','=',$id)->first();
        $texto = $post->nombre.' '.$post->apellido.' se eliminó correctamente';
        $post -> delete();
        return redirect()->back()->with('message',$texto);
    }

    function addSolicitud(){
        $alumno  =  Auth::id();
        $student = (new \App\Models\Student)->findOrFail($alumno);

        $month = Carbon::now();
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();
        $fechas = array();
        $period = CarbonPeriod::create($start, $end);
        foreach ($period as $date) {
            if (Carbon::parse($date)->isWeekend()){
                $fechas[] = $date;
            }

        }

        return view('alumno.newsolicitud',compact('student'))->with(compact('fechas'));
    }

    function showunidades(Request $request){
        if ($request->ajax()){
            $licenciatura =  Auth::user()->licenciatura;
            $semestre = $request->semestre;
            $subjects = Subject::where('licenciatura','=',$licenciatura)->where('semestre','=', $semestre)->get();
            $vista = view('alumno.ajax.selectunidades', compact('subjects'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    function showasesores(Request $request){
        if ($request->ajax()){
            $materia = $request->materia;
            $assignments = Assignment::where('materia','=',$materia)->get();
            $vista = view('alumno.ajax.selectasesor', compact('assignments'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    function showHoras(Request $request){
        if ($request->ajax()){
            $fecha = date($request->fecha);
            $asesor = $request->asesor;
            $dia =  date('w', strtotime( $fecha));
            $schedules = Schedule::where('asesor','=',$asesor)->where('dia','=',$dia)->get();
            $horas = \App\Models\Request::where('asesor','=',$asesor)->get();
            $validas = array();
            foreach ($schedules as $schedule) {
                $start = strtotime($schedule->hr_inicio);
                $end = strtotime($schedule->hr_fin);
                while ($start < $end) {
                    $bandera = true;
                    foreach ($horas as $hora){
                        $fechasoli = $hora->fecha->format('Y-m-d');
                        if ($fecha === $fechasoli){
                            if ($start === strtotime($hora->fecha->format('H:i'))){
                                $bandera = false;
                                break;
                            }
                        }
                    }if ($bandera == 1){
                        $validas[] = $start;
                    }
                    $start = strtotime('+30 minutes', $start);
                }
            }
            $vista = view('alumno.ajax.selecthoras', compact('validas'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    function showHistorial(Request $request){
        $alumno  =  Auth::id();
        $colecion = \App\Models\Request::where('alumno','=',$alumno)->get();
        $materias =$colecion->unique('materia');
        $estados = $colecion->unique('estado');
        $solicituds = \App\Models\Request::where('alumno','=',$alumno)->orderBy('fecha', 'asc')->paginate(5);
        $vista =  view('alumno.historial')->with(compact('solicituds'))->with(compact('materias'))->with(compact('estados'));
        if ($request->ajax()){
            $alumno  =  Auth::id();
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado != 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)
                    ->where('materia','=',$unidad)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado == 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad == 0 && $estado != 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)
                    ->where('estado','=',$estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('alumno.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return $vista;
    }

    public function unidadHistorial(Request $request){
        if ($request->ajax()){
            $alumno  =  Auth::id();
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado != 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)
                    ->where('materia','=',$unidad)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado == 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad == 0 && $estado != 0){
                $solicituds = \App\Models\Request::where('alumno','=',$alumno)
                    ->where('estado','=',$estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('alumno.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));

    }

    public function estadoHistorial(Request $request){
        if ($request->ajax()){
            $request->unidad;
            $request->estado;
        }
    }
}
