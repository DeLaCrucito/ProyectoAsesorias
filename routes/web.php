<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', function (){
        return view('home');
    })->name('generalhome');

//Logins
Route::get('/loginalumno','StudentLoginController@showLoginForm')->name('alumnologin');
Route::post('/alumnsignin','StudentLoginController@login')->name('alumnosignin');
Route::get('alumnlogout', '\App\Http\Controllers\Auth\LoginController@logout')->name('alumnologout');

Route::get('/loginasesor','ConsultantLoginController@showLoginForm')->name('asesorlogin');
Route::post('/asesorsignin','ConsultantLoginController@login')->name('asesorsignin');
Route::get('asesorlogout', '\App\Http\Controllers\Auth\LoginController@logout')->name('asesorlogout');

Route::get('/logincoor','CoordinatorLoginController@showLoginForm')->name('coordinadorlogin');
Route::post('/coorsignin','CoordinatorLoginController@login')->name('coordinadorsignin');
Route::get('coorlogout', '\App\Http\Controllers\Auth\LoginController@logout')->name('coordinadorlogout');

Route::get('/loginadmin','AdministratorLoginController@showLoginForm')->name('adminlogin');
Route::post('/adminsignin','AdministratorLoginController@login')->name('adminsignin');
Route::get('adminlogout', '\App\Http\Controllers\Auth\LoginController@logout')->name('adminlogout');

//Registro
Route::get('/registro', 'StudentController@register')->name('registro');
Route::get('/listalicens','StudentController@ajaxlicenciatura')->name('registrolicenciaturas');
Route::post('/listalicens','StudentController@ajaxlicenciatura')->name('registrolicenciaturas');
Route::get('/semestres','StudentController@ajaxsemestre')->name('registrosemestres');
Route::post('/semestres','StudentController@ajaxsemestre')->name('registrosemestres');
Route::get('/new','StudentController@create')->name('newalumno');
Route::post('/new','StudentController@create')->name('newalumno');

//Alumnos
Route::group(['prefix' => 'alumno', 'middleware' => 'auth:alumnos'],function (){
    Route::get('/profile','StudentController@showDatos')->name('profile');

    Route::get('/nueva',function (){
        return view('alumno.newsolicitud');
    })->name('nuevasolicitud');

    Route::get('/historial',function (){
        return view('alumno.historial');
    })->name('viewhistory');

    Route::post('/ready','StudentController@nuevaSolicitud');

    Route::post('/confirm','StudentController@confirmaSolicitud');
});

