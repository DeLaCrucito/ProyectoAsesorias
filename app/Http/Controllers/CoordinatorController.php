<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Coordinator;
use App\Models\Degree;
use App\Models\Evaluation;
use App\Models\Faculty;
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
            'licen' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email'
        ],[
            'licen.required' => 'Debe seleccionar una licenciatura',
            'nombre.required' => 'Debe seleccionar una facultad',
            'apellido.required' => 'Es necesario ingrasar el nombre',
            'usuario.required' => 'No se pudo encontrar la fase',
            'email.required' => 'El cambo semestre es obligatorio',
            'email.email' => 'Debe introducir un correo electrónico válido'
        ]);

        $Coordinator = Coordinator::findOrFail($id);
        $Coordinator -> licenciatura = $request->licen;
        $Coordinator -> nombre = $request-> nombre;
        $Coordinator -> apellido = $request -> apellido;
        $Coordinator -> correo = $request -> email;
        if ($request->password != ''){
            $this->validate($request, [
                'password' => 'required|confirmed|min:8'
            ],[
                'password.required' => 'Es necesario una contraseña',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'La contraseña tiene que tener almenos 8 caracteres'
            ]);
            $Coordinator -> passwd = bcrypt($request->password);
        }

        $Coordinator -> save();
        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

    public function showDatos(){
        $id  =  Auth::id();
        $evaluations = (new \App\Models\Evaluation)->count();
        $insuficiente = (new \App\Models\Evaluation)->where('aprovechamiento','=',1)->count();
        $satisfactorio = (new \App\Models\Evaluation)->where('aprovechamiento','=',2)->count();
        $bueno = (new \App\Models\Evaluation)->where('aprovechamiento','=',3)->count();
        $excelente = (new \App\Models\Evaluation)->where('aprovechamiento','=',4)->count();


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


        $coordinator = Coordinator::with('degree')->findOrFail($id);
        return view('coordinador.home',compact('coordinator'))
            ->with(compact('insuficientes'))
            ->with(compact('satisfactorios'))
            ->with(compact('buenos'))
            ->with(compact('excelentes'));

    }

    public function destroy(Request $request){
        $id = decrypt($request->id);
        $post = Coordinator::where('id','=',$id)->first();
        $texto = $post->nombre.' '.$post->apellido.' se eliminó correctamente';
        $post -> delete();
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


}
