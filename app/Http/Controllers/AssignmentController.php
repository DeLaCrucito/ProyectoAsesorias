<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function asignar(Request $request){
        $unidad = $request -> subject;
        $asesor = $request -> consultant;
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
        $consultant = $request->consultant;
        $post = Assignment::findOrFail($request -> id);
        $post -> delete();
        return redirect()->back();
    }
}
