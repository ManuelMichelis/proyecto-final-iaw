<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Bienvenida
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Inicio del sitio
 */
Route::get('/dashboard', function ()
{
    $posteos = App\Models\Posteo::where('id_referido', null)->orderByDesc('id')->get();
    $topicos = App\Models\Topico::all();
    return view('dashboard')
        ->with(compact('posteos'))
        ->with(compact('topicos'));
})->middleware(['auth'])->name('dashboard');


// RUTAS RELATIVAS A POSTEOS //

    /**
     * Creacion de un nuevo posteo
     */
    Route::post('/dashboard', 'PosteoController@crearPosteo')->name('nuevoPosteo');

    /**
     * Actualizacion del estado de 'me gusta' para un determinado posteo
     */
    Route::post('/gustar/id={id}','PosteoController@actualizarGustado')->name('actualizarGustado');

    /**
     * Eliminacion de un determinado posteo
     */
    Route::post('/borrar/id={id}','PosteoController@eliminar')->name('borrarPosteo');

    /**
     * Acceso a la discusion de un determinado posteo
     */
    Route::get('/posteo/id={id}', 'PosteoController@ver')->name('verPosteo');

    /**
     * Creacion de un comentario a para un posteo determinado
     */
    Route::post('/comentar/id={id}', 'PosteoController@crearComentario')->name('nuevoComentario');


// RUTAS RELATIVAS A PERFILES //

    /**
     * Acceso al perfil de un usuario determinado
     */
    Route::get('/usuario/alias={alias}', 'PerfilController@ver')->name('verUsuario');

    /**
     * Solicitud de actualizacion del estado de seguimiento para un usuario particular
     */
    Route::post('/seguimiento/id={id}', 'SeguimientoController@actualizarEstado')->name('actualizarSeguimiento');


    //Route::get('/topico/id={id}', 'TopicoController@ver')->name('verTopico');


// RUTAS RELATIVAS A TOPICOS //

    /**
     * Muestra de la grilla de topicos del foro
     */
    Route::get('/topicos', 'TopicoController@muestra')->name('mostrarTopicos');

    /**
     * Solicitud de actualizacion del estado de suscripcion de un usuario para un topico particular
     */
    Route::post('/suscripcion/id={id}', 'SuscripcionController@actualizarEstado')->name('actualizarSuscripcion');


// RUTAS RELATIVAS A CONTENIDO PERSONALIZADO //

    /**
     * Acceso al contenido personalizado del usuario
     */
    Route::get('/contenido-personalizado', function()
    {
        return view('contenido-personalizado');
    })->name('contenidoPersonalizado');


    /**
     * Acceso a la lista de usuarios que Argument recomienda seguir
     */
    Route::get('/usuarios-recomendados', 'RecomendacionUserController@verRecomendaciones')
        ->name('recomendacionesUsuarios');

    /**
     * Acceso a la lista de posteos que Argument recomienda mirar
     */
    Route::get('/posteos-recomendados', 'RecomendacionPosteoController@verRecomendaciones')
        ->name('recomendacionesPosteos');


require __DIR__.'/auth.php';
