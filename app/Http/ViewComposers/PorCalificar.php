<?php
/**
 * Created by PhpStorm.
 * User: pxndx
 * Date: 12/07/2018
 * Time: 03:04 PM
 */

namespace App\Http\ViewComposers;

use App\Models\Evaluation;
use App\Models\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PorCalificar
{
    public function compose(View $view)
    {
        $coordinador = Auth::id();
        $calificadas = Evaluation::with('request')->get();
        $calif = array();
        foreach ($calificadas as $calificada){
            $calif[] = $calificada->solicitud;
        }
        $solicituds = Request::where('coordinador','=',$coordinador)->where('estado','=',2)->get();
        $pendientes = $solicituds->except($calif)->count();
        $view->with('nuevas', $pendientes);
    }
}