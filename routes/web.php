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

Route::get('/', function () {
    return view('welcome');
});

// Ruta al inicio (actualización de posteos)
Route::get('/dashboard', function () {
    $posteos = App\Models\Posteo::all();
    return view('dashboard')->with(compact('posteos'));
})->middleware(['auth'])->name('dashboard');

Route::post('/dashboard', 'PostController@create')->name('nuevoPosteo');

require __DIR__.'/auth.php';
