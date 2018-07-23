<?php

namespace App\Http\Controllers;

use App\Mail\Recordatorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdministratorController extends Controller
{
    public function recordatorio(){
        $solis = (new \App\Models\Request)->where('estado','=',4)->get();
        foreach ($solis as $soli){
            $id = $soli->id;
            $Nueva = (new \App\Models\Request)->where('id','=',$id)->first();

                Mail::to($Nueva->student->correo)->send(new Recordatorio($Nueva));
                Mail::to($Nueva->consultant->correo)->send(new Recordatorio($Nueva));


        }
        return redirect()->back();
    }
}
