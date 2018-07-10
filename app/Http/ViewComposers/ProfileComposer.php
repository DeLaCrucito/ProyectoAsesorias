<?php
/**
 * Created by PhpStorm.
 * User: pxndx
 * Date: 10/07/2018
 * Time: 12:20 AM
 */

namespace App\Http\ViewComposers;


use App\Models\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileComposer
{
    public function compose(View $view)
    {
        $alumno = Auth::id();
        $solicituds = Request::where('alumno','=',$alumno)->where('estado','=',4)->count();
        $view->with('nuevas', $solicituds);
    }
}