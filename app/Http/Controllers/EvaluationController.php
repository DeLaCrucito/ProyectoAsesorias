<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Exploitation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function calificar(Request $request){
        $this->validate($request, [
            'calificacion' => 'required|numeric|between:0,100|integer|digits_between:0,3'
        ],[
            'calificacion.required' => 'Debe introducir la calificación',
            'calificacion.numeric' => 'Solo se aceptan números',
            'calificacion.between' => 'El valor debe estar entre 0 y 100',
            'calificacion.digits_between' => 'El campo no debe exeder tres caracteres',
            'calificacion.integer' => 'Los valores deben ser enteros'
        ]);

        $id = decrypt($request->id);
        $nota = $request->calificacion;
        $exploitations = (new \App\Models\Exploitation)->get();
        foreach ($exploitations as $exploitation){
            $min = $exploitation->min;
            $max = $exploitation->max;
            $eval= $exploitation->id;
            if ($nota >= $min && $nota <= $max){
                $Evaluation = new Evaluation();
                $Evaluation->solicitud = $id;
                $Evaluation->nota = $nota;
                $Evaluation->aprovechamiento = $eval;
                try {
                    $Evaluation->save();
                } catch (\Exception $e) {
                    return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
                }
                return redirect()->back()->with('message', 'Se ha guardado la califición');
            }
        }
    }
}
