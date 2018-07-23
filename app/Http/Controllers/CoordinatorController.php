<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Coordinator;
use App\Models\Degree;
use App\Models\Evaluation;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'licen' => 'required|exists:degrees,id',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|unique:coordinator,correo|max:255',
            'password' => 'required|confirmed|min:8|max:255'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'nombre.required' => 'Debe seleccionar una facultad',
            'apellido.required' => 'Es necesario ingrasar el nombre',
            'email.required' => 'El cambo correo electrónico es obligatorio',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'password.required' => 'Debe introducir una clave válida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña tiene que tener almenos 8 caracteres',
            'email.unique' => 'Ya existe un usuario con este correo',
            'licen.exists'=>'La licenciatura no es un dato válido',
            'nombre.max'=>'El campo nombre es demasiado largo, no debe exeder los 255 caracteres',
            'apellido.max'=>'El campo apellido es demasiado largo, no debe exeder los 255 caracteres',
            'email.max'=>'El campo correo es demasiado largo, no debe exeder los 255 caracteres',
            'password.max'=>'La contraseña demasiado larga, no debe exeder los 255 caracteres'
        ]);

        $Coordinator = new Coordinator();
        $Coordinator -> licenciatura = $request->licen;
        $Coordinator -> nombre = $request-> nombre;
        $Coordinator -> apellido = $request -> apellido;
        $Coordinator -> correo = $request -> email;
        $Coordinator -> password = bcrypt($request->password);

        try {
            $Coordinator -> save();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
        }

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

    public function edit(Request $request){
        $id = decrypt($request->id);
        $coordinator = (new \App\Models\Coordinator)->where('id','=',$id)->first();
        $facultads = Faculty::all(['id','nombre']);
        $degrees = Degree::all(['id','nombre','facultad']);
        return view('administrador.usuarios.coordinador.edit')
            ->with(compact('coordinator'))
            ->with(compact('facultads'))
            ->with(compact('degrees'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'licen' => 'required|exists:degrees,id',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|unique:coordinator,correo|max:255'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'nombre.required' => 'Debe seleccionar una facultad',
            'apellido.required' => 'Es necesario ingrasar el nombre',
            'email.required' => 'El cambo correo electrónico es obligatorio',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'email.unique' => 'Ya existe un usuario con este correo',
            'licen.exists'=>'La licenciatura no es un dato válido',
            'nombre.max'=>'El campo nombre es demasiado largo, no debe exeder los 255 caracteres',
            'apellido.max'=>'El campo apellido es demasiado largo, no debe exeder los 255 caracteres',
            'email.max'=>'El campo correo es demasiado largo, no debe exeder los 255 caracteres',
        ]);
        $Coordinator = Coordinator::findOrFail($id);
        $Coordinator -> licenciatura = $request->licen;
        $Coordinator -> nombre = $request-> nombre;
        $Coordinator -> apellido = $request -> apellido;
        $Coordinator -> correo = $request -> email;
        if ($request->password != ''){
            $this->validate($request, [
                'password' => 'required|confirmed|min:8|max:255'
            ],[
                'password.required' => 'Es necesario una contraseña',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'La contraseña tiene que tener almenos 8 caracteres',
                'password.max'=>'La contraseña demasiado larga, no debe exeder los 255 caracteres'

            ]);
            $Coordinator -> passwd = bcrypt($request->password);
        }
        try {
            $Coordinator -> save();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
        }
        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

    public function showDatos(){
        $id  =  Auth::id();
        $solicituds = (new \App\Models\Request)->where('coordinador','=',$id)->get();
        $missolis = array();
        foreach ($solicituds as $solicitud){
            $missolis[] = $solicitud->id;
        }

        $completadas = (new \App\Models\Request)->where('coordinador','=',$id)->where('estado','=',2)->count();
        $norealizada = (new \App\Models\Request)->where('coordinador','=',$id)->where('estado','=',3)->count();
        $pendientes = (new \App\Models\Request)->where('coordinador','=',$id)->where('estado','=',1)->count();
        $enproceso = (new \App\Models\Request)->where('coordinador','=',$id)->where('estado','=',4)->count();


        $evaluations = (new \App\Models\Evaluation)->whereIn('solicitud',$missolis)->count();
        $insuficiente = (new \App\Models\Evaluation)->whereIn('solicitud',$missolis)->where('aprovechamiento','=',1)->count();
        $satisfactorio = (new \App\Models\Evaluation)->whereIn('solicitud',$missolis)->where('aprovechamiento','=',2)->count();
        $bueno = (new \App\Models\Evaluation)->whereIn('solicitud',$missolis)->where('aprovechamiento','=',3)->count();
        $excelente = (new \App\Models\Evaluation)->whereIn('solicitud',$missolis)->where('aprovechamiento','=',4)->count();


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


        $coordinator = (new \App\Models\Coordinator)->where('id','=',$id)->first();
        return view('coordinador.home',compact('coordinator'))
            ->with(compact('insuficientes'))
            ->with(compact('satisfactorios'))
            ->with(compact('buenos'))
            ->with(compact('excelentes'))
            ->with(compact('solicituds'))
            ->with(compact('completadas'))
            ->with(compact('norealizada'))
            ->with(compact('pendientes'))
            ->with(compact('enproceso'));

    }

    public function destroy(Request $request){
        $id = decrypt($request->id);
        $post = (new \App\Models\Coordinator)->where('id','=',$id)->first();
        $texto = $post->nombre.' '.$post->apellido.' se eliminó correctamente';
        try {
            $post->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');

        }
        return redirect()->back()->with('message',$texto);
    }

    public function allSolicitudCoordinador(Request $request){
        $coordinador  =  Auth::id();
        $coordinator = (new \App\Models\Coordinator)->where('id','=',$coordinador)->first();
        $colecion = (new \App\Models\Request)->where('coordinador','=',$coordinador)->get();
        $materias =$colecion->unique('materia');
        $estados = $colecion->unique('estado');
        $solicituds = (new \App\Models\Request)->where('coordinador','=',$coordinador)->orderBy('fecha', 'asc')->paginate(5);
        $vista =  view('coordinador.historial')->with(compact('solicituds'))->with(compact('materias'))->with(compact
        ('estados'))->with(compact('coordinator'));
        if ($request->ajax()){
            $coordinador  =  Auth::id();
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0){
                $solicituds = (new \App\Models\Request)->where('coordinador','=',$coordinador)->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado != 0){
                $solicituds = (new \App\Models\Request)->where('coordinador','=',$coordinador)
                    ->where('materia','=',$unidad)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad != 0 && $estado == 0){
                $solicituds = (new \App\Models\Request)->where('coordinador','=',$coordinador)
                    ->where('materia','=',$unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }elseif ($unidad == 0 && $estado != 0){
                $solicituds = (new \App\Models\Request)->where('coordinador','=',$coordinador)
                    ->where('estado','=',$estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('coordinador.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return $vista;
    }

    public function filtros(Request $request)
    {
        if ($request->ajax()) {
            $coordinator = Auth::id();
            $unidad = $request->unidad;
            $estado = $request->estado;
            if ($unidad === 0 && $estado === 0) {
                $solicituds = (new \App\Models\Request)->where('coordinador', '=', $coordinator)->orderBy('fecha', 'asc')->paginate(5);
            } elseif ($unidad != 0 && $estado != 0) {
                $solicituds = (new \App\Models\Request)->where('coordinador', '=', $coordinator)
                    ->where('materia', '=', $unidad)
                    ->where('estado', '=', $estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            } elseif ($unidad != 0 && $estado == 0) {
                $solicituds = (new \App\Models\Request)->where('coordinador', '=', $coordinator)
                    ->where('materia', '=', $unidad)
                    ->orderBy('fecha', 'asc')->paginate(5);
            } elseif ($unidad == 0 && $estado != 0) {
                $solicituds = (new \App\Models\Request)->where('coordinador', '=', $coordinator)
                    ->where('estado', '=', $estado)
                    ->orderBy('fecha', 'asc')->paginate(5);
            }
            $vista = view('coordinador.ajax.tablahistorial')->with(compact('solicituds'))->render();
        }
        return response()->json(array('success' => true, 'html' => $vista));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function evaluar(Request $request){
        $id = decrypt($request->id);
        $evaluada = (new \App\Models\Evaluation)->where('solicitud','=',$id)->exists();
        if ($evaluada){
            $evaluation = (new \App\Models\Evaluation)->where('solicitud','=',$id)->first();
        }

        $solicitud = (new \App\Models\Request)->where('id','=',$id)->first();
        return view('coordinador.solicitud')->with(compact('solicitud'))->with(compact('evaluada'))->with(compact('evaluation'));
    }

    //Studiantes
    public function estudiantes(Request $request){
        //$facultads = Faculty::all(['id', 'nombre']);
        $licenciatura = Auth::user()->licenciatura;
        $students = Student::where('licenciatura','=',$licenciatura)->paginate(5);
        $vista = view('coordinador.alumno.read')->with(compact('students'));
        if($request->ajax()){
            $semestre = $request->semestre;
            if ($semestre != 0){
                $students = (new \App\Models\Student)->where('licenciatura','=',$licenciatura)->where('semestre','=',$semestre)->paginate(5);

            }
            $vista = view('coordinador.alumno.ajax.tabla')->with(compact('students'))->render();
        }
        return $vista;
    }

    public function studentajaxTabla(Request $request){
        if($request->ajax()){
            $licenciatura = Auth::user()->licenciatura;
            $semestre = $request->semestre;
            $students = (new \App\Models\Student)->where('licenciatura','=',$licenciatura)->where('semestre','=',$semestre)->paginate(5);
            $vista = view('coordinador.alumno.ajax.tabla')->with(compact('students'))->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function studentedit(Request $request){
        $id = decrypt($request->id);
        $student = Student::where('id','=',$id)->first();
        $facultads = Faculty::all(['id','nombre']);
        $degrees = Degree::all(['id','nombre','facultad']);
        return view('coordinador.alumno.edit',compact('student'))
            ->with(compact('facultads',$facultads))
            ->with(compact('degrees',$degrees));
    }

    public function studentupdate(Request $request, $id){
        $this->validate($request, [
            'matri' => 'required|unique:students,matricula|integer|digits:5',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|unique:students,correo|max:255',
            'semestre' => 'required|integer|between:1,12',
        ],[
            'matri.required' => 'Es necesario ingresar una matricula',
            'nombre.required' => 'Es necesario ingresar el/los nombre(s)',
            'apellido.required' => 'Es necesario ingresar su(s) apellido(s)',
            'email.required' => 'Es necesario ingresar un email',
            'email.email' => 'Debe introducir un correo electrónico válido',
            'semestre.required' => 'Debe seleccionar un Semetre',
            'email.unique'=>'Ya existe un usuario con este correo',
            'matri.unique'=>'Ya existe un usuario con esta matricula',
            'matri.integer'=>'La matrícula no debe contener caracteres especiales ni letras',
            'matri.digits'=>'La matrícula no debe ser mayor a 5 caracteres',
            'nombre.max'=>'El campo nombre es demasiado largo, no debe exeder los 255 caracteres',
            'apellido.max'=>'El campo apellido es demasiado largo, no debe exeder los 255 caracteres',
            'correo.max'=>'El campo correo es demasiado largo, no debe exeder los 255 caracteres',
            'semestre.integer'=>'El semestre no es válido'
        ]);


        $Student = Student::findOrFail($id);
        $Student -> matricula = $request->matri;
        $Student -> nombre = $request-> nombre;
        $Student -> apellido = $request -> apellido;
        $Student -> correo = $request -> email;
        $Student -> semestre = $request -> semestre;
        if ($request->password != ''){
            $this->validate($request, [
                'password' => 'required|confirmed|min:8|max:200'
            ],[
                'password.required' => 'Es necesario una contraseña',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'La contraseña tiene que tener almenos 8 caracteres',
                'password.max'=>'El campo contraseña es demasiado largo, no debe exeder los 255 caracteres'
            ]);
            $Student -> passwd = bcrypt($request->password);
        }
        try {
            $Student -> save();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
        }


        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

}