//Administrador
Route::group(['prefix' => 'admin', 'middleware' => 'auth:administradores'],function (){
    Route::get('/home',function (){
        return view('administrador.home');
    })->name('adminhome');

    Route::group(['prefix' => 'facultad'], function (){
        Route::get('/new','FacultyController@nuevo')->name('newfacultad');
        Route::post('/new','FacultyController@nuevo')->name('newfacultad');

        Route::get('/save','FacultyController@create')->name('savefacultad');
        Route::post('/save','FacultyController@create')->name('savefacultad');

        Route::get('/list','FacultyController@read')->name('viewfacultad');
        Route::post('/list','FacultyController@read')->name('viewfacultad');

        Route::get('/edit/{faculty}','FacultyController@edit')->name('editfacultad');
        Route::post('//edit/{faculty}','FacultyController@edit')->name('editfacultad');

        Route::get('/update/{faculty}','FacultyController@update')->name('updatefacultad');
        Route::post('//update/{faculty}','FacultyController@update')->name('updatefacultad');

        Route::get('/delete','FacultyController@delete')->name('deletefacultad');
        Route::post('/delete','FacultyController@delete')->name('deletefacultad');

        Route::group(['prefix' => 'ajax'], function (){
            Route::get('/ajaxtabla','FacultyController@ajaxTabla')->name('ajaxtablafacultad');
            Route::post('/ajaxtabla','FacultyController@ajaxTabla')->name('ajaxtablafacultad');
        });
    });

    Route::group(['prefix' => 'licenciatura'], function (){
        Route::get('/new','DegreeController@nuevo')->name('newlicenciatura');
        Route::post('/new','DegreeController@nuevo')->name('newlicenciatura');

        Route::get('/save','DegreeController@create')->name('savelicenciatura');
        Route::post('/save','DegreeController@create')->name('savelicenciatura');

        Route::get('/list','DegreeController@read')->name('viewlicenciatura');
        Route::post('/list','DegreeController@read')->name('viewlicenciatura');

        Route::get('/edit/{degree}','DegreeController@edit')->name('editlicenciatura');
        Route::post('/edit/{degree}','DegreeController@edit')->name('editlicenciatura');

        Route::get('/update{degree}','DegreeController@update')->name('updatelicenciatura');
        Route::post('/update{degree}','DegreeController@update')->name('updatelicenciatura');

        Route::get('/delete','DegreeController@delete')->name('deletefacultad');
        Route::post('/delete','DegreeController@delete')->name('deletefacultad');

        Route::group(['prefix' => 'ajax'], function (){
            Route::get('/ajaxtabla','DegreeController@ajaxTabla')->name('tablalicenciatura');
            Route::post('/ajaxtabla','DegreeController@ajaxTabla')->name('tablalicenciatura');
        });
    });



    Route::group(['prefix' => 'unidad'], function (){
        Route::get('/new','SubjectController@nuevo')->name('newunidad');
        Route::post('/new','SubjectController@nuevo')->name('newunidad');

        Route::get('/save','SubjectController@create')->name('saveunidad');
        Route::post('/save','SubjectController@create')->name('saveunidad');

        Route::get('/list','SubjectController@read')->name('viewunidad');
        Route::post('/list','SubjectController@read')->name('viewunidad');

        Route::get('/edit{subject}','SubjectController@edit')->name('editunidad');
        Route::post('/edit{subject}','SubjectController@edit')->name('editunidad');

        Route::get('/update{subject}','SubjectController@update')->name('updateunidad');
        Route::post('/update{subject}','SubjectController@update')->name('updateunidad');

        Route::get('/delete','SubjectController@delete')->name('deleteunidad');
        Route::post('/delete','SubjectController@delete')->name('deleteunidad');

        Route::group(['prefix' => 'ajax'], function (){
            Route::get('/licenciatura','SubjectController@ajaxlicenciatura')->name('ajaxlicen');
            Route::post('/licenciatura','SubjectController@ajaxlicenciatura')->name('ajaxlicen');

            Route::get('/semestres','SubjectController@ajaxsemestre')->name('ajaxsemestre');
            Route::post('/semestres','SubjectController@ajaxsemestre')->name('ajaxsemestre');

            Route::get('/tabla','SubjectController@ajaxTabla')->name('tablaunidada');
            Route::post('/tabla','SubjectController@ajaxTabla')->name('tablaunidada');
        });

    });

    Route::group(['prefix' => 'user'], function (){

        Route::get('/home', function (){
            return view('administrador.usuarios.home');
        })->name('viewusuarios');

        Route::group(['prefix' => 'alumno'], function (){

            Route::get('/list','StudentController@read')->name('viewalumno');
            Route::post('/list','StudentController@read')->name('viewalumno');

            Route::get('/edit{student}','StudentController@edit')->name('editalumno');
            Route::post('/edit{student}','StudentController@edit')->name('editalumno');

            Route::get('/update{student}','StudentController@update')->name('updatealumno');
            Route::post('/update{student}','StudentController@update')->name('updatealumno');

            Route::get('/delete','StudentController@delete')->name('deletealumno');
            Route::post('/delete','StudentController@delete')->name('deletealumno');

            Route::group(['prefix' => 'ajax'], function (){
                Route::get('/tabla','StudentController@ajaxTabla')->name('tablaalumnos');
                Route::post('/tabla','StudentController@ajaxTabla')->name('tablaalumnos');
            });
        });

        Route::group(['prefix' => 'coordinador'], function (){
            Route::get('/new','CoordinatorController@nuevo')->name('newcoordinador');
            Route::post('/new','CoordinatorController@nuevo')->name('newcoordinador');

            Route::get('/save','CoordinatorController@create')->name('savecoordinador');
            Route::post('/save','CoordinatorController@create')->name('savecoordinador');

            Route::get('/list','CoordinatorController@read')->name('viewcoordinador');
            Route::post('/list','CoordinatorController@read')->name('viewcoordinador');

            Route::get('/edit{coordinator}','CoordinatorController@edit')->name('editcoordinador');
            Route::post('/edit{coordinator}','CoordinatorController@edit')->name('editcoordinador');

            Route::get('/update{coordinator}','CoordinatorController@update')->name('updatecoordinador');
            Route::post('/update{coordinator}','CoordinatorController@update')->name('updatecoordinador');

            Route::get('/delete','CoordinatorController@delete')->name('deletecoordinador');
            Route::post('/delete','CoordinatorController@delete')->name('deletecoordinador');

            Route::group(['prefix' => 'ajax'], function (){
                Route::get('/tabla','CoordinatorController@ajaxTabla')->name('tablacoordinadores');
                Route::post('/tabla','CoordinatorController@ajaxTabla')->name('tablacoordinadores');
            });
        });

        Route::group(['prefix' => 'asesor'], function (){
            Route::get('/new','ConsultantController@nuevo')->name('newasesor');
            Route::post('/new','ConsultantController@nuevo')->name('newasesor');

            Route::get('/save','ConsultantController@create')->name('saveasesor');
            Route::post('/save','ConsultantController@create')->name('saveasesor');

            Route::get('/list','ConsultantController@read')->name('viewasesor');
            Route::post('/list','ConsultantController@read')->name('viewasesor');

            Route::get('/edit{consultant}','ConsultantController@edit')->name('editasesor');
            Route::post('/edit{consultant}','ConsultantController@edit')->name('editasesor');

            Route::get('/update{coordinator}','ConsultantController@update')->name('updateasesor');
            Route::post('/update{coordinator}','ConsultantController@update')->name('updateasesor');

            Route::get('/delete','ConsultantController@delete')->name('deleteasesor');
            Route::post('/delete','ConsultantController@delete')->name('deleteasesor');

            Route::group(['prefix' => 'ajax'], function (){
                Route::get('/tabla','ConsultantController@ajaxTabla')->name('tablaasesor');
                Route::post('/tabla','ConsultantController@ajaxTabla')->name('tablaasesor');
            });
        });
    });
});

