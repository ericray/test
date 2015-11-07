<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use App\User;
use App\Grupo;
use App\Escuela;

//Authentication routes

Route::get('admin/login','Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin/logout','Auth\AuthController@getLogout');

//Public authentication routes

Route::get('/login','PublicAuthController@getLogin');
Route::post('/login', 'PublicAuthController@postLogin');
Route::get('/logout','PublicAuthController@getLogout');

Route::group(['prefix' => 'admin','middleware' => ['auth','backend_access']],function(){

    Route::get('/','AdminPagesController@home');
    Route::get('/mail','AdminPagesController@sendMail');

    /* Edit password */

    Route::get('/director/{id}/edit/password','DirectorController@getEditPassword');
    Route::post('/director/{id}/edit/password','DirectorController@postEditPassword');

    Route::get('/administrador/{id}/edit/password','AdministradorController@getEditPassword');
    Route::post('/administrador/{id}/edit/password','AdministradorController@postEditPassword');

    Route::get('/alumno/{id}/edit/password','AlumnoController@getEditPassword');
    Route::post('/alumno/{id}/edit/password','AlumnoController@postEditPassword');

    /* RESTful */

    Route::resources([
        'administrador' => 'AdministradorController',
        'director'      => 'DirectorController',
        'maestro'       => 'MaestroController',
        'escuela'       => 'EscuelaController',
        'estado'        => 'EstadoController',
        'tabla'         => 'TablaController',
        'estatus'       => 'EstatusController',
        'alumno'        => 'AlumnoController'
    ]);

});

Route::group(['prefix' => '/','middleware' => 'public_auth'],function(){

    Route::get('/', 'PublicPagesController@home');

    Route::get('grupos','PublicPagesController@gruposJson');

    Route::get('grupo/{grupo_id}/alumnos','AlumnoController@alumnoByGrupo');

    Route::get('/escuelas','PublicPagesController@escuelasJson');

    Route::get('/alumno/{alumno_id}/tareas','AlumnoController@getTareasAlumno');

    Route::get('alumno/{alumno_id}/tarea/{tarea_id}/calificar','TareaController@getCalificarTarea');

    Route::post('/periodos','PeriodoController@periodosJson');

    Route::post('grupo/alumnos','AlumnoController@postAlumnoByGrupo');

    Route::post('alumno/tareas','AlumnoController@postTareasAlumno');

    Route::post('tarea/calificar','TareaController@postCalificarTarea');

    Route::resources([
        'periodo' => 'PeriodoController'
    ]);

});