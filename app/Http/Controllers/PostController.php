<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use App\Models\Posteo;
use App\Models\Topico;

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
        $topicoTratado = Topico::where('nombre',$request->topico)->first();
        $posteo->topico()->associate($topicoTratado);
        $posteo->save();
        return redirect()->to('/dashboard');
    }

    public function addLike(Request $request){
        dd($request);
        $id = $request->id;
        $posteo = Posteo::where('id',$id);
        $cantidadVotos = $posteo->votos;
        $posteo->votos = $cantidadVotos + 1;
        $posteo->save();
        return redirect()->to('/dashboard');
    }


}
