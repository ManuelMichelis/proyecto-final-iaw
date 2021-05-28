<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use App\Models\Posteo;

class PostController extends Controller
{
    /**
     * Obtiene todos los empleados registrados y lo suministra a una vista para su visualización
     */
    public function create (Request $request) {
        $posteo = new Posteo;
        $posteo->titulo = $request->titulo;
        $posteo->contenido = $request->contenido;
        $posteo->id_referido = $request->referido;
        $posteo->usuario()->associate(Auth::user());
        $posteo->save();
        $this->redirectTo = route('dashboard');
    }

}
