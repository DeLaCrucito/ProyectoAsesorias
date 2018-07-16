<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use App\Mail\Recordatorio;
use App\Models\Consultant;
use App\Models\Coordinator;
use App\Models\Degree;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public function nuevaSolicitud(Request $request){
        $this->validate($request, [
            'unidad' => 'required|numeric|exists:subjects,id',
            'asesor' => 'required|numeric|exists:consultants,id',
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
            'apoyo.required' => 'El campo apoyo es obligatorio',
            'unidad.exists' => 'La unidad de aprendizaje no es válida',
            'asesor.exists' => 'El asesor no es válido'
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

        $datos = [];
        $datos['fecha'] = $fecha;
        $datos['hora'] = $hora;
        $datos['tipo'] = $tipo;
        $datos['tema'] = $tema;
        $datos['periodo'] = $periodo;
        $datos['apoyo'] = $apoyo;

        $subject = Subject::findOrFail($unidad);
        $consultant = Consultant::findOrFail($asesor);

        $milicen = Auth::user()->licenciatura;
        $mimatri = Auth::user()->matricula;

        if ($tipo != 'Individual'){
            $this->validate($request, [
                'compa1' => 'required|exists:students,matricula'
            ],[
                'compa1.required' => 'Debe introducir la matricula de sus compañeros',
                'compa1.exists' => 'El compañero 1 no se encuentra registrado en el sistema. Para continuar es necesario crear una cuenta.'
            ]);
            $compa1 = $request->compa1;
            $compa2 = $request->compa2;



            $companero1 = Student::where('matricula','=',$compa1)->first();
            $compa1id = $companero1->id;
            $compa1licen = $companero1->licenciatura;
            $compa1matri = $companero1->matricula;
            $datos['compa1'] = $compa1id;
            $datos['compas'] = 1;

            if ($compa1licen === $milicen){
                if ($compa1matri === $mimatri){
                    $texto = 'El compañero con matricula '.$compa1matri.' no es válido';
                    return redirect()->back()->with('message', $texto);
                }
                $data = ([
                    'fecha'=> encrypt($datos['fecha']),
                    'hora'=> encrypt($datos['hora']),
                    'tipo' => encrypt($datos['tipo']),
                    'tema'=> encrypt($datos['tema']),
                    'periodo'=> encrypt($datos['periodo']),
                    'apoyo' => encrypt($datos['apoyo']),
                    'asesor'=> encrypt($consultant->id),
                    'unidad' => encrypt($subject->id),
                    'compa1' => encrypt($datos['compa1']),
                    'compas' => encrypt($datos['compas'])
                ]);

                if (isset($compa2)){
                    $this->validate($request, [
                        'compa2' => 'required|exists:students,matricula',
                    ],[
                        'compa2.exists' => 'El compañero 2 no se encuentra registrado en el sistema. Para continuar es necesario crear una cuenta.'
                    ]);
                    $compa2 = $request->compa2;
                    $companero2 = Student::where('matricula','=',$compa2)->first();
                    $compa2id = $companero2->id;
                    $compa2licen = $companero2->licenciatura;
                    $compa2matri = $companero2->matricula;
                    $datos['compa2'] = $compa2id;
                    $datos['compas'] = 2;

                    if ($compa2licen === $milicen){
                        if ($compa2matri === $mimatri){
                            $texto = 'El compañero con matricula '.$compa1matri.' no es válido';
                            return redirect()->back()->with('message', $texto);
                        }
                        $data = ([
                            'fecha'=> encrypt($datos['fecha']),
                            'hora'=> encrypt($datos['hora']),
                            'tipo' => encrypt($datos['tipo']),
                            'tema'=> encrypt($datos['tema']),
                            'periodo'=> encrypt($datos['periodo']),
                            'apoyo' => encrypt($datos['apoyo']),
                            'asesor'=> encrypt($consultant->id),
                            'unidad' => encrypt($subject->id),
                            'compa1' => encrypt($datos['compa1']),
                            'compa2' => encrypt($datos['compa2']),
                            'compas' => encrypt($datos['compas'])
                        ]);

                        return view('alumno.confirmacion')
                            ->with(compact('student'))
                            ->with(compact('subject'))
                            ->with(compact('consultant'))
                            ->with(compact('datos'))
                            ->with(compact('companero1'))
                            ->with(compact('companero2'))
                            ->with(compact('data'))
                            ;
                    }else{
                        $texto = 'El compañero con matricula '.$compa2matri.' no pertenece a tu licenciatura';
                        return redirect()->back()->with('message', $texto);
                    }

                }

            return view('alumno.confirmacion')
                ->with(compact('student'))
                ->with(compact('subject'))
                ->with(compact('consultant'))
                ->with(compact('datos'))
                ->with(compact('companero1'))
                ->with(compact('data'))
                ;
            }else{
                $texto = 'El compañero con matricula '.$compa1matri.' no pertenece a tu licenciatura';
                return redirect()->back()->with('message', $texto);
            }

        }

        $data = ([
            'fecha'=> encrypt($datos['fecha']),
            'hora'=> encrypt($datos['hora']),
            'tipo' => encrypt($datos['tipo']),
            'tema'=> encrypt($datos['tema']),
            'periodo'=> encrypt($datos['periodo']),
            'apoyo' => encrypt($datos['apoyo']),
            'asesor'=> encrypt($consultant->id),
            'unidad' => encrypt($subject->id)
        ]);

        return view('alumno.confirmacion')
            ->with(compact('student'))
            ->with(compact('subject'))
            ->with(compact('consultant'))
            ->with(compact('datos'))
            ->with(compact('data'));
    }

    public function confirmaSolicitud(Request $request){
        $licenciatura = Auth::user()->licenciatura;
        $coordinator = (new \App\Models\Coordinator)->where('licenciatura','=',$licenciatura)->first();
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

        $newfecha = Carbon::createFromFormat('Y-m-d H:i', $fecha .' '. $hora);

        $solicituds = (new \App\Models\Request)->where('asesor','=',$asesor)->get();

        foreach ($solicituds as $solicitud){
            $fechasoli = $solicitud->fecha;
            if ($fechasoli === $newfecha){
                return redirect()->route('nuevasolicitud')->with('message', 'Error: El asesor ya tiene una solicitud agendada con esta fecha y hora');
            }
        }

        if ((new \App\Models\Request)->where('folio','=',$folio)->exists()){
            return redirect()->route('nuevasolicitud')->with('message', 'Error: La solicitud no pudo ser procesada con este asesor,
            fecha y horario');
        }

        $Solicitud = new \App\Models\Request();
        $Solicitud -> alumno = $alumno;
        $Solicitud -> asesor = $asesor;
        $Solicitud -> coordinador = $coordinador;
        $Solicitud -> materia = $unidad;
        $Solicitud -> fecha = $newfecha;
        $Solicitud -> apoyo = $apoyo;
        $Solicitud -> tipo = $tipo;
        $Solicitud -> tema = $tema;
        $Solicitud -> periodo = $periodo;
        $Solicitud -> folio = $folio;
        $Solicitud -> save();
        $identificador = $Solicitud->id;


        $Nueva = (new \App\Models\Request)->where('id','=',$identificador)->first();
        Mail::to($Nueva->student->correo)->send(new DemoEmail($Nueva));
        Mail::to($Nueva->coordinator->correo)->send(new DemoEmail($Nueva));
        Mail::to($Nueva->consultant->correo)->send(new DemoEmail($Nueva));

        if ($tipo != 'Individual'){
            $compas = decrypt($request->compas);
            if ($compas == 1){
                $alumno = decrypt($request->compa1);
                $folio = $alumno .'-'.$asesor.'-'.$coordinador.'-'.$unidad.'-'.$foliofecha.'-'.$foliohora;
                $Solicitud = new \App\Models\Request();
                $Solicitud -> alumno = $alumno;
                $Solicitud -> asesor = $asesor;
                $Solicitud -> coordinador = $coordinador;
                $Solicitud -> materia = $unidad;
                $Solicitud -> fecha = $newfecha;
                $Solicitud -> apoyo = $apoyo;
                $Solicitud -> tipo = $tipo;
                $Solicitud -> tema = $tema;
                $Solicitud -> periodo = $periodo;
                $Solicitud -> folio = $folio;
                $Solicitud -> save();
                $id1 = $Solicitud->id;
                $S1 = (new \App\Models\Request)->where('id','=',$id1)->first();
                Mail::to($S1->student->correo)->send(new DemoEmail($S1));

            }
            if ($compas != 1){
                $alumno = decrypt($request->compa1);
                $folio = $alumno .'-'.$asesor.'-'.$coordinador.'-'.$unidad.'-'.$foliofecha.'-'.$foliohora;
                $Solicitud = new \App\Models\Request();
                $Solicitud -> alumno = $alumno;
                $Solicitud -> asesor = $asesor;
                $Solicitud -> coordinador = $coordinador;
                $Solicitud -> materia = $unidad;
                $Solicitud -> fecha = $newfecha;
                $Solicitud -> apoyo = $apoyo;
                $Solicitud -> tipo = $tipo;
                $Solicitud -> tema = $tema;
                $Solicitud -> periodo = $periodo;
                $Solicitud -> folio = $folio;
                $Solicitud -> save();
                $id1 = $Solicitud->id;
                $S1 = (new \App\Models\Request)->where('id','=',$id1)->first();
                Mail::to($S1->student->correo)->send(new DemoEmail($S1));

                $alumno = decrypt($request->compa2);
                $folio = $alumno .'-'.$asesor.'-'.$coordinador.'-'.$unidad.'-'.$foliofecha.'-'.$foliohora;
                $Solicitud = new \App\Models\Request();
                $Solicitud -> alumno = $alumno;
                $Solicitud -> asesor = $asesor;
                $Solicitud -> coordinador = $coordinador;
                $Solicitud -> materia = $unidad;
                $Solicitud -> fecha = $newfecha;
                $Solicitud -> apoyo = $apoyo;
                $Solicitud -> tipo = $tipo;
                $Solicitud -> tema = $tema;
                $Solicitud -> periodo = $periodo;
                $Solicitud -> folio = $folio;
                $Solicitud -> save();
                $id2 = $Solicitud->id;
                $S2 = (new \App\Models\Request)->where('id','=',$id2)->first();
                Mail::to($S2->student->correo)->send(new DemoEmail($S2));
            }
        }

        return view('alumno.exito')
            ->with(compact('Nueva'));
    }

    public function actualizarEstado(){
        $solicituds = (new \App\Models\Request)->where('estado','=','1')->get();
        $today = Carbon::now()->format('Y-m-d');
        foreach ($solicituds as $solicitud){
            $id = $solicitud->id;
            $fechasoli = $solicitud->fecha->format('Y-m-d');
            if ($fechasoli === $today){
                $nuevasoli = (new \App\Models\Request)->where('id','=',$id)->first();
                $nuevasoli->estado = 4;
                $nuevasoli->save();
                Mail::to($nuevasoli->student->correo)->send(new Recordatorio($nuevasoli));
                Mail::to($nuevasoli->consultant->correo)->send(new Recordatorio($nuevasoli));
            }
            if ($fechasoli < $today){
                $nuevasoli = (new \App\Models\Request)->where('id','=',$id)->first();
                $nuevasoli->estado = 2;
                $nuevasoli->save();
            }
        }
        $soliruns = (new \App\Models\Request())->where('estado','=','4')->get();
        foreach ($soliruns as $solirun){
            $id = $solirun->id;
            $fecha = $solirun->fecha->format('Y-m-d');
            if ($fecha < $today){
                $actualiza = (new \App\Models\Request)->where('id','=',$id)->first();
                $actualiza->estado = 2;
                $actualiza->save();
            }
        }
    }

    public function autogeneratePDF(Request $request, $infopdf){
        $solicitud = (new \App\Models\Request)->where('id', '=',decrypt($infopdf))->first();
        $folio = $solicitud->folio;
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('pdf.solicitud', compact('solicitud'))->render());
        $dompdf->render();
        $dompdf->stream($folio,array('Attachment'=>0));
    }

    public function detalles(Request $request){
        $id = decrypt($request->id);
        $solicitud = (new \App\Models\Request)->where('id','=',$id)->first();
        return view('alumno.solicitud')->with(compact('solicitud'));
    }

    public function updateestado(Request $request){
        $this->validate($request, [
            'check' => 'required|numeric|exists:states',
        ],[
            'check.required' => 'Debe seleccionar una opción',
            'check.numeric' => 'Los datos no son correctos',
            'cehck.exists'=>'La opción seleccionada no es válida'
        ]);
        $check = $request->check;
        $id = decrypt($request->id);
        if ($check == 1){
            $Solicitud = \App\Models\Request::where('id','=',$id)->first();
            $Solicitud->estado = 2;
            $Solicitud->save();
            return redirect()->back()->with('message', 'Se ha actualizado el estado de la solicitud');
        }
        if ($check == 0){
            $Solicitud = \App\Models\Request::where('id','=',$id)->first();
            $Solicitud->estado = 3;
            $Solicitud->save();
            return redirect()->back()->with('message', 'Se ha actualizado el estado de la solicitud, Lamentamos que no se haya realizado la solicitud');
        }

    }

    public function generatePDF(Request $request, $id){
        $solicitud = (new \App\Models\Request)->where('id', '=',decrypt($id))->first();
        $folio = $solicitud->folio;
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->getDefaultPaperSize('A4');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('pdf.solicitud', compact('solicitud'))->render());
        $dompdf->render();
        $dompdf->stream($folio,array('Attachment'=>0));
    }



}
