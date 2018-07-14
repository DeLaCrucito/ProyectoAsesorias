<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use Illuminate\Support\Facades\DB;


class FacultyController extends Controller
{
    public function nuevo(){
        return view('administrador.facultad.create');
    }

    public function create(Request $request){
        $this->validate($request, [
            'nombre' => 'required',
            'nivel' => 'required',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio',
            'nivel.required' => 'Debe seleccionar un nivel de estudios'
        ]);

        $Faculty = new Faculty();
        $Faculty -> nombre = $request -> nombre;
        $Faculty -> tipo = $request -> nivel;
        $Faculty -> save();

        return view('administrador.facultad.ajax.exito');
    }

    public function read(Request $request){
        $vista = view('administrador.facultad.read');
        if($request->ajax()){
            $nivel = $request->tipo;
            $facultads = (new \App\Models\Faculty)->where('tipo', '=', $nivel)->paginate(5);
            return view('administrador.facultad.ajax.tabla', compact('facultads'));
        }
        return $vista;
    }

    public function ajaxTabla(Request $request){
        if($request->ajax()){
            $nivel = $request->tipo;
            $facultads = Faculty::where('tipo', '=', $nivel)->paginate(5);
            $datos = compact('facultads',$facultads);
            $vista = view('administrador.facultad.ajax.tabla', $datos)->render();
        }
        return response()->json(array('success' => true, 'html'=>$vista));
    }

    public function edit(Request $request){
        $facultad = decrypt($request->id);
        $faculty = (new \App\Models\Faculty)->where('id','=',$facultad)->first();
        return view('administrador.facultad.edit', compact('faculty'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'nombre' => 'required',
            'nivel' => 'required',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio',
            'nivel.required' => 'Debe seleccionar un nivel de estudios'
        ]);

        $id = ($request->id);
        $Faculty = Faculty::findOrFail($id);
        $Faculty -> nombre = $request -> nombre;
        $Faculty -> tipo = $request -> nivel;
        $Faculty -> save();

        return redirect()->back()->with('message','Los cambios se realizaron con éxito');
    }

    public function destroy(Request $request){
        $id = decrypt($request->id);
        $post = Faculty::where('id','=',$id)->first();
        $texto = $post->nombre.' se eliminó correctamente';
        $post -> delete();

        return redirect()->back()->with('message',$texto);
    }

}
