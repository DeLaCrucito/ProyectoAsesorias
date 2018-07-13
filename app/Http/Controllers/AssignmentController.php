<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function asignar(Request $request){
        $unidad = decrypt($request->subject);
        $asesor = decrypt($request->consultant);
        $code = $unidad.'-'. $asesor;
        if (Assignment::where('code', '=', $code)->exists()) {
            return redirect()->back()->with('message', 'Materia ya asignada para el asesor. Seleccione otra materia');
        } else{
            $Assignment = new Assignment();
            $Assignment -> materia = $unidad;
            $Assignment -> asesor = $asesor;
            $Assignment -> code = $code;
            $Assignment -> save();

            return view('coordinador.ajax.exit',compact('asesor'));
        }
    }

    public function destroy(Request $request){
        $consultant = decrypt($request->id);
        $post = (new \App\Models\Assignment)->where('id','=',$consultant)->first();
        $post->delete();
        return redirect()->back()->with('message', 'La materia fue removida con éxito');

    }
}
