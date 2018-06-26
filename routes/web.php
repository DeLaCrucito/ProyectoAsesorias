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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function (){
    return view('registro');
})->name('register');

Route::group(['prefix' => 'alumno'],function (){
    Route::get('/profile',function (){
        return view('alumno.home');
    })->name('profile');

    Route::get('/nueva',function (){
        return view('alumno.newsolicitud');
    })->name('nuevasolicitud');

    Route::get('/historial',function (){
        return view('alumno.historial');
    })->name('viewhistory');

    Route::post('/ready','StudentController@nuevaSolicitud');

    Route::post('/confirm','StudentController@confirmaSolicitud');
});

Route::group(['prefix' => 'admin'],function (){
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
        Route::post('/update{subject','SubjectController@update')->name('updateunidad');

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
            Route::get('/new','StudentController@nuevo')->name('newalumno');
            Route::post('/new','StudentController@nuevo')->name('newalumno');

            Route::get('/save','StudentController@create')->name('savealumno');
            Route::post('/save','StudentController@create')->name('savealumno');

            Route::get('/list','StudentController@read')->name('viewalumno');
            Route::post('/list','StudentController@read')->name('viewalumno');

            Route::get('/edit','StudentController@update')->name('editalumno');
            Route::post('/edit','StudentController@update')->name('editalumno');

            Route::get('/delete','StudentController@delete')->name('deletealumno');
            Route::post('/delete','StudentController@delete')->name('deletealumno');

        });

        Route::group(['prefix' => 'coordinador'], function (){
            Route::get('/new','FacultyController@nuevo')->name('newcoordinador');
            Route::post('/new','FacultyController@nuevo')->name('newcoordinador');

            Route::get('/save','FacultyController@create')->name('savecoordinador');
            Route::post('/save','FacultyController@create')->name('savecoordinador');

            Route::get('/list','FacultyController@read')->name('viewcoordinador');
            Route::post('/list','FacultyController@read')->name('viewcoordinador');

            Route::get('/edit','FacultyController@update')->name('editcoordinador');
            Route::post('/edit','FacultyController@update')->name('editcoordinador');

            Route::get('/delete','FacultyController@delete')->name('deletecoordinador');
            Route::post('/delete','FacultyController@delete')->name('deletecoordinador');

        });

        Route::group(['prefix' => 'asesor'], function (){
            Route::get('/new','ConsultantController@nuevo')->name('newasesor');
            Route::post('/new','ConsultantController@nuevo')->name('newasesor');

            Route::get('/save','ConsultantController@create')->name('saveasesor');
            Route::post('/save','ConsultantController@create')->name('saveasesor');

            Route::get('/list','ConsultantController@read')->name('viewasesor');
            Route::post('/list','ConsultantController@read')->name('viewasesor');

            Route::get('/edit','ConsultantController@update')->name('editasesor');
            Route::post('/edit','ConsultantController@update')->name('editasesor');

            Route::get('/delete','ConsultantController@delete')->name('deleteasesor');
            Route::post('/delete','ConsultantController@delete')->name('deleteasesor');

        });

    });
});