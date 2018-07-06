<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function nuevohorario(Request $request, Consultant $consultant){
        $horas = Schedule::with('consultant')->where('asesor','=',$consultant->id)->get();
        $schedules = Schedule::with('consultant')->where('asesor','=',$consultant->id)->paginate(5);
        $vista = view('coordinador.horarios',compact('consultant'))->with(compact('schedules'))->with(compact('horas'));
        if($request->ajax()){
            $schedules = Schedule::with('consultant')->where('asesor','=',$consultant->id)->paginate(5);
            $vista = view('coordinador.ajax.tablahoras', compact('schedules'))->with(compact('consultant'))->render();
        }
        return $vista;
    }

    public function destroy(Request $request){
        $consultant = $request->consultant;
        $post = Schedule::findOrFail($request -> id);
        $post -> delete();
        return redirect()->back();
    }

    public function savehorario(Request $request, Consultant $consultant){
        $day = $request->dia;
        $hr_inicio = $request->hr_inicio;
        $hr_fin = $request->hr_fin;
        $code = $day . '-' . $hr_inicio .'-'. $hr_fin . '-'. $consultant->id;

        $inicio = str_replace(':', '', $hr_inicio);
        $fin = str_replace(':','',$hr_fin);

        $this->validate($request, [
            'dia' => 'required',
            'hr_inicio' => 'required',
            'hr_fin' => 'required'
        ],[
            'dia.required' => 'Debe seleccionar un día',
            'hr_inicio.required' => 'Debe seleccionar un horario de inicio',
            'hr_fin.required' => 'Debe seleccionar un horario de fin'
        ]);

        $schedules = Schedule::where('asesor','=',$consultant->id)->where('dia','=',$day)->get();


        // 0800 1200
        foreach ($schedules as $schedule){
            $codigo = $schedule->code;
            $array = explode('-',$codigo);
            $init = str_replace(':', '', $array[1]);
            $finish = str_replace(':', '', $array[2]);
            if ($inicio > $init && $inicio < $finish){
                return redirect()->back()->with('message', 'Error: No fue posible asignar el horario porque ya exite un horario que causa conflicto');
            }else if ($fin < $finish && $fin > $init){
                return redirect()->back()->with('message', 'Error: No fue posible asignar el horario porque ya exite un horario que causa conflicto');
            } else if(Schedule::where('code', '=', $code)->exists()) {
                return redirect()->back()->with('message', 'Error: El horario ya existe');
            } else if ($fin < $inicio){
                return redirect()->back()->with('message', 'Error: La hora de fin debe ser mayor a la de inicio');
            }else{
                $horario = new Schedule();
                $horario->hr_inicio = strtotime($hr_inicio);
                $horario->hr_fin = strtotime($hr_fin);
                $horario->code= $code;
                $horario->asesor = $consultant->id;
                $horario->dia=$day;
                $horario->save();
                return view('coordinador.ajax.exito',compact('consultant'));
            }
        }
            $horario = new Schedule();
            $horario->hr_inicio = strtotime($hr_inicio);
            $horario->hr_fin = strtotime($hr_fin);
            $horario->code= $code;
            $horario->asesor = $consultant->id;
            $horario->dia=$day;
            $horario->save();
            return view('coordinador.ajax.exito',compact('consultant'));

    }
}
