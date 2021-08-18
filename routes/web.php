<?php

use Illuminate\Support\Facades\Route;
use App\Engine\MotorRecomendacionUsers;
use App\Engine\MotorRecomendacionPosteos;

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
    return view('welcome');
});

// Ruta a Inicio
Route::get('/dashboard', function () {
    $posteos = App\Models\Posteo::where('id_referido', null)->orderByDesc('id')->get();
    $topicos = App\Models\Topico::all();
    return view('dashboard')->with(compact('posteos'))->with(compact('topicos'));
})->middleware(['auth'])->name('dashboard');


// RUTAS RELATIVAS A POSTEOS //

    // Creacion de un nuevo posteo
    Route::post('/dashboard', 'PosteoController@crearPosteo')->name('nuevoPosteo');

    // 'Me gusta' para un determinado posteo
    Route::post('/gustar/id={id}','PosteoController@actualizarGustado')->name('actualizarGustado');

    // Eliminacion de un determinado posteo
    Route::post('/borrar/id={id}','PosteoController@eliminar')->name('borrarPosteo');

    // Acceso a un determinado posteo
    Route::get('/posteo/id={id}', 'PosteoController@ver')->name('verPosteo');

    // Creacion de un nuevo comentario a un posteo particular
    Route::post('/comentar/id={id}', 'PosteoController@crearComentario')->name('nuevoComentario');


// RUTAS RELATIVAS A PERFILES //

    Route::get('/usuario/alias={alias}', 'PerfilController@ver')->name('verUsuario');

    Route::post('/seguimiento/id={id}', 'SeguimientoController@actualizarEstado')->name('actualizarSeguimiento');

    Route::get('/topico/id={id}', 'TopicoController@ver')->name('verTopico');


// RUTAS RELATIVAS A TOPICOS

    Route::get('/topicos', 'TopicoController@muestra')->name('mostrarTopicos');

    Route::post('/suscripcion/id={id}', 'SuscripcionController@actualizarEstado')->name('actualizarSuscripcion');


// RUTAS RELATIVAS A RECOMENDACIONES

    Route::get('/usuarios-recomendados', 'RecomendacionUserController@verRecomendaciones')
        ->name('recomendacionesUsuarios');

    Route::get('/posteos-recomendados', 'RecomendacionPosteoController@verRecomendaciones')
        ->name('recomendacionesPosteos');


require __DIR__.'/auth.php';
