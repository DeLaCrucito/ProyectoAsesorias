<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function nuevo()
    {
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.licenciatura.create', compact('facultads', $facultads));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'facultad' => 'required|exists:faculties,id',
            'nombre' => 'required|max:255',
            'semestres' => 'required|integer|between:1,12'
        ],[
            'facultad.required' => 'Debe seleccionar una facultad',
            'nombre.required' => 'Es necesario ingrasar el nombre',
            'facultad.exists' => 'La facultad no es un dato válido',
            'nombre.max' => 'El nombre es demasiado largo, no debe exceder los 255 caracteres',
            'semestres.required'=> 'Debe introducir los semestres de la licenciatura',
            'semestres.integer'=>'El campo semestres debe ser un número entero',
            'semestres.between' => 'El campo semestres no es válido'

        ]);

        $Degree = new Degree();
        $Degree-> facultad = $request->facultad;
        $Degree-> nombre = $request->nombre;
        $Degree-> semestres = $request->semestres;
        try {
            $Degree-> save();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
        }

        return view('administrador.licenciatura.ajax.exito');
    }

    public function read(Request $request){
        $facultads = Faculty::all(['id', 'nombre']);
        $vista = view('administrador.licenciatura.read')->with(compact('facultads'));
        if($request->ajax()){
            $facultad = $request->facultad;
            $degrees = Degree::where('facultad', '=', $facultad)->paginate(5);
            return view('administrador.licenciatura.ajax.tabla', compact('degrees'))->with('facultads',$facultads);
        }
        return $vista;
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $facultad = $request->facultad;
            $degrees = Degree::where('facultad', '=', $facultad)->paginate(5);
            $datos = compact('degrees',$degrees);
            $vista = view('administrador.licenciatura.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function edit(Request $request){
        $id = decrypt($request->id);
        $degree = (new \App\Models\Degree)->where('id','=',$id)->first();
        $facultads = Faculty::all(['id', 'nombre']);
        return view('administrador.licenciatura.edit', compact('degree'))->with('facultads',$facultads);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'facultad' => 'required|exists:faculties,id',
            'nombre' => 'required|max:255',
            'semestres' => 'required|integer|between:1,12'
        ],[
            'facultad.required' => 'Debe seleccionar una facultad',
            'nombre.required' => 'Es necesario ingrasar el nombre',
            'facultad.exists' => 'La facultad no es un dato válido',
            'nombre.max' => 'El nombre es demasiado largo, no debe exceder los 255 caracteres',
            'semestres.required'=> 'Debe introducir los semestres de la licenciatura',
            'semestres.integer'=>'El campo semestres debe ser un número entero',
            'semestres.between' => 'El campo semestres no es válido'

        ]);

        $Degree = Degree::findOrFail($id);
        $Degree -> facultad = $request -> facultad;
        $Degree -> nombre = $request -> nombre;
        $Degree -> semestres = $request -> semestres;
        try {
            $Degree->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');
        }

        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

    public function destroy(Request $request){
        $id = decrypt($request->id);
        $post = (new \App\Models\Degree)->where('id','=',$id)->first();
        $texto = $post->nombre.' se eliminó correctamente';
        try {
            $post->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'La operación ha fallado, por favor, contacte al administrador.');

        }
        return redirect()->back()->with('message',$texto);
    }

}

