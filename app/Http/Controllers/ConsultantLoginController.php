<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:asesores');
    }
    public function showLoginForm()
    {
        return view('login_asesor');
    }
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('asesores')->attempt(['correo' => $request->email, 'password' => $request->password],
            $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('asesorhome'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        if (Consultant::where('correo','=',$request->email)->exists()){
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('message', 'Error: La contraseña es incorrecta');
        } else{
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('message', 'Error: No se encuentra registrado');
        }

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('generalhome'));
    }
}
