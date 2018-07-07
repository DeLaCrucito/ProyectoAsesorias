<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RequestController extends Controller
{
    public function nuevaSolicitud(Request $request){
        $this->validate($request, [
            'unidad' => 'required|numeric',
            'asesor' => 'required|numeric',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'tipo' => 'required',
            'textema' => 'required',
            'periodo' => 'required',
            'apoyo' => 'required'
        ],[
            'unidad.required' => 'Debe seleccionar una unidad',
            'unidadd.numeric' => 'El valor no es correcto',
            'asesor.numeric' => 'El valor no es correcto',
            'asesor.required' => 'Debe seleccionar un asesor',
            'fecha.required' => 'Debe seleccionar una fecha',
            'fecha.date_format' => 'Debe introducir una fecha válida',
            'hora.required' => 'Debe seleccionar una hora',
            'hora.date' => 'Debe seleccionar una hora válida',
            'tipo.required' => 'El campo tipo es obligatorio',
            'textema.required' => 'Debe introducir un tema',
            'periodo.required' => 'Debe seleccionar un periodo',
            'apoyo.required' => 'El campo apoyo es obligatorio'
        ]);

        $alumno  =  Auth::id();
        $student = Student::findOrFail($alumno);
        $unidad = $request->unidad;
        $asesor = $request->asesor;
        $fecha = $request->fecha;
        $hora = $request->hora;
        $tipo = $request->tipo;
        $tema = $request->textema;
        $periodo = $request->periodo;
        $apoyo = $request->apoyo;

        $subject = Subject::findOrFail($unidad);
        $consultant = Consultant::findOrFail($asesor);

        $datos = [];
        $datos['fecha'] = $fecha;
        $datos['hora'] = $hora;
        $datos['tipo'] = $tipo;
        $datos['tema'] = $tema;
        $datos['periodo'] = $periodo;
        $datos['apoyo'] = $apoyo;

        return view('alumno.confirmacion')
            ->with(compact('student'))
            ->with(compact('subject'))
            ->with(compact('consultant'))
            ->with(compact('datos'));
    }

    public function confirmaSolicitud(Request $request){
        $licenciatura = Auth::user()->licenciatura;
        $coordinator = Coordinator::where('licenciatura','=',$licenciatura)->first();
        $alumno  =  Auth::id();
        $asesor = decrypt($request->asesor);
        $coordinador = $coordinator->id;
        $unidad = decrypt($request->unidad);
        $fecha = decrypt($request->fecha);
        $hora = decrypt($request->hora);
        $apoyo = decrypt($request->apoyo);
        $tipo = decrypt($request->tipo);
        $tema = decrypt($request->tema);
        $periodo = decrypt($request->periodo);

        $foliohora = str_replace(':', '', $hora);
        $foliofecha = str_replace('-', '', $fecha);
        $folio = $alumno .'-'.$asesor.'-'.$coordinador.'-'.$unidad.'-'.$foliofecha.'-'.$foliohora;

        $solicituds = \App\Models\Request::where('asesor','=',$asesor)->get();

        foreach ($solicituds as $solicitud){
            $fechasoli = str_replace('-', '', $solicitud->fecha);
            $horasoli = str_replace(':', '', $solicitud->horario);
            if ($fechasoli === $foliofecha && $horasoli === $foliohora){
                return redirect()->route('nuevasolicitud')->with('message', 'Error: El asesor ya tiene una solicitud agendada con esta fecha y hora');
            }
        }

        if (\App\Models\Request::where('folio','=',$folio)->exists()){
            return redirect()->route('nuevasolicitud')->with('message', 'Error: La solicitud no pudo ser procesada con este asesor,
            fecha y horario');
        }

        $Solicitud = new \App\Models\Request();
        $Solicitud -> alumno = $alumno;
        $Solicitud -> asesor = $asesor;
        $Solicitud -> coordinador = $coordinador;
        $Solicitud -> materia = $unidad;
        $Solicitud -> fecha = $fecha;
        $Solicitud -> horario = strtotime($hora);
        $Solicitud -> apoyo = $apoyo;
        $Solicitud -> tipo = $tipo;
        $Solicitud -> tema = $tema;
        $Solicitud -> periodo = $periodo;
        $Solicitud -> folio = $folio;
        $Solicitud -> save();

        return view('alumno.prueba')->with(compact('fecha'))->with(compact('hora'))->with(compact('folio'));
    }
}
