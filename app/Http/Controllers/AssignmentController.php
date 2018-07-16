<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function asignar(Request $request){
        $unidad = decrypt($request->subject);
        $asesor = decrypt($request->consultant);
        $code = $unidad.'-'. $asesor;
        $materia = (new \App\Models\Subject)->where('id','=',$unidad)->first();
        if ((new \App\Models\Assignment)->where('code', '=', $code)->exists()) {
            $texto = 'La materia '.$materia->nombre.' ya está asignada, intente con otra materia.';
            return redirect()->back()->with('alert', $texto);
        } else{
            $Assignment = new Assignment();
            $Assignment -> materia = $unidad;
            $Assignment -> asesor = $asesor;
            $Assignment -> code = $code;
            try {
                $Assignment -> save();
            } catch (\Exception $e) {
                return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
            }


            $texto = 'La materia '.$materia->nombre.' se agregó con éxito';
            return redirect()->back()->with('message', $texto);
        }
    }

    public function destroy(Request $request){
        $consultant = decrypt($request->id);
        $post = (new \App\Models\Assignment)->where('id','=',$consultant)->first();
        try {
            $post->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
        }
        return redirect()->back()->with('message', 'La materia fue removida con éxito');

    }

    public function listaasesores(Request $request){
        $unidad = decrypt($request->unidad);
        $assigns = (new \App\Models\Assignment)->where('materia','=',$unidad)->get();
        $asesores = array();
        foreach ($assigns as $assign){
            $asesores[] = $assign->asesor;
        }
        $consultants = (new \App\Models\Consultant)->whereNotIn('id',$asesores)->orderBy('apellido','asc')->paginate(5);
        $subject = (new \App\Models\Subject)->where('id','=',$unidad)->first();
        $vista = view('coordinador.variosasesores')->with(compact('consultants'))->with(compact('subject'));
        if($request->ajax()){
            $unidad = decrypt($request->unidad);
            $especialidad = $request->especialidad;
            if ($especialidad != 'nada'){
                $consultants = (new \App\Models\Consultant)->whereNotIn('id',$asesores)->orderBy('apellido','asc')->where('especialidad', '=',$especialidad)->orderBy('apellido','asc')
                    ->paginate(5);

                $subject = (new \App\Models\Subject)->where('id','=',$unidad)->first();

            }
            try {
                $vista = view('coordinador.ajax.tablavariosasesores')->with(compact('consultants'))->with(compact('subject'))->render();
            } catch (\Throwable $e) {
                return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');

            }
        }
        return $vista;
    }

    public function especialidad(Request $request){
        if($request->ajax()){
            $unidad = decrypt($request->unidad);
            $especialidad = $request->especialidad;
            $assigns = (new \App\Models\Assignment)->where('materia','=',$unidad)->get();
            $asesores = array();
            foreach ($assigns as $assign){
                $asesores[] = $assign->asesor;
            }
            $consultants = (new \App\Models\Consultant)->whereNotIn('id',$asesores)->orderBy('apellido','asc')->where('especialidad', '=',$especialidad)->orderBy('apellido','asc')
                ->paginate(5);

            $subject = (new \App\Models\Subject)->where('id','=',$unidad)->first();

            try {
                $vista = view('coordinador.ajax.tablavariosasesores')->with(compact('consultants'))->with(compact('subject'))
                    ->render();
            } catch (\Throwable $e) {
                return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');

            }
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }
}