//Coordinador
Route::group(['prefix' => 'coordinador', 'middleware' => 'auth:coordinadores'],function (){
    Route::get('/profile','CoordinatorController@showDatos')->name('coordinadorhome');
    Route::post('/profile','CoordinatorController@showDatos')->name('coordinadorhome');

    Route::get('/listaunidades','SubjectController@read')->name('unidades');
    Route::post('/listaunidades','SubjectController@read')->name('unidades');

    Route::get('/listaasesores','ConsultantController@listaasesores')->name('verasesores');
    Route::post('/listaasesores','ConsultantController@listaasesores')->name('verasesores');

    Route::get('/detalles{consultant}','ConsultantController@detalles')->name('detalleasesor');
    Route::post('/detalles{consultant}','ConsultantController@detalles')->name('detalleasesor');

    Route::group(['prefix' => 'ajax'], function (){
        Route::get('/licenciatura','SubjectController@ajaxlicenciatura')->name('coorajaxlicen');
        Route::post('/licenciatura','SubjectController@ajaxlicenciatura')->name('coorajaxlicen');

        Route::get('/asesortabla','ConsultantController@especialidad')->name('filtroespecialidad');
        Route::post('/asesortabla','ConsultantController@especialidad')->name('filtroespecialidad');

        Route::get('/semestres','SubjectController@ajaxsemestre')->name('coorajaxsemestre');
        Route::post('/semestres','SubjectController@ajaxsemestre')->name('coorajaxsemestre');

        Route::get('/tabla','SubjectController@ajaxTabla')->name('coortablaunidada');
        Route::post('/tabla','SubjectController@ajaxTabla')->name('coortablaunidada');
    });
});

//Asesor
Route::group(['prefix' => 'asesores', 'middleware' => 'auth:asesores'],function (){

});